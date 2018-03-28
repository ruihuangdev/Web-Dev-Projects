<?php
function setComment(){
    if(isset($_POST['commentSubmit'])){
        $uid = $_POST['uid'];
        $time = $_POST['timeposted'];
        $comment = $_POST['comment'];
        $rating = 1;
        if(empty($comment)){
            header("Location: main.php"); //TODO: Fix location when comment is empty
            exit();
        }
        else{
            include 'database.php';
            $stmt = $mysqli->prepare("INSERT INTO comments (user_uid, timeposted , comment, rating) VALUES (?,?,?,?,?)");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->bind_param('sssi', $uid, $date, $comment, $rating);
            $stmt->execute();
            $stmt->close();
            header("Location: main.php");//TODO: Fix this to redirect to comments
            exit();
        }
    }

}

function getComment(){
    include 'database.php';
    $stmt = $mysqli->prepare("SELECT story_id, user_uid, content, timeposted, rating from comments");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($sid, $uid, $time, $content, $comment, $rating);
    while ($stmt->fetch()){
        echo "<div class='commentbox'><p>";
            echo $uid."<br>";
            echo $time."<br>";
            echo nl2br($content);
        echo "</p></div>";
    }
}