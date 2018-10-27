<?php
header("Content-Type: application/json");

if (isset($_POST['submit'])) {
  $first = $_POST['first'];
  $last = $_POST['last'];
  $email = $_POST['email'];
  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];

  //error handlers
  //check for empty fields
  if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
    echo json_encode(array(
      "userCreated" => false,
      "message" => "Don't leave any field empty!",
    ));
    exit();
  } else {
    //check if input characters are valid
    if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
      echo json_encode(array(
        "userCreated" => false,
        "message" => "Invalid first name/last name",
      ));
      exit();
    } else {
      //check if email is valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array(
          "userCreated" => false,
          "message" => "Invalid email",
        ));
        exit();
      } else {
        require 'database.php';
        $stmt = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE user_uid=?");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($dupe);
        $stmt->fetch();
        $stmt->close();
        if ($dupe > 0) {
          echo json_encode(array(
            "userCreated" => false,
            "message" => "username exists!",
          ));
          exit();
        } else {
          ///Hashing the password
          $hashedPWD = password_hash($pwd, PASSWORD_BCRYPT);

          $stmt = $mysqli->prepare("INSERT INTO users (user_first_name, user_last_name, user_email, user_uid, user_pwd) VALUES (?,?,?,?,?)");
          if (!$stmt) {
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
          }
          $stmt->bind_param('sssss', $first, $last, $email, $uid, $hashedPWD);
          $stmt->execute();
          $stmt->close();
          echo json_encode(array(
            "userCreated" => true,
            "message" => "User " . $uid . " created!",
          ));
          exit();
        }
      }
    }
  }
} else {
  echo json_encode(array(
    "userCreated" => false,
    "message" => "Something went wrong!",
  ));
  exit();
}