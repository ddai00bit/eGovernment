<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 31/05/2010, 00:36
 */

function nv_create_table_news ( $catid )
{
    global $db, $db_config;
    $db->sql_query( "SET SQL_QUOTE_SHOW_CREATE = 1" );
    $result = $db->sql_query( "SHOW CREATE TABLE `" . $db_config['prefix'] . "_vi_news_rows`" );
    $show = $db->sql_fetchrow( $result );
    $db->sql_freeresult( $result );
    $show = preg_replace( '/(KEY[^\(]+)(\([^\)]+\))[\s\r\n\t]+(USING BTREE)/i', '\\1\\3 \\2', $show[1] );
    $sql = preg_replace( '/(default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP|DEFAULT CHARSET=\w+|COLLATE=\w+|character set \w+|collate \w+|AUTO_INCREMENT=\w+)/i', ' \\1', $show );
    $sql = str_replace( $db_config['prefix'] . "_vi_news_rows", $db_config['prefix'] . "_vi_news_" . $catid, $sql );
    $db->sql_query( $sql );
}

$sql_create_table = array();
$sql_create_table[] = "TRUNCATE TABLE `" . $db_config['prefix'] . "_vi_modules`";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modules` (`title`, `module_file`, `module_data`, `custom_title`, `set_time`, `admin_file`, `theme`, `keywords`, `groups_view`, `in_menu`, `weight`, `submenu`, `act`, `admins`, `rss`) VALUES
('about', 'about', 'about', 'Giới thiệu', 1276333182, 1, '', '', '0', 1, 1, 1, 1, '', 0),
('news', 'news', 'news', 'Tin Tức', 1270400000, 1, '', '', '0', 1, 2, 1, 1, '', 1),
('download', 'download', 'download', 'Tải file', 1276597148, 1, '', '', '0', 1, 3, 1, 1, '', 1),
('weblinks', 'weblinks', 'weblinks', 'Liên kết site', 1276834052, 1, '', '', '0', 1, 4, 1, 1, '', 1),
('users', 'users', 'users', 'Thành viên', 1274080277, 1, '', '', '0', 1, 5, 1, 1, '', 0),
('contact', 'contact', 'contact', 'Liên hệ', 1275351337, 1, '', '', '0', 1, 6, 1, 1, '', 0),
('statistics', 'statistics', 'statistics', 'Thống kê', 1276520928, 0, '', 'truy cập, online, statistics', '0', 1, 7, 1, 1, '', 0),
('voting', 'voting', 'voting', 'Thăm dò ý kiến', 1275315261, 1, '', '', '0', 0, 8, 1, 1, '', 1),
('banners', 'banners', 'banners', 'Quảng cáo', 1270400000, 1, '', '', '0', 0, 9, 1, 1, '', 0),
('search', 'search', 'search', 'Tìm kiếm', 1273474173, 0, '', '', '0', 0, 10, 1, 1, '', 0),
('rss', 'rss', 'rss', 'Rss', 1279366705, 1, '', '', '0', 0, 11, 1, 1, '', 0)";

$sql_create_table[] = "TRUNCATE TABLE `" . $db_config['prefix'] . "_vi_modfuncs`";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_modfuncs` (`func_id`, `func_name`, `func_custom_name`, `in_module`, `show_func`, `in_submenu`, `subweight`, `layout`, `setting`) VALUES
(1, 'main', 'Main', 'about', 1, 0, 1, 'left-body-right', ''),
(2, 'comment', 'Comment', 'news', 0, 0, 0, 'left-body-right', ''),
(3, 'detail', 'Detail', 'news', 1, 0, 4, 'left-body-right', ''),
(4, 'main', 'Main', 'news', 1, 0, 1, 'left-body-right', ''),
(7, 'rating', 'Rating', 'news', 0, 0, 0, 'left-body-right', ''),
(8, 'savefile', 'Savefile', 'news', 0, 0, 0, 'left-body-right', ''),
(9, 'search', 'Search', 'news', 1, 0, 5, 'left-body-right', ''),
(10, 'sendmail', 'Sendmail', 'news', 0, 0, 0, 'left-body-right', ''),
(11, 'topic', 'Topic', 'news', 1, 0, 3, 'left-body-right', ''),
(12, 'viewcat', 'Viewcat', 'news', 1, 0, 2, 'left-body-right', ''),
(13, 'down', 'Down', 'download', 1, 0, 4, 'left-body-right', ''),
(14, 'getcomment', 'Getcomment', 'download', 0, 0, 0, 'left-body-right', ''),
(15, 'main', 'Main', 'download', 1, 0, 1, 'left-body-right', ''),
(16, 'report', 'Report', 'download', 1, 0, 6, 'left-body-right', ''),
(17, 'upload', 'Upload', 'download', 1, 0, 5, 'left-body-right', ''),
(20, 'detail', 'Detail', 'weblinks', 1, 0, 3, 'left-body-right', ''),
(21, 'link', 'Link', 'weblinks', 0, 0, 0, 'left-body-right', ''),
(22, 'main', 'Main', 'weblinks', 1, 0, 1, 'left-body-right', ''),
(23, 'reportlink', 'Reportlink', 'weblinks', 0, 0, 0, 'left-body-right', ''),
(24, 'viewcat', 'Viewcat', 'weblinks', 1, 0, 2, 'left-body-right', ''),
(25, 'visitlink', 'Visitlink', 'weblinks', 0, 0, 0, 'left-body-right', ''),
(26, 'active', 'Active', 'users', 1, 0, 7, 'left-body-right', ''),
(27, 'changepass', 'Thay đổi mật khẩu', 'users', 1, 1, 6, 'left-body-right', ''),
(28, 'editinfo', 'Editinfo', 'users', 1, 0, 8, 'left-body-right', ''),
(29, 'login', 'Đăng nhập', 'users', 1, 1, 2, 'left-body-right', ''),
(30, 'logout', 'Logout', 'users', 1, 0, 3, 'left-body-right', ''),
(31, 'lostactivelink', 'Lostactivelink', 'users', 1, 0, 9, 'left-body-right', ''),
(32, 'lostpass', 'Quên mật khẩu', 'users', 1, 1, 5, 'left-body-right', ''),
(33, 'main', 'Main', 'users', 1, 0, 1, 'left-body-right', ''),
(34, 'register', 'Đăng ký', 'users', 1, 1, 4, 'left-body-right', ''),
(35, 'main', 'Main', 'contact', 1, 0, 1, 'left-body-right', ''),
(36, 'allbots', 'Máy chủ tìm kiếm', 'statistics', 1, 1, 6, 'left-body', ''),
(37, 'allbrowsers', 'Theo trình duyệt', 'statistics', 1, 1, 4, 'left-body', ''),
(38, 'allcountries', 'Theo quốc gia', 'statistics', 1, 1, 3, 'left-body', ''),
(39, 'allos', 'Theo hệ điều hành', 'statistics', 1, 1, 5, 'left-body', ''),
(40, 'allreferers', 'Theo đường dẫn đến site', 'statistics', 1, 1, 2, 'left-body', ''),
(41, 'main', 'Main', 'statistics', 1, 0, 1, 'left-body', ''),
(42, 'referer', 'đường dẫn đến site theo tháng', 'statistics', 1, 0, 7, 'left-body', ''),
(43, 'main', 'Main', 'voting', 0, 0, 0, 'left-body-right', ''),
(44, 'result', 'Result', 'voting', 0, 0, 0, 'left-body-right', ''),
(45, 'click', 'Click', 'banners', 0, 0, 0, 'left-body-right', ''),
(46, 'main', 'Main', 'banners', 1, 0, 1, 'left-body-right', ''),
(47, 'adv', 'Adv', 'search', 0, 0, 0, 'left-body-right', ''),
(48, 'main', 'Main', 'search', 1, 0, 1, 'left-body-right', ''),
(49, 'print', 'Print', 'news', 0, 0, 0, '', ''),
(50, 'postcomment', 'Postcomment', 'news', 0, 0, 0, '', ''),
(51, 'openid', 'Openid', 'users', 1, 1, 6, 'left-body-right', ''),
(54, 'main', 'Main', 'rss', 1, 0, 1, 'left-body-right', ''),
(55, 'rss', 'Rss', 'news', 0, 0, 0, '', ''),
(56, 'rss', 'Rss', 'download', 0, 0, 0, '', ''),
(57, 'rss', 'Rss', 'weblinks', 0, 0, 0, '', ''),
(58, 'addads', 'Addads', 'banners', 1, 0, 1, 'left-body-right', ''),
(59, 'cledit', 'Cledit', 'banners', 0, 0, 0, '', ''),
(60, 'clientinfo', 'Clientinfo', 'banners', 1, 0, 2, 'left-body-right', ''),
(61, 'clinfo', 'Clinfo', 'banners', 0, 0, 0, '', ''),
(62, 'logininfo', 'Logininfo', 'banners', 0, 0, 0, '', ''),
(63, 'stats', 'Stats', 'banners', 1, 0, 3, 'left-body-right', ''),
(64, 'viewmap', 'Viewmap', 'banners', 0, 0, 0, '', ''),
(65, 'search', 'Search', 'download', 1, 0, 1, 'left-body-right', ''),
(66, 'viewcat', 'Viewcat', 'download', 1, 0, 2, 'left-body-right', ''),
(67, 'viewfile', 'Viewfile', 'download', 1, 0, 3, 'left-body-right', '')";

