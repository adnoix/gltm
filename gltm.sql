/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : gltm

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-06-27 14:01:43
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `gltm_aboutus`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_aboutus`;
CREATE TABLE `gltm_aboutus` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `detail` text CHARACTER SET utf8 COMMENT '关于我们内容',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_aboutus
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_admin`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_admin`;
CREATE TABLE `gltm_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `admin_name` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '登录名',
  `admin_pwd` varchar(40) CHARACTER SET utf8 NOT NULL COMMENT '密码',
  `last_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '登录IP',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态，1启用，2禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_admin
-- ----------------------------
INSERT INTO gltm_admin VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1467006269', '127.0.0.1', '1');

-- ----------------------------
-- Table structure for `gltm_area`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_area`;
CREATE TABLE `gltm_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '地区名称',
  `pid` int(11) DEFAULT NULL COMMENT '父id',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_area
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_comment`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_comment`;
CREATE TABLE `gltm_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) DEFAULT NULL COMMENT '景点id',
  `type` int(11) DEFAULT NULL COMMENT '类型 1-景点 2-景区',
  `comment_detail` text CHARACTER SET utf8 COMMENT '评论内容',
  `comment_uid` int(11) DEFAULT NULL COMMENT '用户id',
  `score_all` int(11) DEFAULT NULL COMMENT '评分',
  `scenery_score` int(11) DEFAULT NULL COMMENT '景色评分',
  `service_score` int(11) DEFAULT NULL COMMENT '服务评分',
  `public_score` int(11) DEFAULT NULL COMMENT '公共设施评分',
  `comment_ctime` int(11) DEFAULT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_comment_img`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_comment_img`;
CREATE TABLE `gltm_comment_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `cid` int(11) DEFAULT NULL COMMENT '评论id',
  `img` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '评论图片地址',
  `ctime` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_comment_img
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_favorite`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_favorite`;
CREATE TABLE `gltm_favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sid` int(11) DEFAULT NULL COMMENT '景点id',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_favorite
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_feedback`;
CREATE TABLE `gltm_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `feedback_detail` text CHARACTER SET utf8 COMMENT '反馈详情',
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '手机号',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `ctime` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_feedback
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_line`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_line`;
CREATE TABLE `gltm_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `line_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '线路名称',
  `line_level` int(11) DEFAULT NULL COMMENT '线路等级',
  `line_day` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '游玩天数',
  `line_brief` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '行程简介首页',
  `line_favorite` int(11) DEFAULT NULL COMMENT '收藏数',
  `line_introduce` text CHARACTER SET utf8 COMMENT '行程简介',
  `line_outline` text CHARACTER SET utf8 COMMENT '行程概要',
  `line_detail` text CHARACTER SET utf8 COMMENT '行程详情',
  `line_longitude` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '经度',
  `line_latitude` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '纬度',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_line
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_login`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_login`;
CREATE TABLE `gltm_login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `uid` int(11) NOT NULL COMMENT '用户UID',
  `oauth_token` varchar(150) CHARACTER SET utf8 DEFAULT NULL COMMENT '授权账号',
  `oauth_token_secret` varchar(150) CHARACTER SET utf8 DEFAULT NULL COMMENT '授权密码',
  PRIMARY KEY (`login_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_login
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_scenicarea`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_scenicarea`;
CREATE TABLE `gltm_scenicarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `scenicarea_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '景区名称',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_scenicarea
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_sms`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_sms`;
CREATE TABLE `gltm_sms` (
  `phone` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '手机号码',
  `code` int(5) NOT NULL DEFAULT '0' COMMENT '验证码',
  `message` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '消息',
  `time` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_sms
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_spot`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_spot`;
CREATE TABLE `gltm_spot` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `spot_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '景点名称',
  `spot_img` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '景点图片',
  `area_id` int(11) DEFAULT NULL COMMENT '地区id',
  `scenicarea_id` int(11) DEFAULT NULL COMMENT '景区id',
  `spot_level` int(11) DEFAULT NULL COMMENT '景点等级',
  `spot_price` int(11) DEFAULT NULL COMMENT '门票价格',
  `spot_limit` int(11) DEFAULT NULL COMMENT '人数预警值',
  `advise_time` text CHARACTER SET utf8 COMMENT '建议游玩时间',
  `spot_tel` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '景点电话',
  `spot_address` text CHARACTER SET utf8 COMMENT '景点地址',
  `spot_favorite` int(11) DEFAULT NULL COMMENT '景点收藏数',
  `spot_comment` int(11) DEFAULT NULL COMMENT '评论数',
  `spot_culture` text CHARACTER SET utf8 COMMENT '风情文化',
  `spot_introduce` text CHARACTER SET utf8 COMMENT '景点简介',
  `recommend` int(11) DEFAULT '0' COMMENT '是否推荐 0-不推荐 1-推荐',
  `spot_longitude` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '经度',
  `spot_latitude` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '纬度',
  `ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_spot
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_spot_img`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_spot_img`;
CREATE TABLE `gltm_spot_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sid` int(11) DEFAULT NULL COMMENT '景点id',
  `img_src` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '景点图片地址',
  `favorite` int(11) DEFAULT '0' COMMENT '点赞数',
  `img_detail` text CHARACTER SET utf8 COMMENT '图片描述',
  `img_season` int(11) DEFAULT '0' COMMENT '季节 1-春 2-夏 3-秋 4-东',
  `img_ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_spot_img
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_spot_slide`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_spot_slide`;
CREATE TABLE `gltm_spot_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sid` int(11) DEFAULT NULL COMMENT '景点id',
  `slide_img` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '景点图片地址',
  `type` int(11) DEFAULT NULL COMMENT '类型 1-景点 2-景区',
  `slide_ctime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_spot_slide
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_spot_video`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_spot_video`;
CREATE TABLE `gltm_spot_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sid` int(11) DEFAULT NULL COMMENT '景点id',
  `video_src` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '视频地址',
  `video_type` int(11) DEFAULT '0' COMMENT '季节 1-春 2-夏 3-秋 4-冬',
  `video_detail` text COMMENT '视频详情',
  `video_time` int(11) DEFAULT NULL COMMENT '视频时长',
  `video_favorite` int(11) DEFAULT NULL COMMENT '点赞数',
  `video_ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_spot_video
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_spot_voice`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_spot_voice`;
CREATE TABLE `gltm_spot_voice` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sid` int(11) DEFAULT NULL COMMENT '景点id',
  `voice_src` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '语音地址',
  `voice_type` int(11) DEFAULT NULL COMMENT '类型 1-语音 2-入口 3-厕所 4-出口',
  `voice_ctime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_spot_voice
-- ----------------------------

-- ----------------------------
-- Table structure for `gltm_user`
-- ----------------------------
DROP TABLE IF EXISTS `gltm_user`;
CREATE TABLE `gltm_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_phone` int(11) DEFAULT NULL COMMENT '手机号',
  `user_password` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '密码',
  `user_salt` char(5) CHARACTER SET utf8 DEFAULT NULL COMMENT '10000 到 99999之间的随机数，加密密码时使用',
  `user_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '昵称',
  `user_avatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '头像地址',
  `user_email` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '邮箱',
  `user_sex` int(1) DEFAULT '0' COMMENT '性别 1：男、2：女',
  `user_ip` varchar(64) CHARACTER SET utf8 DEFAULT '127.0.0.1' COMMENT 'IP',
  `user_ctime` int(11) DEFAULT NULL COMMENT '注册时间',
  `user_longitude` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '经度',
  `user_latitude` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '纬度',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of gltm_user
-- ----------------------------
