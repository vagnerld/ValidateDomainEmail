<?php 
	$email = $_REQUEST['email'];
?>
<head>
	<meta charset="UTF-8">
</head>
<body style="text-align:center;">
	<br /><br /><br /><br /><br />
	<form method="post">
		<input type="text" name="email" value="<?php echo $email; ?>" placeholder="E-mail">
		<input type="submit">
	</form>

	<?php 
		require_once "./EmailChecker.php"; // lib 
		$e = new ValidateDomainEmail();
		$e->precision = 70;

		echo "<br />Voce quis dizer: <b>".$e->check($email)."</b>? <br /><br /><br />";
		echo $e->print_table($email)."<br /><br /><br />";
		print_r($e->array_table($email));
	?>
</body>