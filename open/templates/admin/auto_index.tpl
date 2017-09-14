<{include file="include/head.tpl"}>
    <div id="content" style="margin-left: 0px !important;">

    </div>
<style>
    .widget-box{
        box-shadow: 2px 2px 5px 2px #999;
        border-radius: 10px;
        overflow: hidden;
    }
    .form-horizontal .control-label {
        padding: 10px 0;
        height: 20px;
        line-height: 20px;
        margin: 0px;
    }
    .widget-title h5{
        font-size: 1rem;
    }
    .form-horizontal .controls {
        font-size: 14px;
        font-weight: normal;
    }
</style>
<script src="templates/admin/js/excanvas.min.js"></script>
<script src="templates/admin/js/jquery.min.js"></script>
<script src="templates/admin/js/jquery.ui.custom.js"></script>
<script src="templates/admin/js/bootstrap.min.js"></script>
<script src="templates/admin/js/jquery.flot.min.js"></script>
<script src="templates/admin/js/jquery.flot.resize.min.js"></script>
<script src="templates/admin/js/jquery.peity.min.js"></script>
<script src="templates/admin/js/fullcalendar.min.js"></script>
<script src="templates/admin/js/bootstrap-colorpicker.js"></script>
<script src="templates/admin/js/bootstrap-datepicker.js"></script>
<script src="templates/admin/js/masked.js"></script>
<script src="templates/admin/js/jquery.gritter.min.js"></script>
<script src="templates/admin/js/jquery.validate.js"></script>
<script src="templates/admin/js/jquery.wizard.js"></script>
<script src="templates/admin/js/jquery.uniform.js"></script>
<script src="templates/admin/js/select2.min.js"></script>
<script src="templates/admin/js/jquery.dataTables.min.js"></script>
<script src="templates/admin/js/Miyue.js"></script>
<script src="templates/admin/js/Globals.js"></script>
<script src="templates/admin/js/Login.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        Admin_index = "index.php/auto/index/";
        var uri = window.location.hash || "index.php/auto/start";
        uri = uri.replace("#","");
        Miyue.PageView(uri);
    });
</script>
</body>
</html>
