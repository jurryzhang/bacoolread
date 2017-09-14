$(function(){
   requirejs(['http://stc.zhulang.com/dist/js/app/low_ie_tips.js']);
   $('.table-odd').each(function(){
	   $(this).find('tr:even').addClass('odd')
	   });
	   
	  $('.table-even').each(function(){
	   $(this).find('tr:odd').addClass('even')
	   }); 
   
});