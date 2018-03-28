<?php
include 'includes/stories.inc.php';
$user = $_SESSION['u_id'];
echo "<form method='POST' action='".setStory()."'>
    <input type='hidden' name='uid' value='$user'>
    <input type='hidden' name='timeposted' value='".date('Y-m-d H:i:s')."'>
    <input type='text' name='title'><br>
    <textarea name='story'></textarea><br>
    <button type='submit' name='storySubmit'>Post Story</button>
</form>";

getStory();
?>

