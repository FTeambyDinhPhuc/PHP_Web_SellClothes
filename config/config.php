<?php
error_reporting(0); // Dòng tắt báo lỗi
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

define('DB_HOST', 'pma.phatdev.xyz');
define('DB_USER', 'phatdevx_fteam_clothes');
define('DB_PASS', 'fteam_clothes');
define('DB_NAME', 'phatdevx_fteam_clothes');
define('DATA_PER_PAGE', 20); // Số dữ liệu hiển thị trên mỗi trang
define('ADMIN_PASSWORD', '123456');

require_once('function.php');
require_once('class.php');

new DB();
