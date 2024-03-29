<?php
session_start();
// var_dump($_SESSION['cart']);
//session_destroy();
require "config.php";
require "models/db.php";
require "models/product.php";
require "models/protype.php";   
require "models/manufacture.php";
$product = new Product;
$protypes=new Protypes;
$getAllProtypes=$protypes->getAllProtypes();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Mobile Shopping</title>
    <link rel="icon" href="./images/logo.png" type="image/icon type">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/font-awesome.min.css" rel="stylesheet">
    <link href="public/css/prettyPhoto.css" rel="stylesheet">
    <link href="public/css/price-range.css" rel="stylesheet">
    <link href="public/css/animate.css" rel="stylesheet">
    <link href="public/css/main.css" rel="stylesheet">
    <link href="public/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="public/images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>
    <div class="header-bottom">
        <!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                        </button>
                        <div class="logo"> <a href="index.php"><img src="public/images/logo.png" alt="" /></a> </div>
                    </div>
                    <div class="mainmenu pull-right">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="index.php" class="active">Home</a></li>
                            <li class="dropdown"><a href="index.php">Products<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <?php foreach($getAllProtypes as $value){?>
                                    <li><a href="cate.php?type_id=<?= $value['Type_id']?>"><?= $value['Type_name']?></a></li>
                                    <?php }?>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="#">Blog List</a></li>
                                    <li><a href="#">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="cart.html?">Cart</a></li>
                        </ul>
                        <div class="search_box pull-right">
                            <form action="result.php" method="get">
                                <input type="text" placeholder="Search" name="key" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-bottom-->
    </header>
    <!--/header-->
    <section>
        <section id="cart_items">
            <div class="container">
                <h3>Your shopping cart</h3>
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Item</td>
                                <td class="description">Name</td>
                                <td class="price">Price</td>
                                <td class="quantity">Quantity</td>
                                <td class="total">Total</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total=0;
                            if(isset($_SESSION['cart'])){
                                foreach($_SESSION['cart'] as $value){
                                    $sum=$value['Price']*$value['quantity'];
                            ?>
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="public/images/<?= $value['Pro_image']?>" alt=""
                                            width=110></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="detail.php?id=?<?=$value['id']?>"><?= $value['Name']?></a></h4>
                                </td>
                                <td class="cart_price">
                                    <p><?=number_format($value['Price'],0)?> VND</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href="addCart.php?id=<?=$value['id']?>"> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity"  value="<?= $value['quantity']?>"
                                            autocomplete="off" size="2">
                                        <a class="cart_quantity_down" href="addCart.php?id=<?=$value['id']?>&action=tru"> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price"><?= number_format($sum,0)?> VND</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="del.php?id=<?=$value['id']?>"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <?php $total+=$sum; }
                                 }?>
                            <tr>
                                <td class="cart_product">
                                </td>
                                <td class="cart_description">
                                </td>
                                <td class="cart_price">
                                </td>
                                <td class="cart_quantity">
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price"><?= number_format($total)?> VND</p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post"
                        action="orderCart.php">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="number" class="form-control" placeholder="Phone number">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="message" id="message" class="form-control" rows="3"
                                placeholder="Your Message Here"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <a class="btn btn-default update" href="index.php">Continue Buying</a>
                            <a class="btn btn-default check_out" href="del.php">Delete All</a>
                            <button class="btn btn-primary pull-right" type="submit">Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!--/#cart_items-->
        <!--features_items-->
        </div>
        </div>
    </section>
    <footer id="footer">
        <!--Footer-->

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank"
                                href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>

</html>