<link href="<?= URIROOT."css/login_css.css"?>" rel="stylesheet" media="all">
<form action="<?= URIROOT."/login";?>" method="post" class="login_form">
        <div class="center_box">
            <div class="center_img"><img src="<?= URIROOT."pic/logo.png"?>" alt="company logo" class="login_img"></div>
            <h1 class="center_text">Member Login</h1>
            <br>
            <label for="usename"><h3>Email id</h3></label>
            <input type="text" name="loginMail" id="loginMail" value="<?php echo $this->getFormdata("loginMail");?>" placeholder="Enter Email address">
            <br>
            <span id="usernameErr"><?php echo $this->getdataError("loginMail");?></span>
            <!-- <br> -->
            <label for="password"><h3>Password</h3></label>
            <input type="password" name="loginPassword" id="loginPassword" placeholder="Enter Password">
            <br>
            <span id="passwordErr"><?php echo $this->getdataError("loginPassword");?></span>
            <br>
            <span id="loginError"><?php echo $this->getdata("loginError");?></span>
            <br>
            <input type="submit" class="logbtn" value="Login" name="loginbtn">
            <br>
            <span id="loginError"><?php echo $this->getdata("loginError");?></span>
            <br>
            <span >all members are manage by administration</span>
        </div>
    </form>