<?php
header("Content-Type:application/json;charset=UTF-8");
$code = $_GET['code'];

$poc = array(
		"poc_1" => 1,
    	"poc_2" => 2,
    	"poc_3" => 3,
    	"poc_4" => 4,
    	"poc_5" => 5,
    	"poc_6" => 6,
    	"poc_7" => 7,
    	"poc_8" => 8,
    	"poc_9" => 9,
    	"poc_10" => 10
	);


//参数 code验证
if(strpos($code, "||") == false){
	echo json_encode(array("status" => false, "msg" => "error code!"));
    exit();
}


list($key, $value) = explode("||", $code);

if ($value != strtoupper(substr(md5("hongcha". $key ."android"),1,-1)) ){
	echo json_encode(array("status" => false, "msg" => "error code!"));
    exit();
}

$mysql = new SaeMysql();
$sql = "select * from result where code ='" . $mysql->escape($code) . "'";

$data = $mysql->getData($sql);
$result = array();

if($data){
	$tmpdata = $data[0];
    foreach($tmpdata as $key => $value){
        if($key != "code" && $key != "id" && $key != "token" && $key != "ua"){
        	$result[$key] = intval($value);
        }
    }
    echo json_encode(array("status" => true, "msg" => $result));
}else{
	echo json_encode(array("status" => false, "msg" => "query empty!"));
}
$mysql->closeDb();
 
?>