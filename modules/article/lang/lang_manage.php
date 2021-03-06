<?php
/**
 * 语言包-小说管理
 *
 * 语言包-小说管理
 * 
 * 调用模板：无
 * 
 * @category   jieqicms
 * @package    article
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: lang_manage.php 228 2008-11-27 06:44:31Z juny $
 */

$jieqiLang['article']['manage']=1; //表示本语言包已经包含

$jieqiLang['article']['article_not_exists']='对不起，该小说不存在！';
//articleclean.php
$jieqiLang['article']['noper_clean_article']='对不起，您无权清空本小说！';
$jieqiLang['article']['article_clean_collect']='本小说所有章节已经删除，现在重新开始采集！';
$jieqiLang['article']['article_clean_success']='本小说所有章节已经删除，您可以继续其他操作！';
//articledel.php
$jieqiLang['article']['noper_delete_article']='对不起，您无权删除本小说！';
$jieqiLang['article']['article_delete_success']='小说已经删除，您可以继续其他操作！';
//articlemanage.php repack.php
$jieqiLang['article']['noper_manage_article']='对不起，您无权管理本小说！';
$jieqiLang['article']['manage_article_info']='信息';
$jieqiLang['article']['manage_article_read']='阅读';
$jieqiLang['article']['add_volume']='新建分卷';
$jieqiLang['article']['add_chapter']='增加章节';
$jieqiLang['article']['edit_article']='编辑小说';
$jieqiLang['article']['delete_article_confirm']='确实要删除该小说么？';
$jieqiLang['article']['delete_article']='删除小说';
$jieqiLang['article']['clear_chapter_confirm']='确实要清空（删除所有章节）该小说么？';
$jieqiLang['article']['clear_chapter']='清空小说';
$jieqiLang['article']['manage_review']='管理书评';
$jieqiLang['article']['delete_chapter_confirm']='确实要删除该章节么？';
$jieqiLang['article']['delete_volume_confirm']='确实要删除该分卷么？';
$jieqiLang['article']['chapter_edit_tag']='[编]';
$jieqiLang['article']['chapter_delete_tag']='[删]';
$jieqiLang['article']['chapter_sort']='章节排序';
$jieqiLang['article']['choose_chapter_volume']='选择章节或分卷';
$jieqiLang['article']['chapter_move_to']='移动到';
$jieqiLang['article']['chapter_top_sort']='--最前面--';
$jieqiLang['article']['chapter_after_sort']='之后';
$jieqiLang['article']['sort_confirm']='确 定';
$jieqiLang['article']['article_repack']='重新生成';
$jieqiLang['article']['repack_select']='生成选项';
$jieqiLang['article']['repack_opf']='生成OPF(小说目录结构文件)';
$jieqiLang['article']['repack_html']='生成HTML';
$jieqiLang['article']['repack_index']='生成目录页HTML';
$jieqiLang['article']['repack_chapter']='生成章节页HTML';
$jieqiLang['article']['repack_txtjs']='生成章节内容JS';
$jieqiLang['article']['repack_zip']='生成ZIP';
$jieqiLang['article']['repack_fullpage']='生成HTML全文阅读';
$jieqiLang['article']['repack_txtfullpage']='生成TXT全文阅读';
$jieqiLang['article']['repack_umdpage']='生成手机电子书UMD';
$jieqiLang['article']['repack_jarpage']='生成手机电子书JAR';

$jieqiLang['article']['new_avote']='新建投票';
$jieqiLang['article']['manage_avote']='管理投票';
//repack.php
$jieqiLang['article']['need_repack_option']='对不起，请先选择需要重新生成的选项！';
$jieqiLang['article']['wait_to_execute']='正在处理，请耐心等待......';
$jieqiLang['article']['article_repack_success']='恭喜您，小说已经重新生成！';

//admin/batchrepack.php
$jieqiLang['article']['repack_start_id']='请输入正确的起始序号！';
$jieqiLang['article']['batch_repack_success']='恭喜您，全部小说处理完成！<br /><br /><a href="%s">点击这里返回起始页面</a>';
$jieqiLang['article']['batch_repack_doing']='正在处理小说《%s》<br />起始时间：%s<br />结束时间：%s<br />当前时间：%s<br />当前序号：%s<br />请耐心等待......';
$jieqiLang['article']['repack_success_next']='恭喜您，本小说已经重新生成，系统将自动处理下一篇！';
$jieqiLang['article']['repack_use_id']='小说批量生成（按序号）';
$jieqiLang['article']['repack_start_id']='起始小说序号';
$jieqiLang['article']['repack_end_id']='结束小说序号';
$jieqiLang['article']['repack_start_button']='开始生成';
$jieqiLang['article']['repack_use_time']='小说批量生成（按更新时间）';
$jieqiLang['article']['repack_start_time']='起始时间';
$jieqiLang['article']['repack_end_time']='结束时间';
$jieqiLang['article']['repack_time_format']='时间格式举例：2005-01-23 23:06:30';
$jieqiLang['article']['repack_next_html']='<html><head><title>小说批量生成</title><meta http-equiv="Content-Type" content="text/html; charset=%s"></head><body><br /><br />&nbsp;&nbsp;%s<br /><br /><a href="%s">如浏览器不能自动转换，点击这里生成下一篇。</a>	<script type="text/javascript">document.location="%s";</script></body></html>';
$jieqiLang['article']['article_batch_repack']='小说批量生成';
$jieqiLang['article']['repack_fromto_id']='正在处理小说《%s》<br />本文序号：%s<br />结束序号：%s<br />请耐心等待......';
$jieqiLang['article']['repack_noid_next']='该序号的小说不存在，系统将自动处理下一篇！';
$jieqiLang['article']['need_time_format']='请输入正确的起始时间！';

