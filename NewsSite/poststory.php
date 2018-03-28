<?php
include 'includes/stories.inc.php';
$uid = $_SESSION['u_id'];
echo "<form method='POST' action='".setStory()."'>
    <input type='hidden' name='uid' value='$uid'>
    <input type='hidden' name='timeposted' value='".date('Y-m-d H:i:s')."'>
    <textarea name='title' class='storytitle'>tile...</textarea><br>
    <textarea name='content' class='storytextarea'>story...</textarea><br>
    <button type='submit' name='storySubmit' class='storybutton'>Post Story</button>
</form>";

getStory();
?>