<?php
echo '<!DOCTYPE html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=GBK" />
  <meta id="ctl00_metaKeywords" content="С˵,С˵��,����С˵,�ഺС˵,����С˵,����С˵,����С˵,��ʷС˵,����С˵,ԭ��������ѧ"
  name="keywords">
  <meta id="ctl00_metaDescription" content="С˵�Ķ�,����С˵���ڴ����������������������ṩ����С˵,����С˵,ԭ��С˵,����С˵,����С˵,����С˵,�ഺС˵,��ʷС˵,����С˵,����С˵,�ƻ�С˵,�ֲ�С˵,�׷�С˵�����½����С˵�Ķ�,���ʾ��ڴ���������������С˵:ç�ļ�,��������,�콾��˫,ʤ��Ϊ��,������ɽ��"
  name="description">
  <!-- 360��ȫ������ʹ��webkit���ٺ� -->
  <meta name="renderer" content="webkit" />
  <meta name="description" content="�����������������С˵����,ÿ�ո���С˵����,С˵���а�����ṩȫ�����ջ�ӭ��С˵����,������ÿ���С˵,������С˵.��ԽС˵.����С˵��.����ÿ������С˵��������������."
  />
  <meta name="keywords" content="С˵,С˵���а�,���С˵����,�ÿ���С˵" />
  <!-- IEʹ����֧�ֵ����ģʽ -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="baidu-site-verification" content="3R33MUNLCM" />
  <title>
    '.$this->_tpl_vars['groupname'].'С˵�Ķ�_����������|���С˵,����С˵,����С˵,�ഺС˵,С˵������С˵����
  </title>
  <link href="/favicon.ico" type="image/x-icon"
  rel="shortcut icon">
  <link href="/favicon.ico" type="image/x-icon"
  rel="Bookmark">
  <link rel="stylesheet" type="text/css" href="/sink/css/base.css"
  />
 
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/jquery-1.7.min.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/common.js"></script>
<script type="text/javascript" src="'.$this->_tpl_vars['jieqi_url'].'/scripts/theme.js"></script>
 <script type="text/javascript" src="/sink/js/base.js">
  </script>
  <script type="text/javascript" src="/sink/js/tcss.ping.js">
  </script>
  <script type="text/javascript" src="/sink/js/banner.js">
  </script>
</head>
<body>

';
$_template_tpl_vars = $this->_tpl_vars;
 $this->_template_include(array('template_include_tpl_file' => 'sink/head.html', 'template_include_vars' => array()));
 $this->_tpl_vars = $_template_tpl_vars;
 unset($_template_tpl_vars);
echo ' 

  <!-- ����������ģ�� -->
    <textarea id="topNavBarTpl" style="display:none;">

	 </textarea>
  <script type="text/javascript">
    $(function() {
      CS.common.init();
    });
  </script>
  <!-- <div class="wrap">  -->
  <link rel="stylesheet" type="text/css" href="/sink/css/index.css"
  />
  </head>
  
  <body>
    <div class="pageCenter">
      <div class="mainNavWrap cf">
        <a class="yqLogo" href="/">
          <img src="/sink/image/logo.png" width="181"
          height="80" alt="����������" title="����������" />
        </a>
<a class="topBanner" target="_blank" href="http://www.acoolread.com/info/34.html"><img width="725" height="80" alt="#"  title="" src="/sink/image/cjtssy.png" ></a>   
<li><a href="http://www.acoolread.com/modules/article/group.php?id=1" target="_blank" title="����������"><strong><font color="#50ADAD";font size="2.8px";>������վ</font></strong></a></li>
<li><a href="http://www.acoolread.com/modules/article/group.php?id=2" target="_blank" title="��������С˵��"><strong><font color="#50ADAD";font size="2.8px";>������վ</font></strong></a></li><li><a href="http://wap.acoolread.com" target="_blank" title="�ֻ�������"><strong><font color="#50ADAD";font size="2.8px";>������wapվ</font></strong></a></li>
<li><a href="http://m.acoolread.com" target="_blank" title="�ֻ�������"><strong><font color="#50ADAD";font size="2.8px";>��Ů��wapվ</font></strong></a></li>
      </div>
      <div class="head_mainnav">
        <div class="head_mainnav_hd cf">
          <h3>
            <a href="'.$this->_tpl_vars['jieqi_url'].'/">
              ��ҳ
            </a>
          </h3>
		  ';
