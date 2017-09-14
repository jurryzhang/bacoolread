<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb">
		<a href="javascript:void(0);" class="tip-bottom" data-original-title="仪表盘" onclick="Miyue.PageView('<{URL_auto m="admin/dashboard"}>');"><i class="icon-home"></i> 仪表盘</a>
		<{section name=a loop=$breadcrumb}><{assign var=breadno value=$smarty.section.a.index+1}>
		<a href="javascript:void(0);" <{if $breadno==$breadcrumb|@count}>class="current"<{else}>class="tip-bottom"<{/if}> onclick="Miyue.PageView('<{$breadcrumb[a].link}>');" data-original-title="<{$breadcrumb[a].text}>"><{$breadcrumb[a].text}></a> 
		<{/section}>
	</div>
    <h1><{$title}></h1>
</div>
<!--End-breadcrumbs-->