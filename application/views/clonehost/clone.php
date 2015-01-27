 <!doctype html>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Pandan</title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>resources/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>resources/css/sticky-footer-navbar.css" rel="stylesheet">
     <script src="<?=base_url()?>resources/js/jquery.min.js"></script>
    <script src="<?=base_url()?>resources/js/bootstrap.min.js"></script>
<style>


.glyphicon-refresh-animate {
    -animation: spin 1s infinite linear;
    -webkit-animation: spin2 1s infinite linear;
}

@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}

@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
</style>
</head>
<body>
<div class="container">
<div class="row">
	<div class="col-md-12">
    	<div id="showallinfo" class="panel panel-info">
        <div class="panel-heading">
        <h4><span id="title">正在執行複製作業，請勿重複刷新本頁 </span><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span></h4>
        </div>
        <div class="panel-body">
        <div class="progress">
          <div id="progressbar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 1%">
            <span class="sr-only">45% Complete</span>
          </div>
        </div>
        <div class="row">
        	<div class="col-md-2">
            	<div id="getOldHostInfo" class="panel panel-default">
                    <div class="panel-heading">取得機器模型
                    </div>
                    <div id="getOldHostInfoDetail" class="panel-body">
                    工作中...
                    </div>
				</div>
            </div>
            <div class="col-md-2">
            	<div id="resetHostInfo" class="panel panel-default">
                    <div class="panel-heading">重塑機器模型
                    </div>
                    <div id="resetHostInfoDetail" class="panel-body">
                    等待...
                    </div>
				</div>
            </div>
            <div class="col-md-2">
            	<div id="getOldSoftwareInfo" class="panel panel-default">
                    <div class="panel-heading">收集軟體資訊
                    </div>
                    <div id="getOldSoftwareInfoDetail" class="panel-body">
                    等待...
                    </div>
				</div>
            </div>
            <div class="col-md-2">
            	<div id="resetSoftwareInfo" class="panel panel-default">
                    <div class="panel-heading">複製軟體資訊
                    </div>
                    <div id="resetSoftwareInfoDetail" class="panel-body">
                    等待...
                    </div>
				</div>
            </div>
            <div class="col-md-2">
            	<div id="getOldDataInfo" class="panel panel-default">
                    <div class="panel-heading">收集資料資訊
                    </div>
                    <div id="getOldDataInfoDetail" class="panel-body">
                    等待...
                    </div>
				</div>
            </div>
            <div class="col-md-2">
            	<div id="resetDataInfo" class="panel panel-default">
                    <div class="panel-heading">複製資料資訊
                    </div>
                    <div id="resetDataInfoDetail" class="panel-body">
                    等待...
                    </div>
				</div>
            </div>
        </div>
        	
        
        </div>
    </div>