$sql_create_table[] = "TRUNCATE TABLE `" . $db_config['prefix'] . "_vi_blocks`";
$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_blocks` (`bid`, `groupbl`, `title`, `link`, `type`, `file_path`, `theme`, `template`, `position`, `exp_time`, `active`, `groups_view`, `module`, `all_func`, `func_id`, `weight`) VALUES
(1, 1, 'Menu', '', 'file', 'module.block_category.php', 'default', '', '[LEFT]', 0, '1', '0', 'news', 0, 4, 1),
(2, 1, 'Menu', '', 'file', 'module.block_category.php', 'default', '', '[LEFT]', 0, '1', '0', 'news', 0, 12, 1),
(3, 1, 'Menu', '', 'file', 'module.block_category.php', 'default', '', '[LEFT]', 0, '1', '0', 'news', 0, 11, 1),
(4, 1, 'Menu', '', 'file', 'module.block_category.php', 'default', '', '[LEFT]', 0, '1', '0', 'news', 0, 3, 1),
(5, 1, 'Menu', '', 'file', 'module.block_category.php', 'default', '', '[LEFT]', 0, '1', '0', 'news', 0, 9, 1),
(6, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 1, 1),
(7, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 46, 1),
(8, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 35, 1),
(9, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 15, 1),
(12, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 13, 1),
(13, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 17, 1),
(14, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 16, 1),
(15, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 4, 2),
(16, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 12, 2),
(17, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 11, 2),
(18, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 3, 2),
(19, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 9, 2),
(20, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 48, 1),
(21, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 41, 1),
(22, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 40, 1),
(23, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 38, 1),
(24, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 37, 1),
(25, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 39, 1),
(26, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 36, 1),
(27, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 42, 1),
(28, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 33, 1),
(29, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 29, 1),
(30, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 30, 1),
(31, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 34, 1),
(32, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 32, 1),
(33, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 27, 1),
(34, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 26, 1),
(35, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 28, 1),
(36, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 31, 1),
(37, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 22, 1),
(38, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 24, 1),
(39, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 20, 1),
(40, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 1, 2),
(41, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 46, 2),
(42, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 35, 2),
(43, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 15, 2),
(46, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 13, 2),
(47, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 17, 2),
(48, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 16, 2),
(49, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 4, 3),
(50, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 12, 3),
(51, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 11, 3),
(52, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 3, 3),
(53, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 9, 3),
(54, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 48, 2),
(55, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 41, 2),
(56, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 40, 2),
(57, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 38, 2),
(58, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 37, 2),
(59, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 39, 2),
(60, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 36, 2),
(61, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 42, 2),
(62, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 33, 2),
(63, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 29, 2),
(64, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 30, 2),
(65, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 34, 2),
(66, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 32, 2),
(67, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 27, 2),
(68, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 26, 2),
(69, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 28, 2),
(70, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 31, 2),
(71, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 22, 2),
(72, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 24, 2),
(73, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 20, 2),
(74, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 1, 1),
(75, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 46, 1),
(76, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 35, 1),
(77, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 15, 1),
(80, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 13, 1),
(81, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 17, 1),
(82, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 16, 1),
(83, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 4, 1),
(84, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 12, 1),
(85, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 11, 1),
(86, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 3, 1),
(87, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 9, 1),
(88, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 48, 1),
(89, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 41, 1),
(90, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 40, 1),
(91, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 38, 1),
(92, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 37, 1),
(93, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 39, 1),
(94, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 36, 1),
(95, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 42, 1),
(96, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 33, 1),
(97, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 29, 1),
(98, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 30, 1),
(99, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 34, 1),
(100, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 32, 1),
(101, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 27, 1),
(102, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 26, 1),
(103, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 28, 1),
(104, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 31, 1),
(105, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 22, 1),
(106, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 24, 1),
(107, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 20, 1),
(108, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 1, 3),
(109, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 46, 3),
(110, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 35, 3),
(111, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 15, 3),
(114, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 13, 3),
(115, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 17, 3),
(116, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 16, 3),
(117, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 4, 3),
(118, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 12, 3),
(119, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 11, 3),
(120, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 3, 3),
(121, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 9, 3),
(122, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 48, 3),
(123, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 41, 3),
(124, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 40, 3),
(125, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 38, 3),
(126, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 37, 3),
(127, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 39, 3),
(128, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 36, 3),
(129, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 42, 3),
(130, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 33, 3),
(131, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 29, 3),
(132, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 30, 3),
(133, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 34, 3),
(134, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 32, 3),
(135, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 27, 3),
(136, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 26, 3),
(137, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 28, 3),
(138, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 31, 3),
(139, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 22, 3),
(140, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 24, 3),
(141, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 20, 3),
(142, 6, 'Tin nổi bật', '', 'file', 'module.block_headline.php', 'default', 'no_title', '[TOP]', 0, '1', '0', 'news', 0, 4, 1),
(143, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 1, 1),
(144, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 46, 1),
(145, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 35, 1),
(146, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 15, 1),
(149, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 13, 1),
(150, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 17, 1),
(151, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 16, 1),
(152, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 4, 2),
(153, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 12, 1),
(154, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 11, 1),
(155, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 3, 1),
(156, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 9, 1),
(157, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 48, 1),
(158, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 41, 1),
(159, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 40, 1),
(160, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 38, 1),
(161, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 37, 1),
(162, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 39, 1),
(163, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 36, 1),
(164, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 42, 1),
(165, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 33, 1),
(166, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 29, 1),
(167, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 30, 1),
(168, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 34, 1),
(169, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 32, 1),
(170, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 27, 1),
(171, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 26, 1),
(172, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 28, 1),
(173, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 31, 1),
(174, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 22, 1),
(175, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 24, 1),
(176, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 20, 1),
(177, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 1, 2),
(178, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 46, 2),
(179, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 35, 2),
(180, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 15, 2),
(183, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 13, 2),
(184, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 17, 2),
(185, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 16, 2),
(186, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 4, 2),
(187, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 12, 2),
(188, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 11, 2),
(189, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 3, 2),
(190, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 9, 2),
(191, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 48, 2),
(192, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 41, 2),
(193, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 40, 2),
(194, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 38, 2),
(195, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 37, 2),
(196, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 39, 2),
(197, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 36, 2),
(198, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 42, 2),
(199, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 33, 2),
(200, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 29, 2),
(201, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 30, 2),
(202, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 34, 2),
(203, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 32, 2),
(204, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 27, 2),
(205, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 26, 2),
(206, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 28, 2),
(207, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 31, 2),
(208, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 22, 2),
(209, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 24, 2),
(210, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 20, 3),
(212, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 51, 1),
(214, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 51, 2),
(216, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 51, 1),
(218, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 51, 2),
(220, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 51, 1),
(222, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 51, 3),

(NULL, 2, 'Thống kê truy cập', '', 'file', 'global.counter.php', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 54, 1),
(NULL, 3, 'Quảng cáo trái', '', 'banner', '2', 'default', '', '[LEFT]', 0, '1', '0', 'global', 1, 54, 2),
(NULL, 4, 'Giới thiệu', '', 'file', 'global.about.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 54, 1),
(NULL, 5, 'Thăm dò ý kiến', '', 'file', 'global.voting.php', 'default', '', '[RIGHT]', 0, '1', '0', 'global', 1, 54, 2),
(NULL, 7, 'Quảng cáo giữa trang', '', 'banner', '1', 'default', 'no_title', '[TOP]', 0, '1', '0', '', 1, 54, 1),
(NULL, 8, 'Đăng nhập thành viên', '', 'file', 'global.login.php', 'default', 'orange', '[RIGHT]', 0, '1', '0', 'global', 1, 54, 3)

";

$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_news_cat` VALUES
(1, 0, 'Tin tức', 'Tin-tuc', '', '', '', 1, 1, 0, 'viewcat_main_right', 3, '8,12,9', 1, 3, '', '', 1274986690, 1274986690, 1300986690, 0, ''), 
(2, 0, 'Sản phẩm', 'San-pham', '', '', '', 2, 5, 0, 'viewcat_page_new', 0, '', 1, 3, '', '', 1274986705, 1274986705, 1300986705, 0, ''), 
(8, 1, 'Thông cáo báo chí', 'thong-cao-bao-chi', '', '', '', 1, 2, 1, 'viewcat_page_new', 0, '', 1, 3, '', '', 1274987105, 1274987244, 1300987105, 0, ''), 
(9, 1, 'Tin công nghệ', 'Tin-cong-nghe', '', '', '', 3, 4, 1, 'viewcat_page_new', 0, '', 1, 3, '', '', 1274987212, 1274987212, 1300987212, 0, ''), 
(10, 0, 'Đối tác', 'Doi-tac', '', '', '', 3, 9, 0, 'viewcat_main_right', 0, '', 1, 3, '', '', 1274987460, 1274987460, 1300987460, 0, ''), 
(11, 0, 'Tuyển dụng', 'Tuyen-dung', '', '', '', 4, 12, 0, 'viewcat_page_new', 0, '', 1, 3, '', '', 1274987538, 1274987538, 1300987538, 0, ''), 
(12, 1, 'Bản tin nội bộ', 'Ban-tin-noi-bo', '', '', '', 2, 3, 1, 'viewcat_page_new', 0, '', 1, 3, '', '', 1274987902, 1274987902, 1300987902, 0, '')";

