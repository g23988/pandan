        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">使用者群組 <small>管理使用者所處的群組</small></h1>
            </div>
                <!-- /.col-lg-12 -->
        </div>

      
      <div class="panel panel-default">
      <div class="panel-body">
        <table class="table table-hover" style="font-size:112%;">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>群組名稱</th>
                    <th>縮寫</th>
                    <th>創建人</th>
                    <th class="x">刪除</th>
                </tr>
            </thead>
			<tbody>
                <?php foreach($groups as $item):?>
                <tr>
                	<td><?php echo $item['GroupID']?></td>
                	<td><?php echo $item['Name']?></td>
                    <td><?php echo $item['Nickname']?></td>
                    <td><?php echo $item['Modifyuser']?></td>
                    <td><a style="color:red;text-decoration:none;" href="<?=base_url()."index.php/userGroup/delete/".$item['GroupID']?>">&#10006; </a></td>
                </tr>
                <?php endforeach?>

            </tbody>            
        </table>
		<p class="text-center">
          <button class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">新增</button>
        </p>

</div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">新增使用群組</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('userGroup/add')?>
          <div class="form-group">
            <label for="group-name" class="control-label">群組名稱:</label>
            <input type="text" class="form-control" id="group-name" name="groupname">
            <label for="nickname" class="control-label">縮寫:</label>
            <input type="text" class="form-control" id="nickname" name="nickname">
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