if($this->_tpl_vars['id'] == 2){
echo '<span>
          </span>';
}
echo '
       
          <h3>
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/articlefilter.php">
              ���
            </a>
          </h3>
          <span>
          </span>
          <h3>
            <a href="'.$this->_tpl_vars['jieqi_modules']['pay']['url'].'/buyegold.php" target="_blank">
              ��ֵ
            </a>
          </h3>
          <span>
          </span>
 <h3>
            <a href="'.$this->_tpl_vars['jieqi_modules']['article']['url'].'/myarticle.php">
              ��������
            </a>
          </h3>
          <span>
          </span>
          <h3>
          <a href="http://www.acoolread.com/modules/fuli/2016.html" target="_blank">
              ���߸���
            </a>
          </h3>

          <div class="headSerachBox">
               <form action="/modules/article/search.php" method="post">
				<input type="text" name="searchkey" class="search_text" placeholder="����һ�°ɣ�"/>
				<input type="submit" value="" class="search_button">
			</form>


          </div>
        </div>
        <div class="head_mainnav_bd cf">
          <div class="subClass">
            <a href="'.jieqi_geturl('article','articlelist','1','1').'">
              ���á�ħ��
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','2').'">
              ����������
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','3').'">
              ���С�У԰
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','4').'">
              ��ʷ������
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','5').'">
              ��Ϸ������
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','6').'">
              �ƻá�ͬ��
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','7').'">
              �ִ�������
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','8').'">
              �Ŵ�������
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','9').'">
              ���롤����
            </a>
            <span>
              |
            </span>
            <a href="'.jieqi_geturl('article','articlelist','1','10').'">
              �ۺϡ�����
            </a>
          </div>

        </div>

      </div>
    </div>
     <div class="pageCenter">
      <!--��һ��-->
      <div class="indexOne mb10 cf">
        <div class="tabWrap tabSwitch fl mr10">
          <div class="threeTabBox">
            <em>
              '.$this->_tpl_vars['groupname'].'����ǿ��
            </em>
          </div>
          <div class="listWrap">
            <div class="tabList">
              <ul class="rankList">
'.$this->_tpl_vars['jieqi_pageblocks']['2']['content'].'

              </ul>

            </div>
          </div>
        </div>
        <div class="indexOneCenter">
          <!-- ��ͼ�ֲ� -->
		<div id="slideshow" class="block">
			<div id="focus">
				<ul>
';
if($this->_tpl_vars['id'] == 2){
echo $this->_tpl_vars['jieqi_pageblocks']['3']['content'];
}else{
echo $this->_tpl_vars['jieqi_pageblocks']['4']['content'];
}
echo '
				</ul>
			</div>
		</div>

        </div>
        <div class="tabWrap mb10 fr">
          <div class="threeTabBox">
            <em>
              '.$this->_tpl_vars['groupname'].'�����ϼ�
            </em>
          </div>
          <div class="rankListWrap">
            <ul class="rankList rankHover numList">
'.$this->_tpl_vars['jieqi_pageblocks']['5']['content'].'
            </ul>
          </div>
        </div>
 
      </div>

      <!--�ڶ���-->
      <div class="indexTwo mb10 cf">
        <div class="tabWrap tabSwitch fl mr10">
          <div class="threeTabBox">
            <em>
              '.$this->_tpl_vars['groupname'].'ԭ�����ư�
            </em>
          </div>
          <div class="listWrap">
            <ul class="rankList rankHover numList">
