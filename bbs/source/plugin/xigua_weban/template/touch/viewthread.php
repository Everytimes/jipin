<?php exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={CHARSET}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>$_G[forum_thread][subject]</title>
    <link rel="stylesheet" type="text/css" href="{$_G[siteurl]}source/plugin/xigua_weban/static/style.css?$version">
</head>
<body id="activity-detail" class="zh_CN mm_appmsg not_in_mm">

<div id="comment" class="discuss_container editing access">
    <form method="post" autocomplete="off" action="">
        <input type="hidden" name="formhash" id="formhash" value="{FORMHASH}">
        <input type="hidden" name="handlekey" value="comment">
        <input type="hidden" name="commentsubmit" value="1">
        <div class="discuss_container_inner hide">
            <h2 class="rich_media_title"></h2>
            <div class="frm_textarea_box_wrp">
            <span class="frm_textarea_box">
                <textarea  name="message" class="frm_textarea" placeholder="" oninput="if($(this).val()){$('#replysubmit').removeClass('btn_disabled');}else{$('#replysubmit').addClass('btn_disabled');}"></textarea>
            </span>
            </div>
            <div class="discuss_btn_wrp"><a id="replysubmit" onclick="return docmtreply();" name="replysubmit" class="btn btn_primary btn_discuss btn_disabled" href="javascript:;">{lang xigua_weban:tijiao}</a></div>

            <div class="rich_tips tips_global loading_tips" id="replysubmitsuccess" style="display:none">
                <span class="tips">{lang xigua_weban:chenggong}</span>
            </div>

        </div>
    </form>
