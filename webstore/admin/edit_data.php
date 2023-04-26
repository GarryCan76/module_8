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
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "module_8";


try {
$list=array();
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$stmt = $conn->prepare("SELECT `id`, `name`, `price`, `icon`, `ship_type`, `stock`, `discription` FROM `ships` WHERE id=".$_GET['productId'] ."");
$stmt->execute();
foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
}
$pstmt = $conn->prepare("SELECT `id`, `product_id`, `url` FROM `photos` WHERE product_id=".$_GET['productId'] ."");
$pstmt->execute();
$_GET["shipType"] = $v['ship_type'];


?>
<div id="main_div">
    <a href="edit.php">or edit products</a>
    <div class="product">
        <a href="#">
            <div class="product_item">
                <img id="icon" src="../imgs/<?php echo $v['icon'] ?>">
                <h3 id="productName"><?php echo $v['name'] ?></h3>
                <div class="info_row">
                    <div>
                        <p id="shipType"><?php echo $v['ship_type'] ?></p>
                        <p id="price">price $<?php echo $v['price'] ?>,-</p>
                        <p id="stock">stock <?php echo $v['stock'] ?></p>
                    </div>
                    <div class="add_cart">
                        <p>Add to cart</p>
                        <img class="cart_img" src="../imgs/freadtatin34hm.png">
                    </div>
                </div>
            </div>
        </a>
        <form action="edit_data.php?productId=<?php echo $v['id'] ?>" method="get">
            <div id="productEditor">
                <div id="productFillIn">
                    <input type="hidden" name="productId" value="<?php echo $v['id'] ?>">
                    <input type="text" name="productName" value="<?php echo $v['name'] ?>" placeholder="Product name" oninput="updatePreview()" required>
                    <input type="number" name="price" placeholder="Price" value="<?php echo $v['price'] ?>" oninput="updatePreview()" required>
                    <input type="text" name="icon" placeholder="Icon"  oninput="updatePreview()" value="<?php echo $v['icon'] ?>" required>
                    <input type="number" name="stock" placeholder="Stock" value="<?php echo $v['stock'] ?>" required oninput="updatePreview()">
                </div>
                <div id="shipTypeSelect">
                    <p>Ship Class</p>
                    <div><input type="radio" id="Fighters" name="shipType" value="Fighter" oninput="updateShipType(0)">
                        <label for="Fighters">Fighters</label></div>
                    <div><input type="radio" id="Frigates" name="shipType" value="Frigate" oninput="updateShipType(1)">
                        <label for="Frigates">Frigates</label></div>
                    <div><input type="radio" id="Destroyers" name="shipType" value="Destroyer" oninput="updateShipType(2)">
                        <label for="Destroyers">Destroyers</label></div>
                    <div><input type="radio" id="Cruisers" name="shipType" value="Cruiser" oninput="updateShipType(3)">
                        <label for="Cruisers">Cruisers</label></div>
                    <div><input type="radio" id="Capitals" name="shipType" value="Capital" oninput="updateShipType(4)">
                        <label for="Capitals">Capitals</label></div>
                </div>
            </div>
            <input type="text" id="description" name="description" value="<?php echo $v['discription'] ?>" placeholder="Description" oninput="updatePreview()" size="25" required>
            <input type="submit" name="submit" oninput="updatePreview()">
        </form>
    </div>
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
} catch(PDOException $e) {
}

$conn = null;
?>
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
        ?>

<?php
        $productName = $_GET["productName"];
        $price = $_GET["price"];
        $description = $_GET["description"];
        $icon = $_GET["icon"];
        $shipType = $_GET["shipType"];
        $stock = $_GET["stock"];
        echo '<script>console.log("oke")</script>';
        $sql = "UPDATE ships SET name='$productName' WHERE id=".$_GET['productId'] ."";
        $stmt = $conn->prepare($sql);

        // execute the query
        $stmt->execute();
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