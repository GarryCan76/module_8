<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>webshop</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>
<body>
<header>
    <div></div>
    <div id="login_div">
        <a href="#">Account</a>
        <a href="#">Login</a>
        <a href="#">Register</a>
    </div>

</header>
<div id="nav_bar">

    <div id="destinations">
        <img style="width: 60px; height: 60px" src="../imgs/artworks-000036218988-b4r0um-t500x500.png">
        <a href="../index.php">Home</a>
        <a href="#">Products</a>
        <a href="#">Info</a>
        <a href="#">Contact</a>
    </div>
    <div></div>
</div>
<div id="main_div">
    <div>
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


            ?>
            <h1><?php echo $v['name'] ?></h1>
        <h2><?php echo $v['ship_type'] ?></h2>
        <div id="product">
            <div id="product_image" style="background-image: url('../imgs/<?php echo $v['icon'] ?>'">

            </div>
            <div>
                <h2>$<?php echo $v['price'] ?>,-</h2>
                <h3><?php echo $v['stock'] ?> in stock</h3>
                <p>rather come by, you can visit one of our stations</p>
                <div>
                    <ul>
                        <li class="product_listitem">Delivery will be instant</li>
                        <li class="product_listitem">This product has no insurance </li>
                        <li class="product_listitem">This product cannot be returned</li>
                        <li class="product_listitem">Premium ships for a decent price</li>
                    </ul>
                </div>
                <a href="../fillinform/index.html">
                    <div id="cart">
                        <h2>Add to cart</h2>
                    </div>
                </a>
                <p><?php echo $v['discription'] ?></p>
            </div>
        </div>
        <div id="image_selector">
            <?php
            foreach(new RecursiveArrayIterator($pstmt->fetchAll()) as $k=>$p) {
            ?>
                <div>
                    <input type="image" src="../imgs/<?php echo $p['url']?>" onclick="change_image(this.src)" id="img_1">
                </div>
            <?php
                }
            ?>
        </div>
    </div>
    <?php
        } catch(PDOException $e) {
        }

        $conn = null;
        ?>

</div>
<div id="bottom">
    <div><h3>Payment</h3>
        <p>Pay quick and safe</p></div>
    <div><h3>Delivery Costs</h3>
        <p>All purchases will be taxed with 15%</p>
    </div>
    <div>
        <h3>Service</h3>
        <ul>
            <li><a href="#">Password recovery</a></li>
            <li><a href="#">Safe payment</a></li>
            <li><a href="#">Delivery</a></li>
            <li><a href="#">Cancel or return order</a></li>
        </ul>
    </div>
    <div>
        <h3>About us</h3>
        <ul>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact information</a></li>
            <li><a href="#">Terms and Conditions</a></li>
            <li><a href="#">Privacy</a></li>
        </ul>
    </div>

</div>
<footer>
    <p>Webstore by &copyJoe Biden</p>
</footer>
</body>
</html>