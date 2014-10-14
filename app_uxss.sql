-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2014 年 10 月 14 日 17:25
-- 服务器版本: 5.5.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `app_uxss`
--

-- --------------------------------------------------------

--
-- 表的结构 `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `token` varchar(20) NOT NULL,
  `poc_1` tinyint(1) NOT NULL,
  `poc_2` tinyint(1) NOT NULL,
  `poc_3` tinyint(1) NOT NULL,
  `poc_4` tinyint(1) NOT NULL,
  `poc_5` tinyint(1) NOT NULL,
  `poc_6` tinyint(1) NOT NULL,
  `poc_7` tinyint(1) NOT NULL,
  `poc_8` tinyint(1) NOT NULL,
  `poc_9` tinyint(1) NOT NULL,
  `poc_10` tinyint(1) NOT NULL,
  `ua` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=214 ;

