<!-- 


* All html data implement here in separete storage location


 -->


<?php ob_start(); ?>
<!-- login form -->

<form method="POST" action="<?= BASE_URL.'login'?>">
	<div class="name">
		<i class="fa fa-envelope"></i>
		<input type="email" name="email" placeholder="E-Mail Address" value="<?= $values['email']??'' ?>">
		<?php if(isset($errors["email"])){echo "<p class='field_error'>".$errors["email"]."</p>";} ?>
	</div>

	<div class="password">
		<i class="fa fa-lock"></i>
		<input type="password" name="password" placeholder="password" value="<?= $values['password']??'' ?>">
		<?php if(isset($errors["password"])){echo "<p class='field_error'>".$errors["password"]."</p>";} ?>
	</div>
	<input type="submit" name="login" value="log in">
	<a class="ml-4" href="<?= BASE_URL ?>registration">Register</a>
	<a class="ml-4" href="<?= BASE_URL ?>email">Lost your password</a>
</form>

<?php $login = ob_get_clean(); ?>






<!-- ==============Registration Form Start============== -->



<?php ob_start(); ?>
<!-- Registration form -->
<form method="POST" action="<?= BASE_URL.'registration/' ?>">
	<div class="name">
		<i class="fa fa-user"></i>
		<input type="text" name="name" placeholder="name" value="<?= $values['name']??'' ?>">
		<?php if(isset($errors["name"])){echo "<p class='field_error'>".$errors["name"]."</p>";} ?>
	</div>
	<div class="email">
		<i class="fa fa-envelope"></i>
		<input type="email" name="email" placeholder="email" value="<?= $values['email']??'' ?>">
		<?php if(isset($errors["email"])){echo "<p class='field_error'>".$errors["email"]."</p>";} ?>
	</div>
	<div class="password">
		<i class="fa fa-lock"></i>
		<input type="password" name="password" placeholder="password" value="<?= $values['password']??'' ?>">
		<?php if(isset($errors["password"])){echo "<p class='field_error'>".$errors["password"]."</p>";} ?>
	</div>
	<input type="submit" name="register" value="Register">
	<a class="ml-4" href="<?= BASE_URL ?>login">Log In</a>
	<a class="ml-4" href="<?= BASE_URL ?>email">Lost your password</a>
</form>

<?php $registration = ob_get_clean(); ?>


<!-- ==============Registration Form end============== -->





<?php ob_start(); ?>

<!-- Email send form -->


<form method="POST" action="<?= BASE_URL.'email' ?>">
	<div class="email">
		<i class="fa fa-envelope"></i>
		<input type="email" name="email" placeholder="E-Mail" value="<?= $values['email']??'' ?>">
		<?php if(isset($errors["email"])){echo "<p class='field_error'>".$errors["email"]."</p>";} ?>
	</div>
	<input type="submit" name="sendMail" value="send">
	<a class="ml-4" href="<?= BASE_URL ?>registration">Register</a>
	<a class="ml-4" href="<?= BASE_URL ?>login">Log In</a>
</form>


<?php $email = ob_get_clean(); ?>




<?php ob_start(); ?>


<!-- Reset form form -->

<form method="POST" action="<?= BASE_URL.'resetpassword' ?>">
	<div class="password" style="margin-bottom: 10px;">
		<i class="fa fa-lock"></i>
		<input type="password" name="password" placeholder="New password" value="<?= $values['password']??'' ?>">
		<?php if(isset($errors["password"])){echo "<p class='field_error'>".$errors["password"]."</p>";} ?>
	</div>
	<div class="password">
		<i class="fa fa-lock"></i>
		<input type="password" name="confirm_password" placeholder="confirm password" value="<?= $values['confirm_password']??'' ?>">
		<?php if(isset($errors["confirm_password"])){echo "<p class='field_error'>".$errors["confirm_password"]."</p>";} ?>
	</div>
	<input type="submit" name="savePassword" value="Save Password">
	<a class="ml-4 float-right" href="<?= BASE_URL ?>login">Log In</a>
</form>

<?php $resetPassword = ob_get_clean(); ?>






<?php ob_start(); ?>

<!-- Vaification code form -->

<?php if(isset($message)){
	echo "<p class='message'>".$message."</p>";
} ?>
<form method="POST" action="<?= BASE_URL.'verification' ?>">
	<div class="email">
		<i class="fa fa-lock"></i>
		<input type="text" name="code" placeholder="Confirmation Code" value="<?= $values['code']??'' ?>">
		<?php if(isset($errors["code"])){echo "<p class='field_error'>".$errors["code"]."</p>";} ?>
	</div>
	<input type="submit" name="verify" value="Verify">
	<input type="submit" name="resend" value="Resend code" style="background: #d8d8d8;color:#666; float: right;">
	
</form>

<?php $verification = ob_get_clean(); ?>