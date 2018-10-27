<?php
header("Content-Type: application/json");

if (isset($_POST['submit'])) {
  $uid = htmlentities($_POST['uid']);
  $pwd = htmlentities($_POST['pwd']);

  //error handlers
  //check if inputs are empty
  if (empty($uid) || empty($pwd)) {
    echo json_encode(array(
      "loggedin" => false,
      "message" => "Empty username or password!",
    ));
    exit();
  } else {
    require 'database.php';
    $stmt = $mysqli->prepare("SELECT COUNT(*), user_uid, user_pwd FROM users WHERE user_uid=?");
    // Bind the parameter
    $stmt->bind_param('s', $uid);
    $stmt->execute();
    // Bind the results
    $stmt->bind_result($cnt, $user_id, $pwd_hash);
    $stmt->fetch();
    $stmt->close();

    if ($cnt < 1) {
      echo json_encode(array(
        "loggedin" => false,
        "message" => "User doesn't exist!",
      ));
      exit();
    } else {
      if ($cnt == 1) {
        $hashedPwdCheck = password_verify($pwd, htmlentities($pwd_hash));
        if ($hashedPwdCheck == false) {
          echo json_encode(array(
            "loggedin" => false,
            "message" => "Incorrect password",
          ));
          exit();
        } else if ($hashedPwdCheck == true) {
          ini_set("session.cookie_httponly", 1);
          session_start();
          $_SESSION["user_id"] = htmlentities($user_id);
          $_SESSION["token"] = htmlentities(bin2hex(openssl_random_pseudo_bytes(32)));
          echo json_encode(array(
            "loggedin" => true,
            "username" => $user_id,
            "message" => "welcome back, " . $user_id . "!",
            "token" => $_SESSION["token"]
          ));
          exit();
        }
      }
    }
  }
} else {
  echo json_encode(array(
    "loggedin" => false,
    "message" => "Something is wrong!",
  ));
  exit();
}