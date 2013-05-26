<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("admin/common/header"); ?>

<!-- this page specific styles -->
<link rel="stylesheet" href="<?php echo base_url('public/admin/css/compiled/signin.css') ?>" type="text/css" media="screen" />

<!-- pre load bg imgs -->
<script type="text/javascript">
    $(function () {
        $("html").css("background-image", "url('<?php echo base_url('public/admin/img/bgs/landscape.jpg') ?>");
    });
</script>
<form action="<?php echo site_url('a/login/accountLogin') ?>" method="post">
    <div class="row-fluid login-wrapper">
        <img class="logo" src="<?php echo base_url('public/admin/img/logo-white.png') ?>">

        <div class="span4 box">
            <div class="content-wrap">
                <h6>系统登陆</h6>
                <input class="span12" type="text" id="accountcode" name="accountcode" placeholder="帐户名" value="admin" required>
                <input class="span12" type="password" id="password" name="password" placeholder="密码" value="password" required>
                <div class="controls input-append">
                    <input class="span2" style="width:206px" name="verify" placeholder="点击输入验证码" required id="verify"
                           type="text">
                    <img title="点击刷新" class="add-on" src="<?php echo site_url("a/login/getVerify"); ?>" alt="验证码"
                         id="verifyImg" name="verifyImg" style="
    height: 38px;
    padding: 0;
    width: 120px;" class="img-polaroid">
                </div>
                <div class="remember">
                    <label for="remember-me"><?php echo (isset($login_error_msg)) ? '<span style="color:red; ">' . $login_error_msg . '</span>' : '' ?></label>
                </div>
            </div>

            <button type="submit" class="btn-glow primary login">登录</button>
        </div>
        <div class="span5 no-account" style="line-height: 10px;">
            <p>&copy; 2013 丰意德 系统要求：请使用IE8.0以上或Firefox等现代浏览器。</p>
        </div> <!-- /container -->
    </div>
</form>
    </body>
</html>
<script type="text/javascript">
    function refreshCode() {
        var date = new Date();
        var ttime = date.getTime();
        var url = "<?php echo site_url("a/login/getVerify");?>";
        $('#verifyImg').show().attr('src', url + '/t/' + ttime);
    }
    $('#verifyImg').click(refreshCode);
</script>