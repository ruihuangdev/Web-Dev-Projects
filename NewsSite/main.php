<?php
    include_once 'header.php';
?>

<section class="main-container">
    <div classs = "main-wrapper">
        <?php
            require 'database.php';
        ?>
        <div id="display-options">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                <span>Sort stories by:</span>
                    <input type="submit" name='vieworder' value="new">
                    <input type="submit" name='vieworder' value="hot">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" >
                    <span> <br> </span>
            </form>
        </div>
    </div>
    <div class= "storyfeed" >
        <?php
            if (isset($_POST['vieworder'])){
                $_SESSION['vieworder'] = $_POST['vieworder'];
            }
            if(!isset($_SESSION['vieworder'])){
                $_SESSION['vieworder'] = 'hot';
            }
            if($_SESSION['vieworder'] == 'new'){
                $stmt = $mysqli->prepare("SELECT story_id, user_uid, title, content, link, timeposted, rating from stories order by timeposted DESC");
                if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
                }
            }
            elseif($_SESSION['vieworder'] == 'hot'){
                $stmt = $mysqli->prepare("SELECT story_id, user_uid, title, content, link, timeposted, rating from stories order by rating DESC");
                if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
                }
            }
            $stmt->execute();
            $stmt->bind_result($story_id, $user_uid, $title, $content, $link, $timestamp, $rating);
            $count = 1;
            while($stmt->fetch()) {
        ?>
                <div class="stories">
                    <a id="<?php echo $count; ?>"> </a>
                        <h2 class="storytitle"><?php echo "<a href=\"". $link ."\">Source</a>>"?></h2>
                        <span class="storysubtitle"><?php echo "Posted by: " .$user_uid." Time:" .$timestamp ?></span><br>
                        <h3 class="storyrating"><?php echo "Rating: ".$rating?>"</h3> 
                </div>
                <?php $count++; 
            }
            $stmt->close();
                ?>
        </div>
</section>

<?php
    include_once 'footer.php';
?>
