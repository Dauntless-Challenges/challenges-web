<?php

//ob_start();
session_start();


// If User is logged => redirect to tavern.php and announce it

 if ( !isset($_SESSION['user']) ) {
  $_SESSION['logged'] = 1;
  header("Location: tavern.php");
  echo "<meta http-equiv='refresh' content='0; url=tavern.php'>";
  exit;
 }

require_once 'inc.php';

html_head("Challenges Set");

navbar('bgimg_index_logged');

HelpButton();
pageFade();



$conn = connect_db();

	$sql = "SELECT * FROM challenges";
	$res = mysqli_query($conn, $sql);

mysqli_close($conn);


?>


<form method="post" class="w3-text-light-grey Oswald">

	<div class="w3-container" style="margin: 0 10%; margin-top: -2%; margin-bottom: 2%;">
		<a href="challenges-add.php" class="w3-btn w3-transparent w3-border w3-border-lime w3-text-lime w3-padding-large w3-round-xxlarge" style="font-size: 1.5vw;">Add Challenge</a>
		<span style="font-size: 2vw; vertical-align: middle;">&nbsp; or search &nbsp;</span>
		<input type="text" class="w3-right w3-input w3-transparent w3-text-light-grey w3-border-bottom" style="width: 75%; margin-top: 0.5%; font-size: 1.5vw" />
	</div>

	<hr style="margin: auto; width: 95%; margin-bottom: 2%; border: 0; height: 4px; background-image: linear-gradient(to right, rgba(255,255,255, 0), rgba(255,255,255, 0.75), rgba(255,255,255, 0));" />

	<div class="w3-row" style="margin-top: 10%; width: 90%; margin: auto;">
		<?php
		while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
			echo '
			<button class="w3-btn w3-col l3 brand-light-blue w3-round-xxlarge w3-center" style="margin: 0 2%; text-decoration: none;">
				<p class="PasseroOne" style="font-size: 1.5vw; margin-top: 1%; margin-bottom: 0">'. $row['name'] .'</p>
				<hr class="w3-border-light-grey" style="margin: auto; width: 90%; margin-bottom: 5%;" />
				<i style="font-size: 1vw; opacity: 0.5;">- '. $row['description'] .'</i>
			</button>
			';
		}
		?>
	</div>

</form>


</body>
</html>