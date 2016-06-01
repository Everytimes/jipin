var _ajax_cache={};
function ajaxRequest(method, cachekey, params, callbackfun, noanimation)
{
    //if(!noanimation) show_loading();
    jQuery.ajax({
        url: ajaxapi+cachekey,
        type: method,
        dataType: "json",
        data: params,
        complete: function(res) {
            //if(!noanimation) hide_loading();
        },
        success: function(res) {
            if (res.retcode != 0) alert(res.retmsg);
            else callbackfun(res);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            var errmsg = "Error("+XMLHttpRequest.readyState+") : "+textStatus;
            alert(errmsg);
        }
    });   
}
function ajaxPost(cachekey, params, callbackfun, noanimation) 
{
    ajaxRequest("post", cachekey, params, callbackfun, noanimation);
}
function ajaxGet(cachekey, params, callbackfun, noanimation)
{
    ajaxRequest("get", cachekey, params, callbackfun, noanimation);
}
