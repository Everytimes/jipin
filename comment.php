<?php
define('IN_HHS', true);

require(dirname(__FILE__) . '/includes/init.php');

$user_id = $_SESSION['user_id'];
if (empty($user_id)) {
    exit();
}

$act = trim($_GET['act']);
if ($act == 'create') {
    $content      = trim($_POST['comment']);
    $comment_rank = intval($_POST['stars']);
    $id_value     = intval($_POST['id_value']);
    $add_time     = time();
    $ip_address   = real_ip();
    $order_id     = intval($_POST['order_id']);
    $user_name    = $_SESSION['user_name'];
    
    $sql = "insert into ".$hhs->table('comment')." (`user_name`,`user_id`,`content`,`comment_rank`,`id_value`,`add_time`,`ip_address`) values ('$user_name','$user_id','$content','$comment_rank','$id_value','$add_time','$ip_address')";
    $db->query($sql);
    $id = $db->insert_id();
    if ($id) {
    	$db->query('update '.$hhs->table('order_info').' set `is_comm` = 1 where `order_id` = "'.$order_id.'"');
    	$res = array(
    		'isError' => 0
    	);
    }
    else{
    	$res = array(
    		'isError' => 1,
    		'message' => '评论失败，请重试！'
    	);
    }
    echo json_encode($res);
    exit();
}

?>
