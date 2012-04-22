<?php
/**
 *
 * This bootstrap file is intended only for first-time users who have dumped
 * the system directly into their document root.  We make some special
 * allowances for that in this file, even though it is **not secure at all**.
 *
 * When you're ready to really get going, point your web server document root
 * to `system/docroot/` and turn on mod_rewrite.
 *
 */

// Solar system directory
$system = dirname(__FILE__);

// set the include-path
// -----------------------------------------
// 为了能够在解压后第一时间运行“Hello World!”示例，
// 所以在设置include路径时做了一个判断。
// 在生产环境中，你需要在include目录下链接/拷贝Solar内核
// 并仅使用下面这条语句包括Solar内核，删除line 25 - line 35
// -----------------------------------------
// set_include_path("$system/include");
// update by Roy Gu 2010-11-11
if (file_exists("{$system}\include\Solar") &&
    file_exists("{$system}\include\Solar.php") &&
    is_dir("{$system}\include\Solar") &&
    is_file("{$system}\include\Solar.php")
) {
    $include = "{$system}\include".PATH_SEPARATOR.".";
} else {
    $include = "{$system}\include".PATH_SEPARATOR.
               "{$system}\source\solar".PATH_SEPARATOR.".";
}
set_include_path($include);

// load Solar
require_once 'Solar.php';

// get the system config array
$config = require "$system/config.php";

// force the Action and Public URI path configs, overwriting anything from
// the original config
$path = $_SERVER['REQUEST_URI'];
$pos = strpos($path, "/index.php");
if ($pos !== false) {
    // strip "/index.php" and everything after it
    $path = substr($path, 0, $pos);
}
$path = rtrim($path, '/');
$config['Solar_Uri_Action']['path'] = "$path/index.php";
$config['Solar_Uri_Public']['path'] = "$path/docroot/public";

// start Solar with the modified config values
Solar::start($config);

// instantiate and run the front controller
$front = Solar_Registry::get('controller_front');
$front->display();

// Done!
Solar::stop();
