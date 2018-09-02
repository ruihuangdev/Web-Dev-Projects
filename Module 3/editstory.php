<?php
    include_once 'header.php';
    $sid = $_POST['sid'];
    $uid = $_POST['uid'];
    $time = $_POST['time'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    include 'includes/stories.inc.php';
    
    echo "<form method='POST' action='".editStory()."'>
        <input type='hidden' name='sid' value=".$sid.">
        <input type='hidden' name='uid' value=".$uid.">
        <input type='hidden' name='timeposted' value=".$time.">
        <textarea name='title' class='storytitle'>".$title."</textarea><br>
        <textarea name='content' class='storytextarea'>".$content."</textarea><br>
        <button type='submit' name='storyEdit' class='storybutton'>Edit</button>
    </form>";
    include_once 'footer.php';
?>