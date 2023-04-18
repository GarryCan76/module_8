<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>webshop</title>
    <link rel="stylesheet" href="styles.css">
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
        <img style="width: 60px; height: 60px" src="imgs/artworks-000036218988-b4r0um-t500x500.png">
        <a href="#">Home</a>
        <a href="#">Products</a>
        <a href="#">Info</a>
        <a href="#">Contact</a>
    </div>
    <div></div>
</div>
<div id="main_div">
    <div id="filters">
        <div>
            <div style="margin: 10px">
                <h3>Ship classes</h3>
                <hr>
                <div class="dropdown">
                    <button class="dropbtn">Fighters</button>
                    <div class="dropdown-content">
                        <a href="#">Cobra Bomber Wing</a>
                        <a href="#">Claw Fighter Wing</a>
                        <a href="#">Dagger Bomber Wing</a>
                        <a href="#">Longbow Bomber Wing</a>
                        <a href="#">Trident Torpedo Bomber Wing</a>
                        <a href="#">Wasp Interceptor Drone Wing</a>
                        <a href="#">Xyphos Support Wing</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Frigates</button>
                    <div class="dropdown-content">
                        <a href="#">Afflictor</a>
                        <a href="#">Hyperion</a>
                        <a href="#">Mercury</a>
                        <a href="#">Omen</a>
                        <a href="#">Scarab</a>
                        <a href="#">Shade</a>
                        <a href="#">Tempest</a>
                        <a href="#">Wolf</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Destroyers</button>
                    <div class="dropdown-content">
                        <a href="#">Buffalo</a>
                        <a href="#">Harbinger</a>
                        <a href="#">Medusa</a>
                        <a href="#">Phantom</a>
                        <a href="#">Shrike</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Cruisers</button>
                    <div class="dropdown-content">
                        <a href="#">Apogee</a>
                        <a href="#">Aurora</a>
                        <a href="#">Doom</a>
                        <a href="#">Fury</a>
                        <a href="#">Revenant</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Capitals</button>
                    <div class="dropdown-content">
                        <a href="#">Astral</a>
                        <a href="#">Odyssey</a>
                        <a href="#">Paragon</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="products">
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
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO `products`(`id`, `name`, `price`,) VALUES ('','$productName','$price','$description')";
                $conn->exec($sql);
            }
            $stmt = $conn->prepare("SELECT `id`, `name`, `price`, `icon`, `ship_type` FROM `ships` WHERE 1");
            $stmt->execute();
            foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
                echo '<a href="detail/detail.php?productId='. $v['id'] .'">
            <div class="product_item">
                <img src="imgs/' . $v["icon"] . '">
                <h3>' . $v["name"] . '</h3>
                <div class="info_row">
                    <div>
                        <p>' . $v["ship_type"] . ' Ship</p>
                        <p>Price $' . $v["price"] . ',-</p>
                        <p>In stock</p>
                    </div>
                    <div class="add_cart">
                        <p>Add to cart</p>
                        <img class="cart_img" src="imgs/freadtatin34hm.png">
                    </div>
                </div>
            </div>
        </a>';
//                echo $v['name'] . " " . $v['price'] . "<br>" . $v['discription']  . "<br>" . "<br>";
                array_push($list, $v['name']);
            }
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

        $conn = null;
        ?>
    </div>
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