</div>
<div id="js_cmt_mine" class="discuss_container editing access">
<form method="post" autocomplete="off" id="fastpostform" action="forum.php?mod=post&action=reply&fid=$_G[fid]&tid=$_G[tid]&extra={$_GET[extra]}&replysubmit=yes&mobile=2">
<input type="hidden" name="formhash" value="{FORMHASH}" />
    <div class="discuss_container_inner hide" id="discuss_container_inner">
        <h2 class="rich_media_title"><!--{if $_G['forum_thread']['typeid'] && $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]}-->
            [{$_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]}]
            <!--{/if}-->
            <!--{if $threadsorts && $_G['forum_thread']['sortid']}-->
            [{$_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']]}]
            <!--{/if}-->
            $_G[forum_thread][subject]</h2>
        <span id="log"></span>
        <div class="frm_textarea_box_wrp">
                <span class="frm_textarea_box">
                    <textarea  name="message" id="fastpostmessage" class="frm_textarea" placeholder="$config[replytxt]"></textarea>
                    <div class="emotion_tool">
                        <span class="emotion_switch" style="display:none;"></span>
                        <span id="js_emotion_switch" class="pic_emotion_switch_wrp">
                            <img class="pic_default" src="source/plugin/xigua_weban/static/icon_emotion_switch.png">
                            <img class="pic_active" src="source/plugin/xigua_weban/static/icon_emotion_switch_active.png">
                        </span>
                        <div class="emotion_panel" id="js_emotion_panel">
                            <span class="emotion_panel_arrow_wrp" id="js_emotion_panel_arrow_wrp">
                                <i class="emotion_panel_arrow arrow_out"></i>
                                <i class="emotion_panel_arrow arrow_in"></i>
                            </span>
                            <div class="emotion_list_wrp" id="js_slide_wrapper"></div>
                            <div class="swipe cl">
                                <div class="swipe-wrap">
                                    <div>

                                        <div class="swipein cl">
                                        <b><span data-face="{lang xigua_weban:w1}" class="icon_emotion_single icon1"></span></b>
                                        <b><span data-face="{lang xigua_weban:w2}" class="icon_emotion_single icon2"></span></b>
                                        <b><span data-face="{lang xigua_weban:w3}" class="icon_emotion_single icon3"></span></b>
                                        <b><span data-face="{lang xigua_weban:w4}" class="icon_emotion_single icon4"></span></b>
                                        <b><span data-face="{lang xigua_weban:w5}" class="icon_emotion_single icon5"></span></b>
                                        <b><span data-face="{lang xigua_weban:w6}" class="icon_emotion_single icon6"></span></b>
                                        <b><span data-face="{lang xigua_weban:w7}" class="icon_emotion_single icon7"></span></b>
                                        <b><span data-face="{lang xigua_weban:w8}" class="icon_emotion_single icon8"></span></b>
                                        <b><span data-face="{lang xigua_weban:w9}" class="icon_emotion_single icon9"></span></b>
                                        <b><span data-face="{lang xigua_weban:w10}" class="icon_emotion_single icon10"></span></b>
                                        <b><span data-face="{lang xigua_weban:w11}" class="icon_emotion_single icon11"></span></b>
                                        <b><span data-face="{lang xigua_weban:w12}" class="icon_emotion_single icon12"></span></b>
                                        <b><span data-face="{lang xigua_weban:w13}" class="icon_emotion_single icon13"></span></b>
                                        <b><span data-face="{lang xigua_weban:w14}" class="icon_emotion_single icon14"></span></b>
                                        <b><span data-face="{lang xigua_weban:w15}" class="icon_emotion_single icon15"></span></b>
                                        <b><span data-face="{lang xigua_weban:w16}" class="icon_emotion_single icon16"></span></b>
                                        <b><span data-face="{lang xigua_weban:w17}" class="icon_emotion_single icon17"></span></b>
                                        <b><span data-face="{lang xigua_weban:w18}" class="icon_emotion_single icon18"></span></b>
                                        <b><span data-face="{lang xigua_weban:w19}" class="icon_emotion_single icon19"></span></b>
                                        <b><span data-face="{lang xigua_weban:w20}" class="icon_emotion_single icon20"></span></b>
                                        <b><span data-face="{lang xigua_weban:w21}" class="icon_emotion_single icon21"></span></b>
                                        <b><span data-face="{lang xigua_weban:w22}" class="icon_emotion_single icon22"></span></b>
                                        <b><span data-face="{lang xigua_weban:w23}" class="icon_emotion_single icon23"></span></b>
                                        <b><span data-face="{lang xigua_weban:w24}" class="icon_emotion_single icon24"></span></b>
                                        <b><span data-face="{lang xigua_weban:w25}" class="icon_emotion_single icon25"></span></b>
                                        <b><span data-face="{lang xigua_weban:w26}" class="icon_emotion_single icon26"></span></b>
                                        <b><span class="icon_emotion del"></span></b>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="swipein">
                                            <b><span data-face="{lang xigua_weban:w27}" class="icon_emotion_single icon27"></span></b>
                                            <b><span data-face="{lang xigua_weban:w28}" class="icon_emotion_single icon28"></span></b>
                                            <b><span data-face="{lang xigua_weban:w29}" class="icon_emotion_single icon29"></span></b>
                                            <b><span data-face="{lang xigua_weban:w30}" class="icon_emotion_single icon30"></span></b>
                                            <b><span data-face="{lang xigua_weban:w31}" class="icon_emotion_single icon31"></span></b>
                                            <b><span data-face="{lang xigua_weban:w32}" class="icon_emotion_single icon32"></span></b>
                                            <b><span data-face="{lang xigua_weban:w33}" class="icon_emotion_single icon33"></span></b>
                                            <b><span data-face="{lang xigua_weban:w34}" class="icon_emotion_single icon34"></span></b>
                                            <b><span data-face="{lang xigua_weban:w35}" class="icon_emotion_single icon35"></span></b>
                                            <b><span data-face="{lang xigua_weban:w36}" class="icon_emotion_single icon36"></span></b>
                                            <b><span data-face="{lang xigua_weban:w37}" class="icon_emotion_single icon37"></span></b>
                                            <b><span data-face="{lang xigua_weban:w38}" class="icon_emotion_single icon38"></span></b>
                                            <b><span data-face="{lang xigua_weban:w39}" class="icon_emotion_single icon39"></span></b>
                                            <b><span data-face="{lang xigua_weban:w40}" class="icon_emotion_single icon40"></span></b>
                                            <b><span data-face="{lang xigua_weban:w41}" class="icon_emotion_single icon41"></span></b>
                                            <b><span data-face="{lang xigua_weban:w42}" class="icon_emotion_single icon42"></span></b>
                                            <b><span data-face="{lang xigua_weban:w43}" class="icon_emotion_single icon43"></span></b>
                                            <b><span data-face="{lang xigua_weban:w44}" class="icon_emotion_single icon44"></span></b>
                                            <b><span data-face="{lang xigua_weban:w45}" class="icon_emotion_single icon45"></span></b>
                                            <b><span data-face="{lang xigua_weban:w46}" class="icon_emotion_single icon46"></span></b>
                                            <b><span data-face="{lang xigua_weban:w47}" class="icon_emotion_single icon47"></span></b>
                                            <b><span data-face="{lang xigua_weban:w48}" class="icon_emotion_single icon48"></span></b>
                                            <b><span data-face="{lang xigua_weban:w49}" class="icon_emotion_single icon49"></span></b>
                                            <b><span data-face="{lang xigua_weban:w50}" class="icon_emotion_single icon50"></span></b>
                                            <b><span data-face="{lang xigua_weban:w51}" class="icon_emotion_single icon51"></span></b>
                                            <b><span data-face="{lang xigua_weban:w52}" class="icon_emotion_single icon52"></span></b>
                                            <b><span class="icon_emotion del"></span></b>
                                    </div>
                                    </div>
                                    <div>

                                        <div class="swipein">
                                            <b><span data-face="{lang xigua_weban:w53}" class="icon_emotion_single icon53"></span></b>
                                            <b><span data-face="{lang xigua_weban:w54}" class="icon_emotion_single icon54"></span></b>
                                            <b><span data-face="{lang xigua_weban:w55}" class="icon_emotion_single icon55"></span></b>
                                            <b><span data-face="{lang xigua_weban:w56}" class="icon_emotion_single icon56"></span></b>
                                            <b><span data-face="{lang xigua_weban:w57}" class="icon_emotion_single icon57"></span></b>
                                            <b><span data-face="{lang xigua_weban:w58}" class="icon_emotion_single icon58"></span></b>
                                            <b><span data-face="{lang xigua_weban:w59}" class="icon_emotion_single icon59"></span></b>
                                            <b><span data-face="{lang xigua_weban:w60}" class="icon_emotion_single icon60"></span></b>
                                            <b><span data-face="{lang xigua_weban:w61}" class="icon_emotion_single icon61"></span></b>
                                            <b><span data-face="{lang xigua_weban:w62}" class="icon_emotion_single icon62"></span></b>
                                            <b><span data-face="{lang xigua_weban:w63}" class="icon_emotion_single icon63"></span></b>
                                            <b><span data-face="{lang xigua_weban:w64}" class="icon_emotion_single icon64"></span></b>
                                            <b><span data-face="{lang xigua_weban:w65}" class="icon_emotion_single icon65"></span></b>
                                            <b><span data-face="{lang xigua_weban:w66}" class="icon_emotion_single icon66"></span></b>
                                            <b><span data-face="{lang xigua_weban:w67}" class="icon_emotion_single icon67"></span></b>
                                            <b><span data-face="{lang xigua_weban:w68}" class="icon_emotion_single icon68"></span></b>
                                            <b><span data-face="{lang xigua_weban:w69}" class="icon_emotion_single icon69"></span></b>
                                            <b><span data-face="{lang xigua_weban:w70}" class="icon_emotion_single icon70"></span></b>
                                            <b><span data-face="{lang xigua_weban:w71}" class="icon_emotion_single icon71"></span></b>
                                            <b><span data-face="{lang xigua_weban:w72}" class="icon_emotion_single icon72"></span></b>
                                            <b><span data-face="{lang xigua_weban:w73}" class="icon_emotion_single icon73"></span></b>
                                            <b><span data-face="{lang xigua_weban:w74}" class="icon_emotion_single icon74"></span></b>
                                            <b><span data-face="{lang xigua_weban:w75}" class="icon_emotion_single icon75"></span></b>
                                            <b><span data-face="{lang xigua_weban:w76}" class="icon_emotion_single icon76"></span></b>
                                            <b><span data-face="{lang xigua_weban:w77}" class="icon_emotion_single icon77"></span></b>
                                            <b><span data-face="{lang xigua_weban:w78}" class="icon_emotion_single icon78"></span></b>
                                            <b><span class="icon_emotion del"></span></b>
                                    </div>
                                    </div>
                                    <div>

                                        <div class="swipein">
                                            <b><span data-face="{lang xigua_weban:w79}" class="icon_emotion_single icon79"></span></b>
                                            <b><span data-face="{lang xigua_weban:w80}" class="icon_emotion_single icon80"></span></b>
                                            <b><span data-face="{lang xigua_weban:w81}" class="icon_emotion_single icon81"></span></b>
                                            <b><span data-face="{lang xigua_weban:w82}" class="icon_emotion_single icon82"></span></b>
                                            <b><span data-face="{lang xigua_weban:w83}" class="icon_emotion_single icon83"></span></b>
                                            <b><span data-face="{lang xigua_weban:w84}" class="icon_emotion_single icon84"></span></b>
                                            <b><span data-face="{lang xigua_weban:w85}" class="icon_emotion_single icon85"></span></b>
                                            <b><span data-face="{lang xigua_weban:w86}" class="icon_emotion_single icon86"></span></b>
                                            <b><span data-face="{lang xigua_weban:w87}" class="icon_emotion_single icon87"></span></b>
                                            <b><span data-face="{lang xigua_weban:w88}" class="icon_emotion_single icon88"></span></b>
                                            <b><span data-face="{lang xigua_weban:w89}" class="icon_emotion_single icon89"></span></b>
                                            <b><span data-face="{lang xigua_weban:w90}" class="icon_emotion_single icon90"></span></b>
                                            <b><span data-face="{lang xigua_weban:w91}" class="icon_emotion_single icon91"></span></b>
                                            <b><span data-face="{lang xigua_weban:w92}" class="icon_emotion_single icon92"></span></b>
                                            <b><span data-face="{lang xigua_weban:w93}" class="icon_emotion_single icon93"></span></b>
                                            <b><span data-face="{lang xigua_weban:w94}" class="icon_emotion_single icon94"></span></b>
                                            <b><span data-face="{lang xigua_weban:w95}" class="icon_emotion_single icon95"></span></b>
                                            <b><span data-face="{lang xigua_weban:w96}" class="icon_emotion_single icon96"></span></b>
                                            <b><span data-face="{lang xigua_weban:w97}" class="icon_emotion_single icon97"></span></b>
                                            <b><span data-face="{lang xigua_weban:w98}" class="icon_emotion_single icon98"></span></b>
                                            <b><span data-face="{lang xigua_weban:w99}" class="icon_emotion_single icon99"></span></b>
                                            <b><span data-face="{lang xigua_weban:w100}" class="icon_emotion_single icon100"></span></b>
                                            <b><span data-face="{lang xigua_weban:w102}" class="icon_emotion_single icon102"></span></b>
                                            <b><span data-face="{lang xigua_weban:w103}" class="icon_emotion_single icon103"></span></b>
                                            <b><span data-face="{lang xigua_weban:w104}" class="icon_emotion_single icon104"></span></b>
                                            <b><span data-face="{lang xigua_weban:w105}" class="icon_emotion_single icon105"></span></b>
                                            <b><span class="icon_emotion del"></span></b>
                                    </div>
                                    </div>
                                </div>
                                <nav class="bullets">
                                    <ul class="position">
                                        <li class="current"></li>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                </span>
        </div>
        <div class="discuss_btn_wrp"><a name="replysubmit" id="fastpostsubmit" class="btn btn_primary btn_discuss btn_disabled" href="javascript:;">{lang xigua_weban:tijiao}</a></div>
        <div class="discuss_list_wrp">
            <div class="rich_tips with_line title_tips discuss_title_line">
                <span class="tips">{lang xigua_weban:wode}</span>
            </div>
            <div class="discuss_list" id="js_cmt_mylist">

            </div>
        </div>
        <div class="rich_tips tips_global loading_tips" id="js_mycmt_loading" style="display:none">
            <img src="source/plugin/xigua_weban/static/icon_loading.gif" class="rich_icon icon_loading_white">
            <span class="tips">{lang xigua_weban:loading}</span>
        </div>
        <div class="wx_poptips" id="js_cmt_toast" style="display:none">
            <img class="icon_toast"
                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGoAAABqCAYAAABUIcSXAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA3NpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDoyMTUxMzkxZS1jYWVhLTRmZTMtYTY2NS0xNTRkNDJiOGQyMWIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MTA3QzM2RTg3N0UwMTFFNEIzQURGMTQzNzQzMDAxQTUiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MTA3QzM2RTc3N0UwMTFFNEIzQURGMTQzNzQzMDAxQTUiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChNYWNpbnRvc2gpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NWMyOGVjZTMtNzllZS00ODlhLWIxZTYtYzNmM2RjNzg2YjI2IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjIxNTEzOTFlLWNhZWEtNGZlMy1hNjY1LTE1NGQ0MmI4ZDIxYiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pmvxj1gAAAVrSURBVHja7J15rF1TFMbXk74q1ZKHGlMkJVIhIgg1FH+YEpEQJCKmGBpThRoSs5jVVNrSQUvEEENIhGiiNf9BiERICCFIRbUiDa2qvudbOetF3Tzv7XWGffa55/uS7593977n3vO7e5+199p7v56BgQGh0tcmvAUERREUQVEERREUQVEERREUQVEERREUQVEERREUQVEERREUQVEERVAUQVEERVAUQbVYk+HdvZVG8b5F0xj4RvhouB+eCy8KrdzDJc1RtAX8ILxvx98V1GyCSkN98Cx4z/95/Wn4fj6j6tUEeN4wkFSnw1MJqj5NhBfAuwaUHREUg4lqNMmePVsHll/HFhVfe1t3FwpJI8DXCCquDrCWNN4B6Tb4M3Z98aTPmTvh0YHl18PXw29yZiKejoPvcUD6E74yFBJbVDk6Bb7K8aP/Hb4c/tRzEYIqprPhSxzlf4Uvhb/0Xoig8qnHAJ3lqPMzfDH8XZ4LEpRf2sVdA5/sqPO9Qfop70UJyn+/boaPddT5yrq7VUUvTIVJI7q74MMddXR8NB1eXcYvhBpZm0s2w72/o86HFoKvLau/pYaXzjLMdUJ6y0LwtWV9CIIaXtvA8+G9HHV03u5q+K+yH47U0NoRngPv7KjzHDwTLj0bS1BDazfJJlcnOOostC6ysnCT+q80G/sIvFVgeW09D8FPVT0uoP7VfvAD8NjA8pqmuAN+OcYAjso0RbIZ8DGB5TVNcRO8JMaHY9SXSdfa3eeANJimWBLrA7JFiZwIXye+NMUV8CcxP2SRFjXefok7NRjSGZJlWUPvw2/wtNiQirSoXWyMsR28wR7AzzYM0oXw+Y7yK+CLJGeaoqjyrJSdZJD6Ov4+z5y6NJc0Az7NUecHydIUy+v60KNyQHoM3nKI1y7YCFiq0i7uBvgER52vDdKqWn9djhY1Dn4G3n6Ecqm2rF74dvgoR53S0hQxW9RJAZAGW5bSn58QJA27dQ7uIEedjywEX5NKVxCqsY6y+qA+LxFI4+yZ6oH0trWkNan80jygtIUsc5SflgAsDXgehfdx1KkkTRE76tN+Xue2jnTU0Ru1oIbvpt30bBtKhOp5yaaRkts0lic8V1i6dPcIRx2d/l8Y8XtNNEg7OOo8bl1kmmOKnDsO88CaYzejau0hWZqiL7C83oCH4SeTHvwV2BqqsHRVztSEYOmWF80NeXZT6Hd4KflResE9vCnBOlCyGfDNAstHTVPUDWoQ1t3iW+9WNizvlhfd4aerXd+ThqiMfNR6+9LvOOro5OY5JX2H4+F7HZD+kGzlamMgldWiirQsjcwWFbjmqZJteekJLK9pisvgL6RhKvuciZiwzrWWGapfrPy30kBVcSBIrw0aD3PU0XB6cehntq7rTMf7/2iQlktDVdXJLXlg6VjmiYBn6rWSTRCH6hvJ0hQrpcGq8oidsmHpTP8t8DGO9/vcWt9qabiqPgup1yKyQwvC2tSefZ73SSpNkUJ4PlLorlHZ+446nc8f3fIyywlJhwrTuwVSjBa1ccvSxN0hjjoK5xVrYZMd9V6XbFfgBukixTwGLg8sDam3dZR/wZ6L/dJlin1en8LS+bgpFbz3Ygvzu1J1HKxYNqxGpCmaCEo12rrBorD6LRp8UbpcdR5VWhTW35KlKd6QFqjuM2XzwlpnMxTvSkuUwuG/Xlg6NtPjbT6WFimF/VG6LEvXgn8QGDjMbBukVECFwhpoS+CQatfX2Q1q6H7wENHdrfCr0lKleEB9JyxNneus+VJpsVL9TwI6W65LovWIGl3KtVJaLv7LBwYTFEERFEVQFEERFEVQFEERFEVQFEERFEVQFEERFEVQFEERFFWq/hFgADUMN4RzT6/OAAAAAElFTkSuQmCC">
            <p class="toast_content">{lang xigua_weban:yiliuyan}</p>
        </div>
    </div>
</form>
</div>

<div id="js_article" class="rich_media">
<!--{if $config[ad_top]}-->
    <div id="js_top_ad_area" class="top_banner">$config[ad_top]</div>
<!--{/if}-->
    <div class="rich_media_inner">
        <div id="page-content">
            <div id="img-content" class="rich_media_area_primary">
                <h2 class="rich_media_title" id="activity-name">
                    <!--{if $_G['forum_thread']['typeid'] && $_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]}-->
                    [{$_G['forum']['threadtypes']['types'][$_G['forum_thread']['typeid']]}]
                    <!--{/if}-->
                    <!--{if $threadsorts && $_G['forum_thread']['sortid']}-->
                    [{$_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']]}]
                    <!--{/if}-->
                    $_G[forum_thread][subject]
                </h2>

                <!--{eval $postcount = 0;}-->
                <!--{loop $postlist $post}-->
                <!--{if $post['first']}-->

                <div class="rich_media_meta_list">
                    <!--{if $config[yuanchuang] && in_array($post[groupid], unserialize($config[yuanchuang])) }-->
                    <span id="copyright_logo" class="rich_media_meta meta_original_tag">{lang xigua_weban:yuanchuang}</span>
                    <!--{/if}-->
                    <em id="post-date" class="rich_media_meta rich_media_meta_text">{eval echo date('Y-m-d', $post[dbdateline])}</em>
                    <!--{if $config[author]}--><em class="rich_media_meta rich_media_meta_text">$post[author]</em><!--{/if}-->
                    <a class="rich_media_meta rich_media_meta_link rich_media_meta_nickname" href="{$config[lanzisrc]}" id="post-user">{$config[lanzi]}</a>
                </div>
                <div class="rich_media_content " id="js_content">
                    <!--{if $config[ad_title]}-->
                    <div id="js_top_title_area" class="top_banner">$config[ad_title]</div>
                    <!--{/if}-->
                    <!--{if $_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])}-->
                    <div class="grey quote">{$lang[message_banned]}</div>
                    <!--{elseif $_G['adminid'] != 1 && $post['status'] & 1}-->
                    <div class="grey quote">{$lang[message_single_banned]}</div>
                    <!--{elseif $needhiddenreply}-->
                    <div class="grey quote">{$lang[message_ishidden_hiddenreplies]}</div>
                    <!--{elseif $post['first'] && $_G['forum_threadpay']}-->
                    <!--{template forum/viewthread_pay}-->
                    <!--{else}-->

                    <!--{if $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))}-->
                    <div class="grey quote">{$lang[admin_message_banned]}</div>
                    <!--{elseif $post['status'] & 1}-->
                    <div class="grey quote">{$lang[admin_message_single_banned]}</div>
                    <!--{/if}-->
                    <!--{if $_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0}-->
                    {$lang[pay_threads]}: <strong>$_G[forum_thread][price] {$_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]][unit]}{$_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]][title]} </strong> <a href="forum.php?mod=misc&action=viewpayments&tid=$_G[tid]" >{$lang[pay_view]}</a>
                    <!--{/if}-->

                    <!--{if $post['first'] && $threadsort && $threadsortshow}-->
                    <!--{if $threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']}-->
                    <!--{if $threadsortshow['optionlist'] == 'expire'}-->
                    {$lang[has_expired]}
                    <!--{else}-->
                    <div class="box_ex2 viewsort">
                        <h4>$_G[forum][threadsorts][types][$_G[forum_thread][sortid]]</h4>
                        <!--{loop $threadsortshow['optionlist'] $option}-->
                        <!--{if $option['type'] != 'info'}-->
                        $option[title]: <!--{if $option['value']}-->$option[value] $option[unit]<!--{else}--><span class="xg1">--</span><!--{/if}--><br />
                        <!--{/if}-->
                        <!--{/loop}-->
                    </div>
                    <!--{/if}-->
                    <!--{/if}-->
                    <!--{/if}-->
                    <!--{if $post['first']}-->
                    <!--{if !$_G[forum_thread][special]}-->
                    $post[message]
                    <!--{elseif $_G[forum_thread][special] == 1}-->
                    <!--{template forum/viewthread_poll}-->
                    <!--{elseif $_G[forum_thread][special] == 2}-->
                    <!--{template forum/viewthread_trade}-->
                    <!--{elseif $_G[forum_thread][special] == 3}-->
                    <!--{template forum/viewthread_reward}-->
                    <!--{elseif $_G[forum_thread][special] == 4}-->
                    <!--{template forum/viewthread_activity}-->
                    <!--{elseif $_G[forum_thread][special] == 5}-->
                    <!--{template forum/viewthread_debate}-->
                    <!--{elseif $threadplughtml}-->
                    $threadplughtml
                    $post[message]
                    <!--{else}-->
                    $post[message]
                    <!--{/if}-->
                    <!--{else}-->
                    $post[message]
                    <!--{/if}-->
                    <!--{/if}-->


                    <!--{if $post['attachment']}-->
                    <div class="grey quote">
                        {$lang[attachment]}: <em><!--{if $_G['uid']}-->{$lang[attach_nopermission]}<!--{else}-->{$lang[attach_nopermission_login]}<!--{/if}--></em>
                    </div>
                    <!--{elseif $post['imagelist'] || $post['attachlist']}-->
                    <!--{if $post['imagelist']}-->
                    <ul class="img_list cl vm">{eval $imagelist1 = showattach($post, 1);echo preg_replace("/\s*\<img\s*id=\"aimg_(\d+)\".*?\>\s*/ies", "replace_aimg(\\1)", $imagelist1);}</ul>
                    <!--{/if}-->
                    <!--{if $post['attachlist']}-->
                    <ul>{echo showattach($post)}</ul>
                    <!--{/if}-->
                    <!--{/if}-->
                    <!--{hook/viewthread_postbottom_mobile 0}-->
                </div>
                <div class="rich_media_tool" id="js_toobar3">
                    <!--{if $config[yuanwen]}-->
                    <a class="media_tool_meta meta_primary" id="js_view_source" href="$yuanwenlink">{lang xigua_weban:yuanwen}</a>
                    <!--{/if}-->
                    <div id="js_read_area3" class="media_tool_meta tips_global meta_primary">{lang xigua_weban:yuedu}
                        <span id="readNum3">$_G[forum_thread][views]</span></div>
                        <span class="media_tool_meta meta_primary tips_global meta_praise" id="like3">
                            <i class="icon_praise_gray<!--{if $if_recommend}--> praised<!--{/if}-->"></i><span class="praise_num" id="likeNum3">{eval echo intval($_G[forum_thread][recommends])}</span>
                        </span>
                    <!--{if $config[jubao]}-->
                    <a id="js_report_article3" class="media_tool_meta tips_global meta_extra" href="$config[jubao]">{lang xigua_weban:jubao}</a>
                    <!--{/if}-->
                </div>
                <!--{eval break;}-->
                <!--{/if}-->
                <!--{/loop}-->

            </div>

            <div class="rich_media_area_extra">

                <!--{if $config[ad_btm]}-->
                <div class="mpda_bottom_container" id="js_bottom_ad_area">
                    <div class="rich_tips with_line title_tips ">
                        <span class="tips">{lang xigua_weban:guanggao}</span>
                    </div>
                    $config[ad_btm]
                </div>
                <!--{/if}-->


                <div class="rich_media_extra" id="js_cmt_area">

                    <div class="discuss_container" id="js_cmt_main">
                        <div class="rich_tips with_line title_tips discuss_title_line">
                            <span class="tips">{lang xigua_weban:jingxuan}</span>
                        </div>
                        <!--<p class="tips_global tc title_bottom_tips" id="js_cmt_nofans1" ></p>-->
                        <p class="discuss_icon_tips title_bottom_tips tr" id="js_cmt_addbtn1">
                            <a href="javascript:void(0);">{lang xigua_weban:xie}<img class="icon_edit" src="source/plugin/xigua_weban/static/icon_edit.png"></a>
                        </p>
                        <div class="discuss_list" id="js_cmt_list">
                            <!--{loop $postlist $post}-->
                            <!--{if !$post['first']}-->
                            <!--{subtemplate xigua_weban:viewthread_node}-->
                            <!--{/if}-->
                            <!--{/loop}-->
                        </div>
                    </div>

                    <div class="rich_tips tips_global loading_tips" id="js_cmt_loading" style="display:none">
                        <img src="source/plugin/xigua_weban/static/icon_loading.gif"
                             class="rich_icon icon_loading_white">
                        <span class="tips">{lang xigua_weban:loading}</span>
                    </div>

                    <!--{if $config[shaixuan]}-->
                    <div class="rich_tips with_line tips_global" id="js_cmt_statement" >
                        <span class="tips">{lang xigua_weban:shai1}</span>
                    </div>
                    <!--{/if}-->
                </div>
            </div>

        </div>

    </div>
</div>
<div id="mask"></div>
<script src="{$_G[siteurl]}source/plugin/xigua_weban/static/jquery-1.11.3.min.js"></script>
<!--<script src="source/plugin/xigua_weban/static/jquery.lazyload.min.js"></script>-->
<script src="{$_G[siteurl]}source/plugin/xigua_weban/static/slider.js?$version"></script>
<script src="{$_G[siteurl]}source/plugin/xigua_weban/static/common.js?$version"></script>
<script>
    window.onhashchange=function(){
        changehash();
    };
    function changehash(){
        switch (window.location.hash)
        {
            case '#reply':
                $('#comment').find('.discuss_container_inner').addClass('hide');
                $('#discuss_container_inner').removeClass('hide');
                $('#js_article').hide();
                $('iframe').hide();
                break;
            case '#comment':
                $('#comment').find('.discuss_container_inner').removeClass('hide');
                $('#discuss_container_inner').addClass('hide');
                $('#js_article').hide();
                $('iframe').hide();
                break;
            default:
                $('#comment').find('.discuss_container_inner').addClass('hide');
                $('#discuss_container_inner').addClass('hide');
                $('#js_article').show();
                break;
        }
    }

    $(function () {
//        $("img").lazyload({ effect : "fadeIn"  });
        var inputt = $('#fastpostmessage');
        function runslider(_this) {
            var bullets = _this.find('nav.bullets');
            var position = _this.find('ul.position');
            new Swipe2(_this[0], {
                startSlide: 0, speed: 500, auto: 0, continuous: true, callback: function (index) {
                    if (bullets.length > 0) {
                        bullets.find('em:first-child').text(index + 1);
                    }
                    if (position.length > 0) {
                        var selectors = position[0].children;
                        for (var t = 0; t < selectors.length; t++) {
                            selectors[t].className = selectors[t].className.replace("current", "");
                        }
                        selectors[(index) % (selectors.length)].className = "current";
                    }
                }
            });
        }
        function jihuo(obj){
            if(obj.val() !=''){
                $('#fastpostsubmit').removeClass('btn_disabled');
            }else{
                $('#fastpostsubmit').addClass('btn_disabled');
            }
        }
        function strrpos(haystack, needle, offset) {
            var i = -1;
            if (offset) {
                i = (haystack + '')
                    .slice(offset)
                    .lastIndexOf(needle);
                if (i !== -1) {
                    i += offset;
                }
            } else {
                i = (haystack + '')
                    .lastIndexOf(needle);
            }
            return i >= 0 ? i : false;
        }

        $('div.swipe').each(function () {
            runslider($(this));
            $(this).css('height', 'auto');
            $('#js_emotion_panel').hide();
        });
        $('#js_emotion_switch').on('touchstart',function(){
            $('#js_emotion_panel').toggle();
        });
        $('.swipein b').on('click',function(){
            var span =$(this).find('span');
            var face = span.attr('data-face');
            var old = inputt.val();
            if(!face){
                var pos = strrpos(old, '/');
                if(pos===false){
                    pos = old.length-1;
                }else if(old.length-pos>4){
                    pos = old.length-1;
                }
                var n= old.substr(0,pos);
                inputt.val(n);
            }else{
                inputt.val(old+face);
            }
            jihuo(inputt);
        });
        inputt.on('input', function(){
            jihuo($(this));
        });
        $('#js_cmt_addbtn1').on('click', function(){
            window.location.hash = '';
            window.location.hash = '#reply';
            changehash();

            <!--{if $_G[uid]}-->
            comment_page = 1;
            setTimeout(function(){
                loadmycomment();
            }, 100);
            <!--{/if}-->
        });

        $('#like3').on('click', function(){
            dorecomm($(this));
        });

        $(window).scroll(function(){
            if(isbottom()){
                loadmycomment();
            }
        });
    });

    //========================================
    (function() {
        var form = $('#fastpostform');
        <!--{if !$_G[uid] || $_G[uid] && !$allowpostreply}-->
        $('#fastpostmessage').on('focus', function () {
            <!--{if !$_G[uid]}-->
            popup.open('{lang nologin_tip}', 'confirm', 'member.php?mod=logging&action=login');
            <!--{else}-->
            popup.open('{lang nopostreply}', 'alert');
            <!--{/if}-->
            this.blur();
        });
        <!--{else}-->
        $('#fastpostmessage').on('focus', function () {
                var obj = $(this);
                if (obj.attr('color') == 'gray') {
                    obj.attr('value', '');
                    obj.removeClass('grey');
                    obj.attr('color', 'black');
                    $('#fastpostsubmitline').css('display', 'block');
                }
            })
            .on('blur', function () {
                var obj = $(this);
                if (obj.attr('value') == '') {
                    obj.addClass('grey');
                    obj.attr('value', '{lang send_reply_fast_tip}');
                    obj.attr('color', 'gray');
                }
            });
        <!--{/if}-->
        $('#fastpostsubmit').on('click', function () {
            var msgobj = $('#fastpostmessage');
            if (msgobj.val() == '') {
                return false;
            }
            if (msgobj.val() == '{lang send_reply_fast_tip}') {
                msgobj.attr('value', '');
            }
            $.ajax({
                    type: 'POST',
                    url: form.attr('action') + '&handlekey=fastpost&loc=1&inajax=1',
                    data: form.serialize(),
                    dataType: 'xml'
                })
                .success(function (s) {
                    evalscript(s.lastChild.firstChild.nodeValue);
                })
                .error(function () {
                    window.location.href = window.location.href;
                    popup.close();
                });
            return false;
        });

        $('#replyid').on('click', function () {
            $(document).scrollTop($(document).height());
            $('#fastpostmessage')[0].focus();
        });
    })();

    var datapid = 0;
    function dorecomm(obj){
        if(obj.find('.icon_praise_gray').hasClass('praised')){
            return ;
        }
        var islogin = $_G[uid];
        if(!islogin){
            window.location.href = 'member.php?mod=logging&action=login&mobile=2';
            return ;
        }

        var url = '';
        datapid = obj.attr('data-pid');
        if(datapid){
            url = 'forum.php?mod=misc&action=postreview&do=support&tid=$_G[tid]&pid='+datapid+'&hash={FORMHASH}&inajax=1';
        }else{
            url = 'forum.php?mod=misc&action=recommend&do=add&tid=$_G[tid]&hash={FORMHASH}&inajax=1';
        }

        $.ajax({
                type: 'GET',
                url: url,
                dataType: 'xml'
            })
            .success(function (s) {
                evalscript(s.lastChild.firstChild.nodeValue);
            })
            .error(function () {
                popup.close();
            });
    }

    function succeedhandle_fastpost(locationhref, message, param) {
        sucalert();
        var pid = param['pid'];
        var tid = param['tid'];
        if(pid) {
            $.ajax({
                    type:'POST',
                    url:'forum.php?mod=viewthread&tid=' + tid + '&weban=1&viewpid=' + pid + '&mobile=2',
                    dataType:'xml'
                })
                .success(function(s) {
                    $('#js_cmt_mylist').prepend(s.lastChild.firstChild.nodeValue);
                })
                .error(function() {
                    window.location.href = window.location.href;
                    popup.close();
                });
        } else {
            if(!message) {
                message = '{lang postreplyneedmod}';
            }
            popup.open(message, 'alert');
        }
        <!--{if $config[autohref]}-->
        setTimeout(function(){
            window.location.href = locationhref;
        }, $config[autohref]);
        <!--{/if}-->
        $('#fastpostmessage').val('');
//        if(param['sechash']) {
//            $('.seccodeimg').click();
//        }
    }
    function errorhandle_(message, param){
        if(param['recommendv']) {
            var likeNum3 = $('#likeNum3');
            $('#like3').find('.icon_praise_gray').addClass('praised');
            likeNum3.text(parseInt(likeNum3.text())+1);
        }else if(message=='{echo lang("message", "thread_poll_succeed")}'){
            var like4 = $('#datapid-'+datapid);
            like4.find('.icon_praise_gray').addClass('praised');
            like4.find('.praise_num').text(parseInt(like4.find('.praise_num').text())+1);
        }else{
            popup.open(message, 'alert');
        }
    }

    function errorhandle_fastpost(message, param) {
        popup.open(message, 'alert');
    }
    function sucalert(){
        $('#js_cmt_toast').show();
        setTimeout(function(){
            $('#js_cmt_toast').hide();
        },2000);
    }
    function shwloading(){
        $('#js_mycmt_loading').show();
    }
    function hidloading(){
        $('#js_mycmt_loading').hide();
    }
    function shwloading1(){
        $('#js_cmt_loading').show();
    }
    function hidloading1(){
        $('#js_cmt_loading').hide();
    }
    function isbottom() {
        var scrollTop = 0;
        var clientHeight = 0;
        var scrollHeight = 0;
        if (document.documentElement && document.documentElement.scrollTop) {
            scrollTop = document.documentElement.scrollTop;
        } else if (document.body) {
            scrollTop = document.body.scrollTop;
        }
        if (document.body.clientHeight && document.documentElement.clientHeight) {
            clientHeight = (document.body.clientHeight < document.documentElement.clientHeight) ? document.body.clientHeight: document.documentElement.clientHeight;
        } else {
            clientHeight = (document.body.clientHeight > document.documentElement.clientHeight) ? document.body.clientHeight: document.documentElement.clientHeight;
        }
        scrollHeight = Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
        if (scrollTop + clientHeight == scrollHeight) {
            return true;
        } else {
            return false;
        }
    }

    var comment_page = 2;
    var dataloading = 0;
    var realpage = $realpage;
    function loadmycomment(){
        if(dataloading){
            return;
        }
        dataloading = 1;
        if(comment_page>realpage){
            return;
        }

        var url = '';
        var ifall = $('#discuss_container_inner').hasClass('hide');
        if(ifall){
            shwloading1();
            url = 'forum.php?mod=viewthread&tid=' + {$_G[tid]} + '&weban=1&mobile=2&viewpostlist=1&page='+comment_page;
        }else{
            shwloading();
            url = 'forum.php?mod=viewthread&tid=' + {$_G[tid]} + '&weban=1&authorid=' + {$_G[uid]} + '&ordertype=1&mobile=2&page='+comment_page;
        }

        $.ajax({
                type: 'POST',
                url: url,
                dataType: 'xml'
            })
            .success(function (s) {
                if(ifall){
                    $('#js_cmt_list').append(s.lastChild.firstChild.nodeValue);
                    hidloading1();
                }else{
                    $('#js_cmt_mylist').append(s.lastChild.firstChild.nodeValue);
                    hidloading();
                }
                comment_page++;
                dataloading = 0;
            })
            .error(function () {
                window.location.href = window.location.href;
                popup.close();
                hidloading();
                hidloading1();
            });
    }
    function delcomment(cmtid){
        var form = $('#comment_form_'+cmtid);
        if(!confirm('{lang xigua_weban:que}')){
            return false;
        }
        $.ajax({
                type: 'POST',
                url: form.attr('action') + '&inajax=1',
                data: form.serialize(),
                dataType: 'xml'
            })
            .success(function (s) {
//                evalscript(s.lastChild.firstChild.nodeValue);
                $('#comment1_'+cmtid).remove();
            })
            .error(function () {
                window.location.href = window.location.href;
                popup.close();
            });
        return false;
    }

    function dialogdel(pid){
        if(!confirm('{lang xigua_weban:que}')){
            return false;
        }
        var form = $('#topicadminform'+pid);
        $.ajax({
                type: 'POST',
                url: form.attr('action') + '&inajax=1',
                data: form.serialize(),
                dataType: 'xml'
            })
            .success(function (s) {
//                evalscript(s.lastChild.firstChild.nodeValue);
                $('#topic'+pid).remove();
            })
            .error(function () {
                window.location.href = window.location.href;
                popup.close();
            });
        return false;
    }
    var commentgetpage = [];
    function commentget(tid, pid){
        if(!commentgetpage[pid]){
            commentgetpage[pid] =2;
        }

        $.ajax({
                type: 'GET',
                url: 'forum.php?mod=misc&action=commentmore&weban=1&tid='+tid+'&pid='+pid+'&page='+commentgetpage[pid]+'&inajax=1&mobile=2',
                dataType: 'xml'
            })
            .success(function (s) {
                if(!s.lastChild.firstChild.nodeValue){
                    $('#comment_more_'+pid).hide();
                }else{
                    $(s.lastChild.firstChild.nodeValue).insertBefore($('#comment_more_'+pid));
                    commentgetpage[pid]++;
                }
            })
            .error(function () {
                window.location.href = window.location.href;
                popup.close();
            });
        return false;
    }
    function showcmtreply(pid){
        var main = $('#comment');
        var url = 'forum.php?mod=post&action=reply&comment=yes&tid=$_G[tid]&pid='+pid+'&extra={$_GET[extra]}&page=1&commentsubmit=yes&infloat=yes&mobile=2&inajax=1';
        var nickname = $('#nickname_'+pid).text();
        var message_ = $('#message_'+pid).text();
        var form =main.find('form');
        form.attr('action', url);
        form.attr('pid', pid);
        main.find('.rich_media_title').text('{$lang[follow_quickreply]}'+nickname+':'+message_);

        window.location.hash = '';
        window.location.hash='#comment';
        changehash();

        return false;
    }
    function docmtreply(){
        var main = $('#comment');
        var form =main.find('form');
        if(form.find('.frm_textarea').val()==''){
            form.find('.frm_textarea').focus();
            return false;
        }
        if($('#replysubmit').hasClass('btn_disabled')){
            return false;
        }
        $.ajax({
                type: 'POST',
                url: form.attr('action') + '&inajax=1',
                data: form.serialize(),
                dataType: 'xml'
            })
            .success(function (s) {
                evalscript(s.lastChild.firstChild.nodeValue);
                $('#replysubmit').addClass('btn_disabled');
                $('#replysubmitsuccess').show();
                setTimeout(function(){
                    window.location.href = window.location.href;
                }, 1000);

            })
            .error(function () {
                window.location.href = window.location.href;
                popup.close();
            });
        return false;
    }

    var POPMENU = new Object;
    var popup = {
        init : function() {
            var _this = this;
            $('.popup').each(function(index, obj) {
                obj = $(obj);
                var pop = $(obj.attr('href'));
                if(pop && pop.attr('popup')) {
                    pop.css({'display':'none'});
                    obj.on('click', function(e) {
                        _this.open(pop);
                    });
                }
            });
            this.maskinit();
        },
        maskinit : function() {
            var _this = this;
            $('#mask').off().on('tap', function() {
                _this.close();
            });
        },

        open : function(pop, type, url) {
            this.close();
            this.maskinit();
            if(typeof pop == 'string') {
                $('#ntcmsg').remove();
                if(type == 'alert') {
                    pop = '<div class="inner"><dt class="tips_title">'+ pop +'</dt><dd class="tips_opr"><a class="ft_btn" onclick="popup.close();">{lang xigua_weban:queding}</a></dd></div>'
                } else if(type == 'confirm') {
                    pop = '<div class="inner"><dt class="tips_title">'+ pop +'</dt><dd class="tips_opr"><a class="ft_btn" href="'+ url +'">{lang xigua_weban:queding}</a><a class="ft_btn" href="javascript:;" onclick="popup.close();">{lang xigua_weban:quxiao}</a></dd></div>'
                }
                $('body').append('<div id="ntcmsg" style="display:none;">'+ pop +'</div>');
                pop = $('#ntcmsg');
            }
            if(POPMENU[pop.attr('id')]) {
                $('#' + pop.attr('id') + '_popmenu').html(pop.html()).css({'height':pop.height()+'px', 'width':pop.width()+'px'});
            } else {
                pop.parent().append('<div class="dialogbox" id="'+ pop.attr('id') +'_popmenu" style="height:'+ pop.height() +'px;width:'+ pop.width() +'px;">'+ pop.html() +'</div>');
            }
            var popupobj = $('#' + pop.attr('id') + '_popmenu');
            popupobj.addClass('pop_tips');
            var left = (window.innerWidth - popupobj.width()) / 2;
            var top = (document.documentElement.clientHeight - popupobj.height()) / 2;
            popupobj.css({'display':'block','position':'fixed','left':left,'top':top,'z-index':120,'opacity':1});
            $('#mask').css({'display':'block','width':'100%','height':'100%','position':'fixed','top':'0','left':'0','background':'black','opacity':'0.2','z-index':'100'});
            POPMENU[pop.attr('id')] = pop;
        },
        close : function() {
            $('#mask').css('display', 'none');
            $.each(POPMENU, function(index, obj) {
                $('#' + index + '_popmenu').css('display','none');
            });
        }
    };
</script>

{$sharehtml}
</body>
</html>