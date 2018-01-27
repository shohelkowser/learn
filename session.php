<?php
session_start();
echo session_name();
if (isset($_POST['add'])) {
    $pname = $_POST['pname'];
    $quantity = $_POST['quantity'];
    $code = $_POST['code'];
    $price = $_POST['price'];

    // if(!$_SESSION["product"]['id']){
    //     $_SESSION["product"]['id'] = 0;
    // }else{
    //     $_SESSION["product"]['id']++;
    // }
    if (!empty($_POST['quantity'])) {
        $items = array(
            "code" => $code,
            "pname" => $pname,
            "quantity" => $quantity,
            "code" => $code,
            "price" => $price,
        );
        echo "item------";
        print_r($items);
        echo "<br>";

    }

    if (isset($_SESSION['product'])) {

        if (isset($_SESSION['product'][$code])) {

            $_SESSION['product'][$code]["quantity"] = $_SESSION['product'][$code]["quantity"] + $quantity;
            $_SESSION['product'][$code]["price"] = $_SESSION['product'][$code]["quantity"] * $price;
        } else {
            echo "<br>added more....";
            $_SESSION['product'][$code] = $items;
        }

    } else {
        $_SESSION['product'] = array();
        $_SESSION['product'][$code] = $items;
        echo "<br> Add <br>";
    }

    // print_r($_SESSION["product"]);

    // $_SESSION["product"][0] = array(
    //      'Name' => $_SESSION["pname"],
    //      'Quantity' => $_SESSION["quantity"],
    //      'Code' => $_SESSION["code"],
    //      'Price' => $_SESSION["price"]
    //     );

    // echo $_SESSION["product"][0]['Name'];
    var_dump($_SESSION['product']);
}
// session_unset();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>session test</title>
</head>
<body>
	<ul style="border: 1px solid red;">
	<li style="border: 1px solid red; width:200px; float: left;">
		<form method="post" action="session.php" style="border: 1px solid red; width:200px">
		pname: <input type="text" name="pname" value="product-1" size="2"><br><br>
		quantity: <input type="text" name="quantity" value="1" size="2"><br><br>
		code:<input type="text" name="code" value="1of3" size="2"><br><br>
		price:<input type="text" name="price" value="200" size="2"><br><br>
		<input type="submit" name='add' value="Add to cart"><br><br>
		</form><br><br></li>


	<li style="border: 1px solid red; width:200px; float: left;">
		<form method="post" action="session.php" style="border: 1px solid red; width:200px">
		pname: <input type="text" name="pname" value="product-2" size="2"><br><br>
		quantity: <input type="text" name="quantity" value="1" size="2"><br><br>
		code:<input type="text" name="code" value="2of3" size="2"><br><br>
		price:<input type="text" name="price" value="400" size="2"><br><br>
		<input type="submit" name='add' value="Add to cart"><br><br>
		</form><br><br></li>



	<li style="border: 1px solid red; width:200px; float: left;">
		<form method="post" action="session.php" style="border: 1px solid red; width:200px">
		pname: <input type="text" name="pname" value="product-3" size="2"><br><br>
		quantity: <input type="text" name="quantity" value="1" size="2"><br><br>
		code:<input type="text" name="code" value="3of3" size="2"><br><br>
		price:<input type="text" name="price" value="600" size="2"><br><br>
		<input type="submit" name='add' value="Add to cart"><br><br>
		</form><br><br>
	</li>
	</ul>


	<br><br><br><br><br>

	<table style="border: 1px solid red; width:200px">
		<th></th>
		<tr style="border: 1px solid red; width:200px">
			<td style="border: 1px solid red;">pname</td>
			<td style="border: 1px solid red;">quantity</td>
			<td style="border: 1px solid red;">code</td>
			<td style="border: 1px solid red;">price</td>
			<td style="border: 1px solid red;">remove</td>
		</tr>



		<?php
$total = 0;
if (isset($_SESSION['product'])) {
    $total = 0;
    foreach ($_SESSION['product'] as $key) {
        echo '<tr style="border: 1px solid red; width:200px">';
        echo '<td>' . $key['pname'] . '</td>';
        echo '<td>' . $key['quantity'] . '</td>';
        echo '<td>' . $key['code'] . '</td>';
        echo '<td>' . $key['price'] . '</td>';
        echo '<td><a href="?del=' . $key['code'] . '">Remove</a></td>';
        echo '<tr>';

        $total = $total + $key['price'];
    }

}

?>
		</tr>
		<tr><td colspan="4" style="border: 1px solid red; width:200px">Total = <?php echo $total; ?></td>
		<td><a href='?buy=Shohel'>Buy</a></td></tr>



	</table>
<?php if (isset($_GET['del'])) {
    unset($_SESSION["product"][$_GET['del']]);

}

$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'ib';
$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

if (isset($_GET['buy'])) {
    $nam = $_GET['buy'];

    foreach ($_SESSION['product'] as $key) {
        $pname = $key['pname'];
        $quantity = $key['quantity'];
        $code = $key['code'];
        $price = $key['price'];
        echo '<br>';
        $conn->query("INSERT INTO `ssss`
		(`pname`, `quantity`, `code`, `price`, `name`) VALUES
		('$pname', '$quantity', '$code', '$price', '$nam')");
        echo $pname . '<br>' . $quantity . '<br>' . $code . '<br>' . $price . '<br>' . $nam . '<br><br>';
    }

}

?>

</body>
</html>

<?php
// header("Location: session.php");
?>

