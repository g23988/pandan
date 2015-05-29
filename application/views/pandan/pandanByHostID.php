<?php
function echoLabel($flag){
	switch($flag){
		case 0:
			echo '<span class="btn btn-danger btn-sm dropdown-toggle" id="dropdownflag" data-toggle="dropdown">Never</span>';
			break;
		case 1:
			echo '<span class="btn btn-warning btn-sm dropdown-toggle" id="dropdownflag" data-toggle="dropdown">DNF</span>';
			break;
		case 2:
			echo '<span class="btn btn-success btn-sm dropdown-toggle" id="dropdownflag" data-toggle="dropdown">Done</span>';
			break;
		}
	}
?>
<script>
$(function () {
  $('[data-toggle="popover"]').popover();
  //設定flag
  $("#chageflag0").click(function(){
	  $.ajax({url:"<?php echo base_url().'index.php/pandan/chageFlag/'.$hostdetail["HostID"].'/0'?>",async:false});
	  $("#dropdownflag").removeClass('btn-warning btn-success btn-danger').addClass('btn-danger').text('Never');
	  });
  $("#chageflag1").click(function(){
	  $.ajax({url:"<?php echo base_url().'index.php/pandan/chageFlag/'.$hostdetail["HostID"].'/1'?>",async:false});
	  $("#dropdownflag").removeClass('btn-warning btn-success btn-danger').addClass('btn-warning').text('DNF');
	  });
  $("#chageflag2").click(function(){
	  $.ajax({url:"<?php echo base_url().'index.php/pandan/chageFlag/'.$hostdetail["HostID"].'/2'?>",async:false});
	  $("#dropdownflag").removeClass('btn-warning btn-success btn-danger').addClass('btn-success').text('Done');
	  });
	//修改備註
	$('#editRemarkbtn').click(function(){
		$('#editRemark').modal('show');
		});
})
</script>

      <!-- Main component for a primary marketing message or call to action -->
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $hostdetail["hostname"] ?> </h1>
                </div>
                <!-- /.col-lg-12 -->
 	  </div>
        <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
            	<div class="panel-heading">
                <button id="editRemarkbtn" class="glyphicon glyphicon-pencil btn btn-sm btn-default"></button>
                </div>
                <div class="panel-body">
                <?php echo $hostdetail["Remark"]?>
                </div>
            </div>
            <p class="pull-left"><a class="btn btn-default btn-md dropdown-toggle" href="<?=base_url()."index.php/pandan/view/".$hostdetail["HostID"]?>">刷新此面</a></p>
            <p class="pull-right"><a class="btn btn-default btn-md dropdown-toggle" href="<?=base_url()."index.php/pandan/pandanByHost"?>">回機器列表</a></p>
        </div>
        
      	<div class="col-md-8">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                <h4>詳細資訊</h4> 
                </div>
                <div class="panel-body">
                
                 <table class="table table-striped" style="font-size:100%;">
                    <tbody>
                    	<tr>
                            <td style="width:50%;">主機群</td>
                            <td style="width:50%;"><?php echo $hostdetail["CloudName"] ?></td>
                        </tr>
						
                        <tr>
                            <td>保管者</td>
                            <td><?php echo $hostdetail["username"]?></td>
                        </tr>
                        <tr>
                        	<td>盤點狀態</td>
                            <td>
							<div class="dropdown">
                            <?php echoLabel($hostdetail["flag"])?>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownflag">
                              <li role="presentation">
                                 <a id="chageflag0" role="menuitem" tabindex="-1">未完成 <span class="label label-danger" >Never</span> </a>
                              </li>
                              <li role="presentation">
                                 <a id="chageflag1" role="menuitem" tabindex="-1">檢查中 <span class="label label-warning">DNF</span></a>
                              </li>
                              <li role="presentation">
                                 <a id="chageflag2" role="menuitem" tabindex="-1">已完成 <span class="label label-success">Done</span></a>
                              </li>
                           </ul>
                            </div>
                            </td>
                        </tr>
                        <?php if($hostdetail["username"]==$userinfo['Name']||$userinfo['Account']=='admin'):?>
                        <tr>
                        	<td>
                            <input id="cloneHostname" type="text" style="width:100%;display:none;" value="<?php echo $hostdetail["hostname"]."_clone"?>" data-toggle="tooltip" data-placement="bottom" title="輸入新的主機名稱"/>	
                            <select  class="form-control" id="transUsername" name="user" style="width:100%;display:none;">
								<?php foreach($users as $item):?>
                                	<?php if($userinfo['Account']=='admin'):?>
                                    <option value="<?php echo $item['UserID']?>"><?php echo $item['Name']?> ( <?php echo $item['Nickname']?> )</option>
                                	<?php elseif($item['UserID']=='1'):?>
                                    <option value="<?php echo $item['UserID']?>"><?php echo $item['Name']?> ( <?php echo $item['Nickname']?> )</option>
                                    <?php elseif($item['GroupID']==$userinfo['GroupID']):?>
                                    <option value="<?php echo $item['UserID']?>"><?php echo $item['Name']?> ( <?php echo $item['Nickname']?> )</option>
                                    <?php endif;?>
                                <?php endforeach?>
                            </select>
                            <!--
                            <input id="transUsername" type="text" style="width:100%;display:none;" value="<?php echo $hostdetail["hostname"]."_clone"?>" data-toggle="tooltip" data-placement="bottom" title="輸入新的主機名稱"/>	-->
                            </td>
                            <td>
                            <span id="clonelock" class="btn btn-primary btn-sm glyphicon glyphicon-new-window" aria-hidden="true"  data-toggle="tooltip" data-placement="bottom" title="完整複製整台資料並更名"> 複製</span>
                            <span id="cloneopen" class="btn btn-success btn-sm glyphicon glyphicon-share" aria-hidden="true" style="display:none;" data-toggle="tooltip" data-placement="right" title="複製途中請勿關閉瀏覽器"> 複製</span>
                        	<span id="translock" class="btn btn-primary btn-sm glyphicon glyphicon-random" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="轉移給同使用者群內的成員"> 轉移</span>
                            <span id="transopen" class="btn btn-success btn-sm glyphicon glyphicon-gift" aria-hidden="true" style="display:none;" data-toggle="tooltip" data-placement="right" title="屬於原管理者的資料將會一併轉移"> 轉移</span>
                            </td>
						</tr>
                        <?php endif;?>
                            
                            
                    </tbody>            
                </table>
                    
                <script>
					$(function(){
						$('[data-toggle="tooltip"]').tooltip();
						//解鎖複製
						$('#clonelock').click(function(){
							$('#clonelock').css('display','none');
							$('#cloneopen').css('display','');
							$('#cloneHostname').css('display','');
							$('#translock').css('display','none');
							});
						$('#cloneopen').click(function(){
							var url = '<?=base_url()."index.php/clonehost/showClonePage/"?>'+$('#cloneHostname').val()+'/'+'<?php echo $hostdetail["HostID"]?>';
							window.location = url;
							});
						//解鎖轉移
						$('#translock').click(function(){
							//計算移動距離
							var a = $('#translock').offset().left;
							var b = $('#clonelock').offset().left;
							var movelen = a - b;
							$('#translock').css('display','none');
							$('#transopen').css('display','').animate({"right":movelen},500);
							$('#transUsername').css('display','');
							});
						$('#transopen').click(function(){
							var url = '<?=base_url()."index.php/pandan/transkeeper/"?>'+$('#transUsername').val()+'/'+'<?php echo $hostdetail["HostID"]?>';
							window.location = url;
							});
						});
				</script>
                </div>
            </div>
        </div>
      </div>
      



      <script>
	  $(function(){
		  $('#hostSoftwareDetail div table tbody tr').click(function(){
			  
			 
			  //alert( $(this).children('td:eq(0)').html());
			  $('#editsoftwaredialog').modal('show');
			  $('#editsoftwarepathid').val($(this).children('td:eq(0)').html());
			  $('#editversion').val($(this).children('td:eq(3)').html());
			  $('#editsettingpath').val($(this).children('td:eq(5)').html());
			  $('#editlogpath').val($(this).children('td:eq(7)').html());
			  var org_softwarecloudoption = $(this).children('td:eq(1)').html();
			  var org_softwareoption = $(this).children('td:eq(2)').html();
			  var org_settingtype = $(this).children('td:eq(4)').html();
			  var org_logtype = $(this).children('td:eq(6)').html();
			  var org_bg = $(this).children('td:eq(9)').html();
			  var org_user = $(this).children('td:eq(8)').html();
				$("#editsoftwarecloud").children().each(function(){
						if ($(this).html()==org_softwarecloudoption){
							$(this).attr("selected", true); 
							 }
				});
				dochangeforedit();
				$("#editsoftware").children().each(function(){
						if ($(this).html()==org_softwareoption){
							$(this).attr("selected", true); 
							 }
				});
				$("#editsettingtype").children().each(function(){
						if ($(this).html()==org_settingtype){
							$(this).attr("selected", true); 
							 }
				});
				$("#editlogtype").children().each(function(){
						if ($(this).html()==org_logtype){
							$(this).attr("selected", true); 
							 }
				});
				$("#editbg").children().each(function(){
						if ($(this).html()==org_bg){
							$(this).attr("selected", true); 
							 }
				});
				$("#edituser").children().each(function(){
						if ($(this).html()==org_user){
							$(this).attr("selected", true); 
							 }
				});
						
			});
			$('#editsoftwarecloud').change(function(){
			 dochangeforedit();
		 	}) 
			
			 
			
		  })
			//給修改software用
		function dochangeforedit(){
			$.ajax({
					 //+$("#select").find(":selected").val()
						  url: "<?=base_url()."index.php/pandan/getJsonSoftwareByCloud/"?>"+$("#editsoftwarecloud").find(":selected").val(),
						  type: "GET",
						  dataType: "json",
						  async: false,
						  contentType: "application/json; charset=utf-8",
						  success: function(JData) {
							 
							$("#editsoftware option").remove();
							var NumOfJData = JData.length;
							for (var i = 0; i < NumOfJData; i++) {
							  //alert(JData[i]["Name"]);   //i=0→Wing; i=1→Wind; i=2→Edge
							  $("#editsoftware").append($("<option></option>").attr("value", JData[i]["SoftwareID"]).text(JData[i]["Name"]));
							}
							//alert("SUCCESS!!!");
						  },
						  
						  error: function() {
							//alert("ERROR!!!");
						  }
					}); 
			}
	  </script>
      
      
      
      <div class="row">
      	
 		<div class="col-md-12" id="hostSoftwareDetail">
         	<div class="panel panel-primary">
            	<div class="panel-heading">
                <h4><?php echo $hostdetail["hostname"] ?> 中的軟體列表 - 總數：<?php echo count($softwarepaths)?></h4>
                </div>
                <div class="panel-body">
                    <table class="table table-hover" style="font-size:100%;">
                        <thead>
                            <tr>
                                <th style="width:10%">軟體群</th>
                                <th style="width:10%">軟體名稱</th>
                                <th style="width:10%">版本</th>
                                <th style="width:10%">設定檔類型</th>
                                <th style="width:10%">PATH</th>
                                <th style="width:10%">記錄檔類型</th>
                                <th style="width:10%">PATH</th>
                                <th style="width:10%">管理者</th>
                                <th style="width:10%">使用單位</th>
                                <th style="width:10%">刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach($softwarepaths as $softwarepath):?>
                            <tr>
                            	<td style="display:none;"><?php echo $softwarepath['PathID']?></td>
                                <td><?php echo $softwarepath['SoftwareCloudName']?></td>
                                <td><?php echo $softwarepath['SoftwareName']?></td>
                                <td><?php echo $softwarepath['Version']?></td>
                                <td><?php echo $softwarepath['SettingTypeName']?></td>
                                <td><?php echo $softwarepath['SettingPath']?></td>
                                <td><?php echo $softwarepath['LogTypeName']?></td>
                                <td><?php echo $softwarepath['LogPath']?></td>
                                <td <?php if($softwarepath['UserName']==$userinfo['Name']) echo 'style="color:red;"'?>><?php echo $softwarepath['UserName']?></td>
                                <td><?php echo $softwarepath['BGName']?></td>
                                <td><a style="color:red;text-decoration:none;" href="<?=base_url()."index.php/pandan/deleteSoftwarePath/".$softwarepath['HostID']."/".$softwarepath['PathID']?>">&#10006;</a></td>
                            </tr>
                            <?php endforeach?>
                        </tbody>            
                    </table>
                    <p class="text-center">
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addSoftwarePath">新增</button>
                    </p>
                    
                    
                    
                </div>
            </div>
         </div>
      </div>
      
