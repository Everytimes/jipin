<?php

if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
class plugin_ezhilu_postnotice {

    public function plugin_ezhilu_postnotice() {}
	
    public function post_message($params) {
	global $_G , $tid , $returnurl , $subject;
	$var=$_G['cache']['plugin']['ezhilu_postnotice'];		
	//�Ƿ����ʹ�ò�� ������ڿ���ʹ�õİ�鷶Χ ֱ�ӷ��ؿ�
	if(!in_array($_G[fid],unserialize($var['use_forums']))){
	 		return ;
	 	}
	if(!$params) return;  
	    $param = $params['param'];
	    if($param[0] == 'post_newthread_succeed') {
		 
		    $thread = array('tid' => $tid , 'url' => $returnurl , 'subject' => $subject ,
                					'author' => $_G['username'],
							'authorid' => $_G['uid'],
						    'dateline' => dgmdate($_G['timestamp']),
							'forumname' => $_G['forum']['name'],
							'fid' => $_G['fid'],			
							);
		
			 //����Ϣ���͸�����
		 	$moderator = DB::fetch_all("SELECT uid FROM %t WHERE fid =%d ",array('forum_moderator',$_G['fid']));
			if(!empty($moderator)){
				foreach($moderator as $value){
				    $value['uid'];
				notification_add($value['uid'], 'system', lang('plugin/ezhilu_postnotice', 'note_message'), $thread, 1);
				}
		   }			
		}
	}
}

class plugin_ezhilu_postnotice_forum extends plugin_ezhilu_postnotice {}
?>