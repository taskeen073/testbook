<?php
session_start();
if ($_SESSION['status']!='admin') {
	echo "<script>alert('session ผิดผลาด'); window.location ='../index.php';</script>";
	exit();
} else {
include '../connect.php';    
}
//เพิ่มข้อมูล
if ($_GET['action']=='add'){
		$meSQL = "INSERT INTO tb_division (name_division) VALUES ('".$_POST["Name"]."')";
		$meQuery = $conn->query($meSQL);		
		
		if ($meQuery == TRUE) {
			echo "<script>alert('เพิ่มข้อมูลเสร็จเรียบร้อยแล้ว'); window.location ='../index.php?page=division';</script>";
        } else {
			echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
			exit();
        
		}		
}

//แก้ไขข้อมูล
if ($_GET['action']=='edit'){
$meSQL = "UPDATE tb_division ";
$meSQL .="SET name_division='{$_POST['Name']}' ";
$meSQL .= "WHERE id_division='{$_POST['id']}' ";
$meQuery = $conn->query($meSQL);			
	if ($meQuery == TRUE) {
		echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=division'; </script>";
        } else {
		echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
		exit();
        }
}	

//ลบข้อมูล
if ($_GET['action']=='delete'){
        $meSQL = "DELETE FROM tb_division ";
        $meSQL .= "WHERE id_division='{$_GET['id']}' ";
        $meQuery = $conn->query($meSQL);
        if ($meQuery == TRUE) {
			echo "<script>alert('ลบข้อมูลสำเร็จ'); window.location ='../index.php?page=division';</script>";
        } else {
			echo "<script>alert('มีปัญหาการลบข้อมูล '); history.back(-1);</script>";
			exit();
        }
}

if(isset($_REQUEST['action']) and $_REQUEST['action']=="updateSortedRows"){
	$newOrder	=	explode(",",$_REQUEST['sortOrder']);
	$n	=	'1';
	foreach($newOrder as $id){
		$conn->query('UPDATE tb_division SET position="'.$n.'" WHERE id_division="'.$id.'" ');
		$n++;
	}
}

$conn->close();
?>

