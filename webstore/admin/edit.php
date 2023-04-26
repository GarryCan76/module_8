<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>webshop</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
<header>
    <div></div>
    <div id="login_div">
        <a href="#">Account</a>
    </div>

</header>
<div id="nav_bar">
    <div id="destinations">
        <img style="width: 60px; height: 60px" src="../imgs/artworks-000036218988-b4r0um-t500x500.png">
        <a href="../index.php">Home</a>
        <a href="../index.php">Products</a>
        <a href="#">Info</a>
        <a href="#">Contact</a>
    </div>
    <div></div>
</div>
<div id="main_div">
    <a href="admin.php">or create new product</a>
    <script>
        function updatePreview(){
            document.getElementById('productName').innerText = document.getElementsByName('productName')[0].value;
            document.getElementById('price').innerText = "price $" + document.getElementsByName('price')[0].value + ",-";
            document.getElementById('stock').innerText = "stock " + document.getElementsByName('stock')[0].value;
            document.getElementById("icon").src = "../imgs/" + document.getElementsByName('icon')[0].value + "";
        }
        function updateShipType(type){
            document.getElementById('shipType').innerText = document.getElementsByName('shipType')[type].value + " class";
        }
    </script>
</div>
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
        $icon = $_GET["icon"];
        $shipType = $_GET["shipType"];
        $stock = $_GET["stock"];
        echo '<script>console.log("oke")</script>';
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO `ships`(`id`, `name`, `price`, `discription`, `icon`, `ship_type`, stock) VALUES ('','$productName','$price','$description','$icon','$shipType','$stock')";
        $conn->exec($sql);
    }
    $list=array();
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $stmt = $conn->prepare("SELECT `id`, `name`, `price`, `icon`, `ship_type` FROM `ships` WHERE 1");
    $stmt->execute();
    foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        ?>
        <a href="edit_data.php?productId=<?php echo $v['id'] ?>">
            <div class="product_item">
                <img src="../imgs/<?php echo $v['icon'] ?>">
                <h3><?php echo $v['name'] ?></h3>
                <div class="info_row">
                    <div>
                        <p><?php echo $v['ship_type'] ?> Class</p>
                        <p>Price $<?php echo $v['price'] ?>,-</p>
                        <p>In stock</p>
                    </div>
                    <div class="add_cart">
                        <p>Add to cart</p>
                        <img class="cart_img" src="../imgs/freadtatin34hm.png">
                    </div>
                </div>
            </div>
        </a>
<?php
//                echo $v['name'] . " " . $v['price'] . "<br>" . $v['discription']  . "<br>" . "<br>";
        array_push($list, $v['name']);
    }

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
<div id="bottom">
</div>
<footer>
    <p>Webstore by &copyJoe Biden</p>
</footer>
</body>
</html>