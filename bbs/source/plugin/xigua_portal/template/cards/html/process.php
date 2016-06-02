<?php
!defined('IN_DISCUZ') && exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: yangzhiguo
 * Date: 15/3/15
 * Time: 11:02
 */

/**
 * @param $card
 *
 * @return mixed
 */
function process_html($card)
{
    $card['var']['html'] = htmlspecialchars_decode($card['var']['adcode']);
    return $card;
}