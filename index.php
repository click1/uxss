<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>uxss测试</title>
        <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
  		<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   		<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <script src="/poc.js"></script>
    </head>
    <body>
        <h2 class="text-center">UXSS 测试</h2>
        <p>
  			<center> <button type="button" class="btn btn-primary btn-lg">正在测试</button></center>
        </p>
        <div class="progress progress-striped active">
   <div class="progress-bar progress-bar-success" role="progressbar" 
      aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" 
      style="width: 0%;">
      <span>0%</span>
   </div>
	</div>
	<hr>
     <div id="testing">
     </div>
     <script>
         
        window.i = 0;			 
        window.total = 6			//payload的个数
var result_view = function(result_arr){
     
    view_html = "";
    all_poc_length = 0;
    all_poc_html = "";
    for(i in poc){
        all_poc_html += "<p>" + poc[i] + "</p>";
    	all_poc_length ++;
    }
    result_arr_length = result_arr.length;
    if(result_arr_length == 0){	//未发现漏洞
        view_html = result_view_html.replace("<bugpoctitle>", "未发现漏洞，详情如下：")
        view_html = view_html.replace("<bugpoccontent>", "使用总共的"+all_poc_length+"个poc测试，未发现漏洞存在");
    }else{			//统计漏洞信息
        tmp_html = "";
        for(i = 0; i< result_arr_length; i++){
            tmp_html += "<p>存在漏洞：" + poc[result_arr[i]] + "</p>";
        }
        view_html = result_view_html.replace("<bugpoctitle>", "发现了"+result_arr_length+"个漏洞，详情如下：");
        view_html = view_html.replace("<bugpoccontent>", tmp_html);
    }
    view_html = view_html.replace("<totoalpoctest>", all_poc_length);
    view_html = view_html.replace("<allpoccontent>", all_poc_html);
    
    result_html  =  $("#testing").html(view_html);
    $(".btn-primary").text("测试完成");
    
}
         
         var result = function(code){	//返回结果
             $.getJSON("/get.php?code=" + code, function(data){
         		 result_arr = new Array();
                 result_html  =  $("#testing").html();
                 result_html += "<p>测试结果:</p>";
                
                 if(data.status == true){
                 	result = data.msg;
                     for(i in result){
                         if (result[i] == 1){	//表示存在问题
                             //result_html += "<p>存在" + i + "漏洞</p>"; 
                              result_arr.push(i);
                         }
                     }
                 }
                 
                 result_view(result_arr);
                 
                 for(j=1; j< 11; j++){		//清空一下iframe
                 	 $("#poc" + j ).attr("src","");
     			 }

             });

         }
         
         var poc_start = function(i, code){
             
             if(i == 1){
             	$("#testing").html("<p>开始测试..............</p>")
             }
             
             if(i == window.total + 1){
             
             	 tmp_html = $("#testing").html();
                 tmp_html += "<p>测试完成..................</p>";
                 $("#testing").html(tmp_html);
                 clearInterval(window.timer);
                 $(".btn-primary").text("统计结果中.....");
                 setTimeout("result(code)", 3000);		//3秒后取结果
                 return;
             }
             
             iframesrc = i + ".php?code=" + code;
             test_html = $("#testing").html();
             test_html += "<p>正在测试 第"+ i + "个payload</p>"
             $("#testing").html(test_html);
                    
             $("#poc" + i ).attr("src","/poc/" + iframesrc)
                    
             progress = i / window.total;
             progress = progress.toFixed(2) * 100 + "%";
            
             $(".progress-bar").attr("style", "width:" + progress);
             $(".progress-bar").text(progress);
             
         }
        var start = function(token){
             $.getJSON("/getcode.php?token=" + token, function(data){
             	
                 if(data.status == true){
                     
                 	code = data.code;
				
                	window.i += 1;
                 	j = window.i
             		poc_start(j, code);
                 }else{
                 	clearInterval(window.timer);
                    alert(data.msg);
                 }
             	
             });
         }
        
        
         $(".btn-primary").click(function(){
             
             //           window.timer = window.setInterval("start('<?php echo substr(md5('wooyun'.md5(time())), 3,10 );?>')", 1000);
            
             
         })   
          window.timer = window.setInterval("start('<?php echo substr(md5('wooyun'.md5(time())), 3,10 );?>')", 1000);
         
     </script>
        <iframe id="poc1" width=0 height=0></iframe>
        <iframe id="poc2" width=0 height=0></iframe>
        <iframe id="poc3" width=0 height=0></iframe>
        <iframe id="poc4" width=0 height=0></iframe>
        <iframe id="poc5" width=0 height=0></iframe>
        <iframe id="poc6" width=0 height=0></iframe>
        <iframe id="poc7" width=0 height=0></iframe>
        <iframe id="poc8" width=0 height=0></iframe>
        <iframe id="poc9" width=0 height=0></iframe>
        <iframe id="poc10" width=0 height=0></iframe>
    </body>
</html>
    