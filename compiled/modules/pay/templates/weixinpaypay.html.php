<?php
echo '<link rel="stylesheet" rev="stylesheet" href="/sink/css/login.css" type="text/css" media="all" />

<h3>
    <img  src="/sink/image/logo.png" style="height:70px;"/>
</h3>

<h3>
    <strong>
        请您及时付款，以便订单尽快处理！ 订单号：'.$this->_tpl_vars['out_trade_no'].'
    </strong>
</h3>
<input type="hidden" name="out_trade_no" id="out_trade_no" value="'.$this->_tpl_vars['out_trade_no'].'" />

<div class="box_mid fix" style="width:100%;height:550px;">
    <div class="login" style="width:450px;">
        <div>
            <h3>
                <strong>
                    微信支付
                </strong></h3>

            <p style="color:red">充值金额'.$this->_tpl_vars['total_fee'].'元</p>
            <p style="color:red">请在<em id="time">2</em>小时内完成支付</p>
        </div>

        <img alt="模式二扫码支付" src="http://www.mianfeidushu.com/lib/OpenSDK/WxpayAPI/example/qrcode.php?data='.$this->_tpl_vars['imgUrl'].'" style="width:298px;height:298px;"/>
    </div>

    <div class="lother" style="width:330px;background-image:url(/sink/image/phone-bg.png);background-position:center; background-repeat:no-repeat;background-size: initial;background-repeat-x: no-repeat;background-repeat-y: no-repeat;background-attachment: initial;background-origin: initial;background-clip: initial;background-color: white;padding-left: 0px;margin-top:30px; ">
        <!--<img src="/sink/image/phone-bg.png" style="height:410px;"/>-->
    </div>
</div>

<script>

    //设置每隔1000毫秒执行一次load() 方法
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
                    alert(\'支付成功，点击按钮跳转到首页\');

                    //延迟3000毫秒执行tz() 方法
                    clearInterval(myIntval);

                    setTimeout("location.href=\'http://www.mianfeidushu.com\'",0);
                }
            }
        }

        //orderquery.php 文件返回订单状态，通过订单状态确定支付状态
        xmlhttp.open("POST","http://www.mianfeidushu.com/modules/pay/weixinorderquery.php",false);

        //下面这句话必须有
        //把标签/值对添加到要发送的头文件。
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

        xmlhttp.send("out_trade_no=" + $(\'#out_trade_no\').val());
    }
</script>

</body>';
?>