<?php 
$title = 'ห้องประชุม'; //กำหนดไตเติ้ล
include 'templates/header.php';
if ($_SESSION['status'] =='admin')  
{
include 'connect.php';
include 'function.php';
} else {
    echo "<script>alert('คุณไม่มีสิทธิในการเข้าถึง!'); window.location ='index.php';</script>";
}
?>
<style>
.inputcolor {
      padding: 0px !important;
}
</style>
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
<?php if ($_GET['action']=='') {?> 
<p> <a class="btn btn-white btn-primary" href="index.php?page=setrooms&action=add" role="button"><i class="ace-icon glyphicon glyphicon-plus"></i>เพิ่ม</a><p>
<div class="table-header">
<?php echo $title; ?>
</div>                    
        <!-- div.table-responsive -->
		<!-- div.dataTables_borderWrap -->
		<div class="table-responsive">
		<div id="msg"></div>
<table id="dynamic-table" class="table table-striped table-bordered table-hover" >  
<thead>
  <tr>
	<th width="20">เลื่อน</th>
    <th class="center">ลำดับ</th>
	<th class="center">รูปภาพ</th>
	<th class="center">ชื่อห้อง</th>
	<th class="center">จำนวนคน</th>
	<th class="center">รายละเอียด</th>
	<th class="center">สีแจ้งเตือน</th>
	<th class="center">จัดการ</th>
  </tr>
</thead>
<tbody id="sortable">
<?php
$i=1 ;
$meSQL = "SELECT * FROM tb_rooms ORDER BY position asc";
$meQuery = $conn->query($meSQL);
while ($rs = $meQuery->fetch_assoc()){
?>
  <tr data-sort-id="<?php echo $rs['id_rooms']; ?>">
	<td class="center"><i class="fa fa-fw fa-arrows-alt" data-toggle="tooltip" title="Grag up or down"></i></td>
    <td class="center"><?php echo $i++; ?></td>
	<td class="center ace-thumbnails clearfix"><p><a href="images/<?php echo $rs['image_rooms']?>" data-rel="colorbox"><img src="images/<?php echo $rs['image_rooms']?>" alt="รูปภาพ" style="width:120px;height:100px;border: 1px solid #9e9e9e"></p></td>
	<td class="center"><?php echo $rs['name_rooms']?></td>
    <td class="center"><?php echo $rs['people_rooms']?></td>
	<td><pre style="padding: 1px;border: 0px;background-color: transparent !important;"><?php echo $rs['detail_rooms']?></pre></td>
	<td class="center"><div style="background-color:<?php echo $rs['color_rooms']?>;">&nbsp;</div></td>
	<td class="center">
	
	<div class="hidden-sm hidden-xs action-buttons">
	<a class="green" href="index.php?page=setrooms&action=edit&id=<?php echo $rs['id_rooms']; ?>">
		<i class="ace-icon fa fa-pencil bigger-130" title="แก้ไข"></i>
	</a>

	<a class="red" href="rooms/action.php?action=delete&id=<?php echo $rs['id_rooms']; ?>&image=<?php echo $rs['image_rooms']; ?>" OnClick="return chkdel();">
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
				<a href="index.php?page=setrooms&action=edit&id=<?php echo $rs['id_rooms']; ?>" class="tooltip-success" data-rel="tooltip" title="แก้ไข">
					<span class="green">
						<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
					</span>
				</a>
			</li>

			<li>
				<a href="rooms/action.php?action=delete&id=<?php echo $rs['id_rooms']; ?>&image=<?php echo $rs['image_rooms']; ?>" class="tooltip-error" data-rel="tooltip" title="ลบ" OnClick="return chkdel();">
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
<?php if ($_GET['action']=='add') {?> 
<form class="form-horizontal" role="form" name="formregister" method="post" action="rooms\action.php?action=add" enctype="multipart/form-data">
    <div class="page-header"><h1>เพิ่มห้องประชุม</h1></div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="Upload">รูปภาพ</label>
    <div class="col-sm-9"> <img id="imgAvatar" src="images/noimages.png" style="width:270px;height:180px;"><p></p>	
			<input type="file" name="Upload" id="Upload" OnChange="showPreview(this)" accept="image/*" value="" > </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="Name"> ชื่อห้อง </label>
      <div class="col-sm-9">
	<input type="text" name="Name" id="Name" placeholder="" class="col-xs-10 col-sm-5" value="" required />
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="People"> จำนวนคน </label>
      <div class="col-sm-9">
	<input type="number" name="People" id="People" placeholder="" class="col-xs-10 col-sm-5" value="" required />
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="Detail"> รายละเอียด </label>
      <div class="col-sm-4">
<textarea class="form-control" id="Detail" name="Detail" placeholder=""></textarea>
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="Color">สีแจ้งเตือน</label>
      <div class="col-sm-9">
<input type="color" name="Color" id="Color" class="inputcolor" value="" required />
      </div>
</div>
<div class="clearfix form-actions">
	<div class="col-md-offset-3 col-md-9">
	<button class="btn btn-primary" type="submit">
	<i class="ace-icon fa fa-check bigger-110"></i>
		ยืนยัน
</button>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<button class="btn btn-warning" type="button" onClick="javascript: window.history.back();">
	<i class="ace-icon fa fa-undo bigger-110"></i>
		ยกเลิก
</button>
    </div>
</div>
</form>
<?php }?>
<!-- แก้ไข -->
<?php if ($_GET['action']=='edit') { 
		$meSQL = "SELECT * FROM tb_rooms WHERE id_rooms ='{$_GET['id']}' ";
		$meQuery = $conn->query($meSQL);
    if ($meQuery == TRUE) {
        $meResult = $meQuery->fetch_assoc();
    } else {
        echo $conn->error;
    }
    ?>            
<form class="form-horizontal" role="form" name="formregister" method="post" action="rooms\action.php?action=edit" enctype="multipart/form-data">
    <div class="page-header"><h1>แก้ไขห้องประชุม</h1></div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="Upload">รูปภาพ</label>
    <div class="col-sm-9"> <img id="imgAvatar" src="images/<?php echo $meResult['image_rooms'];?>" style="width:270px;height:180px;"><p></p>	
			<input type="file" name="Upload" id="Upload" OnChange="showPreview(this)" accept="image/*" value="<?php echo $meResult['image_rooms'];?>" > </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="Name"> ชื่อห้อง </label>
      <div class="col-sm-9">
	<input type="text" name="Name" id="Name" placeholder="" class="col-xs-10 col-sm-5" value="<?php echo $meResult['name_rooms'];?>" required />
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="People"> จำนวนคน </label>
      <div class="col-sm-9">
	<input type="number" name="People" id="People" placeholder="" class="col-xs-10 col-sm-5" value="<?php echo $meResult['people_rooms'];?>" required />
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="Detail"> รายละเอียด </label>
      <div class="col-sm-4">
<textarea class="form-control" id="Detail" name="Detail" placeholder=""><?php echo $meResult['detail_rooms'];?></textarea>
      </div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="Color">สีแจ้งเตือน</label>
      <div class="col-sm-9">
<input type="color" name="Color" id="Color" class="inputcolor" value="<?php echo $meResult['color_rooms'];?>" required />
      </div>
</div>
<div class="clearfix form-actions">
	<div class="col-md-offset-3 col-md-9">
	<button class="btn btn-primary" type="submit">
	<i class="ace-icon fa fa-check bigger-110"></i>
		ยืนยัน
</button>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<button class="btn btn-warning" type="button" onClick="javascript: window.history.back();">
	<i class="ace-icon fa fa-undo bigger-110"></i>
		ยกเลิก
</button>
    </div>
</div>
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
<input type="hidden" name="hdnOldFile" value="<?php echo $meResult['image_rooms'];?>">
</form>
<?php }?>
				</div>
            </div>	
		</div>
	</div>
<script type="text/javascript">
	function showPreview(ele)
	{
			$('#imgAvatar').attr('src', ele.value); // for IE
            if (ele.files && ele.files[0]) {
			
                var reader = new FileReader();
				
                reader.onload = function (e) {
                    $('#imgAvatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(ele.files[0]);
            }
	}
</script>
<script language="JavaScript">
function chkdel(){if(confirm('ต้องการลบหรือไม่')){
	return true;
}else{
	return false;
}
}
</script>			
<?php		
$path = 'rooms';
include 'templates/footer.php';
$conn->close();
?>
                              