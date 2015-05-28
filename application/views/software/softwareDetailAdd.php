        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">軟體新增 <small>新增由 <?php echo $username;?> 管理的軟體</small></h1>
            </div>
                <!-- /.col-lg-12 -->
        </div>

      <div class="panel panel-default">
      <div class="panel-body">
           <?php echo form_open('software/add') ?>
              <div class="form-group" style="font-size:112%;">
              	<div class="row">
                	<div class="col-md-9 col-md-offset-1">
                        <label for="softwareid" class="control-label">編號：</label>
                        <input type="text" class="form-control" id="softwareid" name="softwareid" readonly="readonly" value="自動編號"/>
                        <label for="softwarename" class="control-label">軟體名稱*：</label>
                        <input type="text" class="form-control" id="softwarename" name="softwarename" />
                        <label for="softwarecloudid" class="control-label">軟體群*：</label>
                        <select class="form-control" name="softwarecloudid" id="softwarecloudid">
                            <?php foreach($softwareclouds as $cloud):?>
                            <option value="<?php echo $cloud['CloudID']?>"><?php echo $cloud['Name']?></option>
                            <?php endforeach;?>
                        </select><br />
                	</div>
                </div>
              
                <hr />
                <div class="row">
                	<div class="col-md-9 col-md-offset-1">
                        <label for="remark" class="control-label">備註：</label>
                        <textarea rows="5" class="form-control" id="remark" name="remark"></textarea>
                	</div>
                </div>
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
