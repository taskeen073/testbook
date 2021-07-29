<?php
session_start();
if ($_SESSION['status']!='admin') {
	echo "<script>alert('session ผิดผลาด'); window.location ='../index.php';</script>";
	exit();
} else {
include '../connect.php'; 
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

$strSQL = "SELECT * FROM tb_event WHERE rooms = '".$_POST['idrooms']."' AND status = 1 AND ((start between '".$startdate."' AND '".$enddate."') OR ";
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
. "etc='{$_POST['etc']}',"
. "status='{$_POST['status']}' ";
$meSQL .= "WHERE id ='{$_POST['id']}' ";
$meQuery = $conn->query($meSQL);	
	}		
	if ($meQuery == TRUE) {
		if ($_GET['report'] != '') {
			echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=report&report=".$_GET['report']."';</script>";
			} else { echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=report';</script>"; }
	} else {
		echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
		exit();
	}
}	

//ลบข้อมูล
if ($_GET['action']=='delete'){
	$meSQL = "DELETE FROM tb_event ";
	$meSQL .= "WHERE id='{$_GET['id']}' ";
	$meQuery = $conn->query($meSQL);
	if ($meQuery == TRUE) {
		if ($_GET['report'] != '') {
			echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=report&report=".$_GET['report']."';</script>";
			} else { echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=report';</script>"; }
	} else {
		echo "<script>alert('มีปัญหาการลบข้อมูล '); history.back(-1);</script>";
		exit();
	}
}	
//ปิด
$conn->close();
?>

