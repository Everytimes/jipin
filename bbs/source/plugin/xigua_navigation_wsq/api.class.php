<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php 34718 2014-07-14 08:56:39Z nemohou $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class xigua_navigation_wsq {

	const TYPE_HEADER_BAR           = 1;
	const TYPE_HEADER_BAR_SUB       = 2;
	const TYPE_SIDEBAR_FORUMDISPLAY = 3;
	const TYPE_SIDEBAR_VIEWTHREAD   = 4;

	public function  __construct()
	{
		global $_G;
        $_G['fid'] = intval($_G['fid']);
		if (empty($_G['cache']['plugin'])) {
			loadcache('plugin');
		}
		$this->vars = $_G['cache']['plugin']['xigua_navigation_wsq'];
		$this->on = $this->vars['on'];
		$this->templete = $this->vars['templete'];
		$this->b_style = $this->vars['b_style'];

		if($this->on){
            $list = $this->readfromcache($_G['fid']);
            if (!$list) {
                $list = C::t('#xigua_navigation_wsq#plugin_xigua_navigation_wsq')->fetch_all_navs(1, $_G['fid']);
                $this->writetocache($_G['fid'], $list);
            }
            $this->list = $list;
		}
		$this->z_color = $this->vars['z_color'];
		$this->f_color = $this->vars['f_color'];
		$this->b_color = $this->vars['b_color'];
		$this->f_split = $this->vars['f_split'];

		$this->z_fontsize = $this->vars['z_fontsize'];
		$this->f_fontsize = $this->vars['f_fontsize'];
		$this->z_bold = $this->vars['z_bold'];
		$this->radius = $this->vars['radius'];
        $this->background = array(
			'#5BABEB',
			'#F1914F',
			'#B4B953',
			'#9E8CCB',
			'#F288A2',
			'#E3B342',
			'#8CBDDC',
        );

		$this->top_pic = $this->vars['top_pic'];
		$this->middle_pic = $this->vars['middle_pic'];
		$this->bottom_pic = $this->vars['bottom_pic'];
		$this->z_num = $this->vars['z_num'];
		$this->f_num = $this->vars['f_num'];
		$this->eq_width = $this->vars['eq_width'];
		$this->custom = $this->vars['custom'];
		$this->z_bg = $this->vars['z_bg'];
		$this->f_bg = $this->vars['f_bg'];
	}


    function writetocache($fid, $array = array())
    {
        $datas = $array;
        $cachedata = " return " . var_export($datas, TRUE) . ";";

        global $_G;

        $dir = DISCUZ_ROOT . "./data/sysdata/xigua_navigation_wsq/";
        if (!is_dir($dir)) {
            dmkdir($dir, 0777);
        }
        $file = "$dir/cache_$fid.php";
        if ($fp = @fopen($file, 'wb')) {
            fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: " . md5($fid . '.php' . $cachedata . $_G['config']['security']['authkey']) . "\n\n$cachedata?>");
            fclose($fp);
        } else {
            exit('Can not write to cache files, please check directory ./data/ and ./data/sysdata/ and ./data/sysdata/xigua_beauty_cache/ .');
        }
    }

    function readfromcache($fid)
    {
        $fid = intval($fid);
        $ret = array();

        $file = DISCUZ_ROOT . "./data/sysdata/xigua_navigation_wsq/cache_$fid.php";
        if (is_file($file)) {
            $ret = include $file;
        }

        return $ret;
    }

    function forumdisplay_sideBar() {
		if(!$this->on){
			return '';
		}
        return $this->get_tag(self::TYPE_SIDEBAR_FORUMDISPLAY);
    }

    function viewthread_sideBar() {
		if(!$this->on){
			return '';
		}
        return $this->get_tag(self::TYPE_SIDEBAR_VIEWTHREAD);
    }

    function get_tag($type1){

        $li = $link = '';
        switch($this->b_style){
            case '1':
                $b_color = $this->b_color ? $this->b_color : '#FFF';
                $li = 'float:left;border:0;padding:0;';
                $a = 'margin:5px 5px 0 0;padding:2px 5px;border-radius:3px;background:#64A10A;color:'.$b_color.';line-height:20px;height:20px;';
                break;
            case '2':
                $b_color = $this->b_color ? $this->b_color : '';
                $li = 'float:left;border:0;padding:0;';
                $a = 'margin:5px 5px 0 0;padding:2px 5px;border-radius:3px;background:#FEFEFE;color:'.$b_color.';line-height:20px;height:20px;border:1px solid #DADADA';
                break;
            case '3':
                $b_color = $this->b_color ? $this->b_color : '#FFF';
                $background = $this->background;
                $li = 'float:left;border:0;padding:0;';
                $a = 'margin:5px 5px 0 0;padding:2px 5px;border-radius:3px;color:'.$b_color.';line-height:20px;height:20px;';
                break;
            case '4':
                $b_color = $this->b_color ? $this->b_color : '';
                $li = 'float:left;border:0;padding:0;';
                $a = 'margin:5px 5px 0 0;padding:2px 5px;background:#FFF;color:'.$b_color.';line-height:20px;height:20px;box-shadow:1px 1px 1px #999';
                break;
            default:
                $b_color = $this->b_color ? $this->b_color : '';
                $a = 'color:'.$b_color.';';
                break;
        }

        foreach ($this->list as $v) {
            if($v['type'] == $type1){
                $bcolor = '';
                if(!empty($background)){
                    $kk = array_rand($background, 3);
                    $bcolor = "background:".$background[$kk[mt_rand(0, 2)]].";";
                }
                $link .= "<li style='$li'><a style='$bcolor$a' href=\"$v[link]\">$v[name]</a></li>";
            }
        }

        if($type1 == self::TYPE_SIDEBAR_FORUMDISPLAY){
            return "<ul style='display:block;width:100%;position:absolute;clear:both;bottom:50px'>$link</ul>";
        }else{
            return "<ul style='display:block;width:100%;margin-top:10px;'>$link</ul>";
        }
    }

    public function forumdisplay_headerBar()
    {
		if(!$this->on){
			return '';
		}
		static $xigua_navigation_wsq;
		if($xigua_navigation_wsq){
			return '';
		}
		switch($this->templete)
		{
			case 33:  //qingxincheng
				$return = $this->get_sidebar_template(
					'background:rgb(255,132,0);box-shadow: 0 1px 3px rgba(0,0,0,0.3);',
					'',
					'#fff',
					'border:1px solid rgb(225,225,225);background:rgb(240,240,240);',
					'rgb(51,51,51);',
					'',
					''
				);
                break;
			case 32:  //qingxinlv
				$return = $this->get_sidebar_template(
					'background:#fff;border-top:2px solid rgb(93,191,29);box-shadow: 0 1px 3px rgba(0,0,0,0.3);',
					'',
					'rgb(93,191,29)',
					'background:rgb(241,241,241);',
					'rgb(94,94,94);',
					'border-left:1px solid rgb(93,191,29);',
					''
				);
                break;
			case 31:  //huoyinglan
				$return = $this->get_sidebar_template(
					'background:rgb(63,106,196);box-shadow: 0 1px 3px rgba(0,0,0,0.3);',
					'',
					'#fff',
					'background:rgb(241,241,241);',
					'rgb(94,94,94);',
					''
				);
                break;
			case 30:  //sougoulan
				$return = $this->get_sidebar_template(
					'background:rgb(246,246,246);border-bottom:2px solid rgb(0,124,238);box-shadow: 0 1px 3px rgba(0,0,0,0.3);',
					'',
					'rgb(0,124,238)',
					'border:1px solid rgb(239,239,239);',
					'rgb(128,128,128);',
					''
				);
                break;
			case 29:  //meinvlatu
				$return = $this->get_sidebar_template(
					'background:rgb(31,31,31);border-bottom:2px solid rgb(221,0,0);box-shadow: 0 1px 3px rgba(0,0,0,0.3);',
					'',
					'#fff',
					'background:rgb(56,56,56);',
					'rgb(128,128,128);',
					''
				);
                break;
			case 28:  //sougou news
				$return = $this->get_sidebar_template(
					'background:rgb(238,64,53);border-bottom:1px solid rgb(221,221,221);',
					'',
					'#fff',
					'background:rgb(247,247,247);',
					'rgb(76,76,76);',
					''
				);
                break;
			case 27:  //sougou
				$return = $this->get_sidebar_template(
					'border-bottom:2px solid rgb(238,64,53);border-top:1px solid rgb(194,194,194);',
					'',
					'rgb(71,71,71)',
					'background:rgb(245,245,245);',
					'rgb(76,76,76);',
					''
				);
                break;
			case 26:  //phpwind
				$return = $this->get_sidebar_template(
					'background:#488fce;box-shadow: 0 1px 3px rgba(0,0,0,0.3);',
					'',
					'#FFF',
					'background:#f5f5f5;',
					'#105cb6;',
					'border-left:1px solid #3b7fc4;'
				);
                break;
			case 25:  //elong red
				$return = $this->get_sidebar_template(
					'background:rgb(230,0,20);',
					'',
					'#FFF',
					'',
					'#333',
					'border-left:1px solid orangered;'
				);
                break;
			case 24:  //iqiyi
				$return = $this->get_sidebar_template(
					'background:#414141;',
					'',
					'#FFF',
					'background-image: linear-gradient(to bottom, #f7f7f7, #f0f0f0);',
					'#699F00;',
					'',
					''
				);
                break;
			case 23:  //color_tag
				$return = $this->get_sidebar_template(
					'',
					'',
					'#FFF',
					'',
					'#FFF;',
					'border-radius:3px;margin:3px;',
					'border-radius:3px;margin:3px;'
				);
                break;
			case 22:  //tag
				$return = $this->get_sidebar_template(
					'',
					'',
					'#FFF',
					'',
					'#FFF;',
					'background:#297ee6 -webkit-gradient(linear,0 0,0 100%,from(#2b83ef),to(#2677db));margin:3px;border-radius:3px;',
					'background:#297ee6 -webkit-gradient(linear,0 0,0 100%,from(#2b83ef),to(#2677db));margin:3px;border-radius:3px;'
				);
				break;
			case 21:  //qunar
				$return = $this->get_sidebar_template(
					'border-top:2px solid #1BADB6;border-bottom: 1px solid #CECECE;',
					'',
					'#0086A0',
					'',
					'#FFF',
					'border-left:1px solid #DCDCDC;',
					'color:#1BADB6'
				);
				break;
			case 20:  //hao123_jingdian
				$return = $this->get_sidebar_template(
					'background:#F9F9F9;border-top: 2px solid #196A9D;border-bottom: 1px solid #CECECE;',
					'',
					'#333',
					'background:#F7F7F7;',
					'#196A9D',
					'border-left:1px solid #EAEAEA;'
				);
				break;
			case 19:  //hao123_jianyue
				$return = $this->get_sidebar_template(
					'border:1px solid #EAEAEA;background:#FCFCFC;',
					'',
					'#196A9D',
					'background:#F7F7F7;',
					'#196A9D',
					'border-left:1px solid #EAEAEA;',
					''
				);
				break;
			case 18:  //firefox
				$return = $this->get_sidebar_template(
					'border-top:2px solid #06C;border-bottom: 1px solid #EDEEF0;',
					'',
					'#777',
					'',
					'#333'
				);
				break;
			case 17:  //elong
				$return = $this->get_sidebar_template(
					'background:#0053AC;',
					'',
					'#FFF',
					'',
					'#333',
					'border-left:1px solid #2A76D2;'
				);
				break;
			case 16:  //tongcheng
				$return = $this->get_sidebar_template(
					'background:#64A10A;border-bottom:2px solid #FFA63C;',
					'',
					'#FFF',
					'background:rgb(242,242,242);',
					'#333'
				);
				break;
			case 15:  //tudou
				$return = $this->get_sidebar_template(
					'background: #F60;',
					'',
					'#FFF',
					'background:#F6F7FB;',
					'#2F3B49'
				);
				break;
			case 14:  //youku
				$return = $this->get_sidebar_template(
					'border-bottom: 3px solid #06A7E1;',
					'',
					'#555',
					'background: #F3F3F3;',
					'#666'
				);
				break;
			case 13:  //baoz
				$return = $this->get_sidebar_template(
					'background:#66BB33;',
					'',
					'#FFF',
					'background:#F5F5F5',
					'#333'
				);
				break;
			case 12:  //xici
				$return = $this->get_sidebar_template(
					'background:#303030;border-bottom: #BFC6D0 1px solid;box-shadow: 0 1px 1px #29292A inset, 0 1px 1px #D6DADF;',
					'',
					'#FFF',
					'',
					'#404040'
				);
				break;
			case 11:  //renren
				$return = $this->get_sidebar_template(
					'background:-webkit-gradient(linear,left top,left bottom,from(#2974B5),to(#095DA4));border-bottom:1px solid #023F74;',
					'',
					'#FFF',
					'background:#CEE1EE;',
					'#369'
				);
				break;
			case 10:  //tmall
				$return = $this->get_sidebar_template(
					'border-bottom:2px solid #C40000;',
					'',
					'#000',
					'background:#F7F5F5;',
					'#806F66'
				);
				break;
			case 9:  //taobao
				$return = $this->get_sidebar_template(
					'border-bottom:2px solid #FF5400;',
					'',
					'#FF5400',
					'background:#F5F5F5;',
					'#3C3C3C'
				);
				break;
			case 8:  //fenghuang
				$return = $this->get_sidebar_template(
					'border-top:1px solid #DFDFDF;border-bottom:2px solid #921BB1;background:#EEE;',
					'',
					'#666',
					'',
					'#123261'
				);
				break;
			case 7:  //3G
				$return = $this->get_sidebar_template(
					'background:#658FBD;',
					'',
					'#FEFEFF',
					'background:#ECECEC;',
					'#656565'
				);
				break;
			case 6:  //QQzone
				$return = $this->get_sidebar_template(
					'background:#3F4762;',
					'',
					'#F3F3F3',
					'background:#F1F1F1;',
					'#1AA1E6'
				);
				break;
			case 5:  //Tencent
				$return = $this->get_sidebar_template(
					'background:#49535D;',
					'',
					'#95A0AC',
					'background:#404A54;',
					'#707982'
				);
				break;
			case 4:  //tieba
				$return = $this->get_sidebar_template(
					'background:#F5F7F7;border:1px solid #EAEBEC;border-width:1px 0;',
					'',
					'#3361A7',
					'',
					'#F25824',
					'border-left:1px solid #EAEBEC;'
				);
				break;
			case 3: //baidu
				$return = $this->get_sidebar_template(
					'background:-webkit-gradient(linear,left top,left bottom,from(#DDE9FF),to(#ECF3FF));border-top:2px solid #2C73DF;',
					'',
					'#00C',
					'',
					'#C00'
				);
				break;
			case 2:  //classic
				$return = $this->get_sidebar_template(
					'background:#FFF;border:1px solid #CECECE;border-width:1px 0;',
					'',
					'',
					'background:#F3F3F3;',
					'',
					'border-left:1px solid #cecece;'
				);
				break;
			case 1:  //163
			default:
				$return = $this->get_sidebar_template(
					'background:#F3F3F3;border-top:2px solid #CECECE;',
					'',
					'',
					'',
					''
				);
				break;
		}
		$xigua_navigation_wsq = $return;
		return $xigua_navigation_wsq;
    }

	public function viewthread_topBar()
	{
		$res = $this->forumdisplay_headerBar();
		return $res ? str_replace(array('#headerbar', 'padding-top:10px;'), array('#topcontainer', ''), $res) : '';
	}

	/**
	 * @param        $main_style
	 * @param        $mainastyle
	 * @param string $main_a_color
	 * @param string $sub_warp_custom
	 * @param string $sub_a_color
	 * @param string $mainastyle_replace
	 *
	 * @return string
	 */
	public function get_sidebar_template(
		$main_style,
		$mainastyle,
		$main_a_color = '',
		$sub_warp_custom = '',
		$sub_a_color = '',
		$main_span = '',
		$sub_span = ''
)
	{
		$main_a = array();
        if($this->z_bold){
            $z_bold = 'font-weight:bold;';
        }else{
            $z_bold = '';
        }

		$r = intval($this->radius);
        $sub_warp_i = 'font-style:normal;float:left;';
		$box = ($this->eq_width ? '' : 'display:-webkit-box;');

		$cms_mw   = "{$box}overflow:hidden;min-height:30px;line-height:30px;";
        $sub_warp = "{$box}overflow:hidden;min-height:28px;line-height:28px;";

		if($this->f_split){
			$f_split = '|';
		}else{
			$f_split = '';
		}
        if(in_array($this->templete , array(22,23)))
        {
            $f_split = '';
        }

        $sub_ary = array();

		foreach ($this->list as $k => $v)
        {
            $bcolor = '';
            if($this->templete == 23){
                $bcolor = " style='background:".$this->background[array_rand($this->background, 1)]."';";
            }
            $name = trim($v['name']);
			if($v['type'] == self::TYPE_HEADER_BAR)
            {
				$main_a[] = "<a class='xg_main_a' href='$v[link]'><span$bcolor>$name</span></a>";
			}
            else if($v['type'] == self::TYPE_HEADER_BAR_SUB)
            {
				$sub_ary[] = "<a class='xg_sub_a' href='$v[link]'><span$bcolor>$name</span></a>";
			}
		}

		$top_pic = $this->get_parse_pic($this->top_pic);
		$middle_pic = $this->get_parse_pic($this->middle_pic);
		$bottom_pic = $this->get_parse_pic($this->bottom_pic);

		$main_a_string = '';
		if($main_a){
			$first = 0;
			if($this->z_num > 0){
				$main_arr = array_chunk($main_a, $this->z_num);
			}else{
				$this->z_num = count($main_a);
				$main_arr = array_chunk($main_a, $this->z_num);
			}
			foreach ($main_arr as $ma) {
				$multi_style = '';
				if($first != 0){
					$multi_style = "style='border-top:0;border-radius:0;'";
				}else {
					if($this->templete == 12){
						$multi_style = "style='border-bottom:0;box-shadow:none;'";
					}
				}

				$main_a_string .= "<div $multi_style class=\"xg_main_warp\">".implode('', $ma)."</div>";
				$first = 1;
			}
		}

		$sub_a_string = '';
		if($sub_ary){
			if($this->f_num > 0){
				$sub_arr = array_chunk($sub_ary, $this->f_num);
			}else{
				$this->f_num = count($sub_ary);
				$sub_arr = array_chunk($sub_ary, $this->f_num);
			}
			foreach ($sub_arr as $sub_ary) {
				$sub_a_string .= "<div class=\"xg_sub_warp\">".implode('', $sub_ary)."</div>";
			}
		}

		$zflex = ($this->eq_width ? 'width:'.(100/$this->z_num).'%;float:left;' : '-webkit-box-flex:1;');
		$fflex = ($this->eq_width ? 'width:'.(100/$this->f_num).'%;float:left;' : '-webkit-box-flex:1;');
		$sub_a_style = $fflex.'text-align:center;font-size:'.intval($this->f_fontsize).'px;line-height:28px;display:block;overflow:hidden;position:relative;';
		$cms_ma      = $zflex.'line-height:30px;text-align:center;font-size:'.intval($this->z_fontsize).'px;display:block;'.$z_bold;

		$main_warp = "{$cms_mw}$main_style";

		if($this->z_bg){
			$zbg = 'background-color:'.$this->z_bg;
		}
		if($this->f_bg){
			$fbg = 'background-color:'.$this->f_bg;
		}

		$main_a_style = "{$cms_ma}$mainastyle";
		if($this->z_color)
		{
			$main_span .= 'color:'.$this->z_color;
		}
		else if($main_a_color)
		{
			$main_span .= 'color:'.$main_a_color;
		}

		$sub_warp .= $sub_warp_custom;
		if($this->f_color)
		{
			$sub_a_style .= 'color:'.$this->f_color;
		}
		else if($sub_a_color)
		{
			$sub_a_style .= "color:$sub_a_color;";
		}

		if($this->custom){
			$this->custom = '<div>'. $this->custom .'</div>';
		}

		global $_G;
		$wechat = unserialize($_G['setting']['mobilewechat']);
        $hide_forumlist = '';
		if($this->vars['hide_forumlist']){
			$hide_forumlist .= '<wsqscript>XG_forumlist()</wsqscript>';
		}else{
			$showindexforum = 0;
			if($this->vars['indexforum'] == 1){
				$showindexforum = 1;
			}elseif($this->vars['indexforum'] == 2 && $_G['fid'] == $wechat['wsq_fid']){
				$showindexforum = 1;
			}
            if($showindexforum && ($this->vars['forumlistlink'] || $this->vars['forumlistfont'])){
                $hide_forumlist .= '<wsqscript>XG_link()</wsqscript>';
            }
        }
		$showindexpost = 0;
		if($this->vars['indexpost'] == 1){
			$showindexpost = 1;
		}elseif($this->vars['indexpost'] == 2 && $_G['fid'] == $wechat['wsq_fid']){
			$showindexpost = 1;
		}
		if($showindexpost && ($this->vars['postthreadlink1'] ||$this->vars['postthreadfont'])){
			$hide_forumlist .= '<wsqscript>XG_post()</wsqscript>';
		}

		$sub_a_after = $f_split ? "content: ''; display: block;	position: absolute; width: 1px;height: 14px; background-color:#999; right: 0; top: 50%; margin-top:-7px;" : '';
		$ret = <<<HTML
<style type="text/css">
#topcontainer{}
#topcontainer>div>div{height:auto;padding:0}
#topcontainer>div>div>div{margin-top:0;height:auto!important;max-height:auto!important}
#headerbar a{-webkit-tap-highlight-color:rgba(0,0,0,.3)}
#headerbar .xg_warp{width:100%;clear:both;padding-top:10px;float:left;overflow:hidden}
#headerbar .xg_main_warp{{$main_warp}border-radius:{$r}px {$r}px 0 0;$zbg}
#headerbar .xg_main_warp a:first-child, #headerbar .xg_main_warp a:first-child span{border-left:none}
#headerbar .xg_main_warp a:last-child, #headerbar .xg_main_warp a:last-child span{border-right:none}
#headerbar .xg_main_a{{$main_a_style}}
#headerbar .xg_main_a span{display:block;$main_span}
#headerbar .xg_sub_a{{$sub_a_style}}
#headerbar .xg_sub_a:after{{$sub_a_after}}
#headerbar .xg_sub_a:last-child:after{width:0}
#headerbar .xg_sub_a span{display:block;$sub_span}
#headerbar .xg_sub_a:first-child span{border-left:none}
#headerbar .xg_sub_a:last-child span{border-right:none}
#headerbar .xg_sub_warp{{$sub_warp};$fbg}
#headerbar .xg_sub_warp:last-child{border-radius:0 0 {$r}px {$r}px}
#headerbar .xg_sub_warp i{{$sub_warp_i}}
</style><div class="xg_warp"> $top_pic $main_a_string $middle_pic  $sub_a_string  $bottom_pic $this->custom  $hide_forumlist </div>
HTML;
        return $ret;
	}

	public function get_parse_pic($pic_string)
	{
		if(!$pic_string){
			return '';
		}
		$retstr = '';
		global $_G;
		$top_pic_arr = array();
		$top_pics = array_filter(explode("\n", $pic_string));
		if(!empty($top_pics) && is_array($top_pics)){
			foreach ($top_pics as $top_pic) {
                $top_pic = str_replace(array(',', lang('plugin/xigua_navigation_wsq', 'dot')), ' ', trim($top_pic));
				list($fid, $src, $href) = explode(' ', $top_pic);
                $fid = trim($fid);
                $src = trim($src);
                $href = trim($href);
                if(empty($href)){
                    $href = '#';
                }
				if(($fid == 0 || $fid == $_G['fid']) && $src && $href)
				{
					$retstr .= "<div style='overflow:hidden;'><a class='xg_nav_cover' href='$href'><img class='xg_nav_img' style='width:100%;' src='$src' /></a></div>";
				}
			}

			return $retstr;
		}
		return '';
	}

	public function forumdisplay_variables(&$variables)
	{
        $variables['function'] = array_merge(
            array(
                'XG_forumlist' => array('WSQ.hide', array('forumlist')),
                'XG_link' => array('WSQ.ajaxget', array('id=xigua_navigation_wsq&xt=f', 'forumlist')),
                'XG_post' => array('WSQ.ajaxget', array('id=xigua_navigation_wsq&xt=t', 'post_thread')),
            )
            , (array)$variables['function']);
	}
}