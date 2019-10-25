-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2018 at 08:40 PM
-- Server version: 10.1.35-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coder_israfly`
--

-- --------------------------------------------------------

--
-- Table structure for table `wc_banner`
--

CREATE TABLE `wc_banner` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wc_banner_image`
--

CREATE TABLE `wc_banner_image` (
  `banner_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `wc_categories`
--

CREATE TABLE `wc_categories` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_categories`
--

-- --------------------------------------------------------

--
-- Table structure for table `wc_category_translation`
--

CREATE TABLE `wc_category_translation` (
  `category_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




-- --------------------------------------------------------

--
-- Table structure for table `wc_faqs`
--

CREATE TABLE `wc_faqs` (
  `id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_faqs`
--



-- --------------------------------------------------------

--
-- Table structure for table `wc_faq_translation`
--

CREATE TABLE `wc_faq_translation` (
  `faq_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_faq_translation`
--


-- --------------------------------------------------------

--
-- Table structure for table `wc_gallery`
--

CREATE TABLE `wc_gallery` (
  `id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `image` text NOT NULL,
  `video` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Table structure for table `wc_groups`
--

CREATE TABLE `wc_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_groups`
--

INSERT INTO `wc_groups` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'Super Admin Group', '0000-00-00 00:00:00', NULL, NULL),
(2, 'Public', 'Public Access Group', '0000-00-00 00:00:00', NULL, NULL),
(3, 'Default', 'Default Access Group', '0000-00-00 00:00:00', NULL, NULL),
(4, 'Full Admin', 'Full Admin Group', '0000-00-00 00:00:00', NULL, '2018-03-17 08:18:20'),
(5, 'Test', 'Test Group', '2018-04-19 11:12:43', NULL, '2018-04-19 11:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `wc_languages`
--

CREATE TABLE `wc_languages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `slug` varchar(10) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_languages`
--

INSERT INTO `wc_languages` (`id`, `name`, `directory`, `slug`, `code`, `default`, `status`, `sort`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'English', 'english', 'en', 'en', 0, 1, 2, '2018-03-14 00:00:00', '0000-00-00 00:00:00', NULL),
(2, 'Azərbaycan dili', 'azerbaijani', 'az', 'az', 1, 1, 1, '2018-03-14 01:00:00', '0000-00-00 00:00:00', NULL),
(3, 'Русский', 'russian', 'ru', 'ru', 0, 1, 3, '2018-03-14 01:00:00', '0000-00-00 00:00:00', NULL),

-- --------------------------------------------------------

--
-- Table structure for table `wc_login_attempts`
--

CREATE TABLE `wc_login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(39) CHARACTER SET latin1 DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wc_menu`
--

CREATE TABLE `wc_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `nav_tag_open` varchar(255) NOT NULL,
  `nav_tag_close` varchar(255) NOT NULL,
  `item_tag_open` varchar(255) NOT NULL,
  `item_tag_close` varchar(255) NOT NULL,
  `parent_tag_open` varchar(255) NOT NULL,
  `parent_tag_close` varchar(255) NOT NULL,
  `parentl1_tag_open` varchar(255) NOT NULL,
  `parentl1_tag_close` varchar(255) NOT NULL,
  `parent_anchor` varchar(255) NOT NULL,
  `children_tag_open` varchar(255) NOT NULL,
  `children_tag_close` varchar(255) NOT NULL,
  `parentl1_anchor` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_menu`
--

INSERT INTO `wc_menu` (`id`, `name`, `slug`, `nav_tag_open`, `nav_tag_close`, `item_tag_open`, `item_tag_close`, `parent_tag_open`, `parent_tag_close`, `parentl1_tag_open`, `parentl1_tag_close`, `parent_anchor`, `children_tag_open`, `children_tag_close`, `parentl1_anchor`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Header', 'header', '', '', '<li>', '</li>', '<li>', '</li>', '<li>', '</li>', '<a href=\"%s\">%s</a>', '<ul>', '</ul>', '<a href=\"%s\">%s</a>', 1, '0000-00-00 00:00:00', 0, NULL, 0, NULL, 0),
(2, 'Footer', 'footer', '<ul class=\"footer-menu\">', '</ul>', '<li>', '</li>', '<li>', '</li>', '<li>', '</li>', '<a href=\"%s\">%s</a>', '<ul>', '</ul>', '<a href=\"%s\">%s</a>', 1, '0000-00-00 00:00:00', 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wc_menu_items`
--

CREATE TABLE `wc_menu_items` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `parent` int(11) DEFAULT '0',
  `icon` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Table structure for table `wc_menu_items_translation`
--

CREATE TABLE `wc_menu_items_translation` (
  `Item_id` int(11) NOT NULL,
  `menu_items_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wc_news`
--

CREATE TABLE `wc_news` (
  `id` int(11) NOT NULL,
  `view` bigint(20) NOT NULL,
  `featured` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `image` text NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `wc_news_images`
--

CREATE TABLE `wc_news_images` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Table structure for table `wc_news_to_category`
--

CREATE TABLE `wc_news_to_category` (
  `news_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_news_to_category`
--


-- --------------------------------------------------------

--
-- Table structure for table `wc_news_to_tag`
--

CREATE TABLE `wc_news_to_tag` (
  `news_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wc_news_translation`
--

CREATE TABLE `wc_news_translation` (
  `news_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_text` varchar(255) NOT NULL,
  `desc_text` text NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `tags` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `wc_news_videos`
--

CREATE TABLE `wc_news_videos` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `video` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_news_videos`
--


--
-- Table structure for table `wc_pages`
--

CREATE TABLE `wc_pages` (
  `id` int(11) NOT NULL,
  `view` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `template` varchar(32) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_pages`
--

-- --------------------------------------------------------

--
-- Table structure for table `wc_page_translation`
--

CREATE TABLE `wc_page_translation` (
  `page_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_page_translation`
--
-- --------------------------------------------------------

--
-- Table structure for table `wc_partners`
--

CREATE TABLE `wc_partners` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_partners`
--


-- --------------------------------------------------------

--
-- Table structure for table `wc_permissions`
--

CREATE TABLE `wc_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `directory` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_permissions`
--

INSERT INTO `wc_permissions` (`id`, `name`, `description`, `directory`, `controller`, `method`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Səhifələr', 'Səhifələrin siyahısı', 'admin/', 'news', 'index', '0000-00-00 00:00:00', NULL, NULL),
(2, 'Səhifələr', 'Səhifələrin redaktəsi', 'admin/', 'page', 'edit', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wc_permission_to_group`
--

CREATE TABLE `wc_permission_to_group` (
  `permission_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_permission_to_group`
--

INSERT INTO `wc_permission_to_group` (`permission_id`, `group_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wc_settings`
--

CREATE TABLE `wc_settings` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `json` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_settings`
--

INSERT INTO `wc_settings` (`id`, `key`, `value`, `json`) VALUES
(1, 'site_title', '{\"az\":\"israfly\",\"en\":\"israfly\",\"ru\":\"israfly\",\"sa\":\"israfly\",\"ir\":\"israfly\"}', 1),
(2, 'per_page', '20', 0),
(3, 'per_page_list', '[10,20,50,100,200]', 1),
(4, 'template', 'default', 0),
(5, 'facebook', 'https://www.facebook.com', 0),
(6, 'linkedin', 'https://www.linkedin.com/', 0),
(7, 'instagram', '', 0),
(8, 'youtube', 'https://plus.google.com', 0),
(9, 'email', 'office@israfly.com ', 0),
(10, 'phone', '+994 124087155 ', 0),
(11, 'contact_address', '{\"az\":\"N\\u0259rimanov ray., \\u018fhm\\u0259d R\\u0259c\\u0259bli k\\u00fc\\u00e7. 1\\/25B\",\"en\":\"Ahmad Rajabli st. 1\\/25B Narimanov district\",\"ru\":\"y\\u043b. \\u0410\\u0445\\u043c\\u0430\\u0434 \\u0420\\u0430\\u0434\\u0436\\u0430\\u0431\\u043b\\u0438 1\\/25B  \\u0440.\\u041d\\u0430\\u0440\\u0438\\u043c\\u0430\\u043d\\u043e\\u0432\",\"sa\":\"\\u0634\\u0627\\u0631\\u0639 \\u0627\\u062d\\u0645\\u062f \\u0631\\u0627\\u062c\\u0627\\u0628\\u0644\\u064a. 1\\/25B. \\u0645\\u0646\\u0637\\u0642\\u0629 \\u0646\\u0627\\u0631\\u064a\\u0645\\u0627\\u0646\\u0648\\u0641\",\"ir\":\"\\u0634\\u0627\\u0631\\u0639 \\u0627\\u062d\\u0645\\u062f \\u0631\\u0627\\u062c\\u0627\\u0628\\u0644\\u064a. 1\\/25B. \\u0645\\u0646\\u0637\\u0642\\u0629 \\u0646\\u0627\\u0631\\u064a\\u0645\\u0627\\u0646\\u0648\\u0641\"}', 1),
(18, 'mobile', '+994 12 999 99 99', 0),
(19, 'site_description', '{\"az\":\"israfly\",\"en\":\"israfly\",\"ru\":\"israfly\",\"sa\":\"israfly\",\"ir\":\"israfly\"}', 1),
(20, 'meta_title', '{\"az\":\"israfly\",\"en\":\"israfly\",\"ru\":\"israfly\",\"sa\":\"israfly\",\"ir\":\"israfly\"}', 1),
(21, 'twitter', 'https://twitter.com', 0),
(22, 'googleplus', 'https://plus.google.com', 0),
(23, 'github', '', 0),
(24, 'vimeo', '', 0),
(25, 'flickr', '', 0),
(26, 'rss', '', 0),
(27, 'wordpress', '', 0),
(28, 'dribbble', '', 0),
(29, 'blogger', '', 0),
(30, 'tumblr', '', 0),
(31, 'skype', '', 0),
(33, 'contact_mobile', '+994 55 999 99 99', 0),
(34, 'contact_email', '', 0),
(35, 'contact_latitude', '', 0),
(36, 'contact_longitude', '', 0),
(37, 'mail_server', 'phpmailer', 0),
(38, 'mail_hostname', '', 0),
(39, 'mail_username', '', 0),
(40, 'mail_password', '', 0),
(41, 'mail_port', '', 0),
(42, 'mail_timeout', '', 0),
(43, 'latitude', '40.411164', 0),
(44, 'longitude', '49.861418', 0),
(45, 'footer_text', '{\"az\":\"All rights reserved 2018 ©. Grand Agro In Vitro. Webcoder.\",\"en\":\"All rights reserved 2018 ©. Grand Agro In Vitro. Webcoder.\",\"ru\":\"All rights reserved 2018 ©. Grand Agro In Vitro. Webcoder.\"}', 1),
(46, 'contact_region', '{\"az\":\"Bak\\u0131, Az\\u0259rbaycan\",\"en\":\"Baku, Azerbaijan\",\"ru\":\"\\u0411\\u0430\\u043a\\u0443, \\u0410\\u0437\\u0435\\u0440\\u0431\\u0430\\u0439\\u0434\\u0436\\u0430\\u043d\",\"sa\":\"\\u0628\\u0627\\u0643\\u0648 \\u060c \\u0623\\u0630\\u0631\\u0628\\u064a\\u062c\\u0627\\u0646\",\"ir\":\"\\u0628\\u0627\\u06a9\\u0648\\u060c \\u0622\\u0630\\u0631\\u0628\\u0627\\u06cc\\u062c\\u0627\\u0646\"}', 1),
(48, 'contact_place', '{\"az\":\"\",\"en\":\"\",\"ru\":\"\",\"sa\":\"\",\"ir\":\"\"}', 1),
(49, 'contact_postal', '{\"az\":\"AZ1012\",\"en\":\"AZ1012\",\"ru\":\"AZ1012\",\"sa\":\"AZ1012\",\"ir\":\"AZ1012\"}', 1),
(50, 'contact_phone', '{\"az\":\"(+994) 124087155 \",\"en\":\"(+994) 124087155; ( 070) 330 12 77; 051 330 12 77; 055 980 12 77\",\"ru\":\"(+994) 124087155; 070 330 12 77; 051 330 12 77; 055 980 12 77\",\"sa\":\"(+994) 124087155; 070 330 12 77; 051 330 12 77; 055 980 12 77\",\"ir\":\"(+994) 124087155; 070 330 12 77; 051 330 12 77; 055 980 12 77\"}', 1),
(51, 'contact_fax', '{\"az\":\"\",\"en\":\"\",\"ru\":\"\",\"sa\":\"\",\"ir\":\"\"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wc_slider`
--

CREATE TABLE `wc_slider` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `show_at_home` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_slider`
--

INSERT INTO `wc_slider` (`id`, `name`, `status`, `show_at_home`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(5, 'LAST  CHANGE!', 1, 1, '2018-08-06 16:08:09', 0, '2018-08-28 19:27:44', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wc_slider_items`
--

CREATE TABLE `wc_slider_items` (
  `id` int(11) NOT NULL,
  `slider_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_slider_items`
--

INSERT INTO `wc_slider_items` (`id`, `slider_id`, `sort`) VALUES
(79, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wc_slider_item_translation`
--

CREATE TABLE `wc_slider_item_translation` (
  `slider_item_id` int(11) NOT NULL,
  `lang_id` tinyint(3) NOT NULL,
  `url` text NOT NULL,
  `image` text,
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wc_slides`
--

CREATE TABLE `wc_slides` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_slides`
--

INSERT INTO `wc_slides` (`id`, `link`, `sort`, `status`, `image`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(8, 'http://israfly.coder.az/en/tours', 0, 1, 'catalog/slide/last-chance.png', '2018-08-29 02:02:48', 0, '2018-09-17 09:36:36', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wc_slide_translation`
--

CREATE TABLE `wc_slide_translation` (
  `slide_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_slide_translation`
--

INSERT INTO `wc_slide_translation` (`slide_id`, `lang_id`, `slug`, `name`, `title`, `text`) VALUES
(8, 2, '', 'ƏLA', 'TƏKLİF!', '<p>Son dəqiqə təklifləri</p>\r\n'),
(8, 1, '', 'LAST', ' CHANCE!', '<p>Last minute deals</p>\r\n'),
(8, 3, '', 'ПОСЛЕДНИЙ', 'ШАНС!', '<p>Горящее предложение</p>\r\n'),
(8, 4, '', 'اخر', ' تغير!', '<p>عروض اللحظة الأخيرة</p>\r\n'),
(8, 5, '', 'LAST', ' CHANGE!', '<p>Last minute deals</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `wc_users`
--

CREATE TABLE `wc_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `fcm_token` text NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_users`
--

INSERT INTO `wc_users` (`id`, `firstname`, `lastname`, `email`, `pass`, `username`, `banned`, `fcm_token`, `last_login`, `last_activity`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kamran', 'Nəcəfzadə', 'admin@example.com', '$2y$10$0T6bYhs/PgzeTFl79EEHk.iPgXKsM3zXTSVOFUPZXt5KAR3m4NUbS', 'admin', 0, 'e0A2BSuaXEc:APA91bEtkEpaq9khD33i46yLm2NHFGXqgEADAQ-n-Ks4z-KBnKX-g1afb7hFzGEVbbsN9-PRN4tDVwtzlgG28VlbvkfeqMydII0CLsM9PHAre54QbQR_atWtYh3m3ePwmbHfJwr2ysit', '2018-09-24 11:18:22', '2018-09-24 11:18:22', NULL, '2018-08-02 00:00:00', 'n8ELAtxZj56qyhik', NULL, NULL, '37.26.61.22', NULL, NULL, NULL),
(2, 'Kamran', 'Nadjafzadeh', 'kamran@example.com', '$2y$10$ygclP.ACybOIjhH2OWTEOuXcPz0oB2wrz9vJTf0B4PsIvGtziDOuy', 'kamran', 1, '', '2018-03-14 15:20:35', '2018-03-14 15:20:35', NULL, NULL, NULL, NULL, NULL, '162.158.90.65', NULL, NULL, NULL),
(7, 'Farhad', 'Misirli', 'ferhad@gmail.com', '$2y$10$X4f96vIaGkqfzwdUNiAKLuE05LkdmAyMROLJ.Dpxh.ddl/Hk/0dbu', 'farhad', 0, '', '2018-04-19 14:41:01', '2018-04-19 14:41:01', NULL, NULL, NULL, NULL, NULL, '85.132.36.39', '2018-04-19 14:40:27', NULL, '2018-05-28 19:16:23'),
(8, 'df', 'df', 'df@mail.ru', '$2y$10$9oV1S5P/sQjASDPJzRroc.hp8T.N8IqedPC5PA3xDx/K/PL9kldvu', 'dfdfdf', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-19 15:26:29', NULL, '2018-04-19 16:04:59'),
(9, 'fd', 'fdf', 'dfdf@mail.ru', '$2y$10$B5ztKB8lp4fE6B1/dIgSAurpCEg94hIPLYaHsqdnx/IS4RCyfI5H.', 'adminx', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-19 15:29:33', NULL, '2018-04-19 16:04:59'),
(10, 'jdfbj', 'bl', 'dlkfbl@mail.ru', '$2y$10$T2WPLf9ZuyO8P.8A/.fkjOdF5Ds9MzZQkbGKI6WUgLS0UPaTt5KdO', 'admindfdf', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-19 15:38:50', NULL, '2018-04-19 16:04:59'),
(11, 'dfljbnLKNLK', 'LKNLKDN', 'KNNLKNLD@MAIL.RU', '$2y$10$2tjFR9ObtfptW/Mp5eBKze.a18rvezEdRPbUpCxxQSChUdcBn.T7W', 'admindfkj', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-19 15:39:47', NULL, '2018-04-19 16:04:59'),
(12, 'Test', 'testsd', 'tessdt@mail.com', '$2y$10$VOTf0wj/ulVAbG98j6aBpuxOQsjm2VPXjdC7cUk4IRZkhzFgDv.FK', 'test1', 0, '', '2018-04-19 16:08:25', '2018-04-19 16:08:25', NULL, NULL, NULL, NULL, NULL, '85.132.36.39', '2018-04-19 16:06:30', NULL, '2018-05-19 22:12:11'),
(13, 'Shukran', 'Ibrahimli', 'sukranibrahimli@gmail.com', '$2y$10$oFvB124EQSqZa/onWvTaVuKaNVTXkHfCZrQC5eXR2L3sz5gM1Cs8e', 'shukran', 0, '', '2018-05-14 15:39:25', '2018-05-14 15:39:25', NULL, NULL, NULL, NULL, NULL, '85.132.36.39', '2018-05-14 15:01:29', NULL, '2018-05-28 19:16:27'),
(15, 'Taleh', 'Ferzeliyev', 'tferzeliyev@std.qu.edu.az', '$2y$10$L02I1b.5A02oBKhV4oaXlePpUZ1snAKz4M1mnu/vg.OsSWcj8QMJO', 'tony', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-23 21:45:15', NULL, '2018-05-28 19:15:48'),
(16, 'Kama', 'Kamayev', 'kama98@gmail.com', '$2y$10$CPFuS34wpQgW1VZPaR1QS.ESc/7H.gQvpRrrcg9wM8MaEsPSYpYBC', 'kamka', 0, 'd8rX71R3EG4:APA91bELpkTjVVrKI6KpPJM3p7kS663NrT2AsTj-TaCcT3pRxGZIzt7dtDfiM5lDoqEVBX41agxqVKAayAY_6tptT3zCON0B1-r6TyW-9IeXjzTmJkPJH7WmxMQrGokw_H22JnnNA-cy', '2018-06-14 11:13:09', '2018-06-14 11:13:09', NULL, NULL, NULL, NULL, NULL, '85.132.36.39', '2018-05-23 22:42:33', NULL, NULL),
(17, 'egt', 'sttge', 'segtsge@mail.ru', '$2y$10$2yX1361kgE6lIM5eqHFGZOC3.oeMf5thfHNvPlo9X8B8HmxnFuXHG', 'gser', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 11:15:08', NULL, '2018-05-28 19:15:41'),
(18, 'vste', 'tresrtv', 'ertesrtvesrtvrteertvetr@MAIL.RU', '$2y$10$vk5qMTd5gxJWdmdmpsPsQOQLeOj6dbaQrbX6VP53JqXiOn5fKxUcq', 'set', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-25 11:19:44', NULL, '2018-05-28 19:15:38'),
(19, 'Taleh', 'Ferzeliyev', 'ftaleh96@gmail.com', '$2y$10$8s.EydueWMPKkhYsiFlZn.MV/NVTjn7g2afAVaxSXiG.W.aRmIumC', 'tano', 0, '', '2018-05-29 17:38:11', '2018-05-29 17:38:11', NULL, NULL, NULL, NULL, NULL, '85.132.36.39', '2018-05-29 15:28:35', NULL, NULL),
(20, 'Nicat', 'Mahirson', 'niciM@gmail.com', '$2y$10$QsKDsCxcUW.ekxNHv.0dneXmcJ/aRxulNQZB9e8/lpnmGVoLzLuR.', 'mnicat284522', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-01 14:09:24', NULL, NULL),
(21, 'Nicat', 'Mahiroglu', 'nicimahirson@gmail.com', '$2y$10$ViLvOBxto7Mhj3PT9G0F3.7/y201UwCxWNax3J/J2JmXsMkhTdn7W', 'mnicat77179', 0, '', '2018-06-01 14:28:22', '2018-06-01 14:28:22', NULL, NULL, NULL, NULL, NULL, '85.132.36.39', '2018-06-01 14:18:06', NULL, NULL),
(22, 'Farhad', 'Misirli', 'farhad@example.com', '$2y$10$0T6bYhs/PgzeTFl79EEHk.iPgXKsM3zXTSVOFUPZXt5KAR3m4NUbS', 'farhad', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL),
(23, 'sadas', 'sdadas', 'dsada@mail.ru', '$2y$10$U.CVPe1fDsAGEA2HUmeiUukcdxFn2dbnQElG5DuYK6A4bzaAhSAo6', 'ssadas63403', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-04 11:25:01', NULL, NULL),
(24, 'asdasdas', 'ascascasdasd', 'adasdasdasdasdasdas@mail.ru', '$2y$10$37eIQ7NAmqim41ALzJ.ZXebIjzPGWx1EEjVMxwXSwPU3nVjGX7Yli', 'aasdasdas503093', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-05 16:51:52', NULL, '2018-06-09 14:32:09'),
(25, 'Ferhad', 'Misirli', 'ferhad99@gmail.com', '$2y$10$ZR21Rj5jS1cTjuhcH1E.Ye3WgiRzNyWZn3KoRJ/j7qgfysUF5lx4e', 'ferhad987', 0, '', '2018-06-07 18:05:57', '2018-06-07 18:05:57', NULL, NULL, NULL, NULL, NULL, '85.132.36.39', '2018-06-07 17:41:00', NULL, NULL),
(26, 'zsdgsdg', 'sdgsdsdg', 'sgsseg@mail.ru', '$2y$10$lmvNEf7MTbofxNyhsf9NJOwH6jD/Ywfq204EXnd0rW/LBjUcsrDE.', 'sdgsdgs', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-11 11:27:26', NULL, '2018-07-13 15:31:39');

-- --------------------------------------------------------

--
-- Table structure for table `wc_user_to_group`
--

CREATE TABLE `wc_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_user_to_group`
--

INSERT INTO `wc_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1),
(7, 1),
(8, 3),
(9, 3),
(10, 3),
(11, 2),
(12, 2),
(13, 1),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3);

-- --------------------------------------------------------

--
-- Table structure for table `wc_user_variables`
--

CREATE TABLE `wc_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wc_user_variables`
--

INSERT INTO `wc_user_variables` (`id`, `user_id`, `data_key`, `value`) VALUES
(1, 1, 'firstname', 'Kamran'),
(2, 1, 'lastname', 'Nadjafzadeh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wc_banner`
--
ALTER TABLE `wc_banner`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `wc_banner_image`
--
ALTER TABLE `wc_banner_image`
  ADD PRIMARY KEY (`banner_id`,`lang_id`),
  ADD KEY `banner_id` (`banner_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `wc_categories`
--
ALTER TABLE `wc_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_category_translation`
--
ALTER TABLE `wc_category_translation`
  ADD PRIMARY KEY (`category_id`,`lang_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `lang_id` (`lang_id`);


--
-- Indexes for table `wc_faqs`
--
ALTER TABLE `wc_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_faq_translation`
--
ALTER TABLE `wc_faq_translation`
  ADD PRIMARY KEY (`faq_id`,`lang_id`),
  ADD KEY `page_id` (`faq_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `wc_gallery`
--
ALTER TABLE `wc_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_groups`
--
ALTER TABLE `wc_groups`
  ADD PRIMARY KEY (`id`);


--
-- Indexes for table `wc_languages`
--
ALTER TABLE `wc_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_login_attempts`
--
ALTER TABLE `wc_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_menu`
--
ALTER TABLE `wc_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `wc_menu_items`
--
ALTER TABLE `wc_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `wc_menu_items_translation`
--
ALTER TABLE `wc_menu_items_translation`
  ADD PRIMARY KEY (`Item_id`);

--
-- Indexes for table `wc_news`
--
ALTER TABLE `wc_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_news_images`
--
ALTER TABLE `wc_news_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_news_to_category`
--
ALTER TABLE `wc_news_to_category`
  ADD KEY `news_id` (`news_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `wc_news_to_tag`
--
ALTER TABLE `wc_news_to_tag`
  ADD PRIMARY KEY (`news_id`,`tag_id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `wc_news_translation`
--
ALTER TABLE `wc_news_translation`
  ADD PRIMARY KEY (`news_id`,`lang_id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `wc_news_videos`
--
ALTER TABLE `wc_news_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_pages`
--
ALTER TABLE `wc_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_page_translation`
--
ALTER TABLE `wc_page_translation`
  ADD PRIMARY KEY (`page_id`,`lang_id`),
  ADD KEY `page_id` (`page_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `wc_partners`
--
ALTER TABLE `wc_partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_permissions`
--
ALTER TABLE `wc_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_permission_to_group`
--
ALTER TABLE `wc_permission_to_group`
  ADD PRIMARY KEY (`permission_id`,`group_id`);

--
-- Indexes for table `wc_services`
--
ALTER TABLE `wc_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_service_translation`
--
ALTER TABLE `wc_service_translation`
  ADD KEY `service_id` (`service_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `wc_settings`
--
ALTER TABLE `wc_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_slider`
--
ALTER TABLE `wc_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_slider_items`
--
ALTER TABLE `wc_slider_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delete relation item` (`slider_id`);

--
-- Indexes for table `wc_slider_item_translation`
--
ALTER TABLE `wc_slider_item_translation`
  ADD KEY `delete relation translation items` (`slider_item_id`);

--
-- Indexes for table `wc_slides`
--
ALTER TABLE `wc_slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_users`
--
ALTER TABLE `wc_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wc_user_to_group`
--
ALTER TABLE `wc_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `wc_user_variables`
--
ALTER TABLE `wc_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wc_banner`
--
ALTER TABLE `wc_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wc_categories`
--
ALTER TABLE `wc_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;


--
-- AUTO_INCREMENT for table `wc_faqs`
--
ALTER TABLE `wc_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wc_gallery`
--
ALTER TABLE `wc_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `wc_groups`
--
ALTER TABLE `wc_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wc_languages`
--
ALTER TABLE `wc_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wc_login_attempts`
--
ALTER TABLE `wc_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `wc_menu`
--
ALTER TABLE `wc_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wc_menu_items`
--
ALTER TABLE `wc_menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `wc_menu_items_translation`
--
ALTER TABLE `wc_menu_items_translation`
  MODIFY `Item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=588;

--
-- AUTO_INCREMENT for table `wc_news`
--
ALTER TABLE `wc_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wc_news_images`
--
ALTER TABLE `wc_news_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `wc_news_videos`
--
ALTER TABLE `wc_news_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wc_pages`
--
ALTER TABLE `wc_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wc_partners`
--
ALTER TABLE `wc_partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wc_permissions`
--
ALTER TABLE `wc_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wc_services`
--
ALTER TABLE `wc_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wc_settings`
--
ALTER TABLE `wc_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `wc_slider`
--
ALTER TABLE `wc_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wc_slider_items`
--
ALTER TABLE `wc_slider_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `wc_slides`
--
ALTER TABLE `wc_slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


--
-- AUTO_INCREMENT for table `wc_users`
--
ALTER TABLE `wc_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `wc_user_variables`
--
ALTER TABLE `wc_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wc_slider_items`
--
ALTER TABLE `wc_slider_items`
  ADD CONSTRAINT `delete relation item` FOREIGN KEY (`slider_id`) REFERENCES `wc_slider` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `wc_slider_item_translation`
--
ALTER TABLE `wc_slider_item_translation`
  ADD CONSTRAINT `delete relation translation items` FOREIGN KEY (`slider_item_id`) REFERENCES `wc_slider_items` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