<script>
//修改資料
$(function(){
	 $('#hostDataDetail div table tbody tr').click(function(){
		 
		 $('#editdatapathid').val($(this).children('td:eq(0)').html());
		 $('#editdatapath').val($(this).children('td:eq(2)').html());
		 var org_datatypeoption = $(this).children('td:eq(1)').html();
		 var org_databg = $(this).children('td:eq(4)').html();
		 var org_datauser = $(this).children('td:eq(3)').html();
		 $("#editdatatype").children().each(function(){
						if ($(this).html()==org_datatypeoption){
							$(this).attr("selected", true); 
							 }
				});
	 	$("#editdatabg").children().each(function(){
						if ($(this).html()==org_databg){
							$(this).attr("selected", true); 
							 }
				});
		$("#editdatauser").children().each(function(){
						if ($(this).html()==org_datauser){
							$(this).attr("selected", true); 
							 }
				});
		 $('#editdatadialog').modal('show');
		 });
	
	
	
	})


</script>
      
	<div class="row">
      	
 		<div class="col-md-12" id="hostDataDetail">
         	<div class="panel panel-primary">
            	<div class="panel-heading">
                <h4><?php echo $hostdetail["hostname"] ?> 中的資料列 - 總數：<?php echo count($datapaths)?></h4>
                </div>
                <div class="panel-body">
                    <table class="table table-hover" style="font-size:100%;">
                        <thead>
                            <tr>
                                <th>資料類型</th>
                                <th>PATH</th>
                                <th>管理者</th>
                                <th>使用單位</th>
                                <th>刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datapaths as $datapath):?>
                            <tr>
                            	<td style="display:none;"><?php echo $datapath['PathID']?></td>
                                <td><?php echo $datapath['DatatypeName']?></td>
                                <td><?php echo $datapath['Datapath']?></td>
                                <td <?php if($datapath['UserName']==$userinfo['Name']) echo 'style="color:red;"'?>><?php echo $datapath['UserName']?></td>
                                <td><?php echo $datapath['BGName']?></td>
                                <td><a style="color:red;text-decoration:none;" href="<?=base_url()."index.php/pandan/deleteDataPath/".$datapath['HostID']."/".$datapath['PathID']?>">&#10006;</a></td>
                            </tr>
                            <?php endforeach?>
                        </tbody>            
                    </table>
                    <p class="text-center">
                      <button class="btn btn-default" data-toggle="modal" data-target="#addDataPath">新增</button>
                    </p>
                </div>
            </div>
         </div>
      </div>   
      
 <script>
 $(function(){
	 dochange();
	 $('#softwarecloud').change(function(){
		 dochange();
		 })
	 
		  
	 
	 })
