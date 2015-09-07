
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">總覽</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-eye-slash fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $count_pandan_nerver;?></div>
                                    <div>沒動過！</div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php/pandan/pandanByHost/never">
                            <div class="panel-footer">
                                <span class="pull-left">查看明細</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-eye fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $count_pandan_dnf;?></div>
                                    <div>盤到一半！</div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php/pandan/pandanByHost/dnf">
                            <div class="panel-footer">
                                <span class="pull-left">查看明細</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $count_pandan_done;?></div>
                                    <div>已完成！</div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php/pandan/pandanByHost/done">
                            <div class="panel-footer">
                                <span class="pull-left">查看明細</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                            	
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-group fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $count_pandan_groupuse;?></div>
                                    <div>群組共用</div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php/pandan/pandanByHost/groupuse">
                            <div class="panel-footer">
                                <span class="pull-left">查看明細</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>
            
            
            
            <!-- /.row -->
            <div class="row">
            	<div class="col-lg-12">
                		<div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?php echo $count_pandan_persent;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $count_pandan_persent;?>%">
                                            完成 <?php echo $count_pandan_persent;?>%<span class="sr-only"><?php echo $count_pandan_persent;?>% Complete</span>
                                        </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-newspaper-o fa-fw"></i> 公告訊息 <div class="pull-right"> <button type="button" class="btn btn-default btn-xs glyphicon glyphicon-pencil" data-toggle="modal" data-target="#myModal"></button></div>
                        </div>
                        <!-- /.panel-heading <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal"> </button>-->
                        <div class="panel-body">
                       		<table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="130px">使用者</th>
                                        <th>內容</th>
                                        <th width="200px">時間</th>
                                        <?php if($username ==="admin"):?>
                                        <th width="60px">刪除</th>
                                        <?php endif;?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($news as $new):?>
                                    <tr>
                                        <td><?php echo $new['Name']?></td>
                                        <td><?php echo $new['Text']?></td>
                                        <td><?php echo $new['Createtime']?></td>
                                        <?php if($username === "admin"):?>
                                        <td><a style="color:red;text-decoration:none;" href="<?=base_url()."index.php/news/delete/".$new['NewsID']?>">&#10006;</a></td>
                                        <?php endif;?>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>            
                            </table>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> 完成進度 
                        </div>
                        <div class="panel-body">
                       		<div id="morris-bar-chart"></div>
                            <script>
$(function() {
	$.getJSON("<?=base_url()?>index.php/pages/ajax_complete_bar",function(json){
		console.log(json);
				Morris.Bar({
				element: 'morris-bar-chart',
				data: json,
				xkey: 'Name',
				ykeys: ['done', 'total'],
				labels: ['Done', 'Total'],
				stacked:true,
				hideHover: 'auto',
				xLabelMargin: 1,
				resize: true
			});
		});
    

});
							</script>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                                    </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-envelope fa-fw"></i> 最新五筆訊息
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group" id="homemessage">
                            <script>
								$(function(){
									//$('#homemessage').html('asd');
									$('#homemessage').load('index.php/message/UserMessageHtmlHome/5');
									});
							</script>
                                
                            </div>
                            <!-- /.list-group -->
                            <a href="index.php/message/view" class="btn btn-default btn-block">全部訊息</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    
                    
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->


<!--新增公告頁面-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <?php echo form_open('pages/insert_news')?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">新增公告</h4>
      </div>
      <div class="modal-body">
         <div class="form-group" style="font-size:115%;">
        	 <label for="text" class="control-label">內容：</label>
            <textarea rows="5" class="form-control" id="text" name="text"></textarea>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <input class="btn btn-primary" type="submit" name="submit" value="發布" >
        </form>
      </div>
    </div>
  </div>
</div>