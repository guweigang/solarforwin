<?php
// Solar system directory
$system = dirname(dirname(__FILE__));

// set the include-path
// -----------------------------------------
// 为了能够在解压后第一时间运行“Hello World!”示例，
// 所以在设置include路径时做了一个判断。
// 在生产环境中，你需要在include目录下链接/拷贝Solar内核
// 并仅使用下面这条语句包括Solar内核，删除line 14 - line 24
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

// start Solar with system config file
$config = "$system/config.php";
Solar::start($config);

// instantiate and run the front controller
$front = Solar_Registry::get('controller_front');
$front->display();

// Done!
Solar::stop();
