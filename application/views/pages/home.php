<div class="container">

      <!-- Main component for a primary marketing message or call to action -->

      <div class="jumbotron">
        <h1>歡迎使用PANDAN<small> Open BETA</small></h1>
        <br />
        <p class="text-center">
          <a class="btn btn-lg btn-primary" href="<?=base_url()."index.php/pandan/pandanByHost"?>">開始盤點</a>
        </p>
      </div>
      <div class="row">
      	<div class="col-sm-12">
        	<div class="panel panel-default">
            	<div class="panel-heading">
           		 <h4>公告訊息</h4>
                </div>
				<div class="panel-body">
                    <table class="table table-hover" style="font-size:112%;">
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
                    <p class="text-right"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">+</button></p>
                </div>
        	</div>
          
        </div>
      </div>

      

    </div> <!-- /container -->


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


