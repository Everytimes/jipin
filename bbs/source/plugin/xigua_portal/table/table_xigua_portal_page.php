<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/14
 * Time: 14:25
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * Class table_xigua_portal_page
 */
class table_xigua_portal_page extends discuz_table
{
    public $setting_table;

    public function __construct()
    {
        $this->_table = 'xigua_portal_page';
        $this->setting_table = 'xigua_portal_setting';
        $this->_pk = 'pid';

        parent::__construct();
    }

    public function multi_delete($ids)
    {
        if (empty($ids)) {
            return FALSE;
        }
        $ids = dintval($ids, TRUE);

        DB::query("DELETE FROM %t WHERE $this->_pk IN (" . dimplode($ids) . ')', array($this->_table));
        DB::query("DELETE FROM %t WHERE $this->_pk IN (" . dimplode($ids) . ')', array($this->setting_table));

        return TRUE;
    }
}