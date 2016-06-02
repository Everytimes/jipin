<?php !defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:43
 */
return array(
    'modulename' => xigua_cards::l('top_', 0),
    'introduce'  => xigua_cards::l('top_in', 0),
    'icon'       => 'source/plugin/xigua_portal/template/cards/top/images/news.png',
    'preview'    => '',
    'version'    => '1.0.0',
    'lock'       => 0,
    'open'       => 1,
    'js'         => '',
    'src'        => '',
    'tpl'        => '{html}',
    'css'        => <<<CSS
.topline_p{text-align:center;padding:0 10px 10px 10px}
.topline_p_h2{font-size:18px;padding:8px 0 4px}
.topline_p_h2 em{border-radius:1px;color:white;background:#de6761;font-size:12px;margin-right:2px;text-align:center;vertical-align:1px;white-space:nowrap}
.topline_p_mate{font-size:14px;padding-bottom:2px}
.topline_p_h2,.topline_p_mate{white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block}
CSS

);