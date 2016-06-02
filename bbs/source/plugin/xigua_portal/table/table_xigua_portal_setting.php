<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/9
 * Time: 14:25
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * Class table_xigua_portal_setting
 */
class table_xigua_portal_setting extends discuz_table
{

    public function __construct()
    {
        $this->_table = 'xigua_portal_setting';
        $this->_pk = 'id';

        parent::__construct();
    }

    public function list_all($pid)
    {
        $data = array();
        $query = DB::query('SELECT * FROM %t WHERE pid=%d ORDER BY displayorder ASC, id ASC', array($this->_table, $pid));
        while ($value = DB::fetch($query)) {
            $data[ $value['type'] . '_' . $value[ $this->_pk ] ] = $value;
        }

        return $data;
    }
}