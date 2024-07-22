<?php 
    session_start();
    require 'function.php';
    date_default_timezone_set("Asia/Jakarta");

    //active-user-session
    if (isset($_SESSION['login'])) {
        $user_id = $_SESSION['user_id'];
    }

    //login=false
    if (!isset($_SESSION['login'])) {
        echo "
            <script>
                document.location.href = 'index.php';
            </script>
        ";
    }

    //total-price
    $totalprice = $_SESSION['totalprice'];

    if ($totalprice == 0){
        header("Location: cart.php");
        exit;
    }

    //fetch-sql
    $produk = query("SELECT * FROM cart WHERE buyer_id = '$user_id' ORDER BY cart_id DESC");

    //pay-button
    if(isset($_POST['pay'])){
        //pay-success
        foreach ($produk as $prdk) {
            global $conn;

            $product_id = $prdk["product_id"];
            $seller_id = $prdk["seller_id"];
            $buyer_id = $prdk["buyer_id"];
            $name = $prdk["name"];
            $price = $prdk["price"];
            $picture = $prdk["picture"];
            $date = date("d-m-Y");
            $hour = date("H:i");

            //insert to databases
            
            $query = "INSERT INTO riwayat_order 
                        VALUES ('', '$product_id', '$seller_id', '$buyer_id', '$name', '$price', '$picture', '$date', '$hour')
                      ";

            if (mysqli_affected_rows($conn) > 0) {
                deletecart($product_id);
            }

            mysqli_query($conn, $query);
        }
        echo "
            <script>
                alert('Payment Success');
                document.location.href = 'cart.php'; 
            </script>
        ";
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Jual.in</title>   
    <link rel="stylesheet" type="text/css" href="css/style_checkout.css?v=<?php echo time(); ?>">

    <!--fontawesome-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!--fontstyle-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 

</head>
<body>
    <div class="container">
        <div class="box">
            <h3 class="price">
                <span>Total</span>
                <span>Rp <?= number_format($totalprice); ?></span>
            </h3>
        </div>


        <form action="" method="post" class="box">
            <div class="row">
                <div class="col">
                    <h4 class="title">billing address</h4>

                    <div class="inputBox">
                        <span>full name :</span>
                        <input type="text" required>
                    </div>
                    <div class="inputBox">
                        <span>email :</span>
                        <input type="email" placeholder="example@example.com" required>
                    </div>
                    <div class="inputBox">
                        <span>address :</span>
                        <input type="text" placeholder="room - street - locality" required>
                    </div>
                    <div class="inputBox">
                        <span>city :</span>
                        <input type="text" required>
                    </div>

                    <div class="flex">
                        <div class="inputBox">
                            <span>state :</span>
                            <input type="text" placeholder="indonesia" required>
                        </div>
                        <div class="inputBox">
                            <span>zip code :</span>
                            <input type="text" placeholder="123 456" required pattern="[0-9]+">
                        </div>
                    </div>
                </div>

                <div class="col">
                    <h4 class="title">payment</h4>

                    <div class="inputBox">
                        <span>cards accepted :</span>
                        <img src="img/card_img.png" alt="">
                    </div>
                    <div class="inputBox">
                        <span>name on card :</span>
                        <input type="text" required>
                    </div>
                    <div class="inputBox">
                        <span>credit card number :</span>
                        <input type="text" placeholder="1111-2222-3333-4444" required pattern="[0-9]+">
                    </div>
                    <div class="inputBox">
                        <span>exp month :</span>
                        <input type="text" placeholder="january" required>
                    </div>

                    <div class="flex">
                        <div class="inputBox">
                            <span>exp year :</span>
                            <input type="number" placeholder="2022" required>
                        </div>
                        <div class="inputBox">
                            <span>CVV :</span>
                            <input type="text" placeholder="1234" required pattern="[0-9]+">
                        </div>
                    </div>
                </div>    
            </div>

            <button type="submit" class="pay-btn" name="pay" onclick="return confirm('Are you sure?')">Confirm Payment</button>
        </form>
    </div>    
    
</body>
</html>