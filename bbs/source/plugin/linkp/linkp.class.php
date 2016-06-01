<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_linkp {
	

	  function global_footer()
	  {
		  $requsturl=$_SERVER['REQUEST_URI'];
	      $sql="select * from ".DB::table('common_linkp');
           $query = DB::query($sql);
		    $requsturl='http://'. $_SERVER['HTTP_HOST'].$requsturl;
           while($leave=DB::fetch($query)){
			  
			 
			
				 if($requsturl==$leave['clink']){
				   $cookie_key='plink_num'.$leave['id'];
				   $showdialog=false;
				   $linknum=getcookie($cookie_key);
				  if(!$linknum){
					  
					  
					       $showdialog=true;
						   $linknum=0;
					  
				  }else{
					  
					  
					  
					   $linknum=intval($linknum);
					   
					   if($linknum>$leave['linknum'] && $leave['linknum']>0){
						   
						     $showdialog=false;
						   
						}else{
							
							
							  $showdialog=true;
							  
						}
					  
				  }
				  if($showdialog){
				    $linknum=$linknum+1;
				    dsetcookie($cookie_key,$linknum,86400);
				   $message='<div>'.$leave['message'].'</div><div><button onclick="location.href=\\\''.$leave['plink'].'\\\'"  value="true" class="pn pnc"><strong>   GO   </strong></button></div>';
				   return "<script>showDialog('".$message."','confirm','','',1);
				   
				          
				   
				   </script>";
				   
				  }
				}
		    }
		  
		  
	   }
	  
	  
}
		
		
	  