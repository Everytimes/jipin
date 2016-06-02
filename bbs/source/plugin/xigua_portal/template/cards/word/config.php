<?php !defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:43
 */
return array(
    'modulename' => xigua_cards::l('word', 0),
    'introduce'  => xigua_cards::l('word_in', 0),
    'icon'       => 'source/plugin/xigua_portal/template/cards/word/images/news.png',
    'preview'    => '',
    'version'    => '1.0.0',
    'lock'       => 0,
    'open'       => 1,
    'js'         => '',
    'src'        => '',
    'tpl'        => '<div class="word-main">{html}</div>',
    'css'        => <<<CSS
.word-main{padding: 10px 10px 0}
.word-main{font-size: 20px;padding-bottom: 10px}
.word-main li{height:32px;line-height: 32px;display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-o-box;display:box}
.word-main li a{display:block;-webkit-box-flex:1;-moz-box-flex:1;-ms-box-flex:1;box-flex:1;text-align:left;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;font-size:16px}
CSS

);