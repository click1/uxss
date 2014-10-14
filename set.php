<?php
header("Content-Type:application/json;charset=UTF-8");
$code = $_GET['code'];
$ua = $_SERVER['HTTP_USER_AGENT'];
$poc = array(
		1=> "poc_1",
    	2=> "poc_2",
    	3 => "poc_3",
    	4 => "poc_4",
    	5 => "poc_5",
    	6 => "poc_6",
    	7 => "poc_7",
    	8 =>"poc_8"
	);

$poc_suc = $_GET['suc'];
//参数 suc判断
if(!array_key_exists($poc_suc, $poc)){
	echo json_encode(array("status" => false, "msg" => "error suc!"));
    exit();
}   

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

$id = 0;

$mysql = new SaeMysql();
$sql = "select id from result where code ='" . $mysql->escape($code) . "'";

$data = $mysql->getData($sql);

if(!$data){
    //   	$insert_sql = "insert into result (`code`, `ua`) values ('" .$mysql->escape($code) . "','". $mysql->escape($ua)  ."')";
    //$mysql->runSql($insert_sql);
    //if ($mysql->errno() != 0){
    //		echo json_encode(array("status" => false, "msg" => "mysql error!"));
    //		exit();
    //}
    //$id = $mysql->lastId();
    echo json_encode(array("status" => false, "msg" => "请刷新后重试!"));
    exit();
}else{
	$id = intval($data[0]["id"]);
}

$update_sql = "update result set $poc[$poc_suc] = 1 where id = {$id} and code ='" . $mysql->escape($code). "'";
$mysql->runSql($update_sql);
if($mysql->error() != 0){
	    echo json_encode(array("status" => false, "msg" => "update error!"));
   		exit();
}

$mysql->closeDb();

echo json_encode(array("status" => true, "msg" => "update success!"));
exit();

?>