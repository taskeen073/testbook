<?php 
$title = 'จองห้องประชุม'; //กำหนดไตเติ้ล
include 'templates/header.php';
if ($_SESSION['status'] =='admin' || $_SESSION['status'] =='user')  
{
include 'function.php';
} else {
    echo "<script>alert('กรุณาลงชื่อเข้าใช้ระบบ!'); window.location ='index.php?page=login';</script>";
}
?>	
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php?page=home">Home</a>
							</li>
							<li class="active">จองห้องประชุม</li>
						</ul><!-- /.breadcrumb -->
</div>				
<div class="page-header">
							<h1>
								<?php echo $org; ?>
								<!--<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									ข้อความ
								</small>-->
							</h1>
</div><!-- /.page-header -->           
<div class="main-container ace-save-state" id="main-container">
    <div class="main-content">
		<div class="main-content-inner">
			<div class="page-content" >
                <div class="row" >
                    <div class="col-sm-12">
<form enctype="multipart/form-data" class="form-horizontal" role="form" name="formregister" method="post" action="booking\action.php?action=add">
    <div class="page-header"><h1>จองห้องประชุม</h1></div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="idrooms"> ห้องประชุม </label>
    <div class="col-sm-9">
	<select name="idrooms" id="idrooms" >
<?php 
 $meSQL = "SELECT * FROM tb_rooms ORDER BY position asc";
 $meQuery = $conn->query($meSQL);
 while ($meResult = $meQuery->fetch_assoc()){
 ?> 
            <option value="<?php echo $meResult['id_rooms'];?>"><?php echo $meResult['name_rooms'];?></option>
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
       <select name="division" id="division">
<?php 
 $meSQL = "SELECT * FROM tb_division ORDER BY position asc";
 $meQuery = $conn->query($meSQL);
 while ($meResult = $meQuery->fetch_assoc()){
 ?> 
            <option value="<?php echo $meResult['id_division'];?>"><?php echo $meResult['name_division'];?></option>
 <?php } ?>
       </select>
      </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="title">หัวข้อ</label>
      <div class="col-sm-9">
	<input type="text" name="title" id="title" placeholder="" class="col-xs-10 col-sm-5" value="" required />
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="people">จำนวนคน</label>
    <div class="col-sm-2">
		<input type="number" name="people" id="people" placeholder="" class="col-xs-10 col-sm-5" value="" required />
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="startdatepicker"> เริ่ม</label>
    <div class="col-sm-2">
	<div class="input-group"> <input class="form-control datepicker" name="startdate" id="startdatepicker" type="text" data-date-format="dd-mm-yyyy" autocomplete="off" required> <span class="input-group-addon" > <i class="fa fa-calendar bigger-110" ></i> </span> </div>
    </div>
	<label class="col-sm-1 control-label no-padding-right" for="starttime"> เวลา </label>
    <div class="col-sm-2">
	<div class="input-group"> <input id="starttime" name="starttime" type="time" class="form-control" required></div>
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="enddatepicker">สิ้นสุด</label>
    <div class="col-sm-2">
	<div class="input-group"> <input class="form-control datepicker" name="enddate" id="enddatepicker" type="text" data-date-format="yyyy-mm-dd" autocomplete="off" required> <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i> </span> </div>
    </div>
	<label class="col-sm-1 control-label no-padding-right" for="endtime"> เวลา </label>
    <div class="col-sm-3">
	<div class="input-group"> <input id="endtime" name="endtime" type="time" class="form-control" required></div>
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="style" required> จัดโต๊ะ </label>
      <div class="col-sm-9">
       <select name="style" id="style">
<?php 
 $meSQL = "SELECT * FROM tb_style ORDER BY position asc";
 $meQuery = $conn->query($meSQL);
 while ($meResult = $meQuery->fetch_assoc()){
 ?> 
            <option value="<?php echo $meResult['id_style'];?>"><?php echo $meResult['name_style'];?></option>
 <?php } ?>
       </select>
      </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" > อุปกรณ์ </label>
      <div class="col-sm-9">
<?php 
 $meSQL = "SELECT * FROM tb_equipment ORDER BY position asc";
 $meQuery = $conn->query($meSQL);
 $i=0;
 while ($meResult = $meQuery->fetch_assoc()){
 ?> 	  
       <input type="checkbox" name="equip[]" value="<?php echo $meResult['id_equipment'];?>">
		<label for="equip[]"><?php echo $meResult['name_equipment'];?></label>&nbsp;&nbsp; &nbsp;&nbsp;
<?php $i++; if ($i == 3)
{echo '<br />';$i=0;} 
} ?>
      </div>
</div> 
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="etc">อื่นๆ </label>
      <div class="col-sm-4">
<textarea class="form-control" id="etc" name="etc" placeholder=""></textarea>
      </div>
</div>
<input type="hidden" name="memberid" value="<?php echo $rs['id_member'];?>" />
<div class="clearfix form-actions">
	<div class="center">
	<button class="btn btn-primary" type="submit">
	<i class="ace-icon fa fa-check bigger-110"></i>
		ยืนยัน
</button>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<button class="btn btn-warning" type="button" onClick="javascript: window.history.back();">
	<i class="ace-icon fa fa-undo bigger-110"></i>
		ยกเลิก
</button>
    </div>
</div>
</form>
				</div>
            </div>	
		</div>
	</div>			
<?php			
include 'templates/footer.php';
$conn->close();
?>
                              