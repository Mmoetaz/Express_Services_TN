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
	<link rel="stylesheet" href="../../css/paiment.css">
</head>
<body>

    <?php
    	require_once $ROOT . $DS . "view".$DS."header.php";
    ?>
	<!--Titre de l'app-->
	<header class="titre">
		<h1 style="font-family: initial;color:white;">Tax Administration TN</h1>
	</header>
	<div style="position: -webkit-sticky;position:sticky;margin-top:-4em;top:2em;margin-left: 85%;font-size: 18px;border:solid 2px lightsalmon;">
		<h3 style="color:red;font-family: initial;margin-top:0;">Attention:</h3>
		<p style="font-family: initial;color:white;display: flex;justify-content: center;align-items:center;">
			This is a sensitive space, Strict legal action will be taken for any hacking attempt!
		</p>
	</div>
	<section class="containerin">
		<form class="myform" name="login" method="post" action="index.php?controller=Employe">
			<center>
				<table>
					<tr>
						<td><label style="color:lightsalmon;"for="id">ID:</label></td> 
						<td><input type="text" name="id" id="id" placeholder="00000000" autofocus required /></td>
					</tr>
					<tr>
						<td><label style="color:lightsalmon;"for="code">Code:</label></td> 
						<td><input type="Password" name="code" id="code" placeholder="ej:123456" required/></td>
					</tr>
				</table>
			</center>
			<div class="button">
				<button type="submit" name="loginbutton" class="but">Log In</button>
			</div>
		</form>
		<!--Tunisian flag-->
	</section>
	<?php
    	require_once $ROOT . $DS . "view".$DS."footer.php";
    ?>
</body>
</html>