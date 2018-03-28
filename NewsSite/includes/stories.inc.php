<?php

function setStory(){
    if(isset($_SESSION['u_id'])){
        if(isset($_POST['storySubmit'])){
            $uid = $_POST['uid'];
            $time = $_POST['timeposted'];
            $title = $_POST['title'];
            $content = $_POST['content'];
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
            echo "Rating: $rating<br>";
            echo $title."<br>";
            echo "Posted by $uid at $time <br>";
            echo nl2br($content);
        echo "</p>";
        if(isset($_SESSION['u_id'])){
            echo"
            <form class='editform' method='POST' action='editstory.php'>
                <input type='hidden' name='sid' value=$sid>
                <input type='hidden' name='uid' value=$uid>
                <input type='hidden' name='title' value=$title>
                <input type='hidden' name='content' value=$content> 
                <input type='hidden' name='time' value=$time>
                <button>Edit</button>
            </form>";//TODO fix a bug where the content to edit always display the original
        }
        echo"</div>";
    }
    $stmt->close();
}

function editStory(){
    if(isset($_SESSION['u_id'])){
        
        if(isset($_POST['storyEdit'])){
            
            $sid = $_POST['sid'];
            $uid = $_POST['uid'];
            $time = $_POST['timeposted'];
            $title = $_POST['title'];
            $content = $_POST['content'];

            if(empty($content)|| empty($title)){
                echo "Cannot submit stories without title or content!";
            }          

            else{
                include 'database.php'; 
                $stmt = $mysqli->prepare("UPDATE stories set title=?, content=? where story_id='$sid'");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt->bind_param('ss', $title, $content);
                $stmt->execute();
                $stmt->close();
                header("Location: main.php");
                exit();
            }
        }
    }
    else{
        echo "You are not logged!";
        header("Location: main.php?notloggedin");
        exit();
    }
}
?>

