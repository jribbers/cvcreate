<?php
  require_once '/inc/connection.php';
  include '/inc/classes/user.php';
?>
<?php
  $error = '';
  $areSet = [
    'username'    => false,
    'email'       => false,
    'password'    => false
  ];

  if(isSet($_POST['username'])){
    $areSet['username'] = $_POST['username'];
  } else {
    $error .= 'Username is a required field, please fill it out.';
  }

  if(isSet($_POST['email'])){
    $areSet['email'] = $_POST['email'];
  } else {
    $error .= 'Email is a required field, please fill it out.';
  }

  if(isSet($_POST['password']) && $_POST['passwordConf'] === $_POST['password']){
    $areSet['password'] = $_POST['password'];
  } else {
    $error .= 'Passwords do not match.';
  }

  $complete = true;
  foreach($areSet as $key => $value){
    if($value == false){
      $complete == false;
    } else {
      $complete = true;
    }
  }

  if($complete == true){
    // volgende stappen
  }
    $properties = array('username' => 'userNAAM', 'email' => 'omg@meermail.org', 'password' => 'MijnGeheim4321');

    // print_r($properties);

    $voila = new User(true, $properties);
    $test = $voila->message;
    echo $test;
?>