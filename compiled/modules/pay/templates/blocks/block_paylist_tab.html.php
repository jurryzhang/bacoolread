<?php
echo '<ul class="ultab">
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php?t=alipaypay"';
if($this->_tpl_vars['_request']['t'] == 'alipaypay'){
echo ' class="selected"';
}
echo '>支付宝充值</a></li>
	<!--<li><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php?t=yeepaypay"';
if($this->_tpl_vars['_request']['t'] == 'yeepaypay'){
echo ' class="selected"';
}
echo '>网上银行充值</a></li>-->
	<!--<li><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php?t=qqpay"';
if($this->_tpl_vars['_request']['t'] == 'qqpay'){
echo ' class="selected"';
}
echo '>手机QQ充值</a></li>-->
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php?t=weixinpay"';
if($this->_tpl_vars['_request']['t'] == 'weixinpay'){
echo ' class="selected"';
}
echo '>微信充值</a></li>
<!--	<li><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php?t=yeemobilepay"';
if($this->_tpl_vars['_request']['t'] == 'yeemobilepay'){
echo ' class="selected"';
}
echo '>手机充值卡充值</a></li>
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php?t=yeegamepay"';
if($this->_tpl_vars['_request']['t'] == 'yeegamepay'){
echo ' class="selected"';
}
echo '>游戏点卡充值</a></li>
	<li><a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php?t=mobilepay"';
if($this->_tpl_vars['_request']['t'] == 'mobilepay'){
echo ' class="selected"';
}
echo '>移动手机充值</a></li> -->
</ul>';
?>