$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_news_rows` VALUES
(1, '1,8,12', 0, 1, 'Quỳnh Nhi', 1, 1274989177, 1275318126, 1, 1274989140, 0, 2, 'Ra mắt công ty mã nguồn mở đầu tiên tại Việt Nam', 'Ra-mat-cong-ty-ma-nguon-mo-dau-tien-tai-Viet-Nam', 'Mã nguồn mở NukeViet vốn đã quá quen thuộc với cộng đồng CNTT Việt Nam trong mấy năm qua. Tuy chưa hoạt động chính thức, nhưng chỉ trong khoảng 5 năm gần đây, mã nguồn mở NukeViet đã được dùng phổ biến ở Việt Nam, áp dụng ở hầu hết các lĩnh vực, từ tin tức đến thương mại điện tử, từ các website cá nhân cho tới những hệ thống website doanh nghiệp.', '2010_05/nangly.jpg', 'Thành lập VINADES.,JSC', 'thumb/nangly.jpg|block/nangly.jpg', 1, '<p style=\"text-align: justify;\"> Để chuyên nghiệp hóa việc phát hành mã nguồn mở NukeViet, Ban quản trị NukeViet quyết định thành lập doanh nghiệp chuyên quản NukeViet mang tên Công ty cổ phần Phát triển nguồn mở Việt Nam (Viết tắt là VINADES.,JSC), chính thức ra mắt vào ngày 25-2-2010 (trụ sở tại 67B/35 Khương Hạ, Khương Đình, Thanh Xuân, Hà Nội) nhằm phát triển, phổ biến hệ thống NukeViet tại Việt Nam.<br  /> <br  /> Theo ông Nguyễn Anh Tú, Chủ tịch HĐQT VINADES, công ty sẽ phát triển bộ mã nguồn NukeViet nhất quán theo con đường mã nguồn mở đã chọn, chuyên nghiệp và quy mô hơn bao giờ hết. Đặc biệt là hoàn toàn miễn phí đúng tinh thần mã nguồn mở quốc tế.<br  /> <br  /> NukeViet là một hệ quản trị nội dung mã nguồn mở (Opensource Content Management System) thuần Việt từ nền tảng PHP-Nuke và cơ sở dữ liệu MySQL. Người sử dụng thường gọi NukeViet là portal vì nó có khả năng tích hợp nhiều ứng dụng trên nền web, cho phép người sử dụng có thể dễ dàng xuất bản và quản trị các nội dung của họ lên internet hoặc intranet.<br  /> <br  /> NukeViet cung cấp nhiều dịch vụ và ứng dụng nhờ khả năng tăng cường tính năng thêm các module, block... tạo sự dễ dàng cài đặt, quản lý, ngay cả với những người mới tiếp cận với website. Người dùng có thể tìm hiểu thêm thông tin và tải về sản phẩm tại địa chỉ http://nukeviet.vn</p><blockquote> <p style=\"text-align: justify;\"> <em>Thông tin ra mắt công ty VINADES có thể tìm thấy trên trang 7 báo Hà Nội Mới ra ngày 25/02/2010 (<a href=\"http://hanoimoi.com.vn/newsdetail/Cong_nghe/309750/ra-mat-cong-ty-ma-nguon-mo-dau-tien-tai-viet-nam.htm\" target=\"_blank\">xem chi tiết</a>), Bản tin tiếng Anh của đài tiếng nói Việt Nam ngày 26/02/2010 (<a href=\"http://english.vovnews.vn/Home/First-opensource-company-starts-operation/20102/112960.vov\" target=\"_blank\">xem chi tiết</a>); trang 7 báo An ninh Thủ Đô số 2858 ra vào thứ 2 ngày 01/03/2010 và các trang tin tức, báo điện tử khác.</em></p></blockquote>', 0, 1, 2, 1, '29|6', 1, 1, 1, 97, 0, 0, 'nguồn mở, quen thuộc, cộng đồng, việt nam, hoạt động, gần đây, phổ biến, áp dụng, hầu hết, hết các, lĩnh vực, tin tức, thương mại điện, điện tử, cá nhân, hệ thống'), 
(2, '1,8,12', 1, 1, 'laser', 2, 1274989787, 1275318114, 1, 1274989740, 0, 2, 'Công bố dự án NukeViet 3.0 sau 1 tháng ra mắt VINADES.,JSC', 'Cong-bo-du-an-NukeViet-3-0-sau-1-thang-ra-mat-VINADES-JSC', 'NukeViet 3.0 - Một nền tảng được xây dựng hoàn toàn mới với những công nghệ web tiên tiến nhất hiện nay hứa hẹn sẽ làm một cuộc cách mạng về mã nguồn mở ở Việt Nam. Món quà này là lời cảm ơn chân thành nhất mà VINADES.,JSC muốn gửi tới cộng đồng sau một tháng chính thức ra mắt.', '2010_05/nukeviet3.jpg', 'NukeViet 3.0', 'thumb/nukeviet3.jpg|block/nukeviet3.jpg', 1, '<p style=\"font-weight: bold;\"> <span style=\"font-size: 14pt;\">Câu chuyện của NukeViet và VINADES.,JSC</span></p><p style=\"font-weight: bold;\"> Từ một trăn trở</p><p style=\"text-align: justify;\"> Giữa năm 2009, trước yêu cầu cấp thiết phải đổi mới và làm một cuộc cách mạng cho mã nguồn mở NukeViet, một cuộc thảo luận sôi nổi đã diễn ra với tiêu đề &quot;Lối đi nào để chuyên nghiệp hóa mã nguồn mở NukeViet&quot;.</p><p> Kết quả của cuộc thảo luận này là 55 bài viết với hàng chục ý kiến đóng góp đã được đưa ra. Các giải pháp về tài chính, nhân lực, phương hướng hoạt động được đem ra thảo luận. rockbuilc, Nkd833 đề xuất phương án thành lập doanh nghiệp chuyên quản NukeViet như một giải pháp toàn diện để giải quyết vấn đề chuyên nghiệp hóa NukeViet. Các vấn đề được các thành viên tham gia thảo luận và mổ xẻ thẳng thắn, nhiều ý kiến phản biện trái chiều cũng được đưa ra trên tinh thần xây dựng. Sau 2 tháng thảo luận, Ban Quản Trị đã có dự định...</p><p> <span style=\"font-weight: bold;\">Gặp mặt</span></p><p> Tháng 11, Sau khi tham khảo các ý kiến của mọi người trên diễn đàn, Anh Tú đã trực tiếp về Việt Nam. Một cuộc offline được tổ chức chớp nhoáng với sự tham gia của các thành viên chủ chốt tại Hà Nội. Các cuộc tìm hiểu và tiếp xúc được triển khai gấp rút trong giai đoạn này.</p><p> <span style=\"font-weight: bold;\">Một mô hình - một lối đi</span></p><p style=\"text-align: justify;\"> Hướng đi chuyên nghiệp hóa việc phát triển NukeViet đã được anh Tú chọn lựa: &quot;Thành lập doanh nghiệp chuyên quản NukeViet&quot;. Doanh nghiệp chuyên quản NukeViet được thành lập từ chính nhu cầu của cộng đồng nhằm chuyên nghiệp hóa NukeViet, vì vậy mô hình công ty cổ phần được chọn lựa để đáp ứng yêu cầu đó. Chịu trách nhiệm triển khai, laser đã lên phương án đầu tư, mục tiêu, kế hoạch phát triển ngắn và dài hạn.</p><p> <br  /> <span style=\"font-weight: bold;\">Triển khai thực hiện</span></p><p style=\"text-align: justify;\"> Tháng 1 năm 2010, việc thành lập đã được xúc tiến. Ngày 25/02/2010, trên các bản tin tiếng Anh và tiếng Việt xuất hiện bản tin &quot;Ra mắt công ty mã nguồn mở đầu tiên tại Việt Nam&quot;. Đó là Công ty cổ phần Phát triển nguồn mở Việt Nam (VIET NAM OPEN SOURCE DEVELOPMENT JOINT STOCK COMPANY - VINADES.,JSC). Đây là một vài hình ảnh trong ngày khai trương:</p><div style=\"text-align: center;\"> <img alt=\"Anh Tú phát biểu khai trương VINADES.,JSC \" height=\"332\" src=\"http://nukeviet.vn/uploads/spaw2/images/anhtu-phatbieu.jpg\" style=\"border: 0px solid;\" width=\"500\" /></div><div style=\"text-align: center;\"> Anh Tú phát biểu khai trương VINADES.,JSC <p> <br  /> <img alt=\"\" border=\"0\" src=\"http://nukeviet.vn/uploads/spaw2/images/hung-phatbieu.jpg\" style=\"width: 500px;\" width=\"500\" /></p> <p> Nguyễn Hùng giới thiệu đôi nét về công ty, mục tiêu và phương hướng hoạt động.</p> <p> <br  /> <img alt=\"\" border=\"0\" height=\"332\" src=\"http://nukeviet.vn/uploads/spaw2/images/nangly.jpg\" style=\"width: 500px; height: 332px;\" width=\"500\" /></p> <p> Cùng nâng ly chúc mừng khai trương.</p></div><p style=\"font-weight: bold;\"> ... và lời cảm ơn gửi tới cộng đồng</p><p style=\"text-align: justify;\"> VINADES.,JSC từ khi được thai nghén tới lúc chập chững những bước đi ban đầu đều có sự động viên, ủng hộ và đóng góp lớn nhỏ của cộng đồng NukeViet - Một cộng đồng gắn liền với những ký ức, những kỷ niệm buồn vui và mang trong mỗi thành viên một đam mê, một hoài bão lớn lao. &quot;Lửa thử vàng, gian nan thử sức&quot;, mỗi khó khăn trả qua khiến cộng đồng NukeViet lớn dần lên, gắn kết với nhau bằng một sợi dây vô hình không thể chia cắt: đó là niềm đam mê với mã nguồn mở, với công nghệ web. VINADES.,JSC được tạo ra từ cộng đồng và sẽ cố gắng hết sức để hoạt động vì lợi ích của cộng đồng.</p><p>  </p><div style=\"text-align: center;\"> <img alt=\"\" border=\"0\" height=\"375\" src=\"http://nukeviet.vn/uploads/spaw2/images/anhvp2.jpg\" style=\"width: 500px; height: 375px;\" width=\"500\" /></div><p>  </p><p style=\"text-align: center;\"> Văn phòng làm việc của VINADES.,JSC ở Hà Nội.</p><div style=\"text-align: center;\"> <img alt=\"\" border=\"0\" height=\"375\" src=\"http://nukeviet.vn/uploads/spaw2/images/anhvp3.jpg\" style=\"width: 500px; height: 375px;\" width=\"500\" /></div><p>  </p><p style=\"text-align: center;\"> Một góc văn phòng nhìn từ trong ra ngoài.</p><p style=\"font-weight: bold;\"> NukeViet 3.0 - Cuộc cách mạng của NukeViet</p><p style=\"text-align: justify;\"> Sau nhiều tháng triển khai, NukeViet 3.0 đã được định hình và dự định công bố bản beta trong thời gian gần. NukeViet 3.0 là phiên bản mang tính cách mạng của hệ thống NukeViet vì 100% các dòng code của NukeViet 3.0 đã được viết mới hoàn toàn chứ không sử dụng nền tảng cũ. Việc này đã ngốn rất nhiều thời gian và công sức của đội ngũ lập trình. Đó cũng là lý do vì sao bản 2.0 không được cải tiến nhiều trong thời gian qua.</p><div style=\"text-align: justify;\"> NukeViet 3.0 được xây dựng với mong muốn có một nền tảng ổn định để sau đó có thể đầu tư lâu dài, xây dựng một thư viện ứng dụng phong phú. VINADES.,JSC sẽ song hành cùng cộng đồng NukeViet trong việc hỗ trợ và phát triển NukeViet thành một mã nguồn mở hoạt động ở quy mô chuyên nghiệp. Đây là bước đi đầu tiên trong trong tiến trình chuyên nghiệp hóa này. Các ứng dụng bổ sung sẽ được xây dựng bài bản, chất lượng. Cộng đồng NukeViet sẽ không chỉ là cộng đồng người sử dụng mà sẽ được đầu tư về đào tạo để trở thành một cộng đồng lập trình mạnh. Thông tin chi tiết về dự án phát triển NukeViet 3.0 được cập nhật tại đây: <a href=\"http://nukeviet.vn/phpbb/viewforum.php?f=99\" target=\"_blank\">http://nukeviet.vn/phpbb/viewforum.php?f=99</a></div>', 0, 1, 2, 1, '39|9', 1, 1, 1, 91, 0, 0, 'nền tảng, xây dựng, hoàn toàn, với những, công nghệ, tiên tiến, hiện nay, hứa hẹn, cách mạng, nguồn mở, việt nam, món quà, cảm ơn, chân thành, thành nhất, cộng đồng'), 
(5, '2', 1, 1, '', 0, 1274993307, 1275318039, 1, 1274993280, 0, 2, 'Giới thiệu về mã nguồn mở NukeViet', 'Gioi-thieu-ve-ma-nguon-mo-NukeViet', 'Chắc hẳn đây không phải lần đầu tiên bạn nghe nói đến mã nguồn mở. Và nếu bạn là người mê lướt web thì hẳn bạn từng nhìn thấy đâu đó cái tên NukeViet. NukeViet, phát âm là Nu-Ke-Việt, chính là phần mềm dùng để xây dựng các Website mà bạn ngày ngày online để truy cập đấy.', '2010_05/1243187502.jpg', '', 'thumb/1243187502.jpg|block/1243187502.jpg', 1, '<p> <strong><span style=\"font-size: 14px;\">THÔNGTIN VỀ MÃ NGUỒN MỞ NUKEVIET</span></strong></p><p style=\"font-weight: bold;\"> I. Giới thiệu chung:</p><p> NukeVietlà một hệ quản trị nội dung mãnguồn mở (Opensource Content Management System), người sử dụng thường gọi NukeViet là portal vì nó có khả năng tích hợp nhiều ứng dụng trên nền Web.</p><p> NukeViet có 2 dòng phiên bản chính:</p><p> Dòng phiên bản trước năm 2009 (NukeViet 2.0 trở về trước) được Nguyễn Anh Tú- một lưuhọc sinh người Việt tại Nga - cùng cộng đồng pháttriển thành một ứng dụng thuần Việt từ nền tảngPHP-Nuke.</p><p> Dòng phiên bản NukeViet 3.0 trở về sau (kể từ năm 2010 trở đi) là dòng phiên bản hoàn toàn mới, được xây dựng từ đầu với nhiều tính năng ưu việt.</p><p> NukeViet được viết bằng ngôn ngữ PHP vàchủ yếu sử dụng cơ sở dữ liệu MySQL,cho phép người sử dụng có thể dễ dàng xuất bản &amp;quản trị các nội dung của họ lên Internet hoặc Intranet.</p><p> NukeViet được sử dụng ở nhiều website, từ nhữngwebsite cá nhân cho tới những hệ thống website doanh nghiệp, nó cung cấp nhiều dịch vụ và ứng dụng nhờ khả năngtăng cường tính năngbằng cách cài thêm cácmodule, block... NukeViet có thể dễ dàng cài đặt, dễ dàng quản lý kể cả với những người mới sử dụng.</p><p style=\"text-align: justify;\"> NukeViet là giải pháp hoàn hảo cho các Website từ cá nhân cho tới các doanh nghiệp. NukeViet là bộ mã nguồn chất lượng cao, được phát hành theo giấy phép mã nguồn mở nên việc sử dụng NukeViet hoàn toàn miễn phí. Với người sử dụng cá nhân, tất cả đều có thể tự tạo cho mình một website chuyên nhgieepj mà không mất bất cứ chi phí nào. Với những nhà phát triển Web, sử dụng NukeViet có thể nhanh chóng xây dựng các hệ thống lớn mà việc lập trình không đòi hỏi quá nhiều thời gian vì NukeViet đã xây dựng sẵn hệ thống quản lý ưu việt.</p><p>  </p><p> Thông tin chi tiết về NukeViet có thểtìm thấy ở bách khoa toàn thư mở Wikipedia: <a href=\"http://vi.wikipedia.org/wiki/NukeViet\">http://vi.wikipedia.org/wiki/NukeViet</a></p><p style=\"font-weight: bold;\"> II. Thông tin về diễn đàn NukeViet:</p><p> Diễn đànNukeViet hoạt động trên website: <a href=\"http://nukeviet.vn/\"><span style=\"font-weight: bold;\">http://nukeviet.vn</span></a> hiện có trên 13.000 thành viên thực gồm học sinh, sinh viên &amp; nhiều thànhphần khác thuộc giới trí thức ở trong và ngoài nước.</p><p> Là mộtdiễn đàn của các nhà quản lý website, rất nhiều thành viên trong diễn đànNukeViet là cán bộ, lãnh đạo từ đủ mọi lĩnh vực: công nghệ thông tin, xây dựng,văn hóa - xã hội, thể thao, dịch vụ - du lịch... từ cử nhân, bác sĩ, kỹ sư chođến bộ đội, công an...</p><p> Nhiều họcsinh, sinh viên tham gia diễn đàn NukeViet, đam mê mã nguồn mở và đã thành côngvới chính công việc mà họ yêu thích.</p>', 0, 1, 2, 1, '40|8', 1, 1, 1, 90, 0, 0, 'quản trị, nội dung, sử dụng, khả năng, tích hợp, ứng dụng'), 
(6, '1,8,10', 0, 1, '', 0, 1274994722, 1275318001, 1, 1274994720, 0, 2, 'Thư mời hợp tác liên kết quảng cáo và cung cấp hosting thử nghiệm', 'Thu-moi-hop-tac', 'Hiện tại VINADES.,JSC đang tiến hành phát triển bộ mã nguồn NukeViet phiên bản 3.0 – một thế hệ CMS hoàn toàn mới với nhiều tính năng ưu việt, được đầu tư bài bản với kinh phí lớn. Với thiện chí hợp tác cùng phát triển VINADES.,JSC xin trân trọng gửi lời mời hợp tác đến Quý đối tác là các công ty cung cấp tên miền - hosting, các doanh nghiệp quan tâm và mong muốn hợp tác cùng VINADES để cùng thực hiện chung các hoạt động kinh doanh nhằm gia tăng giá trị, quảng bá thương hiệu chung cho cả hai bên.', '2010_05/hoptac.jpg', '', 'thumb/hoptac.jpg|block/hoptac.jpg', 1, '<div style=\"text-align: center;\"> <h2 style=\"color: rgb(255, 69, 0);\"> THƯ MỜI HỢP TÁC</h2> <h4> TRONG VIỆC LIÊN KẾT QUẢNG CÁO, CUNG CẤP HOSTING THỬ NGHIỆM PHÁT TRIỂN</h4> <h2> MÃ NGUỒN MỞ NUKEVIET</h2> </div> <p style=\"text-align: justify; line-height: 130%; font-weight: bold;\">  </p> <p style=\"text-align: justify; line-height: 130%; font-weight: bold;\"> Kính gửi: QUÍ KHÁCH VÀ ĐỐI TÁC</p> <p style=\"text-align: justify; line-height: 130%; font-style: italic; text-indent: 1cm;\"> Lời đầu tiên, Ban giám đốc công ty cổ phần Phát Triển Nguồn Mở Việt Nam (VINADES.,JSC) xin gửi đến Quý đối tác lời chào trân trọng, lời chúc may mắn và thành công. Tiếp đến chúng tôi xin được giới thiệu và ngỏ lời mời hợp tác kinh doanh.</p> <p style=\"text-align: justify; line-height: 130%; font-style: italic; text-indent: 1cm;\"> VINADES.,JSC ra đời nhằm chuyên nghiệp hóa việc phát hànhmã nguồn mở NukeViet. Đồng thời khai thác các dự án từ NukeViet tạo kinh phí pháttriển bền vững cho mã nguồn này.</p> <p style=\"text-align: justify; line-height: 130%; font-style: italic; text-indent: 1cm;\"> NukeViet là hệ quản trị nội dung, là website đa năng đầutiên của Việt Nam do cộng đồng người Việt phát triển. Có nhiều lợi thế như cộng đồng người sử dụng đông đảo nhất tại Việt Nam hiện nay, sản phẩm thuần Việt, dễ sử dụng, dễ phát triển.</p> <p style=\"text-align: justify; line-height: 130%; font-style: italic; text-indent: 1cm;\"> Hiện tại VINADES.,JSC đang tiến hành phát triển bộ mã nguồn NukeViet phiên bản 3.0 – một thế hệ CMS hoàn toàn mới với nhiều tính năng ưu việt, được đầu tư bài bản với kinh phí lớn.</p> <p style=\"text-align: justify; line-height: 130%; font-style: italic; text-indent: 1cm;\"> Với thiện chí hợp tác cùng phát triển VINADES.,JSC xin trân trọng gửi lời mời hợp tác đến Quý đối tác là các công ty cung cấp tên miền -hosting, các doanh nghiệp quan tâm và mong muốn hợp tác cùng VINADES để cùng thực hiện chung các hoạt động kinh doanh nhằm gia tăng giá trị, quảng bá thương hiệu chung cho cả hai bên.</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm; font-weight: bold;\"> Phương thức hợp tác nhưsau:</p> <p style=\"text-align: justify; line-height: 130%; font-weight: bold;\"> 1.Quảng cáo, trao đổi banner, liên kết website:</p> <p style=\"text-align: justify; line-height: 130%;\"> a. Mô tả hình thức:</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Quảng cáo trên website &amp; hệ thống kênh truyền thông của 2 bên.</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Quảng cáo trên các phiên bản phát hành của mã nguồn mở NukeViet.</p> <p style=\"text-align: justify; line-height: 130%;\"> b, Lợi ích:</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Quảng bá rộng rãi chođối tượng của 2 bên.</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Giảm chi phí quảng bácho 2 bên.</p> <p style=\"text-align: justify; line-height: 130%;\"> c, Trách nhiệm:</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Hai bên sẽ thỏa thuận và đưa quảng cáo của mình vào website của đối tác. Thỏa thuận vị trí, kích thước và trang đặt banner quảng cáo nhằm mang lại hiệu quả cao cho cả hai bên.</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Mở forum hỗ trợ người dùng hosting ngay tại diễn đàn NukeViet.VN để quý công ty dễ dàng hỗ trợ người sử dụng cũng như thực hiện các kế hoạch truyền thông của mình tới cộng đồng NukeViet.</p> <p style=\"text-align: justify; line-height: 130%; font-weight: bold;\"> 2.Hợp tác cung cấp hosting thử nghiệm NukeViet:</p> <p style=\"text-align: justify; line-height: 130%;\"> a. Mô tả hình thức:</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Hai bên ký hợp đồng nguyên tắc &amp; thỏa thuận hợp tác trong việc hợp tác phát triển mã nguồn mở NukeViet. Theo đó:</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> + Phía đối tác cung cấp mỗi loại 1 gói hosting đại lý cho VINADES.,JSC để chúng tôi test trong quá trình phát triển mã nguồn mở NukeViet, để đảm bảo NukeViet sẵn sàng tương thích với hosting của quý khách ngay khi ra mắt.</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> + VINADES.,JSC sẽ công báo thông tin chứng nhận host của phía đối tác là phù hợp, tương thích tốt nhất với NukeViet tới cộng đồng những người phát triển và sử dụng NukeViet.</p> <p style=\"text-align: justify; line-height: 130%;\"> b. Lợi ích:</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Mở rộng thị trường theo cả hướng đối tượng.</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Tiết kiệm chi phí –nâng cao hiệu quả kinh doanh.</p> <p style=\"text-align: justify; line-height: 130%;\"> c. Trách nhiệm:</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Bên đối tác cung cấp miễn phí host để VINADES.,JSC thực hiện việc test tương thích mã nguồn NukeViet trên các gói hosting của đối tác.</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - VINADES.,JSC công bố tới cộng đồng về kết quả chứng nhận chất lượng host của phía đối tác.</p> <p style=\"text-align: justify; line-height: 130%; font-weight: bold;\"> 3,Hợp tác nhân lực hỗ trợ người sử dụng:</p> <p style=\"text-align: justify; line-height: 130%;\"> a, Mô tả hình thức:</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Hai bên sẽ hỗ trợ lẫn nhau trong quá trình giải quyết các yêu cầu của khách hàng.</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> + Bên đối tác gửi các yêu cầu của khách hàng về mã nguồn NukeViet tới VINADES.,JSC</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> + VINADES gửi các yêu cầu của khách hàng có liên quan đến dịch vụ hosting tới phía đối tác.</p> <p style=\"text-align: justify; line-height: 130%;\"> b, Lợi ích:</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Giảm thiểu chi phí, nhân lực hỗ trợ khách hàng của cả 2 bên.</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Tăng hiệu quả hỗ trợ khách hàng.</p> <p style=\"text-align: justify; line-height: 130%;\"> c, Trách nhiệm:</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> - Khi nhận được yêu cầu hỗ trợ VINADES hoặc bên đối tác cần ưu tiên xử lý nhanh gọn nhằm nâng cao hiệuquả của sự hợp tác song phưong này.</p> <p style=\"text-align: justify; line-height: 130%; font-weight: bold;\"> 4. Các hình thức khác:</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> Ngoài các hình thức đã đề xuất ở trên, là đơn vị phát hành mã nguồn mở NukeViet chúng tôi có thể phát hành quảng cáo trên giao diện phần mềm, trên các bài viết giới thiệu xuất hiện ngay sau khi cài đặt phần mềm… chúng tôi tin tưởng rằng với lượng phát hành lên đến hàng chục ngàn lượt tải về cho mỗi phiên bản là một cơ hội quảng cáo rất hiệu quả đến cộng đồng Webmaster Việt Nam.</p> <p style=\"text-align: justify; line-height: 130%; text-indent: 1cm;\"> Với mong muốn tạo nên cộng đồng phát triển và sử dụng NukeViet rộng lớn đúng như mục tiêu đề ra,chúng tôi luôn linh động trong các hình thức hợp tác nhằm mang lại sự thuận tiện cho đối tác cũng như mục tiêu hợp tác đa phương. Chúng tôi sẽ tiếp nhận các hình thức hợp tác khác mà bên đối tác trình bày hợp lý và hiệu quả, mong nhận được thêm nhiều hình thức hợp tác khác từ đối tác. Phương châm của chúng tôi “Cùng hợp tác để phát triển”.</p> <p style=\"text-align: justify; line-height: 130%; font-style: italic; text-indent: 1cm;\"> Trân trọng cảm ơn, rất mong được hợp tác cùng quý vị.</p> <span style=\"font-weight: bold;\">Thông tin liên hệ:</span> <p style=\"text-align: justify;\"> CÔNGTY CỔ PHẦN PHÁT TRIỂN NGUỒN MỞ VIỆT NAM (VINADES.,JSC)</p> <p style=\"text-align: justify; text-indent: 1cm;\"> Trụ sở chính: 67B (ngõ 35) phố Khương Hạ, Khương Đình, ThanhXuân, Hà Nội.</p> <p style=\"text-align: justify; text-indent: 1cm;\"> Điện thoại: (84-4) 85 872007</p> <p style=\"text-align: justify; text-indent: 1cm;\"> Fax: (84-4) 35 500 914</p> <p style=\"text-align: justify; text-indent: 1cm;\"> Website: <a href=\"http://www.vinades.vn/\">www.vinades.vn</a> – <a href=\"http://www.nukeviet.vn/\">www.nukeviet.vn</a></p> <p style=\"text-align: justify; text-indent: 1cm;\"> Email: <a href=\"mailto:contact@vinades.vn\">contact@vinades.vn</a></p>', 0, 1, 2, 1, '29|8', 1, 1, 1, 73, 0, 0, 'hiện tại, tiến hành, phát triển, phiên bản, thế hệ, hoàn toàn, tính năng, ưu việt, kinh phí, thiện chí, hợp tác, trân trọng, mời hợp tác, đối tác, các công ty, công ty, cung cấp, tên miền, các doanh, doanh nghiệp, quan tâm')";

$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_news_sources` VALUES
(1, 'Hanoimoi.com.vn', '', '', 1, 1274989177, 1274989177), 
(2, 'nukeviet.vn', '', '', 2, 1274989787, 1274989787)";

