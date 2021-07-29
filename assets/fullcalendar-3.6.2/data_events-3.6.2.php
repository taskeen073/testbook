<?php
include '../../connect.php';
$data = array();
$query = "SELECT * FROM tb_event AS t1 
LEFT JOIN tb_division AS t2 
ON t1.division = t2.id_division 
LEFT JOIN tb_style AS t3
ON t1.style = t3.id_style 
LEFT JOIN tb_rooms AS t4
ON t1.rooms = t4.id_rooms WHERE status = 1";
$query2 = "SELECT * FROM tb_equipment";
$result2 = $conn->query($query2);
$arr = array();
while ($rs = $result2->fetch_array()) {
    $arr[$rs['id_equipment']]= $rs['name_equipment'];
}
//$arr = array("0"=>"","1"=>"โน๊ตบุ๊ค","2"=>"ไมค์ลอย","3"=>"ไมค์คอนเฟอร์เรน",..........");  ผลลัพธ์
/*$query2 = "SELECT * FROM tb_equipment";   แบบที่ 2
$result2 = $conn->query($query2);
$arr = array();
while ($rs = $result2->fetch_array()) {
    $arr[$rs['id_equipment']]= $rs['name_equipment'];
}
function listeq($num){    
global $arr;
	$arr = $arr;
	$watch_return = $arr[$num]; 
  return $watch_return;
}
$var = $obj->equipment;
$arrayex = explode(',', $var);
foreach ($arrayex as $value) {
  $equip .= listeq($value).' ';
}
echo $equip;*/

if ($result = $conn->query($query)) {	
    /* fetch object array */
    while ($obj = $result->fetch_object()) {

       $data[] = array(
                    'id' => $obj->id,
                    'title'=> $obj->title,
                    'start'=> $obj->start,
                    'end'=> $obj->end,
                    'color'=> $obj->color,
                    'division'=> $obj->name_division,
                    'people'=> $obj->people,
                    'style'=> $obj->name_style,
                    'equipment'=> strtr($obj->equipment,$arr),
					'member'=> $obj->member,
					'rooms'=> $obj->name_rooms,
					'etc'=> $obj->etc,
                    );
    }

    /* free result set */
    $result->close();
}
$conn->close();

$data=(isset($data))?$data:NULL;
$json= json_encode($data);  
if(isset($_GET['callback']) && $_GET['callback']!=""){  
echo $_GET['callback']."(".$json.");";      
}else{  
echo $json;  
}
?>