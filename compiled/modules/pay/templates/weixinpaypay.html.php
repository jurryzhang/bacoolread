<?php
echo '<link rel="stylesheet" rev="stylesheet" href="/sink/css/login.css" type="text/css" media="all" />

<h3>
    <img  src="/sink/image/logo.png" style="height:70px;"/>
</h3>

<h3>
    <strong>
        ������ʱ����Ա㶩�����촦�� �����ţ�'.$this->_tpl_vars['out_trade_no'].'
    </strong>
</h3>
<input type="hidden" name="out_trade_no" id="out_trade_no" value="'.$this->_tpl_vars['out_trade_no'].'" />

<div class="box_mid fix" style="width:100%;height:550px;">
    <div class="login" style="width:450px;">
        <div>
            <h3>
                <strong>
                    ΢��֧��
                </strong></h3>

            <p style="color:red">��ֵ���'.$this->_tpl_vars['total_fee'].'Ԫ</p>
            <p style="color:red">����<em id="time">2</em>Сʱ�����֧��</p>
        </div>

        <img alt="ģʽ��ɨ��֧��" src="http://www.mianfeidushu.com/lib/OpenSDK/WxpayAPI/example/qrcode.php?data='.$this->_tpl_vars['imgUrl'].'" style="width:298px;height:298px;"/>
    </div>

    <div class="lother" style="width:330px;background-image:url(/sink/image/phone-bg.png);background-position:center; background-repeat:no-repeat;background-size: initial;background-repeat-x: no-repeat;background-repeat-y: no-repeat;background-attachment: initial;background-origin: initial;background-clip: initial;background-color: white;padding-left: 0px;margin-top:30px; ">
        <!--<img src="/sink/image/phone-bg.png" style="height:410px;"/>-->
    </div>
</div>

<script>

    //����ÿ��1000����ִ��һ��load() ����
    var myIntval = setInterval(function(){load()},1000);

    function load()
    {
        //document.getElementById("timer").innerHTML = parseInt(document.getElementById("timer").innerHTML) + 1;

        var xmlhttp;

        if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                trade_state = xmlhttp.responseText;

                if(trade_state == \'SUCCESS\')
                {
                    alert(\'֧���ɹ��������ť��ת����ҳ\');

                    //�ӳ�3000����ִ��tz() ����
                    clearInterval(myIntval);

                    setTimeout("location.href=\'http://www.mianfeidushu.com\'",0);
                }
            }
        }

        //orderquery.php �ļ����ض���״̬��ͨ������״̬ȷ��֧��״̬
        xmlhttp.open("POST","http://www.mianfeidushu.com/modules/pay/weixinorderquery.php",false);

        //������仰������
        //�ѱ�ǩ/ֵ����ӵ�Ҫ���͵�ͷ�ļ���
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

        xmlhttp.send("out_trade_no=" + $(\'#out_trade_no\').val());
    }
</script>

</body>';
?>