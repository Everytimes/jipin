<?php !defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:43
 */
return array(
    'modulename' => lang('core', 'search'),
    'introduce'  => lang('core', 'search'),
    'icon'       => 'source/plugin/xigua_portal/template/cards/search/images/1.png',
    'preview'    => '',
    'version'    => '1.0.0',
    'lock'       => 0,
    'open'       => 1,
    'js'         => "$('input[name=formhash]').val(FORMHASH);",
    'src'        => '',
    'tpl'        =>  '{html}',
    'css'        => <<<CSS
 .s{padding:10px;position:relative;height:40px} .w{width:100%;height:100%;border-radius:2px;overflow:hidden;display:-webkit-box} .t{-webkit-box-flex:1;overflow:hidden;position:relative;-webkit-appearance:none;background:#efefef} .u{background:transparent;display:block;height:30px;line-height:30px;margin:5px 0 5px 10px;width:90%;font-size:15px} .search input{border:0;outline:0} .v{display:block;width:69px;height:100%;background:#0497f4;border:0;font-size:16px;position:relative} .o{background: url(source/plugin/xigua_portal/template/cards/search/images/search.png) no-repeat center center;background-size:cover;display:inline-block;height:20px;width:20px;vertical-align:text-top}
CSS

);