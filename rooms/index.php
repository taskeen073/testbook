<?php 
$title = 'ห้องประชุม'; //กำหนดไตเติ้ล
include 'templates/header.php';
include 'connect.php';
?>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php?page=home">Home</a>
							</li>
							<li class="active">ห้องประชุม</li>
						</ul><!-- /.breadcrumb -->
</div>				
<div class="page-header">
	
							<h1>
								<?php echo $org; ?>
								<!--<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								</small>-->
							</h1>
</div><!-- /.page-header -->           
<div class="main-container ace-save-state" id="main-container">
    <div class="main-content">
		<div class="main-content-inner">
			<div class="page-content" >
                <div class="row" >
                    <div class="col-sm-12">
<!-- หน้าแรก -->					
<?php if (!isset($_GET['action'])) {
 $meSQL = "SELECT * FROM tb_rooms ORDER BY id_rooms asc";
 $meQuery = $conn->query($meSQL);
 ?> 
<div class="table-header">
<?php echo $title; ?>
</div>                    
        <!-- div.table-responsive -->
		<!-- div.dataTables_borderWrap -->
		<div class="table-responsive">
<table id="dynamic-table" class="table table-striped table-bordered table-hover" >  
<thead>
  <tr>
    <th class="center">ลำดับ</th>
	<th class="center">รูปภาพ</th>
	<th class="center">ชื่อห้อง</th>
	<th class="center">จำนวนคน</th>
	<th class="center">รายละเอียด</th>
  </tr>
</thead>
<tbody>
<?php
$i=1 ;
while ($rs = $meQuery->fetch_assoc()){
?>
  <tr>
    <td class="center"><?php echo $i++; ?></td>
	<td class="center ace-thumbnails clearfix"><p><a href="images/<?php echo $rs['image_rooms']?>" data-rel="colorbox"><img src="images/<?php echo $rs['image_rooms']?>" alt="รูปภาพ" style="width:120px;height:100px;border: 1px solid #9e9e9e"></p></td>
	<td class="center"><?php echo $rs['name_rooms']?></td>
    <td class="center"><?php echo $rs['people_rooms']?></td> 
	<td><pre style="padding: 1px;border: 0px;background-color: transparent !important;"><?php echo $rs['detail_rooms']?></pre></td>
  </tr>
  <?php } ?>   
  </tbody>
</table>
<?php } ?>
				</div>
            </div>	
		</div>				
<?php		
include 'templates/footer.php';
$conn->close();
?>
                              