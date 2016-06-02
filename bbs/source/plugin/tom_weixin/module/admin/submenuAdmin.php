<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$submenuBaseUrl = $moduleBaseUrl.'&act=admin&moduleid=submenu';
$submenuListUrl = 'action=plugins&operation=config&do='.$pluginid.'&identifier=tom_weixin&pmod=module&act=admin&moduleid=submenu';
if($_GET['mact'] == 'add'){
    if(submitcheck('submit')){
        $title      = isset($_GET['title'])? addslashes($_GET['title']):'';
        $description = isset($_GET['description'])? addslashes($_GET['description']):'';
        $picurl     = isset($_GET['picurl'])? addslashes($_GET['picurl']):'';
        $url        = isset($_GET['url'])? addslashes($_GET['url']):'';
        $paixu      = isset($_GET['paixu'])? intval($_GET['paixu']):'';
        
        $insertData = array();
        $insertData['title']        = $title;
        $insertData['description']  = $description;
        $insertData['picurl']       = $picurl;
        $insertData['url']          = $url;
        $insertData['paixu']        = $paixu;
        C::t('#tom_weixin#tom_weixin_submenu')->insert($insertData);
        cpmsg($tomScriptLang['act_success'], $submenuListUrl, 'succeed');
    }else{
        showformheader('plugins&operation=config&do=' . $pluginid . '&identifier=tom_weixin&pmod=module&act=admin&moduleid=submenu&mact=add');
        showtableheader();
        echo '<tr><th colspan="15" class="partition"><a href="'.$submenuBaseUrl.'"><font color="#F60"><b>' . $moduleLang['submenu_list_back'] . '</b></font></a></th></tr>';
        echo '<tr class="header"><th>'.$moduleLang['title'].'</th><th></th></tr>';
        echo '<tr><td width="300"><input name="title" type="text" value="" size="40" /></td><td>'.$moduleLang['title_msg'].'</td></tr>';
        echo '<tr class="header"><th>'.$moduleLang['description'].'</th><th></th></tr>';
        echo '<tr><td><textarea rows="6" name="description" cols="40" class="tarea"></textarea></td><td>'.$moduleLang['description_msg'].'</td></tr>';
        echo '<tr class="header"><th>'.$moduleLang['picurl'].'</th><th></th></tr>';
        echo '<tr><td><input name="picurl" type="text" value="" size="60"/></td><td>'.$moduleLang['picurl_msg'].'</td></tr>';
        echo '<tr class="header"><th>'.$moduleLang['url'].'</th><th></th></tr>';
        echo '<tr><td><input name="url" type="text" value="" size="60"/></td><td>'.$moduleLang['url_msg'].'</td></tr>';
        echo '<tr class="header"><th>'.$moduleLang['paixu'].'</th><th></th></tr>';
        echo '<tr><td><input name="paixu" type="text" value="10" size="10"/></td><td></td></tr>';
        showsubmit('submit', 'submit');
        showtablefooter();
        showformfooter();
    }
}else if($_GET['mact'] == 'edit'){
    $submenuInfo = C::t('#tom_weixin#tom_weixin_submenu')->fetch_by_id($_GET['id']);
    if(submitcheck('submit')){
        $title      = isset($_GET['title'])? addslashes($_GET['title']):'';
        $description = isset($_GET['description'])? addslashes($_GET['description']):'';
        $picurl     = isset($_GET['picurl'])? addslashes($_GET['picurl']):'';
        $url        = isset($_GET['url'])? addslashes($_GET['url']):'';
        $paixu      = isset($_GET['paixu'])? intval($_GET['paixu']):'';
        
        $updateData = array();
        $updateData['title']  = $title;
        $updateData['description'] = $description;
        $updateData['picurl'] = $picurl;
        $updateData['url'] = $url;
        $updateData['paixu'] = $paixu;
        C::t('#tom_weixin#tom_weixin_submenu')->update($submenuInfo['id'],$updateData);
        cpmsg($tomScriptLang['act_success'], $submenuListUrl, 'succeed');
    }else{
        showformheader('plugins&operation=config&do=' . $pluginid . '&identifier=tom_weixin&pmod=module&act=admin&moduleid=submenu&mact=edit&id='.$_GET['id']);
        showtableheader();
        echo '<tr><th colspan="15" class="partition"><a href="'.$submenuBaseUrl.'"><font color="#F60"><b>' . $moduleLang['submenu_list_back'] . '</b></font></a></th></tr>';
        echo '<tr class="header"><th>'.$moduleLang['title'].'</th><th></th></tr>';
        echo '<tr><td width="300"><input name="title" type="text" value="'.$submenuInfo['title'].'" size="40" /></td><td>'.$moduleLang['title_msg'].'</td></tr>';
        echo '<tr class="header"><th>'.$moduleLang['description'].'</th><th></th></tr>';
        echo '<tr><td><textarea rows="6" name="description" cols="40" class="tarea">'.$submenuInfo['description'].'</textarea></td><td>'.$moduleLang['description_msg'].'</td></tr>';
        echo '<tr class="header"><th>'.$moduleLang['picurl'].'</th><th></th></tr>';
        echo '<tr><td><input name="picurl" type="text" value="'.$submenuInfo['picurl'].'" size="60"/></td><td>'.$moduleLang['picurl_msg'].'</td></tr>';
        echo '<tr class="header"><th>'.$moduleLang['url'].'</th><th></th></tr>';
        echo '<tr><td><input name="url" type="text" value="'.$submenuInfo['url'].'" size="60"/></td><td>'.$moduleLang['url_msg'].'</td></tr>';
        echo '<tr class="header"><th>'.$moduleLang['paixu'].'</th><th></th></tr>';
        echo '<tr><td><input name="paixu" type="text" value="'.$submenuInfo['paixu'].'" size="10"/></td><td></td></tr>';
        
        showsubmit('submit', 'submit');
        showtablefooter();
        showformfooter();
    }
}else if($_GET['formhash'] == FORMHASH && $_GET['mact'] == 'del'){
    C::t('#tom_weixin#tom_weixin_submenu')->delete_by_id($_GET['id']);
    cpmsg($tomScriptLang['act_success'], $submenuListUrl, 'succeed');
}else{
    $submenuList = C::t('#tom_weixin#tom_weixin_submenu')->fetch_all_list();
    showtableheader();
    echo '<tr><th colspan="15" class="partition">' . $moduleLang['submenu_help_title'] . '</th></tr>';
    echo '<tr><td colspan="15" class="tipsblock" s="1"><ul id="tipslis">';
    echo '<li>' . $moduleLang['submenu_help_1'] . '</li>';
    echo '<li>' . $moduleLang['submenu_help_2'] . '</li>';
    echo '<li>' . $moduleLang['submenu_help_3'] . '</li>';
    echo '</ul></td></tr>';
    echo '<tr><th colspan="15" class="partition">' . $moduleLang['submenu_list_title'] . '</th></tr>';
    echo '<tr><th colspan="15">';
    echo '&nbsp;&nbsp;<a class="addtr" href="'.$submenuBaseUrl.'&mact=add">' . $moduleLang['submenu_add'] . '</a>';
    echo '</th></tr>';
    echo '<tr class="header">';
    echo '<th width="10%">ID</th>';
    echo '<th>' . $moduleLang['title'] . '</th>';
    echo '<th>' . $moduleLang['description'] . '</th>';
    echo '<th>' . $moduleLang['paixu'] . '</th>';
    echo '<th>' . $tomScriptLang['handle'] . '</th>';
    echo '</tr>';
    
    $i = 1;
    foreach ($submenuList as $key => $value) {
        echo '<tr>';
        echo '<td>' . $i . '</td>';
        echo '<td>' . $value['title'] . '</td>';
        echo '<td>' . $value['description'] . '</td>';
        echo '<td>' . $value['paixu'] . '</td>';
        echo '<td>';
        echo '<a href="'.$submenuBaseUrl.'&mact=edit&id='.$value['id'].'&formhash='.FORMHASH.'">' . $moduleLang['submenu_edit']. '</a>&nbsp;|&nbsp;';
        echo '<a href="'.$submenuBaseUrl.'&mact=del&id='.$value['id'].'&formhash='.FORMHASH.'">' . $tomScriptLang['delete'] . '</a>';
        echo '</td>';
        echo '</tr>';
        $i++;
    }
    showtablefooter();
}
?>
