<?php
header("Content-Type: application/json");
ini_set("session.cookie_httponly", 1);
session_start();

if (isset($_SESSION['token'])) {
  $user_id = $_SESSION["user_id"];
  $event_date = htmlentities($_POST['event-date']);
  $event_time = htmlentities($_POST['event-time']);
  $event_name = htmlentities($_POST['event-name']);
    //error handlers
    //check if inputs are empty
  if (!isset($user_id)) {
    echo json_encode(array(
      "eventadded" => false,
      "message" => "You are not signed in"
    ));
    exit();
  } else if (empty($event_date) || empty($event_time) || empty($event_name)) {
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
      "event_time" => $event_time,
      "event_name" => $event_name
    ));
    exit();
  }
} else {
  echo json_encode(array(
    "eventadded" => false,
    "message" => "Something is wrong!",
    "session" => $_SESSION
  ));
  exit();
}