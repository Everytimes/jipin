<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_huoyuedu {
	public function viewthread_bottom (){
		global $_G;
		$now = time();
		$today0 = strtotime(date("Y-m-d 00:00:00",time()));
		$month0 = strtotime(date("Y-m-01 00:00:00",time()));
		$today24 = strtotime(date("Y-m-d 23:59:59",time()));
		$shengmiao = $today24 - $now;
		$csetting = $_G['cache']['plugin']['huoyuedu'];
		$bankuais = $csetting[bankuais];
		$bankuais = unserialize($bankuais);
		$viewfids = $_G['cookie']['viewfids'];
		$tolog = 0;
		if(in_array($_G[fid],$bankuais)){ //�����ǰ��鱻����ͳ��
				$todayinfo = DB::fetch_first("SELECT * FROM ".DB::table('yt_huoyuedu2')." WHERE addtime > '".$today0."' and fid ='".$_G[fid]."' order by id desc");
				if(!$todayinfo){DB::query("insert into ".DB::table('yt_huoyuedu2')." (`fid`, `addtime`) VALUES ('$_G[fid]','$now') ");}
				if($viewfids){
					if(strstr($viewfids,"_".$_G[fid]."_")){
     		   $tolog = 0;
					}else{
						$tolog = 1;
					}
				}else{
					$tolog = 1;
				}
		}


		if($tolog){
			$viewinfo = DB::fetch_first("SELECT * FROM ".DB::table('yt_huoyuedu1')." WHERE uid='$_G[uid]' and fid='$_G[fid]' order by id desc");
			if($viewinfo){
				if($viewinfo[lasttime] > $today0){//���챾�˷��ʹ��ð��					
				}else{//������ǰ���ʹ��ð�飬�����������ʸð��
					DB::query("update ".DB::table('yt_huoyuedu1')." set lasttime = '$now',views=views+1 where id = '$viewinfo[id]' ");
					
					if($viewinfo[addtime] < $month0){
						DB::query("insert into ".DB::table('yt_huoyuedu1')." (`uid`, `fid`, `addtime`, `lasttime`, `fromsite`) VALUES ('$_G[uid]','$_G[fid]','$now','$now','')");
					}elseif($viewinfo[views] >= 3){ $benhuo = ",living = living + 1 ";}
				  DB::query("update ".DB::table('yt_huoyuedu2')." set liveuser = liveuser +1 ".$benhuo."  where   addtime > '".$today0."' and fid = '$_G[fid]' ");
				}
			}else{//������ǰ��û���ʹ��ð��
				DB::query("insert into ".DB::table('yt_huoyuedu1')." (`uid`, `fid`, `addtime`, `lasttime`, `fromsite`) VALUES ('$_G[uid]','$_G[fid]','$now','$now','')");
				DB::query("update ".DB::table('yt_huoyuedu2')." set newuser =newuser +1,liveuser = liveuser +1 where addtime > '".$today0."' and fid = '$_G[fid]' ");
			}
			
			$viewfids = $viewfids."_".$_G[fid]."_";
			dsetcookie('viewfids', $viewfids, $shengmiao);//���ʼ�¼��cookie ������0ʱ�Զ�����
		}
	}
}


class plugin_huoyuedu_forum extends plugin_huoyuedu {

}
