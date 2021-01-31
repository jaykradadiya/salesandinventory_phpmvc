<!DOCTYPE html>
<?php
    $action= $this->getAction();
    $this->auth->checkLogged();
    // echo $action;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link href="<?= URIROOT."css/Style.css";?>" rel="stylesheet" media="all">
    <link href="<?= URIROOT."css/view_css.css";?>" rel="stylesheet" media="all">

    <title><?php echo (isset($this->page_title) ? $this->page_title : "welcome to my site");?></title>
</head>
<body>
<header class="upnav">
        <img src="<?= URIROOT."pic/logo.png";?>" alt="logo" class="logo">
        <!-- <a href="logout.php"><button class="cta">logout</button></a> -->
    </header>
    <!-- <header class="sidenav"> -->
        <div class="sidenav">
        <nav class="sidebar">
            <div class="text">
                <?php  echo Session::get("empEmail");?>
            </div>
            <ul class="sidelist">
                <li class="sidelistli list1 <?php if($action=='product'){echo 'curr';}?>">
                    <a href="<?= URIROOT."product"?>" class="list1"> Products</a>
                </li> 
                <li class="sidelistli list2 <?php if($action=='category'){echo 'curr';}?>">
                    <a href="<?= URIROOT."category"?>" class="list2">Category</a>
                </li>
                <li class="sidelistli list3 <?php if($action=='supplier'){echo 'curr';}?>">
                    <a href="<?= URIROOT."supplier"?>" class="list3">Supplier</a>
                </li>
                <li class="sidelistli <?php if($action=='order_view'){echo 'curr';}?>">
                    <a href="<?= URIROOT."order"?>" >view orders</a>
                    </li>
                <li class="sidelistli <?php if($action=='order_take'){echo 'curr';}?>">
                    <a href="<?= URIROOT."order/addOrder"?>" >Take orders</a>
                </li>
                <?php
                if(Session::get("empType")==1)
                {
                ?>
                <li class="sidelistli list4 <?php if($action=='employee')echo 'curr';?>">
                    <a href="<?= URIROOT."employee"?>" class="list4">Employees</a>
                </li>

                <?php 
                   
                }
                ?>
                <li class="sidelistli">
                    <a href="<?= URIROOT."logout"?>" >log out</a>
                </li>
            </ul>
        </nav>
        <!-- </div> -->