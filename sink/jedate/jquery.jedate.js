/**
 @Name : jeDate v3.8 ���ڿؼ�
 @Author: chen guojun
 @Date: 2017-03-10
 @QQȺ��516754269
 @������http://www.jayui.com/jedate/ �� https://github.com/singod/jeDate
 */
window.console && (console = console || {log : function(){return;}});
;(function(root, factory) {
	//amd
	if (typeof define === 'function' && define.amd) {
		define(['jquery'], factory);
	} else if (typeof exports === 'object') { //umd
		module.exports = factory();
	} else {
		root.jeDate = factory(window.jQuery || $);
	}
})(this, function($) {
	var jet = {}, doc = document, ymdMacth = /\w+|d+/g, parseInt = function (n) { return window.parseInt(n, 10);},
	config = {
		skinCell:"jedateblue",
		format:"YYYY-MM-DD hh:mm:ss", //���ڸ�ʽ
		minDate:"1900-01-01 00:00:00", //��С����
		maxDate:"2099-12-31 23:59:59" //�������
	};
	$.fn.jeDate = function(options){
		return this.each(function(){
			return new jeDate($(this),options||{});
		});
	};
	$.extend({
		jeDate:function(elem, options){
			return $(elem).each(function(){
				return new jeDate($(this),options||{});
			});
		}
	});

	jet.docScroll = function(type) {
		type = type ? "scrollLeft" :"scrollTop";
		return doc.body[type] | doc.documentElement[type];
	};
	jet.winarea = function(type) {
		return doc.documentElement[type ? "clientWidth" :"clientHeight"];
	};
	jet.isShow = function(elem, bool) {
		elem.css({display: bool != true ? "none" :"block"});
	};
	//�ж��Ƿ�����
	jet.isLeap = function(y) {
		return (y % 100 !== 0 && y % 4 === 0) || (y % 400 === 0);
	};
	//��ȡ���µ�������
	jet.getDaysNum = function(y, m) {
		var num = 31;
		switch (parseInt(m)) {
			case 2:
				num = jet.isLeap(y) ? 29 : 28; break;
			case 4: case 6: case 9: case 11:
			    num = 30; break;
		}
		return num;
	};
	//��ȡ������
	jet.getYM = function(y, m, n) {
		var nd = new Date(y, m - 1);
		nd.setMonth(m - 1 + n);
		return {
			y: nd.getFullYear(),
			m: nd.getMonth() + 1
		};
	}
	//��ȡ�ϸ���
	jet.getPrevMonth = function(y, m, n) {
		return jet.getYM(y, m, 0 - (n || 1));
	};
	//��ȡ�¸���
	jet.getNextMonth = function(y, m, n) {
		return jet.getYM(y, m, n || 1);
	};
	//������λ
	jet.digit = function(num) {
		return num < 10 ? "0" + (num | 0) :num;
	};
	//�ж��Ƿ�Ϊ����
	jet.IsNum = function(str){
		return (str!=null && str!="") ? !isNaN(str) : false;
	};
	//ת�����ڸ�ʽ
	jet.parse = function(ymd, hms, format) {
		ymd = ymd.concat(hms);
		var hmsCheck = jet.parseCheck(format, false).substring(0, 5) == "hh:mm", num = 2;
		return format.replace(/YYYY|MM|DD|hh|mm|ss/g, function(str, index) {
			var idx = hmsCheck ? ++num :ymd.index = ++ymd.index | 0;
			return (ymd[idx]==undefined||ymd[idx]=="") ? ymd[idx] : jet.digit(ymd[idx]);

		});
	};
	jet.parseCheck = function(format, bool) {
		var ymdhms = [];
		format.replace(/YYYY|MM|DD|hh|mm|ss/g, function(str, index) {
			ymdhms.push(str);
		});
		return ymdhms.join(bool == true ? "-" :":");
	};
	jet.checkFormat = function(format) {
		var ymdhms = [];
		format.replace(/YYYY|MM|DD|hh|mm|ss/g, function(str, index) {
			ymdhms.push(str);
		});
		return ymdhms.join("-");
	};
	jet.parseMatch = function(str) {
		var timeArr = str.split(" ");
		return timeArr[0].match(ymdMacth);
	};
	//��֤����
	jet.checkDate = function (date) {
		var dateArr = date.match(ymdMacth);
		if (isNaN(dateArr[0]) || isNaN(dateArr[1]) || isNaN(dateArr[2])) return false;
		if (dateArr[1] > 12 || dateArr[1] < 1) return false;
		if (dateArr[2] < 1 || dateArr[2] > 31) return false;
		if ((dateArr[1] == 4 || dateArr[1] == 6 || dateArr[1] == 9 || dateArr[1] == 11) && dateArr[2] > 30) return false;
		if (dateArr[1] == 2) {
			if (dateArr[2] > 29) return false;
			if ((dateArr[0] % 100 == 0 && dateArr[0] % 400 != 0 || dateArr[0] % 4 != 0) && dateArr[2] > 28) return false;
		}
		return true;
	};
	//��ʼ������
	jet.initDates = function(num, format) {
		format = format || 'YYYY-MM-DD hh:mm:ss';
		if(typeof num === "string"){
			var newDate = new Date(parseInt(num.substring(0,10)) * 1e3);
		}else{
			num = num | 0;
			var newDate = new Date(), todayTime = newDate.getTime() + 1000*60*60*24*num;
			newDate.setTime(todayTime);
		}
		var years = newDate.getFullYear(), months = newDate.getMonth() + 1, days = newDate.getDate(), hh = newDate.getHours(), mm = newDate.getMinutes(), ss = newDate.getSeconds();
		return jet.parse([ years, jet.digit(months), jet.digit(days) ], [ jet.digit(hh), jet.digit(mm), jet.digit(ss) ], format);
	};
	jet.montharr = [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ];
	jet.weeks = [ "��", "һ", "��", "��", "��", "��", "��" ];
	//�ж�Ԫ������
	jet.isValHtml = function(that) {
		return /textarea|input/.test(that[0].tagName.toLocaleLowerCase());
	};
	jet.isBool = function(obj){  return (obj == undefined || obj == true ?  true : false); };
	jet.addDateTime = function(time,num,type,format){
		var ishhmm = jet.checkFormat(format).substring(0, 5) == "hh-mm" ? true :false;
		var nocharDate = ishhmm ? time.replace(/^(\d{2})(?=\d)/g,"$1,") : time.substr(0,4).replace(/^(\d{4})/g,"$1,") + time.substr(4).replace(/^(\d{2})(?=\d)/g,"$1,");
		var tarr = jet.IsNum(time) ? nocharDate.match(ymdMacth) : time.match(ymdMacth), date = new Date(),
			tm0 = parseInt(tarr[0]),  tm1 = tarr[1] == undefined ? date.getMonth() + 1 : parseInt(tarr[1]), tm2 = tarr[2] == undefined ? date.getDate() : parseInt(tarr[2]),
			tm3 = tarr[3] == undefined ? date.getHours() : parseInt(tarr[3]), tm4 = tarr[4] == undefined ? date.getMinutes() : parseInt(tarr[4]), tm5 = tarr[5] == undefined ? date.getMinutes() : parseInt(tarr[5]);
		var newDate = new Date(tm0,jet.digit(tm1)-1,(type == "DD" ? tm2 + num : tm2),(type == "hh" ? tm3 + num : tm3),(type == "mm" ? tm4 + num : tm4),jet.digit(tm5));
		return jet.parse([ newDate.getFullYear(), newDate.getMonth()+1, newDate.getDate() ], [ newDate.getHours(), newDate.getMinutes(), newDate.getSeconds() ], format);
	};
	jet.boxCell = "#jedatebox";
	function jeDate(elem, opts){
		this.opts = opts;
		this.valCell = elem;
		this.init();
	}
	var jedfn = jeDate.prototype;
	jedfn.init = function(){
		var that = this, opts = that.opts, zIndex = opts.zIndex == undefined ? 2099 : opts.zIndex,
			isinitVal = (opts.isinitVal == undefined || opts.isinitVal == false) ? false : true,
		    createDiv = $("<div id="+jet.boxCell.replace(/\#/g,"")+" class='jedatebox "+(opts.skinCell || config.skinCell)+"'></div");
		jet.fixed = jet.isBool(opts.fixed);
		createDiv.attr("author","chen guojun--www.jayui.com--version:"+$.dateVer);
		createDiv.css({"z-index": zIndex ,"position":(jet.fixed == true ? "absolute" :"fixed"),"display":"block"});
		var initVals = function(elem) {
			var jeformat = opts.format || config.format, inaddVal = opts.initAddVal || [0], num, type;
			if(inaddVal.length == 1){
				num = inaddVal[0], type = "DD";
			}else{
				num = inaddVal[0], type = inaddVal[1];
			}
			var isnosepYMD = $.inArray(jet.checkFormat(jeformat), ["YYYYMM","YYYYMMDD","YYYYMMDDhh","YYYYMMDDhhmm","YYYYMMDDhhmmss"]);
			var nowDateVal = jet.initDates(0, jeformat), jeaddDate = (isnosepYMD != -1) ? nowDateVal : jet.addDateTime(nowDateVal, num, type, jeformat);
			(elem.val() || elem.text()) == "" ? jet.isValHtml(elem) ? elem.val(jeaddDate) :elem.text(jeaddDate) :jet.isValHtml(elem) ? elem.val() : elem.text();
		};
		//Ϊ������ʼ����ʱ������ֵ
		if (isinitVal && jet.isBool(opts.insTrigger)) {
			that.valCell.each(function() {
				initVals($(this));
			});
		}
		if (jet.isBool(opts.insTrigger)) {
			that.valCell.on("click", function (ev) {
				ev.stopPropagation();
				if ($(jet.boxCell).length > 0) return;
				jet.format = opts.format || config.format;
				jet.minDate = opts.minDate || config.minDate;
				jet.maxDate = opts.maxDate || config.maxDate;
				$("body").append(createDiv);
				that.setHtml(opts);
			});
		}else {
			jet.format = opts.format || config.format;
			jet.minDate = opts.minDate || config.minDate;
			jet.maxDate = opts.maxDate || config.maxDate;
			$("body").append(createDiv);
			that.setHtml(opts);    
		}   
	};
	//��λ���
	jedfn.orien = function(obj, self, pos) {  
		var tops, leris, ortop, orleri, rect = jet.fixed ? self[0].getBoundingClientRect() : obj[0].getBoundingClientRect();
		if(jet.fixed) {
            //����Ŀ��Ԫ�ؼ��㵯��λ��
			leris = rect.right + obj.outerWidth() / 1.5 >= jet.winarea(1) ? rect.right - obj.outerWidth() : rect.left + (pos ? 0 : jet.docScroll(1));
			tops = rect.bottom + obj.outerHeight() / 1 <= jet.winarea() ? rect.bottom - 1 : rect.top > obj.outerHeight() / 1.5 ? rect.top - obj.outerHeight() - 1 : jet.winarea() - obj.outerHeight();
			ortop = Math.max(tops + (pos ? 0 :jet.docScroll()) + 1, 1) + "px", orleri = leris + "px";
		}else{
            //����λ��λ��ҳ���������Ҿ���
			ortop = "50%", orleri = "50%";
			obj.css({"margin-top":-(rect.height / 2),"margin-left":-(rect.width / 2)});
		}
		obj.css({"top":ortop,"left":orleri});
	};
	//�رղ�
	jedfn.dateClose = function() {
		$(jet.boxCell).remove();
	};
	//���ֿؼ��Ǽ�
	jedfn.setHtml = function(opts){
		var that = this, elemCell = that.valCell, boxCell = $(jet.boxCell);
		var weekHtml = "", tmsArr = "", date = new Date(),  dateFormat = jet.checkFormat(jet.format),
			isYYMM = (dateFormat == "YYYY-MM" || dateFormat == "YYYY") ? true :false,  ishhmm = dateFormat.substring(0, 5) == "hh-mm" ? true :false;
		jet.formatType = dateFormat;
		if ((elemCell.val() || elemCell.text()) == "") {
			//Ŀ��Ϊ��ֵ���ȡ��ǰ����ʱ��
			tmsArr = [ date.getFullYear(), date.getMonth() + 1, date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds() ];
			jet.currDate = new Date(tmsArr[0], parseInt(tmsArr[1])-1, tmsArr[2], tmsArr[3], tmsArr[4], tmsArr[5]);
			jet.ymdDate = tmsArr[0] + "-" + jet.digit(tmsArr[1]) + "-" + jet.digit(tmsArr[2]);
		} else {
			var initVal = jet.isValHtml(elemCell) ? elemCell.val() : elemCell.text();
			//�Ի�ȡ�����ڵĽ����滻
			var nocharDate = ishhmm ? initVal.replace(/^(\d{2})(?=\d)/g,"$1,") : initVal.substr(0,4).replace(/^(\d{4})/g,"$1,") + initVal.substr(4).replace(/^(\d{2})(?=\d)/g,"$1,");
			//�ж��Ƿ�Ϊ�������ͣ����ָ�
			var inVals = jet.IsNum(initVal) ? nocharDate.match(ymdMacth) : initVal.match(ymdMacth);
			if(ishhmm){
				tmsArr = dateFormat == "hh-mm" ? [ inVals[0], inVals[1], date.getSeconds() ] :[ inVals[0], inVals[1], inVals[2] ];
				jet.currDate = new Date(date.getFullYear(), date.getMonth()-1, date.getDate());
			}else{
				tmsArr = [ inVals[0], inVals[1], inVals[2], inVals[3] == undefined ? date.getHours() : inVals[3], inVals[4] == undefined ? date.getMinutes() : inVals[4], inVals[5] == undefined ? date.getSeconds() :inVals[5] ];
				jet.currDate = new Date(tmsArr[0], parseInt(tmsArr[1])-1,  tmsArr[2], tmsArr[3], tmsArr[4], tmsArr[5]);
				jet.ymdDate = tmsArr[0] + "-" + jet.digit(tmsArr[1]) + "-" + jet.digit(tmsArr[2]);
			}
		}
		jet.currMonth = tmsArr[1], jet.currDays = tmsArr[2];
		//�ؼ�HMTLģ��
		var datetopStr = '<div class="jedatetop" style="display:'+(ishhmm ? "none":"bolck")+'">' + (!isYYMM ? '<div class="jedateym" style="width:50%;"><i class="prev triangle yearprev"></i><span class="jedateyy" ym="24"><em class="jedateyear"></em><em class="pndrop"></em></span><i class="next triangle yearnext"></i></div>' + '<div class="jedateym" style="width:50%;"><i class="prev triangle monthprev"></i><span class="jedatemm" ym="12"><em class="jedatemonth"></em><em class="pndrop"></em></span><i class="next triangle monthnext"></i></div>' :'<div class="jedateym" style="width:100%;"><i class="prev triangle ymprev"></i><span class="jedateyy"><em class="jedateyearmonth"></em></span><i class="next triangle ymnext"></i></div>') + "</div>";
		var dateymList = !isYYMM ? '<div class="jedatetopym" style="display: none;">' + '<ul class="ymdropul"></ul><p><span class="jedateymchle">&lt;&lt;</span><span class="jedateymchri">&gt;&gt;</span><span class="jedateymchok">�ر�</span></p>' + "</div>" :(dateFormat == "YYYY" ? '<ul class="jedayy"></ul>' :��'<ul class="jedaym"></ul>');
		var dateriList = '<ol class="jedaol"></ol><ul class="jedaul"></ul>';
		var bothmsStr = !isYYMM ? '<div class="botflex jedatehmsshde"><ul class="jedatehms"><li><input type="text" /></li><i>:</i><li><input type="text" /></li><i>:</i><li><input type="text" /></li></ul></div>' + '<div class="botflex jedatebtn"><span class="jedateok">ȷ��</span><span class="jedatetodaymonth">����</span><span class="jedateclear">���</span></div>' :(dateFormat == "YYYY" ? '<div class="botflex jedatebtn"><span class="jedateok" style="width:47.8%">ȷ��</span><span class="jedateclear" style="width:47.8%">���</span></div>' : '<div class="botflex jedatebtn"><span class="jedateok">ȷ��</span><span class="jedatetodaymonth">����</span><span class="jedateclear">���</span></div>');
		var datebotStr = '<div class="jedatebot">' + bothmsStr + "</div>";
		var datehmschoose = '<div class="jedateprophms ' + (ishhmm ? "jedatepropfix" :"jedateproppos") + '"><div class="jedatepropcon"><div class="jedatehmstitle">ʱ��ѡ��<div class="jedatehmsclose">&times;</div></div><div class="jedateproptext">Сʱ</div><div class="jedateproptext">����</div><div class="jedateproptext">����</div><div class="jedatehmscon jedateprophours"></div><div class="jedatehmscon jedatepropminutes"></div><div class="jedatehmscon jedatepropseconds"></div></div></div>';
		var dateHtmStr = isYYMM ? datetopStr + dateymList + datebotStr :ishhmm ? datetopStr + datehmschoose + datebotStr :datetopStr + dateymList + dateriList + datehmschoose + datebotStr;
		boxCell.html(dateHtmStr);
        //�Ƿ���ʾ�����ť
		jet.isBool(opts.isClear) ? "" : jet.isShow(boxCell.find(".jedatebot .jedateclear"), false);
		//�Ƿ���ʾ���찴ť
		if(!isYYMM){
			jet.isBool(opts.isToday) ? "" : jet.isShow(boxCell.find(".jedatebot .jedatetodaymonth"), false);
		};
		//�Ƿ���ʾȷ�ϰ�ť
		jet.isBool(opts.isOk) ? "" : jet.isShow(boxCell.find(".jedatebot .jedateok")[0], false);
		//�ж��Ƿ���ʱ����
		if(/\hh-mm/.test(dateFormat)){
			var isTimehms = function(bool) {
				if(elemCell.val() != "" || elemCell.text() != "") {
					var hmsArrs = bool ? [ tmsArr[0], tmsArr[1], tmsArr[2] ] : [ tmsArr[3], tmsArr[4], tmsArr[5] ];
				}else{
					var hmsArrs =  [ jet.currDate.getHours(), jet.currDate.getMinutes(), jet.currDate.getSeconds() ];
				}
				boxCell.find(".jedatebot .jedatehms input").each(function(i) {
					$(this).val(jet.digit(hmsArrs[i]));
					jet.isBool(opts.ishmsVal) ? "" : $(this).attr("readOnly",'true');
				});
			};
			if(ishhmm){
				isTimehms(true);
				boxCell.find(".jedateyear").text(jet.currDate.getFullYear() + '��');
				boxCell.find(".jedatemonth").text(jet.digit(jet.currDate.getMonth() + 1) + '��');
			}else{
				if(jet.isBool(opts.isTime)){
					isTimehms(false);
				}else{
					jet.isShow(boxCell.find(".jedatebot .jedatehmsshde"), false);
					boxCell.find(".jedatebot .jedatebtn").css("width" , "100%");
				}
			}
		}else{
			if (!isYYMM) jet.isShow(boxCell.find(".jedatebot .jedatehmsshde"), false);
			boxCell.find(".jedatebot .jedatebtn").css("width" , "100%");
		};
		//�ж��Ƿ�Ϊ��������
		if(/\YYYY-MM-DD/.test(dateFormat)){
			$.each(jet.weeks, function(i, week) {
				weekHtml += '<li class="weeks" data-week="' + week + '">' + week + "</li>";
			});
			boxCell.find(".jedaol").html(weekHtml);
			that.createDaysHtml(jet.currDate.getFullYear(), jet.currDate.getMonth()+1, opts);
			that.chooseYM(opts);
		};
		if(isYYMM){
			var monthCls = boxCell.find(".jedateym .jedateyearmonth");
			if(dateFormat == "YYYY"){
				monthCls.attr("data-onyy",tmsArr[0]).text(tmsArr[0] + "��");
				boxCell.find(".jedayy").html(that.onlyYear(tmsArr[0]));
			}else{
				monthCls.attr("data-onym",tmsArr[0]+"-"+jet.digit(tmsArr[1])).text(tmsArr[0] + "��" + parseInt(tmsArr[1]) + "��");
				boxCell.find(".jedaym").html(that.onlyYMStr(tmsArr[0], parseInt(tmsArr[1])));
			}
			that.onlyYMevents(tmsArr,opts);
		}
		that.orien(boxCell, elemCell);
		setTimeout(function () {
			opts.success && opts.success(elemCell);
		}, 2);
		that.events(tmsArr, opts);
	};
	//ѭ����������
	jedfn.createDaysHtml = function(ys, ms, opts){
		var that = this, boxCell = $(jet.boxCell);
		var year = parseInt(ys), month = parseInt(ms), dateHtml = "",count = 0;
		var minArr = jet.minDate.match(ymdMacth), minNum = minArr[0] + minArr[1] + minArr[2],
			maxArr = jet.maxDate.match(ymdMacth), maxNum = maxArr[0] + maxArr[1] + maxArr[2];
		boxCell.find(".jedaul").html(""); //�м�һ��Ҫ���������ȥ����Ҫ��Ȼ���һ�η�ҳ������������������ʾ����
		var firstWeek = new Date(year, month - 1, 1).getDay() || 7,
			daysNum = jet.getDaysNum(year, month), prevM = jet.getPrevMonth(year, month),
			prevDaysNum = jet.getDaysNum(year, prevM.m), nextM = jet.getNextMonth(year, month),
			currOne = jet.currDate.getFullYear() + "-" + jet.digit(jet.currDate.getMonth() + 1) + "-" + jet.digit(1),
			thisOne = year + "-" + jet.digit(month) + "-" + jet.digit(1);
		boxCell.find(".jedateyear").attr("year", year).text(year + '��');
		boxCell.find(".jedatemonth").attr("month", month).text(month + '��');
		//����ʱ���ע
		var mark = function (my, mm, md) {
			var Marks = opts.marks, contains = function(arr, obj) {
				var len = arr.length;
				while (len--) {
					if (arr[len] === obj) return true;
				}
				return false;
			};
			return $.isArray(Marks) && Marks.length > 0 && contains(Marks, my + "-" + jet.digit(mm) + "-" + jet.digit(md)) ? '<i class="marks"></i>' :"";
		};
		//�Ƿ���ʾ����
		var isfestival = function(y, m ,d) {
			var festivalStr;
			if(opts.festival == true){
				var lunar = jeLunar(y, m - 1, d), feslunar = (lunar.solarFestival || lunar.lunarFestival),
					lunartext = (feslunar && lunar.jieqi) != "" ? feslunar : (lunar.jieqi || lunar.showInLunar);
				festivalStr = '<p><span class="solar">' + d + '</span><span class="lunar">' + lunartext + '</span></p>';
			}else{
				festivalStr = '<p class="nolunar">' + d + '</p>';
			}
			return festivalStr;
		};
		//�ж��Ƿ������Ƶ�����֮��
		var dateOfLimit = function(Y, M, D, isMonth){
			var thatNum = (Y + "-" + jet.digit(M) + "-" + jet.digit(D)).replace(/\-/g, '');
			if(isMonth){
				if (parseInt(thatNum) >= parseInt(minNum) && parseInt(thatNum) <= parseInt(maxNum)) return true;
			}else {
				if (parseInt(minNum) > parseInt(thatNum) || parseInt(maxNum) < parseInt(thatNum)) return true;
			}
		}
		//��һ��ʣ������
		for (var p = prevDaysNum - firstWeek + 1; p <= prevDaysNum; p++, count++) {
			var pmark = mark(prevM.y,prevM.m,p), pCls = dateOfLimit(prevM.y, prevM.m, p, false) ? "disabled" : "other";
			dateHtml += '<li year="'+prevM.y+'" month="'+prevM.m+'" day="'+p+'" class='+pCls+'>'+(isfestival(prevM.y,prevM.m,p) + pmark)+'</li>';
		}
		//���µ�����
		for(var b = 1; b <= daysNum; b++, count++){
			var bCls = "", bmark = mark(year,month,b),
				thisDate = (year + "-" + jet.digit(month) + "-" + jet.digit(b)); //���µ�ǰ����
			if(dateOfLimit(year, month, b, true)){
				bCls = jet.ymdDate == thisDate ? "action" : (currOne != thisOne && thisOne == thisDate ? "action" : "");
			}else{
				bCls = "disabled";
			}
			dateHtml += '<li year="'+year+'" month="'+month+'" day="'+b+'" '+(bCls != "" ? "class="+bCls+"" : "")+'>'+(isfestival(year,month,b) + bmark)+'</li>';
		}
		//��һ�¿�ʼ����
		for(var n = 1, nlen = 42 - count; n <= nlen; n++){
			var nmark = mark(nextM.y,nextM.m,n), nCls = dateOfLimit(nextM.y, nextM.m, n, false) ? "disabled" : "other";
			dateHtml += '<li year="'+nextM.y+'" month="'+nextM.m+'" day="'+n+'" class='+nCls+'>'+(isfestival(nextM.y,nextM.m,n) + nmark)+'</li>';
		}
		//������ƴ������������
		boxCell.find(".jedaul").html(dateHtml);
		that.chooseDays(opts);
	};
	//ѭ���������£�YYYY-MM��
	jedfn.onlyYMStr = function(y, m) {
		var onlyYM = "";
		$.each(jet.montharr, function(i, val) {
			var minArr = jet.parseMatch(jet.minDate), maxArr = jet.parseMatch(jet.maxDate),
				thisDate = new Date(y, jet.digit(val), "01"), minTime = new Date(minArr[0], minArr[1], minArr[2]), maxTime = new Date(maxArr[0], maxArr[1], maxArr[2]);
			if (thisDate < minTime || thisDate > maxTime) {
				onlyYM += "<li class='disabled' ym='" + y + "-" + jet.digit(val) + "'>" + y + "��" + jet.digit(val) + "��</li>";
			} else {
				onlyYM += "<li " + (m == val ? 'class="action"' :"") + ' ym="' + y + "-" + jet.digit(val) + '">' + y + "��" + jet.digit(val) + "��</li>";
			}
		});
		return onlyYM;
	};
	//ѭ�������꣨YYYY��
	jedfn.onlyYear = function(YY) {
		var onlyStr = "";
		jet.yearArr = new Array(15);
		$.each(jet.yearArr, function(i) {
			var minArr = jet.parseMatch(jet.minDate), maxArr = jet.parseMatch(jet.maxDate),
				minY = minArr[0], maxY = maxArr[0], yyi = YY - 7 + i,
				getyear = $(jet.boxCell).find(".jedateym .jedateyearmonth").attr("data-onyy");
			if (yyi < minY || yyi > maxY) {
				onlyStr += "<li class='disabled' yy='" + yyi + "'>" + yyi + "��</li>";
			} else {
				onlyStr += "<li "+(getyear == yyi ? 'class="action"' : "")+" yy='" + yyi + "'>" + yyi + "��</li>";
			}
		});
		return onlyStr;
	};
	//���ɶ�λʱ����
	jedfn.setStrhms = function(opts) {
		var that = this, boxCell = $(jet.boxCell);
		var parseFormat = jet.format, hmsArr = [], hmsliCls = boxCell.find(".jedatehms li"),
			proptextCls = boxCell.find(".jedatepropcon .jedateproptext"), 
			propconCls = boxCell.find(".jedatepropcon .jedatehmscon");
		var parsehms = function(str) {
			var ymdstr = str.match(ymdMacth).join("-"), timeArr = ymdstr == "YYYY-MM-DD-hh-mm" ? str.split(" ") : ymdstr,
				isHMtime = ymdstr == "YYYY-MM-DD-hh-mm" ? timeArr[1] :timeArr;
			return isHMtime.match(ymdMacth).join("-");
		};
        boxCell.find(".jedateprophms").css({bottom:boxCell.find(".jedatebot").height()});
        var minhms = jet.minDate.split(" ")[1].match(ymdMacth),
            maxhms = jet.maxDate.split(" ")[1].match(ymdMacth),
		    parmathm = parsehms(parseFormat) == "hh-mm";
        //��ʽΪhh-mmʱ����ʱ�ֵ��б���
		if(parmathm){
			var hmsliWidth = hmsliCls.css('width').replace(/\px|em|rem/g,''), hmsiW = boxCell.find(".jedatehms i").css('width').replace(/\px|em|rem/g,''),
				hmschoseW = proptextCls.css('width').replace(/\px|em|rem/g,''), hmslival = Math.round(parseInt(hmsliWidth) + parseInt(hmsliWidth)/2 + parseInt(hmsiW)/2);
			hmsliCls[0].style.width = hmsliCls[1].style.width = hmslival + "px";
			proptextCls[0].style.width = proptextCls[1].style.width = propconCls[0].style.width = propconCls[1].style.width = Math.round(parseInt(hmschoseW) + parseInt(hmschoseW)/2 + 2) + "px";
		}
		//����ʱ����
		$.each([ 24, 60, 60 ], function(i, len) {
			var hmsStr = "", hmsCls = "", inputCls = boxCell.find(".jedatehms input"), textem = inputCls.eq(i).val();
			inputCls.eq(i).attr("maxlength",2).attr("numval",len-1).attr("item",i);
			for (var h = 0; h < len; h++) {
				h = jet.digit(h);
				if (jet.isBool(opts.hmsLimit)) { 
                    hmsCls = parmathm && i == 2 ? minhms[i] == h ? "disabled action" :"disabled" :textem == h ? "action" :"";
                    if(parmathm && i == 2){
                        var readCls = hmsliCls.eq(2);
                        readCls.css({"display":"none"}).prev().css({"display":"none"});
                        proptextCls.eq(i).css({"display":"none"});
                        propconCls.eq(i).css({"display":"none"});
                    }
				} else {
					//�ж�����ʱ�䷶Χ��״̬
					if (h < minhms[i] || h > maxhms[i]){
                        hmsCls = h == textem ? "disabled action" : "disabled";
                    }else {
                        hmsCls = h == textem ? "action" :"";
                    };
				}
				hmsStr += '<p class="' + hmsCls + '">' + h + "</p>";
			}
			hmsArr.push(hmsStr);
		});
		return hmsArr;
	};
	//����������µĵ��
	jedfn.onlyYMevents = function(tmsArr, opts) {
		var that = this, boxCell = $(jet.boxCell);
		var ymVal, ymPre = boxCell.find(".jedateym .ymprev"), 
			ymNext = boxCell.find(".jedateym .ymnext"), 
			ony = parseInt(tmsArr[0]), onm = parseFloat(tmsArr[1]);
		$.each([ ymPre, ymNext ], function(i, cls) {
			cls.on("click", function(ev) {
				ev.stopPropagation();
				if(jet.checkFormat(jet.format) == "YYYY"){
					ymVal = cls == ymPre ? boxCell.find(".jedayy li").attr("yy") : boxCell.find(".jedayy li").eq(jet.yearArr.length-1).attr("yy");
					boxCell.find(".jedayy").html(that.onlyYear(parseInt(ymVal)));
				}else{
					ymVal = cls == ymPre ? ony -= 1 :ony += 1;
					boxCell.find(".jedaym").html(that.onlyYMStr(ymVal, onm));
				}
				that.ymPremNextEvents(opts);
			});
		});
	};
	jedfn.nongliorien = function(obj, self, pos) {
		var tops, leris, ortop, orleri, rect =self[0].getBoundingClientRect();
		leris = rect.right + obj[0].offsetWidth / 1.5 >= jet.winarea(1) ? rect.right - obj[0].offsetWidth : rect.left + (pos ? 0 : jet.docScroll(1));
		tops = rect.bottom + obj[0].offsetHeight / 1 <= jet.winarea() ? rect.bottom - 1 : rect.top > obj[0].offsetHeight / 1.5 ? rect.top - obj[0].offsetHeight - 1 : jet.winarea() - obj[0].offsetHeight;
		ortop = Math.max(tops + (pos ? 0 :jet.docScroll()) + 1, 1) + "px", orleri = leris + "px";
		return {top: ortop, left: orleri }
	};
	//ѡ������
	jedfn.chooseDays = function(opts) {
		var that = this, elemCell = that.valCell, boxCell = $(jet.boxCell);
		boxCell.find(".jedaul li").on("click", function(ev) {
			var _that = $(this), liTms = [];
			if (_that.hasClass("disabled")) return;
			ev.stopPropagation();
			//��ȡʱ����ļ���
			boxCell.find(".jedatehms input").each(function() {
				liTms.push($(this).val());
			});
			var aty = parseInt(_that.attr("year")), atm = parseFloat(_that.attr("month")), atd = parseFloat(_that.attr("day")),
				getDateVal = jet.parse([ aty, atm, atd ], [ liTms[0], liTms[1], liTms[2] ], jet.format);
			jet.isValHtml(elemCell) ? elemCell.val(getDateVal) :elemCell.text(getDateVal);
			that.dateClose();
			opts.festival && $("#jedatetipscon").remove();
			if ($.isFunction(opts.choosefun) || opts.choosefun != null) opts.choosefun && opts.choosefun(elemCell,getDateVal);
		});

		if(opts.festival) {
			//��������ʾ�����
			boxCell.find(".jedaul li").on("mouseover", function () {
				var _this = $(this), aty = parseInt(_this.attr("year")), atm = parseFloat(_this.attr("month")), atd = parseFloat(_this.attr("day")),
					tipDiv = $("<div/>",{"id":"jedatetipscon","class":"jedatetipscon"}), lunar = jeLunar(aty, atm - 1, atd);
				var tiphtml = '<p>' + lunar.solarYear + '��' + lunar.solarMonth + '��' + lunar.solarDate + '�� ' + lunar.inWeekDays + '</p><p class="red">ũ����' + lunar.shengxiao + '�� ' + lunar.lnongMonth + '��' + lunar.lnongDate + '</p><p>' + lunar.ganzhiYear + '�� ' + lunar.ganzhiMonth + '�� ' + lunar.ganzhiDate + '��</p>';
				var Fesjieri = (lunar.solarFestival || lunar.lunarFestival) != "" ? '<p class="red">' + ("���գ�"+lunar.solarFestival + lunar.lunarFestival) + '</p>' : "";
				var Fesjieqi = lunar.jieqi != "" ? '<p class="red">'+(lunar.jieqi != "" ? "������"+lunar.jieqi : "") + '</p>': "";
				var tiptext = (lunar.solarFestival || lunar.lunarFestival || lunar.jieqi) != "" ? (Fesjieri + Fesjieqi) : "";
				//������ʾ���ĵ���
				$("body").append(tipDiv);
				tipDiv.html(tiphtml + tiptext);
				//��ȡ������ũ����ʾ����ֵ�λ��
				var tipPos = jedfn.nongliorien(tipDiv, _this);
				tipDiv.css({"z-index":  (opts.zIndex == undefined ? 2099 + 5 : opts.zIndex + 5),top:tipPos.top,left:tipPos.left,position:"absolute",display:"block"});
			}).on( "mouseout", function () { //����Ƴ���ʾ����ʧ
				if($("#jedatetipscon").length > 0) $("#jedatetipscon").remove();
			});
		}
	};
	//����ѡ�������
	jedfn.chooseYM = function(opts) {
		var that = this, boxCell = $(jet.boxCell);
		var jetopym = boxCell.find(".jedatetopym"), jedateyy = boxCell.find(".jedateyy"), jedatemm = boxCell.find(".jedatemm"), jedateyear = boxCell.find(".jedateyy .jedateyear"),
			jedatemonth = boxCell.find(".jedatemm .jedatemonth"), mchri = boxCell.find(".jedateymchri"), mchle = boxCell.find(".jedateymchle"),
			ishhmmss = jet.checkFormat(jet.format).substring(0, 5) == "hh-mm" ? true :false;
		var minArr = jet.minDate.match(ymdMacth), minNum = minArr[0] + minArr[1],
			maxArr = jet.maxDate.match(ymdMacth), maxNum = maxArr[0] + maxArr[1];
		//ѭ��������
		function eachYears(YY) {
			var eachStr = "", ycls;
			$.each(new Array(15), function(i,v) {
				if (i === 7) {
					var getyear = jedateyear.attr("year");
					ycls = (parseInt(YY) >= parseInt(minArr[0]) && parseInt(YY) <= parseInt(maxArr[0])) ? (getyear == YY ? 'class="action"' :"") : 'class="disabled"';
					eachStr += "<li " + ycls + ' yy="' + YY + '">' + YY + "��</li>";
				} else {
					ycls = (parseInt(YY - 7 + i) >= parseInt(minArr[0]) && parseInt(YY - 7 + i) <= parseInt(maxArr[0])) ? "" : 'class="disabled"';
					eachStr += '<li ' + ycls + ' yy="' + (YY - 7 + i) + '">' + (YY - 7 + i) + "��</li>";
				}
			});
			return eachStr;
		}
		//ѭ��������
		function eachYearMonth(YY, ymlen) {
			var ymStr = "";
			if (ymlen == 12) {
				$.each(jet.montharr, function(i, val) {
					var getmonth = jedatemonth.attr("month"), val = jet.digit(val);
					var mcls = (parseInt(jedateyear.attr("year") + val) >= parseInt(minNum) && parseInt(jedateyear.attr("year") + val) <= parseInt(maxNum)) ?
						(jet.digit(getmonth) == val ? 'class="action"' :"") : 'class="disabled"';
					ymStr += "<li " + mcls + ' mm="' + val + '">' + val + "��</li>";
				});
				$.each([ mchri, mchle ], function(c, cls) {
					jet.isShow(cls,false);
				});
			} else {
				ymStr = eachYears(YY);
				$.each([ mchri, mchle ], function(c, cls) {
					jet.isShow(cls,true);
				});
			}
			jetopym.removeClass( ymlen == 12 ? "jedatesety" :"jedatesetm").addClass(ymlen == 12 ? "jedatesetm" :"jedatesety");
			boxCell.find(".jedatetopym .ymdropul").html(ymStr);
			jet.isShow(jetopym,true);
		}
		function clickLiYears(year) {
			boxCell.find(".ymdropul li").on("click", function(ev) {
				var _this = $(this), Years = _this.attr("yy"), Months = parseInt(jedatemonth.attr("month"));
				if (_this.hasClass("disabled")) return;
				ev.stopPropagation();
				year.attr("year", Years).html(Years + '��');
				jet.isShow(jetopym,false);
				that.createDaysHtml(Years, Months, opts);
			});
		}
		//����ѡ����
		!ishhmmss && jedateyy.on("click", function() {
			var yythat = $(this), YMlen = parseInt(yythat.attr("ym")), yearAttr = parseInt(jedateyear.attr("year"));
			eachYearMonth(yearAttr, YMlen);
			clickLiYears(jedateyear);
		});
		//����ѡ����
		!ishhmmss && jedatemm.on("click", function() {
			var mmthis = $(this), YMlen = parseInt(mmthis.attr("ym")), yearAttr = parseInt(jedateyear.attr("year"));
			eachYearMonth(yearAttr, YMlen);
			boxCell.find(".ymdropul li").on("click", function(ev) {
				if ($(this).hasClass("disabled")) return;
				ev.stopPropagation();
				var lithat = $(this), Years = jedateyear.attr("year"), Months = parseInt(lithat.attr("mm"));
				jedatemonth.attr("month", Months).html(Months + '��');
				jet.isShow(jetopym,false);
				that.createDaysHtml(Years, Months, opts);
			});
		});
		//�ر�����ѡ��
		boxCell.find(".jedateymchok").on("click", function(ev) {
			ev.stopPropagation();
			jet.isShow(jetopym,false);
		});
		var yearMch = parseInt(jedateyear.attr("year"));
		$.each([ mchle, mchri ], function(d, cls) {
			cls.on("click", function(ev) {
				ev.stopPropagation();
				d == 0 ? yearMch -= 15 :yearMch += 15;
				var mchStr = eachYears(yearMch);
				boxCell.find(".jedatetopym .ymdropul").html(mchStr);
				clickLiYears(jedateyear);
			});
		});
	};
	//��������µ��¼���
	jedfn.ymPremNextEvents = function(opts){
		var that = this, elemCell = that.valCell, boxCell = $(jet.boxCell);
		var newDate = new Date(), isYY = (jet.checkFormat(jet.format) == "YYYY"), ymCls = isYY ? boxCell.find(".jedayy li") : boxCell.find(".jedaym li");
		//ѡ������
		ymCls.on("click", function (ev) {
			if ($(this).hasClass("disabled")) return;    //�ж��Ƿ�Ϊ��ѡ״̬
			ev.stopPropagation();
			var atYM =  isYY ? $(this).attr("yy").match(ymdMacth) : $(this).attr("ym").match(ymdMacth),
				getYMDate = isYY ? jet.parse([atYM[0], newDate.getMonth() + 1, 1], [0, 0, 0], jet.format) : jet.parse([atYM[0], atYM[1], 1], [0, 0, 0], jet.format);
			jet.isValHtml(elemCell) ? elemCell.val(getYMDate) : elemCell.text(getYMDate);
			that.dateClose();
			if ($.isFunction(opts.choosefun) || opts.choosefun != null) opts.choosefun(elemCell, getYMDate);
		});
	};
	jedfn.events = function(tmsArr,opts){
		var that = this, elemCell = that.valCell, boxCell = $(jet.boxCell);
		var newDate = new Date(), yPre = boxCell.find(".yearprev"), yNext = boxCell.find(".yearnext"),
			mPre = boxCell.find(".monthprev"), mNext = boxCell.find(".monthnext"),
			jedateyear = boxCell.find(".jedateyear"), jedatemonth = boxCell.find(".jedatemonth"),
			isYYMM = (jet.checkFormat(jet.format) == "YYYY-MM" || jet.checkFormat(jet.format) == "YYYY") ? true :false,
			ishhmmss = jet.checkFormat(jet.format).substring(0, 5) == "hh-mm" ? true :false,
            screlTopNum = 155;
		if (!isYYMM) {
			//�л���
			!ishhmmss && $.each([ yPre, yNext ], function(i, cls) {
				cls.on("click", function(ev) {
					if(boxCell.find(".jedatetopym").css("display") == "block") return;
					ev.stopPropagation();
					var year = parseInt(jedateyear.attr("year")), month = parseInt(jedatemonth.attr("month")),
						pnYear = cls == yPre ? --year : ++year;
					cls == that.createDaysHtml(pnYear, month, opts);
				});
			});
			//�л���
			!ishhmmss && $.each([ mPre, mNext ], function(i, cls) {
				cls.on("click", function(ev) {
					if(boxCell.find(".jedatetopym").css("display") == "block") return;
					ev.stopPropagation();
					var year = parseInt(jedateyear.attr("year")), month = parseInt(jedatemonth.attr("month")),
						PrevYM = jet.getPrevMonth(year, month), NextYM = jet.getNextMonth(year, month);
					cls == mPre  ? that.createDaysHtml(PrevYM.y, PrevYM.m, opts) : that.createDaysHtml(NextYM.y, NextYM.m, opts);
				});
			});
			//ʱ�����¼���
			var hmsStr = that.setStrhms(opts), hmsevents = function(hmsArr) {
				$.each(hmsArr, function(i, hmsCls) {
					if (hmsCls.html() == "") hmsCls.html(hmsStr[i]);
				});
				if (ishhmmss) {
					jet.isShow(boxCell.find(".jedatehmsclose"), false);
					jet.isShow(boxCell.find(".jedatetodaymonth"), false);
				} else {
					jet.isShow(boxCell.find(".jedateprophms"), true);
				}
				//���㵱ǰʱ�����λ��
				$.each([ "hours", "minutes", "seconds" ], function(i, hms) {
					var hmsCls = boxCell.find(".jedateprop" + hms), achmsCls = boxCell.find(".jedateprop"+hms+" .action");
					hmsCls[0].scrollTop = achmsCls[0].offsetTop - screlTopNum; 
					var onhmsPCls = boxCell.find(".jedateprop" + hms + " p");
					onhmsPCls.on("click", function() {
						var _this = $(this);
						if (_this.hasClass("disabled")) return;
						onhmsPCls.each(function() {
							$(this).removeClass("action");
						});
						_this.addClass("action");
						boxCell.find(".jedatebot .jedatehms input").eq(i).val(jet.digit(_this.text()));
						if (!ishhmmss) jet.isShow(boxCell.find(".jedateprophms"), false);
					});
				});
			};
			var hs = boxCell.find(".jedateprophours"), ms = boxCell.find(".jedatepropminutes"), ss = boxCell.find(".jedatepropseconds");
			if (ishhmmss) {
				hmsevents([ hs, ms, ss ]);
			} else {
				boxCell.find(".jedatehms").on("click", function() {
					if (boxCell.find(".jedateprophms").css("display") !== "block") hmsevents([ hs, ms, ss ]);
					//�ر�ʱ�����
					boxCell.find(".jedateprophms .jedatehmsclose").on("click", function() {
						jet.isShow(boxCell.find(".jedateprophms"), false);
					});
				});
			}
			//���찴ť��������ʱ��
			boxCell.find(".jedatebot .jedatetodaymonth").on("click", function() {
				var toTime = [ newDate.getFullYear(), newDate.getMonth() + 1, newDate.getDate(), newDate.getHours(), newDate.getMinutes(), newDate.getSeconds() ],
					gettoDate = jet.parse([ toTime[0], toTime[1], toTime[2] ], [ toTime[3], toTime[4], toTime[5] ], jet.format);
				that.createDaysHtml(toTime[0], toTime[1], opts);
				jet.isValHtml(elemCell) ? elemCell.val(gettoDate) :jet.text(gettoDate);
				that.dateClose();
				if ($.isFunction(opts.choosefun) || opts.choosefun != null) opts.choosefun(elemCell,gettoDate);
				if (!isYYMM) that.chooseDays(opts);
			});
		}else{
			that.ymPremNextEvents(opts);
			//���°�ť��������ʱ��
			boxCell.find(".jedatebot .jedatetodaymonth").on("click", function(ev) {
				ev.stopPropagation();
				var ymTime = [ newDate.getFullYear(), newDate.getMonth() + 1, newDate.getDate() ],
					YMDate = jet.parse([ ymTime[0], ymTime[1], 0 ], [ 0, 0, 0 ], jet.format);
				jet.isValHtml(elemCell) ? elemCell.val(YMDate) :elemCell.text(YMDate);
				that.dateClose();
				if ($.isFunction(opts.choosefun) || opts.choosefun != null) opts.choosefun(elemCell,YMDate);
			});
		}
		//���ʱ������ֵ������Ӧ����Ӧλ��
		boxCell.find(".jedatehms input").on("keyup", function() {
			var _this = $(this), thatval = _this.val(), hmsVal = parseInt(_this.attr("numval")), thatitem = parseInt(_this.attr("item"));
			_this.val(thatval.replace(/\D/g,""));
			//�ж�����ֵ�Ƿ��������ֵ
			if(thatval > hmsVal){
				_this.val(hmsVal);
				alert("����ֵ���ܴ���"+hmsVal);
			}
			if(thatval == "") _this.val("00");
			boxCell.find(".jedatehmscon").eq(thatitem).children().each(function(){
				$(this).removeClass("action");
			})
			boxCell.find(".jedatehmscon").eq(thatitem).children().eq(parseInt(_this.val().replace(/^0/g,''))).addClass("action");
			$.each([ "hours", "minutes", "seconds" ], function(i, hms) {
				var hmsCls = boxCell.find(".jedateprop" + hms), achmsCls = boxCell.find(".jedateprop" + hms + " .action");
				hmsCls[0].scrollTop = achmsCls[0].offsetTop - screlTopNum;
			});
		});
		//��հ�ť�������ʱ��
		boxCell.find(".jedatebot .jedateclear").on("click", function(ev) {
			ev.stopPropagation();
			var clearVal = jet.isValHtml(elemCell) ? elemCell.val() :elemCell.text();
			jet.isValHtml(elemCell) ? elemCell.val("") :elemCell.text("");
			that.dateClose();
			if (clearVal != "") {
				if (jet.isBool(opts.clearRestore)){
					jet.minDate = opts.startMin || jet.minDate;
					jet.maxDate = opts.startMax || jet.maxDate;
				}
				if ($.isFunction(opts.clearfun) || opts.clearfun != null) opts.clearfun(elemCell,clearVal);
			}
		});
		//ȷ�ϰ�ť��������ʱ��
		boxCell.find(".jedatebot .jedateok").on("click", function(ev) {
			ev.stopPropagation();
			var isValtext = (elemCell.val() || elemCell.text()) != "", isYYYY = jet.checkFormat(jet.format) == "YYYY", okVal = "",
			//��ȡʱ���������
				eachhmsem = function() {
					var hmsArr = [];
					boxCell.find(".jedatehms input").each(function() {
						hmsArr.push($(this).val());
					});
					return hmsArr;
				};
			var minArr = jet.minDate.match(ymdMacth), minNum = minArr[0] + minArr[1] + minArr[2],
				maxArr = jet.maxDate.match(ymdMacth), maxNum = maxArr[0] + maxArr[1] + maxArr[2];
			if (isValtext) {
				var btnokVal = jet.isValHtml(elemCell) ? elemCell.val() :elemCell.text(), oktms = btnokVal.match(ymdMacth);
				if (!isYYMM) {
					var okTimeArr = eachhmsem(), okTime = [ parseInt(jedateyear.attr("year")), parseInt(jedatemonth.attr("month")), oktms[2]],
						okTimeNum = okTime[0] + okTime[1] + okTime[2],
						paroktms = [ oktms[0], oktms[1] == undefined ? "" : oktms[1], oktms[2] == undefined ? "" : oktms[2]],
						parokTimeArr = [ okTimeArr[0] == undefined ? "" : okTimeArr[0], okTimeArr[1] == undefined ? "" : okTimeArr[1], okTimeArr[2] == undefined ? "" : okTimeArr[2] ];
					//�жϻ�ȡ���������Ƿ�����Ч����
					var isokTime = (parseInt(okTimeNum) >= parseInt(minNum) && parseInt(okTimeNum) <= parseInt(maxNum)) ? true : false;
					okVal = isValtext && isokTime ? jet.parse([ okTime[0], okTime[1], okTime[2] ], parokTimeArr, jet.format) :
						jet.parse(paroktms, parokTimeArr, jet.format);
					if(!ishhmmss) that.createDaysHtml(okTime[0], okTime[1], opts);
					that.chooseDays(opts);
				} else {
					var ymactCls = isYYYY ? boxCell.find(".jedayy .action") : boxCell.find(".jedaym .action");
					//�ж��Ƿ�Ϊ��YYYY��YYYY-MM������
					if(isYYYY){
						var okDate = ymactCls ? ymactCls.attr("yy").match(ymdMacth) : oktms;
						okVal = jet.parse([parseInt(okDate[0]), newDate.getMonth() + 1, 1], [0, 0, 0], jet.format);
					}else {
						var jedYM = ymactCls ? ymactCls.attr("ym").match(ymdMacth) : oktms;
						okVal = jet.parse([parseInt(jedYM[0]), parseInt(jedYM[1]), 1], [0, 0, 0], jet.format);
					}
				}
			} else {
				var okArr = eachhmsem(), monthCls = boxCell.find(".jedateyearmonth")[0], okDate = "";
				//�ж��Ƿ�Ϊʱ����(hh:mm:ss)����
				if (ishhmmss) {
					okVal = jet.parse([ tmsArr[0], tmsArr[1], tmsArr[2] ], [ okArr[0], okArr[1], okArr[2] ], jet.format);
				} else {
					//�ж��Ƿ�Ϊ���£�YYYY��YYYY-MM������
					if(isYYMM){
						okDate = jet.checkFormat(jet.format) == "YYYY" ? monthCls.attr("data-onyy").match(ymdMacth) : monthCls.attr("data-onym").match(ymdMacth);
					}else{
						okDate = [ newDate.getFullYear(), newDate.getMonth() + 1, newDate.getDate()];
					}
					okVal = isYYYY ? jet.parse([parseInt(okDate[0]), newDate.getMonth(), 1], [0, 0, 0], jet.format) :
						jet.parse([parseInt(okDate[0]), parseInt(okDate[1]), newDate.getDate()], [okArr[0], okArr[1], okArr[2]], jet.format);
				}
			}

			jet.isValHtml(elemCell) ? elemCell.val(okVal) :elemCell.text(okVal);
			that.dateClose();
			if ($.isFunction(opts.okfun) || opts.okfun != null) opts.okfun(jet.elemCell,okVal);
		});
		//����հ״�����
		$(document).on("mouseup scroll", function(ev) {
			ev.stopPropagation();
			var box = $(jet.boxCell);
			if (box && box.css("display") !== "none")  box.remove();
			if($("#jedatetipscon").length > 0) $("#jedatetipscon").remove();
		});
		$(jet.boxCell).on("mouseup", function(ev) {
			ev.stopPropagation();
		});

	};

	//���ڿؼ��汾
	$.dateVer = "3.8";
	//����ָ������
	$.nowDate = function(num) {
		return jet.initDates(num);
	};
	//��ȡ����������
	$.getLunar = function(time){
		if(/\YYYY-MM-DD/.test(jet.formatType)){
			//���Ϊ�������͵����ڶԻ�ȡ�����ڵĽ����滻
			var nocharDate = time.substr(0,4).replace(/^(\d{4})/g,"$1,") + time.substr(4).replace(/^(\d{2})(?=\d)/g,"$1,"),
			    warr = jet.IsNum(time) ? nocharDate.match(ymdMacth) : time.match(ymdMacth),
				lunars = jeLunar(warr[0], warr[1] - 1, warr[2]);
			return{
				nMonth: lunars.lnongMonth,             //ũ����
			    nDays: lunars.lnongDate,               //ũ����
				yYear: parseInt(lunars.solarYear),     //������
				yMonth: parseInt(lunars.solarMonth),   //������
				yDays: parseInt(lunars.solarDate),     //������
				cWeek: lunars.inWeekDays,              //�������ڼ�
				nWeek: lunars.solarWeekDay             //�������ڼ�
		    };
		}
	};
	//Ϊ��ǰ��ȡ�������ڼӼ�����������ֻ�ܿ��Ƶ����������ܿ���ʱ����Ӽ�
	$.addDate = function(time,num,type) {
		num = num | 0;   type = type || "DD";
		return jet.addDateTime(time,num,type,jet.format);
	};
	return jeDate;
});

//ũ������
;(function(root, factory) {
	root.jeLunar = factory(root.jeLunar);
})(this, function(jeLunar) {
	var lunarInfo=[19416,19168,42352,21717,53856,55632,91476,22176,39632,21970,19168,42422,42192,53840,119381,46400,54944,44450,38320,84343,18800,42160,46261,27216,27968,109396,11104,38256,21234,18800,25958,54432,59984,28309,23248,11104,100067,37600,116951,51536,54432,120998,46416,22176,107956,9680,37584,53938,43344,46423,27808,46416,86869,19872,42448,83315,21200,43432,59728,27296,44710,43856,19296,43748,42352,21088,62051,55632,23383,22176,38608,19925,19152,42192,54484,53840,54616,46400,46496,103846,38320,18864,43380,42160,45690,27216,27968,44870,43872,38256,19189,18800,25776,29859,59984,27480,21952,43872,38613,37600,51552,55636,54432,55888,30034,22176,43959,9680,37584,51893,43344,46240,47780,44368,21977,19360,42416,86390,21168,43312,31060,27296,44368,23378,19296,42726,42208,53856,60005,54576,23200,30371,38608,19415,19152,42192,118966,53840,54560,56645,46496,22224,21938,18864,42359,42160,43600,111189,27936,44448],
		sTermInfo = [ 0, 21208, 43467, 63836, 85337, 107014, 128867, 150921, 173149, 195551, 218072, 240693, 263343, 285989, 308563, 331033, 353350, 375494, 397447, 419210, 440795, 462224, 483532, 504758 ];
	var Gan = "���ұ����켺�����ɹ�", Zhi = "�ӳ���î������δ�����纥", Animals = "��ţ������������Ｆ����";
	var solarTerm = [ "С��", "��", "����", "��ˮ", "����", "����", "����", "����", "����", "С��",
		"â��", "����", "С��", "����", "����", "����", "��¶", "���", "��¶", "˪��", "����", "Сѩ", "��ѩ", "����" ];
	var nStr1 = "��һ�����������߰˾�ʮ", nStr2 = "��ʮإئ", nStr3 = [ "��", "��", "��", "��", "��", "��", "��", "��", "��", "ʮ", "ʮһ", "��"],
		sFtv1 = {
			"0101" : "*1Ԫ����",         "0202" : "ʪ����",
			"0214" : "���˽�",           "0308" : "��Ů��",
			"0312" : "ֲ����",           "0315" : "������Ȩ����",
			"0401" : "���˽�",           "0422" : "������",
			"0501" : "*1�Ͷ���",         "0504" : "�����",
			"0512" : "��ʿ��",           "0518" : "�������",
			"0520" : "ĸ�׽�",           "0601" : "��ͯ��",
			"0623" : "����ƥ����",       "0630" : "���׽�",
			"0701" : "������",           "0801" : "������",
			"0903" : "��սʤ����",       "0910" : "��ʦ��",
			"1001" : "*3�����",         "1201" : "���̲���",
			"1224" : "ƽ��ҹ",           "1225" : "ʥ����"
		},
		sFtv2 = {
			"0100" : "��Ϧ",             "0101" : "*2����",
			"0115" : "Ԫ����",           "0505" : "*1�����",
			"0707" : "��Ϧ��",           "0715" : "��Ԫ��",
			"0815" : "*1�����",         "0909" : "*1������",
			"1015" : "��Ԫ��",           "1208" : "���˽�",
			"1223" : "С��"

		};
	function flunar(Y) {
		var sTerm = function (j, i) {
				var h = new Date((31556925974.7 * (j - 1900) + sTermInfo[i] * 60000) + Date.UTC(1900, 0, 6, 2, 5));
				return (h.getUTCDate())
			},
			d = function (k) {
				var h, j = 348;
				for (h = 32768; h > 8; h >>= 1) {
					j += (lunarInfo[k - 1900] & h) ? 1 : 0;
				}
				return (j + b(k))
			},
			ymdCyl = function (h) {
				return (Gan.charAt(h % 10) + Zhi.charAt(h % 12))
			},
			b =function (h) {
				var islp = (g(h)) ? ((lunarInfo[h - 1900] & 65536) ? 30 : 29) : (0);
				return islp
			},
			g = function (h) {
				return (lunarInfo[h - 1900] & 15)
			},
			e = function (i, h) {
				return ((lunarInfo[i - 1900] & (65536 >> h)) ? 30 : 29)
			},
			newymd = function (m) {
				var k, j = 0, h = 0, l = new Date(1900, 0, 31), n = (m - l) / 86400000;
				this.dayCyl = n + 40;
				this.monCyl = 14;
				for (k = 1900; k<2050&&n>0; k++) {
					h = d(k); n -= h;
					this.monCyl += 12;
				}
				if (n < 0) {
					n += h; k--;
					this.monCyl -= 12;
				}
				this.year = k;
				this.yearCyl = k - 1864;
				j = g(k);
				this.isLeap = false;
				for (k = 1; k<13&&n>0; k++) {
					if (j > 0 && k == (j + 1) && this.isLeap == false) {
						--k;
						this.isLeap = true;
						h = b(this.year);
					} else {
						h = e(this.year, k);
					}
					if (this.isLeap == true && k == (j + 1)) {
						this.isLeap = false;
					}
					n -= h;
					if (this.isLeap == false) this.monCyl++;
				}
				if (n == 0 && j > 0 && k == j + 1) {
					if (this.isLeap) {
						this.isLeap = false;
					} else {
						this.isLeap = true;
						--k;
						--this.monCyl;
					}
				}
				if (n < 0) {
					n += h; --k;
					--this.monCyl
				}
				this.month = k;
				this.day = n + 1;
			},
			digit = function (num) {
				return num < 10 ? "0" + (num | 0) :num;
			},
			reymd = function (i, j) {
				var h = i;
				return j.replace(/dd?d?d?|MM?M?M?|yy?y?y?/g, function(k) {
					switch (k) {
						case "yyyy":
							var l = "000" + h.getFullYear();
							return l.substring(l.length - 4);
						case "dd": return digit(h.getDate());
						case "d": return h.getDate().toString();
						case "MM": return digit((h.getMonth() + 1));
						case "M": return h.getMonth() + 1;
					}
				})
			},
			lunarMD = function (i, h) {
				var j;
				switch (i, h) {
					case 10: j = "��ʮ"; break;
					case 20: j = "��ʮ"; break;
					case 30: j = "��ʮ"; break;
					default:
						j = nStr2.charAt(Math.floor(h / 10));
						j += nStr1.charAt(h % 10);
				}
				return (j)
			};
		this.isToday = false;
		this.isRestDay = false;
		this.solarYear = reymd(Y, "yyyy");
		this.solarMonth = reymd(Y, "M");
		this.solarDate = reymd(Y, "d");
		this.solarWeekDay = Y.getDay();
		this.inWeekDays = "����" + nStr1.charAt(this.solarWeekDay);
		var X = new newymd(Y);
		this.lunarYear = X.year;
		this.shengxiao = Animals.charAt((this.lunarYear - 4) % 12);
		this.lunarMonth = X.month;
		this.lunarIsLeapMonth = X.isLeap;
		this.lnongMonth = this.lunarIsLeapMonth ? "��" + nStr3[X.month - 1] : nStr3[X.month - 1];
		this.lunarDate = X.day;
		this.showInLunar = this.lnongDate = lunarMD(this.lunarMonth, this.lunarDate);
		if (this.lunarDate == 1) {
			this.showInLunar = this.lnongMonth + "��";
		}
		this.ganzhiYear = ymdCyl(X.yearCyl);
		this.ganzhiMonth = ymdCyl(X.monCyl);
		this.ganzhiDate = ymdCyl(X.dayCyl++);
		this.jieqi = "";
		this.restDays = 0;
		if (sTerm(this.solarYear, (this.solarMonth - 1) * 2) == reymd(Y, "d")) {
			this.showInLunar = this.jieqi = solarTerm[(this.solarMonth - 1) * 2];
		}
		if (sTerm(this.solarYear, (this.solarMonth - 1) * 2 + 1) == reymd(Y, "d")) {
			this.showInLunar = this.jieqi = solarTerm[(this.solarMonth - 1) * 2 + 1];
		}
		if (this.showInLunar == "����") {
			this.showInLunar = "������";
			this.restDays = 1;
		}
		this.solarFestival = sFtv1[reymd(Y, "MM") + reymd(Y, "dd")];
		if (typeof this.solarFestival == "undefined") {
			this.solarFestival = "";
		} else {
			if (/\*(\d)/.test(this.solarFestival)) {
				this.restDays = parseInt(RegExp.$1);
				this.solarFestival = this.solarFestival.replace(/\*\d/, "");
			}
		}
		this.showInLunar = (this.solarFestival == "") ? this.showInLunar : this.solarFestival;
		this.lunarFestival = sFtv2[this.lunarIsLeapMonth ? "00" : digit(this.lunarMonth) + digit(this.lunarDate)];
		if (typeof this.lunarFestival == "undefined") {
			this.lunarFestival = "";
		} else {
			if (/\*(\d)/.test(this.lunarFestival)) {
				this.restDays = (this.restDays > parseInt(RegExp.$1)) ? this.restDays : parseInt(RegExp.$1);
				this.lunarFestival = this.lunarFestival.replace(/\*\d/, "");
			}
		}
		if (this.lunarMonth == 12  && this.lunarDate == e(this.lunarYear, 12)) {
			this.lunarFestival = sFtv2["0100"];
			this.restDays = 1;
		}
		this.showInLunar = (this.lunarFestival == "") ? this.showInLunar : this.lunarFestival;
	}
	var jeLunar = function(y,m,d) {
		return new flunar(new Date(y,m,d));
	};
	return jeLunar;
});
