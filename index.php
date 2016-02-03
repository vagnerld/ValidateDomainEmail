<?php


require_once "./EmailChecker.php"; // lib 
$e = new ValidateDomainEmail();


$email = $_REQUEST['email'];

echo $email."<br /><br />";

echo "<br />Voce quis dizer: <b>".$e->check($email)."?";




?>

<br /><br /><br /><br /><br />
<form>
<input type="text" name="email" value="<?php echo $email; ?>">
<input type="submit">
</form>
