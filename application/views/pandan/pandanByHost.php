<script src="<?=base_url()?>resources/js/typeahead.bundle.min.js"></script>
<script>
$(function(){
	//tips
	$('[data-toggle="tooltip"]').tooltip();
	});

</script>
<?php
//echo host標籤
function echoLabel($flag){
	switch($flag){
		case 0:
			echo '<span class="label label-danger pull-right neverbtn">Never</span>';
			break;
		case 1:
			echo '<span class="label label-warning pull-right dnfbtn">DNF</span>';
			break;
		case 2:
			echo '<span class="label label-success pull-right donebtn">Done</span>';
			break;
		}
	}

?>


      <!-- Main component for a primary marketing message or call to action 
      <div class="jumbotron">
      	<h2>記錄新增<br /><small>從機器開始盤點軟體</small></h2>
      </div>
		-->
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">開始</h1>
                </div>
                <!-- /.col-lg-12 -->
   </div>
      <!-- 快速導覽-->
    <div class="row">
        <!--檢是filter按鈕-->
        <div class="col-lg-12 col-md-6">
                <!--filter tab-->
            <ul class="nav nav-tabs" id="filtertab">
              <li><a href="#filterByFlag" data-toggle="tab">依狀態</a></li>
              <li><a href="#filterByGroup" data-toggle="tab">依機器群</a></li>
              <li class="active"><a href="#filterByHostname" data-toggle="tab">依名稱</a></li>
            </ul>
        
        <div class="tab-content">
          <div class="tab-pane" id="filterByFlag">
          		<!--filter by flag-->
          		<div class="panel panel-primary">
                    <!--<div class="panel-heading">
                        <h3 class="panel-title">過濾</h3>
                    </div>-->
                    <div class="panel-body">
                        <div class="btn-group" data-toggle="buttons-checkbox" style="width:100%;">
                        <script>
                        $(function(){
                            $('#filterDone').click(function(){
                                if(!($('#filterDone').hasClass('active'))){
                                    //如果被選擇
                                    $('.donebtn').parent().css('display','');
                                    }
                                else{
                                    //沒被選
                                    $('.donebtn').parent().css('display','none');
                                    }
                                });
                            $('#filterDNF').click(function(){
                                if(!($('#filterDNF').hasClass('active'))){
                                    //如果被選擇
                                    $('.dnfbtn').parent().css('display','');
                                    }
                                else{
                                    //沒被選
                                    $('.dnfbtn').parent().css('display','none');
                                    }
                                });
                            $('#filterNever').click(function(){
                                if(!($('#filterNever').hasClass('active'))){
                                    //如果被選擇
                                    $('.neverbtn').parent().css('display','');
                                    }
                                else{
                                    //沒被選
                                    $('.neverbtn').parent().css('display','none');
                                    }
                                });
                            })
                        </script>
                        <button id="filterDone" class="btn btn-default active filter" type="button" style="width:33%;"><span class="label label-success">Done</span></button>
                        <button id="filterDNF" class="btn btn-default active filter" type="button" style="width:33%;"><span class="label label-warning">DNF</span></button>
                        <button id="filterNever" class="btn btn-default active filter" type="button" style="width:33%;"><span class="label label-danger">Never</span></button>
                        </div>
                    </div>
                </div>
                <!-- filterByflag end-->
          </div>
          <div class="tab-pane" id="filterByGroup">
          		<div class="panel panel-primary">
                	<div class="panel-body">
                    
                    	<script>
						$(function(){
							var hostgroup = [];
							$("a[data-toggle='tooltip'][hostgroup]").each(function(index, element) {
									var groupname = $(this).attr('hostgroup');
									//檢查陣列
									var index = $.inArray(groupname,hostgroup);
									//沒有就塞入
									if(index < 0){
										hostgroup.push(groupname);
										}
                            });
							for(var key in hostgroup){
										$("#filterByGroupSelect").append($("<option></option>").attr("value", hostgroup[key]).text(hostgroup[key]));
										}
							$('#filterByGroupSelect').change(function(){
								var selectval = $("#filterByGroupSelect").find(":selected").val();
								$("a[data-toggle='tooltip'][hostgroup]").css('display','');
								if(selectval!='all'){
									$("a[data-toggle='tooltip'][hostgroup!='"+selectval+"']").css('display','none');
									}
								});
						})
						</script>
                        
                        <div id="test">
                        </div>
                        <select class="form-control" id="filterByGroupSelect">
                        	<option value="all">全部</option>
                        </select>
                    </div>
                </div>
		  </div>
          <div class="tab-pane active" id="filterByHostname">
          	<div class="panel panel-primary">
            	<div class="panel-body">
            	<input id="aheadByHostname" class="form-control typeahead" type="text" value="" placeholder="Hostname..."/>
                <link href="<?=base_url()?>resources/css/typeahead.css" rel="stylesheet">
                <script>
				var substringMatcher = function(strs) {
				  return function findMatches(q, cb) {
					var matches, substrRegex;
					matches = [];
					substrRegex = new RegExp(q, 'i');
					$.each(strs, function(i, str) {
					  if (substrRegex.test(str)) {
						matches.push({ value: str });
					  }
					});
					cb(matches);
				  };
				};
				//main 抓取選取的直處發redirect
				$(function(){
					var typeaheadarray = [];
					$('.btn-md[hostgroup] span:even').each(function(index, element) {
						typeaheadarray.push($(this).html());
                    	});
					$('#aheadByHostname').typeahead({
					  hint: true,
					  highlight: true,
					  minLength: 1
					},
					{
					  name: 'typeaheadarray',
					  displayKey: 'value',
					  source: substringMatcher(typeaheadarray)
					}).on('typeahead:selected', onSelected);
					$('#aheadByHostname').focus();
				});
				function onSelected($e, datum) {
					$('.btn-md[hostgroup] span:even').each(function(index, element) {
                       if($(this).html()===datum.value){
						   $(this).click();
						   } 
                    });
				}
				</script>
                </div>
            </div>
          </div>
          <div class="tab-pane" id="settings">...</div>
        </div>
        	<!--filter tab end-->
    	
        </div>
        <!--檢是filter按鈕結束-->
    </div>
    <!--快速導覽結束-->
    
    <!-- 大包panel -->
    <div class="panel panel-default">
    	<div class="panel-body">

    <!--切割row ABCD-->

    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="A">
               <div class="panel-heading">
                  <h3 class="panel-title">A</h3>
               </div>
               <div class="panel-body">
				<?php foreach($ownhost['A'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row abcd-->

 <!--切割row EFGH-->

    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="E">
               <div class="panel-heading">
                  <h3 class="panel-title">E</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['E'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row EFGH-->
 <!--切割row IJKL-->

    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="I">
               <div class="panel-heading">
                  <h3 class="panel-title">I</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['I'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row IJKL-->
 <!--切割row MNOP-->

    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="M">
               <div class="panel-heading">
                  <h3 class="panel-title">M</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['M'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row MNOP-->
 <!--切割row QRST-->

    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="Q">
               <div class="panel-heading">
                  <h3 class="panel-title">Q</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['Q'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row QRST-->
 <!--切割row UVWX-->

    <div id="UVWX" class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="U">
               <div class="panel-heading">
                  <h3 class="panel-title">U</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['U'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
				<?php endforeach?>
               </div>
            </div>
		</div>  
    </div>
<!-- 切割row UVWX-->
 <!--切割row YZ-->

    <div class="row">
    	<div class="col-md-3">
        	<div class="panel panel-info" id="Y">
               <div class="panel-heading">
                  <h3 class="panel-title">Y</h3>
               </div>
               <div class="panel-body">
                  <?php foreach($ownhost['Y'] as $item):?>
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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
					<a class="btn btn-default btn-md" style="width:100%;font-weight:bold;" data-toggle="tooltip" data-placement="top" title="<?php echo $item['CloudName']?>" hostgroup="<?php echo $item['CloudName']?>" href="<?=base_url()."index.php/pandan/view/".$item['HostID']?>"><span><?php echo $item['Name']?></span> <?php echoLabel($item['flag']);?><br /></a> 
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


