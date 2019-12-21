<?php
    session_start();
    include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Jaidee Shop</title>
</head>
<body>
<nav class="navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Markus Shop</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="index.php?menu=all">หน้าหลัก</a></li>
                <li><a href="#">เกี่ยวกับ</a></li>
                <li><a href="newpro.php">เพิ่มสินค้า</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-left">
                <li  class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        สินค้าของเรา <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="showproduct.php?category=1">Computer</a></li>
                        <li><a href="showproduct.php?category=2">Food</a></li>
                        <li><a href="showproduct.php?category=3">Clothes</a></li>
                    </ul>
                </li>
                <li><a href="searchproduct.php">ค้นหา</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if(isset($_SESSION['id'])){
                ?>
                <li  class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="glyphicon glyphicon-user"></i>
                        <?php echo $_SESSION['name'];?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">โปรไฟล์</a></li>
                        <li><a href="#">รายการสั่งซื้อ</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">ออกจากระบบ</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" >
                        <i class="glyphicon glyphicon-shopping-cart"></i> (0)
                    </a>
                </li>
                <?php
                    } 
                    else{
                ?>
                <li><a href="login.php">เข้าสู่ระบบ</a></li>
                <li><a href="register.php">สมัครสมาชิก</a></li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container" style="margin-top:10px">
    <div class="jumbotron">
        <h1>Markus Shop</h1>
        <p class="leed">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur reiciendis at facere modi! Sit adipisci id dolore qui voluptatum nulla eius cupiditate ipsum exercitationem! Consequatur at asperiores perferendis temporibus ipsa.</p>
    </div>
</div>
        <?php
            
        ?>
<div class="container">
    <div class="row">
        <?php
        $sql = "SELECT * FROM product ORDER BY id";
        //include($page);
        $result = $conn->query($sql);
        if(!$result){
            echo "Error During Retrival";
        }
        else{
            //ดึงข้อมูล
            while($prd=$result->fetch_object()){
                $prd->id; //$prd["id]
        ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="thumbnail">
                    <a href="productdetail.php?pid=<?php echo $prd->id;?>">
                        <img src="image/<?php echo $prd->picture;?>" alt="">
                    </a>
                    <div class="caption">
                    <h3><?php echo $prd->name;?></h3>
                    <p><?php echo $prd->description;?></p>
                    <p><Strong>Price: </Strong><?php echo $prd->price;?><Strong> Bath</Strong></p>
                    <p><Strong>Qty: </Strong><?php echo $prd->unitInStock;?></p>
                    <p>
                        <a href="#" class="btn btn-info">Add To Basket</a>
                        <a href="editproduct.php?pid=<?php echo $prd->id?>" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a href="deleteproduct.php?pid=<?php echo $prd->id?>" class="btn btn-danger linkDelete"><i class="glyphicon glyphicon-trash"></i></a>
                    </p>
                    </div>
                </div>
            </div>
            <?php
                }
            }
        ?>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".linkDelete").click(function(){
            if(confirm("confirm delete?")){
                return true;
            }else{
                return false;
            }

            return confirm("confirm delete")
        });
    });
</script>
</body>
</html>