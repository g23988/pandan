<?php echo form_open('software/update')?>
          <div class="form-group" style="font-size:115%;">
          	<label for="softwareid" class="control-label">編號：</label>
            <input type="text" class="form-control" id="softwareid" name="softwareid"  value="<?php echo $SoftwareID;?>" readonly="readonly"/>
          	<label for="softwarename" class="control-label">軟體名稱：</label>
            <input type="text" class="form-control" id="softwarename" name="softwarename" value="<?php echo $softwareDetail['Name']?>"/>
            <label for="softwarecloudid" class="control-label">軟體群：</label>
            <select class="form-control" name="softwarecloudid" id="softwarecloudid">
            		<?php foreach($softwareclouds as $item):?>
                   <option value="<?php echo $item['CloudID']?>"><?php echo $item['Name']?></option>
                   	<?php endforeach;?>
            </select>
            <hr />
            <label for="remark" class="control-label">備註：</label>
            <textarea rows="5" class="form-control" id="remark" name="remark"><?php echo $softwareDetail['Remark']?></textarea>
          </div>

        
      </div>
      <div class="modal-footer">
        <a href="<?=base_url()."index.php/software/delete/".$SoftwareID?>" class="btn btn-danger" data-dismiss="modal">刪除</a>
        <input class="btn btn-primary" type="submit" name="submit" value="更新" >
      </div>
      </form>          

