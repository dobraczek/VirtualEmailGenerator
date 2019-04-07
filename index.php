<?php

/**
 * User Virtual Generator
 * @author Martin Dobry
 * @link http://webscript.cz
 * @version 1.0
 */

include "UserVirtualGenerator.php";
$UserGenerator = new VirtualUserGenerator\UserGenerator();
$User = $UserGenerator->getUser();


?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<title>Virtual User Generator</title>
	
	<meta content="" name="keywords">
	<meta content="" name="author">
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>

    <h1>Virtual User Generator</h1>
    
    <div class="personBox">
    	<img class="portrait" src="<?= $User->avatar ?>">
    	<p><strong><?= $User->name ?> (age <?= $User->age ?>)</b>, <?= $User->country ?></strong><br />
    	<a href="mailto:<?= $User->email ?>"><?= $User->email ?></a></p>
    </div>

</body>
</html>