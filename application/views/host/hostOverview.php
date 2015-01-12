<script>
$(function(){
	$('#cloudlist td').click(function(){
		//抓取td列表中的cliudid屬性
		$('#hostCloudDetail').load("<?=base_url()?>index.php/host/viewHostCloudDetail/"+$(this).attr("cloudid"));
	});
	
});


</script>


<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      	<h2>主機總覽 <small>列出受 <?php echo $username;?> 管理的主機</small></h2>
      </div>

      	<div class="row">
        	<div class="col-md-3">
            	<div class="panel panel-default">
            		<div class="panel-heading">
                    <h3>主機群</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover" style="font-size:100%;" id="cloudlist">
                            <tbody>
                            	<?php foreach($hostclouds as $item):?>
                                <tr style="width:100%">
                                    <td cloudid="<?php echo $item['CloudID']?>"><?php echo $item['Name']?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>            
                        </table>
                    </div>
            	</div>
            </div>
            <div class="col-md-9">
            	<div class="panel panel-default">
                <div class="panel-body" id="hostCloudDetail">
            	<h4>請從左方挑選欲檢視的主機群</h4>
                </div>
                </div>
            </div>
        </div>

    </div> <!-- /container -->