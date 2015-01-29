<script>
$(function(){
	//按鍵快速查找
	function onKeydown(event){
		var keycode = event.which;
		$("div.panel-info").removeClass('panel-danger');
		changeColor(String.fromCharCode(keycode));
		switch(keycode){
			//a case
			case 65:case 66:case 67:case 68:
				location.href = "#ABCD";
				break;
			case 69:case 70:case 71:case 72:
				location.href = "#EFGH";
				break;
			case 73:case 74:case 75:case 76:
				location.href = "#IJKL";
				break;
			case 77:case 78:case 79:case 80:
				location.href = "#MNOP";
				break;
			case 81:case 82:case 83:case 84:
				location.href = "#QRST";
				break;
			case 85:case 86:case 87:case 88:
				location.href = "#UVWX";
				break;
			case 89:case 90:case 90:case 48:case 49:case 50:case 51:case 52:case 53:case 54:case 55:case 56:case 57:
				location.href = "#YZnum";
				break;
			}
		}
	function changeColor(keycode){
		$('#'+keycode).addClass('panel-danger');
		//特別處理0~9
		if(keycode==='0'||keycode==='1'||keycode==='2'||keycode==='3'||keycode==='4'||keycode==='5'||keycode==='6'||keycode==='7'||keycode==='8'||keycode==='9')
			$('#numpanel').addClass('panel-danger');
		}

	$(window).bind('keydown', onKeydown);
	//tips
	$('[data-toggle="tooltip"]').tooltip();
	});

</script>
<?php
function echoLabel($flag){
	switch($flag){
		case 0:
			echo '<span class="label label-danger pull-right">Never</span>';
			break;
		case 1:
			echo '<span class="label label-warning pull-right">DNF</span>';
			break;
		case 2:
			echo '<span class="label label-success pull-right">Done</span>';
			break;
		}
	}

?>


<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      	<h2>記錄新增<br /><small>從機器開始盤點軟體</small></h2>
      </div>
      
      <!-- 快速導覽-->
    <div class="row">
    	<div class="col-md-12">
    	<div class="panel panel-default">
        	<div class="panel-heading">
        		<h3 class="panel-title">機器名稱快速連結 <small>字首導覽，可以直接鍵入字首跳頁</small></h3>
        	</div>
        	<div class="panel-body">
           	    <a class="btn btn-default btn-lg" href="#ABCD" style="width:10%;">A B C D</a>
                <a class="btn btn-default btn-lg" href="#EFGH" style="width:10%;">E F G H</a>
                <a class="btn btn-default btn-lg" href="#IJKL" style="width:10%;">I J K L</a>
                <a class="btn btn-default btn-lg" href="#MNOP" style="width:10%;">M N O P</a>
                <a class="btn btn-default btn-lg" href="#QRST" style="width:10%;">Q R S T</a>
                <a class="btn btn-default btn-lg" href="#UVWX" style="width:10%;">U V W X</a>
                <a class="btn btn-default btn-lg" href="#YZnum" style="width:10%;">Y Z 0~9</a>
   
            </div>
        </div>
        </div>
    </div>
    <!--快速導覽結束-->
    <!-- 大包panel -->
    <div class="panel panel-default">
    	<div class="panel-body">
    <!--切割row ABCD-->
    <div id="ABCD" class="page-header" >
   		<h2>A B C D</h2>
	</div>
    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="A">
               <div class="panel-heading">
                  <h3 class="panel-title">A</h3>
               </div>
               <div class="panel-body">
				<?php foreach($ownhost['A'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="B">
               <div class="panel-heading">
                  <h3 class="panel-title">B</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['B'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
                  
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="C">
               <div class="panel-heading">
                  <h3 class="panel-title">C</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['C'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="D">
               <div class="panel-heading">
                  <h3 class="panel-title">D</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['D'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row abcd-->

 <!--切割row EFGH-->
    <div id="EFGH" class="page-header">
   		<h2>E F G H</h2>
	</div>
    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="E">
               <div class="panel-heading">
                  <h3 class="panel-title">E</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['E'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="F">
               <div class="panel-heading">
                  <h3 class="panel-title">F</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['F'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="G">
               <div class="panel-heading">
                  <h3 class="panel-title">G</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['G'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="H">
               <div class="panel-heading">
                  <h3 class="panel-title">H</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['H'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row EFGH-->
 <!--切割row IJKL-->
    <div id="IJKL" class="page-header">
   		<h2>I J K L</h2>
	</div>
    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="I">
               <div class="panel-heading">
                  <h3 class="panel-title">I</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['I'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="J">
               <div class="panel-heading">
                  <h3 class="panel-title">J</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['J'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="K">
               <div class="panel-heading">
                  <h3 class="panel-title">K</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['K'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="L">
               <div class="panel-heading">
                  <h3 class="panel-title">L</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['L'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row IJKL-->
 <!--切割row MNOP-->
    <div id="MNOP" class="page-header">
   		<h2>M N O P</h2>
	</div>
    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="M">
               <div class="panel-heading">
                  <h3 class="panel-title">M</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['M'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="N">
               <div class="panel-heading">
                  <h3 class="panel-title">N</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['N'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="O">
               <div class="panel-heading">
                  <h3 class="panel-title">O</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['O'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="P">
               <div class="panel-heading">
                  <h3 class="panel-title">P</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['P'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row MNOP-->
 <!--切割row QRST-->
    <div id="QRST" class="page-header">
   		<h2>Q R S T</h2>
	</div>
    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="Q">
               <div class="panel-heading">
                  <h3 class="panel-title">Q</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['Q'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="R">
               <div class="panel-heading">
                  <h3 class="panel-title">R</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['R'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="S">
               <div class="panel-heading">
                  <h3 class="panel-title">S</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['S'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="T">
               <div class="panel-heading">
                  <h3 class="panel-title">T</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['T'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row QRST-->
 <!--切割row UVWX-->
    <div id="UVWX" class="page-header">
   		<h2>U V W X</h2>
	</div>
    <div id="UVWX" class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="U">
               <div class="panel-heading">
                  <h3 class="panel-title">U</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['U'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="V">
               <div class="panel-heading">
                  <h3 class="panel-title">V</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['V'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="W">
               <div class="panel-heading">
                  <h3 class="panel-title">W</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['W'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="X">
               <div class="panel-heading">
                  <h3 class="panel-title">X</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['X'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row UVWX-->
 <!--切割row YZ-->
    <div id="YZnum" class="page-header">
   		<h2>Y Z 0~9</h2>
	</div>
    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="Y">
               <div class="panel-heading">
                  <h3 class="panel-title">Y</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['Y'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="Z">
               <div class="panel-heading">
                  <h3 class="panel-title">Z</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['Z'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="numpanel">
               <div class="panel-heading">
                  <h3 class="panel-title">0~9</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['num'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
        <div class="col-md-3">
       		 <div class="panel panel-info" id="otherpanel">
               <div class="panel-heading">
                  <h3 class="panel-title">其餘</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['other'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?></a> <br />
				<?php endforeach?>
               </div>
            </div>
        </div>
    </div>
<!-- 切割row YZ-->
</div>
</div>

<!--大包panel結束-->
<!--    <div class="row">
    	<div class="col-md-12">
    	<div class="panel panel-default">
        	<div class="panel-heading">
        		<h3 class="panel-title"></h3>
        	</div>
        	<div class="panel-body">
            	無<br />
                      
            </div>
        </div>
        </div>
    </div>-->







    </div> <!-- /container -->
