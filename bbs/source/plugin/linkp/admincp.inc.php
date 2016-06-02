<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$mode=isset($_REQUEST['mode'])?$_REQUEST['mode']:'default';
cpheader();
if($mode=='default' || $mode=='list'){

           $sql="select * from ".DB::table('common_linkp');
           $query = DB::query($sql);
           while($leave=DB::fetch($query)){
			   
			   
			   $data[]=$leave;
			   
		   }
		   
		   
		   include template('linkp:list');
  
   

}elseif($mode=='save'){
	if(submitcheck('submit') && FORMHASH==$_POST['formhash']){
     
	 
	 $clink=daddslashes(getgpc('clink','p'));
	 $plink=daddslashes(getgpc('plink','p'));
     $linknum=intval(getgpc('linknum','p'));
	 $message=daddslashes(getgpc('message'));
	 $addtime=time();
	  $sql="insert into ".DB::table('common_linkp')."(clink,plink,linknum,message,addtime)values('$clink','$plink','$linknum','$message','$addtime')";
	  
	  $data=array(
	     'clink'=>$clink,
		 'plink'=>$plink,
		 'linknum'=>$linknum,
		 'message'=>$message,
		 'addtime'=>$addtime,
	  
	  );
	  DB::insert('common_linkp',$data);
	  
    // DB::query($sql);
	 
	 cpmsg(lang('plugin/linkp', 'seo1'),'action=plugins&operation=config&do='.$pluginid.'&identifier=linkp&pmod=admincp&mode=list');
	
	}
	  include template('linkp:setting');
	
}


elseif($mode=='drop' && isset($_GET['hash']) && FORMHASH==$_GET['hash']){
	
	$id=getgpc('id');
	$sql="delete from ".DB::table('common_linkp')." where id=$id";
    $query = DB::query($sql);
	
	 cpmsg(lang('plugin/linkp', 'seo2'),'action=plugins&operation=config&do='.$pluginid.'&identifier=linkp&pmod=admincp&mode=list','succeed');
}
elseif($mode=='edit'){
	
	
	$id=getgpc('id');
	
	if(submitcheck('submit') && FORMHASH==$_POST['formhash']){
		  
		  
	   $clink=daddslashes(getgpc('clink','p'));
	   $plink=daddslashes(getgpc('plink','p'));
       $linknum=intval(getgpc('linknum','p'));
	   $message=daddslashes(getgpc('message'));
	  
       
	  
	   $data=array(
	     'clink'=>$clink,
		 'plink'=>$plink,
		 'linknum'=>$linknum,
		 'message'=>$message,
		
	  
	    );
		DB::update('common_linkp',$data,"id=$id");
	   cpmsg(lang('plugin/linkp', 'seo3'),'action=plugins&operation=config&do=' . $pluginid . '&identifier=linkp&pmod=admincp&mode=list');
		 
		 
	 }
	$sql="select * from ".DB::table('common_linkp')." where id=$id";
    $query = DB::query($sql);
		   
    $leave=DB::fetch($query);
	
    include template('linkp:setting');
	
	
}