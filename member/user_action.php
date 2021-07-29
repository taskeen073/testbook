<?php
session_start();
if ($_SESSION['status']!='admin' and $_SESSION['status']!='user') {
	echo "<script>alert('session ผิดผลาด'); window.location ='../index.php';</script>";
	exit();
} else {
include '../connect.php';    
}
//แก้ไขข้อมูล user
if ($_GET['action']=='edit'){
	if (strlen($_POST['txtUsername'])<5) {
		echo "<script>alert('ชื่อผู้ใช้ต้องมากกว่า 5 ตัวอักษร'); history.back(-1);</script>";
		exit();
    }			
	if (strlen($_POST['txtPassword'])<6) {
		echo "<script>alert('รหัสผ่านต้องมากกว่า 6 ตัวอักษร'); history.back(-1);</script>";
		exit();
    }
	if($_POST["txtPassword"] != $_POST["txtConPassword"])
	{
		echo "<script>alert('รหัสผ่านไม่ตรงกัน'); window.history.back();</script>";
		exit();
    }
        	if(!filter_var($_POST['txtemail'], FILTER_VALIDATE_EMAIL))
	{
		echo "<script>alert('อีเมลล์ไม่ถูกต้อง');history.back(-1);</script>";
		exit();
    }
$meSQL = "UPDATE tb_member ";
$meSQL .="SET username='{$_POST['txtUsername']}',"
. "password='{$_POST['txtPassword']}',"
. "ntitle='{$_POST['title']}',"
. "firstname='{$_POST['txtfirstname']}',"
. "surname='{$_POST['txtsurname']}',"
. "position='{$_POST['position']}',"
. "phone='{$_POST['phone']}',"
. "email='{$_POST['txtemail']}',"
. "status='{$_POST['status']}',"
. "active='{$_POST['active']}' ";
$meSQL .= "WHERE id_member='{$_POST['id']}' ";
$meQuery = $conn->query($meSQL);			
	if ($meQuery == TRUE) {
		echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว'); window.location ='../index.php?page=user';</script>";
        } else {
		echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
		exit();
        }
}	
$conn->close();
?>