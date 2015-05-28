        </div>
        <!-- /#page-wrapper -->

    </div>

<script>
/*
var isAlt = false;
//快速進入start偵測 複合健alt + s
function quickstart(event){
	 if (event.keyCode == 18) {
		 isAlt = true;
		 };
	 if (event.keyCode == 83 && isAlt) {
	 	window.location.replace("base_url()."index.php/pandan/pandanByHost"");
	 	};
	};
$(function(){
	$(window).bind('keydown', quickstart);
	});*/
</script>
<footer class="footer">
	

        
      <div class="container">
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
        <p class="text-muted credit"> PANDAN v0.96 Copyright © 2014 e104 Inc. All rights reserved ， 程式維護 【 系統工程課  <a href="mailto:wei.liu@e104.com.tw">Wei Liu</a> 】</p>
      </div>
</footer>
		
</body>

</html>