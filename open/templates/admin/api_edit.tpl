<{include file="include/nav.tpl"}>
<!--Action boxes-->
<div class="container-fluid">
	 <a href="http://<{$smarty.const.SITEURL}>/<{URL_auto m="api/in" AppID=$smarty.get.id ApiID=$smarty.get.apiid}>" target="_blank">http://<{$smarty.const.SITEURL}>/<{URL_auto m="api/in" AppID=$smarty.get.id ApiID=$smarty.get.apiid}></a>
    <hr>

    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>接口设置<input type="hidden" id="shareid" value="<{$smarty.get.id}>"><input type="hidden" id="apiid" value="<{$smarty.get.apiid}>"></h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">接口用途</label>
                            <div class="controls">
                                <input type="text" id="apiuse" value="<{$data.apiuse}>">
                                <span class="help-block blue">请描述接口大致用途</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">数据模型</label>
                            <div class="controls">
                                <select id="apimodel" disabled="disabled">
                                    <{section name=a loop=$apimodel}>
                                    <option value="<{$smarty.section.a.index}>"<{if $data.apimodel eq $smarty.section.a.index}> selected<{/if}>><{$apimodel[a].name}></option>
                                    <{/section}>
                                </select>
                                <span class="help-block blue">请选择接口数据模型，该参数不可修改。</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">数据类型</label>
                            <div class="controls">
                                <select id="apitype" disabled="disabled">
                                    <{section name=c loop=$apitype}>
                                    <option value="<{$apitype[c]}>"<{if $data.apitype eq $apitype[c]}> selected<{/if}>><{$apitype[c]}></option>
                                    <{/section}>
                                </select>
                                <span class="help-block blue">请选择接口返回数据类型，该参数不可修改。</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>参数设置</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <{section name=a loop=$query}>
                        <div class="control-group"><{assign var=querystring value=$query[a]}>
                            <label class="control-label"><{$queryinfo.$querystring.text}>：<{$querystring}></label>
                            <div class="controls">
                                <input type="text" id="<{$querystring}>" value="<{$data.query.$querystring|default:$querystring}>" diyquery="true">
                                <span class="help-block blue">请填写渠道访问时自定义的参数名称，如果渠道没有参数个性化的需求请使用默认值，不要留空。</span>
                            </div>
                        </div>
                        <{/section}>
                    </div>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>输出模板（<{$data.apitype}>）</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="row-fluid nopadding nomargin ">
                    		<div class="span5"><textarea class="textarea_editor nomargin span12" rows="20" id="dome" disabled="disabled"></textarea></div>
                            <div class="span7">
                                <textarea class="textarea_editor nomargin span12" rows="20" id="template" placeholder="输出模板"><{$data.template}></textarea>
                            </div>
                    </div>
                    <div class="form-actions nomargin">
                            <div class="btn btn-success" onclick="Miyue.Apisave();">保存</div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $('#begintime').datepicker();
    $('#overtime').datepicker();
    $('.data-table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>',
    });
    $("#dome").load("configs/dome/<{$data.apimodel}>.html");
    $('select').select2();
    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();
    $(".controls input").unbind("keydown").bind("keydown", function(e) {
        if (e && e.keyCode == 13) {
            e.preventDefault();
            Miyue.Apisave();
        }
    });
</script>