</div>
<p class="text-center"><a id="checkBtn" class="btn btn-lg btn-default" style="display:none;"><span class="glyphicon glyphicon-ok"></span> 確認完成</a></p>
<p class="text-center"><a href="<?=base_url()?>index.php/pandan/view/<?php echo $oldhostid?>" id="failBtn" class="btn btn-lg btn-danger" style="display:none;"><span class="glyphicon glyphicon-remove"></span> 失敗了</a></p>
</div>
<script>
//setInterval(function(){
//   	 $('#test').append('a<br>');
//	}, 2000);
$(function(){
	
	var newhostname = '<?php echo urldecode($newhostname)?>';
	var newhostid ;
	var oldhostid = '<?php echo $oldhostid?>';
	setTimeout(function(){
			//第一步驟，得到資訊
			$.ajax({
						  url: "<?=base_url()?>index.php/clonehost/cloneHostByHostID/"+newhostname+"/"+oldhostid,
						  type: "GET",
						  dataType: "json",
						  contentType: "application/json; charset=utf-8",
						  success: function(JData) {
							  
							  if(JData==""||JData==null){
								  fail("機器名稱重複！");
								  $("#getOldHostInfoDetail").html('').append('機器名稱重複');
								  $('#getOldHostInfo').removeClass('panel-default').addClass('panel-danger');
								  return;
								  }
							  else{
								  $("#getOldHostInfoDetail").html('').append('HostID：'+JData["HostID"]);
								  $("#getOldHostInfoDetail").append('<br>').append('Name：'+JData["Name"]);
								  //調整viewbar
								$('#getOldHostInfo').removeClass('panel-default').addClass('panel-success');
								$('#resetHostInfoDetail').html('工作中...');
						    	$('#progressbar').css('width','17%');

								//等待兩秒 執行重塑機器模型
								setTimeout(function(){resetHostInfo()},1000);
								  }
							  
											  },
						  error: function() {
							fail("失敗！請立刻聯絡系統管理員處理垃圾資料！");
						  }
					}); 
		
	}, 1000);
	
	//重塑機器模型
	function resetHostInfo(){
			//第二步驟，重塑insert資訊
			$.ajax({
						  url: "<?=base_url()?>index.php/clonehost/resetcloneHost/"+newhostname+"/"+oldhostid,
						  type: "GET",
						  dataType: "json",
						  contentType: "application/json; charset=utf-8",
						  success: function(JData) {

							  $("#resetHostInfoDetail").html('').append('HostID：'+JData["HostID"]);
							  //重設目標newhostid
							  newhostid = JData["HostID"];
							  $("#resetHostInfoDetail").append('<br>').append('Name：'+JData["Name"]);
							  //調整viewbar
								$('#resetHostInfo').removeClass('panel-default').addClass('panel-success');
								$('#getOldSoftwareInfoDetail').html('工作中...');
						    	$('#progressbar').css('width','34%');
								//等待兩秒 執行取得軟體資料模型
								setTimeout(function(){getOldSoftwareInfo()},1000);
											  },
						  error: function() {
							fail("失敗！請立刻聯絡系統管理員處理垃圾資料！");
						  }
					}); 
		}
	
	//取得軟體資料模型
	function getOldSoftwareInfo(){
			//第三步驟，取得軟體by oldhostid
			$.ajax({
						  url: "<?=base_url()?>index.php/clonehost/cloneSoftwareByHostID/"+newhostid+"/"+oldhostid,
						  type: "GET",
						  dataType: "json",
						  contentType: "application/json; charset=utf-8",
						  success: function(JData) { 
						  		//檢查是否為空值
							  if(JData==""||JData==null){
								  $("#getOldSoftwareInfoDetail").html('').append('筆數：0');
								  }
							  else{
								  $("#getOldSoftwareInfoDetail").html('').append('筆數：'+JData.length);
								  }
							  //調整viewbar
								$('#getOldSoftwareInfo').removeClass('panel-default').addClass('panel-success');
								$('#resetSoftwareInfoDetail').html('工作中...');
						    	$('#progressbar').css('width','51%');
								//等待兩秒 執行resetSoftwareInfo
								setTimeout(function(){resetSoftwareInfo()},1000);
											  },
						  error: function() {
							fail("失敗！請立刻聯絡系統管理員處理垃圾資料！");
						  }
					}); 
		
		
		}
	
	function resetSoftwareInfo(){
			//第四步驟，INSERT軟體by oldhostid
			$.ajax({
						  url: "<?=base_url()?>index.php/clonehost/setnewsoftwarepath/"+newhostid+"/"+oldhostid,
						  type: "GET",
						  dataType: "json",
						  contentType: "application/json; charset=utf-8",
						  success: function(JData) { //
								if(JData==""||JData==null){
									$("#resetSoftwareInfoDetail").html('').append('筆數：0');
								}
								else{
									$("#resetSoftwareInfoDetail").html('').append('筆數：'+JData.length);
									}
							  
							  //調整viewbar
								$('#resetSoftwareInfo').removeClass('panel-default').addClass('panel-success');
								$('#getOldDataInfoDetail').html('工作中...');
						    	$('#progressbar').css('width','68%');
								//等待兩秒
								setTimeout(function(){getOldDataInfo()},1000);
											  },
						  error: function() {
							fail("失敗！請立刻聯絡系統管理員處理垃圾資料！");
						  }
					}); 
		
		
		}
	
	//取得資料資訊模型
	function getOldDataInfo(){
			//第五步驟，取得資料by oldhostid
			$.ajax({
						  url: "<?=base_url()?>index.php/clonehost/cloneDataByHostID/"+newhostid+"/"+oldhostid,
						  type: "GET",
						  dataType: "json",
						  contentType: "application/json; charset=utf-8",
						  success: function(JData) { 
						  if(JData==""||JData==null){$("#getOldDataInfoDetail").html('').append('筆數：0');}
						  else{$("#getOldDataInfoDetail").html('').append('筆數：'+JData.length);}
							  
							  //調整viewbar
								$('#getOldDataInfo').removeClass('panel-default').addClass('panel-success');
								$('#resetDataInfoDetail').html('工作中...');
						    	$('#progressbar').css('width','85%');
								//等待兩秒 執行resetSoftwareInfo
								setTimeout(function(){resetDataInfo()},1000);
											  },
						  error: function() {
							fail("失敗！請立刻聯絡系統管理員處理垃圾資料！");
						  }
					}); 
		
		
		}
		
	function resetDataInfo(){
			//第六步驟，INSERT軟體by oldhostid
			$.ajax({
						  url: "<?=base_url()?>index.php/clonehost/setnewdatapath/"+newhostid+"/"+oldhostid,
						  type: "GET",
						  dataType: "json",
						  contentType: "application/json; charset=utf-8",
						  success: function(JData) { 
						  if(JData==""||JData==null){$("#resetDataInfoDetail").html('').append('筆數：0');}
						  else{$("#resetDataInfoDetail").html('').append('筆數：'+JData.length);}
							  //調整viewbar
								$('#resetDataInfo').removeClass('panel-default').addClass('panel-success');
						    	$('#progressbar').css('width','100%');
								
								
								$('#checkBtn').css('display','').attr('href','<?=base_url()?>index.php/pandan/view/'+newhostid);
								$('.glyphicon-refresh-animate').css('display','none');
								$('#progressbar').removeClass('active');
								$('#title').html('作業完成！');
											  },
						  error: function() {
							fail("失敗！請立刻聯絡系統管理員處理垃圾資料！");
						  }
					}); 
		
		
		}
		
	/*
	setTimeout(function(){
    	$('#getOldDataInfoDetail').load('/index.php/clonehost/test','',function(){
			$('#getOldDataInfo').removeClass('panel-default').addClass('panel-success');
			$('#resetDataInfoDetail').html('工作中...');
			$('#progressbar').css('width','85%');
			});

	}, 10000);
	setTimeout(function(){
    	$('#resetDataInfoDetail').load('/index.php/clonehost/test','',function(){
			$('#resetDataInfo').removeClass('panel-default').addClass('panel-success');
			$('#progressbar').css('width','100%');
			
			

			});

	}, 12000);
	*/
	//失敗跳這邊
	function fail(AL){
			$('.glyphicon-refresh-animate').css('display','none');
			$('#progressbar').removeClass('active');
			$('#showallinfo').removeClass('panel-info').addClass('panel-danger');
			$('#title').html(AL);
			//打開失敗按鈕
			$('#failBtn').css('display','');
		}

	
	
	
	});


</script>
</div>
<footer class="footer">
      <div class="container">
        <p class="text-muted credit"> Copyright © 2014 e104 Inc. All rights reserved ， 程式維護 【 系統工程課  <a href="mailto:wei.liu@e104.com.tw">Wei Liu</a> 】</p>
      </div>
</footer>

</body>

</html>
