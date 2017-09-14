<?php
echo '
<div id="content"><link href="/sink/css/user.css" type="text/css" rel="stylesheet">

	<!--wrap begin-->
	<div class="wrap2">
		<script type="text/javascript">
            $(function(){

                var ss = \'userhub\'+\'_\'+\'\';
                if(ss == \'userhub_inbox\' || ss == \'userhub_outbox\' || ss == \'userhub_draft\' || ss == \'userhub_toSysView\' || ss == \'userhub_messagedetail\'){
                    $(\'#userhub_newmessage\').parent("dl.list_menu").show();
                    $(\'#userhub_newmessage\').children("a").addClass("focus");
                }
                if(ss == \'chapter_cmView\'){
                    $(\'#article_masterPage\').parent("dl.list_menu").show();
                    $(\'#article_masterPage\').children("a").addClass("focus");
                }
//  if(\'\' == \'upaView\'){
//      $(\'#userhub_usereditView\').parent("dl.list_menu").show();
//	  $(\'#userhub_usereditView\').children("a").addClass("focus");
//  }
                if(\'\' == \'hotcomment\'){
                    $(\'#userhub_comment\').parent("dl.list_menu").show();
                    $(\'#userhub_comment\').children("a").addClass("focus");
                }
                if(\'\' == \'uservip\'){
                    $(\'#userhub_usermember\').parent("dl.list_menu").show();
                    $(\'#userhub_usermember\').children("a").addClass("focus");
                }
                if(\'\' == \'moderatorView\'){
                    $(\'#userhub_review_view\').parent("dl.list_menu").show();
                    $(\'#userhub_review_view\').children("a").addClass("focus");
                }
                $(\'#\'+ss).parent("dl.list_menu").show();
                $(\'#\'+ss).children("a").addClass("focus");
                $("li#row em").click(function(){
                    $(this).parent().parent().children("dl.list_menu").toggle(300);
                });
            });

		</script>
		<!--sidebar2 begin-->
		<div class="sidebar2 fl bg4 fix">

			<div class="user2 f_blue fix">
				'.$this->_tpl_vars['jieqi_pageblocks']['3']['content'].'

				'.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'
				<div class="kf"></div>
			</div>
			<div class="article2 fr">
				<div class="boxm2">
					<script type="text/javascript">
                        function frmpay_validate(){
                            var checked = false;
                            var egolds = document.getElementsByName(\'egold\');
                            for (var i=0; i<egolds.length; i++) {
                                checked = checked || egolds[i].checked;
                            }
                            if(!checked){
                                alert("请选择您要的充值金额");
                                return false;
                            }
                            showMask();
                            displayDialog(document.getElementById(\'paydialog\').innerHTML);
                        }

                        function check_radio(){
                            var o = getTarget();
                            $_(o).subTag(\'input\')[0].checked = true;
                        }

					</script>

					'.jieqi_get_block(array('bid'=>'0', 'blockname'=>'充值导航', 'module'=>'pay', 'filename'=>'block_paylist_tab', 'classname'=>'BlockSystemCustom', 'side'=>'-1', 'title'=>'', 'vars'=>'', 'template'=>'', 'contenttype'=>'4', 'custom'=>'1', 'publish'=>'3', 'hasvars'=>'0'), 1).'



					<script type="text/javascript">
                        function frmpay_validate(){
                            var checked = false;
                            var egolds = document.getElementsByName(\'egold\');
                            for (var i=0; i<egolds.length; i++) {
                                checked = checked || egolds[i].checked;
                            }
                            if(!checked){
                                alert("请选择您要的充值金额");
                                return false;
                            }
                            showMask();
                            displayDialog(document.getElementById(\'paydialog\').innerHTML);
                        }

                        function check_radio(){
                            var o = getTarget();
                            $_(o).subTag(\'input\')[0].checked = true;
                        }

					</script>


					<form name="frmalipay" method="post" action="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/weixinpay.php">
						<table class="grid" width="100%" align="center">
							<caption>微信充值</caption>
							<tr>
								<td style="font-size:14px;line-height:200%;padding:20px;">
									<strong>请选择您要的充值金额：</strong><br />
									<div style="width:100%;clear:both;margin-bottom:10px;">
										<ul class="recnTul">
											<li onclick="check_radio();"><input type="radio" name="egold" value="1000" class="radio" > 1000 '.$this->_tpl_vars['egoldname'].'<span>10元</span></li>
											<li onclick="check_radio();"><input type="radio" name="egold" value="2000" class="radio" checked="checked"> 2000 '.$this->_tpl_vars['egoldname'].'<span>20元</span></li>
											<li onclick="check_radio();"><input type="radio" name="egold" value="3000" class="radio"> 3000 '.$this->_tpl_vars['egoldname'].'<span>30元</span></li>
											<li onclick="check_radio();"><input type="radio" name="egold" value="5000" class="radio"> 5000 '.$this->_tpl_vars['egoldname'].'<span>50元</span></li>
											<li onclick="check_radio();"><input type="radio" name="egold" value="10000" class="radio"> 10000 '.$this->_tpl_vars['egoldname'].'<span>100元</span></li>
											<!--<li onclick="check_radio();"><input type="radio" name="egold" value="50000" class="radio"> 50000 '.$this->_tpl_vars['egoldname'].'<span>500元</span></li>-->
										</ul>
										<div class="cb"></div>
									</div>
									<input type="submit" name="Submit" value="进入下一步" class="button" >
									<input type="hidden" name="action" value="bankpay">
								</td>
							</tr>
						</table>
					</form>
					<div class="textbox">
						<strong>说明：</strong><br />
						微信充值，兑换比例：<span class="hot">1</span>元=<span class="hot">100</span>'.$this->_tpl_vars['egoldname'].'<br />
					</div>
				</div>
			</div></div></div>';
?>