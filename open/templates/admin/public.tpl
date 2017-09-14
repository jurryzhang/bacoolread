<{include file="head.tpl"}>
<div class="message-dialog bg-color-red fg-color-white">
    <p>
    		<{$pagecontent}> 
    		<{if $redirecturl neq ""}><a href="<{$redirecturl}>">2秒后自动跳转,点击立即跳转...</a><br/><{/if}>
    </p>
    	<a href="<{$redirecturl}>"><button class="place-right">单击我</button></a>
</div>
<{include file="foot.tpl"}>