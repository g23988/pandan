
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">主機總覽<small> 列出受 <?php echo $username;?> 管理的主機</small></h1>
	</div>
</div>


<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-desktop fa-fw"></i> 主機群
		<div class="pull-right"><button type="button" class="btn btn-default btn-xs fa fa-plus" data-toggle="modal" data-target="#addModal" data-whatever="@mdo"></button></div>
	</div>
    <div class="panel-body">
    		<!-- filter-->
            <div class="row">
           		<div class="col-md-6">
             	   <div class="panel panel-default">
                       <div class="panel-body">
                       <label for="filterByLocationSelect" class="control-label">位置：</label>
                       <select class="form-control" name="filterByLocationSelect" id="filterByLocationSelect">
                                    <option value="all" selected="selected">全部</option>
                            <?php foreach($hostcloudlocation as $location):?>
                                    <option value="<?php echo $location['Location']?>"><?php echo $location['Location']?></option>
                            <?php endforeach;?>
                       </select>
                       </div>
            		</div>
                </div>
            	<div class="col-md-6">
             	   <div class="panel panel-default">
                       <div class="panel-body">
						<label for="filterByGroupSelect" class="control-label">機器群：</label>
                        <select class="form-control" name="filterByGroupSelect" id="filterByGroupSelect">
                                    <option value="all" selected="selected">全部</option>
                            <?php foreach($hostclouds as $cloud):?>
                                    <option value="<?php echo $cloud['CloudID']?>" location="<?php echo $cloud['Location'];?>"><?php echo $cloud['Name']?></option>
                            <?php endforeach;?>
                        </select>
                       </div>
            		</div>
            	</div>
            </div>
            <!-- filter end--> 
        <div class="dataTable_wrapper">
            <table id="hosttable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="5%">序號</th>
                        <th width="20%">名稱</th>
                        <th width="20%">主機群</th>
                        <th width="10%">位置</th>
			<th width="25%">保管者</th>
                        <th width="20%">備註</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>序號</th>
                        <th>名稱</th>
                        <th>主機群</th>
                        <th>位置</th>
			<th>保管者</th>
                        <th>備註</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
	//位置選擇後遮蔽連動右方機器群的option
	$('#filterByLocationSelect').change(function(){
		var selectval = $("#filterByLocationSelect").find(":selected").val();
		$("#filterByGroupSelect option").css('display','');
		if(selectval!='all'){
			$("#filterByGroupSelect option[location!="+selectval+"]").css('display','none');
			}
		//位置下拉選擇後改變
		var selecturl = baseHref+"index.php/host/HostLocationJson/"+selectval;
		$('#hosttable').dataTable().api().ajax.url(selecturl).load();
		
		});
	

	
	
	//讀取群名稱ajax
	var baseHref = document.getElementsByTagName('base')[0].href
    var table = $('#hosttable').DataTable( {
        "ajax": baseHref+"index.php/host/HostJson/all",
		"fnDrawCallback":function(settings){
			//$(this).page(2).draw(false);
			//change_page();
			//table.page(2).draw(false);
			//console.log(settings);
		}
    } );
	
	//function change_page(){
	//	table.page(2).draw(false);
	//}
	
	//機器群下拉選擇後改變
	$('#filterByGroupSelect').change(function(){
		var selectval = $("#filterByGroupSelect").find(":selected").val();
		var selecturl = baseHref+"index.php/host/HostJson/"+selectval;
		$('#hosttable').dataTable().api().ajax.url(selecturl).load();
	});	
	
	
	//讀取edit資訊
	$('#hosttable tbody').on( 'click', 'tr', function () {

	   $('#edithostid').val($(this).children('td:eq(0)').html());
	   $.ajax({
			url: "<?=base_url()."index.php/host/getJsonHost/"?>"+$(this).children('td:eq(0)').html(),
			type: "GET",
			dataType: "json",
			async: true,
			contentType: "application/json; charset=utf-8",
			success: function(JData) {
				//打開對話框
				$('#editModal').modal('show');
				$('#edithostname').val(JData["Name"]);
				$('#editremark').val(JData["Remark"]);
				//改變選單選項到目前資料位置
				$("#editsoftwarecloudid").children().each(function(){
				if ($(this).val()==JData["CloudID"]){
					$(this).attr("selected", true); 
					 }
				});
				$("#edituserid").children().each(function(){
				if ($(this).val()==JData["UserID"]){
					$(this).attr("selected", true); 
					 }
				});
				$("#deletehost").attr('href',"<?=base_url()."index.php/host/delete/"?>"+$('#edithostid').val());
				
				},
			error: function() {
							alert("ERROR!!!");
						  }
			}); 
		 
	   
    } );
	
} );
</script>


<!--新增的是窗-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">新增主機</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('host/add') ?>
              <div class="form-group">
                        <label for="hostid" class="control-label">編號：</label>
                        <input type="text" class="form-control" id="hostid" name="hostid" readonly="readonly" value="自動編號"/>
                        <label for="hostname" class="control-label">主機名稱*：</label>
                        <input type="text" class="form-control" id="hostname" name="hostname" />
                        <label for="hostcloudid" class="control-label">主機群*：</label>
                        <select class="form-control" name="hostcloudid" id="hostcloudid">
                            <?php foreach($hostclouds as $cloud):?>
                            <option value="<?php echo $cloud['CloudID']?>"><?php echo $cloud['Name']?></option>
                            <?php endforeach;?>
                        </select>
              
                <hr />

                        <label for="remark" class="control-label">備註：</label>
                        <textarea rows="5" class="form-control" id="remark" name="remark"></textarea>

              </div>

            
          </div>
          	<div class="row">
            	<div class="col-md-9 col-md-offset-1">
                <p class="text-center">
         		   <input class="btn btn-primary" type="submit" name="submit" value="新增" >
          		</p>
                </div>
            </div>
 
          </form>          
    </div>
  </div>
</div>

<!--修改的視窗-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">修改主機群明細</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('host/update')?>
          <div class="form-group">
            <label for="edithostid" class="control-label">編號：</label>
            <input type="text" class="form-control" id="edithostid" name="edithostid"  value="" readonly="readonly"/>
          	<label for="edithostname" class="control-label">主機名稱：</label>
            <input type="text" class="form-control" id="edithostname" name="edithostname" value=""/>
            
            <label for="editsoftwarecloudid" class="control-label">主機群：</label>
            <select class="form-control" name="editsoftwarecloudid" id="editsoftwarecloudid">
            		<?php foreach($hostclouds as $item):?>
                   <option value="<?php echo $item['CloudID']?>"><?php echo $item['Name']?></option>
                   	<?php endforeach;?>
            </select>
            <label for="edituserid" class="control-label">保管者：</label>
            <select class="form-control" name="edituserid" id="edituserid">
            		<?php foreach($users as $item):?>
                   <option value="<?php echo $item['UserID']?>"><?php echo $item['Name']?></option>
                   	<?php endforeach;?>
            </select>
            <br />
            <p class="bg-danger">注意：轉移保管者給【共用】，將會把控制權交給所有人</p>
            <hr />
            <label for="editremark" class="control-label">備註：</label>
            <textarea rows="5" class="form-control" id="editremark" name="editremark"></textarea>
            
          </div>
      </div>
      <div class="modal-footer">
        <a id="deletehost" class="btn btn-danger pull-left" href="">刪除</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <input class="btn btn-primary" type="submit" name="submit" value="送出" >
      </div>
      </form>
    </div>
  </div>
</div>

