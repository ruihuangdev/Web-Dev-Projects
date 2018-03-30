<?php
    include "includes/comments.inc.php";
    $uid = $_SESSION['u_id'];
    $sid = $_POST['sid'];

    getStory($sid);

    echo " <form method='POST' action='".setComment()."'>
        <input type='hidden' name='uid' value=$uid>
        <input type='hidden' name='sid' id='sid' value=$sid>
        <input type='hidden' name='time' value='".date('Y-m-d H:i:s')."'>
        <textarea name='comment' placeholder='Your comment here'></textarea><br>
        <button name='commentSubmit' type='submit'>comment</button>
    </form> ";



    getComments($sid);

?>

