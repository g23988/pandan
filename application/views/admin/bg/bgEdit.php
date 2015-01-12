<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      	<h2>管理使用單位<br /><small>管理軟體與設定的終端使用對象</small></h2>
      </div>
      
      <div class="panel panel-default">
      <div class="panel-body">
        <table class="table table-hover" style="font-size:112%;">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>使用單位</th>
                    <th>創建時間</th>
                    <th>創建人</th>
                    <th>刪除</th>
                </tr>
            </thead>
			<tbody>
                <?php foreach($bgs as $item):?>
                <tr>
                	<td><?php echo $item['BgID']?></td>
                    <td><?php echo $item['Name']?></td>
                    <td><?php echo $item['Modifytime']?></td>
                    <td><?php echo $item['Modifyuser']?></td>
                    <td><a style="color:red;text-decoration:none;" href="<?=base_url()."index.php/bg/delete/".$item['BgID']?>">&#10006;</a></td>
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
        <h4 class="modal-title" id="exampleModalLabel">新增目標單位</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('bg/add')?>
          <div class="form-group">
            <label for="bgname" class="control-label">目標單位:</label>
            <input type="text" class="form-control" id="bgname" name="bgname">
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






    </div> <!-- /container -->
