</div>
<footer class="footer">
      <div class="container">
        <p class="text-muted credit"> Copyright © 2014 e104 Inc. All rights reserved ， 程式維護 【 系統工程課  <a href="mailto:wei.liu@e104.com.tw">Wei Liu</a> 】</p>
      </div>
</footer>
		<script>
		var tipsmessages = [];
		tipsmessages.push('<strong>你知道嗎？</strong> 就算AD認證通過，但是管理者沒有加入帳號。也無法使用PANDAN喔！');
		tipsmessages.push('<strong>你知道嗎？</strong> 你可以使用 <span class="label label-primary">alt + s</span> 快速在任何頁面訪問盤點頁！');
		</script>
      <!--通知-->
        <div class="alert alert-danger" id="footalertbox">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <script>
				$(function(){
					$('#footalertbox').append(tipsmessages[parseInt(Math.random()*tipsmessages.length)]);
					});
				</script>
        </div>

        <!--通知結束-->
</body>

</html>