<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
} 

class table_tom_weixin_submenu extends discuz_table{
	public function __construct() {
        parent::__construct();
		$this->_table = 'tom_weixin_submenu';
		$this->_pk    = 'id';
	}

    public function fetch_by_id($id,$field='*') {
		return DB::fetch_first("SELECT $field FROM %t WHERE id=%d", array($this->_table, $id));
	}
	
	public function fetch_all_list($field='*',$where='',$limit=0) {
        $whereStr = '';
        if(!empty($where)){
            $whereStr = ' WHERE '.$where;
        }
        $limitStr = '';
        if(!empty($limit)){
            $limitStr = ' LIMIT '.$limit;
        }
		return DB::fetch_all("SELECT $field FROM %t $whereStr ORDER BY paixu ASC $limitStr ", array($this->_table));
	}
	
	public function delete_by_id($id) {
		return DB::query("DELETE FROM %t WHERE id=%d", array($this->_table, $id));
	}

}


?>
