<{include file="include/nav.tpl"}>
<!--Action boxes-->
<div class="container-fluid"><hr>

    <!--Chart-box-->
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                <h5>数据概览</h5>
            </div>
            <div class="widget-content" >
                <div class="row-fluid">
                    <div class="span3">
                        <ul class="site-stats">
                            <li class="bg_lh" onclick="Miyue.PageView('<{URL_auto m="admin/share"}>')"><i class="icon-indent-left"></i> <strong><{$totalshare|@count}></strong> <small>输出渠道</small></li>
                            <li class="bg_lh" onclick="Miyue.PageView('<{URL_auto m="admin/spider"}>')"><i class="icon-indent-right"></i> <strong><{$totalspider|@count}></strong> <small>输入CP</small></li>
                            <li class="bg_lh" onclick="Miyue.PageView('<{URL_auto m="admin/spider"}>')"><i class="icon-tag"></i> <strong><{$totalbook}></strong> <small>收录书籍</small></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End-Chart-box-->

</div>