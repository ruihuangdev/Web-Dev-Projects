<?php
    include "includes/comments.inc.php";

    echo " <form method='POST' action='".setComment().".>
    <input type='hidden' name='uid' value='Anonymous'>
    <input type='hidden' name='time' value='".date('Y-m-d H:i:s')."'>
    <textarea name='comment'></textarea><br>
    <button name='submit' type='commentSubmit'>comment</button>
    </form> ";

    getComments();

?>

