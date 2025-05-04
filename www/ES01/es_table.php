<!-- http://204.216.213.176/inf3php/ES01/es_table.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Esempio ciclo for</title>
</head>
<body>
    <h1>Generazione dinamica di una tabella html</h1>

    <?php
	echo '<table border="1">';
	for($i=0; $i<10; $i++) {
		echo "<tr><td>$i</td></tr>";	
	}
	echo "</table>";
	?>

</body>
</html>  