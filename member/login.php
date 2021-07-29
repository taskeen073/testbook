<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link href="https://fonts.googleapis.com/css2?family=Niramit:wght@700&display=swap" rel="stylesheet">
<style>
body { 
font-family: 'Niramit', sans-serif; 
}
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
   
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
.dobtn {
    width: auto;
    padding: 10px 18px;
    background-color: #3393d8;
}
.footer
{
    position:fixed;
    bottom:0;
    width:100%;
    background:#555555;
    padding:5px 5px 5px 5px;
	text-align:center;
	color:#fff;
	vertical-align: middle;
	line-height: 20px;
	font-family: monospace;
}
</style>
</head>
<body>
<div style="width:400px;margin:70px auto;">
<div style="text-align:center;color:#607d8b"><h1>ระบบจองห้องประชุม</h1></div>
<form name="login" method="post" action="member/check_login.php">
  <div class="container">
    <label><b>ชื่อผู้ใช้</b></label>
    <input type="text" placeholder="Enter Username" name="username" value="<?php if(isset($_COOKIE["userlogin"])) { echo $_COOKIE["userlogin"]; } ?>" >

    <label><b>รหัสผ่าน</b></label>
    <input type="password" placeholder="Enter Password" name="password" value="<?php if(isset($_COOKIE["passwordform"])) { echo $_COOKIE["passwordform"]; } ?>" >
        
    <button type="submit">Login</button>
    <input name="remember" type="checkbox" id="remember"  value="remember"<?php if(isset($_COOKIE["userlogin"])) { ?> checked <?php }; ?> /> Remember me
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" onClick="javascript: window.history.back();" class="cancelbtn">ยกเลิก</button>
    <!--<span class="psw"><button type="button" class="dobtn" onClick="javascript:window.location ='member/rigister.php';" >สมัครสมาชิก</button></span>-->
  </div>
</form>
 <div style="text-align:center;vertical-align: middle;display: table-cell;">
  <span style="color:#555">Support : </span><img src="images/ie20.jpg"><span style="color:#555">        Internet Exproler     </span><img src="images/chrome20.jpg"><span style="color:#555">        Chrome     </span><img src="images/firefox20.jpg"><span style="color:#555">        Firefox</span>
  </div>
</div>
<div class="footer" >Copyright © 2020 By woravets .All rights reserved</div>
</body>
</html>
