<!DOCTYPE html>
<html lang="en">
<head>
    <title>内容控制平台</title><meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="http://<{$smarty.const.SITEURL}>/" />
    <link rel="stylesheet" href="templates/admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="templates/admin/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="templates/admin/css/matrix-login.css" />
    <link rel="stylesheet" href="templates/admin/css/jquery.gritter.css" />
    <link href="templates/admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.useso.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <script src="<{URL_auto m="site/config"}>"></script>
</head>
<body>
<div id="loginbox">
    <form id="loginform" class="form-vertical" action="http://themedesigner.in/demo/matrix-admin/index.html">
        <div class="control-group normal_text"> <h3><img src="templates/admin/img/logo.png" alt="Logo" /></h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"></i></span><input type="text" id="username" placeholder="用户名" />
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" id="password" placeholder="密　码" />
                </div>
            </div>
        </div>
        <div class="form-actions">
            <span class="pull-left"><a href="javascript:void(0)" class="flip-link btn btn-info" id="to-recover">忘记密码？</a></span>
            <span class="pull-right"><a href="javascript:void(0)" class="btn btn-success" onclick="Login.check();"/> 登录</a></span>
        </div>
    </form>
    <form id="recoverform" action="#" class="form-vertical">
        <p class="normal_text">很抱歉，我们目前暂不提供邮箱找回方式找回账号密码！.</p>

        <div class="controls">
            <div class="main_input_box">
                <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" value="请联系运维同事找回您的账号与密码！" disabled="disabled"/>
            </div>
        </div>

        <div class="form-actions">
            <span class="pull-left"><a href="javascript:void(0)" class="flip-link btn btn-success" id="to-login">&laquo; 返回登录</a></span>
            <span class="pull-right"><a class="btn btn-info"/>下一步</a></span>
        </div>
    </form>
</div>
<script src="templates/admin/js/jquery.min.js"></script>
<script src="templates/admin/js/jquery.gritter.min.js"></script>
<script src="templates/admin/js/Globals.js"></script>
<script src="templates/admin/js/Login.js"></script>
</body>

</html>
