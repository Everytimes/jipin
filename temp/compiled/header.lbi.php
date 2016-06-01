

<div class="city-bg"></div>
<script>
$(function () {
    H_login = {};
    H_login.openLogin = function(){
        $('.tcity_tit a').click(function(){
            $('.city').show();
            $('.city-bg').show();
        });
    };
    H_login.closeLogin = function(){
        $('.close-city').click(function(){
            $('.city').hide();
            $('.city-bg').hide();
        });
    };
    H_login.run = function () {
        this.closeLogin();
        this.openLogin();
        this.loginForm();
    };
    H_login.run();
});
</script>