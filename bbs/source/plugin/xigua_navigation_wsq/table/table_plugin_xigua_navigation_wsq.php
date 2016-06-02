<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: table_common_connect_guest.php 29265 2012-03-31 06:03:26Z yexinhao $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_plugin_xigua_navigation_wsq extends  discuz_table
{

    public function __construct() {
        $this->_table = 'plugin_xigua_navigation_wsq';
        $this->_pk = 'id';

        parent::__construct();
    }

    public function save($data)
    {

        foreach ($data as $row) {
            if(empty($row['name']) || empty($row['link'])){
                continue;
            }
            DB::query('INSERT INTO %t SET available=%d, displayorder=%d, `type`=%d, `name`=%s, `link`=%s, `fids`=%s',
                array(
                    $this->_table,
                    1,
                    $row['displayorder'],
                    $row['type'],
                    $row['name'],
                    $row['link'],
                    $row['fids'],
                ));
        }

        return TRUE;
    }

    public function multi_update($data)
    {
        foreach ($data as $id => $row) {
            $row['fids'] = implode(',', array_filter($row['fids']));
            DB::query('UPDATE %t SET available=%d, displayorder=%d, `type`=%d, `name`=%s, `link`=%s,`fids`=%s WHERE id=%d',
                array(
                    $this->_table,
                    1,
                    $row['displayorder'],
                    $row['type'],
                    $row['name'],
                    $row['link'],
                    $row['fids'],
                    $id
                ));
        }
        return TRUE;
    }

    public function multi_delete($ids)
    {
        if(empty($ids)){
            return FALSE;
        }
        return DB::query("DELETE FROM %t WHERE id IN (" . dimplode($ids) . ')', array($this->_table));
    }

    public function fetch_all_navs($avai = null, $fid = 0){
        if($avai !== null){
            $avai = ' WHERE available=' . intval($avai);
        }else{
            $avai = '';
        }
        $fids = '';
        if($fid){
            $fid = intval($fid);
            $fids = ($avai ? ' AND ' :' WHERE ') . " FIND_IN_SET($fid, fids) OR FIND_IN_SET(-1, fids)";
        }
        $result = DB::fetch_all('SELECT * FROM '.DB::table($this->_table)." $avai $fids ORDER BY displayorder ASC");
        return $result;
    }

    public function fetch_all_navs_page($start_limit , $lpp){
        $result = DB::fetch_all('SELECT * FROM '.DB::table($this->_table)." ORDER BY id ASC " . DB::limit($start_limit, $lpp));
        return $result;
    }
    public function fetch_all_navs_count(){
        $result = DB::result_first('SELECT count(*) as c FROM '.DB::table($this->_table));
        return $result;
    }
}