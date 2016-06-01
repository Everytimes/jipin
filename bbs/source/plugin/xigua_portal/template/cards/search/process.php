<?php
!defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:02
 */

function process_search($card)
{
    global $_G;
    $charset = CHARSET;
    if($height = intval($card['var']['height'])){
        $h = 'style="height:'.$height.'px"';
        $th = 'style="height:'.($height-10).'px;line-height:'.($height-10).'px"';
    }

    $radius = intval($card['var']['radius']);
    if($radius){
        $v[] = "border-radius:0 {$radius}px {$radius}px 0;";
        $t[] = "border-radius:{$radius}px 0 0 {$radius}px;";
    }

    if($sbtncolor = $card['var']['sbtncolor']){
        $v[] = "background:$sbtncolor;";
    }
    if($sboxcolor = $card['var']['sboxcolor']){
        $t[] = "background:$sboxcolor;";
    }

    $t = 'style="'.implode('', $t) .'""';
    $v = 'style="'.implode('', $v) .'""';

    if($_G['cache']['plugin']['xigua_search']){
        $header = <<<H
<form $h class="s" action="plugin.php" method="get" accept-charset="$charset"><input type="hidden" value="xigua_search:index" name="id"><input type="hidden" value="true" name="searchsubmit">
H;
    }else{
        $header = <<<H
<form $h class="s" method="post" autocomplete="off" accept-charset="UTF-8" action="search.php?mod=forum&mobile=2"><input type="hidden" value="yes" name="searchsubmit">
H;

    }
    $yutian = $card['var']['yutian'];

    $card['var']['html'] = <<<HTML
$header <input type="hidden" value="true" name="searchsubmit"> <input type="hidden" value="mh" name="source"><input type="hidden" value="" name="formhash"><div class="w">
    <div $t class="t"><input $th type="search" autocomplete="off" autocorrect="off" maxlength="64" name="srchtxt" class="u" placeholder="$yutian"></div><button type="submit" class="v" $v><i class="o"></i></button></div></form>
HTML;

    return $card;
}