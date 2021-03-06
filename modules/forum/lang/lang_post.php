<?php
/**
 * 语言包-论坛帖子发表、回复
 *
 * 语言包-论坛帖子发表、回复
 * 
 * 调用模板：无
 * 
 * @category   jieqicms
 * @package    forum
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: lang_post.php 327 2009-02-05 09:30:51Z juny $
 */

$jieqiLang['forum']['post']=1; //表示本语言包已经包含
//delpost.php
$jieqiLang['forum']['forum_not_exists']='对不起，该论坛不存在！';
$jieqiLang['forum']['post_not_exists']='对不起，该帖子不存在！';
$jieqiLang['forum']['topic_not_exists']='对不起，该主题不存在！';
$jieqiLang['forum']['noper_delete_post']='对不起，您无权删除该帖子！';
$jieqiLang['forum']['delete_post_failure']='删除帖子失败，请与管理员联系！';
$jieqiLang['forum']['delete_post_success']='帖子删除成功，系统自动返回该主题列表！';
//newpost.php postedit.php
$jieqiLang['forum']['need_post_title']='标题不能为空！';
$jieqiLang['forum']['need_post_content']='帖子内容不能为空！';
$jieqiLang['forum']['min_post_content']='帖子内容不能少于 %s 字节！';
$jieqiLang['forum']['max_post_content']='帖子内容不能多于 %s 字节！';
$jieqiLang['forum']['upload_filetype_error']='%s不是允许上传的文件类型！';
$jieqiLang['forum']['upload_filetype_safe']='为了安全起见，系统默认禁止上传 *.%s 文件！';
$jieqiLang['forum']['upload_filesize_over']='%s文件大小超出系统限制的%dK！';
$jieqiLang['forum']['post_words_deny']='对不起，帖子内容含有禁用的单词：<br />%s';
$jieqiLang['forum']['post_words_water']='对不起，本帖子被怀疑为灌水。如有误判，尚请谅解！';
$jieqiLang['forum']['post_time_limit']='对不起，两次发贴的间隔时间不得少于 %s 秒';
$jieqiLang['forum']['post_topic_failure']='发表主题失败，请与管理员联系！';
$jieqiLang['forum']['topic_is_locked']='对不起，该主题已锁定！';
$jieqiLang['forum']['post_faliure']='发表帖子失败，请与管理员联系！';
$jieqiLang['forum']['post_success']='帖子发表成功，系统自动返回该主题！';
$jieqiLang['forum']['post_new']='发表新主题';
$jieqiLang['forum']['post_reply']='发表回复';
$jieqiLang['forum']['post_button']='发 表';
$jieqiLang['forum']['post_attach']='附件';
$jieqiLang['forum']['post_image']='图片';
$jieqiLang['forum']['attach_limit']='附件限制：';
$jieqiLang['forum']['attach_filetype']='文件类型：';
$jieqiLang['forum']['attach_image_max']='图片最大：';
$jieqiLang['forum']['attach_file_max']='文件最大：';
$jieqiLang['forum']['noper_edit_post']='对不起，您无权编辑该帖子！';
$jieqiLang['forum']['edit_post_failure']='编辑帖子失败，请与管理员联系！';
$jieqiLang['forum']['edit_post_success']='帖子编辑成功，系统自动返回该主题页面！';
$jieqiLang['forum']['post_edit']='编辑帖子';
$jieqiLang['forum']['now_attach']='现有附件：';
$jieqiLang['forum']['attach_edit_note']='（取消打勾表示删除该附件）';
$jieqiLang['forum']['edit_post_button']='保 存';
$jieqiLang['forum']['noper_new_post']='对不起，您无权发表新帖！';
$jieqiLang['forum']['noper_reply_post']='对不起，您无权回复帖子！';


//table field
$jieqiLang['forum']['table_forumtopics_topictitle']='标题';

$jieqiLang['forum']['table_forumposts_posttext']='内容';

?>