function dochange(){
	$.ajax({
			 //+$("#select").find(":selected").val()
				  url: "<?=base_url()."index.php/pandan/getJsonSoftwareByCloud/"?>"+$("#softwarecloud").find(":selected").val(),
				  type: "GET",
				  dataType: "json",
				  contentType: "application/json; charset=utf-8",
				  success: function(JData) {
					 
					$("#software option").remove();
					var NumOfJData = JData.length;
					for (var i = 0; i < NumOfJData; i++) {
					  //alert(JData[i]["Name"]);   //i=0→Wing; i=1→Wind; i=2→Edge
					  $("#software").append($("<option></option>").attr("value", JData[i]["SoftwareID"]).text(JData[i]["Name"]));
					}
					//alert("SUCCESS!!!");
				  },
				  
				  error: function() {
					//alert("ERROR!!!");
				  }
			}); 
	}

 </script>


 <!-- 新增軟體 -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="addSoftwarePath">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">新增軟體資料</h4>
      </div>
      <div class="modal-body">

        <div class="row">
        	<div class="col-md-4">
            	<?php echo form_open('pandan/addSoftwarePath/'.$hostdetail["HostID"])?>
                	<input type="hidden" name="hostid" id="hostid" value="<?php echo $hostdetail["HostID"]?>"/>
                    <input type="hidden" name="hostcloudid" id="hostcloudid" value="<?php echo $hostdetail["CloudID"]?>"/>
                    <label for="softwarecloud" class="control-label">軟體群:</label><br />
                    <select  class="form-control" id="softwarecloud" name="softwarecloud">
                    	<?php foreach($softwareclouds as $item):?>
                        	<option value="<?php echo $item['CloudID']?>"><?php echo $item['Name']?></option>
                        <?php endforeach?>
                    </select>
                    
            </div>
            <div class="col-md-4">
          	        <label for="software" class="control-label">軟體名稱:</label><br />
                    <select  class="form-control" id="software" name="software">
                    	
                    </select>
            
            </div>
            <div class="col-md-4">
          	        
                    <label for="version" class="control-label">版本:</label>
         	        <input type="text" class="form-control" id="version" name="version">
            
            </div>
        </div>
         <!--<label for="btn" class="control-label"></label>

         <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus
        sagittis lacus vel augue laoreet rutrum faucibus." style=" width:100%;">
          Popover on bottom
        </button>
        
       	 <span class="btn btn-default btn-lg">+0</span>-->
         			<hr />
        <div class="row">
        	<div class="col-md-6">
      				 <label for="settingtype" class="control-label">設定檔類型:</label><br />
                    <select  class="form-control" id="settingtype" name="settingtype">
                    	<?php foreach($settingtypes as $item):?>
                        <option value="<?php echo $item['SettingTypeID']?>"><?php echo $item['Name']?></option>
                        <?php endforeach?>
                    </select>
                    <label for="settingpath" class="control-label">設定檔Path:</label>
         	        <input type="text" class="form-control" id="settingpath" name="settingpath">
            </div>
            <div class="col-md-6">
      				<label for="logtype" class="control-label">紀錄檔類型:</label><br />
                    <select  class="form-control" id="logtype" name="logtype">
                    	<?php foreach($logtypes as $item):?>
                        <option value="<?php echo $item['LogTypeID']?>"><?php echo $item['Name']?></option>
                        <?php endforeach?>
                    </select>
                    <label for="logpath" class="control-label">紀錄檔Path:</label>
         	        <input type="text" class="form-control" id="logpath" name="logpath">
            </div>
        </div>
					<hr />
        <label for="bg" class="control-label">使用單位:</label><br />
        <select  class="form-control" id="bg" name="bg">
        	<?php foreach($bgs as $item):?>
				<option value="<?php echo $item['BgID']?>"><?php echo $item['Name']?></option>
            <?php endforeach?>
        </select>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <input class="btn btn-primary" type="submit" name="submit" value="送出" >
        </form>
      </div>
    </div>
  </div>
