<?php 
	$email = $_REQUEST['email'];
?>
<body style="text-align:center;">
	<br /><br /><br /><br /><br />
	<form method="post">
		<input type="text" name="email" value="<?php echo $email; ?>">
		<input type="submit">
	</form>

	<?php 
		require_once "./EmailChecker.php"; // lib 
		$e = new ValidateDomainEmail();
		echo "<br />Voce quis dizer: <b>".$e->check($email)."</b>? <br /><br /><br />";

		$e->print_table($email);
	?>
</body>