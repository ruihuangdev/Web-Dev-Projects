<?php
    session_start();
    $action = $_POST['act'];
	$filename = $_POST['thefile'];
	$username = $_SESSION['username'];
    $loc = "viewfiles.php?user=" . $username;
    if ($action == 'View Selected File') {
    // Get the MIME type (e.g., image/jpeg)
	    $finfo = new finfo(FILEINFO_MIME_TYPE);
	    $mime = $finfo->file($filename);
    // Set the Content-Type header to the MIME type of the file, and display the file.
	    header("Content-Type: " . $mime);
	    if ($mime != '') {
		    header('Content-Disposition: filename="' . basename($filename) . '"');
	    }
	    readfile($filename);
    }
    //needed to chmod 0777 files
    if ($action == 'Delete Selected File') {
	    unlink($filename);
	    header("Location: " . $loc);
	    exit;
    }
    // Get the filename and make sure it is valid
    if ($action == 'Upload File') {
	    $uploadedfilename = basename($_FILES['uploadedfile']['name']);
	    if (!preg_match('/^[\w_\.\-]+$/', $uploadedfilename)) {
			echo "Invalid filename";
			echo"<a href='home.html'>return to homepage </a>";
	    }
	    $full_path = sprintf("/home/FileSharing/users/%s/files/%s", $_SESSION['user'], $uploadedfilename);
	    if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path)) {
		    header("Location: " . $loc);
		    exit;
        } 
        else {
		    header("Location: " . $loc);
		    exit;
	    }
    }
?>