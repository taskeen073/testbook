<?php 
$title = 'ระบบสมาชิก'; 
include 'templates/header.php';
if ($_SESSION['status'] =='admin')  
{
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
                                <li class="active">ระบบสมาชิก</li>
	</li>
        </ul><!-- /.breadcrumb -->
</div>				
<div class="page-header">
<h1><?php echo $org; ?></h1>
</div><!-- /.page-header -->
<div class="main-container ace-save-state" id="main-container">
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content" >
                <div class="row" >
                    <div class="col-xs-12">
<!-- หน้าแรก -->					
<?php if (!isset($_GET['action'])) {
 $meSQL = "SELECT * FROM tb_member ORDER BY id_member asc";
 $meQuery = $conn->query($meSQL);
 ?> 
<p> <a class="btn btn-white btn-primary" href="index.php?page=member&action=add" role="button"><i class="ace-icon glyphicon glyphicon-plus"></i>เพิ่ม</a><p>
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
	<th class="center">ชื่อผู้ใช้</th>
	<th class="center">ชื่อ - นามสกุล</th>
	<th class="center">ตำแหน่ง</th>
	<th class="center">เบอร์โทรศัพท์</th>
	<!--<th class="center">อีเมลล์</th> -->
	<th class="center">ระดับสิทธิ์</th>
	<th class="center">สถานะ</th>
    <th class="center">เข้าระบบล่าสุด</th>
   <!-- <th class="center">วันที่เข้าร่วม</th> -->
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
	<td><?php echo $rs['username']?></td>
	<td><?php 
	$title = $rs['ntitle'];
	$firstname = $rs['firstname'];
	$surname = $rs['surname'];
	echo $title .$firstname .'&nbsp;&nbsp;' .$surname;
    ?></td>
	<td><?php echo $rs['position']?></td>
	<td><?php echo $rs['phone']?></td>
   <!-- <td><?php// echo $rs['email']?></td> -->
	<td class="center"><?php if ($rs['status']=='admin'){echo '<span class="label label-sm label-warning">';} else {echo '<span class="label label-sm label-info">';}?><?=$rs['status']?></span></td>
	<td class="center"><?php $rs['active'];if ($rs['active'] == 1){echo '<i class="ace-icon glyphicon glyphicon-ok"></i>';} else {echo '<i class="ace-icon glyphicon glyphicon-remove"></i>';}?></td>
	<td class="center"><?php $dateLog=$rs['login_date']; echo thai_date_and_time(strtotime($dateLog)).' '.'('.$rs['login_times'].')'; ?></td>
    <!--<td class="center"><?php// $dateData=$rs['create_date']; echo thai_date_and_time(strtotime($dateData)); ?></td>-->
	<td class="center">
	<div class="hidden-sm hidden-xs action-buttons">
	<a class="green" href="index.php?page=member&action=edit&id=<?php echo $rs['id_member']; ?>">
		<i class="ace-icon fa fa-pencil bigger-130" title="แก้ไข"></i>
	</a>

	<a class="red" href="member/action.php?action=delete&id=<?php echo $rs['id_member']; ?>" OnClick="return chkdel();">
		<i class="ace-icon fa fa-trash-o bigger-130" title="ลบ"></i>
	</a>
</div>

<div class="hidden-md hidden-lg">
	<div class="inline pos-rel">
		<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
			<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
		</button>

		<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

			<li>
				<a href="index.php?page=member&action=edit&id=<?php echo $rs['id_member']; ?>" class="tooltip-success" data-rel="tooltip" title="แก้ไข">
					<span class="green">
						<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
					</span>
				</a>
			</li>

			<li>
				<a href="member/action.php?action=delete&id=<?php echo $rs['id_member']; ?>" class="tooltip-error" data-rel="tooltip" title="ลบ" OnClick="return chkdel();">
					<span class="red">
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
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
<!-- เพิ่ม -->
<?php if (isset($_GET['action']) AND $_GET['action']=='add') { ?> 
<form class="form-horizontal" role="form" name="formregister" method="post" action="member\action.php?action=add">
    <div class="page-header"><h1>เพิ่มสมาชิก</h1></div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtUsername"> ชื่อผู้ใช้ </label>
    <div class="col-sm-9">
	<input type="text" name="txtUsername" id="txtUsername" placeholder="Username" class="col-xs-10 col-sm-5" value="" required />
    </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtPassword"> รหัสผ่าน </label>
      <div class="col-sm-9">
	<input type="password" name="txtPassword" id="txtPassword" placeholder="Password" class="col-xs-10 col-sm-5" value="" required />
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtConPassword"> ยืนยันรหัสผ่าน </label>
      <div class="col-sm-9">
	<input type="password" name="txtConPassword" id="txtConPassword" placeholder="Password" class="col-xs-10 col-sm-5" value="" required />
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="title"> คำนำหน้า </label>
      <div class="col-sm-9">
       <select name="title" id="title" >
            <option value="นาย">นาย</option>
            <option value="นางสาว">นางสาว</option>
            <option value="นาง">นาง</option>
       </select>
      </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtfirstname"> ชื่อ </label>
    <div class="col-sm-9">
	<input type="text"  name="txtfirstname" id="txtfirstname" placeholder="Firstname" class="col-xs-10 col-sm-5" value="" required />
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtsurname"> นามสกุล </label>
    <div class="col-sm-9">
	<input type="text"  name="txtsurname" id="txtsurname" placeholder="Surname" class="col-xs-10 col-sm-5" value="" required />
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="position">ตำแหน่ง</label>
    <div class="col-sm-9">
	<input type="text"  name="position" id="position" placeholder="Position" class="col-xs-10 col-sm-5" value="" required />
    </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="phone">เบอร์โทรศัพท์</label>
    <div class="col-sm-9">
	<input type="text"  name="phone" id="phone" placeholder="Phone" class="col-xs-10 col-sm-5" value="" required />
    </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtemail"> อีเมลล์ </label>
    <div class="col-sm-9">
	<input type="text"  name="txtemail" id="txtemail" placeholder="Email" class="col-xs-10 col-sm-5" value="" required />
    </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="status"> ระดับสิทธิ์ </label>
      <div class="col-sm-9">
       <select name="status" id="status" >
            <option value="admin">admin</option>
			<option value="user" selected>user</option>
       </select>
      </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="active"> สถานะ </label>
      <div class="col-sm-9">
       <select name="active" id="active" >
            <option value="1">ใช้งานได้</option>
            <option value="0">รอการยืนยัน</option>
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
</form>
<?php }?>
<!-- แก้ไข -->
<?php if (isset($_GET['action']) AND $_GET['action']=='edit') { 
		$meSQL = "SELECT * FROM tb_member WHERE id_member='{$_GET['id']}' ";
		$meQuery = $conn->query($meSQL);
    if ($meQuery == TRUE) {
        $meResult = $meQuery->fetch_assoc();
    } else {
        echo $conn->error;
    }
    ?>                                                    
<form class="form-horizontal" role="form" name="formregister" method="post" action="member\action.php?action=edit">
    <div class="page-header"><h1>แก้ไขข้อมูล&nbsp;&nbsp;<?php echo $meResult['username'];?></h1></div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="txtUsername"> ชื่อผู้ใช้ </label>
    <div class="col-sm-9">
	<input type="text" name="txtUsername" id="txtUsername" placeholder="Username" class="col-xs-10 col-sm-5" value="<?php echo $meResult['username'];?>" required />
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
       <select name="title" id="title">
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
       <select name="status" id="status" >
                <option value="admin" <?php if ($meResult['status'] == 'admin') {echo 'selected';}?>>admin</option>
	<option value="user" <?php if ($meResult['status'] == 'user') {echo 'selected';}?>>user</option>
       </select>
      </div>
</div>   
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="active"> สถานะ </label>
      <div class="col-sm-9">
       <select name="active" id="active" >
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
  <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
</form>
<?php } ?>                                   
                                        </div>
                                </div>
                        </div>
					</div>
<script language="JavaScript">
function chkdel(){if(confirm('ต้องการลบผู้ใช้นี้หรือไม่'))
    {
	return true;
}else{
	return false;
    }
}
</script>
<?php		
include 'templates/footer.php';
$conn->close();
?>
                              