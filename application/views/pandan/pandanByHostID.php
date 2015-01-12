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
})
</script>
<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="row">
        <div class="col-md-4">
        	<h2><?php echo $hostdetail["hostname"] ?>附掛作業<br /><small>列出所有歸屬於這台機器的軟體</small></h2>
			<p class="text-right"><a class="btn btn-default btn-md dropdown-toggle" href="<?=base_url()."index.php/pandan/pandanByHost"?>">回機器列表</a></p>
        </div>
      	<div class="col-md-8">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                <h4><?php echo $hostdetail["hostname"] ?> 詳細資訊</h4>
                </div>
                <div class="panel-body">
                
                 <table class="table table-striped" style="font-size:100%;">
                    <tbody>
						<tr>
                            <td style="width:50%;">軟體數量</td>
                            <td style="width:50%;"><?php echo count($softwarepaths)?></td>
                        </tr>
                        <tr>
                            <td>資料數量</td>
                            <td><?php echo count($datapaths)?></td>
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
                                 <a id="chageflag0" role="menuitem" tabindex="-1"><span class="label label-danger">Never</span></a>
                              </li>
                              <li role="presentation">
                                 <a id="chageflag1" role="menuitem" tabindex="-1"><span class="label label-warning">DNF</span></a>
                              </li>
                              <li role="presentation">
                                 <a id="chageflag2" role="menuitem" tabindex="-1"><span class="label label-success">Done</span></a>
                              </li>
                           </ul>
                            </div>
                            </td>
                        </tr>
                    </tbody>            
                </table>
                
                </div>
            </div>
        </div>
      </div>
      
      </div>


      
      
      
      
      <div class="row">
      	
 		<div class="col-md-12" id="hostSoftwareDetail">
         	<div class="panel panel-info">
            	<div class="panel-heading">
                <h4><?php echo $hostdetail["hostname"] ?> 中的軟體列表</h4>
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
      
  
      
	<div class="row">
      	
 		<div class="col-md-12" id="hostSoftwareDetail">
         	<div class="panel panel-info">
            	<div class="panel-heading">
                <h4><?php echo $hostdetail["hostname"] ?> 中的資料列表</h4>
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

      
      
  
      





      

    </div> <!-- /container -->