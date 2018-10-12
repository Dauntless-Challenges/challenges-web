<?php

//ob_start();
session_start();

require_once 'inc.php';


// ------------------------------


// Start of Page with some functions

html_head("Public Profile Page");

navbar('bgimg_public_profile');
HelpButton();


pageFade();


// ------------------------------


// Get of the entered user and selecting rws form Database

$user = $_GET['public-user'];

$conn = connect_db();

$sql = "SELECT * FROM `profiles` WHERE id_user=". getUserID($user);
$result = mysqli_query($conn, $sql);

if($result != "") $row = mysqli_fetch_array($result, MYSQL_ASSOC);

mysqli_close($conn);


// ------------------------------


/* First logical operations as result from the SQL Query
 * If there's no match => User not found!
 * If User's profile isnt Public => Hidden!
 * If there's a match => Show of the Profile!
*/

if (!isset($row)) { ?>

<div class="ProfileBox w3-card-4 w3-display-middle w3-container">
    <p class="w3-center" style="font-size: 4vw; margin-top: 16%;">User <?php echo $user; ?> not found!</p>
</div>

<?php } else if ($row['public'] == 0) { ?>

<div class="ProfileBox w3-card-4 w3-display-middle w3-container">
    <p class="w3-center" style="font-size: 4vw; margin-top: 16%;"><?php echo $user; ?>'s profile is hidden!</p>
</div>

<?php } else if($result != "") { ?>

<div class="ProfileBox w3-card-4 w3-display-middle w3-container w3-row">
<div class='w3-third w3-center'>
<p class='ProfileName w3-card-2 w3-padding PasseroOne'><?php echo getUser($row['id_user']); ?> [<?php if($row['id_guild'] != 0) echo getGuild($row['id_guild']); else echo "No Guild"; ?>]</p>
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


		<!-- ------------------------------
		

		If User is an Admin => Change the badge to Dev Badge 
		Else => show User's Badge -->

            <?php if(getUserPerm($row['id_user']) == 1) { ?>
            <p class="w3-center" style="font-size: 1vw;">Developers Team</p>
            <img src="images/dev.png" width="90%" style="margin-left: 5%;" />
        </div>
        
        <p class="w3-col l1"> </p>
        <p class="w3-col l6" style="font-size: 0.95vw;">
            ==========================<br />This member is part of Challenges Developers Team. They work their hardest to bring you the best environment.<br />Please take those people with respect!!<br />=========================</p>
        
        <div style="margin-top: -5%;">
        <?php
            echo "<span style='font-size: 0.9vw;'>Current EXP: &nbsp; <b class='w3-xlarge'>&#x221e;</b></span>";
        ?>
        
        <div class="w3-ligh-grey w3-opacity w3-round-xlarge w3-border w3-border-black">
            <div class="w3-container w3-deep-purple w3-round-xlarge" style="height: 1.25rem; width:100%;"></div>
        </div>
        </div>
            <?php } else { ?>
            <p class="w3-center" style="font-size: 1vw;"><?php echo getBadgeName($row['id_badge']); ?><br /><span class="w3-tiny w3-center"><i>Rank Badge by Dimitry Miroliubov</i></span></p>
            <img src="<?php echo getBadgeImage($row['id_badge']); ?>" width="100%" style="margin-top: -10%;" />
        </div>
        
        <p class="w3-col l1"> </p>
        <p class="w3-col l6" style="font-size: 0.95vw;">
            <?php
            if($row['id_badge'] != 0) { ?>=========================<br /><?php echo getBadgeDesc($row['id_badge']); ?><br />=========================</p>
        
        <div style="margin-top: -5%;">
        <?php
            $exp = ($row['exp'] / getBadgeEXP($row['id_badge']))*100;
            echo "<span style='font-size: 0.9vw;'>Current EXP: &nbsp ". $row['exp'] ." / ". getBadgeEXP($row["id_badge"]) ." (". round($exp, 1) ."%)</span>";
        ?>
        
        <div class="w3-ligh-grey w3-opacity w3-round-xlarge w3-border w3-border-black">
            <div class="w3-container w3-deep-purple w3-round-xlarge" style="height: 1.25rem; width:<?php echo $exp; ?>%; max-width: 100%;"></div>
        </div>
        </div>
        <?php } else echo "No Badge T^T"; } ?>
    </div>
</div>
</div>
<?php } ?>

</body>
</html>