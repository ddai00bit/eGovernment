<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 05/07/2010 09:47
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$module_version = array(
    'name' => 'Page',
    'modfuncs' => 'main,rss',
    'is_sysmod' => 1,
    'virtual' => 1,
    'version' => '4.3.04',
    'date' => 'Friday, November 16, 2018 9:59:52 AM GMT+07:00',
    'author' => 'VINADES <contact@vinades.vn>',
    'note' => '',
    'uploads_dir' => array(
        $module_upload
    )
);