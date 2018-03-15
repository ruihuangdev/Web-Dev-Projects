<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>Your Files</title>
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
<body>
    <div id="main">
 	<p> <b> Upload File: </b> </p>
    <form enctype="multipart/form-data" action="fileaction.php" method="POST">
 	    <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
             <label for="uploadfile_input">Choose a file to upload:</label> 
             <input name="uploadedfile" type="file" id="uploadfile_input" />
 	    </p>
 	    <p><input type="submit" name="act" value="Upload File"/></p>
    </form>


    <form action="fileaction.php" method="POST">
	    <p> <b> Files in your directory: </b> </p>
 	    <?php
            if (is_dir($dir)) {
	            foreach (glob($dir . '/*.*') as $file) {
		        $name = ltrim($file, $dir);
		        echo '<input type="radio" name="thefile" ';
		        echo 'value= "' . $file . '">' . $name . ' <br>' . "\n";
	            }
            }
        ?>
    <input type="submit" name="act" value="View Selected File" />
    </div>
</bdoy>
</html>