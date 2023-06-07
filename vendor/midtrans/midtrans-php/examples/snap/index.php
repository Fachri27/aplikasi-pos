<?php
  $base = $_SERVER['REQUEST_URI'];
?>

<form method="post">
	<label>Buah</label>
	<input type="text" name="buah">
	<br><br>
	<label>Harga</label>
	<input type="text" name="harga">
	<br><br>
	<button type="submit" name="submit">save</button>
</form>
<?php  

if(isset($_POST['submit'])){
	$buah = $_POST['buah'];
	$harga = $_POST['harga'];
	$Total = 0;
	$subtotal = $harga + $Total;

	echo "
		<h3>Selected Items:</h3>
		<ul>
		    <li>$buah x $harga</li>
		</ul>

		<h4>Total: $subtotal</h4>
	";
}

?>

<form action="<?php echo $base ?>checkout-process-simple-version.php" method="POST">
    <input type="hidden" name="amount" value="94000"/>
    <input type="submit" value="Confirm">
</form>
