(function(win) {
	if (!win.Globals)
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
	win.Globals = F;
})(window);
(function() {
	var Funcs = {
		Ajax : function(url, type, data, datatype, beforesend, success) {
			$.ajax({
				type : type,
				url : url,
				async : true,
				data:data,
				dataType : datatype,
				beforeSend : beforesend,
				success : success
			});
		},
		TipsWarning : function() {
			$.gritter.add({
				title : arguments[1] || "Sorry！",
				text : arguments[0] || "",
				sticky : false,
				time : 3000,
				class_name : 'Tips-waning',
			});
			if(arguments[0]=="请登录后再访问！"){
            	setTimeout(function(){
            		location.href="http://"+Admin_domain+"/"+Site_login;
            	},2000);
            }
		},
		TipsSuccess : function(){
			$.gritter.add({
				title : arguments[1] || "Congratulations！",
				text : arguments[0] || "",
				sticky : false,
				time : 3000,
				class_name : 'Tips-success',
			});
		},
		PushState : function(title, url) {
			var state = {
				title : title,
				url : url
			};
			history.pushState(state, title, url);
		},
		Pageloading : function(){
			$("#content").addClass("pageloading");
			$(".loadingbar").remove();
			var loading = "<div id=\"loading\" class=\"spinner loadingbar\">";
			loading += "<div class=\"rect1\"></div>";
			loading += "<div class=\"rect2\"></div>";
			loading += "<div class=\"rect3\"></div>";
			loading += "<div class=\"rect4\"></div>";
			loading += "<div class=\"rect5\"></div>";
			loading += "<div class=\"rect6\"></div>";
			loading += "<div class=\"rect7\"></div>";
			loading += "<div class=\"rect8\"></div>";
			loading += "<div class=\"rect9\"></div>";
			loading += "<div class=\"rect10\"></div>";
			loading += "</div>";
			$("body").append(loading);
		},
		Pageloaded : function(){
			$(".pageloading").removeClass("pageloading");
			$(".loadingbar").remove();
		},
		Ajaxloading : function(){
			$(".loadingbar").remove();
			var loading = "<div id=\"loading\" class=\"spinner loadingbar ajaxloading\">";
			loading += "<div class=\"rect1\"></div>";
			loading += "<div class=\"rect2\"></div>";
			loading += "<div class=\"rect3\"></div>";
			loading += "<div class=\"rect4\"></div>";
			loading += "<div class=\"rect5\"></div>";
			loading += "<div class=\"rect6\"></div>";
			loading += "<div class=\"rect7\"></div>";
			loading += "<div class=\"rect8\"></div>";
			loading += "<div class=\"rect9\"></div>";
			loading += "<div class=\"rect10\"></div>";
			loading += "</div>";
			$("body").append(loading);
		},
		Ajaxloaded : function(){
			$(".loadingbar").remove();
		},
		Transdate : function(endTime){ 
			var date=new Date(); 
			date.setFullYear(endTime.substring(0,4)); 
			date.setMonth(endTime.substring(5,7)-1); 
			date.setDate(endTime.substring(8,10)); 
			date.setHours(endTime.substring(11,13)); 
			date.setMinutes(endTime.substring(14,16)); 
			date.setSeconds(endTime.substring(17,19)); 
			return Date.parse(date)/1000; 
		},
		Refresh : function(){
			var uri = window.location.hash || "";
			if(uri!=""){
				uri = uri.replace("#","");
				$("#content").load(uri);
			}
		}
	}
	Globals.Extend(Globals, Funcs, false);
})();