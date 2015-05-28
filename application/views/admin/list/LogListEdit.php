        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">管理紀錄檔類型 <small>管理紀錄檔歸納群組</small></h1>
            </div>
                <!-- /.col-lg-12 -->
        </div>


      
      
      <div class="panel panel-default">
      <div class="panel-body">
        <table class="table table-hover" style="font-size:112%;">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>紀錄檔類型</th>
                    <th>描述</th>
                    <th>創建時間</th>
                    <th>創建人</th>
                    <th>刪除</th>
                </tr>
            </thead>
			<tbody>
                <?php foreach($logtypes as $item):?>
                <tr>
                	<td><?php echo $item['LogTypeID']?></td>
                    <td><?php echo $item['Name']?></td>
                    <td style="width:400px;"><?php echo $item['Description']?></td>
                    <td><?php echo $item['Modifytime']?></td>
                    <td><?php echo $item['Modifyuser']?></td>
                    <td><a style="color:red;text-decoration:none;" href="<?=base_url()."index.php/listadmin/deletelogtype/".$item['LogTypeID']?>">&#10006;</a></td>
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
        <h4 class="modal-title" id="exampleModalLabel">新增記錄檔類型</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('listadmin/addlogtype')?>
          <div class="form-group">
            <label for="logtypename" class="control-label">紀錄檔類型名稱:</label>
            <input type="text" class="form-control" id="logtypename" name="logtypename">
            <label for="description" class="control-label">描述:</label>
            <textarea rows="5" class="form-control" id="description" name="description"></textarea>
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

