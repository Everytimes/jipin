<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_reprint_thread extends discuz_table
{
	public function __construct() {
		$this->_table = 'reprint_thread';
		$this->_pk = 'tid';
		parent::__construct();
	}

    public function query()
    {
        $return = array(
            "totalProperty" => 0,
            "root" => array(),
        );
        $sort  = isset($_REQUEST["sort"]) ? $_REQUEST["sort"] : "ctime";
        $dir   = isset($_REQUEST["dir"]) ? $_REQUEST["dir"] : "DESC";
        $start = isset($_REQUEST["start"]) ? $_REQUEST["start"] : 0;
        $limit = isset($_REQUEST["limit"]) ? $_REQUEST["limit"] : 0;
        $where = "1";
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.tid,a.fromurl,a.op,a.ctime,b.subject ".
               "FROM ".DB::table($this->_table)." AS a left join ".DB::table('forum_thread')." AS b on a.tid=b.tid ".
               "WHERE $where ".
               "ORDER BY `$sort` $dir";
        if ($limit>0) $sql.= " LIMIT $start,$limit";
        $query = DB::query($sql);
		while($row = DB::fetch($query)) {
            $row["subject"] = iconv(CHARSET, "UTF-8//ignore", $row["subject"]);
			$return["root"][] = $row;
		}
        $query = DB::query("select FOUND_ROWS() AS total");
        if ($row = DB::fetch($query)) {
            $return["totalProperty"] = $row["total"];
        }
        return $return;
    }

    public function getThreadByUrl($url)
    {
        $sql = "SELECT tid,fromurl,op,ctime FROM ".DB::table($this->_table)." WHERE fromurl='$url'";
        return DB::fetch_first($sql);
    }

    public function addThread($tid, $url, $op)
    {
        $data = array (
            'tid' => $tid,
            'fromurl' => $url,
            'op' => $op,
            'ctime' => date("Y-m-d H:i:s")
        );
        DB::insert($this->_table,$data);
    }

    public function del()
    {
        $tid = isset($_REQUEST["tid"]) ? intval($_REQUEST["tid"]) : 0;
        if ($tid==0) {
            throw new Exception('tid is not set');
        }
        $sql = "DELETE FROM ".DB::table($this->_table)." WHERE tid='$tid'";
        runlog('reprint', "[sql: $sql]");
        DB::query($sql);
    }
}

?>
