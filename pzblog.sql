-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 24, 2010 at 11:56 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pzblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, '顾伟刚'),
(2, '岳风顺'),
(3, '林军'),
(4, '李小龙');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `title` varchar(63) NOT NULL,
  `body` mediumtext,
  `author_id` mediumint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `created`, `updated`, `status`, `title`, `body`, `author_id`) VALUES
(1, '2010-01-01 12:00:00', '2010-05-25 14:41:27', 'draft', 'solar-system- 1.01-win-0.3发布', '为了能让更多人使用solar php，我一直在不停地做solar windows版本的工作，今天终于能够给大家带来一个好消息了，这个版本是solar-win的一个里程卑版本，在这个版本中，solar-win的行为已经和linux下面几乎一致了。', 1),
(2, '2010-01-01 00:00:00', '2010-05-25 15:14:03', 'public', 'solar_manual_offline_v1.0(preview3) 发布', 'solar文档跑离上次更新已有很久了，忙于杂事，耽误了许多时间，这次更新也没有太大的惊喜，主要是更新了下文档的目录结构，不再以ch01s01.html形式命名，而是以该页面标题命名，并增加了内容的层次结构，更方便阅读和查找。', 2),
(3, '2010-01-01 06:00:00', '2010-05-25 15:14:17', 'public', 'Solar 连接数据库的编码问题和网页的编码问题？', '这篇文章已同步发表到论坛：http://solarphp.org.cn/viewtopic.php?f=2&t=83\r\n今天在群里面【普通人】问到数据库的编码问题和网页的编码问题，我在这里一并回答了。注：这里使用Acme作为默认vendor 8-) 。\r\n首先，Solar并没有准备数据库编码的配置，不过这很容易完成，大家都知道， :lol: Solar是一个极易扩展的框架。下面说说解决方案：', 1),
(7, '2010-05-20 21:23:44', '2010-05-25 15:13:40', 'draft', '从名师网V3.0改版看发展', '名师网的定位是基础教育服务专家。我全程参与了名师网第2版的开发，可以说第二版仍是以门户为主，是2.0时代的1.0产物。\r\n\r\n名师网3.0版终于顺应互联网形势改成2.0格局了。但此次我的工作是辅助名师网第3版的开发工作，工作量并不大。现在开发工作基本完成，是应该跳到更高的层次来看看这次改版的成果与不足。', 4),
(9, '2010-05-21 18:23:08', '2010-05-25 14:50:50', 'public', 'solar_manual_offline_v1.0(preview2) 发布', 'solar文档v1.0预览第二版，更新情况：\r\n1. 和官方一致的样式\r\n2. 图片显示\r\n3. 格式与官方也一致了', 2),
(10, '2010-05-21 18:30:36', '2010-05-25 14:51:38', 'draft', '为什么选择使用“Solar Framework For PHP 5” ？', 'Solar是基于PHP 5的web应用框架。她继承了Savant模板系统、DB_Table对象-关系管理包以及PEAR组织结构的优良特性及先进思想。\r\n\r\nSolar由Paul M. Jones创办，他也是Solar系统的“独裁者”。其他开发人员主要为标准项目分发包开发组件，所有这些都遵守New BSD协议。\r\n\r\n   1.\r\n\r\n      优雅和一致的：代码库本身是很容易理解的，坚持文档友好的命名规则，并有很强的概念完整性。\r\n   2.\r\n\r\n      完整的名字空间： Solar类库有它们自己的PHP5.2名字空间 ，并且Solar中的vendor同样有自己的名字空间。这样一来，混合其他组件和框架也不是什么难事了，因为他们不会产生名字冲突。\r\n   3.\r\n\r\n      配置是可继承的：在配置文件配置好某个类，该类的所有子类都会默认继承该配置。\r\n   4.\r\n\r\n      本地化是可继承的：设置某个类的本地化字符串，该类的所有子类都会继承那些本地化字符串。\r\n   5.\r\n\r\n      针对SQL注入，跨站点脚本的攻击和其他常见的攻击有非常容易使用的防卸体系。\r\n   6. 验证和查审有户输入，有健壮和可扩展的数据过滤体系。\r\n   7.\r\n\r\n      用于LDAP、TypeKey、数据库htpasswd及其他源的验证适配器。\r\n   8.\r\n\r\n      用于memcache、APC、XCache及其他系统的缓存适配器。\r\n   9.\r\n\r\n      用于超链接, 图像, 样式, 本地化文本, 表单生成等的视图辅助类。\r\n  10.\r\n\r\n      活跃并且友好的社区： 加入 mailing list and IRC where we make it point to be nice.\r\n  11.\r\n\r\n      充分集成企业的开发模式，例如：\r\n          * 数据映射\r\n          * 依赖注入和服务定位器\r\n          * 延迟加载\r\n          * MVC 模式\r\n                o Front 控制器\r\n                o Page 控制器\r\n                o Table Module和Active Record\r\n                o 模板视图\r\n                o 两步视图\r\n          * 查询对象\r\n          * 注册表\r\n          * 服务器会话状态\r\n\r\n', 1),
(11, '2010-05-21 18:36:40', '2010-05-25 14:52:35', 'public', 'solar- win的vendor组织形式', '在windows vista（含）以上版本系统中使用solar进行开发已经不是问题了，但是使用这种方法的文件组织形式有点不一样，仍然是symlink造成的，后面的版本要官方更新了。', 2),
(13, '2010-05-24 06:48:46', '2010-05-25 14:52:51', 'public', 'solar windows测试', 'solar windows测试', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `blog_id` smallint(6) NOT NULL,
  `title` varchar(60) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `title`, `content`, `author`) VALUES
(1, 1, '哈哈', '留个言1', '顾伟刚'),
(2, 1, '你好，中国', '留个言1', ''),
(3, 2, '你好，长沙', '留个言2', ''),
(4, 2, '你好中国', '', '岳风顺'),
(5, 3, '李建国', '李建国', '李建国');

-- --------------------------------------------------------

--
-- Table structure for table `summaries`
--

CREATE TABLE IF NOT EXISTS `summaries` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `blog_id` mediumint(6) NOT NULL,
  `comment_count` mediumint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `summaries`
--

INSERT INTO `summaries` (`id`, `blog_id`, `comment_count`) VALUES
(1, 3, 5),
(2, 7, 9),
(3, 1, 10),
(4, 2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `taggings`
--

CREATE TABLE IF NOT EXISTS `taggings` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `blog_id` mediumint(6) NOT NULL,
  `tag_id` mediumint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `taggings`
--

INSERT INTO `taggings` (`id`, `blog_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'win'),
(2, 'manual'),
(3, 'solar'),
(4, 'php');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
