<?php
header("Content-Type: application/json");

if(isset($_SESSION['token'])){
  if(isset($_POST['submit'])){
    $event_date = htmlentities($_POST['event-date']);
    $event_time = htmlentities($_POST['event-time']);
    $event_name = htmlentities($_POST['event-name']);
    //error handlers
    //check if inputs are empty
    if(empty($event_date)||empty($event_time)||empty($event_name)){
      echo json_encode(array(
        "eventadded" => false,
        "message" => "Empty event fields!",
      ));
      exit();
    }
  }
}
else{
  echo json_encode(array(
    "eventadded" => false,
    "message" => "Something is wrong!",
  ));
  exit();
}