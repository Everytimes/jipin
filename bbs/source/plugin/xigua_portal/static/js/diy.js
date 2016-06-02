/**
 * Created by yangzhiguo on 15/3/14.
 */
$(function(){
    "use strict";

    $('.button2').on('click', function(){
        $('#form').submit();
    });

    $('a.delbg').on('click', function(){
        $('#bg').val('');
        $('#ajaxtip2').html('');
        $(this).hide();
    });

    picker();
});

function htmlspecialchars(str)
{
    str = str.replace(/&/g, '&amp;');
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/'/g, '&#039;');
    return str;
}

function change_tids(obj){
    if(obj.value == 'threadspecified' || obj.value == 'articlespecified'){
        $('.ipe').show();
    }else{
        $('.ipe').hide();
        $('#tids').val('');
    }
}

function picker(){
    $('span.J_color_pick').colorPicker({
        callback:function(color) {
            var em = $(this).find('em'),
                input = $(this).next('.J_hidden_color');
            em.css('background',  color);
            input.val(color.length === 7 ? color : '');
        }
    });
}

function ajaxFileUpload() {
    $('#ajaxtip1').html('');
    $("#ajaxloading-img").show();
    $.ajaxFileUpload({
        url:actionurl,
        secureuri:false,
        fileElementId:'xiguafile',
        dataType: 'json',
        data:{ac:'upload', formhash:FORMHASH},
        success: function (data, status){
            if(typeof(data.errno) != 'undefined' && data.errno != 0){
                $('#ajaxtip1').html(data.error);
            }else{
                $('#ajaxtip2').html('<img src="'+data.error+'" />');
                $('#bg').val(data.error);
                $('a.delbg').show();
            }
            $("#ajaxloading-img").hide();
        },
        error: function (data, status, e){
            $("#ajaxloading-img").hide();
            if(typeof(data.error) != 'undefined') {
                alert(data.error);
            }else{
                alert(e);
            }
        }
    });
    return false;
}


var addrowdirect = 0;
var addrowkey = 0;
function addrow(obj, type) {
    var table = obj.parentNode.parentNode.parentNode.parentNode;
    if(!addrowdirect) {
        var row = table.insertRow(obj.parentNode.parentNode.rowIndex);
    } else {
        var row = table.insertRow(obj.parentNode.parentNode.rowIndex + 1);
    }
    var typedata = rowtypedata[type];
    for(var i = 0; i <= typedata.length - 1; i++) {
        var cell = row.insertCell(i);
        cell.colSpan = typedata[i][0];
        var tmp = typedata[i][1];
        if(typedata[i][2]) {
            cell.className = typedata[i][2];
        }
        tmp = tmp.replace(/\{(n)\}/g, function($1) {return addrowkey;});
        tmp = tmp.replace(/\{(\d+)\}/g, function($1, $2) {return addrow.arguments[parseInt($2) + 1];});
        cell.innerHTML = tmp;
    }
    addrowkey ++;
    addrowdirect = 0;
    return false;
}

function deleterow(obj) {
    var table = obj.parentNode.parentNode.parentNode.parentNode;
    var tr = obj.parentNode.parentNode;
    table.deleteRow(tr.rowIndex);
}