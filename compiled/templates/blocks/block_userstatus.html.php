<?php
echo '      <dl>
       <dt class="img"><img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['jieqi_userid'],'s',$this->_tpl_vars['jieqi_avatar']).'" onerror="javascript:this.src=\'/images/noavatars.jpg\'"><span class="mask"></span></dt>
	   <div class="infor_box">

       <dd>'.$this->_tpl_vars['jieqi_username'].'
       </dd>
       <dd><a title="'.$this->_tpl_vars['jieqi_vip'].'" href="#"><img src="'.$this->_tpl_vars['jieqi_vip_imageurl'].'"></a></dd>
       <dd><a title="'.$this->_tpl_vars['jieqi_honor'].'级" href="#"><img src="'.$this->_tpl_vars['jieqi_honor_imageurl'].'"></a></dd>
	   </div>
      </dl>
    </div>
    <dl class="assets">
     <dd><em>余额：</em>'.$this->_tpl_vars['jieqi_egold'].$this->_tpl_vars['jieqi_egoldname'].'<a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php" target="_blank" class="recharge2">充值</a></dd>
     <dd><em>抵扣券：</em>'.$this->_tpl_vars['jieqi_juan'].$this->_tpl_vars['jieqi_juanname'].'</dd>
     <dd><em>月票：</em>'.$this->_tpl_vars['userset']['vipvote'].'张</dd>
     <dd><em>包月：</em>';
if($this->_tpl_vars['overtime'] == 0){
echo '尚未包月';
}elseif($this->_tpl_vars['overtime'] < $this->_tpl_vars['time']){
echo '已经到期';
}else{
echo date('Y-m-d',$this->_tpl_vars['overtime']).' 到期';
}
echo '<a href="javascript:;" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/monthly.php?id='.$this->_tpl_vars['jieqi_userid'].'\');" class="recharge2">开通</a></dd>
    </dl>';
?>