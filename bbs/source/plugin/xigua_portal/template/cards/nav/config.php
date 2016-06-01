<?php !defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:43
 */
return array(
    'modulename' => xigua_cards::l('nav',0),
    'introduce'  => xigua_cards::l('nav_in',0),
    'icon'       => 'source/plugin/xigua_portal/template/cards/nav/images/nav.png',
    'preview'    => '',
    'version'    => '1.0.0',
    'lock'       => 0,
    'open'       => 1,
    'tpl'        => '{html}',
    'js'         => '',
    'css'        => <<<CSS
.main-nav {border-bottom:1px solid #ececec;padding:10px 10px 0}
.main-nav-list{display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-o-box;display:box;-webkit-box-pack:justify;-moz-box-pack:justify;-ms-flex-pack:justify;-o-box-pack:justify;box-pack:justify;margin-bottom:10px}
.main-nav-list a{display:block;height:20px;font-size:16px;line-height:20px;text-align:center;white-space:nowrap;color:#444}
.main-nav h3{font-size:20px;padding-bottom:10px}
CSS

);