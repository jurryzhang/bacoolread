;(function($){var _util=CS.util,_dialog=CS.dialog,_loginPopup=CS.loginPopup,_main=CS.page.bookReader.main,_sideBar=CS.page.bookReader.sideBar,_topTool=CS.page.bookReader.topTool;var _params={},_is_loading=0,_showEnd=0,_isKeyPage=1,_contentTips='《$bookName$》最新章节由云起书院首发，最新最火最快网络小说首发地！（本站提供：传统翻页、瀑布阅读两种模式，可在设置中选择）';var _chapter_list=null;function init(bid,uuid,isChapterVip,bookName,bookAuthor){_params.bid=bid||0;_params.uuid=uuid||0;_params.isChapterVip=isChapterVip||0;_params.bookName=bookName||'';_params.bookAuthor=bookAuthor||'';_chapter_list=$('#chaptercontainer');_loadChapterContent();_main.bindContentEvent();}
function _loadChapterContent(){_main.getChapterContent(_params.bid,_params.uuid,_params.isChapterVip,_loadChapterSuccessCallback);}
function _bindPageBtnEvent(preChapterUUID,nextChapterUUID){var pre_readUrl=_getReadPageUrl(preChapterUUID),next_readUrl=_getReadPageUrl(nextChapterUUID);$('#rightFloatBar_preChapterBtn').attr('href',pre_readUrl);if(!nextChapterUUID){$('#rightFloatBar_nextChapterBtn').on('click',function(){return _goToReadPage(0);});}else{$('#rightFloatBar_nextChapterBtn').attr('href',next_readUrl);}
_chapter_list.on('focus','[nodetype="replyInput"]',function(){_isKeyPage=0;}).on('blur','[nodetype="replyInput"]',function(){_isKeyPage=1;});$(document).on('keydown keypress',function(event){if(!_isKeyPage||$(document.body).find('.maskUI').length>0){return;}
if(event.keyCode==37){if(!preChapterUUID){return false;}
return _goToReadPage(preChapterUUID);}
if(event.keyCode==39){return _goToReadPage(nextChapterUUID);}});}
function _getReadPageUrl(uuid){if(!uuid){return'javascript:;';}
return window.location.href.replace(/(\d)+\.html/,uuid+'.html');}
function _goToReadPage(uuid){if(!uuid){if(!_showEnd){_showEnd=1;_main.loadBookEndContent(_loadBookEndContentSuccessCallback);}
return false;}
window.location.href=_getReadPageUrl(uuid);return false;}
function _loadBookEndContentSuccessCallback(json){if(json&&json.data&&json.data.Content){_chapter_list.append(json.data.Content);_setChapterBG();$(document).scrollTop($('#endBox').offset().top);}}
function _loadChapterSuccessCallback(data,dataSource){if(!data||!data['Content']){return;}
_chapter_list.append(data['Content']);var $lastChapterBox=_chapter_list.find('[nodetype="chapterBox"]:last');_main.renderInteractContent(data,$lastChapterBox);$('img[chaptercontent]',_chapter_list).on('load',_sideBar.readResize);_setChapterStyle(dataSource);if(_util.getClientHeight()<_util.getScrollHeight()){_sideBar.readResize();}
_bindPageBtnEvent(data['preuuid'],data['nextuuid']);_main.openPopupByChapterNum();}
function _setChapterStyle(dataSource){var book_info=_chapter_list.find('.textinfo a'),fontSize=$.cookie(_topTool.fontSizeCookieName);$('.bottom_tool:last',_chapter_list).hide();$(book_info[0]).html(_params.bookName);$(book_info[1]).html(_params.bookAuthor);if(dataSource==='cdn'){_contentTips=_contentTips.replace('$bookName$',_params.bookName);_contentTips=_util.sim2tra(_contentTips);$('.bookreadercontent p:last',_chapter_list).html(_contentTips);}
if(fontSize){_chapter_list.find(".bookreadercontent").css("font-size",fontSize+'px');}
_setChapterBG();$('#bottomTool').show();}
function _setChapterBG(){var bgKey=$.cookie(_topTool.bgCookieName);if(bgKey){var bgConfig=_topTool.bgConfig[bgKey];_chapter_list.find(".textbox").add($('#bottomTool')).css(bgConfig['cssName'],bgConfig['cssValue']);}}
_util.initNameSpace("CS.page.bookReader");CS.page.bookReader.readByPage={'init':init};})(jQuery);