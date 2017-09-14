<?php
if(count($this->_tpl_vars['reviewrows']) > 0){
echo '
		<div class="intrReviewTab">
          <ul class="reviewTabTit mb10 cf">
                <li id="three1" class="on">最新书评</li>
                <li id="three2" style="border-left:0;"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['reviewaid'].'&type=good" target="_blank">精华评论</a></li>
                <li id="three3" style="border-left:0;"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviews.php?aid='.$this->_tpl_vars['reviewaid'].'&type=all" target="_blank">全部评论</a></li>
            </ul>
            <div class="reviewTabCon">
                <div id="con_three_1">
';
if (empty($this->_tpl_vars['reviewrows'])) $this->_tpl_vars['reviewrows'] = array();
elseif (!is_array($this->_tpl_vars['reviewrows'])) $this->_tpl_vars['reviewrows'] = (array)$this->_tpl_vars['reviewrows'];
$this->_tpl_vars['i']=array();
$this->_tpl_vars['i']['columns'] = 1;
$this->_tpl_vars['i']['count'] = count($this->_tpl_vars['reviewrows']);
$this->_tpl_vars['i']['addrows'] = count($this->_tpl_vars['reviewrows']) % $this->_tpl_vars['i']['columns'] == 0 ? 0 : $this->_tpl_vars['i']['columns'] - count($this->_tpl_vars['reviewrows']) % $this->_tpl_vars['i']['columns'];
$this->_tpl_vars['i']['loops'] = $this->_tpl_vars['i']['count'] + $this->_tpl_vars['i']['addrows'];
reset($this->_tpl_vars['reviewrows']);
for($this->_tpl_vars['i']['index'] = 0; $this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['loops']; $this->_tpl_vars['i']['index']++){
	$this->_tpl_vars['i']['order'] = $this->_tpl_vars['i']['index'] + 1;
	$this->_tpl_vars['i']['row'] = ceil($this->_tpl_vars['i']['order'] / $this->_tpl_vars['i']['columns']);
	$this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['order'] % $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['column'] == 0) $this->_tpl_vars['i']['column'] = $this->_tpl_vars['i']['columns'];
	if($this->_tpl_vars['i']['index'] < $this->_tpl_vars['i']['count']){
		list($this->_tpl_vars['i']['key'], $this->_tpl_vars['i']['value']) = each($this->_tpl_vars['reviewrows']);
		$this->_tpl_vars['i']['append'] = 0;
	}else{
		$this->_tpl_vars['i']['key'] = '';
		$this->_tpl_vars['i']['value'] = '';
		$this->_tpl_vars['i']['append'] = 1;
	}
	echo '
                    <div class="shupingList cf">
                        <div class="splImg"><img src="'.jieqi_geturl('system','avatar',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posterid'],'s').'" alt="';
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posterid'] > 0){
echo $this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['poster'];
}else{
echo '游客';
}
echo '"/></div>
                        <div class="splInfo cf">
                        	<div class="cf">
                            <b>';
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posterid'] > 0){
echo '<a href="'.jieqi_geturl('system','user',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posterid']).'" target="_blank">'.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['poster'].'</a>';
}else{
echo '游客';
}
echo '</b>
                            <em>'.date('Y-m-d H:i:s',$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['replytime']).' 发表</em>
                        	</div>
                            <p>';
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['istop'] == 1){
echo '<span class="hot"><i class="fa fa-thumbs-up fa-fw"></i></span>';
}
if($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['isgood'] == 1){
echo '<span class="hot"><i class="fa fa-trophy fa-fw"></i></span>';
}
echo '<a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviewshow.php?rid='.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topicid'].'" target="_blank">'.truncate($this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['posttext'],'320','..').'</a></p>
                          <div class="splInfohf"><a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/reviewshow.php?rid='.$this->_tpl_vars['reviewrows'][$this->_tpl_vars['i']['key']]['topicid'].'#postnew" target="_blank">回复</a></div>
                        </div>
                    </div>
                    
';
}
echo '
                    
                </div>
            </div>
        </div>
';
}

?>