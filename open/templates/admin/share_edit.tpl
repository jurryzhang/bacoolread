<{include file="include/nav.tpl"}>
<!--Action boxes-->
<div class="container-fluid">
    <hr>

    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>渠道信息<input id="shareid" value="<{$smarty.get.id}>" type="hidden"></h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">渠道名称</label>
                            <div class="controls">
                                <input id="name" type="text" value="<{$data.name}>"> <span
                                        class="help-block blue">如:百度书城、掌阅等...仅做后台区分使用</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">鉴权方式</label>
                            <div class="controls">
                                <label><input type="checkbox" id="token" />密钥授权</label> <label><input
                                            type="checkbox" id="passip" />IP地址授权</label> <span
                                        class="help-block blue">至少选择一种鉴权方式</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">APPID</label>
                            <div class="controls">
                                <input id="domain" type="text" value="<{$data.appid}>" disabled>
                                <span class="help-block blue">渠道访问接口时唯一的身份标示</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">APPSECRET</label>
                            <div class="controls">
                                <input id="domain" type="text" value="<{$data.appsecret}>"
                                       disabled> <span class="help-block blue">渠道对应APPID唯一的密钥，渠道需保证密钥不外泄，否则有内容泄露风险！</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">白名单IP</label>
                            <div class="controls">
                                <textarea id="ip" rows="10"><{$data.ip}></textarea>
                                <span class="help-block blue">渠道服务器白名单设置，多个ip请使用回车，IP最后一段支持指定范围如:192.168.1.1-255</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">免费章节</label>
                            <div class="controls">
                                <input id="free" type="text" value="<{$data.free}>">
                                <span class="help-block blue">该参数控制每本书前多少章节免费</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">分类对应</label>
                            <div class="controls sortlistinput" style="white-space: nowrap;">
                                <input type="text" value="站内ID" style="width:3em" disabled>=><input type="text" value="对应ID" style="width:3em"  disabled>　<input type="text" value="站内名称" style="width:4em"  disabled>=><input type="text" value="对应名称" style="width:4em"  disabled>
                                <{section name=a loop=$sortlist}><{assign var=sortid value=$sortlist[a].sortid}>
                                <div class="row-fluid">
                                    <input type="text" value="<{$sortlist[a].sortid}>" style="width:3em" disabled>=><input type="text" value="<{$data.sortlist.$sortid.sortid|default:$sortlist[a].sortid}>" style="width:3em" diysort="true" sortid="<{$sortlist[a].sortid}>">　<input type="text" value="<{$sortlist[a].sortname}>" style="width:4em" disabled>=><input type="text" id="sortname_<{$sortlist[a].sortid}>" value="<{$data.sortlist.$sortid.sortname|default:$sortlist[a].sortname}>" style="width:4em">
                                </div>
                                <{/section}>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="btn btn-success" onclick="Miyue.Sharesave();">保存</div>
                        </div>
                    </div>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-align-justify"></i>
					</span>
                    <h5>授权批次</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th width="10%">批次</th>
                            <th width="30%">起始时间</th>
                            <th width="30%">结束时间</th>
                            <th width="10%">授权数量</th>
                            <th width="20%">管理</th>
                        </tr>
                        </thead>
                        <tbody>
                        <{section name=a loop=$batch}>
                            <tr class="gradeA">
                                <td><{$smarty.section.a.index+1}></td>
                                <td><{$batch[a].data.begintime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
                                <td><{$batch[a].data.overtime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
                                <td><{$batch[a].data.books|@count}></td>
                                <td class="center">
                                    <div class="btn btn-primary btn-mini" onclick="Miyue.Loadpage('index.php/admin/batch_edit/?id=<{$smarty.get.id}>&batchid=<{$batch[a].filename}>')">编辑</div>
                                    <div class="btn btn-danger btn-mini"  onclick="Miyue.Deletebatch('<{$smarty.get.id}>','<{$batch[a].filename}>')">删除</div>
                                </td>
                            </tr>
                            <{/section}>
                        </tbody>
                    </table>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>添加批次</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">起始时间</label>
                            <div class="controls">
                                <input type="text" id="begintime" value=""  data-date-format="yyyy-mm-dd">
                                <span class="help-block blue">授权起始时间，精确到当天00:00</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">结束时间</label>
                            <div class="controls">
                                <input type="text"id="overtime" value=""  data-date-format="yyyy-mm-dd">
                                <span class="help-block blue">授权结束时间，精确到当天00:00</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="btn btn-success" onclick="Miyue.Sharebatchsubmit();">添加</div>
                        </div>
                    </div>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-align-justify"></i>
					</span>
                    <h5>接口管理</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th width="25%">接口用途</th>
                            <th width="15%">数据模型</th>
                            <th width="15%">数据类型</th>
                            <th width="25%">编辑时间</th>
                            <th width="15%">管理</th>
                        </tr>
                        </thead>
                        <tbody>
                        <{section name=a loop=$api}>
                            <tr class="gradeA">
                                <td><{$api[a].data.apiuse}></td><{assign var=modelid value=$api[a].data.apimodel}>
                                <td><{$apimodel[$modelid].name}></td>
                                <td><{$api[a].data.apitype}></td>
                                <td><{$api[a].edittime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
                                <td class="center">
                                    <div class="btn btn-primary btn-mini" onclick="Miyue.Loadpage('index.php/admin/api_edit/?id=<{$smarty.get.id}>&apiid=<{$api[a].filename}>')">编辑</div>
                                    <div class="btn btn-danger btn-mini" onclick="Miyue.Deleteapi('<{$smarty.get.id}>','<{$api[a].filename}>')">删除</div>
                                </td>
                            </tr>
                            <{/section}>
                        </tbody>
                    </table>
                </div>
                <div class="widget-title">
					<span class="icon"> <i class="icon-info-sign"></i>
					</span>
                    <h5>添加接口</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">接口用途</label>
                            <div class="controls">
                                <input type="text" id="apiuse" value="">
                                <span class="help-block blue">请描述接口大致用途</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">数据模型</label>
                            <div class="controls">
                                <select id="apimodel">
                                    <{section name=a loop=$apimodel}>
                                    <option value="<{$smarty.section.a.index}>"><{$apimodel[a].name}></option>
                                    <{/section}>
                                </select>
                                <span class="help-block blue">请选择接口数据模型，该参数不可修改。</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">数据类型</label>
                            <div class="controls">
                                <select id="apitype">
                                    <{section name=c loop=$apitype}>
                                    <option value="<{$apitype[c]}>"><{$apitype[c]}></option>
                                    <{/section}>
                                </select>
                                <span class="help-block blue">请选择接口返回数据类型，该参数不可修改。</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="btn btn-success" onclick="Miyue.Shareapisubmit();">添加</div>
                        </div>
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
        "sDom": '<"">t<"F"p>',
    });
    $('select').select2();
    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();
    <{if in_array("token",$data.access)}>$.uniform.update($("#token").attr("checked", true));<{/if}>
    <{if in_array("passip",$data.access)}>$.uniform.update($("#passip").attr("checked", true));<{/if}>
</script>