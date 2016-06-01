<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php 34718 2014-07-14 08:56:39Z nemohou $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class xigua_share {

    public function __construct()
    {
        loadcache('plugin');
        global $_G;
        $this->v = $_G['cache']['plugin']['xigua_share'];
        $this->v['btn2'] = unserialize($this->v['btn2']);
        $this->v['pos'] = intval($this->v['pos']);
        $this->styles = $this->v['styles'] ? strval($this->v['styles']) : '';
        $this->down = $this->v['down'];
        $this->size = $this->v['size'];
        $this->center = $this->v['center'];
        $this->float = $this->v['float'];
        $this->cancel_color = $this->v['cancel_color'];
        $this->cancel_bg = $this->v['cancel_bg'];
        $this->float_pos = $this->v['float_pos'];
        $this->float_opacity = $this->v['float_opacity'];
        $this->guideword = $this->v['guideword'];
        $this->gzname = $this->v['gzname'];
    }

    public function forumdisplay_mobilesign()
    {
        $retval = array();
        if($this->v['toplink'] && $this->v['topfont']){
            $retval = array(
                'link' => $this->v['toplink'],
                'text' => $this->v['topfont']
            );
        }
        return $retval;
    }

    public function viewthread_threadTop()
    {
        if($this->v['pos'] == 1){
            return $this->get_share($this->size);
        }
    }

    function viewthread_threadBottom()
    {
        if($this->v['pos'] == 2)
        {
            return $this->get_share($this->size);
        }
    }

    public function get_share($simple = 0)
    {
        global $_G;
        $retval = '';
        $style = $this->styles;

        $h = '35';
        $f0 = $f1 = $f2 =$f3 =$f4 =$f5 =$f6 = '';
        if($this->v['btn2_font']){
            $h = '50';
            $f0 = "<span style='line-height:86px;color:#999;font-size:12px'>". $this->_xs('l0') ."</span>";
            $f1 = "<span style='line-height:86px;color:#999;font-size:12px'>". $this->_xs('l1') ."</span>";
            $f2 = "<span style='line-height:86px;color:#999;font-size:12px'>". $this->_xs('l2') ."</span>";
            $f3 = "<span style='line-height:86px;color:#999;font-size:12px'>". $this->_xs('l3') ."</span>";
            $f4 = "<span style='line-height:86px;color:#999;font-size:12px'>". $this->_xs('l4') ."</span>";
            $f5 = "<span style='line-height:86px;color:#999;font-size:12px'>". $this->_xs('l5') ."</span>";
            $f6 = "<span style='line-height:86px;color:#999;font-size:12px'>". $this->_xs('l6') ."</span>";
        }
        $cancel = $this->_xs('cancel');

        $common_style = "float:left;width:35px;height:{$h}px;margin:0 4px;text-decoration:none;
background: url($_G[siteurl]source/plugin/xigua_share/images/share-icon$style.png) no-repeat;background-size:auto 35px;";
        $fst = 'margin-right:0;';
        $c0 = 'background-position:-35px 0;';  //wechat
        $c1 = 'background-position:-70px 0;';  //weibo
        $c2 = 'background-position:0 0;';  //qq
        $c3 = 'background-position:-210px 0;';  //qzone
        $c4 = 'background-position:-175px 0;';
        $c5 = 'background-position:-105px 0;';
        $c6 = 'background-position:-140px 0;';//dou


        foreach($GLOBALS['postlist'] as $pid => $post)
        {
            if($post['first'] == 1)
            {
                foreach ($post['attachments'] as $attach) {
                    if($attach['isimage']){
                        $pic = $attach['thumb'] ? getimgthumbname($attach['attachment']) : $attach['attachment'];
                        $preurl = !in_array(strtolower(substr($pic, 0, 6)), array('http:/', 'https:', 'ftp://')) ? $_G['siteurl'] : '';
                        $pic = $preurl . $attach['url'] . $pic;
                        break;
                    }
                }
                if(!$pic && strpos($post['message'], 'class="img"')!== false){
                    preg_match('/(<img([^>]*)src=(\"|\'))(.+?)((\"|\').*?\>)/ise', $post['message'], $m__);
                    if($pic = $m__[4]){
                        if (!in_array(strtolower(substr($pic, 0, 6)), array('http:/', 'https:', 'ftp://'))) {
                            $pic = $_G['siteurl'] . $pic;
                        }
                    }
                }

                $subject = urlencode(dhtmlspecialchars(iconv(CHARSET, 'UTF-8', $post['subject'])));
                $url     = urlencode($this->get_url($post['tid']));

                $post['message'] = preg_replace("/\[attach\](\d+)\[\/attach\]/i", '', cutstr(strip_tags($post['message']), 300));
                $message = urlencode(iconv(CHARSET, 'UTF-8', dhtmlspecialchars(cutstr($post['message'], 120))));

                $weibo  = "http://service.weibo.com/share/share.php?url=$url&appkey=&title=$subject&pic=&language=zh_cn&pic=$pic";
                $qq     = "http://connect.qq.com/widget/shareqq/index.html?url=$url&desc=$message&summary=&title=$subject&site=&pics=$pic";
                $renren = "http://widget.renren.com/dialog/share?resourceUrl=$url&title=$subject&description=$message&pic=$pic";
                $qzone  = "http://openmobile.qq.com/api/check2?page=qzshare.html&loginpage=loginindex.html&logintype=qzone&url=$url&summary=$subject&desc=$message&title=$subject&imageUrl=$pic&successUrl=&failUrl=&callbackUrl=&sid=";
                $qweibo = "http://share.v.t.qq.com/index.php?c=share&a=index&url=$url&title=$subject&pic=$pic";
                $douban = "http://www.douban.com/share/service?href=$url&name=$subject&pic=$pic";

                $btn2 = $this->v['btn2'];
                if($simple){
                    $width = count($btn2)*30;
                }else{
                    $width = count($btn2)*43;
                }
                $btn_style = $this->center ? "style='width:${width}px;margin: 0 auto;display:block;text-align:center'":"style='width:100%;margin: 0 auto;display:block;text-align:center'";
                $guider = "$_G[siteurl]source/plugin/xigua_share/images/guider.png";
                $guider2 = "$_G[siteurl]source/plugin/xigua_share/images/guide_weixin.png";

                if($simple){
                    $common_style = "float:left;width:25px;height:25px;margin-right:5px;text-decoration:none;background:url($_G[siteurl]source/plugin/xigua_share/images/share-icon$style.png) no-repeat;background-size:auto 25px;";
                    $c0 = 'background-position:-25px 0;';  //wechat
                    $c1 = 'background-position:-50px 0;';  //weibo
                    $c2 = 'background-position:0 0;';  //qq
                    $c3 = 'background-position:-150px 0;';  //qzone
                    $c4 = 'background-position:-125px 0;';
                    $c5 = 'background-position:-75px 0;';
                    $c6 = 'background-position:-100px 0;';//dou

                    if($this->down){
                        $ctrl = 'position:absolute;bottom:0';
                    }
                    $retval = "
<div style='clear:both;margin:10px 0;height:25px;$ctrl'>
<dl style='display:block;color:#999'>
    <dd style='text-align:center;width:100%;display:block'>".
($this->v['btn2_before'] ? '<a style="float:left;color:#999;font-size:12px;height:25px;line-height:25px;margin-right:5px;">'.$this->v['btn2_before'].'</a>' : '').
(in_array(1, $btn2) ? "<a click='show_wechat' style=\"{$common_style}{$c0}\"></a>" : '').
(in_array(2, $btn2) ? "<a target='_blank' href='$weibo'  style=\"{$common_style}{$c1}\"></a>" : '').
(in_array(3, $btn2) ? "<a target='_blank' href='$qq'     style=\"{$common_style}{$c2}\"></a>" : '').
(in_array(4, $btn2) ? "<a target='_blank' href='$qzone'  style=\"{$common_style}{$c3}\"></a>" : '').
(in_array(5, $btn2) ? "<a target='_blank' href='$qweibo' style=\"{$common_style}{$c4}\"></a>" : '').
(in_array(6, $btn2) ? "<a target='_blank' href='$renren' style=\"{$common_style}{$c5}\"></a>" : '').
(in_array(7, $btn2) ? "<a target='_blank' href='$douban' style=\"{$common_style}{$c6}{$fst}\"></a>" : '').
                        "<div style='clear:both'></div>".
                        "</dd>
</dl>
<a click='hide_wechat' id='xg_cover' style='position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5) url(\"$guider\") no-repeat top right;background-size:auto 90px;display:none;z-index:999999'>
</a><div style=\"clear:both\"></div>
</div>";
                }else{
                    $bwidth = $width-4;
                    $btn2_before = $this->center ? "style='width:{$bwidth}px;margin:0 auto;padding-left:4px;display:block;'" : 'style="width:100%;padding-left:4px;display:block;"';
                    $retval = "
<div style='clear:both;margin:10px 0;'>
<dl style='display:block;color:#999'>".
($this->v['btn2_before'] ? "<dt $btn2_before>".$this->v['btn2_before']."</dt>" : '')
."<dd $btn_style>".
(in_array(1, $btn2) ? "<a click='show_wechat' style=\"{$common_style}{$c0}\">$f0</a>" : '').
(in_array(2, $btn2) ? "<a target='_blank' href='$weibo'  style=\"{$common_style}{$c1}\">$f1</a>" : '').
(in_array(3, $btn2) ? "<a target='_blank' href='$qq'     style=\"{$common_style}{$c2}\">$f2</a>" : '').
(in_array(4, $btn2) ? "<a target='_blank' href='$qzone'  style=\"{$common_style}{$c3}\">$f3</a>" : '').
(in_array(5, $btn2) ? "<a target='_blank' href='$qweibo' style=\"{$common_style}{$c4}\">$f4</a>" : '').
(in_array(6, $btn2) ? "<a target='_blank' href='$renren' style=\"{$common_style}{$c5}\">$f5</a>" : '').
(in_array(7, $btn2) ? "<a target='_blank' href='$douban' style=\"{$common_style}{$c6}{$fst}\">$f6</a>" : '').
"<div style='clear:both'></div></dd></dl>
<a click='hide_wechat' id='xg_cover' style='position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7) url(\"$guider\") no-repeat top right;background-size:auto 90px;display:none;z-index:999999;'>
</a>
<div style='clear:both'></div></div>";
                }

                if($this->float == 1){
                    if($simple){
                        $f0 = $f1 = $f2 =$f3 =$f4 =$f5 =$f6 = '';
                    }
                    $guidertop = $this->get_guider();

                    $tool = "$_G[siteurl]source/plugin/xigua_share/images/tool.png";
                    $share_title = $this->v['btn2_before'];
                    $share_btn =
(in_array(1, $btn2) ? "<a click='show_wechat' style=\"{$common_style}{$c0}\">$f0</a>" : '').
(in_array(2, $btn2) ? "<a target='_blank' href='$weibo'  style=\"{$common_style}{$c1}\">$f1</a>" : '').
(in_array(3, $btn2) ? "<a target='_blank' href='$qq'     style=\"{$common_style}{$c2}\">$f2</a>" : '').
(in_array(4, $btn2) ? "<a target='_blank' href='$qzone'  style=\"{$common_style}{$c3}\">$f3</a>" : '').
(in_array(5, $btn2) ? "<a target='_blank' href='$qweibo' style=\"{$common_style}{$c4}\">$f4</a>" : '').
(in_array(6, $btn2) ? "<a target='_blank' href='$renren' style=\"{$common_style}{$c5}\">$f5</a>" : '').
(in_array(7, $btn2) ? "<a target='_blank' href='$douban' style=\"{$common_style}{$c6}{$fst}\">$f6</a>" : '');
                    $cclor = $this->cancel_color ? $this->cancel_color : '#3e9ac0';
                    $cbg = $this->cancel_bg ? $this->cancel_bg : '#ECECEC';

                    $float_pos = $this->float_pos ? trim($this->float_pos) : 'right:10px;bottom:90px;';
                    $float_opacity = intval($this->float_opacity) / 100;
                    $retval =
"$guidertop<div style='position: fixed;z-index:999;width:49px;height:136px;overflow:hidden;opacity:$float_opacity;$float_pos;'>
    <div style='position:absolute;left: 0;bottom:0;width:49px;height:136px;background-image: url($tool);background-size:cover;'>
    <a style='display:block;height:46px;opacity:0' class='replyBtn'></a>
    <a style='display:block;height:44px' click='show_xgbox1()'></a>
    <a style='display:block;height:46px' href='#frombar'></a>
    </div>
</div>
<div id=\"xg_box1\" style=\"position: fixed;z-index:19999;left: 0;top: 0;right: 0;bottom: 0;background-color:rgba(0,0,0,.5);display: none;\">
    <div style='width:310px;position:fixed;height:140px;left:50%;top:50%;margin:-68px 0 0 -155px;border-radius:5px;background-color:#F5F5F5;'>
        <div style='height: 34px;line-height: 34px;font-size: 14px;padding-left: 20px;color:#666;'>$share_title</div>
        <div $btn_style>
            $share_btn
            <div style='clear:both'></div>
        </div>
        <a style='height:35px;line-height:35px;width:280px;margin:10px auto 0 auto;background-color:$cbg;border-radius:3px;font-size:14px;color:$cclor;text-align:center;display:block' click='hide_xgbox1()'>$cancel</a>
    </div>
    <a click='hide_wechat' id='xg_cover' style='position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7) url(\"$guider\") no-repeat top right;background-size:auto 90px;display:none;z-index:999999;'></a>
</div>";
                } else if ($this->float == 2) {
                    $qpos = $this->float_pos ? trim($this->float_pos) : 'right:10px;bottom:90px;';
                    $float_opacity = intval($this->float_opacity) / 100;
                    $cbg = $this->cancel_bg ? $this->cancel_bg : '#5a85ce';
                    $cclor = $this->cancel_color ? $this->cancel_color : '#fff';

                    $sty_up = "display:block;width:40px;height:40px;position:fixed;z-index:99;background:url($_G[siteurl]source/plugin/xigua_share/images/up.png) no-repeat 0 0;background-size:40px 40px;opacity:$float_opacity;$qpos";
                    $sty_bk = "display:inline-block;background: url($_G[siteurl]source/plugin/xigua_share/images/bk.png) no-repeat 5px center;background-size: 18px 18px;color: #FFF;height: 40px;line-height: 40px;padding: 0 5px 0 28px;border-radius: 5px;font-size: 14px;width:auto;position:relative;top:auto;left:auto;border:0";
                    $sty_cr = "display:block;background:rgba(42,49,56,1);position:fixed;bottom:0;left:0;width:100%;z-index:9998;height:51px";
                    $sty_in1 = "display:inline-block;float: left;overflow: hidden;margin:6px 0 8px 10px;";
                    $sty_rep = "display:inline-block;width:auto;background: url($_G[siteurl]source/plugin/xigua_share/images/icon-addhd.png) no-repeat 5px center;background-size: 18px 18px;color: #FFF;height: 40px;line-height: 40px;padding: 0 5px 0 28px;border-radius: 5px;font-size: 14px;";
                    $sty_mor = "padding: 0 10px;float: right;height: 50px;line-height:48px;color: #fff";
                    $sty_in2 = "font-size: 15px;display: inline-block;margin:6px 15px 0 0;width:35%;height: 40px;float: right;position: relative;";
                    $sty_shr = "background-color:$cbg;color:#FFF;text-align:center;font-size: 15px;position: absolute;display: block;width: 100%;border-radius:3px;line-height: 40px;";
                    $sty_gui = "position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6) url($guider2) no-repeat top right;background-size:auto 155px;display:none;z-index:999999;";

                    $lang_back  = $this->_xs('back');
                    $lang_reply = $this->_xs('reply');
                    $lang_dot   = $this->_xs('dot');
                    $lang_share = $this->_xs('share');

                    $guideword = $this->get_guider();

                    $retval = <<<HTML
$guideword<a style="$sty_up" href="#frombar"></a>
<div style="$sty_cr">
   <div style="$sty_in1">
     <a style="$sty_bk" class="backBtn" href="javascript:;">$lang_back</a>
     <a style="$sty_rep" class='replyBtn'>$lang_reply</a>
   </div>
    <a style="$sty_mor" href="javascript:;" id="info_center" class="moreC db">
        <i class="circle">$lang_dot</i><i class="circle">$lang_dot</i><i class="circle">$lang_dot</i>
    </a>
   <div style="$sty_in2">
        <a style="$sty_shr" click='show_wechat()'>$lang_share</a>
    </div>
 </div>
<a style="$sty_gui" click='hide_wechat' id='xg_cover'></a>
HTML;

                }
            }
            break;
        }
        return $retval;
    }

    function get_guider(){
        global $_G;
        $float_opacity = intval($this->float_opacity) / 100;
        $cbg = $this->cancel_bg ? $this->cancel_bg : '#5a85ce';
        $cclor = $this->cancel_color ? $this->cancel_color : '#fff';

        $gsty_guw = "position: fixed;right: 10px;top:10px;font-size:16px;padding:5px 10px;color:#FFF;background-color: #444444;border-radius:3px;outline: none;z-index: 101;opacity:$float_opacity;";
        $gsty_box = "position: fixed;z-index:19999;left: 0;top: 0;right: 0;bottom: 0;background-color:rgba(0,0,0,.5);display: none;";
        $gsty_in1 = "width:310px;position:fixed;height:320px;left:50%;top:50%;margin:-190px 0 0 -155px;border-radius:5px;background-color:#F5F5F5;";
        $gsty_a1 = "display: block;width: 60px;height: 60px;background: url($_G[siteurl]source/plugin/xigua_share/images/yes.png) no-repeat;background-size: 60px 60px;margin: 0 auto;";
        $gsty_cp = "overflow: hidden;text-align: center;margin-top: 20px";
        $gsty_yi = "font-size: 15px;text-align: center;color: #666;padding-bottom: 15px;";
        $gsty_cpts = "font-size: 15px;text-align: center;line-height: 20px;color:#666;padding:15px 0 0";
        $gsty_dik  = "width:100%;border-top:1px solid #ddd";
        $gsty_tc   = "padding: 15px 20px;text-align: left;line-height: 20px;font-size: 13px;color: #999;";
        $gsty_btn  = "height:35px;line-height:35px;width:280px;margin:0 auto;background-color:$cbg;border-radius:3px;font-size:14px;color:$cclor;text-align:center;display:block";

        $lang_gzh = $this->_xs('gzhao');
        $lang_cpts = $this->_xs('copyts');
        $lang_know = $this->_xs('know');

        if($this->gzname && strpos($this->gzname, 'http://') === 0){
            $guideword = <<<GUIDE
<a style="$gsty_guw" target="_blank" href="$this->gzname">$this->guideword</a>
GUIDE;
        }elseif($this->gzname){
            $lang_tc   = sprintf($this->_xs('gzdesc'), $this->gzname);
            $guideword = <<<GUIDE
<a style="$gsty_guw" click="show_xgbox()">$this->guideword</a>
<div style="$gsty_box" id="xg_box">
    <div style="$gsty_in1">
        <div style="$gsty_cp"><a style="$gsty_a1" href="javascript:void(0);"></a></div>
        <p style="$gsty_cpts">$lang_cpts</p>
        <p style="$gsty_yi">$lang_gzh<span style="color:#333">$this->gzname</span></p>
        <div style="$gsty_dik"><p style="$gsty_tc">$lang_tc</p></div>
        <a style="$gsty_btn" click='hide_xgbox()'>$lang_know</a>
    </div>
</div>
GUIDE;
        }else{
            $guideword = '';
        }
        return $guideword;
    }

    function get_url($tid){
        $param = array_merge(array(
            'c' => 'index',
            'a' => 'viewthread',
            'f' => 'wx',
            'siteid' => $_GET['siteid']
        ), array('tid' => $tid));
        $url = 'http://wsq.discuz.qq.com/?' . http_build_query($param);
        return trim($url);
    }

    function _xs($lang)
    {
        return lang('plugin/xigua_share', $lang);
    }

    function viewthread_variables(&$variables) {

        if(!$variables['function']){
            $variables['function'] = array();
        }

        $variables['function'] = array_merge(
            array(
                'show_wechat' => array('WSQ.show', array('xg_cover')),
                'hide_wechat' => array('WSQ.hide', array('xg_cover')),
                'show_xgbox' => array('WSQ.show', array('xg_box')),
                'hide_xgbox' => array('WSQ.hide', array('xg_box')),
                'show_xgbox1' => array('WSQ.show', array('xg_box1')),
                'hide_xgbox1' => array('WSQ.hide', array('xg_box1')),
            ) , $variables['function']);

    }
}