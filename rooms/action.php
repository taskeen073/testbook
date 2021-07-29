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
	if($_FILES["Upload"]["name"] != "")
        {			
			$filename = basename($_FILES["Upload"]["name"]);
        	move_uploaded_file($_FILES["Upload"]["tmp_name"],"../images/".$filename);
        }
		$meSQL = "INSERT INTO tb_rooms (image_rooms,name_rooms,people_rooms,detail_rooms,color_rooms) VALUES ('".$filename."','".$_POST["Name"]."','".$_POST["People"]."','".$_POST["Detail"]."','".$_POST["Color"]."')";
		$meQuery = $conn->query($meSQL);		
		
		if ($meQuery == TRUE) {
			echo "<script>alert('เพิ่มข้อมูลเสร็จเรียบร้อยแล้ว'); window.location ='../index.php?page=setrooms';</script>";
        } else {
			echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
			exit();
        
		}		
}

//แก้ไขข้อมูล
if ($_GET['action']=='edit'){
	if($_FILES["Upload"]["name"] != "")
        {
			        		//*** Delete Old File ***//
        	@unlink("../images/".$_POST["hdnOldFile"]);
			$filename = basename($_FILES["Upload"]["name"]);	
        	move_uploaded_file($_FILES["Upload"]["tmp_name"],"../images/".$filename);     	
        }
		else{
			$filename = $_POST['hdnOldFile'];
		}
$meSQL = "UPDATE tb_rooms ";
$meSQL .="SET image_rooms='$filename',"
. "name_rooms='{$_POST['Name']}',"
. "people_rooms='{$_POST['People']}',"
. "detail_rooms='{$_POST['Detail']}',"
. "color_rooms='{$_POST['Color']}' ";
$meSQL .= "WHERE id_rooms='{$_POST['id']}' ";
$meQuery = $conn->query($meSQL);			
	if ($meQuery == TRUE) {
		echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location ='../index.php?page=setrooms'; </script>";
        } else {
		echo "<script>alert('มีปัญหาการบันทึกข้อมูล กรุณากลับไปบันทึกใหม่');history.back(-1);</script>";
		exit();
        }
}	

//ลบข้อมูล
if ($_GET['action']=='delete'){
	if($_GET["image"] != "")
        {			        		//*** Delete Old File ***//
        	@unlink("../images/".$_GET["image"]);   	
        }
        $meSQL = "DELETE FROM tb_rooms ";
        $meSQL .= "WHERE id_rooms='{$_GET['id']}' ";
        $meQuery = $conn->query($meSQL);
        if ($meQuery == TRUE) {
			echo "<script>alert('ลบข้อมูลสำเร็จ'); window.location ='../index.php?page=setrooms';</script>";
        } else {
			echo "<script>alert('มีปัญหาการลบข้อมูล '); history.back(-1);</script>";
			exit();
        }
}

if(isset($_REQUEST['action']) and $_REQUEST['action']=="updateSortedRows"){
	$newOrder	=	explode(",",$_REQUEST['sortOrder']);
	$n	=	'1';
	foreach($newOrder as $id){
		$conn->query('UPDATE tb_rooms SET position="'.$n.'" WHERE id_rooms="'.$id.'" ');
		$n++;
	}
}

$conn->close();
?>