</div>

<!--新增資料-->
 <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="addDataPath">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">新增資料</h4>
      </div>
      <div class="modal-body">
		<?php echo form_open('pandan/addDataPath/'.$hostdetail["HostID"])?>
                	<input type="hidden" name="hostid" id="hostid" value="<?php echo $hostdetail["HostID"]?>"/>
                    <input type="hidden" name="hostcloudid" id="hostcloudid" value="<?php echo $hostdetail["CloudID"]?>"/>
      				 <label for="datatype" class="control-label">資料類型:</label><br />
                    <select  class="form-control" id="datatype" name="datatype">
                    	<?php foreach($datatypes as $item):?>
                        <option value="<?php echo $item['DataTypeID']?>"><?php echo $item['Name']?></option>
                        <?php endforeach?>
                    </select>
                    <label for="datapath" class="control-label">資料Path:</label>
         	        <input type="text" class="form-control" id="datapath" name="datapath">


					<hr />
        <label for="bg" class="control-label">使用單位:</label><br />
        <select  class="form-control" id="bg" name="bg">
        	<?php foreach($bgs as $item):?>
				<option value="<?php echo $item['BgID']?>"><?php echo $item['Name']?></option>
            <?php endforeach?>
        </select>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <input class="btn btn-primary" type="submit" name="submit" value="送出" >
        </form>
      </div>
    </div>
  </div>
