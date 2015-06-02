<?php foreach($messages as $item):?>
<li>
<a href="<?php echo $item['Link'];?>">
       <div>
             <strong><?php echo $item['From'];?></strong>
             <span class="pull-right text-muted">
                    <em><?php echo time_ago(strtotime($item['Createtime']))." ago";?></em>
             </span>
       </div>
      <div><?php echo $item['Text'];?></div>
</a>
</li>
<li class="divider"></li>
<?php endforeach?>
<li>
    <a class="text-center" href="#">
    <strong>全部訊息</strong>
    <i class="fa fa-angle-right"></i>
    </a>
</li>
<?php
function time_ago($tm,$rcs = 0) {
   $cur_tm = time(); $dif = $cur_tm-$tm;
   $pds = array('second','minute','hour','day','week','month','year','decade');
   $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
   for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);

   $no = floor($no); if($no <> 1) $pds[$v] .='s'; $x=sprintf("%d %s ",$no,$pds[$v]);
   if(($rcs > 0)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm, --$rcs);
   return $x;
}
?>