<?php 
$title = 'รายการของฉัน'; //กำหนดไตเติ้ล
include 'templates/header.php';
if ($_SESSION['status'] =='admin' || $_SESSION['status'] =='user')  
{
//include 'connect.php';
include 'function.php';
} else {
    echo "<script>alert('คุณไม่มีสิทธิในการเข้าถึง!'); window.location ='index.php';</script>";
}
?>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php?page=home">Home</a>
							</li>
							<li class="active">รายการของฉัน</li>
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

<!-- หน้าแรก -->					
<?php if (!isset($_GET['action'])) {
 $meSQL = "SELECT * FROM tb_event LEFT JOIN tb_rooms ON tb_event.rooms = tb_rooms.id_rooms WHERE id_member = {$_SESSION['id']} ORDER BY id DESC";
 $meQuery = $conn->query($meSQL);
 ?> 
<div class="clearfix">
<a class="btn btn-white btn-primary" href="index.php?page=booking" role="button"><i class="ace-icon glyphicon glyphicon-plus"></i>เพิ่ม</a>
	<span class="pull-right tableTools-container"></span>
</div>
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
	<th class="center">ห้องประชุม</th>
	<th class="center">หัวข้อ</th>
	<th class="center">เริ่มเวลา</th>
	<th class="center">สิ้นสุดเวลา</th>
	<th class="center">สถานะ</th>
	<th class="center">จัดการ</th>
  </tr>
</thead>
<tbody>
<?php
$i=1 ;
while ($rs = $meQuery->fetch_assoc()){
?>
  <tr>
    <td class="center"><?php echo $i++; ?></td>
	<td><?php echo $rs['name_rooms'];?></td>
	<td><?php echo $rs['title'];?></td>
    <td class="center"><?php $dateData=$rs['start']; echo thai_date_and_time(strtotime($dateData)); ?></td>
	<td class="center"><?php $dateData=$rs['end']; echo thai_date_and_time(strtotime($dateData)); ?></td>
	<td class="center"><?php if ($rs['status']=='1'){echo '<span class="label label-sm label-info">','อนุมัติ','</span>';} else if ($rs['status']=='2'){echo '<span class="label label-sm label-danger">','ไม่อนุมัติ','</span>';} else if($rs['status']=='3'){echo '<span class="label label-sm">','ยกเลิก','</span>' ;}else {echo '<span class="label label-sm label-warning">','รออนุมัติ','</span>';}?></td>
	<td class="center">
	<div class="hidden-sm hidden-xs action-buttons">
<?php if ($rs['status']=='0' || $rs['status']=='3' ) { ?>
	<a class="green" href="index.php?page=mybooking&action=edit&id=<?php echo $rs['id']; ?>">
		<i class="ace-icon fa fa-pencil bigger-130" title="แก้ไข"></i>
	</a>
	<a class="red" href="booking/action.php?action=change&id=<?php echo $rs['id']; ?>&status=<?php echo $rs['status']; ?>" OnClick="return chk();">
		<i class="ace-icon fa fa-gavel bigger-130" title="เปลี่ยนสถานะ"></i>
	</a>
<?php } ?>
	<a class="blue" href="javascript:popup('booking/print.php?id=<?php echo $rs['id']; ?>','',680,500)">
		<i class="ace-icon glyphicon glyphicon-print bigger-130" title="พิมพ์"></i>
	</a>
	
</div>

<div class="hidden-md hidden-lg">
	<div class="inline pos-rel">
		<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
			<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
		</button>

		<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
<?php if ($rs['status']=='0' || $rs['status']=='3' ) { ?>
			<li>
				<a href="index.php?page=mybooking&action=edit&id=<?php echo $rs['id']; ?>" class="tooltip-success" data-rel="tooltip" title="แก้ไข">
					<span class="green">
						<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
					</span>
				</a>
			</li>			
			<li>
				<a href="booking/action.php?action=change&id=<?php echo $rs['id']; ?>&status=<?php echo $rs['status']; ?>" class="tooltip-info" data-rel="tooltip" title="เปลี่ยนสถานะ" OnClick="return chk();">
					<span class="blue">
						<i class="ace-icon fa fa-gavel bigger-120"></i>
					</span>
				</a>
			</li>
<?php } ?>
			<li>
				<a href="javascript:popup('booking/print.php?id=<?php echo $rs['id']; ?>','',680,500)" class="tooltip-error" data-rel="tooltip" title="พิมพ์">
					<span class="red">
						<i class="ace-icon glyphicon glyphicon-print bigger-120"></i>
					</span>
				</a>
			</li>
		</ul>
	</div>
</div>
	</td> 
  </tr>
  <?php } ?>   
  </tbody>
</table>
<?php } ?>
<!-- แก้ไข -->	
<?php if (isset($_GET['action']) and $_GET['action']=='edit') { 
		$meSQL = "SELECT * FROM tb_event WHERE id ='{$_GET['id']}' ";
		$meQuery = $conn->query($meSQL);
    if ($meQuery == TRUE) {
        $meResult2 = $meQuery->fetch_assoc();
    } else {
        echo $conn->error;
    }
    ?>               
<form enctype="multipart/form-data" class="form-horizontal" role="form" name="formregister" method="post" action="booking\action.php?action=edit">
    <div class="page-header"><h1>แก้ไข</h1></div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="idrooms"> ห้องประชุม </label>
    <div class="col-sm-9">
	<select name="idrooms" id="idrooms">
<?php 
 $meSQL = "SELECT * FROM tb_rooms ORDER BY id_rooms asc";
 $meQuery = $conn->query($meSQL);
 while ($meResult = $meQuery->fetch_assoc()){
 ?> 
            <option value="<?php echo $meResult['id_rooms'];?>" <?php if ($meResult['id_rooms'] == $meResult2['rooms']) {echo 'selected';}?>><?php echo $meResult['name_rooms'];?></option>
 <?php } ?>
       </select>
    </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right">ผู้จอง</label>
      <div class="col-sm-9">
	<input type="text" name="membershow" placeholder="" class="col-xs-10 col-sm-5" value="<?php echo $rs['firstname'].'  '.$rs['surname'];?>" disabled />
	<input type="hidden" name="member" value="<?php echo $rs['firstname'].'  '.$rs['surname'];?>" />
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="division"> สังกัด </label>
      <div class="col-sm-9">
       <select name="division" id="division" >
<?php 
 $meSQL = "SELECT * FROM tb_division ORDER BY id_division asc";
 $meQuery = $conn->query($meSQL);
 while ($meResult = $meQuery->fetch_assoc()){
 ?> 
            <option value="<?php echo $meResult['id_division'];?>" <?php if ($meResult['id_division'] == $meResult2['division']) {echo 'selected';}?>><?php echo $meResult['name_division'];?></option>
 <?php } ?>
       </select>
      </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="title">หัวข้อ</label>
      <div class="col-sm-9">
	<input type="text" name="title" id="title" placeholder="" class="col-xs-10 col-sm-5" value="<?php echo $meResult2['title'];?>" required />
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="people">จำนวนคน</label>
    <div class="col-sm-2">
		<input type="number" name="people" id="people" placeholder="" class="col-xs-10 col-sm-5" value="<?php echo $meResult2['people'];?>" required />
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="startdatepicker"> เริ่ม</label>
    <div class="col-sm-2">
	<div class="input-group"> <input class="form-control datepicker" name="startdate" id="startdatepicker" type="text" data-date-format="yyyy-mm-dd" autocomplete="off" value="<?php $start = date('Y-m-d',strtotime($meResult2['start']));echo $start;?>" required> <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i> </span> </div>
    </div>
	<label class="col-sm-1 control-label no-padding-right" for="starttime"> เวลา </label>
    <div class="col-sm-2">
	<div class="input-group"> <input id="starttime" name="starttime" type="time" class="form-control" value="<?php $starttime = date('H:i',strtotime($meResult2['start']));echo $starttime;?>" required></div>
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="enddatepicker">สิ้นสุด</label>
    <div class="col-sm-2">
	<div class="input-group"> <input class="form-control datepicker" name="enddate" id="enddatepicker" type="text" data-date-format="yyyy-mm-dd" autocomplete="off" value="<?php $end = date('Y-m-d',strtotime($meResult2['end']));echo $end;?>" required> <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i> </span> </div>
    </div>
	<label class="col-sm-1 control-label no-padding-right" for="endtime"> เวลา </label>
    <div class="col-sm-3">
	<div class="input-group"> <input id="endtime" name="endtime" type="time" class="form-control" value="<?php $endtime = date('H:i',strtotime($meResult2['end']));echo $endtime;?>" required></div>
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="style" required> จัดโต๊ะ </label>
      <div class="col-sm-9">
       <select name="style" id="style" >
<?php 
 $meSQL = "SELECT * FROM tb_style ORDER BY id_style asc";
 $meQuery = $conn->query($meSQL);
 while ($meResult = $meQuery->fetch_assoc()){
 ?> 
            <option value="<?php echo $meResult['id_style'];?>" <?php if ($meResult['id_style'] == $meResult2['style']) {echo 'selected';}?>><?php echo $meResult['name_style'];?></option>
 <?php } ?>
       </select>
      </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" > อุปกรณ์ </label>
      <div class="col-sm-9">
<?php 
 $meSQL = "SELECT * FROM tb_equipment ORDER BY id_equipment asc";
 $meQuery = $conn->query($meSQL);
 $equipment = explode(',' , $meResult2['equipment']);
 //echo $equipment;
 $i = 0;
 while ($meResult = $meQuery->fetch_assoc()){
	 if (in_array($meResult['id_equipment'], $equipment))
	 {
		  echo "<input type='checkbox' name='equip[]' value='".$meResult['id_equipment']."' checked>";
		 }else
		 {
		  echo "<input type='checkbox' name='equip[]' value='".$meResult['id_equipment']."' >";
		 }// end if
 ?> 	  
       
		<label for="equip[]"><?php echo $meResult['name_equipment'];?></label>&nbsp;&nbsp; &nbsp;&nbsp;
<?php $i++; if ($i == 3){echo '<br />';$i=0;} 
} ?>
      </div>
</div> 
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="etc">อื่นๆ </label>
      <div class="col-sm-4">
<textarea class="form-control" id="etc" name="etc" placeholder=""><?php echo $meResult2['etc'];?></textarea>
	  </div>
</div>
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
<div class="clearfix form-actions">
	<div class="col-md-offset-3 col-md-9">
	<button class="btn btn-primary" type="submit">
	<i class="ace-icon fa fa-check bigger-110"></i>
		ยืนยัน
</button>
&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
<button class="btn btn-warning" type="button" onClick="javascript: window.history.back();">
	<i class="ace-icon fa fa-undo bigger-110"></i>
		ยกเลิก
</button>
    </div>
</div>
</form>
<?php } ?> 
				</div>
            </div>	
		</div>	
	</div>
<script language="JavaScript">
function chk(){if(confirm('ต้องการเปลี่ยนสถานะหรือไม่ ยกเลิก/รออนุมัติ')){
	return true;
}else{
	return false;
}
}
</script>
<script type="text/javascript">
function popup(url,name,windowWidth,windowHeight){ 
myleft=(screen.width)?(screen.width-windowWidth)/2:100; 
mytop=(screen.height)?(screen.height-windowHeight)/2:100; 
properties = "width="+windowWidth+",height="+windowHeight;
properties +=",scrollbars=no, top="+mytop+",left="+myleft+",toolbar=no";    
window.open(url,name,properties);
}
</script>								
<?php		
include 'templates/footer.php';
$conn->close();
?>
                              