//admin/batchaction.php
$jieqiLang['article']['need_batch_ids']='对不起，请先选择要处理的小说！';
$jieqiLang['article']['need_delete_ids']='对不起，请先选择要删除的小说！';
$jieqiLang['article']['start_delete_article']='<br />正在删除小说《%s》...';
$jieqiLang['article']['delete_article_info']='删除小说信息...';
$jieqiLang['article']['delete_read_file']='删除阅读文件...';
$jieqiLang['article']['delete_chapters']='删除章节...';
$jieqiLang['article']['delete_attachments']='删除附件...';
$jieqiLang['article']['delete_reviews']='删除书评...';
$jieqiLang['article']['batch_delete_success']='<hr />小说批量删除完成！';
$jieqiLang['article']['batch_delete_complete']='小说已经删除，您可以继续其他操作！';
$jieqiLang['article']['batch_show_success']='<hr />小说批量审核完成！';
$jieqiLang['article']['batch_show_complete']='小说已经审核完成，您可以继续其他操作！';
$jieqiLang['article']['batch_hide_success']='<hr />小说批量隐藏完成！';
$jieqiLang['article']['batch_hide_complete']='小说已经隐藏完成，您可以继续其他操作！';
$jieqiLang['article']['batch_ready_success']='<hr />小说批量待审完成！';
$jieqiLang['article']['batch_ready_complete']='小说已经设置成待审，您可以继续其他操作！';

