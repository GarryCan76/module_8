
<form action="main.php" method="get">
    <input type="text" name="productName" placeholder="Product name" required>
    <input type="number" name="price" placeholder="Price" required>
    <input type="text" name="description" placeholder="Description" required>
    <input type="submit" name="submit">
</form>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "module_8";


try {
    $list=array();
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    if(isset($_GET['submit']))
    {
        $productName = $_GET["productName"];
        $price = $_GET["price"];
        $description = $_GET["description"];
        echo '<script>console.log("oke")</script>';
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO `products`(`id`, `name`, `price`, `discription`) VALUES ('','$productName','$price','$description')";
        $conn->exec($sql);
    }
    $stmt = $conn->prepare("SELECT `id`, `name`, `price`, `discription` FROM `products` WHERE 1");
    $stmt->execute();
    echo "<p>Alle data van alle records uit de webshopproducten tabel toont.</p>";
    foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        echo $v['name'] . " " . $v['price'] . "<br>" . $v['discription']  . "<br>" . "<br>";
        array_push($list, $v['name']);
    }

    echo "<p> Alleen de titels van de eerste 5 records uit de webshopproducten toont in alfabetische volgorde.</p>";
    $listSort = $list;
    sort($listSort);
    foreach ($listSort as &$value) {
        echo $value . "<br>";
    }
    echo "<br> <p>Alleen de ids toont van de webshopproducten waarvan de waarde kleiner is dan 5.</p>";
    $stmt2 = $conn->prepare("SELECT `id`, `name`, `price`, `discription` FROM `products` WHERE 1");
    $stmt2->execute();
    foreach(new RecursiveArrayIterator($stmt2->fetchAll()) as $k=>$v) {
        if ($v['id'] < 10){
            echo $v['id'] . " " . $v['name'] . " " . $v['price'] . "<br>" . $v['discription']  . "<br>" . "<br>";
        }
    }
    echo "<br> <p>Toont hoeveel webshopproducten er totaal zijn opgenomen.</p>";
    echo sizeof($list);
    echo "<br> <p>De titel toont van het webshopproduct dat als laatste is toegevoegd</p>";
    $index = 1;
    foreach ($list as &$val) {
        if ($index == sizeof($list)){
            echo $val . "<br>";
        }
        $index++;
    }

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>