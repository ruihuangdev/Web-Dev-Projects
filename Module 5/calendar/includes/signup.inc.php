<?php
if(isset($_POST['submit'])){
    $first = $_POST['first'];
    $last =  $_POST['last'];
    $email = $_POST['email'];
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    //error handlers
    //check for empty fields
    if(empty($first)||empty($last)||empty($email)||empty($uid)||empty($pwd)){
        header("Location: ../signup.php?signup=empty");
        exit();
    }
    else{
        //check if input characters are valid
        if(!preg_match("/^[a-zA-Z]*$/", $first)||!preg_match("/^[a-zA-Z]*$/", $last)){
            header("Location: ../signup.php?signup=invalid");
            exit();        
        }
        else{
            //check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                header("Location: ../signup.php?signup=invalidemail");
                exit();       
            }
            else{
                require 'database.php';

                //$sql= "SELECT * FROM users WHERE user_uid ='$uid'";
                //$result = mysqli_query($conn, $sql);
                //$resultCheck = mysqli_num_rows($result);

                $stmt = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE user_uid=?");
                $stmt->bind_param('s', $uid);
                $stmt->execute();
                $stmt->bind_result($dupe);
                $stmt->fetch();
                $stmt->close();
                if($dupe > 0){
                    header("Location: ../signup.php?signup=usertaken");
                    exit();     
                }
                else{
                    ///Hashing the password
                    $hashedPWD = password_hash($pwd, PASSWORD_DEFAULT);
                    //Insert the user into the database
                    //$sql= "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first,''$last', '$email, '$uid', '$hashedPWD');";
                    //mysql_query($conn, $sql);

                    $stmt = $mysqli->prepare("INSERT INTO users (user_first_name, user_last_name, user_email, user_uid, user_pwd) VALUES (?,?,?,?,?)");
                    if(!$stmt){
                        printf("Query Prep Failed: %s\n", $mysqli->error);
                        exit;
                    }
                    $stmt->bind_param('sssss', $first, $last, $email, $uid, $hashedPWD);
                    $stmt->execute();
                    $stmt->close();
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
}
else{
    header("Location: ../signup.php");
    exit();
}