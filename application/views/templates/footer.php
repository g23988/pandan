        </div>
        <!-- /#page-wrapper -->

    </div>

<script>

var isAlt = false;
//快速進入start偵測 複合健alt + s
function quickstart(event){
	 if (event.keyCode == 18) {
		 isAlt = true;
		 };
	 if (event.keyCode == 65 && isAlt) {
	 	window.location.replace("<?=base_url()."index.php/pandan/pandanByHost/all"?>");
	 	};
	 if (event.keyCode == 78 && isAlt) {
	 	window.location.replace("<?=base_url()."index.php/pandan/pandanByHost/never"?>");
	 	};
	};
$(function(){
	$(window).bind('keydown', quickstart);
	});
</script>
<footer class="footer">
	

        
      <div class="container">

        <p class="text-muted credit"> PANDAN v2.0 Copyright © 2015 e104 Inc. All rights reserved ， 程式維護 【 系統工程課  <a href="mailto:wei.liu@e104.com.tw">Wei Liu</a> 】</p>
      </div>
</footer>
		
</body>

</html>