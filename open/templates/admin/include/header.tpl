<!--Header-part-->
<div id="header">
    <h1><{$title}></h1>
</div>
<!--close-Header-part-->


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li  class="dropdown" id="profile-messages" ><a title="" href="javascript:void(0);" data-toggle="dropdown" data-target="#profile-messages"><i class="icon icon-user"></i>  <span class="text"><{$userinfo->name}></span></a>
        </li>
        <li class=""><a title="" href="javascript:void(0);" onclick="Login.logout();"><i class="icon icon-share-alt"></i> <span class="text">注销</span></a></li>
    </ul>
</div>
<!--close-top-Header-menu-->