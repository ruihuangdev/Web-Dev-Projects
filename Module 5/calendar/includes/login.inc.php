<?php
session_start();

if(isset($_POST['submit'])){
  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];

  //error handlers
  //check if inputs are empty
  if(empty($uid)||empty($pwd)){
    echo "please make sure to fill in user id or password!";
    exit();
  }
  else{
    require 'database.php';
    $stmt = $mysqli->prepare("SELECT COUNT(*), user_uid, user_pwd FROM users WHERE user_uid=?");
    // Bind the parameter
    $stmt->bind_param('s', $uid);
    $stmt->execute();
    // Bind the results
    $stmt->bind_result($cnt, $user_id, $pwd_hash);
    $stmt->fetch();
    $stmt->close();

    if ($cnt <1){
      echo "error";
      exit();
    }
    else{
      if($cnt==1){
        //De-hashing the password
        $hashedPwdCheck = password_verify($pwd, $pwd_hash);
        if($hashedPwdCheck==FALSE){
          echo "error";
          exit();
        }
        elseif($hashedPwdCheck == true){
          //login the user here
          echo ("welcome back, ". $user_id."!");
          $_SESSION['u_id']=$user_id;
          exit();
        }
      }
    }
  }
}
else{
  echo "error";
  exit();
}