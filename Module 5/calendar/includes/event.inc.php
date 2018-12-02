<?php
header("Content-Type: application/json");
ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_only_cookies', '1');
session_start();

if (!hash_equals($_SESSION['token'], $_POST['token'])) {
  echo json_encode(array(
    "eventadded" => false,
    "message" => "Request forgery detected"
  ));
  die();
} else {
  $user_id = $_SESSION["user_id"];
  $event_date = htmlentities($_POST['event-date']);
  $event_start_time = htmlentities($_POST['event-start-time']);
  $event_end_time = htmlentities($_POST['event-end-time']);
  $event_name = htmlentities($_POST['event-name']);
    //error handlers
    //check if inputs are empty
  if (!isset($user_id)) {
    echo json_encode(array(
      "eventadded" => false,
      "message" => "You are not signed in"
    ));
    exit();
  } else if (empty($event_date) || empty($event_start_time) || empty($event_end_time) || empty($event_name)) {
    echo json_encode(array(
      "eventadded" => false,
      "message" => "Empty event fields!"
    ));
    exit();
  } else {
    echo json_encode(array(
      "eventadded" => true,
      "user_id" => $user_id,
      "event_date" => $event_date,
      "event_start_time" => $event_start_time,
      "event_end_time" => $event_end_time,
      "event_name" => $event_name
    ));
    exit();
  }
}