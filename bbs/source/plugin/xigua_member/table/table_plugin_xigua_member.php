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

class table_plugin_xigua_member extends  discuz_table
{
    public $_table_count;

    public function __construct()
    {
        $this->_table = 'plugin_xigua_member';
        $this->_table_count = 'plugin_xigua_member_count';
        $this->_pk = 'logid';

        parent::__construct();
    }

    public function svae_log($uid, $oldname, $newname, $usetype)
    {
        if(!$this->check_counter($uid))
        {
            DB::query("INSERT INTO %t SET uid=%d, counter=1", array(
                $this->_table_count,
                $uid
            ));
        }
        else
        {
            DB::query("UPDATE %t SET `counter`=`counter`+1 WHERE uid=%d", array(
                $this->_table_count,
                $uid
            ));
        }
        DB::insert($this->_table, array(
            'uid'    => $uid,
            'crts'   => time(),
            'oldname' => $oldname,
            'newname' => $newname,
            'usetype' => $usetype,
        ));
        return TRUE;
    }

    public function check_counter($uid){
        return DB::result_first("SELECT uid FROM %t WHERE uid=%d LIMIT 1", array(
            $this->_table_count,
            $uid
        ));
    }

    public function read_count($uid)
    {
        return DB::result_first("SELECT counter FROM %t WHERE uid=%d LIMIT 1", array(
            $this->_table_count,$uid
        ));
    }

    public function fetch_by_page($start_limit , $lpp){
        $result = DB::fetch_all('SELECT * FROM '.DB::table($this->_table)." ORDER BY logid DESC " . DB::limit($start_limit, $lpp));
        return $result;
    }
    public function total(){
        $result = DB::result_first('SELECT count(*) as c FROM '.DB::table($this->_table));
        return $result;
    }
    public function multi_delete($ids)
    {
        if(empty($ids)){
            return FALSE;
        }
        return DB::query("DELETE FROM %t WHERE logid IN (" . dimplode($ids) . ')', array($this->_table));
    }
}