//batchreplace.php
$jieqiLang['article']['need_replace_from']='请输入查找字符串！';
$jieqiLang['article']['replace_lines_difference']='您选择了逐行替换的模式，但是查找内容和替换内容的行数并不相同！';
$jieqiLang['article']['replace_lines_empay']='您选择了逐行替换的模式，但是查找内容里面有空行！';
$jieqiLang['article']['need_replace_filetype']='对不起，请先选择需要替换的文件类型！';
$jieqiLang['article']['need_replace_startid']='请输入正确的起始序号！';
$jieqiLang['article']['batch_replace_success']='恭喜您，全部小说处理完成！<br /><br /><a href="%s">点击这里返回起始页面</a>';
$jieqiLang['article']['need_replace_starttime']='请输入正确的起始时间！';
$jieqiLang['article']['replace_use_id']='小说内容批量替换（按序号）';
$jieqiLang['article']['replace_start_id']='起始小说序号';
$jieqiLang['article']['replace_end_id']='结束小说序号';
$jieqiLang['article']['replace_search_string']='查找字符串';
$jieqiLang['article']['replace_to']='替换成';
$jieqiLang['article']['replace_type']='替换方法';
$jieqiLang['article']['replace_as_block']='整个内容作为一个字符串替换';
$jieqiLang['article']['replace_as_line']='每行内容作为一个字符串替换';
$jieqiLang['article']['replace_filetype']='替换文件类型';
$jieqiLang['article']['replace_file_txt']='小说原始内容(txt)';
$jieqiLang['article']['replace_file_html']='分章节阅读(html)';
$jieqiLang['article']['replace_file_full']='全文阅读(html)';
$jieqiLang['article']['replace_filesize']='文件大小';
$jieqiLang['article']['replace_size_nolimit']='不限制';
$jieqiLang['article']['replace_size_more']='大于1K';
$jieqiLang['article']['replace_size_less']='小于1K';
$jieqiLang['article']['replace_start_button']='开始生成';
$jieqiLang['article']['replace_use_time']='小说内容批量替换（按更新时间）';
$jieqiLang['article']['replace_start_time']='起始时间';
$jieqiLang['article']['replace_end_time']='结束时间';
$jieqiLang['article']['replace_time_format']='时间格式举例：2005-01-23 23:06:30';
$jieqiLang['article']['replace_next_html']='<html><head><title>小说内容批量替换</title><meta http-equiv="Content-Type" content="text/html; charset=%s"></head><body><br /><br />&nbsp;&nbsp;%s<br /><br /><a href="%s">如浏览器不能自动转换，点击这里生成下一篇。</a><script type="text/javascript">document.location="%s";</script></body></html>';
$jieqiLang['article']['replace_id_doing']='正在处理序号 %s 的小说<br />请耐心等待......<br />';
$jieqiLang['article']['replace_success_next']='恭喜您，本小说已经重新生成，系统将自动处理下一篇！';
$jieqiLang['article']['replace_noid_next']='该序号的小说不存在，系统将自动处理下一篇！';
//admin/createfake.php createstatic.php
$jieqiLang['article']['create_id_neednum']='起始序号和终止序号必须为数字，并且终止序号大于等于起始序号！';
$jieqiLang['article']['create_id_numerror']='参数错误，终止序号小于起始序号！';
$jieqiLang['article']['create_info_doing']='开始生成小说信息页面，生成时间跟页面数量有关，请耐心等待...<br>起始序号：%s 终止序号：%s<br>';
$jieqiLang['article']['create_info_success']='恭喜您，全部小说信息页面生成完成！';
$jieqiLang['article']['create_sort_doing']='开始生成小说分类页面，生成时间跟页面数量有关，请耐心等待...<br>起始序号：%s 终止序号：%s<br>正在生成 全部类别：';
$jieqiLang['article']['create_sort_info']='<br><hr><br>正在生成类别 %s：';
$jieqiLang['article']['create_sort_success']='恭喜您，全部分类页面生成完成！';
$jieqiLang['article']['create_initial_doing']='开始生成小说首字母分类页面，生成时间跟页面数量有关，请耐心等待...<br>起始序号：%s 终止序号：%s：';
$jieqiLang['article']['create_initial_info']='<br><hr><br>正在生成字母 %s：';
$jieqiLang['article']['create_initial_success']='恭喜您，全部首字母分类页面生成完成！';
$jieqiLang['article']['create_toplist_doing']='开始生成排行榜页面，生成时间跟页面数量有关，请耐心等待...<br>起始序号：%s 终止序号：%s：';
$jieqiLang['article']['create_toplist_info']='<br><hr><br>正在生成 %s：';
$jieqiLang['article']['create_toplist_success']='恭喜您，全部排行榜页面生成完成！';
$jieqiLang['article']['create_para_error']='对不起，提交的参数错误，您没有选择要生成的页面类别，请返回并重新提交！';
$jieqiLang['article']['top_allvisit']='总排行榜';
$jieqiLang['article']['top_monthvisit']='月排行榜';
$jieqiLang['article']['top_weekvisit']='周排行榜';
$jieqiLang['article']['top_dayvisit']='日排行榜';
$jieqiLang['article']['top_avall']='原创总排行';
$jieqiLang['article']['top_avmonth']='原创月排行';
$jieqiLang['article']['top_avweek']='原创周排行';
$jieqiLang['article']['top_avday']='原创日排行';
$jieqiLang['article']['top_voteall']='总推荐榜';
$jieqiLang['article']['top_votemonth']='月推荐榜';
$jieqiLang['article']['top_voteweek']='周推荐榜';
$jieqiLang['article']['top_voteday_titile']='日推荐榜';
$jieqiLang['article']['top_postdate']='最新入库';
$jieqiLang['article']['top_toptime']='本站推荐';
$jieqiLang['article']['top_goodnum']='总收藏榜';
$jieqiLang['article']['top_size']='字数排行';
$jieqiLang['article']['top_authorupdate']='原创更新';
$jieqiLang['article']['top_masterupdate']='转载更新';
$jieqiLang['article']['top_lastupdate']='最近更新';
$jieqiLang['article']['create_review_idnum']='起始序号和终止序号必须为数字，并且终止序号大于等于起始序号！';
$jieqiLang['article']['create_review_doing']='开始生成书评js，生成时间跟页面数量有关，请耐心等待...<br>起始序号：%s 终止序号：%s<br>';
$jieqiLang['article']['create_review_success']='恭喜您，全部书评js生成完成！';
//admin/setgood.php
$jieqiLang['article']['article_setgood_success']='本站推荐完成！<br /><br />您可以关闭本页面。';
$jieqiLang['article']['article_notgood_success']='取消推荐完成！<br /><br />您可以关闭本页面。';

//admin/batchclean.php
$jieqiLang['article']['clean_bad_parm']='对不起，提交的参数错误！<br />如果你不想使用某个条件，请留空，否则必须输入正确的参数类型。';
$jieqiLang['article']['clean_operate_delarticle']='删除小说';
$jieqiLang['article']['clean_operate_delchapter']='删除所有章节';
$jieqiLang['article']['clean_operate_delattach']='删除有附件的章节';
$jieqiLang['article']['clean_operate_hidearticle']='隐藏小说';
$jieqiLang['article']['clean_operate_showarticle']='显示小说';
$jieqiLang['article']['clean_show_start']='您选择的是“%s”<br />小说清理可能会花费比较多时间，请耐心等待，不要关闭浏览器......<br />';
$jieqiLang['article']['clean_show_num']='共有 %s 篇小说需要处理：<br />';
$jieqiLang['article']['clean_article_doing']='正在处理《%s》（ID:%s）...<br />';
$jieqiLang['article']['clean_all_success']='<br />恭喜您，全部处理完成，您可以关闭本窗口！';
?>