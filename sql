ALTER TABLE `hhs_goods`   
  ADD COLUMN  `lab_qgby` varchar(100) NOT NULL,
  ADD COLUMN  `lab_zpbz` varchar(100) NOT NULL,
  ADD COLUMN  `lab_qtth` varchar(100) NOT NULL,
  ADD COLUMN  `lab_jkbs` varchar(100) NOT NULL,
  ADD COLUMN  `lab_hwzy` varchar(100) NOT NULL,
  ADD COLUMN  `is_luck` tinyint(1) DEFAULT '0' COMMENT '抽奖产品',
  ADD COLUMN  `luck_num` TINYINT(1) DEFAULT 0  NULL   COMMENT '中奖人数',
  ADD COLUMN  `luck_times` smallint(5) NULL COMMENT '抽奖期数' AFTER `luck_num`,
  ADD COLUMN  `is_miao` tinyint(1) DEFAULT '0' COMMENT '秒杀产品',


ALTER TABLE `hhs_cart`   
  ADD COLUMN  `is_luck` tinyint(1) DEFAULT '0' COMMENT '抽奖产品',
  ADD COLUMN  `luck_times` SMALLINT(5) NULL   COMMENT '抽奖期数' AFTER `is_luck`,
  ADD COLUMN  `is_miao` tinyint(1) DEFAULT '0' COMMENT '秒杀产品',


ALTER TABLE `hhs_order_info`   
  ADD COLUMN  `is_luck` tinyint(1) DEFAULT '0' COMMENT '抽奖产品',
  ADD COLUMN  `is_lucker` tinyint(1) DEFAULT '0' COMMENT '幸运者',
  ADD COLUMN  `is_hongbao_back` tinyint(1) DEFAULT '0' COMMENT '是否已经微信红包退款',
  ADD COLUMN  `luck_times` smallint(5) DEFAULT NULL COMMENT '抽奖期数',
  ADD COLUMN  `is_miao` tinyint(1) DEFAULT '0' COMMENT '秒杀产品',
