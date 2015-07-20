<script>
$(function(){
	$('#cloudlist td').click(function(){
		//抓取td列表中的cliudid屬性
		$('#hostCloudDetail').load("<?=base_url()?>index.php/host/viewHostCloudDetail/"+$(this).attr("cloudid"));
	});
	
});


</script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">主機總覽<small> 列出受 <?php echo $username;?> 管理的主機</small></h1>
	</div>
</div>


      	<div class="row">
        	<div class="col-md-3">
            	<div class="panel panel-default">
            		<div class="panel-heading">
                    <h4>主機群</h4>
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
