<script src="<?=base_url()?>resources/js/jquery-ui.js"></script>
<script>
var baseHref = document.getElementsByTagName('base')[0].href;
function autogrow(textarea){
var adjustedHeight=textarea.clientHeight;

	adjustedHeight=Math.max(textarea.scrollHeight,adjustedHeight);
	if (adjustedHeight>textarea.clientHeight){
		textarea.style.height=adjustedHeight+'px';
	}

}
$(function  () {
	$.getJSON(baseHref+'index.php/pandan/ReadCustomfile/0',function(data){
			var long = data.length;
			for(var i = 0;i < long ;i++){
				
				var appendstring = '<li class="panel panel-primary"> <div class="panel-heading" listid="'+i+'"><input style="width:50%;" class="form-control" type="text" value="'+data[i]["name"]+'"></div><div class="panel-body">';
				appendstring += '<div class="row"><div class="col-md-6">';
				appendstring += '<ol class="connect_btn" listname="'+data[i]["name"]+'" listid="'+i+'">';
				for(var context in data[i]["context"]){
					appendstring += ('<li><a style="display:none;" class="btn btn-default" listname="'+data[i]["name"]+'" href="index.php/pandan/view/'+data[i]["context"][context]+'" hostid="'+ data[i]["context"][context] +'">'+data[i]["context"][context]+'</a></li>');
					}
				appendstring += '</ol>';
				appendstring += '</div><div class="col-md-6" remark>';
				appendstring += '<textarea id="textval" class="form-control" style="max-width:100%;" onkeyup="autogrow(this);">'+data[i]["remark"]+'</textarea>';
				appendstring += '</div></div>';//註解的col-md-6用 關閉row
				appendstring += '</div></li>';//body用
				$('.list[use]').append(appendstring);
				
				}
			//group sortable
			$(".connect_btn").sortable({
				connectWith:'.connect_btn'
	  		});
			$(".list").sortable(
			{
				connectWith:'.unsync',
				placeholder: "movable-placeholder",
				start: function(e, ui) {
					ui.placeholder.height(ui.helper.outerHeight());
					ui.placeholder.width(ui.helper.outerWidth());
				}
				});
			//AJAX取出內容
			$("#draggablePanelList .connect_btn li a").each(function(){
					$(this).parent("li").load(baseHref+'index.php/pandan/ReadHostTitle/'+$(this).attr('hostid'));
					});
			$('textarea').each(function() {
               autogrow(this); 
            });
		});
	//取得未分類的
	
	
	$.ajax({
		url: baseHref+"index.php/pandan/ReadCustomfile/1",
		type: "GET",
		dataType: "json",
		success: function(data) {
			for(var i in data){
				$("#unsetpanel").append('<li><a style="display:none;" class="btn btn-default" href="index.php/pandan/view/'+data[i]+'" hostid="'+ data[i] +'">'+data[i]+'</a></li>');
				}
			//AJAX取出內容
			$("#divnomove .connect_btn li a").each(function(){
				$(this).parent("li").load(baseHref+'index.php/pandan/ReadHostTitle/'+$(this).attr('hostid'));
				});	
			},
		 error: function() {
			$("#savebtn").click();
			}


		});

	$('#savebtn').click(function(){
		var string = "";
		//取得清單
		var obj = [];
		$("#draggablePanelList .panel-heading").each(function() {
			var string = "";
			var listname = $(this).children('input').val();
			var listremark = $(this).parent().children('.panel-body').find('#textval').val();
			//console.log(listremark);
			var listid = $(this).attr('listid');
			var arrayhostid = [];
			$("#draggablePanelList .connect_btn[listid='"+listid+"'] a").each(function() {
					arrayhostid.push($(this).attr('hostid'));
				});
			//建立清單陣列 然後塞進obj
			var itemobj = {
				name : listname,
				remark : listremark,
				context : arrayhostid
			}
			obj.push(itemobj);
			
        });
		//轉換obj成為json 然後傳去後端
		var post_array = {"string":JSON.stringify(obj)}
		$.get(baseHref+"index.php/pandan/WriteCustomfile", post_array); 
		});
	//新件清單
	$('#newlistbtn').click(function(){
			var newlistid = parseInt($("#draggablePanelList .panel-heading:last").attr('listid'))+1;
			if(isNaN(newlistid)) {
				newlistid=1;
				}
			var appendstring = '<li class="panel panel-primary"> <div class="panel-heading" listid="'+newlistid+'"><input class="form-control" type="text" value="new" style="width:50%;"></div><div class="panel-body">';
			appendstring += '<div class="row"><div class="col-md-6">';
			appendstring += '<ol class="connect_btn" listname="new" listid="'+newlistid+'">';
			appendstring += '</ol>';
			appendstring += '</div><div class="col-md-6">';
			appendstring += '<textarea id="textval" class="form-control" style="max-width:100%;" onkeyup="autogrow(this);"></textarea></div></div></li>';
				$('.list[use]').append(appendstring);
			$(".connect_btn").sortable();
		});


});
    
</script>    

<style type="text/css">
body.dragging, body.dragging * {
  cursor: move !important;
}

.dragged {
	border: 1px dotted #eee;
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}

ol.example li.placeholder {
	border: 1px dotted #eee;
  position: relative;
  /** More li styles **/
}
ol.example li.placeholder:before {
	border: 1px dotted #eee;
  position: absolute;
  /** Define arrowhead **/
}

#divnomove {
    position: fixed;
    right: 20px;
    bottom: 30px;
   
}
.scrollable-menu {
	height: auto;
    max-height: 300px;
    overflow-x: hidden; 
	}
.scrollable-menu-waitdelete {
	height: auto;
    max-height: 100px;
    overflow-x: hidden; 
	}
.connect_btn {
    width: 100%;
    min-height: 20px;
    list-style-type: none;
    margin: 0;
    padding: 5px 0 0 0;
    float: left;
    margin-right: 10px;
	}
.movable-placeholder {
		padding: 5px;
        display: block;
        margin: 0 0 15px 0;
        border-style: dotted;
        border-width: 1px;
        border-color: #000;
    }
textarea {
	overflow-y:hidden;
	}
</style>

<!-- Bootstrap 3 panel list. -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">自訂<small> 此為實驗測試項目</small> <span id="savebtn" class="btn btn-default">儲存目前清單</span> <span id="newlistbtn" class="btn btn-default">新增清單</span></h1>
	</div>
<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-md-7">
		<ul id="draggablePanelList" use class="list-unstyled list">

        </ul>
	</div>
	<div class="col-md-4" id="divnomove">

            <div class="panel panel-primary">
                <div class="panel-heading">未配置</div>
                <div class="panel-body scrollable-menu">

                    <ol class='connect_btn' id='unsetpanel' style="width: 100%;">

                    </ol>
                 </div>
                 
            </div>
            <div class="panel panel-danger">
                <div class="panel-heading">待刪除清單</div>
                <div class="panel-body scrollable-menu-waitdelete">
                <ul class="list-unstyled list unsync" nouse>
                    <li><span class="fa fa-trash"></span> 移至此處的清單將無法復原</li>
                </ul>
                </div>
            </div>
	</div>


</div>