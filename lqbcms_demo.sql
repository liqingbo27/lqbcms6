/*
 Navicat MySQL Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : 127.0.0.1:3306
 Source Schema         : lqbcms_demo

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 29/04/2021 15:29:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for lqbcms_admin
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_admin`;
CREATE TABLE `lqbcms_admin`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` smallint(3) UNSIGNED NOT NULL DEFAULT 0,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `nickname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `avatar` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '头像',
  `openid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `last_login_time` int(10) UNSIGNED NULL DEFAULT NULL,
  `last_login_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `login_count` mediumint(8) UNSIGNED NULL DEFAULT 0,
  `verify` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `address` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `delete_time` int(10) NOT NULL DEFAULT 0,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `sort` smallint(6) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `account`(`username`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_admin
-- ----------------------------
INSERT INTO `lqbcms_admin` VALUES (1, 1, 'admin', 'admin', '$2y$10$cppkARXh/YjWB1gTP0iOMO/XPr184LtSL3MTpuBdqDq77KxX.0nU2', '', '', NULL, NULL, 0, NULL, '18888888888', '', '', '', 1578990973, 1578990973, 0, 0, 0);

-- ----------------------------
-- Table structure for lqbcms_advert
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_advert`;
CREATE TABLE `lqbcms_advert`  (
  `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `url` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `filepath` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `file_type` tinyint(1) NOT NULL DEFAULT 1,
  `place` smallint(6) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT 0,
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(10) NOT NULL DEFAULT 0,
  `delete_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lqbcms_advert_place
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_advert_place`;
CREATE TABLE `lqbcms_advert_place`  (
  `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `placename` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `w` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '宽',
  `h` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '高',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `sort` smallint(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_advert_place
-- ----------------------------
INSERT INTO `lqbcms_advert_place` VALUES (1, '首页轮播', '1000', '430', 0, 1);
INSERT INTO `lqbcms_advert_place` VALUES (2, '约游-小程序轮播图', '1000', '430', 0, 2);
INSERT INTO `lqbcms_advert_place` VALUES (3, '直卖-小程序轮播图', '750', '1334', 0, 3);

-- ----------------------------
-- Table structure for lqbcms_cases
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_cases`;
CREATE TABLE `lqbcms_cases`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发布者UID',
  `item_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '产品ID',
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '所在分类',
  `special_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '新闻标题',
  `thumb` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `keywords` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章关键字',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章描述',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `clicks` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `like` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `tag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `r` tinyint(1) NOT NULL DEFAULT 0,
  `h` tinyint(1) NOT NULL DEFAULT 0,
  `t` tinyint(1) NOT NULL DEFAULT 0,
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `delete_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '案例表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_cases
-- ----------------------------
INSERT INTO `lqbcms_cases` VALUES (5, 'zh', 1, 0, 3, 0, '分析检测', '/storage/cases/20200207/30c2ba6d3999c6338cf3c88514b1e595.jpg', '公司注销流程三步走', '公司注销流程三步走', '', 139, 0, 1, '', 1, 0, 0, 1581039675, 1553931877, 0);
INSERT INTO `lqbcms_cases` VALUES (3, 'zh', 1, 0, 1, 0, '分析检测', '/storage/cases/20200207/a6c5ea82d1d3193be5c4e8f6de81439c.jpg', '公司被吊销的后果', '公司被吊销的后果', '', 120, 0, 1, '', 1, 0, 0, 1581039690, 1553931593, 0);
INSERT INTO `lqbcms_cases` VALUES (6, 'zh', 1, 0, 3, 0, '分析检测', '/storage/cases/20200207/7f479225edc31d1d070bcd0dabba7644.jpg', '注册公司注意这五点', '创业走出的第一步就是公司注册。有的人可能觉得公司注册非常简单，花点钱找个中介机构就可以搞定。这有一定道理，与布满荆棘的创业之路比起来，公司注册确实要简单很多。据统计，去年平均每天新登记企业1.2万户，换个角度思考，每天大约有1.2万人注册公司，开启创业之路。但是很多人出师不利，并没有走好第一步，甚至为以后的发展埋下大隐患。公司注册有很多不容忽视的问题，需要创业者关注!', '', 157, 0, 1, '', 1, 0, 0, 1581039658, 1553931898, 0);
INSERT INTO `lqbcms_cases` VALUES (9, 'zh', 1, 0, 2, 0, '水质采样', '/storage/cases/20200207/9b39c95d8f1a98cc2b7d81e7f7183d5e.jpg', '公司不注销对法人股东有什么影响？', '公司吊销：吊销只是一个过程，公司即使被吊销了营业执照，虽然不能经营，做还是存在的，还要承担相应的债权债务。', '', 338, 0, 1, '', 1, 0, 1, 1581039370, 1553937083, 0);
INSERT INTO `lqbcms_cases` VALUES (10, 'zh', 1, 0, 2, 0, '大气采样', '/storage/cases/20200207/e9311b596c6d2b1e6af779d04119d8c5.jpg', '注销问答', ' 注销问答 2', ' <p><br></p> ', 81, 0, 1, '', 0, 0, 0, 1581039354, 1562913254, 0);
INSERT INTO `lqbcms_cases` VALUES (11, 'zh', 1, 0, 1, 0, '分析检测', '/storage/cases/20200207/cc42a17ad3309506d4b10abcca531340.jpg', '什么是软著 有什么用 怎么申请呢 ', '现在什么行业最火，肯定是互联网行业！没错！在“互联网+”、“人工智能”、“万物智联”的号召下，不少行业也纷纷“转型升级”，主动拥抱互联网。', '', 308, 0, 1, '', 0, 0, 0, 1581039325, 1563112333, 0);

-- ----------------------------
-- Table structure for lqbcms_cases_category
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_cases_category`;
CREATE TABLE `lqbcms_cases_category`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) UNSIGNED NULL DEFAULT 0 COMMENT 'parentCategory上级分类',
  `level` tinyint(1) NULL DEFAULT 0 COMMENT '分类级别',
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类名称',
  `keywords` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `articlenum` int(10) NULL DEFAULT 0,
  `sort` smallint(8) NULL DEFAULT 0,
  `status` tinyint(1) UNSIGNED NULL DEFAULT 1,
  `tag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '案例分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_cases_category
-- ----------------------------
INSERT INTO `lqbcms_cases_category` VALUES (1, 0, 0, '监测流程', NULL, NULL, 0, 1, 1, NULL);
INSERT INTO `lqbcms_cases_category` VALUES (2, 0, 0, '送检流程', NULL, NULL, 0, 2, 1, NULL);
INSERT INTO `lqbcms_cases_category` VALUES (3, 0, 0, '报告查询', NULL, NULL, 0, 3, 1, NULL);

-- ----------------------------
-- Table structure for lqbcms_file
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_file`;
CREATE TABLE `lqbcms_file`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `cid` smallint(6) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类ID',
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `savename` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `savepath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `extension` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `size` int(11) NOT NULL,
  `download` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '下载数',
  `views` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '浏览数',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for lqbcms_link
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_link`;
CREATE TABLE `lqbcms_link`  (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `group_id` smallint(3) UNSIGNED NOT NULL DEFAULT 1,
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qq` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rel` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `views` int(1) UNSIGNED NOT NULL DEFAULT 0,
  `sort` smallint(5) NOT NULL DEFAULT 0,
  `update_time` int(10) UNSIGNED NULL DEFAULT NULL,
  `create_time` int(10) UNSIGNED NULL DEFAULT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `keyword_count` int(11) NOT NULL DEFAULT 0 COMMENT '关键词数',
  `br` tinyint(1) NOT NULL DEFAULT 0 COMMENT '权重',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lqbcms_member
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_member`;
CREATE TABLE `lqbcms_member`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_id` smallint(6) NOT NULL DEFAULT 0 COMMENT '1为分校联盟，2为赏金猎人',
  `role_id` smallint(3) UNSIGNED NOT NULL DEFAULT 0,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `phone` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `address` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `company` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `last_login_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `last_login_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `login_count` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `sort` smallint(6) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `account`(`username`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 83 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_member
-- ----------------------------
INSERT INTO `lqbcms_member` VALUES (75, 0, 0, 'q3kfahd9', 1, '李清波', '18889363060', '', '', '', '', 0, '', 0, '', 1579247305, 1579247305, 0, 0);
INSERT INTO `lqbcms_member` VALUES (76, 0, 0, 'e3zesd8g', 1, '莫卓才', '13322072702', '', '', '', '', 0, '', 0, '', 1579253177, 1579253177, 0, 0);
INSERT INTO `lqbcms_member` VALUES (77, 0, 0, 'dqymbt91', 1, '卓良晟', '13976482614', '', '', '', '', 0, '', 0, '', 1579253191, 1579253191, 0, 0);
INSERT INTO `lqbcms_member` VALUES (82, 0, 0, 'mjsljh6u', 1, '许至亲', '15500955259', '', '', '', '', 0, '', 0, '', 1582532945, 1582532945, 0, 0);
INSERT INTO `lqbcms_member` VALUES (81, 0, 0, 's1ml7ys7', 1, '1', '1', '1', '', '', '', 0, '', 0, '', 1582376335, 1582376335, 0, 0);

-- ----------------------------
-- Table structure for lqbcms_menu
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_menu`;
CREATE TABLE `lqbcms_menu`  (
  `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '一级菜单标题',
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '二级菜单名称（与视图的文件夹名称和路由路径对应）',
  `icon` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '一级菜单图标样式',
  `jump` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '自定义一级菜单路由地址，默认按照 name 解析。一旦设置，将优先按照 jump 设定的路由跳转',
  `spread` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'true //是否默认展子菜单',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `sort` smallint(6) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_menu
-- ----------------------------
INSERT INTO `lqbcms_menu` VALUES (1, 0, '主页', '', 'layui-icon-home', '', NULL, 1, 0);
INSERT INTO `lqbcms_menu` VALUES (2, 1, '控制台', '', '/', '', NULL, 1, 0);
INSERT INTO `lqbcms_menu` VALUES (5, 0, '新闻管理', 'news', 'layui-icon-list', '/news/list', '', 1, 0);
INSERT INTO `lqbcms_menu` VALUES (6, 5, '新闻列表', 'news', 'layui-icon-list', '/news/list', '', 1, 0);
INSERT INTO `lqbcms_menu` VALUES (7, 0, '单页管理', 'singlepage', 'layui-icon-list', '/singlepage/list', NULL, 1, 90);
INSERT INTO `lqbcms_menu` VALUES (8, 5, '资讯列表', 'news', '', '/news/list', NULL, 0, 0);
INSERT INTO `lqbcms_menu` VALUES (9, 6, '案例列表', 'cases', '', '/cases/list', NULL, 0, 0);
INSERT INTO `lqbcms_menu` VALUES (10, 0, '设置', 'set', 'layui-icon-set', '', NULL, 1, 99);
INSERT INTO `lqbcms_menu` VALUES (11, 10, '基础设置', 'set', '', '/set/base', NULL, 1, 0);
INSERT INTO `lqbcms_menu` VALUES (12, 5, '资讯分类', 'news', '', '/news/category', NULL, 0, 0);
INSERT INTO `lqbcms_menu` VALUES (13, 6, '案例分类', 'cases', '', '/cases/category', NULL, 0, 0);
INSERT INTO `lqbcms_menu` VALUES (14, 5, '新闻分类', 'service', 'layui-icon-list', '/news/category', '', 1, 2);
INSERT INTO `lqbcms_menu` VALUES (16, 0, '友情链接', 'recruit', 'layui-icon-list', '/friendlink/list', '', 1, 91);
INSERT INTO `lqbcms_menu` VALUES (18, 0, '广告管理', 'advert', 'layui-icon-list', '/advert/list', NULL, 1, 91);
INSERT INTO `lqbcms_menu` VALUES (20, 10, '菜单设置', 'menu', '', '/menu/list', NULL, 1, 3);
INSERT INTO `lqbcms_menu` VALUES (25, 10, 'SEO设置', 'seo', '', '/set/seo', NULL, 1, 2);

-- ----------------------------
-- Table structure for lqbcms_messages
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_messages`;
CREATE TABLE `lqbcms_messages`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `phone` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `nickname` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `create_time` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lqbcms_news
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_news`;
CREATE TABLE `lqbcms_news`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发布者UID',
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '所在分类',
  `special_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '新闻标题',
  `thumb` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `source` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `keywords` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章关键字',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章描述',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `clicks` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `like` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `tag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `recommended` tinyint(1) NOT NULL DEFAULT 0,
  `hotted` tinyint(1) NOT NULL DEFAULT 0,
  `topped` tinyint(1) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `delete_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '新闻表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_news
-- ----------------------------
INSERT INTO `lqbcms_news` VALUES (1, 'zh', 1, 2, 0, 'How to make a nice morning?', '/storage/news/20210429/0970afd276832b0f88a2eecd5b39987c.jpg', 'How to make a nice morning?', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt cursus leo nec placerat. Praesent facilisis elit libero, eget ornare turpis ultricies a. In in ex vel metus dignissim blandit non et eros. Integer ac viverra\n                         ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt cursus leo nec placerat. Praesent facilisis elit libero, eget ornare turpis ultricies a. In in ex vel metus dignissim blandit non et eros. Integer ac viverra</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; diam, nec euismod est. Sed sed nisl sit amet massa convallis dapibus...</p><p><br/></p>', 0, 0, 1, '', 1, 0, 1, 1, 1619681021, 1619366400, 0);
INSERT INTO `lqbcms_news` VALUES (2, 'zh', 1, 1, 0, 'Hot sand tunisia', '/storage/news/20210429/6626aa3cfa1b6c4eaa31892e89bc394f.jpg', 'a', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt cursus leo nec placerat. Praesent facilisis elit libero, eget ornare turpis ultricies a. In in ex vel metus dignissim blandit non et eros. Integer ac viverra\n                         ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt cursus leo nec placerat. Praesent facilisis elit libero, eget ornare turpis ultricies a. In in ex vel metus dignissim blandit non et eros. Integer ac viverra</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; diam, nec euismod est. Sed sed nisl sit amet massa convallis dapibus...</p><p><br/></p>', 1, 0, 1, '', 1, 0, 1, 0, 1619680630, 1619435395, 0);
INSERT INTO `lqbcms_news` VALUES (3, 'zh', 1, 1, 0, 'Where i find the best travel deals', '/storage/news/20210429/532cc90ad67c46df1ebbf7651946366b.jpg', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt cursus leo nec placerat. Praesent facilisis elit libero, eget ornare turpis ultricies a. In in ex vel metus dignissim blandit non et eros. Integer ac viverra\n                         ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt cursus leo nec placerat. Praesent facilisis elit libero, eget ornare turpis ultricies a. In in ex vel metus dignissim blandit non et eros. Integer ac viverra</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; diam, nec euismod est. Sed sed nisl sit amet massa convallis dapibus...</p><p><br/></p>', 0, 0, 1, '', 0, 0, 1, 0, 1619680606, 1619679307, 0);

-- ----------------------------
-- Table structure for lqbcms_news_category
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_news_category`;
CREATE TABLE `lqbcms_news_category`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) UNSIGNED NULL DEFAULT 0 COMMENT 'parentCategory上级分类',
  `level` tinyint(1) NULL DEFAULT 0 COMMENT '分类级别',
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类名称',
  `ename` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `keywords` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `articlenum` int(10) NULL DEFAULT 0,
  `sort` smallint(8) NULL DEFAULT 0,
  `status` tinyint(1) UNSIGNED NULL DEFAULT 1,
  `tag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '新闻分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_news_category
-- ----------------------------
INSERT INTO `lqbcms_news_category` VALUES (1, 0, 0, '生活随笔', NULL, NULL, NULL, 0, 1, 1, NULL);
INSERT INTO `lqbcms_news_category` VALUES (2, 0, 0, '美文欣赏', NULL, NULL, NULL, 0, 2, 1, NULL);

-- ----------------------------
-- Table structure for lqbcms_notice
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_notice`;
CREATE TABLE `lqbcms_notice`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'zh',
  `admin_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发布者UID',
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '所在分类',
  `special_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '新闻标题',
  `thumb` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `keywords` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章关键字',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章描述',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `clicks` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `like` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `tag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `r` tinyint(1) NOT NULL DEFAULT 0,
  `h` tinyint(1) NOT NULL DEFAULT 0,
  `t` tinyint(1) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `delete_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '公告' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lqbcms_notice_category
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_notice_category`;
CREATE TABLE `lqbcms_notice_category`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) UNSIGNED NULL DEFAULT 0 COMMENT 'parentCategory上级分类',
  `level` tinyint(1) NULL DEFAULT 0 COMMENT '分类级别',
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类名称',
  `ename` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `keywords` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `articlenum` int(10) NULL DEFAULT 0,
  `sort` smallint(8) NULL DEFAULT 0,
  `status` tinyint(1) UNSIGNED NULL DEFAULT 1,
  `tag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '公告分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lqbcms_recruit
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_recruit`;
CREATE TABLE `lqbcms_recruit`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发布者UID',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '岗位',
  `price_min` decimal(9, 0) NOT NULL DEFAULT 0,
  `price_max` decimal(9, 0) NOT NULL DEFAULT 0,
  `experience` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '工作经验',
  `education` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '学历',
  `age` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '年龄',
  `arrival` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '到岗',
  `marital` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '婚姻',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `clicks` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `like` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `r` tinyint(1) NOT NULL DEFAULT 0,
  `h` tinyint(1) NOT NULL DEFAULT 0,
  `t` tinyint(1) NOT NULL DEFAULT 0,
  `sort` int(6) UNSIGNED NULL DEFAULT 0,
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `delete_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '招聘' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lqbcms_report
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_report`;
CREATE TABLE `lqbcms_report`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发布者UID',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '新闻标题',
  `thumb` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `keywords` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章关键字',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章描述',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `attach` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '附件',
  `attach_name` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '附件名',
  `clicks` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `like` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `tag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `r` tinyint(1) NOT NULL DEFAULT 0,
  `h` tinyint(1) NOT NULL DEFAULT 0,
  `t` tinyint(1) NOT NULL DEFAULT 0,
  `code` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `delete_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 56 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '服务业务' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lqbcms_report_allow
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_report_allow`;
CREATE TABLE `lqbcms_report_allow`  (
  `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `member_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `report_id` int(10) NOT NULL DEFAULT 0,
  `create_time` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of lqbcms_report_allow
-- ----------------------------
INSERT INTO `lqbcms_report_allow` VALUES (2, 75, 9, 1579255485);
INSERT INTO `lqbcms_report_allow` VALUES (6, 76, 9, 1579255527);
INSERT INTO `lqbcms_report_allow` VALUES (7, 77, 9, 1579255527);
INSERT INTO `lqbcms_report_allow` VALUES (9, 77, 8, 1579255530);
INSERT INTO `lqbcms_report_allow` VALUES (10, 76, 5, 1579255532);
INSERT INTO `lqbcms_report_allow` VALUES (11, 75, 1, 1579395110);
INSERT INTO `lqbcms_report_allow` VALUES (12, 75, 17, 1581040951);
INSERT INTO `lqbcms_report_allow` VALUES (13, 76, 17, 1581040951);
INSERT INTO `lqbcms_report_allow` VALUES (14, 77, 17, 1581040952);

-- ----------------------------
-- Table structure for lqbcms_service
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_service`;
CREATE TABLE `lqbcms_service`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发布者UID',
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '所在分类',
  `special_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '新闻标题',
  `thumb` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `keywords` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章关键字',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章描述',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `clicks` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `like` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `tag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `r` tinyint(1) NOT NULL DEFAULT 0,
  `h` tinyint(1) NOT NULL DEFAULT 0,
  `t` tinyint(1) NOT NULL DEFAULT 0,
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `delete_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '服务业务' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_service
-- ----------------------------
INSERT INTO `lqbcms_service` VALUES (1, 1, 0, 0, '水和废水监测', '', '吊销为什么转注销', '吊销为什么转注销', '<p><img src=\"http://www.hnhzykj.com/storage/edit/20200207/1276f568cd1a08760ce2bceb6c772e82.jpg\" alt=\"图片\"/></p>', 126, 0, 1, '', 1, 0, 0, 1582529932, 1553931568, 0);
INSERT INTO `lqbcms_service` VALUES (5, 1, 3, 0, '环境空气和废气监测', '', '公司注销流程三步走', '公司注销流程三步走', '', 139, 0, 1, '', 1, 0, 0, 1553931877, 1553931877, 0);
INSERT INTO `lqbcms_service` VALUES (2, 1, 4, 0, '室内空气监测', '/uploads/news/201906250216561000.jpg', '儋州网络公司哪家好', '海南立行博网络科技有限公司是一家儋州本地公司，\n公司地址：海南省儋州市那大镇兰阳北路鼎尚广场B区B36-116号\n经营范围：住础软件开发，软件开发，软件和信息技术像务陈，象他软件开发，网络与信息战全软件开发，互志网零售，信息技术咨询像务。', '<p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px; border: none; text-indent: 2em; font-family: 微软雅黑; line-height: normal;\"><span style=\"margin: 0px; padding: 0px; border: none; color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">在人们日常工作和生活的环境中如果含有可溶性重金属、游离甲醛、甲醛、VOC、苯、甲苯、二甲苯、乙苯、氯乙烯单体、苯乙烯、氨、氡等有毒有害物质，会对人体健康造成严重影响。</span></p><p style=\"margin-top: 0px; margin-bottom: 0px; white-space: normal; padding: 0px; border: none; text-indent: 2em; font-family: 微软雅黑; line-height: normal;\"><span style=\"margin: 0px; padding: 0px; border: none; color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">空气和废气监测分析方法，建立先进的空气和废气环境监测体系要做到数据准确、代表性强、方法科学、传输及时，能够及时跟踪污染源及污染物排放的变化情况，准确预警和及时响应各类环境突发事件。</span></p><p><span style=\"margin: 0px; padding: 0px; border: none; color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\"><br/></span></p><p><br/></p>', 141, 0, 1, '', 1, 0, 0, 1582599200, 1553931572, 0);
INSERT INTO `lqbcms_service` VALUES (3, 1, 1, 0, '土壤与水系沉积物监测', '', '公司被吊销的后果', '公司被吊销的后果', '<ul class=\"wenzhangneirong list-paddingleft-2\" style=\"list-style-type: none;\"><p style=\"margin-top: 0px; margin-bottom: 10px; padding: 0px; outline: none 0px; line-height: 25px;\">土壤是环境的重要组成部分，土壤<span style=\"margin: 0px; padding: 0px; outline: none 0px; font-weight: bold;\">环境监测</span>是指通过对影响土壤环境质量因素的代表值的测定，确定环境质量（或污染程度）及其变化趋势。通常所说的土壤监测是指土壤<span style=\"margin: 0px; padding: 0px; outline: none 0px; font-weight: bold;\">环境监测</span>，一般可以分为区域土壤背景、农田土壤环境、建设项目土壤环境评价、土壤污染事故等类型的监测，包括布点采样、样品制备、分析方法、结果表征、资料统计和质量评价等技术内容。</p><p style=\"margin-top: 0px; margin-bottom: 10px; padding: 0px; outline: none 0px; line-height: 25px;\">土壤污染大致可分为无机污染物和有机污染物两大类。无机污染物主要包括酸、碱、重金属，盐类、锶的化合物、含砷、硒、氟的化合物等；有机污染物主要包括有机农药、酚类、氰化物、石油、合成洗涤剂、城市污水、污泥及厩肥带来的有害微生物等。</p></ul><p><br/></p>', 122, 0, 1, '', 1, 0, 0, 1582598574, 1553931593, 0);
INSERT INTO `lqbcms_service` VALUES (4, 1, 1, 0, '固体废物监测', '', '最全最快速注销公司的6大流程', '最全最快速注销公司的6大流程', '<p><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">固体废物监测是对固体废物进行监视和测定的过程。固体废物是指在生产、建设、日常生活和其他活动中产生的污染环境的固态、半固态废弃物质。工业固体废物是指在工业、交通等生产活动中产生的固体废物。城市生活垃圾是指在城市日常生活中或者为城市日常生活提供服务的活动中产生的固体废物以及法律、行政法规规定视为城市生活垃圾的固体废物。</span></p>', 205, 0, 1, '', 1, 0, 0, 1582599446, 1553931633, 0);
INSERT INTO `lqbcms_service` VALUES (6, 1, 3, 0, '城市污泥监测', '', '注册公司注意这五点', '创业走出的第一步就是公司注册。有的人可能觉得公司注册非常简单，花点钱找个中介机构就可以搞定。这有一定道理，与布满荆棘的创业之路比起来，公司注册确实要简单很多。据统计，去年平均每天新登记企业1.2万户，换个角度思考，每天大约有1.2万人注册公司，开启创业之路。但是很多人出师不利，并没有走好第一步，甚至为以后的发展埋下大隐患。公司注册有很多不容忽视的问题，需要创业者关注!', '', 158, 0, 1, '', 1, 0, 0, 1553931898, 1553931898, 0);
INSERT INTO `lqbcms_service` VALUES (8, 1, 1, 0, '振动监测', '', 'test', 'ess', '<p><span style=\"color: rgb(128, 128, 128); font-family: &quot;Microsoft Yahei&quot;; font-size: 14px; background-color: rgb(255, 255, 255);\">振动检测仪是检测家电振动频率，主要是监控车辆发动机振动监测振动家电洗碗机，冰箱，垃圾处理单位，干衣机等。</span> </p>', 2, 0, 1, '', 0, 0, 0, 1582599097, 1553932092, 0);
INSERT INTO `lqbcms_service` VALUES (9, 1, 4, 0, '电磁辐射监测', '/uploads/news/201906250214221000.jpg', '公司不注销对法人股东有什么影响？', '公司吊销：吊销只是一个过程，公司即使被吊销了营业执照，虽然不能经营，做还是存在的，还要承担相应的债权债务。', '<p><a target=\"_blank\" href=\"https://baike.baidu.com/item/%E7%94%B5%E7%A3%81\" style=\"color: rgb(19, 110, 194); text-decoration-line: none; font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);\">电磁</a><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">辐射是由空间共同移送的电能量和磁能量所组成，而该能量是由</span><a target=\"_blank\" href=\"https://baike.baidu.com/item/%E7%94%B5%E8%8D%B7/1144574\" style=\"color: rgb(19, 110, 194); text-decoration-line: none; font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);\">电荷</a><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">移动所产生。举例说，正在发射讯号的</span><a target=\"_blank\" href=\"https://baike.baidu.com/item/%E5%B0%84%E9%A2%91/775402\" style=\"color: rgb(19, 110, 194); text-decoration-line: none; font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);\">射频</a><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">天线所发出的移动电荷，便会产生电磁能量。电磁“</span><a target=\"_blank\" href=\"https://baike.baidu.com/item/%E9%A2%91%E8%B0%B1/7707276\" style=\"color: rgb(19, 110, 194); text-decoration-line: none; font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);\">频谱</a><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">”包括形形色色的电磁辐射，从</span><a target=\"_blank\" href=\"https://baike.baidu.com/item/%E6%9E%81%E4%BD%8E%E9%A2%91/7229660\" style=\"color: rgb(19, 110, 194); text-decoration-line: none; font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);\">极低频</a><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">的电磁辐射至极高频的电磁辐射。两者之间还有</span><a target=\"_blank\" href=\"https://baike.baidu.com/item/%E6%97%A0%E7%BA%BF%E7%94%B5%E6%B3%A2/942435\" style=\"color: rgb(19, 110, 194); text-decoration-line: none; font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);\">无线电波</a><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">、微波、红外线、可见光和</span><a target=\"_blank\" href=\"https://baike.baidu.com/item/%E7%B4%AB%E5%A4%96%E5%85%89/8817748\" style=\"color: rgb(19, 110, 194); text-decoration-line: none; font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; white-space: normal; background-color: rgb(255, 255, 255);\">紫外光</a><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">等。电磁频谱中射频部分的一般定义，是指频率约由3千赫至300吉赫的辐射。有些电磁辐射对人体有一定的影响。</span> </p>', 337, 0, 1, '', 1, 0, 1, 1582598968, 1553937083, 0);
INSERT INTO `lqbcms_service` VALUES (10, 1, 0, 0, '塑胶跑道监测', '/uploads/ueditor/image/20190712/1562913163651594.jpg', '注销问答', ' 注销问答 2', '<p><span style=\"color: rgb(40, 40, 40); font-family: 瀹嬩綋, &quot;Arial Narrow&quot;; font-size: 12px; text-indent: 32px; margin: 0px; padding: 0px; -webkit-tap-highlight-color: transparent; font-weight: bolder;\"><span style=\"margin: 0px; padding: 0px; -webkit-tap-highlight-color: transparent; font-size: 16px;\"><span style=\"margin: 0px; padding: 0px; -webkit-tap-highlight-color: transparent; color: rgb(51, 127, 229); line-height: 2;\">塑胶跑道又叫做全天候田径运动跑道</span><span style=\"margin: 0px; padding: 0px; -webkit-tap-highlight-color: transparent; line-height: 2;\">，</span></span></span><span style=\"color: rgb(40, 40, 40); font-family: 瀹嬩綋, &quot;Arial Narrow&quot;; text-indent: 32px; margin: 0px; padding: 0px; -webkit-tap-highlight-color: transparent; line-height: 2;\">一般由聚氨酯预聚体、混合聚醚、废轮胎橡胶、EPDM橡胶粒或PU颗粒、颜料、助剂、填料组成。</span></p><p><span style=\"color: rgb(40, 40, 40); font-family: 瀹嬩綋, &quot;Arial Narrow&quot;; text-indent: 32px; background-color: rgb(255, 255, 255);\">海之源可为委托客户进行权威优质的服务，对塑胶跑道检测，塑胶跑道生产解决方案，高效、快捷遵循国家以及地方标准进行检测，并出具检测报告。</span></p>', 78, 0, 1, '', 0, 0, 0, 1582598924, 1562913254, 0);
INSERT INTO `lqbcms_service` VALUES (18, 1, 0, 0, '土壤45项监测', '', '', '', '<p><span style=\"margin: 0px; padding: 0px; list-style: none; font-family: arial, 宋体, sans-serif; line-height: 24px; text-indent: 28px;\">土壤环境质量标准是土壤中</span><span style=\"font-family:arial, 宋体, sans-serif\"><span style=\"margin: 0px; padding: 0px; list-style: none; line-height: 24px; text-indent: 28px;\">污染</span></span><span style=\"font-family:arial, 宋体, sans-serif\"><span style=\"margin: 0px; padding: 0px; list-style: none; line-height: 24px; text-indent: 28px;\">物</span></span><span style=\"margin: 0px; padding: 0px; list-style: none; font-family: arial, 宋体, sans-serif; line-height: 24px; text-indent: 28px;\">的最高容许含量。污染物在土壤中的残留积累，以不致造成作物的生育障碍、在籽粒或可食部分中的过量积累（不超过</span><span style=\"font-family:arial, 宋体, sans-serif\"><span style=\"margin: 0px; padding: 0px; list-style: none; line-height: 24px; text-indent: 28px;\">食品</span></span><span style=\"font-family:arial, 宋体, sans-serif\"><span style=\"margin: 0px; padding: 0px; list-style: none; line-height: 24px; text-indent: 28px;\">卫生标准</span></span><span style=\"margin: 0px; padding: 0px; list-style: none; font-family: arial, 宋体, sans-serif; line-height: 24px; text-indent: 28px;\">）或影响土壤、水体等环境质量为界限。为贯彻《中华人民共和国环境保护》防止土壤污染，保护生态环境，保障农林生产，维护人体健康，制定本标准。国家按土壤应用功能、保护目标和土壤主要性质，规定了土壤中污染物的最高允许浓度指标值及相应的监测方法。</span></p>', 5, 0, 1, '', 0, 0, 0, 1582598837, 1582513848, 0);
INSERT INTO `lqbcms_service` VALUES (19, 1, 0, 0, '海洋沉积物监测', '', '', '', '<p><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">一般认为制定海水水质标准时通常要经过两个阶段。首先，要确定海洋环境质量的“基准”，经过调查研究，掌握各种环境要素(包括污染物)的基本情况；一定阶段内海水、沉积物中污染物的种类、浓度和生物体中各种污染物的残留量；对靶系统(人体、生态系或生物资源等)影响的剂量与效应定量因果关系为主要依据，先行评定海水水质基准。其次，“标准”的确定要考虑指定保护海域的自然条件(海区的自净能力或环境容量)和社会条件(地区社会、经济的承受能力)，以代价与效益或代价与危险分析结果为主要依据，再行制定海水水质标准。</span></p>', 0, 0, 1, '', 0, 0, 0, 1582598815, 1582530068, 0);
INSERT INTO `lqbcms_service` VALUES (20, 1, 0, 0, '噪声监测、海水监测、生物监测', '', '', '', '<p><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">一般认为制定海水水质标准时通常要经过两个阶段。首先，要确定海洋环境质量的“基准”，经过调查研究，掌握各种环境要素(包括污染物)的基本情况；一定阶段内海水、沉积物中污染物的种类、浓度和生物体中各种污染物的残留量；对靶系统(人体、生态系或生物资源等)影响的剂量与效应定量因果关系为主要依据，先行评定海水水质基准。其次，“标准”的确定要考虑指定保护海域的自然条件(海区的自净能力或环境容量)和社会条件(地区社会、经济的承受能力)，以代价与效益或代价与危险分析结果为主要依据，再行制定海水水质标准。</span></p>', 1, 0, 1, '', 0, 0, 0, 1582598806, 1582530271, 0);
INSERT INTO `lqbcms_service` VALUES (21, 1, 0, 0, '加油站大气污染物监测', '', '', '', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;PingFang SC&quot;, &quot;Lantinghei SC&quot;, &quot;Microsoft YaHei&quot;, arial, 宋体, sans-serif, tahoma; background-color: rgb(255, 255, 255);\">第九十八条 违反本法规定，以拒绝进入现场等方式拒不接受环境保护主管部门及其委托的环境监察机构或者其他负有大气环境保护监督管理职责的部门的监督检查，或者在接受监督检查时弄虚作假的，由县级以上人民政府环境保护主管部门或者其他负有大气环境保护监督管理职责的部门责令改正，处二万元以上二十万元以下的罚款;构成违反治安管理行为的，由公安机关依法予以处罚。</span></p>', 0, 0, 1, '', 0, 0, 0, 1582598765, 1582530290, 0);
INSERT INTO `lqbcms_service` VALUES (25, 1, 0, 0, '环境噪声监测', '', '', '', '<p><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">城市环境噪声监测是对区域环境和交通噪声的空间分布进行调查监测，在大多数城市交通噪声尤其明显。城市环境噪声监测包括城市区域环境噪声监测、城市交通噪声监测、功能区噪声监测、城市环境噪声长期监测和城市环境中扰民噪声源的调查测试等。</span></p>', 1, 0, 1, '', 0, 0, 0, 1582598683, 1582530389, 0);
INSERT INTO `lqbcms_service` VALUES (26, 1, 0, 0, '环境空气和废气监测', '', '', '', '<p style=\"line-height: normal;\"><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">在人们日常工作和生活的环境中如果含有可溶性重金属、游离甲醛、甲醛、VOC、苯、甲苯、二甲苯、乙苯、氯乙烯单体、苯乙烯、氨、氡等有毒有害物质，会对人体健康造成严重影响。</span></p><p style=\"line-height: normal;\"><span style=\"color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; text-indent: 28px; background-color: rgb(255, 255, 255);\">空气和废气监测分析方法，建立先进的空气和废气环境监测体系要做到数据准确、代表性强、方法科学、传输及时，能够及时跟踪污染源及污染物排放的变化情况，准确预警和及时响应各类环境突发事件。</span></p>', 19, 0, 1, '', 0, 0, 0, 1582598393, 1582530402, 0);

-- ----------------------------
-- Table structure for lqbcms_setting
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_setting`;
CREATE TABLE `lqbcms_setting`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '变量名',
  `value` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '値',
  `explain` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '说明',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统设置' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of lqbcms_setting
-- ----------------------------
INSERT INTO `lqbcms_setting` VALUES (1, 'zh', 'system_name', 'LQBCMS6', '', 0);
INSERT INTO `lqbcms_setting` VALUES (2, 'zh', 'company', 'LQBCMS6', '', 0);
INSERT INTO `lqbcms_setting` VALUES (3, 'zh', 'nickname', '海之源', '', 0);
INSERT INTO `lqbcms_setting` VALUES (4, 'zh', 'cellphone', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (5, 'zh', 'email', '252588119@qq.com', '', 0);
INSERT INTO `lqbcms_setting` VALUES (6, 'zh', 'remarks', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (7, 'zh', 'avatar', 'http://cdn.layui.com/avatar/168.jpg', '', 0);
INSERT INTO `lqbcms_setting` VALUES (8, 'zh', 'file', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (9, 'zh', 'access_token', 'my_access_token', '', 0);
INSERT INTO `lqbcms_setting` VALUES (10, 'zh', 'group', 'base', '', 0);
INSERT INTO `lqbcms_setting` VALUES (11, 'zh', 'beianhao', '琼ICP备20001113号-1', '', 0);
INSERT INTO `lqbcms_setting` VALUES (12, 'zh', 'qrcode', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (13, 'zh', 'tel', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (14, 'zh', 'address', '水静市码头', '', 0);
INSERT INTO `lqbcms_setting` VALUES (15, 'zh', 'qq', '252588119', '', 0);
INSERT INTO `lqbcms_setting` VALUES (16, 'zh', 'coordinate', '110.375343, 19.946699', '', 0);
INSERT INTO `lqbcms_setting` VALUES (17, 'zh', 'longitude', '110.345542', '', 0);
INSERT INTO `lqbcms_setting` VALUES (18, 'zh', 'latitude', '20.034617', '', 0);
INSERT INTO `lqbcms_setting` VALUES (19, 'zh', 'linkman', '李清波', '', 0);
INSERT INTO `lqbcms_setting` VALUES (20, 'zh', 'wechat', 'liqingbo27', '', 0);
INSERT INTO `lqbcms_setting` VALUES (21, 'zh', 'microblog', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (22, 'zh', 'logo', '/storage/base/20200526/9b1521ba216a6a3f326a0ea422a1027a.png', '', 0);
INSERT INTO `lqbcms_setting` VALUES (23, 'zh', 'postcode', '570100', '', 0);
INSERT INTO `lqbcms_setting` VALUES (24, 'en', 'system_name', 'hǎi nán guó jiā gōng yuán yán jiū yuàn ', '', 0);
INSERT INTO `lqbcms_setting` VALUES (25, 'en', 'company', 'hǎi nán guó jiā gōng yuán yán jiū yuàn ', '', 0);
INSERT INTO `lqbcms_setting` VALUES (26, 'en', 'linkman', 'liqingbo', '', 0);
INSERT INTO `lqbcms_setting` VALUES (27, 'en', 'tel', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (28, 'en', 'cellphone', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (29, 'en', 'qq', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (30, 'en', 'wechat', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (31, 'en', 'microblog', '/storage/base/20200420/c7d2d9a89b288dd067451e4f7ad2f8c3.png', '', 0);
INSERT INTO `lqbcms_setting` VALUES (32, 'en', 'email', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (33, 'en', 'address', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (34, 'en', 'postcode', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (35, 'en', 'longitude', '110.367264', '', 0);
INSERT INTO `lqbcms_setting` VALUES (36, 'en', 'latitude', '20.030233', '', 0);
INSERT INTO `lqbcms_setting` VALUES (37, 'en', 'beianhao', ' 琼ICP备20001113号-1', '', 0);
INSERT INTO `lqbcms_setting` VALUES (38, 'en', 'remarks', '', '', 0);
INSERT INTO `lqbcms_setting` VALUES (39, 'en', 'qrcode', '/storage/base/20200323/637eb960d7cdf3f6bb55f1875be4e805.jpg', '', 0);
INSERT INTO `lqbcms_setting` VALUES (40, 'en', 'logo', '/storage/base/20200429/517ad37f0eef9981819c7843851a9d4e.png', '', 0);
INSERT INTO `lqbcms_setting` VALUES (41, 'en', 'access_token', 'my_access_token', '', 0);
INSERT INTO `lqbcms_setting` VALUES (60, 'zh', 'index_title', '李清波个人博客 - 不积跬步，无以至千里，不积小流，无以成江海。', '', 0);
INSERT INTO `lqbcms_setting` VALUES (61, 'zh', 'index_keywords', '李清波个人博客,不积跬步，无以至千里，不积小流，无以成江海。', '', 0);
INSERT INTO `lqbcms_setting` VALUES (62, 'zh', 'index_description', '李清波个人博客 - 不积跬步，无以至千里，不积小流，无以成江海。', '', 0);

-- ----------------------------
-- Table structure for lqbcms_singlepage
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_singlepage`;
CREATE TABLE `lqbcms_singlepage`  (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admin_id` smallint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发布者UID',
  `varname` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '所在分类',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '新闻标题',
  `keywords` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章关键字',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '文章描述',
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(10) NOT NULL DEFAULT 0,
  `delete_time` int(10) NULL DEFAULT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `clicks` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '新闻表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_singlepage
-- ----------------------------
INSERT INTO `lqbcms_singlepage` VALUES (2, 'en', 1, 'intro', 'About HINP', 'good morning', 'good morning', NULL, 1, 1445918022, 1590487382, NULL, '', 308, 0);
INSERT INTO `lqbcms_singlepage` VALUES (3, 'zh', 1, 'jiyu', '院长寄语', '院长寄语', '院长寄语', '', 1, 1445918037, 1619435449, NULL, '<p>院长寄语</p>', 460, 2);
INSERT INTO `lqbcms_singlepage` VALUES (7, 'en', 1, 'dashiji', 'Events', 'good morning', 'good morning', NULL, 1, 1533636217, 1590487413, NULL, '', 46, 0);
INSERT INTO `lqbcms_singlepage` VALUES (14, 'zh', 1, 'zhici', '理事长致辞', '理事长致辞', '理事长致辞', '', 1, 1585906475, 1619435442, NULL, '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 14px; background-color: rgba(242, 242, 242, 0.424);\">理事长致辞</span></p>', 728, 1);
INSERT INTO `lqbcms_singlepage` VALUES (16, 'zh', 0, 'intro', '研究院简介', '简介', '简介', '', 1, 1587113631, 1619435420, NULL, '<p>简介</p>', 931, 0);
INSERT INTO `lqbcms_singlepage` VALUES (18, 'en', 0, 'jiyu', 'Message from the Dean', 'Message from the Dean', 'Message from the Dean', '', 1, 1587113802, 1591713183, NULL, '<p>。。。。。。。。。。。。。。。。。。。。。。。。。。。</p>', 25, 0);
INSERT INTO `lqbcms_singlepage` VALUES (20, 'zh', 0, 'dashiji', '大事记', '大事记', '大事记', '', 1, 1587113806, 1619435432, NULL, '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 14px; background-color: rgb(242, 242, 242);\">大事记</span></p>', 241, 0);
INSERT INTO `lqbcms_singlepage` VALUES (21, 'en', 0, 'zhici', 'Message from the Chairman', 'test', 'test', NULL, 1, 1587113810, 1590487401, NULL, '', 24, 0);

-- ----------------------------
-- Table structure for lqbcms_sms
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_sms`;
CREATE TABLE `lqbcms_sms`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '验证码',
  `phone` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '手机',
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'ip地址',
  `send_time` int(10) NOT NULL COMMENT '发送时间',
  `flag` tinyint(1) NOT NULL COMMENT '发送状态1表示成功:0表示失败',
  `type` tinyint(1) NOT NULL COMMENT '1验证码',
  `isuse` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '短信发送真实状态码',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '验证码记录表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_sms
-- ----------------------------
INSERT INTO `lqbcms_sms` VALUES (1, '5477', '18889363060', '127.0.0.1', 1579245780, 1, 1, 1, 1);
INSERT INTO `lqbcms_sms` VALUES (2, '4700', '18889363060', '127.0.0.1', 1579245854, 1, 1, 1, 1);
INSERT INTO `lqbcms_sms` VALUES (3, '9438', '18889363060', '192.168.10.196', 1579250309, 1, 1, 0, 1);
INSERT INTO `lqbcms_sms` VALUES (4, '6702', '18889363060', '127.0.0.1', 1579394826, 1, 1, 0, 1);
INSERT INTO `lqbcms_sms` VALUES (5, '3200', '18889363060', '112.66.95.198', 1582529612, 1, 1, 0, 1);

-- ----------------------------
-- Table structure for lqbcms_team
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_team`;
CREATE TABLE `lqbcms_team`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发布者UID',
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '所在分类',
  `special_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '新闻标题',
  `position` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '职位',
  `thumb` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `keywords` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章关键字',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章描述',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `clicks` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `like` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `tag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `r` tinyint(1) NOT NULL DEFAULT 0,
  `h` tinyint(1) NOT NULL DEFAULT 0,
  `t` tinyint(1) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `delete_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '科研团队' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lqbcms_userfiles
-- ----------------------------
DROP TABLE IF EXISTS `lqbcms_userfiles`;
CREATE TABLE `lqbcms_userfiles`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `admin_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员编号',
  `admin_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '会员名称',
  `filename` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名称',
  `savepath` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'URL链接',
  `savename` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `path` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '缩略图',
  `ext` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文件后缀',
  `type` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '1为图片',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建日期',
  `size` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '大小',
  `category` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文件分类 只能用小写英文字符表示',
  `sort` smallint(6) UNSIGNED NOT NULL DEFAULT 1 COMMENT '排序',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lqbcms_userfiles
-- ----------------------------
INSERT INTO `lqbcms_userfiles` VALUES (2, 0, NULL, '', '/storage/news/20210429/0970afd276832b0f88a2eecd5b39987c.jpg', '', '/storage/news/20210429/0970afd276832b0f88a2eecd5b3', '', '', 1619681008, 0, '', 1, '');

SET FOREIGN_KEY_CHECKS = 1;