';
if($this->_tpl_vars['id'] == 2){
echo $this->_tpl_vars['jieqi_pageblocks']['6']['content'];
}else{
echo $this->_tpl_vars['jieqi_pageblocks']['1']['content'];
}
echo '
            </ul>
          </div>
        </div>
        <div class="indexCenter">
          <h6>';
if($this->_tpl_vars['id'] == 2){
echo '�ִ�������';
}else{
echo '���á�����';
}
echo '</h6>
          <div class="recBookWrap">
            <div class="recBook cf">
              <div class="twoBookWrap">
';
if($this->_tpl_vars['id'] == 2){
echo $this->_tpl_vars['jieqi_pageblocks']['8']['content'];
}else{
echo $this->_tpl_vars['jieqi_pageblocks']['7']['content'];
}
echo '
			                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="tabWrap tabSwitch fr">
          <div class="threeTabBox">
<em> ǩԼ�����ܰ�</em>
          </div>
          <div class="listWrap">
            <ul class="rankList rankHover numList tabList">
'.$this->_tpl_vars['jieqi_pageblocks']['9']['content'].'

            </ul>

          </div>
        </div>
      </div>
      <!--������-->
      <div class="indexThree mb10 cf">
        <div class="tabWrap tabSwitch fl mr10">
          <div class="threeTabBox">
            <em>
              '.$this->_tpl_vars['groupname'].'�ʻ���
            </em>
          </div>
          <div class="listWrap">
            <ul class="rankList rankHover numList">
'.$this->_tpl_vars['jieqi_pageblocks']['10']['content'].'
            </ul>
          </div>
        </div>
        <div class="indexCenter">
          <h6>';
if($this->_tpl_vars['id'] == 2){
echo '�Ŵ�������';
}else{
echo '���С�У԰';
}
echo '</h6>
          <div class="recBookWrap">
            <div class="recBook cf">
              <div class="twoBookWrap">
';
if($this->_tpl_vars['id'] == 2){
echo $this->_tpl_vars['jieqi_pageblocks']['12']['content'];
}else{
echo $this->_tpl_vars['jieqi_pageblocks']['11']['content'];
}
echo '
                </ul>
              </div>
            </div>

          </div>
        </div>
        <!--��Ʒ������-->
        <div class="tabWrap tabSwitch fr">
         <div class="threeTabBox">
            <em>
             '.$this->_tpl_vars['groupname'].'���Ƽ���
            </em>
          </div>
          <div class="listWrap">

            <ul class="rankList rankHover numList tabList">
 '.$this->_tpl_vars['jieqi_pageblocks']['13']['content'].'
            </ul>

          </div>
        </div>
      </div>
      <!--������-->
      <div class="indexFour mb10 cf">
        <div class="tabWrap tabSwitch fl mr10">
       <div class="threeTabBox">
            <em>
             '.$this->_tpl_vars['groupname'].'��Ʊ��
            </em>
          </div>
          <div class="listWrap">
            <ul class="rankList rankHover numList">
'.$this->_tpl_vars['jieqi_pageblocks']['14']['content'].'
            </ul>

          </div>
        </div>
        <div class="indexCenter">
          <h6>';
if($this->_tpl_vars['id'] == 2){
echo '���롤����';
}else{
echo '���졤����';
}
echo '</h6>
          <div class="recBookWrap">
            <div class="recBook cf">
              <div class="twoBookWrap">
