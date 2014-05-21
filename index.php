
<?php

include 'lib.php';

// To do things with Moodle, we create a new Moodle class, initialize it, and then call its functions.
$moodle = new Moodle();

// Initialize the class.
//$fields = array('token'=>$token, 'server'=>$server, 'dir'=>$dir);
//$moodle->init($fields);

// Usage examples.
// Normally, a function returns something useful, such as an array of user properties, or TRUE, on success.
// When something happens the return is FALSE, and the last error string is in $moodle->error string.
// A lot of things need to be done in Moodle for web services API to work properly. See readme in this project.

// Get user information.
$id = 1; // User id in Moodle. 1 for guest user.

// return 
$userfieldsearch =  $moodle->getUserByField(array('id'=>50385));
if ($userfieldsearch)
  ;//var_dump($userfieldsearch );          // Success, normal result.
else
  ;//var_dump($moodle->error); // Error.

  if( !$moodle->getUserByField(array('username'=>'testxml') ) ){
$userFields['username']='testxml';
$userFields['password']='Testxml1;';
$userFields['firstname']='testxml';
$userFields['lastname']='testxml';
$userFields['email']='mickael.huneau@gmail.com';
$userFields['city']='testxml';
$userFields['country']='FR';
$userFields['theme'] = 'umv4';

$usercreate =  $moodle->createUser($userFields);
if ($usercreate)
  ;//var_dump($usercreate );  // Success, normal result.
else
  var_dump($moodle->error); // Error.
 
 }
 /*
$userdelete =  $moodle->deleteUser('50385');
  if ($userdelete)
  var_dump($userdelete );          // Success, normal result.
else
  var_dump($moodle->error); // Error.
*/

/*
$course =  $moodle->getCourseById(2);
if ($course)
  var_dump($course );  // Success, normal result.
else
  var_dump($moodle->error); // Error.
*/
/*
$courseCat =  $moodle->getCategories(array('id'=>2));
if ($courseCat)
  var_dump($courseCat );  // Success, normal result.
else
  var_dump($moodle->error); // Error.
  */
  
  if( !$moodle->getcourse(array('username'=>'testxml') ) ){
   $courseFields['fullname'] = $fields['fullname'];
   $courseFields['shortname'] = $fields['shortname'];
   $courseFields['categoryid'] = $fields['categoryid'];
  
  $course =  $moodle->createCourse(array('id'=>2));
if ($course)
  var_dump($course );  // Success, normal result.
else
  var_dump($moodle->error); // Error.
  
  
  

?>
