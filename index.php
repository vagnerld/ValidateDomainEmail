<?php 
	$email = $_REQUEST['email'];
?>
<head>
	<meta charset="UTF-8">
</head>
<body style="text-align:center;">
	<br /><br /><br /><br /><br />
	<form method="post">
		<input type="email" name="email" value="<?php echo $email; ?>" placeholder="E-mail" required>
		<input type="submit">
	</form>

	<?php
		require_once "./EmailChecker.php";
		$e = new ValidateDomainEmail();

		echo "Você quis dizer: <b>".$e->check($email)."</b>?";
		echo "<br /><br /><br />";
		echo $e->print_table($email);
	?>
</body>