';
if($this->_tpl_vars['id'] == 2){
echo $this->_tpl_vars['jieqi_pageblocks']['16']['content'];
}else{
echo $this->_tpl_vars['jieqi_pageblocks']['15']['content'];
}
echo '
                </ul>
              </div>
            </div>

          </div>
        </div>
        <div class="tabWrap fr">
          <div class="threeTabBox">
            <em>
             '.$this->_tpl_vars['groupname'].'VIP���
            </em>
          </div>
          <div class="rankListWrap">
            <ul class="rankList rankHover numList">
 '.$this->_tpl_vars['jieqi_pageblocks']['17']['content'].'
            </ul>
          </div>
        </div>
      </div>


 
      <!--�ײ�������-->
      <div class="indexSeven mb10 cf">
        <div class="fl mr10">
          <div class="tabWrap tabSwitch mb10">
       <div class="threeTabBox">
            <em>
             '.$this->_tpl_vars['groupname'].'������
            </em>
          </div>
            <div class="listWrap">
              <ul class="rankList rankHover numList tabList">
  '.$this->_tpl_vars['jieqi_pageblocks']['18']['content'].'
              </ul>
            </div>
          </div>
        </div>
        <!--����С˵�����б�-->
        <div class="indexCenter newUpdate">
          <h6>
            '.$this->_tpl_vars['groupname'].'����С˵�����б�
          </h6>
          <div id="updateTabBox" class="updateTabBox">
            <div class="updateTab">
              <ul>
                <li class="upCur">
                  ���С˵
                </li>
                <li>
                  VIPС˵
                </li>
                <li class="noborder">
                  ǩԼС˵
                </li>
              </ul>
            </div>
          </div>
          <div id="updateList" class="updateList">
            
            <ul>
 '.$this->_tpl_vars['jieqi_pageblocks']['21']['content'].'
            </ul>
           
            <ul class="hidden">
 '.$this->_tpl_vars['jieqi_pageblocks']['22']['content'].'
            </ul>
           
            <ul class="hidden">
 '.$this->_tpl_vars['jieqi_pageblocks']['23']['content'].'
            </ul>
          </div>
        </div>
        <div class="fr">
          <div class="tabWrap mb10">
            <div class="twoTabBox">
              <h3>
                '.$this->_tpl_vars['groupname'].'�������
              </h3>
            </div>
            <div class="rankListWrap">
              <ul class="rankList rankHover numList">
'.$this->_tpl_vars['jieqi_pageblocks']['25']['content'].'
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>
    <br>
    <a id="totop" class="go_top" href="javascript:">
    </a>
  </body>
  
  </html>
  

  <div class="footer">
    <div class="footer_main cf">

 
      <div class="foot">
        <p>
        
          <a href="http://www.acoolread.com/modules/forum/showtopic.php?tid=27&lpage=1&page=1" target="_blank" rel="nofollow">
            ���ڱ�վ
          </a>
          <a href="http://www.acoolread.com/modules/forum/showtopic.php?tid=28&lpage=1&page=1" target="_blank" rel="nofollow">
            �������
          </a>
          <a href="http://www.acoolread.com/modules/forum/showtopic.php?tid=29&lpage=1&page=1" target="_blank" rel="nofollow">
            ��ҪͶ��
          </a>
          <a href="http://www.acoolread.com/modules/forum/showtopic.php?tid=30&lpage=1&page=1" target="_blank" rel="nofollow">
            ��Ȩ����
          </a>
          <a href="http://www.acoolread.com/modules/forum/showtopic.php?tid=31&lpage=1&page=1" target="_blank" rel="nofollow">
            ��ϵ����
          </a>
        </p>
        <p>
          Copyright&nbsp;&nbsp;&copy;&nbsp;2015&nbsp;Acoolread.&nbsp;All&nbsp;Rights&nbsp;Reserved
        </p>
        <p>
   ���߷���<a href="http://www.acoolread.com" style="margin: 0px;">С˵</a>��Ʒʱ�������ع��һ�������Ϣ�����취�涨����վ����¼С˵��Ʒ���������⡢������۾����������Ϊ����������վ������
        </p>            
        <p>
    ���Ǿܾ��κ�ɫ��С˵���ܾ��κγ�Ϯ�����ַ���Ȩ��С˵��һ�����֣�����ɾ����
        </p>       
        <p>
          ����������&nbsp;��Ȩ���� ��ICP��14039675��-3
        </p>
      </div>
    </div>
  </div>
  <a id="goTopBtn" class="go_top" href="javascript:">
  </a>

  </div>
</body>

</html>';
?>