<?php

//ob_start();
session_start();

require_once 'inc.php';


// ------------------------------


// Start of Page with some functions

html_head("Profile Page");

navbar('bgimg_index_logged');
HelpButton();


// ------------------------------


// If User isn't logged => Access denied | else show the code

if( !isset($_SESSION['user']) ) {
access();
} else {


pageFade();


// ------------------------------


// Connection to DB and selecting profiles table by UserID

$conn = connect_db();

$sql = "SELECT * FROM `profiles` WHERE id_user=". $_POST['user'];
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result, MYSQL_ASSOC);

mysqli_close($conn);



// ------------------------------


// Start of HTML Code with PHP array variables from the Select Query

?>

<div class="ProfileBox w3-display-middle w3-container w3-row">
<div class='w3-third w3-center'>
<p class='ProfileName w3-padding PasseroOne'><?php echo getUser($row['id_user']); ?> [<?php if($row['id_guild'] != 0) echo getGuild($row['id_guild']); else echo "No Guild"; ?>]</p>
<p class='ProfileTitle w3-padding w3-card-4 PasseroOne'><?php echo getTitle($row['id_title']); ?></p>

<div class="w3-xlarge" style="margin-top: 10%;">
    <p>Most Recent Challenge: &nbsp; <span style="font-size: 1.25vw;"><?php echo $row['id_challenge']; ?></span></p>
    <p>Completed Challenges: &nbsp; <span style="font-size: 1.25vw;"><?php echo $row['ch_done']; ?></span></p>
    <p>Speedruns on Board: &nbsp; <span style="font-size: 1.25vw;"><?php echo $row['sp_board']; ?></span></p>

    <p style="margin-top: 10%; font-size: 1vw;">Joined at: <?php echo date('F dS, Y \a\t h:mA', strtotime($row['date'])); ?> <br /> <i>GMT-5 (CDT)</i></p>
</div>
</div>

<div class='w3-third'>
    <p style="font-size: 1.5vw;">Favourite Weapon: <br /> <?php if($row['id_weapon'] != 0) echo getWeapon($row['id_weapon']); else echo "None"; ?></p>
</div>

<div class='w3-third' style="width: 32%; height: 5%; margin-top: 1%;">
    <p style="font-size: 1vw; word-break: break;"><?php if($row['note'] != "") echo nl2br($row['note']); else echo "No description!"; ?></p>
    
    <hr class="w3-border-black w3-margin-top" style="width: 90%; margin: auto;" />
    
    <div class="w3-row">
        <div class="w3-col l5" style="margin-top: -1%;">
            <p class="w3-center" style="font-size: 1vw;"><?php echo getBadgeName($row['id_badge']); ?><br /></p>
            <img src="<?php echo getBadgeImage($row['id_badge']); ?>" width="100%" style="margin-top: -10%;" />
        </div>
        
        <p class="w3-col l1"> </p>
        <p class="w3-col l6" style="font-size: 0.95vw;"><?php if($row['id_badge'] != 0) { ?>=========================<br /><?php echo getBadgeDesc($row['id_badge']); ?><br />=========================</p>
        
        <div style="margin-top: -5%;">
        <?php
            $exp = ($row['exp'] / getBadgeEXP($row['id_badge']))*100;
            echo "<span style='font-size: 0.9vw;'>Current EXP: &nbsp ". $row['exp'] ." / ". getBadgeEXP($row["id_badge"]) ." (". round($exp, 1) ."%)</span>";
        ?>
        
        <div class="w3-ligh-grey w3-opacity w3-round-xlarge w3-border w3-border-black">
            <div class="w3-container w3-deep-purple w3-round-xlarge" style="height: 1.25rem; width:<?php echo $exp; ?>%; max-width: 100%;"></div>
        </div>
        </div>
        <?php } else echo "No Badge T^T"; ?>
    </div>
</div>
</div>

<?php } ?>
</body>
</html>