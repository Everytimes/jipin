<?php
if(!defined('IN_DISCUZ') && !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
function xgl($lang){
    return lang('plugin/xigua_navigation_wsq', $lang);
}

$wechat = unserialize($_G['setting']['mobilewechat']);
function xg_get_slt_type($selected = 0){
    $selects = array(
        1 => xgl('select1'),
        2 => xgl('select2'),
        3 => xgl('select3'),
        4 => xgl('select4'),
    );
    $data = '';
    foreach ($selects as $value => $display) {
        if($selected == $value){
            $s = 'selected="selected"';
        }else{
            $s = '';
        }
        $data .= "<option value=\"$value\" $s>$display</option>";
    }
    return $data;
}

if(submitcheck('permsubmit'))
{
    if(!empty($_GET['new']))
    {
        $data = array();
        $new = $_GET['new'];
        foreach ($new['name'] as $key => $row) {
            $data[$key]['name'] = $row;
            $data[$key]['type'] = $new['type'][$key];
            $data[$key]['displayorder'] = $new['displayorder'][$key];
            $data[$key]['link'] = $new['link'][$key];
            $data[$key]['fids'] = implode(',', array_filter($new['fids'][$key]));
        }
        C::t('#xigua_navigation_wsq#plugin_xigua_navigation_wsq')->save($data);
    }

    if(!empty($_GET['row'])){
        C::t('#xigua_navigation_wsq#plugin_xigua_navigation_wsq')->multi_update($_GET['row']);
    }
    if(!empty($_GET['delete'])){
        C::t('#xigua_navigation_wsq#plugin_xigua_navigation_wsq')->multi_delete($_GET['delete']);
    }

//    if (!isset($_G['cache']['forums'])) {
//        loadcache('forums');
//    }
//    foreach ($_G['cache']['forums'] as $forum) {
//        $cache_file = DISCUZ_ROOT . "./data/sysdata/xigua_navigation_wsq_$forum[fid].php";
//        if(is_file($cache_file)){
//            @unlink($cache_file);
//        }
//    }

    include DISCUZ_ROOT . './source/plugin/xigua_navigation_wsq/function.php';
    xgn_delete_all(DISCUZ_ROOT . "./data/sysdata/xigua_navigation_wsq");

    cpmsg(xgl('save_succeed'), "action=plugins&operation=config&do=$pluginid&identifier=xigua_navigation_wsq&pmod=admin&page=".$_GET['page'], 'succeed');
}

$page = max(1, intval(getgpc('page')));
$lpp   = 10;
$start_limit = ($page - 1) * $lpp;

$list = C::t('#xigua_navigation_wsq#plugin_xigua_navigation_wsq')->fetch_all_navs_page($start_limit, $lpp);
$count = C::t('#xigua_navigation_wsq#plugin_xigua_navigation_wsq')->fetch_all_navs_count();

$multipage = multi($count, $lpp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=xigua_navigation_wsq&pmod=admin&lpp=$lpp", 0, 10, 0, 1);

require_once libfile('function/forumlist');
$forums = '<select style="max-height:80px;width:200px" name="row[fids][]" size="10" multiple="multiple"><option value="">'.cplang('plugins_empty').'</option><option value="-1">'.cplang('all').'</option>'.forumselect(FALSE, 0, 0, TRUE).'</select>';

showformheader("plugins&operation=config&do=$pluginid&identifier=xigua_navigation_wsq&pmod=admin");
//showtableheader(xgl('tip'));
//showtablerow('','colspan="99"',str_replace('$wechat[wsq_siteid]', $wechat['wsq_siteid'],xgl('how')));
showtableheader(xgl('nav'));
showtablerow('class="header"', array(), array(
    'ID',
//    xgl('available'),
    xgl('displayorder'),
    xgl('position'),
    xgl('name'),
    xgl('link'),
    xgl('forums'),
));

foreach ($list as $row) {
    $ID= 'htmlQ'.$row['id'];
    $name = str_replace('\'', '"', $row['name']);
    $oldforums = $forums;
    $oldforums = str_replace(array("\n", 'name="row[fids][]"'), array('', 'name="row['.$row['id'].'][fids][]"'), $oldforums);
    foreach(array_filter(explode(',', $row['fids'])) as $v) {
        $oldforums = str_replace('<option value="'.$v.'">', '<option value="'.$v.'" selected>', $oldforums);
    }
    showtablerow('', array(
//        'class="td25"',
//        'class="td25"',
//        'class="td25"',
//        'class="td25"',
//        'class="td29"',
//        'class="td29"',
//        'class="td29"',
    ), array(
        '<label><input type="checkbox" name="delete[]" value="'.$row['id'].'" /> '.$row['id'].'</label>',
//        '<input class="checkbox" name="row['.$row['id'].'][available]" type="checkbox" '.($row['available'] ? 'checked="checked" ' : '').' value="1" />',
        '<input size="2" type="text" name="row['.$row['id'].'][displayorder]" value="'.$row['displayorder'].'" />',
        '<select name="row['.$row['id'].'][type]">'.xg_get_slt_type($row['type']).'</select>',
//        '<input type="text" class="txt" name="row['.$row['id'].'][name]" value="'.$row['name'].'">',
        <<<HTML
<div style="width:100px!important"><div id="$ID" class="txt html" contenteditable="true" style="text-shadow:1px 1px 1px #aaa;width:84px!important;margin-bottom:5px">{$row[name]}</div>
<input id="{$ID}_v" name="row[{$row[id]}][name]" value='{$name}' type="hidden">
<script type="text/javascript">$('$ID').innerHTML='{$name}';sethtml('$ID')</script><br>
<div id="{$ID}_c_menu" style="display: none;">
    <iframe id="{$ID}_c_frame" src="" frameborder="0" width="210" height="148" scrolling="no"></iframe>
</div></div>
HTML
,

        '<input type="text" class="txt" style="width:200px" name="row['.$row['id'].'][link]" value="'.$row['link'].'">',
        $oldforums
    ));
}


echo '<tr>
    <td>&nbsp;</td>
    <td colspan="99">
    <input type="hidden" name="page" value="'.$page.'">
        <span><a class="addtr" href="javascript:;" onclick="addrow(this, 0)">'.xgl('add').'</a></span>
    </td>
</tr>';
showsubmit('permsubmit', 'submit', 'del', '', $multipage);
showtablefooter();
showformfooter();

?>
<script type="text/JavaScript">
    var rowtypedata = [
        [
            [1, '&nbsp;'],
//            [1,'<input class="checkbox" name="new[available][]" type="checkbox" disabled checked="checked" value="1" />'],
            [1,'<input type="text" name="new[displayorder][]" value="0" size="2">'],
            [1,'<select name="new[type][]"><?php echo xg_get_slt_type()?></select>'],
            [1,'<input type="text" class="txt" name="new[name][]">'],
            [1,'<input type="text" class="txt" style="width:350px" name="new[link][]" value="http://">'],
            [1, '<?php
            echo str_replace(array("\n", 'name="row[fids][]"', '<option value="-1"', '\''), array('', 'name="new[fids][{n}][]"', '<option value="-1" selected', '\\\''), $forums);
            ?>']
        ]
    ];
</script>