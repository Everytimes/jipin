<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class xigua_logo
{
    public function __construct()
    {
        global $_G;
        if(!$_G['cache']['plugin']){
            loadcache('plugin');
        }
        $this->config = $_G['cache']['plugin']['xigua_logo'];
        $this->push_forums = array_filter(unserialize($this->config['push_forums']));
        $this->push_title = $this->config['push_title'];
        $this->push_margin = intval($this->config['push_margin']);

        $this->announcement_tid = ($this->config['announcement_tid']);
        $this->announcement_title = $this->config['announcement_title'];
        $this->announcement_color = $this->config['announcement_color'];
    }

    function forumdisplay_topBar()
    {
        global $_G;

        $return = array();
        include dirname(__FILE__) . '/function.php';

        if($this->announcement_tid)
        {
            $gonggao = xg_ll('gonggao', 1);
            $p_style = 'font-size:14px;height:17px;line-height:18px;vertical-align:middle';
            $c1 = $this->announcement_color ? $this->announcement_color : '#db5f40';
            $span_style = "background:".$c1.";color:#FFF;border-radius:2px;padding: 0 5px;margin-right:5px;display:inline-block;" . $p_style;

            $data =  fetch_post_by_tid($this->announcement_tid);
            $html = '';
            if($data['count'] == 1)
            {
                $html = <<<HTML
<ul><li class="wot" tid="$data[tid]"><span style="$span_style">$gonggao</span><a href="javascript:;" class="c3" style="$p_style">$data[subject]</a></li></ul><p style="height:45px;color:#666;font-size:11px;overflow:hidden">$data[message]</p>
HTML;
            }else if($data['posts']){
                foreach ($data['posts'] as $tid => $subject) {
                    $html .= "<li class=\"wot\" tid=\"$tid\"><span style=\"$span_style\">$gonggao</span><a class=\"c3\" style=\"$p_style\">$subject</a></li>";
                }
                $html = "<ul>$html</ul>";
            }

            $return[] = array(
                'name' => $this->announcement_title,
                'html' => $html,
                'more' => '',
            );
        }


        if(! empty($this->push_forums))
        {
            if($display = get_logo_forums($this->push_forums))
            {
                require_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
                $return[] = array(
                    'name' => $this->push_title,
                    'html' => $this->gethtml($display),
                    'more' => WeChatHook::getPluginUrl('xigua_logo:forumlist', array('siteid' => $_GET['siteid'])),
                );
            }
        }




        return $return;
    }

    public function gethtml($forums)
    {
        $i = 0;
        $total = count($forums);
        foreach ($forums as $forum) {
            if(++$i == $total){
                $this->push_margin = 0;
            }
            $li[] = "<a style='box-sizing:border-box;width:54px;height:72px;text-align:center;float:left;margin-right:".$this->push_margin."px;' href='".get_forum_url($forum['fid'], $_GET['siteid'])."'><img style='width:45px;height:45px;border-radius:3px' src='$forum[icon]'/>
<span class='wot' style='clear:both;display:block;text-align:center;overflow:hidden;white-space:nowrap;line-height:22px;height:22px'>$forum[name]</span>
</a>";
        }

        return !empty($li) ? '<div><div>'.implode('', $li).'</div><div style="clear:both"></div></div>' : '';
    }
}