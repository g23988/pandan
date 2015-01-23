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
    	<div class="panel panel-info">
        <div class="panel-heading">
        <h4><span id="title">正在執行複製作業 </span><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span></h4>
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
                    <div class="panel-heading">取得軟體資訊模型
                    </div>
                    <div id="getOldSoftwareInfoDetail" class="panel-body">
                    等待...
                    </div>
				</div>
            </div>
            <div class="col-md-2">
            	<div id="resetSoftwareInfo" class="panel panel-default">
                    <div class="panel-heading">重塑軟體資訊模型
                    </div>
                    <div id="resetSoftwareInfoDetail" class="panel-body">
                    等待...
                    </div>
				</div>
            </div>
            <div class="col-md-2">
            	<div id="getOldDataInfo" class="panel panel-default">
                    <div class="panel-heading">取得資料資訊模型
                    </div>
                    <div id="getOldDataInfoDetail" class="panel-body">
                    等待...
                    </div>
				</div>
            </div>
            <div class="col-md-2">
            	<div id="resetDataInfo" class="panel panel-default">
                    <div class="panel-heading">重塑資料資訊模型
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
<p class="text-center"><span id="checkBtn" class="btn btn-lg btn-default" style="display:none;"><span class="glyphicon glyphicon-ok"></span> 確認完成</span></p>
</div>
<script>
//setInterval(function(){
//   	 $('#test').append('a<br>');
//	}, 2000);
$(function(){
	
	var newhostname = '<?php echo $newhostname?>';
	var oldhostid = '<?php echo $oldhostid?>';
	setTimeout(function(){
    	$('#getOldHostInfoDetail').load('<?=base_url()?>/index.php/clonehost/getHostByHostID/'+newhostname+'/'+oldhostid,'',function(){
			$('#getOldHostInfo').removeClass('panel-default').addClass('panel-success');
			$('#resetHostInfoDetail').html('工作中...');
			$('#progressbar').css('width','17%');
		});
		
	}, 2000);
	setTimeout(function(){
    	$('#resetHostInfoDetail').load('<?=base_url()?>/index.php/clonehost/test','',function(){
			$('#resetHostInfo').removeClass('panel-default').addClass('panel-success');
			$('#getOldSoftwareInfoDetail').html('工作中...');
			$('#progressbar').css('width','34%');
			});

	}, 4000);
	setTimeout(function(){
    	$('#getOldSoftwareInfoDetail').load('<?=base_url()?>/index.php/clonehost/test','',function(){
			$('#getOldSoftwareInfo').removeClass('panel-default').addClass('panel-success');
			$('#resetSoftwareInfoDetail').html('工作中...');
			$('#progressbar').css('width','51%');
			});

	}, 6000);
	setTimeout(function(){
    	$('#resetSoftwareInfoDetail').load('<?=base_url()?>/index.php/clonehost/test','',function(){
			$('#resetSoftwareInfo').removeClass('panel-default').addClass('panel-success');
			$('#getOldDataInfoDetail').html('工作中...');
			$('#progressbar').css('width','68%');
			});

	}, 8000);
	setTimeout(function(){
    	$('#getOldDataInfoDetail').load('<?=base_url()?>/index.php/clonehost/test','',function(){
			$('#getOldDataInfo').removeClass('panel-default').addClass('panel-success');
			$('#resetDataInfoDetail').html('工作中...');
			$('#progressbar').css('width','85%');
			});

	}, 10000);
	setTimeout(function(){
    	$('#resetDataInfoDetail').load('<?=base_url()?>/index.php/clonehost/test','',function(){
			$('#resetDataInfo').removeClass('panel-default').addClass('panel-success');
			$('#progressbar').css('width','100%');
			$('#checkBtn').css('display','');
			$('.glyphicon-refresh-animate').css('display','none');
			$('#progressbar').removeClass('active');
			$('#title').html('作業完成！');
			});

	}, 12000);
	
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
