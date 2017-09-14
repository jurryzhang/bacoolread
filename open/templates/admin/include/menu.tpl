<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> 仪表盘</a>
    <ul>
        <li><a href="javascript:void(0);" uri="<{URL_auto m="admin/dashboard"}>" onclick="Miyue.PageView(this)"><i class="icon icon-home"></i> <span>仪表盘</span></a> </li>
        <li> <a href="javascript:void(0);" uri="<{URL_auto m="admin/set"}>" onclick="Miyue.PageView(this)"><i class="icon icon-signal"></i> <span>平台设置</span></a> </li>
        <li> <a href="javascript:void(0);" uri="<{URL_auto m="auto/start"}>" onclick="Miyue.PageView(this)"><i class="icon icon-inbox"></i> <span>计划任务</span></a> </li>
		<li> <a href="javascript:void(0);" uri="<{URL_auto m="auto2/start"}>" onclick="Miyue.PageView(this)"><i class="icon icon-inbox"></i> <span>定时发布监控</span></a> </li>
        <li class="submenu"> <a uri="javascript:void(0);" onclick="Miyue.PageView(this,'slidedown')"><i class="icon icon-th-list"></i> <span>共享管理</span></a>
            <ul>
                <li><a href="javascript:void(0);" uri="<{URL_auto m="admin/share_add"}>" onclick="Miyue.PageView(this)">新增渠道</a></li>
                <li><a href="javascript:void(0);" uri="<{URL_auto m="admin/share"}>" onclick="Miyue.PageView(this)">渠道管理</a></li>
            </ul>
        </li>
        <li class="submenu"> <a uri="javascript:void(0);" onclick="Miyue.PageView(this,'slidedown')"><i class="icon icon-file"></i> <span>内容源管理</span></a>
            <ul>
                <li><a href="javascript:void(0);" uri="<{URL_auto m="admin/spider_add"}>" onclick="Miyue.PageView(this)">新增内容源</a></li>
                <li><a href="javascript:void(0);" uri="<{URL_auto m="admin/spider"}>" onclick="Miyue.PageView(this)">内容源管理</a></li>
            </ul>
        </li>
        <!--<li> <a href="javascript:void(0);" uri="<{URL_auto m="admin/access"}>" onclick="Miyue.PageView(this)"><i class="icon icon-inbox"></i> <span>权限管理</span></a> </li>-->
    </ul>
</div>
<!--sidebar-menu-->