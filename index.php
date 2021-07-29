<?php
error_reporting (E_ALL ^ E_NOTICE);

$dir3 = '';
$dir4 = '';
if (!isset($_GET["page"])){$_GET["page"] = '';}
	$site = $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'];
	$site = str_replace('index.php','',$site);
    $dirs = glob($site . '*', GLOB_ONLYDIR);
    foreach ($dirs as $dir) {
			$dir = str_replace($site,'',$dir);
            $alldirs[] = $dir; 
    }
	$refrain = array('ace-master','assets','images','templates','font');// folder ที่ละเว้น
   foreach($alldirs as $dir)
{
	$dir2 = str_replace($refrain,'',$dir);
	if ($dir2 != ''){ 
	$dir3 .= 'case '.'"'.$dir2.'"'.':';
    $dir3 .= 'include("'.$dir2.'/index.php'.'"'.');';
    $dir3 .= 'break;';
	}
}
	$dir3 .= ' 			
  case "login":
    include("member/login.php");
    break;
  case "user":	
    include("member/user.php");
    break;
  case "setrooms":
  	include("rooms/setting.php");
	 break;
  case "mybooking":
	  include("booking/mybooking.php");
    break;
	  '; //ถ้ามี case ที่ไม่ใช่  index
//	session_start();  //เปิดกรณีบังคับ Login
//    $dir4 .= 'if(!isset($_SESSION["id"])) {';
//	  $dir4 .= 'include("member/login.php");'; 
//    $dir4 .= '} else {';
	$dir4 .= 'switch ($_GET["page"]) {'.$dir3.'';
    $dir4 .= 'default:include "home/index.php";  }';//หน้าแรก
//    $dir4 .= '}';
	eval($dir4);
//echo eval($dir4);
?>
