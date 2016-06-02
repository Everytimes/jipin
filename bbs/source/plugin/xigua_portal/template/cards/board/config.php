<?php !defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:43
 */
return array(
    'modulename' => xigua_cards::l('board', 0),
    'introduce'  => xigua_cards::l('board_in', 0),
    'icon'       => 'source/plugin/xigua_portal/template/cards/board/images/1.png',
    'preview'    => '',
    'version'    => '1.0.0',
    'lock'       => 0,
    'open'       => 1,
    'js'         => <<<JS
JS
,
    'src'        => '',
    'tpl'        => <<<HTML
<div class="news-box">{html}</div>
HTML
,
    'css'        => <<<CSS
.tmore a{height:41px;position:relative;display:inline-block;margin-right:12px;font-size:18px;color:#2B73DF}
.news-t{background:#fff;width:100%;height:45px;line-height:45px;border-bottom:1px solid #EBEAEA;border-top:2px solid #2B73DF;display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-o-box;display:box}.news-t h3{font-weight:700;font-size:23px;margin-left:12px;overflow:hidden}.news-t h3 a{color:#2B73DF}.tmore{overflow:hidden;-webkit-box-flex:1;-moz-box-flex:1;-ms-box-flex:1;box-flex:1;text-align:right}.b-l {padding-top:20px}.b-l li {text-align:center;display:block;  width: 25%;float:left}.b-l img {display:block;height:50px;width:50px;margin:0 auto;border-radius:.2rem}
.b-l .b-tit {font-size:13px;line-height: 22px;height: 22px;overflow: hidden;display:block;  -webkit-box-flex: 1;-moz-box-flex: 1;-ms-box-flex: 1;box-flex:1}
CSS
);