$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_news_topics` VALUES
(1, 'NukeViet 3', 'NukeViet-3', '', '', 'NukeViet 3', 1, 'NukeViet 3', 1274990212, 1274990212)";

$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_news_block_cat` (`bid`, `adddefault`, `number`,`title`, `alias`, `image`, `thumbnail`, `description`, `weight`, `keywords`, `add_time`, `edit_time`) VALUES
(1, 0, 4,'Tin tiêu điểm', 'Tin-tieu-diem', '', '', 'Tin tiêu điểm', 1, '', 1279945710, 1279956943),
(2, 1, 4, 'Tin mới nhất', 'Tin-moi-nhat', '', '', 'Tin tiêu điểm', 2, '', 1279945725, 1279956445)";

$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_news_block` VALUES
(1, 5, 3), 
(1, 2, 2), 
(1, 1, 1), 
(2, 6, 4), 
(2, 5, 3), 
(2, 2, 2), 
(2, 1, 1)";

$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_voting` VALUES
(2, 'Bạn biết gì về NukeViet 3?', 1, 1, 0, '0', 1275318563, 0, 1), 
(3, 'Bạn quan tâm gì nhất ở mã nguồn mở?', 1, 1, 0, '0', 1275318589, 0, 1)";

$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_voting_rows` VALUES
(5, 2, 'Một bộ sourcecode cho web hoàn toàn mới.', 0), 
(6, 2, 'Mã nguồn mở, sử dụng miễn phí.', 0), 
(7, 2, 'Sử dụng xHTML, CSS và hỗ trợ Ajax', 0), 
(8, 2, 'Tất cả các ý kiến trên', 0), 
(9, 3, 'Liên tục được cải tiến, sửa đổi bởi cả thế giới.', 0), 
(10, 3, 'Được sử dụng miễn phí không mất tiền.', 0), 
(11, 3, 'Được tự do khám phá, sửa đổi theo ý thích.', 0), 
(12, 3, 'Phù hợp để học tập, nghiên cứu vì được tự do sửa đổi theo ý thích.', 0), 
(13, 3, 'Tất cả các ý kiến trên', 0)";

$sql_create_table[] = "INSERT INTO `" . $db_config['prefix'] . "_vi_about` (`id`, `title`, `alias`, `bodytext`, `keywords`, `weight`, `admin_id`, `add_time`, `edit_time`, `status`) VALUES 
(1, 'Giới thiệu về NukeViet 3.0', 'Gioi-thieu-ve-NukeViet-3-0', '<p> NukeViet 3.0 là thế hệ CMS hoàn toàn mới do người Việt phát triển. Lần đầu tiên ở Việt Nam, một bộ nhân mã nguồn mở được đầu tư bài bản và chuyên nghiệp cả về tài chính, nhân lực và thời gian. Kết quả là 100% dòng code của NukeViet được viết mới hoàn toàn, NukeViet 3 sử dụng xHTML, CSS với Xtemplate và jquery cho phép vận dụng Ajax uyển chuyển cả trong công nghệ nhân.</p><p> Tận dụng các thành tựu mã nguồn mở có sẵn nhưng NukeViet 3 vẫn đảm bảo rằng từng dòng code là được code tay (NukeViet 3 không sử dụng bất cứ một nền tảng (framework) nào). Điều này có nghĩa là NukeViet 3 hoàn toàn không phụ thuộc vào bất cứ framework nào trong quá trình phát triển của mình; Bạn hoàn toàn có thể đọc hiểu để tự lập trình trên NukeViet 3 nếu bạn biết PHP và MySQL (đồng nghĩa với việc NukeViet 3 hoàn toàn mở và dễ nghiên cứu cho bất cứ ai muốn tìm hiểu về code của NukeViet).</p><p style=\"text-align: justify;\"> Bộ nhân NukeViet 3 ngoài việc thừa hưởng sự đơn giản vốn có của NukeViet nhưng không vì thế mà quên nâng cấp mình. Hệ thống NukeViet 3 hỗ trợ công nghệ đa nhân module. Chúng tôi gọi đó là công nghệ ảo hóa module. Công nghệ này cho phép người sử dụng có thể khởi tạo hàng ngàn module một cách tự động mà không cần động đến một dòng code. Các module được sinh ra từ công nghệ này gọi là module ảo. Module ảo là module được nhân bản từ một module bất kỳ của hệ thống nukeviet nếu module đó cho phép tạo module ảo.</p><p style=\"text-align: justify;\"> NukeViet 3 cũng hỗ trợ việc cài đặt từ động 100% các module, block, theme từ Admin Control Panel, người sử dụng có thể cài module mà không cần làm bất cứ thao tác phức tạp nào. NukeViet 3 còn cho phép bạn đóng gói module để chia sẻ cho người khác.</p><p style=\"text-align: justify;\"> NukeViet 3 đa ngôn ngữ 100% với 2 loại: đa ngôn ngữ giao diện và đa ngôn ngữ database. NukeViet 3 có tính năng&nbsp; cho phép người quản trị tự xây dựng ngôn ngữ mới cho site. Cho&nbsp; phép đóng gói file ngôn ngữ để chia sẻ cho cộng đồng... câu chuyện về nukeviet 3 sẽ còn dài vì một loạt các tính năng cao cấp vẫn đang được phát triển. Hãy sử dụng và phổ biến NukeViet 3 để tự mình tận hưởng những thành quả mới nhất từ công nghệ web mã nguồn mở. Cuối cùng NukeViet 3 là món của của VINADES.,JSC gửi tới cộng đồng để cảm ơn cộng đồng đã ủng hộ thời gian qua, bây giờ NukeViet 3 được đưa trở lại cộng đồng để hy vọng NukeViet 3 tiếp tục lớn mạnh hơn.</p><p style=\"text-align: justify;\"> Mọi ý kiến về NukeViet 3 các bạn vui lòng gửi về email: admin@nukeviet.vn Tất cả các góp ý của các bạn đều có ý nghĩa cho NukeViet nhằm cải thiện và nâng cao tính năng. Mọi góp ý đều được hoanh nghênh.</p>', '',1, 1, 1275320174, 1275320174, 1), 
(2, 'Giới thiệu về công ty chuyên quản NukeViet', 'Gioi-thieu-ve-cong-ty-chuyen-quan-NukeViet', '<p style=\"text-align: justify;\"> Để chuyên nghiệp hóa việc phát hành mã nguồn mở NukeViet, Ban Quản Trị NukeViet quyết định thành lập doanh nghiệp chuyên quản NukeViet mang tên CÔNG TY CỔ PHẦN PHÁT TRIỂN NGUỒN MỞ VIỆT NAM - Tên giao dịch tiếng Anh: VIET NAM OPEN SOURCE DEVELOPMENT JOINT STOCK COMPANY (viết tắt: VINADES.,JSC). Nhiệm vụ công ty ngoài việc phát hành, phát triển hệ thống NukeViet sẽ có thêm nhiệm vụ triển khai các dự án để tạo kinh phí duy trì hoạt động lâu dài cho NukeViet. Trên tinh thần đó công ty sẽ phát triển bộ mã nguồn NukeViet nhất quán theo con đường mã nguồn mở đã chọn - tự do và miễn phí nhưng chuyên nghiệp và quy mô hơn bao giờ hết.</p><p style=\"text-align: justify;\"> Thông tin ra mắt công ty VINADES có thể tìm thấy trên trang 7 báo Hà Nội Mới ra ngày 25/02/2010 (<a href=\"http://hanoimoi.com.vn/newsdetail/Cong_nghe/309750/ra-mat-cong-ty-ma-nguon-mo-dau-tien-tai-viet-nam.htm\" target=\"_blank\">xem chi tiết</a>), Bản tin tiếng Anh của đài tiếng nói Việt Nam ngày 26/02/2010 (<a href=\"http://english.vovnews.vn/Home/First-opensource-company-starts-operation/20102/112960.vov\" target=\"_blank\">xem chi tiết</a>) và các trang tin tức, báo điện tử khác (<a href=\"http://www.google.com.vn/search?q=%22Ra+m%E1%BA%AFt+c%C3%B4ng+ty+m%C3%A3+ngu%E1%BB%93n+m%E1%BB%9F+%C4%91%E1%BA%A7u+ti%C3%AAn+t%E1%BA%A1i+Vi%E1%BB%87t+Nam%22&amp;ie=utf-8&amp;oe=utf-8&amp;aq=t&amp;rls=org.mozilla:vi:official&amp;client=firefox-a\" target=\"_blank\">xem chi tiết</a>)</p><div id=\"content\"> <strong><span style=\"font-family: tahoma; color: rgb(255, 69, 0); font-size: 14px;\">Mã nguồn mở - xu hướng của thế giới – lựa chọn cho Việt Nam</span></strong><br  /> <p style=\"text-align: justify;\"> Sử dụng và mở hóa mã nguồn dường như đã thành xu hướng tất yếu của thế giới. Không tách khỏi dòng chảy công nghệ, Việt Nam đã và đang từng bước hòa nhập vào dòng chảy ấy. Bắt đầu cho xu hướng phát triển mã nguồn mở (open source) phải nói đến nỗ lực cổ vũ cho việc sử dụng mã nguồn mở của cộng đồng mạng Việt Nam.</p> <p style=\"text-align: justify;\"> Sau một thời gian dài nỗ lực, các sản phẩm mã nguồn mở đã đến với cộng đồng người Việt và bây giờ là ăn sâu trong tiềm thức người dùng như một phần tất yếu của thế giới công nghệ. Vậy nên, dù là công dân mạng hay người dùng máy tính thông thường, dù là dân công nghệ thông tin (IT) hay là nhân viên văn phòng, dù có tham gia lập trình hay không thì một điều chắc chắn rằng bất cứ ai trong chúng ta cũng đã và đang sử dụng các phần mềm mã nguồn mở.</p> <p style=\"text-align: justify;\"> Sản phẩm mã nguồn mở tạo web NukeViet cũng là một trong những sản phẩm quen thuộc của cộng đồng IT Việt Nam. NukeViet đã được phát triển trong hơn 5 năm qua, được sử dụng ở nhiều website lớn nhỏ thuộc nhiều lĩnh vực khác nhau.</p></div>', '', 2, 1, 1275320224, 1275320224, 1)";

$disable_site_content = "Vì lý do kỹ thuật website tạm ngưng hoạt động. Thành thật xin lỗi các bạn vì sự bất tiện này!";
$copyright = "Chú ý: Việc đăng lại bài viết trên ở website hoặc các phương tiện truyền thông khác mà không ghi rõ nguồn http://nukeviet.vn là vi phạm bản quyền";

$sql_create_table[] = "UPDATE `" . $db_config['prefix'] . "_config` SET `config_value` =  " . $db->dbescape_string( $disable_site_content ) . " WHERE `module` =  'global' AND `config_name` = 'disable_site_content' AND `lang`='vi'";
$sql_create_table[] = "UPDATE `" . $db_config['prefix'] . "_config` SET `config_value` =  " . $db->dbescape_string( $copyright ) . " WHERE `module` =  'news' AND `config_name` = 'copyright' AND `lang`='vi'";

$array_cron_name = array();
$array_cron_name[1] = 'Xóa các dòng ghi trạng thái online đã cũ trong CSDL';
$array_cron_name[2] = 'Tự động lưu CSDL';
$array_cron_name[3] = 'Xóa các file tạm trong thư mục tmp';
$array_cron_name[4] = 'Xóa IP log files Xóa các file logo truy cập';
$array_cron_name[5] = 'Xóa các file error_log quá hạn';
$array_cron_name[6] = 'Gửi email các thông báo lỗi cho admin';
$array_cron_name[7] = 'Xóa các referer quá hạn';

$result = $db->sql_query( "SELECT `id`, `run_func` FROM `" . $db_config['prefix'] . "_cronjobs` ORDER BY `id` ASC" );
while ( list( $id, $run_func ) = $db->sql_fetchrow( $result ) )
{
    $cron_name = ( isset( $array_cron_name[$id] ) ) ? $array_cron_name[$id] : $run_func;
    $sql_create_table[] = "UPDATE `" . $db_config['prefix'] . "_cronjobs` SET `" . $lang_data . "_cron_name` =  " . $db->dbescape_string( $cron_name ) . " WHERE `id`=" . $id;
}
$db->sql_freeresult();

?>