<script src="<?=base_url()?>resources/js/Chart.min.js"></script>
<script>
//盤點資料
$(function(){
	//系統通知
	$('#systemnotice').load('<?=base_url()?>index.php/message/showSysnoticeByUser');
	
	//吃派
	$('#piepandancount').load('<?=base_url()?>index.php/message/showPiePandanCountByUser');
	
	});
</script>
<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      	<h2><?php echo $username;?> 個人訊息<br /><small>總覽關於您的事情</small></h2>
      </div>
	<div class="row">
    	<div class="col-md-6">
        	<div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title">系統通知</h3>
               </div>
               <div id="systemnotice" class="panel-body">
                 
                  
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title">盤點資料數量 <span id="pandancounttotal"></span></h3>
               </div>
               <div id="piepandancount" class="panel-body">
                  
                  
               </div>
            </div>
        </div>
        <div class="col-md-6">
        	<div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title">系統通知</h3>
               </div>
               <div class="panel-body">
                  <div id="canvas-holder">
			<canvas id="chart-area" width="300" height="300"/>
		</div><br />
                  
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title">系統通知</h3>
               </div>
               <div class="panel-body">
                  內容<br />
                  
               </div>
            </div>
        </div>
    </div>
    
    
    <div class="row">
    	<div class="col-md-12">
    	<div class="panel panel-default">
        	<div class="panel-heading">
        		<h3 class="panel-title">系統通知</h3>
        	</div>
        	<div class="panel-body">
            	內容<br />
                      
            </div>
        </div>
        </div>
    </div>







    </div> <!-- /container -->
