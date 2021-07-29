<?php 
error_reporting(0);
$title = 'ระบบจองห้องประชุม'; 
include 'templates/header.php';
include 'connect.php';  
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate ("D, d M Y H:i:s") . " GMT");

$query2 = "SELECT * FROM tb_equipment";
$result2 = $conn->query($query2);
$arr1 = '"0"=>""';
while ($rs = $result2->fetch_assoc()) {
    $arr2 .= ',"'.$rs['id_equipment'].'"=>"'.$rs['name_equipment'].'"';
}
$arr3 = $arr1.$arr2;
$arr3 = $arr3;
echo $arr3;

function listeq($num){    
	$arr3 = array($arr3);
	$watch_return = $arr3[$num]; 
  return $watch_return;
}
echo '<br>';
$var = '1,3,4';
$arrayex = explode(',', $var);
foreach ($arrayex as $value) {
  $equip .= listeq($value).',';
}
echo $equip;
?>

<style type="text/css">   
/* css สำหรับกำหนดรูปแบบของกล่องข้อความ Tooltip */ 
.tooltip{  
    position:fixed;    
    padding:15px;  
    z-index:90000;
}  
</style>     
<style>
  #calendar {
    max-width: 700px;
    margin: 0 auto;
  }
</style>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php?page=home">Home</a>
							</li>
						</ul><!-- /.breadcrumb -->
</div>				
<div class="page-header">
							<h1>
								<?php echo $org; ?>
							</h1>
</div><!-- /.page-header -->
                                                
<div class="main-container ace-save-state" id="main-container">
    <div class="main-content">
		<div class="main-content-inner">
			<div class="page-content" >
                <div class="row" >
                    <div class="col-sm-12">
					
							<div class="center">
                      <span class="label label-danger label-white middle">รออนุมัติ 
<?php $sql2 = "SELECT COUNT(id) AS count1 FROM tb_event WHERE status = 0 ";
$rs2 = $conn->query($sql2)->fetch_assoc(); echo $rs2['count1']; ?> รายการ</span>
					  <span class="label label-success label-white middle">ห้องประชุม 
<?php $sql2 = "SELECT COUNT(id_rooms) AS count2 FROM tb_rooms ";
$rs2 = $conn->query($sql2)->fetch_assoc(); echo $rs2['count2']; ?> ห้อง</span>
					  <span class="label label-info label-white middle">สมาชิก 
<?php $sql2 = "SELECT COUNT(id_member) AS count3 FROM tb_member ";
$rs2 = $conn->query($sql2)->fetch_assoc(); echo $rs2['count3']; ?> คน</span>
							</div>	  
							<br>
					  <div id="calendar"></div>							
				</div>
            </div>
        <div id="fullCalModal" class="modal fade" style="padding-top:20px">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                    <h3>รายการจองห้องประชุม</h4>
					</div>
						<div id="modalTitle" class="modal-body" style="font-size: 16px;"></div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
				</div>
			</div>
		</div>     
<?php		
include 'templates/footer.php';
?>
                              