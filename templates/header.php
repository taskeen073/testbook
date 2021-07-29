<?php
session_start();
if ($_SESSION['id'] != '') {
include 'connect.php';
$sql = "SELECT * FROM tb_member WHERE id_member = '{$_SESSION['id']}' ";
$rs = $conn->query( $sql )->fetch_assoc() ;
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>

		<meta name="description" content="top menu &amp; navigation" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png" />
		<link rel="stylesheet" href="custom.css" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
        <link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="assets/css/colorbox.min.css" />
	
		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
		<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		<link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
        <link rel="stylesheet" href="assets/fullcalendar-3.6.2/fullcalendar.min.css"/>
        <link href="assets/dist/css/bootstrap-datepicker.css" rel="stylesheet" />     
		<script src="assets/js/ace-extra.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body class="no-skin">
<div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
				</button>
				<div class="navbar-header pull-left">
					<a href="index.php?page=home" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							ระบบจองห้องประชุม 
						</small>
					</a>
				</div>     				
				<nav id="sidebar" role="navigation" class="navbar-menu pull-left navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="<?php if ($_GET['page']=='booking'){echo 'active';}?>">
							<a href="index.php?page=booking">
								<i class="ace-icon fa  fa-pencil-square-o"></i>
								จองห้องประชุม
							</a>
						</li>
						<li class="<?php if ($_GET['page']=='rooms'){echo 'active';}?>">
							<a href="index.php?page=rooms">
								<i class="ace-icon fa  fa-coffee"></i>
								ห้องประชุม
							</a>
						</li>
<?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'user') {?>                                           
						<li class="<?php if ($_GET['page']=='mybooking'){echo 'active';}?>">
							<a href="index.php?page=mybooking">
								<i class="ace-icon fa  fa-calendar"></i>
								รายการจองของฉัน
							</a>
						</li>
<?php } ?>                                           
<?php   if ($_SESSION['status'] =='admin')  { ?>
						<li class="<?php if ($_GET['page']=='member'){echo 'active';}?>">
							<a href="index.php?page=member">
								<i class="ace-icon fa fa-users"></i>
								สมาชิก
							</a>
						</li>    
						<li class="<?php if ($_GET['page']=='report'){echo 'active';}?>">
							<a href="index.php?page=report">
								<i class="ace-icon fa fa-check-square-o"></i>
								ตรวจสอบ
							</a>
						</li>
						<li class="<?php if ($_GET['page']=='setrooms' || $_GET['page']=='style' || $_GET['page']=='equip' ){echo 'active';}?>">				
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="ace-icon fa fa-cogs"></i>
								ตั้งค่า
	  		&nbsp;
								<i class="ace-icon fa fa-angle-down bigger-110"></i>
							</a>

							<ul class="dropdown-menu dropdown-light-blue dropdown-caret">
								<li>
									<a href="index.php?page=setrooms">
										<i class="ace-icon fa fa-coffee bigger-110 blue"></i>
										ห้องประชุม
									</a>
								</li>

								<li>
									<a href="index.php?page=style">
										<i class="ace-icon fa fa-eye bigger-110 blue"></i>
										รูปแบบห้อง
									</a>
								</li>

								<li>
									<a href="index.php?page=equip">
										<i class="ace-icon fa fa-camera-retro bigger-110 blue"></i>
										อุปกรณ์
									</a>
								</li>
								
								<li>
									<a href="index.php?page=division">
										<i class="ace-icon fa fa-briefcase bigger-110 blue"></i>
										สังกัด
									</a>
								</li>
							</ul>
						</li>
<?php } ?>  
					</ul>
				</nav>
				<div class="navbar-buttons navbar-header pull-right " role="navigation">
<?php if ($_SESSION['id'] != '') {?> 
					<ul class="nav ace-nav">
<?php 	if ($_SESSION['status'] == 'admin') {
$sql2 = "SELECT COUNT(id) AS count1 FROM tb_event WHERE status = 0 ";
$rs2 = $conn->query($sql2)->fetch_assoc();?>					
						<li class="transparent dropdown-modal open">
							<a class="dropdown-toggle" href="index.php?page=report&report=0" >
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important"><?php if ($rs2['count1']==0){echo '';}else {echo $rs2['count1'];}?></span>
							</a>
						</li>
<?php } ?>				
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" src="assets/images/avatars/way.jpg" alt="Member Photo" />
								<span class="user-info">
									<small>ยินดีต้อนรับ</small>
										<span style="font-size:13px;">
<?php 
										echo $rs['firstname'].'  '.$rs['surname'];
?>									
										</span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="index.php?page=user">
										<i class="ace-icon fa fa-cog"></i>
										ตั้งค่า
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="member/logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										ออกจากระบบ
									</a>
								</li>
							</ul>
						</li>
					</ul>
<?php } else {?>
<ul class="nav ace-nav">
<li>
							<a href="index.php?page=login">
								<i class="ace-icon fa  fa-laptop"></i>
								เข้าสู่ระบบ
							</a>
</li>  
</ul>
<?php } ?>
						</div>
			</div><!-- /.navbar-container -->
		</div>