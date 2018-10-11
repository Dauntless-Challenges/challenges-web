<?php

//ob_start();
session_start();

 if ( isset($_SESSION['user']) != "" ) {
  $_SESSION['logged'] = 1;
  header("Location: tavern.php");
  echo "<meta http-equiv='refresh' content='0; url=tavern.php'>";
  exit;
 }

require_once 'inc.php';

html_head("Dauntless Challenges");

navbar();


pageFade();


echo "<body class='bgimg_index'>";
Landing();


?>


</body>
</html>