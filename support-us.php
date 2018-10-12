<?php

//ob_start();
session_start();

require_once 'inc.php';

html_head("Support Us");

navbar('bgimg_support');
HelpButton();


pageFade();


?>

<div class="w3-container w3-text-dark-grey Oswald" style="margin-top: -2%;">
    <div id="DonateBox">
    <p class="w3-xxxlarge w3-text-white w3-center w3-border w3-border-white" id="DonateTitle">Want to make Gnashers satisfied and happy??</p>
    
    <div class="w3-center" style="margin-top: 2%;">
        <p class="w3-text-white w3-xxlarge" id="DonateText">Get them some money for food and they'll be so grateful...</p>
        
        <?php //echo SupportUs(); ?>
        
        <!-- This <p> is Donor(); related -->
        <!-- <p class="w3-text-white w3-xlarge" id="DonateText"><img src="images/crown.png" width="32px;" alt="Crown" /> &nbsp;Any donated amount will give access to the <span onclick="ChallengeProfile();" style="text-decoration: none; font-weight: bold; cursor: pointer">Challenger Profile</span>&nbsp; <img src="images/crown.png" width="32px;" alt="Crown" /></p> -->
    
        <?php echo Donate(); ?>
    </div>
    </div>
    
		<!-- This Function is <p id="DonateText"> related -->
        <?php //echo Donor(); ?>
</div>

</body>
</html>