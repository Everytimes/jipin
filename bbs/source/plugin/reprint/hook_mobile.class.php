<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once dirname(__FILE__).'/libs/env.class.php';
class mobileplugin_reprint
{
    public function common()
    {
        global $_G;
		if (class_exists('ReprintAPI', false) && method_exists('ReprintAPI', 'common')) {
			$_G['pluginrunlist'][] = 'reprint';
			$this->_disableSecCode();
			ReprintAPI::common();
		}
    }

	public function global_reprint()
	{
		global $_G;
		if (class_exists('ReprintAPI', false) && method_exists('ReprintAPI', 'output')) {
			ReprintAPI::output();
		}
	}

	protected function _disableSecCode()
	{
		global $_G;
		$_G['setting']['seccodedata'] =  json_decode('{"cloudip":"0","rule":{"register":{"allow":"0","numlimit":"",' . 
				'"timelimit":"60"},"login":{"allow":"0","nolocal":"0","pwsimple":"0","pwerror":"0","outofday":"","numiptry":"",' . 
				'"timeiptry":"60"},"post":{"allow":"0","numlimit":"","timelimit":"60","nplimit":"","vplimit":""},"password":{"allow":"0"},' . 
				'"card":{"allow":"0"}},"minposts":"","type":"0","width":100,"height":30,"scatter":"","background":"0","adulterate":"0",' . 
				'"ttf":"0","angle":"0","warping":"0","color":"0","size":"0","shadow":"0","animator":"0"}', true);
		$tmp = json_decode('{"allowmobile":1,"mobileseccode":0,"mobilehotthread":1,"mobiledisplayorder3":1}', true);
		$_G['setting']['mobile'] = $tmp + $_G['setting']['mobile'];
		$_G['setting']['secqaa']['status'] = 0;
		$_G['cache']['plugin']['dsu_paulsign']['ftopen'] = 0;
	}
}
