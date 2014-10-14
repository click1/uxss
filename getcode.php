<?php
header("Content-Type:application/json;charset=UTF-8");

$token = $_GET['token'];
$ua = $_SERVER['HTTP_USER_AGENT'];

if(empty($token) || strlen($token) < 10 ){
	echo json_encode(array("status"=>false ,"msg" => "token不正确"));
    exit();
}

$mysql = new SaeMysql();
$sql = "select id,code from result where token ='" . $mysql->escape($token) . "'";

$data = $mysql->getData($sql);
if(!$data){
    
    $code = date("YmdHis")."||".strtoupper(substr(md5("hongcha".date("YmdHis")."android"),1,-1));
    
    $insert_sql = "insert into result (`code`,`token`, `ua`) values ('" .$mysql->escape($code) ."','". $mysql->escape($token). "','". $mysql->escape($ua)  ."')";
    $mysql->runSql($insert_sql);
    if ($mysql->errno() != 0){
    		echo json_encode(array("status" => false, "msg" => "mysql error!"));
   			exit();
    }
}else{
	$code = $data[0]['code'];
}

$mysql->closeDb();

//$code = date("YmdHis")."||".strtoupper(substr(md5("hongcha".date("YmdHis")."android"),1,-1));


echo json_encode(array("status"=> true,"code" => $code));


?>