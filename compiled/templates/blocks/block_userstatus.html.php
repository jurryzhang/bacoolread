<?php
echo '      <dl>
       <dt class="img"><img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['jieqi_userid'],'s',$this->_tpl_vars['jieqi_avatar']).'" onerror="javascript:this.src=\'/images/noavatars.jpg\'"><span class="mask"></span></dt>
	   <div class="infor_box">

       <dd>'.$this->_tpl_vars['jieqi_username'].'
       </dd>
       <dd><a title="'.$this->_tpl_vars['jieqi_vip'].'" href="#"><img src="'.$this->_tpl_vars['jieqi_vip_imageurl'].'"></a></dd>
       <dd><a title="'.$this->_tpl_vars['jieqi_honor'].'��" href="#"><img src="'.$this->_tpl_vars['jieqi_honor_imageurl'].'"></a></dd>
	   </div>
      </dl>
    </div>
    <dl class="assets">
     <dd><em>��</em>'.$this->_tpl_vars['jieqi_egold'].$this->_tpl_vars['jieqi_egoldname'].'<a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php" target="_blank" class="recharge2">��ֵ</a></dd>
     <dd><em>�ֿ�ȯ��</em>'.$this->_tpl_vars['jieqi_juan'].$this->_tpl_vars['jieqi_juanname'].'</dd>
     <dd><em>��Ʊ��</em>'.$this->_tpl_vars['userset']['vipvote'].'��</dd>
     <dd><em>���£�</em>';
if($this->_tpl_vars['overtime'] == 0){
echo '��δ����';
}elseif($this->_tpl_vars['overtime'] < $this->_tpl_vars['time']){
echo '�Ѿ�����';
}else{
echo date('Y-m-d',$this->_tpl_vars['overtime']).' ����';
}
echo '<a href="javascript:;" onclick="huodong(\''.$this->_tpl_vars['jieqi_modules']['article']['url'].'/monthly.php?id='.$this->_tpl_vars['jieqi_userid'].'\');" class="recharge2">��ͨ</a></dd>
    </dl>';
?>