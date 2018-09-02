<?php

session_start();


if(isset($_POST['submit'])){
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    //error handlers
    //check if inputs are empty
    if(empty($uid)||empty($pwd)){
        header("Location: ../main.php?login=empty");
        exit();
    }
    else{
        //$sql = "SELECT * FROM users WHERE user_uid = '$uid' OR user_email='$uid'";
        //$result = mysqli_query($conn, $sql);
        //$resultCheck = mysqli_nun_rows($result);
        //TODO Figure out this part

        require 'database.php';
        $stmt = $mysqli->prepare("SELECT COUNT(*), user_uid, user_pwd FROM users WHERE user_uid=?");
        // Bind the parameter
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        // Bind the results
        $stmt->bind_result($cnt, $user_id, $pwd_hash);
        $stmt->fetch();
        $stmt->close();

        if ($cnt <1){
            header("Location: ../main.php?login=error");
            exit();
        }
        else{
            if($cnt==1){
                //De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $pwd_hash);
                if($hashedPwdCheck==FALSE){
                    header("Location: ../main.php?login=error");
                    exit();
                }
                elseif($hashedPwdCheck == true){
                    //login the user here
                    $_SESSION['u_id']=$user_id;
                    header("location: ../main.php?login=success");
                    exit();
                }
            }
        }
    }
}
else{
    header("Location: ../main.php?login=error");
    exit();
}