<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * Created by PhpStorm.
 * User: yzg
 * Date: 2014/11/17
 * Time: 0:10
 */
class XG_treeclass {

    public $arr = array();

    public $nbsp = "&nbsp;";

    public $ret = '';

    public $child = array();

    /**
     * array(
     *      1 => array('fid'=>'1','fup'=>0,'name'=>''),
     *      2 => array('fid'=>'2','fup'=>0,'name'=>''),
     *      3 => array('fid'=>'3','fup'=>1,'name'=>''),
     *      4 => array('fid'=>'4','fup'=>1,'name'=>''),
     *      5 => array('fid'=>'5','fup'=>2,'name'=>''),
     *      6 => array('fid'=>'6','fup'=>3,'name'=>''),
     *      7 => array('fid'=>'7','fup'=>3,'name'=>'')
     *      )
     */
    public function init($arr = array()) {
        $this->arr = $arr;
        $this->ret = '';
        return is_array($arr);
    }

    public function get_parent($myid) {
        $newarr = array();
        if (!isset($this->arr[$myid]))
            return false;
        $pid = $this->arr[$myid]['fup'];
        $pid = $this->arr[$pid]['fup'];
        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {
                if ($a['fup'] == $pid)
                    $newarr[$id] = $a;
            }
        }
        return $newarr;
    }

    public function get_child($myid) {
        $a = $newarr = array();
        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {
                if ($a['fup'] == $myid)
                    $newarr[$id] = $a;
            }
        }
        return $newarr ? $newarr : false;
    }

    public function get_all_child($myid) {
        $number = 1;
        $child = $this->get_child($myid);
        if (is_array($child)) {
            $total = count($child);
            foreach ($child as $id => $value) {
                $this->child[]= $value;
                $this->get_all_child($value['fid']);
                $number++;
            }
        }
        return $this->child;
    }

    public function get_pos($myid, &$newarr) {
        $a = array();
        if (!isset($this->arr[$myid]))
            return false;
        $newarr[] = $this->arr[$myid];
        $pid = $this->arr[$myid]['fup'];
        if (isset($this->arr[$pid])) {
            $this->get_pos($pid, $newarr);
        }
        if (is_array($newarr)) {
            krsort($newarr);
            foreach ($newarr as $v) {
                $a[$v['fid']] = $v;
            }
        }
        return $a;
    }

    public function get_tree_array($myid) {
        $retarray = array();
        $child = $this->get_child($myid);
        if (is_array($child)) {
            $total = count($child);
            foreach ($child as $id => $value) {
                @extract($value);
                $retarray[$id] = $value;
                $retarray[$id]["child"] = $this->get_tree_array($id, '');
            }
        }
        return $retarray;
    }

    private function have($list, $item) {
        return(strpos(',,' . $list . ',', ',' . $item . ','));
    }
}