(function(win) {
    if (!win.Login)
        var F = {
            Extend : function(dest, source, replace) {
                for (prop in source) {
                    if (replace == false && dest[prop] != null)
                        continue;
                    dest[prop] = source[prop];
                }
                ;
                return dest;
            }
        };
    win.Login = F;
})(window);
(function() {
    var Funcs = {
        check : function() {
            var username = $("#username").val();
            if (username == "") {
                Globals.TipsWarning("请输入用户名！");
                return;
            }
            var password = $("#password").val();
            if (password == "") {
                Globals.TipsWarning("请输入密码！");
                return;
            }
            Globals.Ajax(Site_logincheck, "post", {
            	username : username,
            	password : password,
            }, "json", function() {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    location.href="http://"+Admin_domain+"/"+Admin_index;
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        },
        logout : function() {
            Globals.Ajax(Site_logout, "get", "", "json", function() {
                // console.log("submiting");
                Globals.Ajaxloading();
            }, function(result) {
                if (result.Success) {
                    Globals.TipsSuccess(result.Msg);
                    setTimeout(function(){
                    	location.href="http://"+Admin_domain+"/"+Site_login;
                	},2000);
                } else {
                    Globals.TipsWarning(result.Msg);
                }
                Globals.Ajaxloaded();
                return;
            });
        }
    } 
    Login.Extend(Login, Funcs, false);
})();