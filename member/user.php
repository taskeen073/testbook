<?php 
$title = 'ระบบจองห้องประชุม'; //กำหนดไตเติ้ล
include 'templates/header.php';
include 'connect.php';
?>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php?page=home">Home</a>
							</li>
							<!--<li class="active">Calendar</li>-->
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
<!-- แก้ไข -->
<?php 
		$meSQL = "SELECT * FROM tb_member WHERE id_member='{$_SESSION['id']}' ";
		$meQuery = $conn->query($meSQL);
    if ($meQuery == TRUE) {
        $meResult = $meQuery->fetch_assoc();
    } else {
        echo $conn->error;
    }
    ?>                                                    
<form class="form-horizontal" role="form" name="formregister" method="post" action="member\user_action.php?action=edit">
    <div class="page-header"><h1>แก้ไขข้อมูล&nbsp;&nbsp;<?php echo $meResult['username'];?></h1></div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtUsername" > ชื่อผู้ใช้ </label>
    <div class="col-sm-9">
	<input type="text" name="txtUsername" id="txtUsername" placeholder="Username" class="col-xs-10 col-sm-5" value="<?php echo $meResult['username'];?>" disabled />
    </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtPassword"> รหัสผ่าน </label>
      <div class="col-sm-9">
	<input type="password" name="txtPassword" id="txtPassword" placeholder="Password" class="col-xs-10 col-sm-5" value="<?php echo $meResult['password'];?>" required />
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtConPassword"> ยืนยันรหัสผ่าน </label>
      <div class="col-sm-9">
	<input type="password" name="txtConPassword" id="txtConPassword" placeholder="Password" class="col-xs-10 col-sm-5" value="<?php echo $meResult['password'];?>" required />
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="title"> คำนำหน้า </label>
      <div class="col-sm-9">
       <select name="title" id="title" >
            <option value="นาย" <?php if ($meResult['ntitle'] == 'นาย') {echo 'selected';}?>>นาย</option>
            <option value="นางสาว" <?php if ($meResult['ntitle'] == 'นางสาว') {echo 'selected';}?>>นางสาว</option>
            <option value="นาง" <?php if ($meResult['ntitle'] == 'นาง') {echo 'selected';}?>>นาง</option>
       </select>
      </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtfirstname"> ชื่อ </label>
    <div class="col-sm-9">
	<input type="text"  name="txtfirstname" id="txtfirstname" placeholder="Firstname" class="col-xs-10 col-sm-5" value="<?php echo $meResult['firstname'];?>" required />
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtsurname"> นามสกุล </label>
    <div class="col-sm-9">
	<input type="text"  name="txtsurname" id="txtsurname" placeholder="Surname" class="col-xs-10 col-sm-5" value="<?php echo $meResult['surname'];?>" required />
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="position">ตำแหน่ง</label>
    <div class="col-sm-9">
	<input type="text"  name="position" id="position" placeholder="Position" class="col-xs-10 col-sm-5" value="<?php echo $meResult['position'];?>" required />
    </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="phone">เบอร์โทรศัพท์</label>
    <div class="col-sm-9">
	<input type="text"  name="phone" id="phone" placeholder="Phone" class="col-xs-10 col-sm-5" value="<?php echo $meResult['phone'];?>" required />
    </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtemail"> อีเมลล์ </label>
    <div class="col-sm-9">
	<input type="text"  name="txtemail" id="txtemail" placeholder="Email" class="col-xs-10 col-sm-5" value="<?php echo $meResult['email'];?>" required />
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="status"> ระดับสิทธิ์ </label>
      <div class="col-sm-9">
       <select name="status" disabled>
                <option value="admin" <?php if ($meResult['status'] == 'admin') {echo 'selected';}?>>admin</option>
				<option value="user" <?php if ($meResult['status'] == 'user') {echo 'selected';}?>>user</option>
       </select>
      </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="active"> สถานะ </label>
      <div class="col-sm-9">
       <select name="active" disabled>
            <option value="1" <?php if ($meResult['active'] == '1') {echo 'selected';}?>>ใช้งานได้</option>
            <option value="0" <?php if ($meResult['active'] == '0') {echo 'selected';}?>>รอการยืนยัน</option>
       </select>
      </div>
</div> 
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
	<input type="hidden" name="txtUsername" value="<?php echo $meResult['username'];?>" />
	<input type="hidden" name="status" value="<?php echo $meResult['status'];?>" />
	<input type="hidden" name="active" value="<?php echo $meResult['active'];?>" />
	<input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>" />
</form>                               
				</div>
            </div>						
<?php		
include 'templates/footer.php';
$conn->close();
?>
                              