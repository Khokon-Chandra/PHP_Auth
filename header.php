<!DOCTYPE html>
<html>
<head>
	<title>Email form</title>
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/form.css?ver=1.0.2">
</head>
<body>



	<div class="form-wrapper">

		<div class="layer-one"></div>
		<div class="layer-two"></div>
		<div class="layer-three">
			
			<div class="formTitle">
				<h3 ><?= $file ?></h3>
			</div>

				<?php if(isset($alert) && !empty($alert)){
					echo "<p class='alert'>".$alert."</p>";
				} ?>