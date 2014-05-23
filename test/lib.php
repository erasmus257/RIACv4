<?php

class Moodle {

  var $token = '12a3019e66470c5b4ec451ebf7c725bd';  // Token to access Moodle server. Must be configured in Moodle. See readme.
  var $server = 'https://moodle2-test2.univ-mlv.fr'; // Moodle URL, for example http://localhost:8080.
  var $dir = null;    // Directory on the server. For example, /moodle. If your moodle runs as root, this is empty.
  var $error = '';    // Last error of the class. We'll write the last error here when something wrong happens.
 	
  // The init function initializes the variable of class (so that it can be used).
  function init($fields) {
    $this->token = $fields['token'];
    $this->server = $fields['server'];
    $this->dir = $fields['dir'];
  }
  
  // the getUserByField renvoie le tableau des users correspondant à la recherche
 //Prend un argument avec un array associtatif key value de la forme:  array('firstname'=>'huneau'),'id'=>16739)
   //champs authorisé 
   // "id" (int) matching user id,
   // "lastname" (string) user last name (Note: you can use % for searching but it may be considerably slower!),
   // "firstname" (string) user first name (Note: you can use % for searching but it may be considerably slower!),
   // "idnumber" (string) matching user idnumber,
   // "username" (string) matching user username,
   // "email" (string) user email (Note: you can use % for searching but it may be considerably slower!),
   // "auth" (string) matching user auth plugin 
  function getUserByField($userkey){
  // Clear last error. 
  	$this->error = null;

	$counter = 0 ;
	$criter = array();
    foreach($userkey as $key => $value) {
	  $criter[$counter]=array('key'=>$key ,'value' => (string) $value);
	}
	
	$request = xmlrpc_encode_request('core_user_get_users'
	,array(  $criter )
	,array('encoding'=>'UTF-8') );
		
     //var_dump($request);  // In case you want to see XML.
     
    $context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",
      'content' => $request
    )));
    
    $path = $this->server.$this->dir."/webservice/xmlrpc/server.php?wstoken=".$this->token;
    // Send XML to server and get a reply from it.
    $file = file_get_contents($path, false, $context); // $file is the reply from server.
    // Decode the reply.
    $response = xmlrpc_decode($file);
	//var_dump($response['users'][0]); // for test purpose

    // Note: lack of permissions on Moodle will get us an XML-formatted response with NULL values.
    // In other words, one must be absolutely sure to give all the required capabilities to web services account
    // in order to execute this function successfully. Moodle says that we need the following:
    // moodle/user:viewdetails, moodle/user:viewhiddendetails, moodle/course:useremail, moodle/user:update
    // for core_user_get_users call.

    // Handle errors.
    if (!is_array($response) || !is_array($response['users']) || !is_array($response['users'][0]) || !array_key_exists('id', $response['users'][0])) {
      // We have an error.
      if ($response['faultCode'])
        $this->error = 'Moodle error: ' . $response['faultString'] . ". Fault code: ".$response['faultCode']. ".";
      else
        $this->error = 'Moodle returned no info. Check if user id exists and whether the web service
          account has capabilities required to execute core_user_get_users call.';
      $this->error .= " Actual reply from server: ".$file;
      return false;
    }
    
    // This is our normal exit (returning an array of user properties).
    $user = $response['users'];
    return $user;
  
  }
  
  // The getUser function obtains information for a Moodle user identified by its id.
  function getUser($user_id) {
  	// Clear last error.
  	$this->error = null;
    
  	// Create XML for the request. XML must be set properly for this to work.
     $request = xmlrpc_encode_request('core_user_get_users_by_id', array(array((string) $user_id)), array('encoding'=>'UTF-8'));
	
	
	//$request = xmlrpc_encode_request('core_user_get_users',
	 //array ( 'criteria' => array ( 0 => array (   'key' => 'id','value' => (string) $user_id ))) ,array('encoding'=>'UTF-8') );
		
     //var_dump($request);  // In case you want to see XML.
    
    $context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",
      'content' => $request
    )));
    
    $path = $this->server.$this->dir."/webservice/xmlrpc/server.php?wstoken=".$this->token;
    // Send XML to server and get a reply from it.
    $file = file_get_contents($path, false, $context); // $file is the reply from server.
    // Decode the reply.
    $response = xmlrpc_decode($file);
	//var_dump($request); // for test purpose

    // Note: lack of permissions on Moodle will get us an XML-formatted response with NULL values.
    // In other words, one must be absolutely sure to give all the required capabilities to web services account
    // in order to execute this function successfully. Moodle says that we need the following:
    // moodle/user:viewdetails, moodle/user:viewhiddendetails, moodle/course:useremail, moodle/user:update
    // for core_user_get_users call.

    // Handle errors.
    if (!is_array($response) || !is_array($response[0]) || !array_key_exists('id', $response[0])) {
      // We have an error.
      if ($response['faultCode'])
        $this->error = 'Moodle error: ' . $response['faultString'] . ". Fault code: ".$response['faultCode']. ".";
      else
        $this->error = 'Moodle returned no info. Check if user id exists and whether the web service
          account has capabilities required to execute core_user_get_users call.';
      $this->error .= " Actual reply from server: ".$file;
      return false;
    }
    
    // This is our normal exit (returning an array of user properties).
    $user = $response[0];
    return $user;
  }
  
  // The createUser function tries to create a new Moodle user.
  function createUser($fields) {
  	// Clear last error.
  	$this->error = null;

  	// Construct user fields array.
    $userFields = array();
    if (isset($fields['username'])) $userFields['username'] = $fields['username'];
    if (isset($fields['password'])) $userFields['password'] = $fields['password'];
    if (isset($fields['firstname'])) $userFields['firstname'] = $fields['firstname'];
    if (isset($fields['lastname'])) $userFields['lastname'] = $fields['lastname'];
    if (isset($fields['email'])) $userFields['email'] = $fields['email'];
    if (isset($fields['city'])) $userFields['city'] = $fields['city'];
    if (isset($fields['country'])) $userFields['country'] = $fields['country'];
	if (isset($fields['theme'])) $userFields['theme'] = $fields['theme'];
  	
    // Create XML for the request. XML must be set properly for this to work.
    $request = xmlrpc_encode_request('core_user_create_users', array(array($userFields)), array('encoding'=>'UTF-8'));
    // var_dump($request);  // In case you want to see XML.
    
    $context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",
      'content' => $request
    )));
    
    $path = $this->server.$this->dir."/webservice/xmlrpc/server.php?wstoken=".$this->token;
    // Send XML to server and get a reply from it.
    $file = file_get_contents($path, false, $context); // $file is the reply from server.
    // Decode the reply.
    $response = xmlrpc_decode($file);

    // Note: lack of permissions on Moodle will get us an error.
    // moodle/user:create capability is required for web service account to call core_user_create_users.

    // Handle errors.
    if (!is_array($response) || !is_array($response[0]) || !array_key_exists('id', $response[0])) {
      // We have an error.
      if ($response[faultCode])
        $this->error = 'Moodle error: ' . $response[faultString] . ". Fault code: ".$response[faultCode]. ".";
      else
        $this->error = 'Moodle returned no info. Check if Moodle is set up properly (see readme).';
      $this->error .= " Actual reply from server: ".$file;
      return false;
    }
    
    // This is our normal exit. Returning a 2-member array with new user id and username.
    $user = $response[0];
    return $user;
  } 

  // The createUser function tries to update an existing Moodle user.
  function updateUser($fields) {
  	// Clear last error.
  	$this->error = null;
  	
  	// Check if user exists.
  	$user = $this->getUser($fields['id']);
  	if (!$user)
  	  return false;

  	// Construct user fields array.
    $userFields = array();
    if (isset($fields['id'])) $userFields['id'] = $fields['id'];
    if (isset($fields['username'])) $userFields['username'] = $fields['username'];
    if (isset($fields['password'])) $userFields['password'] = $fields['password'];
    if (isset($fields['firstname'])) $userFields['firstname'] = $fields['firstname'];
    if (isset($fields['lastname'])) $userFields['lastname'] = $fields['lastname'];
    if (isset($fields['email'])) $userFields['email'] = $fields['email'];
    if (isset($fields['city'])) $userFields['city'] = $fields['city'];
    if (isset($fields['country'])) $userFields['country'] = $fields['country'];
  	
  	// Create XML for the request. XML must be set properly for this to work.
    $request = xmlrpc_encode_request('core_user_update_users', array(array($userFields)), array('encoding'=>'UTF-8'));
    // var_dump($request);  // In case you want to see XML.
    
    $context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",
      'content' => $request
    )));
    
    $path = $this->server.$this->dir."/webservice/xmlrpc/server.php?wstoken=".$this->token;
    // Send XML to server and get a reply from it.
    $file = file_get_contents($path, false, $context); // $file is the reply from server.
    // Decode the reply.
    $response = xmlrpc_decode($file);

    // Note: lack of permissions on Moodle will get us an error.
    // moodle/user:update capability is required for web service account to call core_user_update_users.

    if ($response && xmlrpc_is_fault($response)) {
      $this->error = 'Moodle error: ' . $response[faultString] . ". Fault code: ".$response[faultCode]. ".";
      $this->error .= " Actual reply from server: ".$file;
      return false;
    }
    
    // This is our normal exit after a successful update.
    return true;
  }
  
  // The deleteUser function tries to delete an existing Moodle user.
  function deleteUser($user_id) {
  	// Clear last error.
  	$this->error = null;
  	
  	// Check if user exists.
  	$user = $this->getUserByField(array('id'=>$user_id));
  	if (!$user)
  	  return false;
	
  	  
  	// Create XML for the request. XML must be set properly for this to work.
  	$request = xmlrpc_encode_request('core_user_delete_users', array(array((string) $user_id)), array('encoding' => 'UTF-8'));
    // var_dump($request);  // In case you want to see XML.
        
    $context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",
      'content' => $request
    )));
    
    $path = $this->server.$this->dir."/webservice/xmlrpc/server.php?wstoken=".$this->token;
    // Send XML to server and get a reply from it.
    $file = file_get_contents($path, false, $context); // $file is the reply from server.
    // Decode the reply.
    $response = xmlrpc_decode($file);
     
    if ($response && xmlrpc_is_fault($response)) {
      $this->error = "Moodle error: " . $response[faultString]." Fault code: " . $response[faultCode];
      return false;
    }
    
    // This is our normal exit after a successful delete.
    return true;
  }
  
  // recupere les categories correspondant au critere donnée
  //The category column to search, expected keys (value format) are:
  //"id" (int) the category id,"name" (string) the category name,"parent" 
  //(int) the parent category id,
  //"idnumber" (string) category idnumber - user must have 'moodle/category:manage' to search on idnumber,
  //"visible" (int) whether the returned categories must be visible or hidden. If the key is not passed,then the function return all categories that the user can see.
  //  - user must have 'moodle/category:manage' or 'moodle/category:viewhiddencategories' to search on visible,
  //"theme" (string) only return the categories having this theme - user must have 'moodle/category:manage' to search on theme
  // de la forme array('id' => $value,'idnumber' => $value)
  function getCategories($categoryKeyValue){
  // Clear last error. 
  	$this->error = null;

	$counter = 0 ;
	$criter = array();
    foreach($categoryKeyValue as $key => $value) {
	  $criter[$counter]=array('key'=>$key ,'value' => (string) $value);
	}
	
	$request = xmlrpc_encode_request('core_course_get_categories'
	,array(  $criter )
	,array('encoding'=>'UTF-8') );
		
     var_dump($request);  // In case you want to see XML.
     
    $context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",
      'content' => $request
    )));
    
    $path = $this->server.$this->dir."/webservice/xmlrpc/server.php?wstoken=".$this->token;
    // Send XML to server and get a reply from it.
    $file = file_get_contents($path, false, $context); // $file is the reply from server.
    // Decode the reply.
    $response = xmlrpc_decode($file);
	var_dump($response); // for test purpose

    // Note: lack of permissions on Moodle will get us an XML-formatted response with NULL values.
    // In other words, one must be absolutely sure to give all the required capabilities to web services account
    // in order to execute this function successfully. Moodle says that we need the following:
    // moodle/user:viewdetails, moodle/user:viewhiddendetails, moodle/course:useremail, moodle/user:update
    // for core_user_get_users call.

    // Handle errors.
    if (!is_array($response) || !is_array($response[0]) || !array_key_exists('id', $response[0])) {
      // We have an error.
      if ($response['faultCode'])
        $this->error = 'Moodle error: ' . $response['faultString'] . ". Fault code: ".$response['faultCode']. ".";
      else
        $this->error = 'Moodle returned no info. Check if user id exists and whether the web service
          account has capabilities required to execute core_user_get_users call.';
      $this->error .= " Actual reply from server: ".$file;
      return false;
    }
    
    // This is our normal exit (returning an array of user properties).
    $user = $response['users'];
    return $user;
  
  }
  
  // The getCourse function obtains information for a Moodle course identified by its id.
  function getCourseById($id) {
  	// Clear last error.
  	$this->error = null;
    
  	// Create XML for the request. XML must be set properly for this to work.
  	$courseids = array( $id );
    // $params = array('options'=>array('ids'=>$courseids)); // This does not work, gets us an exception inside Moodle.
    $params = array(array('ids'=>$courseids)); // This works.
  	$request = xmlrpc_encode_request('core_course_get_courses', $params, array('encoding'=>'UTF-8'));
    // var_dump($request);  // In case you want to see XML.
    
    $context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",
      'content' => $request
    )));
    
    $path = $this->server.$this->dir."/webservice/xmlrpc/server.php?wstoken=".$this->token;
    // Send XML to server and get a reply from it.
    $file = file_get_contents($path, false, $context); // $file is the reply from server.
    // Decode the reply.
    $response = xmlrpc_decode($file);

    // Note: lack of permissions on Moodle will get us an error.
    // Required capabilities for core_course_get_courses call:
    // moodle/course:view,moodle/course:update,moodle/course:viewhiddencourses
    // Make sure that your web service account role has those.

    // Handle errors.
    if (!is_array($response) || !is_array($response[0]) || !array_key_exists('id', $response[0])) {
      // We have an error.
      if ($response[faultCode])
        $this->error = 'Moodle error: ' . $response[faultString] . ". Fault code: ".$response[faultCode]. ".";
      else
        $this->error = "Moodle returned no info. Check if course id exists and whether the web service
          account has capabilities required to execute core_course_get_courses call.";
      $this->error .= " Actual reply from server: ".$file;
      return false;
    }
    
    // This is our normal exit (returning an array of course properties).
    $course = $response[0];
    return $course;
  }
  
  // The getCourse function obtains information for a Moodle course identified by its field.
  // dont work ... stupide dev
  function getCourse($courseKeyValue) {
  	// Clear last error.
  	$this->error = null;
	
    $counter = 0 ;
	$criter = array();
    foreach($courseKeyValue as $key => $value) {
	  $criter[$counter]=array('key'=>$key ,'value' => (string) $value);
	}
    
  	$request = xmlrpc_encode_request('core_course_get_courses', array($criter), array('encoding'=>'UTF-8'));
    // var_dump($request);  // In case you want to see XML.
    
    $context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",
      'content' => $request
    )));
    
    $path = $this->server.$this->dir."/webservice/xmlrpc/server.php?wstoken=".$this->token;
    // Send XML to server and get a reply from it.
    $file = file_get_contents($path, false, $context); // $file is the reply from server.
    // Decode the reply.
    $response = xmlrpc_decode($file);

    // Note: lack of permissions on Moodle will get us an error.
    // Required capabilities for core_course_get_courses call:
    // moodle/course:view,moodle/course:update,moodle/course:viewhiddencourses
    // Make sure that your web service account role has those.

    // Handle errors.
    if (!is_array($response) || !is_array($response[0]) || !array_key_exists('id', $response[0])) {
      // We have an error.
      if ($response[faultCode])
        $this->error = 'Moodle error: ' . $response[faultString] . ". Fault code: ".$response[faultCode]. ".";
      else
        $this->error = "Moodle returned no info. Check if course id exists and whether the web service
          account has capabilities required to execute core_course_get_courses call.";
      $this->error .= " Actual reply from server: ".$file;
      return false;
    }
    
    // This is our normal exit (returning an array of course properties).
    $course = $response[0];
    return $course;
  }
  
  function createCourse($fields) {
  	// Clear last error.
  	$this->error = null;

  	// Construct Course fields array.
    $courseFields = array();
    if (isset($fields['fullname'])) $courseFields['fullname'] = $fields['fullname'];
    if (isset($fields['shortname'])) $courseFields['shortname'] = $fields['shortname'];
    if (isset($fields['categoryid'])) $courseFields['categoryid'] = $fields['categoryid'];


  	
    // Create XML for the request. XML must be set properly for this to work.
    $request = xmlrpc_encode_request('core_user_create_courses', array(array($userFields)), array('encoding'=>'UTF-8'));
    // var_dump($request);  // In case you want to see XML.
    
    $context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",
      'content' => $request
    )));
    
    $path = $this->server.$this->dir."/webservice/xmlrpc/server.php?wstoken=".$this->token;
    // Send XML to server and get a reply from it.
    $file = file_get_contents($path, false, $context); // $file is the reply from server.
    // Decode the reply.
    $response = xmlrpc_decode($file);

    // Note: lack of permissions on Moodle will get us an error.
    // moodle/Course:create capability is required for web service account to call core_user_create_users.

    // Handle errors.
    if (!is_array($response) || !is_array($response[0]) || !array_key_exists('id', $response[0])) {
      // We have an error.
      if ($response[faultCode])
        $this->error = 'Moodle error: ' . $response[faultString] . ". Fault code: ".$response[faultCode]. ".";
      else
        $this->error = 'Moodle returned no info. Check if Moodle is set up properly (see readme).';
      $this->error .= " Actual reply from server: ".$file;
      return false;
    }
    
    // This is our normal exit. Returning a 2-member array with new user id and username.
    $Course = $response[0];
    return $Course;
  } 
  
  // The enrollUser function tries to enroll user in a course.
  function enrollUser($user_id, $course_id) {
  	// Clear last error.
  	$this->error = null;

  	// Check whether user exists.
  	$user = $this->getUser($user_id);
  	if (!$user)
  	  return false;
 	
  	// Here, you may wish to check $user['enrolledcourses'] to see if a user is already enrolled in a course.
    
  	// Check whether course exists.
  	$course = $this->getCourseById($course_id);
  	if (!$course)
  	  return false;
	  
  	// Create XML for the request. XML must be set properly for this to work.  This format was hard to figure out.
  	// I needed to debug the server code so see why method signatures did not match.
    $params = array(array(array('roleid'=>'5', 'userid'=>$user_id, 'courseid'=>$course_id))); // roleid 5 is "student".
  	$request = xmlrpc_encode_request('enrol_manual_enrol_users', $params, array('encoding'=>'UTF-8'));
    // var_dump($request);  // In case you want to see XML.
    
  	$context = stream_context_create(array('http' => array(
      'method' => "POST",
      'header' => "Content-Type: text/xml",
      'content' => $request
    )));
    
    $path = $this->server.$this->dir."/webservice/xmlrpc/server.php?wstoken=".$this->token;
    // Send XML to server and get a reply from it.
    $file = file_get_contents($path, false, $context); // $file is the reply from server.
    // Decode the reply.
    $response = xmlrpc_decode($file);
  	
    // enrol/manual:enrol capability is required for the web services account.
    // Also, the account must be abble to assign the "Student" role - this is configured in
    // Site administration - Users - Permissions - Define roles - Allow role assignments (make sure that the "Student" role
    // is checked for Web Services Users category (this is my custom role for web services account).
    
    if ($response && xmlrpc_is_fault($response)) {
      $this->error = "Moodle error: " . $response[faultString]." Fault code: " . $response[faultCode];
      return false;
    }
    
    // Here, you may wish to check $user['enrolledcourses'] to see if a user gor enrolled, just to be safe.
    // $user = $this->getUser($user_id);
  	    
    // This is our normal exit after a successful enrollment.
    return true;
  }
}

  
?>