</div>

      
<!-- 修改備註-->
<div class="modal fade" id="editRemark" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">修改備註</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('pandan/changeRemark/'.$hostdetail["HostID"])?>
          <div class="form-group">
            <input type="hidden" class="form-control" id="EditRemarkID" name="EditRemarkID" value="<?php echo $hostdetail["HostID"]?>" readonly="readonly">
            <label for="EditRemarkText" class="control-label">備註:</label>
            <textarea class="form-control" id="EditRemarkText" name="EditRemarkText" rows="6"><?php echo $hostdetail["Remark"]?></textarea>
          </div>
<!--	     <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>-->
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <input class="btn btn-primary" type="submit" name="submit" value="送出" >
      </div>
      </form>
    </div>
  </div>
</div>
  
      

<!-- 修改software明細-->
<div class="modal fade" id="editsoftwaredialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">修改軟體資料</h4>
      </div>
      <div class="modal-body">

        <div class="row">
        	<div class="col-md-4">
            	<?php echo form_open('pandan/editSoftwarePath/'.$hostdetail["HostID"])?>
                    <input type="hidden" class="form-control" id="editsoftwarepathid" name="editsoftwarepathid" value="">
                	<input type="hidden" name="hostid" id="hostid" value="<?php echo $hostdetail["HostID"]?>"/>
                    <input type="hidden" name="hostcloudid" id="hostcloudid" value="<?php echo $hostdetail["CloudID"]?>"/>
                    <label for="softwarecloud" class="control-label">軟體群:</label><br />
                    <select  class="form-control" id="editsoftwarecloud" name="softwarecloud">
                    	<?php foreach($softwareclouds as $item):?>
                        	<option value="<?php echo $item['CloudID']?>"><?php echo $item['Name']?></option>
                        <?php endforeach?>
                    </select>
                    
            </div>
            <div class="col-md-4">
          	        <label for="software" class="control-label">軟體名稱:</label><br />
                    <select  class="form-control" id="editsoftware" name="software">
                    	
                    </select>
            
            </div>
            <div class="col-md-4">
          	        
                    <label for="version" class="control-label">版本:</label>
         	        <input type="text" class="form-control" id="editversion" name="version">
            
            </div>
        </div>
        
         			<hr />
        <div class="row">
        	<div class="col-md-6">
      				 <label for="settingtype" class="control-label">設定檔類型:</label><br />
                    <select  class="form-control" id="editsettingtype" name="settingtype">
                    	<?php foreach($settingtypes as $item):?>
                        <option value="<?php echo $item['SettingTypeID']?>"><?php echo $item['Name']?></option>
                        <?php endforeach?>
                    </select>
                    <label for="settingpath" class="control-label">設定檔Path:</label>
         	        <input type="text" class="form-control" id="editsettingpath" name="settingpath">
            </div>
            <div class="col-md-6">
      				<label for="logtype" class="control-label">紀錄檔類型:</label><br />
                    <select  class="form-control" id="editlogtype" name="logtype">
                    	<?php foreach($logtypes as $item):?>
                        <option value="<?php echo $item['LogTypeID']?>"><?php echo $item['Name']?></option>
                        <?php endforeach?>
                    </select>
                    <label for="logpath" class="control-label">紀錄檔Path:</label>
         	        <input type="text" class="form-control" id="editlogpath" name="logpath">
            </div>
        </div>
					<hr />
        <div class="row">
       		 <div class="col-md-6">
        <label for="bg" class="control-label">使用單位:</label><br />
        <select  class="form-control" id="editbg" name="bg">
        	<?php foreach($bgs as $item):?>
				<option value="<?php echo $item['BgID']?>"><?php echo $item['Name']?></option>
            <?php endforeach?>
        </select>
        	</div>
            <div class="col-md-6">
		<label for="user" class="control-label">管理者:</label><br />
        <select  class="form-control" id="edituser" name="user">
        	<?php foreach($users as $item):?>
				<option value="<?php echo $item['UserID']?>"><?php echo $item['Name']?></option>
            <?php endforeach?>
        </select>
        	</div>
        </div>
        <!-- row end-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <input class="btn btn-primary" type="submit" name="submit" value="確認修改" >
        </form>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- 修改detail明細-->
