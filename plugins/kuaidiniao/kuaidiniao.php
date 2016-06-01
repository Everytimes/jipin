<?php
/**
 *
 * 快递鸟物流轨迹即时查询接口
 *
 * @author: CQ
 * @qq: 1069712970
 * @see: http://www.kdniao.com/YundanChaxunAPI.aspx
 * @copyright: 深圳市快金数据技术服务有限公司
 *
 * DEMO中的电商ID与私钥仅限测试使用，正式环境请单独注册账号
 * 单日超过500单查询量，建议接入我方物流轨迹订阅推送接口
 *
 * ID和Key请到官网申请：http://www.kdniao.com/ServiceApply.aspx
 * 测试ID和KEY已经关闭
 * ID:1237100
 * KEY:518a73d8-1f7f-441a-b644-33e77b49d846
 */
header("Content-type: text/html; charset=utf-8");
define("IN_HHS",true);
require(dirname(__FILE__).'/../../includes/init.php');

$getcom=trim($_GET['com']);//快递公司编号；
$logisticCode=trim($_GET['nu']);//物流单号；

include_once('kuaidiniao_config.php');

$smarty->assign('expressid', $_GET["com"] );
$smarty->assign('expressno', $_GET["nu"] );

//电商ID
define('EBusinessID','1257990');
//电商加密私钥，快递鸟提供，注意保管，不要泄漏
define('AppKey','a60bdce2-abc4-40f8-8164-c5edf2100ae3');// or define('AppKey', '请到快递鸟官网申请http://www.kdniao.com/ServiceApply.aspx');
//请求url
define('ReqURL','http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx');// or define('ReqURL', 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx');

//调用获取物流轨迹
//-------------------------------------------------------------

    $logisticResult = getOrderTracesByJson($shipperCode, $logisticCode);


//-------------------------------------------------------------

    $express=json_decode($logisticResult, true);
    if($express['Success']){
        if($express['State']=='3'){
            $result['resultcode']=200;
            foreach($express['Traces'] as $key=>$value)
            {
                $result['result']['list'][$key]['datetime']=$value['AcceptTime'];
                $result['result']['list'][$key]['remark']=$value['AcceptStation'];
                $result['result']['list'][$key]['zone']=$value['Remark'];
            }

        }else{
            if(isset($express['Reason'])){
                $result['reason']=$express['Reason'];
                $result['resultcode']=200;
                $result['result']['list']='';
            }
        }
        $smarty->assign('express', $result );
        $strresult=$smarty->fetch('library/express.lbi');
        echo json_encode($strresult);
    }
    else{
        echo "查询失败，请重试";
    }



/**
 * Json方式 查询订单物流轨迹
 */
function getOrderTracesByJson($shipperCode, $logisticCode){
	$requestData= "{\"OrderCode\":\"\",\"ShipperCode\":\"".$shipperCode."\",\"LogisticCode\":\"".$logisticCode."\"}";
	$datas = array(
        'EBusinessID' => EBusinessID,
        'RequestType' => '1002',
        'RequestData' => urlencode($requestData) ,
        'DataType' => '2',
    );
    $datas['DataSign'] = encrypt($requestData, AppKey);
	$result=sendPost(ReqURL, $datas);
	
	//根据公司业务处理返回的信息......
	
	return $result;
}

/**
 * XML方式 查询订单物流轨迹
 */
/*function getOrderTracesByXml(){
	$requestData= "<?xml version=\"1.0\" encoding=\"utf-8\" ?>".
						"<Content>".
						"<OrderCode></OrderCode>".
						"<ShipperCode>SF</ShipperCode>".
						"<LogisticCode>589707398027</LogisticCode>".
						"</Content>";
	
	$datas = array(
        'EBusinessID' => EBusinessID,
        'RequestType' => '1002',
        'RequestData' => urlencode($requestData) ,
        'DataType' => '1',
    );
    $datas['DataSign'] = encrypt($requestData, AppKey);
	$result=sendPost(ReqURL, $datas);	
	
	//根据公司业务处理返回的信息......
	
	return $result;
}*/
 
/**
 *  post提交数据 
 * @param  string $url 请求Url
 * @param  array $datas 提交的数据 
 * @return url响应返回的html
 */
function sendPost($url, $datas) {
    $temps = array();	
    foreach ($datas as $key => $value) {
        $temps[] = sprintf('%s=%s', $key, $value);		
    }	
    $post_data = implode('&', $temps);
    $url_info = parse_url($url);
    $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
    $httpheader.= "Host:" . $url_info['host'] . "\r\n";
    $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
    $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
    $httpheader.= "Connection:close\r\n\r\n";
    $httpheader.= $post_data;
    $fd = fsockopen($url_info['host'], 80);
    fwrite($fd, $httpheader);
    $gets = "";
	$headerFlag = true;
	while (!feof($fd)) {
		if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
			break;
		}
	}
    while (!feof($fd)) {
		$gets.= fread($fd, 128);
    }
    fclose($fd);    
    
    return $gets;
}

/**
 * 电商Sign签名生成
 * @param data 内容   
 * @param appkey Appkey
 * @return DataSign签名
 */
function encrypt($data, $appkey) {
    return urlencode(base64_encode(md5($data.$appkey)));
}

?>