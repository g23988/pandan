<script>
//調整遇先選擇的夏拉是選單
$(function(){
	$("#hostcloudid").children().each(function(){
    if ($(this).val()==$('#org_hostcloudid').val()){
        $(this).attr("selected", true); 
   		 }
	});
	
	$("#userid").children().each(function(){
    if ($(this).val()==$('#org_userid').val()){
        $(this).attr("selected", true); 
   		 }
	});
	

	})
</script>


<?php echo form_open('host/update')?>
          <div class="form-group" style="font-size:115%;">
          	<label for="hostid" class="control-label">編號：</label>
            <input type="text" class="form-control" id="hostid" name="hostid"  value="<?php echo $HostID;?>" readonly="readonly"/>
          	<label for="hostname" class="control-label">主機名稱：</label>
            <input type="text" class="form-control" id="hostname" name="hostname" value="<?php echo $hostDetail['Name']?>"/>
            <!-- 紀錄本來的hostcloudid userid 給前方javascript調用-->
            <input id="org_hostcloudid" type="hidden" value="<?php echo $hostDetail['CloudID']?>" />
            <input id="org_userid" type="hidden" value="<?php echo $hostDetail['UserID']?>" />
            
            <label for="softwarecloudid" class="control-label">主機群：</label>
            <select class="form-control" name="hostcloudid" id="hostcloudid">
            		<?php foreach($hostclouds as $item):?>
                   <option value="<?php echo $item['CloudID']?>"><?php echo $item['Name']?></option>
                   	<?php endforeach;?>
            </select>
            <label for="userid" class="control-label">保管者：</label>
            <select class="form-control" name="userid" id="userid">
            		<?php foreach($users as $item):?>
                   <option value="<?php echo $item['UserID']?>"><?php echo $item['Name']?></option>
                   	<?php endforeach;?>
            </select>
            <br />
            <p class="bg-danger">注意：轉移保管者給【系統管理者】，將會把控制權交給所有人</p>
            <hr />
            <label for="remark" class="control-label">備註：</label>
            <textarea rows="5" class="form-control" id="remark" name="remark"><?php echo $hostDetail['Remark']?></textarea>
          </div>

        
      </div>
      <div class="modal-footer">
        <a href="<?=base_url()."index.php/host/delete/".$HostID?>" class="btn btn-danger" data-dismiss="modal">刪除</a>
        <input class="btn btn-primary" type="submit" name="submit" value="更新" >
      </div>
      </form>          