<div class="modal fade" id="editdatadialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">修改資料</h4>
      </div>
      <div class="modal-body">
		<?php echo form_open('pandan/editDataPath/'.$hostdetail["HostID"])?>
                	<input type="hidden" name="editdatapathid" id="editdatapathid" value=""/>
                    <input type="hidden" name="hostid" id="hostid" value="<?php echo $hostdetail["HostID"]?>"/>
                    <input type="hidden" name="hostcloudid" id="hostcloudid" value="<?php echo $hostdetail["CloudID"]?>"/>
      				 <label for="datatype" class="control-label">資料類型:</label><br />
                    <select  class="form-control" id="editdatatype" name="datatype">
                    	<?php foreach($datatypes as $item):?>
                        <option value="<?php echo $item['DataTypeID']?>"><?php echo $item['Name']?></option>
                        <?php endforeach?>
                    </select>
                    <label for="datapath" class="control-label">資料Path:</label>
         	        <input type="text" class="form-control" id="editdatapath" name="datapath">


					<hr />
		<div class="row">
       		 <div class="col-md-6">
        <label for="bg" class="control-label">使用單位:</label><br />
        <select  class="form-control" id="editdatabg" name="bg">
        	<?php foreach($bgs as $item):?>
				<option value="<?php echo $item['BgID']?>"><?php echo $item['Name']?></option>
            <?php endforeach?>
        </select>
        	</div>
            <div class="col-md-6">
		<label for="user" class="control-label">管理者:</label><br />
        <select  class="form-control" id="editdatauser" name="user">
        	<?php foreach($users as $item):?>
				<option value="<?php echo $item['UserID']?>"><?php echo $item['Name']?></option>
            <?php endforeach?>
        </select>
        	</div>
        </div>
        <!-- row end-->
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <input class="btn btn-primary" type="submit" name="submit" value="送出" >
        </form>
      </div>
      </form>
    </div>
  </div>
</div>

