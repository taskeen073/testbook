<?php
session_start();
if ($_SESSION['status']!='admin' and $_SESSION['status']!='user') {
	echo "<script>alert('session ผิดผลาด'); window.location ='../index.php';</script>";
	exit();
} else {
include '../connect.php'; 
}
//เพิ่มข้อมูล
if ($_GET['action']=='add'){
$sql = "SELECT * FROM tb_rooms WHERE id_rooms = '{$_POST['idrooms']}' ";
$meResult = $conn->query( $sql )->fetch_assoc() ;   
$strYear = date('Y',strtotime($_POST['startdate']))-543;
$strMonth= date('m',strtotime($_POST['startdate']));
$strDay= date('d',strtotime($_POST['startdate']));
$startdate = $strYear.'-'.$strMonth.'-'.$strDay.'T'.$_POST['starttime'].':00';

$endstrYear = date('Y',strtotime($_POST['enddate']))-543;
$endstrMonth= date('m',strtotime($_POST['enddate']));
$endstrDay= date('d',strtotime($_POST['enddate']));
$enddate = $endstrYear.'-'.$endstrMonth.'-'.$endstrDay.'T'.$_POST['endtime'].':00';

$strSQL = "SELECT * FROM tb_event WHERE rooms = '".$_POST['idrooms']."' AND status = 1 AND ((start between '".$startdate."' AND '".$enddate."') or ";
$strSQL .= " (end between '".$startdate."' AND '".$enddate."') OR ('".$startdate."' between start AND end) OR ";
$strSQL .= " ('".$enddate."' between start AND end)) ";
	
	$objResult = $conn->query( $strSQL )->fetch_array() ;
	if($objResult)
	{
			echo "<script>alert('วันและเวลาที่จองห้องของคุณ ถูกจองไปแล้ว!');history.back(-1);</script>";
			exit();
	}
	else
	{
$equip = implode(',', $_POST['equip']);	
$meSQL = "INSERT INTO tb_event (id_member,rooms,title,start,end,color,division,people,style,equipment,member,etc) VALUES ('".$_POST['memberid']."','".$_POST['idrooms']."','".$_POST['title']."','".$startdate."','".$enddate."','".$meResult['color_rooms']."','".$_POST['division']."','".$_POST['people']."','".$_POST['style']."','".$equip."','".$_POST['member']."','".$_POST['etc']."')";
		$meQuery = $conn->query($meSQL);		
	}	
		if ($meQuery == TRUE) {
			echo "<script>alert('เพิ่มข้อมูลเสร็จเรียบร้อยแล้ว'); window.location ='../index.php?page=mybooking';</script>";
        } else {
			echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
			exit();
        
		}	
}	

//แก้ไขข้อมูล
if ($_GET['action']=='edit'){
$sql = "SELECT * FROM tb_rooms WHERE id_rooms = '{$_POST['idrooms']}' ";
$meResult = $conn->query( $sql )->fetch_assoc() ;   
$strYear = date('Y',strtotime($_POST['startdate']))-543;
$strMonth= date('m',strtotime($_POST['startdate']));
$strDay= date('d',strtotime($_POST['startdate']));
$startdate = $strYear.'-'.$strMonth.'-'.$strDay.'T'.$_POST['starttime'].':00';

$endstrYear = date('Y',strtotime($_POST['enddate']))-543;
$endstrMonth= date('m',strtotime($_POST['enddate']));
$endstrDay= date('d',strtotime($_POST['enddate']));
$enddate = $endstrYear.'-'.$endstrMonth.'-'.$endstrDay.'T'.$_POST['endtime'].':00';

$strSQL = "SELECT * FROM tb_event WHERE rooms = '".$_POST['idrooms']."' AND status = 1 AND ((start between '".$startdate."' AND '".$enddate."') or ";
$strSQL .= " (end between '".$startdate."' AND '".$enddate."') OR ('".$startdate."' between start AND end) OR ";
$strSQL .= " ('".$enddate."' between start AND end)) ";
	
	$objResult = $conn->query( $strSQL )->fetch_array() ;
	if($objResult)
	{
			echo "<script>alert('วันและเวลาที่จองห้องของคุณ ถูกจองไปแล้ว!');history.back(-1);</script>";
			exit();
	}
	else
	{
$equip = implode(',', $_POST['equip']);
$meSQL = "UPDATE tb_event ";
$meSQL .="SET rooms='{$_POST['idrooms']}',"
. "title='{$_POST['title']}',"
. "start='{$startdate}',"
. "end='{$enddate}',"
. "color='{$meResult['color_rooms']}',"
. "division='{$_POST['division']}',"
. "people='{$_POST['people']}',"
. "style='{$_POST['style']}',"
. "equipment='{$equip}',"
. "etc='{$_POST['etc']}' ";
$meSQL .= "WHERE id ='{$_POST['id']}' ";
$meQuery = $conn->query($meSQL);			
	}
	if ($meQuery == TRUE) {
		echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=mybooking'; </script>";
        } else {
		echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
		exit();
        }
}	
//เปลี่ยนสถานะ
if ($_GET['action']=='change'){
		if ($_GET['status']=='0'){
			$meSQL = "UPDATE tb_event SET status='3'";
		} else if($_GET['status']=='3'){
			$meSQL = "UPDATE tb_event SET status='0'";
}
$meSQL .= "WHERE id ='{$_GET['id']}' ";
$meQuery = $conn->query($meSQL);			
	if ($meQuery == TRUE) {
		echo "<script>window.location ='../index.php?page=mybooking';</script>";
        } else {
		echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
		exit();
        }
}	
//ปิด
$conn->close();
?>

