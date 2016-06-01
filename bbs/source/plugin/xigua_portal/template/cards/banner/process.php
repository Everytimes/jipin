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
function process_banner($card)
{
    $card['var']['close'] = $card['var']['close'] ? '<a class="close">X</a>' : '';
    $card['var']['cookiexpire'] = intval($card['var']['cookiexpire']);
    $card['var']['id'] = $card['id'];

    return $card;
}