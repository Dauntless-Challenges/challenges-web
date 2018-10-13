<?php

//ob_start();
session_start();

require_once 'inc.php';


// ------------------------------


// Start of Page with some functions

html_head("Challenges Crossroads");

navbar('bgimg_index_logged');
HelpButton();


// ------------------------------


// If User is logged => get his name an announce it as pop-up

if( !isset($_SESSION['user']) ) {
access();
} else {
// select loggedin users detail
 $conn = connect_db();
 $sql = "SELECT * FROM `users` WHERE id_user=".$_SESSION['user'];
 $res = mysqli_query($conn, $sql);
 $userRow = mysqli_fetch_array($res, MYSQL_ASSOC);
 mysqli_close($conn);

pageFade();

// Pop up |
//        V
    
if($_SESSION['log'] == 1)
{
?>
<script>
swal({
  title: "Greetings, <?php echo $userRow['name']; ?>!",
  text: "Everything is ready and up for work!",
  type: "success",
  position: "top-end",
  showConfirmButton: false,
  timer: 2000
});
</script>
<?php
$_SESSION['log'] = 0;
}


// ------------------------------


// Start of HTML Code with Javascript function on Admin Features


?>

<div class="w3-container mySlides">

<div class="TavernBox w3-container" style="font-size: 1.75vw;">
<p class='w3-center'>Welcome <?php echo $userRow['name']; ?>!</p>

<p>- Challenges</p>

<p>- Speedrunning UwU</p>

<form method="post" action="profile.php" style="margin-left: -12%;"><input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>"><input type="submit" class="w3-btn w3-transparent w3-round-large w3-text-black" style="padding: 0 22%; margin-left: 9%;" value="- Profile Page" /></form>

<p>- Leaderboard</p>
</div>

<?php if($userRow['permission'] == 1) { ?>
<div class='w3-display-right w3-xxxlarge w3-text-white'>
    <button class='fa fa-chevron-right w3-btn w3-transparent' onclick="plusDivs(1);"></button>
</div>
<?php } ?>

</div>

<?php if($userRow['permission'] == 1) { ?>
<div class="w3-container mySlides w3-text-white Oswald" style="display: none;">
    <div class='w3-display-left w3-xxxlarge'>
    <button class='fa fa-chevron-left w3-btn w3-transparent' onclick="plusDivs(-1);"></button>
    </div>
    
    <div id="Panel">
    <p class="w3-xxlarge animation-target w3-center" style="margin-top: -2%;">Admin Panel</p>
    
    <div class="w3-row" style="margin-top: 4%;">
        <p class="w3-col l2"> </p>
        <?php
            AdminButton("titles");
            AdminButton("runs");
            AdminButton("parties");
        ?>
    </div>
    <div class="w3-row" style="margin-top: 4%;">
        <p class="w3-col l2"> </p>
        <?php
            AdminButton("difficulties");
            AdminButton("guilds");
            AdminButton("weapons");
        ?>
    </div>
    <div class="w3-row" style="margin-top: 4%;">
        <p class="w3-col l2"> </p>
        <button class="w3-col l3 w3-btn w3-transparent w3-round-large w3-xxxlarge w3-border w3-border-white w3-padding-large w3-hover-teal">Challenges</button>
        <p class="w3-col l2"> </p>
        <button class="w3-col l3 w3-btn w3-transparent w3-round-large w3-xxxlarge w3-border w3-border-white w3-padding-large w3-hover-teal">Profiles</button>
        <p class="w3-col l1"> </p>
    </div>
    </div>
    
    <?php 
        AdminCat("titles");
        AdminCat("runs");
        AdminCat("parties");
        AdminCat("difficulties");
        AdminCat("guilds");
        AdminCat("weapons");
    ?>
    
</div>


<?php } } ?>
</body>
</html>