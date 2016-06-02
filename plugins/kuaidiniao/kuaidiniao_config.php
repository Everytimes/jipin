<?php
/**
 * Created by PhpStorm.
 * User: dsheldon
 * Date: 2016/5/30
 * Time: 11:34
 */
//快递鸟物流查询

$apikey='a60bdce2-abc4-40f8-8164-c5edf2100ae3';//是申请的快递鸟接口apikey;
$ebusinessid=1257990;//快递鸟公司id编号，为固定值；
$requrl='http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx';//去请求接口地址；
//在这里将这几个数据全部定义为变量，方便修改；在php接口文件出修改，快递鸟接口文件内将这几个是数据转换成常量了；

//提示，每个物流查询接口的快递公司编号基本都不一样的，这里要自己到接口官网去查询最新的物流公司编码；


switch($getcom)
{
    case "EMS国内邮政特快专递"://ecshop后台中显示的快递公司；
        $shipperCode='EMS';
        break;
    case "中国邮政":
        $shipperCode='YZPY';//这个这里用的是快递鸟内的中国平邮的常量；如有问题可以在修改；
        break;
    case "申通快递":
        $shipperCode='STO';
        break;
    case "圆通速递":
        $shipperCode='YTO';
        break;
    case "顺丰速运":
        $shipperCode='SF';
        break;
    case "天天快递":
        $shipperCode='HHTT';
        break;
    case "中通速递":
        $shipperCode='ZTO';
        break;
    case "宅急送":
        $shipperCode="ZJS";
        break;
    case "汇通快递":
        $shipperCode='HTKY';
        break;
    case "优速快递":
        $shipperCode='UC';
        break;
    case "韵达快递":
        $shipperCode='YD';
    default:
        $shipperCode='';

}

