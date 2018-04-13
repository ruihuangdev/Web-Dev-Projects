<?php

function getStory($thisstory){
    include 'database.php';
    $sid = $thisstory;
    $stmt = $mysqli->prepare("SELECT * from stories where story_id = '$sid'");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($sid, $uid, $title, $link, $content, $time, $rating);
    while ($stmt->fetch()){
        echo "<div class='commentbox'><p>";
            echo "Rating: $rating<br>";
            echo $title."<br>";
            echo "Posted by $uid at $time <br>";
            echo nl2br($content);
        echo "</p>";
        echo"</div>";
    }
    $stmt->close();
}

function setComment(){
    if(isset($_SESSION['u_id'])){
        if(isset($_POST['commentSubmit'])){
            $uid = $_POST['uid'];
            $sid = $_POST['sid'];
            $time = $_POST['time'];
            $comment = $_POST['comment'];
            $rating = 1;
            if(empty($comment)){
                echo 'Do not submit an empty comment!';
            }
            else{
                include 'database.php';
                $stmt = $mysqli->prepare("INSERT INTO comments (user_uid, story_id,  content, timeposted ,rating) VALUES (?,?,?,?,?)");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt->bind_param('ssssi', $uid, $sid, $comment, $time, $rating);
                $stmt->execute();
                $stmt->close();
                //echo 'Comment submitted!';//TODO: not inserting into comments, investigate
            }
        }
    }
    else{
        echo "Sign in to comment!<br><br>";
    }
}

function getComments($thisstory){
    include 'database.php';
    $sid = $thisstory;
    $stmt = $mysqli->prepare("SELECT * from comments where story_id = '$sid'");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($cid, $uid, $sid, $comment, $time, $rating);
    while ($stmt->fetch()){
        echo "<div class='commentbox'><p>";
            echo "Rating: $rating<br>";
            echo "Posted by $uid at $time <br>";
            echo nl2br($comment);
        echo "</p>";
        echo"</div>";
    }
}