<?php
echo '<div class="rie">
<ul class="BookFansUl">
<li>您当前的等级：'.$this->_tpl_vars['mycredits']['rank'].'</li>
<li>您当前粉丝值：'.$this->_tpl_vars['mycredits']['credit'].'</li>
<li>距离下级还差：'.$this->_tpl_vars['mycredits']['upcredit'].'</li>
</ul>
</div>';
?>