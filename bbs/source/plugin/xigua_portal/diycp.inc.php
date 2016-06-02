<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/9
 * Time: 14:51
 */
if (!defined('IN_DISCUZ') && !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'init.php';

$app_url = 'http://addon.discuz.com/?@xigua_portal.plugin';
$ahead = $_G['siteurl'] . 'plugin.php?id=xigua_portal:index';
$page = max(1, intval(getgpc('page')));
$lpp = 5;
$start_limit = ($page - 1) * $lpp;

$styles = xigua_cards::styles();


$select = '<select name="row[style][]">';
foreach ($styles as $style) {
    $select .= '<option value="'.$style.'">'.xigua_cards::l('style_'.$style, 0).'</option>';
}
$select .= '</select>';

if (submitcheck('persubmit')) {

    $index = intval($_GET['index']);
    $settings = array('xigua_portal_pid' => $index);
    C::t('common_setting')->update_batch($settings);
    updatecache('setting');

    require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
    if($index){
        $pluginid = 'xigua_portal';
        WeChatHook::updateRedirect(
            array('plugin' => $pluginid, 'include' => 'api.class.php', 'class' => $pluginid, 'method' => 'redirect')
        );
    }else{
        WeChatHook::updateRedirect(
            array('plugin' => 'wechat', 'include' => 'response.class.php', 'class' => 'WSQResponse', 'method' => 'redirect')
        );
    }

    if (!empty($_GET['new'])) {
        $new = dhtmlspecialchars($_GET['new']);
        foreach ($new['title'] as $key => $row) {
            $data = array();
            $data['title']       = ($row);
            $data['style'] = ($new['style'][ $key ]);
            $data['keywords']    = ($new['keywords'][ $key ]);
            $data['description'] = ($new['description'][ $key ]);
            $data['code'] = ($new['code'][ $key ]);
            C::t('#xigua_portal#xigua_portal_page')->insert($data);
        }
    }

    if (!empty($_GET['row'])) {
        $rows = dhtmlspecialchars($_GET['row']);
        foreach ($rows['title'] as $key => $row) {
            $data = array();
            $data['title'] = ($row);
            $data['style'] = ($rows['style'][ $key ]);
            $data['keywords'] = ($rows['keywords'][ $key ]);
            $data['description'] = ($rows['description'][ $key ]);
            $data['code'] = $rows['code'][ $key ];
            C::t('#xigua_portal#xigua_portal_page')->update($key, $data);
        }
    }

    if (!empty($_GET['delete'])) {
        C::t('#xigua_portal#xigua_portal_page')->multi_delete($_GET['delete']);
    }
    cpmsg(
        xigua_cards::l('succeed', 0),
        "action=plugins&operation=config&do=$pluginid&identifier=xigua_portal&pmod=diycp&page=" . $page,
        'succeed'
    );
}

$list = C::t('#xigua_portal#xigua_portal_page')->range($start_limit, $lpp, 'DESC');
$count = C::t('#xigua_portal#xigua_portal_page')->count();
$multipage = multi(
    $count, $lpp, $page,
    ADMINSCRIPT . "?action=plugins&operation=config&do=$pluginid&identifier=xigua_portal&pmod=diycp"
);

showformheader("plugins&operation=config&do=$pluginid&identifier=xigua_portal&pmod=diycp");
showtableheader(xigua_cards::l('diy_desc', 0).  '<a style="position:absolute;right:10px;color:red;font-weight:bold" href="'.$app_url.'">'.xigua_cards::l('style_more', 0).'</a>',
    '','style="position:relative"');
showtablerow('class="header"', array(), array(
    'PID',
    xigua_cards::l('allstyle', 0),
    xigua_cards::l('title', 0),
    xigua_cards::l('keywords', 0),
    xigua_cards::l('description', 0),
    xigua_cards::l('code', 0),
    xigua_cards::l('action', 0),
));

$list = array_values($list);
$max = count($list);
foreach ($list as $k => $row) {
    $pid = $row['pid'];
    showtablerow('', array(), array(
        '<input type="checkbox" name="delete[]" value="' . $pid . '" />' . $pid,
        str_replace(array('<option value="'.$row['style'], 'row[style][]'), array('<option selected value="'.$row['style'], 'row[style]['.$pid.']'), $select),
        '<input type="text" class="txt" style="width:100px" name="row[title][' . $pid . ']" value="' . $row['title'] . '" >',
        '<input type="text" class="txt" style="width:150px" name="row[keywords][' . $pid . ']" value="' . $row['keywords'] . '" >',
        '<textarea cols=20 rows=3 name="row[description][' . $pid . ']" >' . $row['description'] . '</textarea>',
        '<textarea cols=20 rows=3 name="row[code][' . $pid . ']" >' . $row['code'] . '</textarea>',
        '<a target="_balnk" href="' . $ahead . '&pid=' . $pid . '&diy=yes">' . xigua_cards::l('diy_start', 0) . '</a>&nbsp;&nbsp;&nbsp;'.
        '<a target="_balnk" href="' . $ahead . '&pid=' . $pid . '&preview=previews">' . xigua_cards::l('preview', 0) . '</a>'.        '<label><input id="check_'.$k.'" '.($_G['setting']['xigua_portal_pid']==$pid ? 'checked' : '').' class="radio" type="checkbox" onclick="return docheck('.$k.','.$max.');" name="index" value="'.$pid.'" />'.xigua_cards::l('be_index', 0) .'</label>'

    ));
}

echo '<tr>
<td>&nbsp;</td>
<td colspan="99">
    <input type="hidden" name="page" value="' . $page . '">
    <span><a class="addtr" href="javascript:;" onclick="addrow(this, 0)">' . xigua_cards::l('add', 0) . '</a></span>
</td>
</tr>';

showsubmit('persubmit', 'submit', 'del', '', $multipage);
showtablefooter();
showformfooter();
?>
<script type="text/JavaScript">
    var rowtypedata = [
        [
            [1, '&nbsp;'],
            [1, '<?php echo str_replace('name="row[style][]"', 'name="new[style][]"', $select)?>'],
            [1, '<input type="text" class="txt" style="width:100px" name="new[title][]" >'],
            [1, '<input type="text" class="txt" style="width:150px" name="new[keywords][]">'],
            [1, '<textarea  cols=20 rows=3 name="new[description][]"></textarea>'],
            [1, '<textarea  cols=20 rows=3 name="new[code][]"></textarea>'],
            [1, '&nbsp;']
        ]
    ];
    function docheck(index, max){
        for(var i =0; i<max; i++){
            if(i != index){
                document.getElementById('check_'+i).checked = 0;
            }
        }
        return true;
    }
</script>