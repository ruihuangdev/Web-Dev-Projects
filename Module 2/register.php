<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>New User Registration</title>
        <style type="text/css">
        body{
	        width: 760px; /* how wide to make your web page */
	        background-color: #cddcec; /* what color to make the background */
	        margin: 0 auto;
	        padding: 0;
	        font:12px/16px Verdana, sans-serif; /* default font */
            text-align: center;
        }
        div#main{
	        background-color: #FFF;
	        margin: 0;
	        padding: 10px;
        }
        </style>
    </head>
    <body><div id= 'main'>
        <?php
            $username = trim($_POST["newusername"]);
            if (!preg_match('/^[a-z\d]{2,15}$/i', $username)) {
                echo "<br> ERROR: Username can only contain alphanumeric characters, between 2 to 15 characters long </br>";
                echo "<a href='home.html'>Return to Login</a>";
                exit;
            }
            
            $dir = sprintf("/home/users/%s", $username);
            $filepath = "/home/ruihuang/.files/users.txt";
            $userexist = FALSE;
            $h = fopen("/home/ruihuang/.files/users.txt", "r");
            while (!feof($h)) {
                $line = fgets($h);
                if ($username == trim($line)) {
                    $userexist = TRUE;
                }
            }
            fclose($h);

            function rrmdir($some_dir) {
                foreach (new DirectoryIterator($some_dir) as $item) {
                    if ($item->isDot()) {
                        continue;
                    }
                    if (filetype($some_dir . "/" . $item) == "dir") {
                        rrmdir($some_dir . "/" . $item);
                    } 
                    else{
                        unlink($some_dir . "/" . $item);
                    }
                }
                rmdir($some_dir);
            }

            if ($_POST['action'] == 'Create User') {
                if (!$userexist) {
                    $oldmask = umask(0);
                    mkdir($dir, 0777);
                    mkdir($dir . "/files", 0777);
                    umask($oldmask);
                    $file = fopen($filepath, 'a');
                    fwrite($file, "\n" . $username);
                    fclose($file);
                    echo "User Created <br><br>";
                    echo "<a href='home.html'>Return to Homepage</a>";
                } 
                else {
                    echo "Username already exists. <br><br>";
                    echo "<a href='home.html'>Return to Homepage</a>";
                }
            } 
            
            elseif ($_POST['action'] == 'Delete User') {
                if ($userexist) {
                    rrmdir($dir);
                    $contents = file_get_contents($filepath);
                    $contents = str_replace("\n" . $username, '', $contents);
                    file_put_contents($filepath, $contents);
                    echo "User Deleted <br><br>";
                    echo "<a href='home.html'>Return to Login</a>";
                } 
                else {
                    echo "Username does not exist. <br><br>";
                    echo "<a href='home.html'>Return to Login</a>";
                }
            } 
            else {
                echo "<br> ERROR: Try Again </br>";
                echo "<a href='home.html'>Return to Login</a>";
            }
        ?>
    </div>
    </body>
</html>