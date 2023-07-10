<!DOCTYPE html>
<html lang="en">
<head>
	<!--character encoding-->
	<meta charset="utf-8">
	<title>Express Services TN</title>
	<!--icon de la fenetre-->
	<link rel="icon" href="../../photos/Flag_of_Tunisia.png">
	<!--metadata-->
	<meta name="description" content="PaimenetTN,Radar,Admin">
	<meta name="keywords" content="PaimenetTN,Radar,Admin">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--CSS file for layout-->
	<link rel="stylesheet" href="../../css/index.css">
</head>
<body>

	<header class="titre">
		<h1 style="font-family: initial;color:white;">Tax Administration TN</h1>
    	<form name="void" method="post" action="../../php/void.php">
        	<button class="logout" type="submit">Log out</button>
    	</form>
	</header>
	<div style="position: -webkit-sticky;position:sticky;margin-top:-4em;top:2em;margin-left: 85%;font-size: 18px;border:solid 2px lightsalmon;">
		<h3 style="color:red;font-family: initial;margin-top:0;">Attention:</h3>
		<p style="font-family: initial;color:white;display: flex;justify-content: center;align-items:center;">
			This is a sensitive space, Strict legal action will be taken for any hacking attempt!
		</p>
	</div>
	<section class="main">
		<span class="butmain1">
			<a href="viewAdd.php">
				<button>
					<img src="../../photos/addpenal.jpg" width="400" height="350"><br>Add Penalty
				</button>
			</a>
		</span>
	</section>
	<?php
    	require_once "footer.php";
    ?>
</body>
</html>
