<?php

function setStory(){
    if(isset($_SESSION['u_id'])){
        if(isset($_POST['storySubmit'])){
            $uid = $_POST['uid'];
            $time = $_POST['timeposted'];
            $title = $_POST['title'];
            $content = $_POST['story'];
            $rating = 1;
            if(empty($content)|| empty($title)){
                echo "Cannot submit stories without title or content!";
            }          

            else{
                include 'database.php';
                $stmt = $mysqli->prepare("INSERT INTO stories (user_uid, timeposted , title, content, rating) VALUES (?,?,?,?,?)");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt->bind_param('ssssi', $uid, $time, $title, $content, $rating);
                $stmt->execute();
                $stmt->close();
                echo "Story submitted!";
            }
        }
    }
    else{
        echo "Sign in to submit a story!<br><br>";
    }

}

function getStory(){
    echo 'Here are the stories:';
    include 'database.php';
    $stmt = $mysqli->prepare("SELECT * from stories");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($sid, $uid, $title, $content, $time, $rating);
    while ($stmt->fetch()){
        echo "<div class='commentbox'><p>";
            echo $title."<br>";
            echo "Posted by $uid at $time <br>";
            echo nl2br($content);
        echo "</p></div>";
    }
    $stmt->close();
}
?>