<?php
/**
 *
 * author life
 *
 */
class Solar_Debug {
	protected $_is_ajax = false;
	protected $_total_time; // 执行总时间
	protected $_included_files;  // 所包含的文件
	protected $_sql_debug; // Solar_Sql::$sql_debug
	protected $_sql_total_time; // SQL语句执行总时间
	protected $_end_time; // 结束时间
	protected $_solar_sql; // Solar_Sql对象

	protected $_debug_header = './debug/debug_header.php';
	protected $_debug_data = './debug/debug_data.php';
	protected $_debug_data_log = './debug/debug_data_log.php'; // 非 ajax sql的日志
	protected $_debug_data_ajax_log = './debug/debug_data_ajax_log.php'; // ajax sql的日志

	function __construct() {
		$this->_end_time = microtime(true);
		$this->_included_files = get_included_files();
		$this->_sql_debug = Solar_Sql_Adapter::$sql_debug;

		// 判断是否是ajax请求
		$request = Solar_Registry::get('request');
		if($request->isXhr()) $this->_is_ajax = true;
	}

	/**
	 * 
	 * 得到函数的参数列表
	 *
	 * @return string
	 *
	 */
	protected function _getArgs($args) {
		$args_str = '';
		foreach ($args as $a) {
			if (!empty($args_str)) {
				$args_str .= ', ';
			}
			switch (gettype($a)) {
				case 'integer':
				case 'double':
					$args_str .= $a;
					break;
				case 'string':
					$a = htmlspecialchars(substr($a, 0, 64)).((strlen($a) > 64) ? '...' : '');
					$args_str .= "\"$a\"";
					break;
				case 'array':
					$args_str .= 'Array('.count($a).')';
					break;
				case 'object':
					$args_str .= 'Object('.get_class($a).')';
					break;
				case 'resource':
					$args_str .= 'Resource('.strstr($a, '#').')';
					break;
				case 'boolean':
					$args_str .= $a ? 'True' : 'False';
					break;
				case 'NULL':
					$args_str .= 'Null';
					break;
				default:
					$args_str .= 'Unknown';
			}
		}

		return $args_str;
	}

	/**
	 * 
	 * 得到调用的trace
	 * 调用_getArgs()
	 *
	 */
	protected function _getCallTrace($backtrace) {
		$output = "<table><thead><tr><th>#</th><th>file</th><th>line</th><th>function</th></tr></thead>";
		$n = 0;

		foreach($backtrace as $bt) {
			$args = $this->_getArgs($bt['args']);
		
			$output .= "<tr><td>{$n}</td><td>{$bt["file"]}</td><td>{$bt["line"]}</td><td> {$bt['class']}{$bt['type']}{$bt['function']}($args)</td></tr>";
			$n++;
		}
		$output .= "</table>";

		return $output;
	}

	protected function _getSqlDebugBody() {
		$this->_solar_sql = Solar::factory('Solar_Sql');
		$out = '';
		if($this->_is_ajax) {
			$uri = Solar::factory('Solar_Uri_Action');
			$out = '<tr class="ajax_sql_uri"><td colspan="3">'. $uri->get(). ' ('. count($this->_sql_debug).')</td></tr>';
		}
		$n = 1;
		foreach((array) $this->_sql_debug as $each) {
			$explain_sql = $this->_getExplainSql($each['sql']);
			$call_trace = $this->_getCallTrace($each['backtrace']);

			$out .= '<tr><td width="2px" class="sql_seq">'. $n++. '</td><td width="60px">'. $each['time']. '</td>';
			$out .= '<td class="sql_trace"><div class="sql_trace_op">格式化Sql</div><div class="sql_trace_sql">'. $each['sql']. '</div>';
			$out .= '<hr /><div class="call_trace_op">详情</div><div class="call_trace_call">'. $explain_sql. $call_trace. '</div></td></tr>';
		}

		return $out;
	}
	/**
	 *
	 * SQL, 得到总的SQL语句, 执行时间, 执行的call trace
	 *
	 */
	protected function _getSqlDebug($sql_body) {
		$class = $this->_is_ajax ? 'ajax_sql_content' : 'sql_content';
		$out = '<div id="'. $class. '"><table><thead><tr><th>#</th><th>Time</th><th>Sql & Call Backtrace</th></thead>';
		$out .= $sql_body;
		$out .= '</table></div>';

		return $out;
	}

	/**
	 *
	 * Explain SQL语句, 得到查询的状态
	 * SHOW COLUMNS FROM table_name 不能用EXPLAIN
	 *
	 */
	protected function _getExplainSql($sql) {
		if(substr($sql, 0, 6) != 'SELECT') return '';

		$re = $this->_solar_sql->fetchOne('EXPLAIN '. $sql);
		$out = '<table class="explain_sql"><tr>';
		$cols = array('id', 'select_type', 'table', 'type', 'possible_keys', 'key', 'key_len', 'ref', 'rows', 'extra');
		$value = '';
		foreach($cols as $col) {
			$out .= "<th>$col</th>";
			$value .= "<td>{$re[$col]}</td>";
		}
		$out .= '</tr>';
		$out .= "<tr>$value</tr>";

		return $out;
	}

	/**
	 *
	 * 得到所包含的文件列表
	 * 
	 */
	protected function _getIncludedFile() {
		$out = '<div id="file_content"><table><tr><th width="5px">#</th><th width="70px">Type</th><th>File</th></tr>';
		$n = 1;
		$type_zh = array(
			'Helper' => '辅助类', 'Page\Layout' => '布局', 'Page\View' => '视图', 
			'Model' => '模型', 'Sql' => '数据库', 'config' => '配置', 'Locale' => '语言', 
			'User' => '用户', 'Auth' => '用户访问', 'Role' => '用户角色', 'Access' => '访问控制', 
			'Cache' => '缓存', 'Session' => 'Session', 'Filter' => '过滤器', 'Func' => '函数');

		foreach($this->_included_files as $file) {
			$find = false;
			foreach($type_zh as $key => $val) {
				if(strpos($file, $key)) {
					$type = $val;
					$find = true;
					break;
				}
			}
			if(!$find) $type = 'Solar';
			$out .= "<tr><td>$n</td><td>$type</td><td>$file</td></tr>";
			$n++;
		}
		$out .= "</table></div>";
		
		return $out;
	}

	/**
	 *
	 * 总方法
	 *
	 */
	public function debug() {
		// 不是ajax请求才生成debug_header.php文件
		if(!$this->_is_ajax) {
			$nav = $this->_getDebugNav(); // 得到sql和file的导航
			file_put_contents($this->_debug_header, $nav);

			// 非ajax请求 生成debug_data.php
			// SQL DEBUG & Files
			$out = $this->_getSqlDebug($this->_getSqlDebugBody());
			$out .= $this->_getIncludedFile();
			file_put_contents($this->_debug_data, $out);
			file_put_contents($this->_debug_data_log, $out);

			// 删除ajax data文件
			@unlink($this->_debug_data_ajax_log);
		} else {
			// sql_debug serialize 追加到 ajax log 里
			$pre_log = '';
			if(file_exists($this->_debug_data_ajax_log)) {
				$pre_log = file_get_contents($this->_debug_data_ajax_log);
			}
			$sql_body = $this->_getSqlDebugBody(). $pre_log;

			// 写入log
			file_put_contents($this->_debug_data_ajax_log, $sql_body);

			// 追加到debug_data.php
			$out = file_get_contents($this->_debug_data_log). $this->_getSqlDebug($sql_body);
			file_put_contents($this->_debug_data, $out);
		}
	}

	/**
	 * 
	 * 得到导航 作为debug_header.php
	 *
	 */
	protected function _getDebugNav() {
		$out = '<table id="debug_nav">';
		$out .= $this->_getDebugCaption();
		$out .= '<tr>';
		$out .= $this->_getSqlDebugNav();
		$out .= $this->_getIncludedFileNav();
		$out .= '<td id="cookie_nav" width="25%">Cookie</td>';
		$out .= '</tr></table>';

		return $out;
	}

	/**
	 *
	 * SQL nav
	 *
	 */
	protected function _getSqlDebugNav() {
		// 得到总SQL执行时间
		$this->_sql_total_time = 0;
		foreach((array)$this->_sql_debug as $each) {
			$this->_sql_total_time += $each['time'];
		}

		return '<td id="sql_nav" width="25%">共 <span class="obvious">'. count($this->_sql_debug).'</span> 条Sql语句 - <span class="obvious">'. $this->_sql_total_time. '</span> secs</td><td id="sql_ajax_nav" width="25%"> Ajax Sql </td>';
	}

	/**
	 *
	 * File nav
	 *
	 */
	protected function _getIncludedFileNav() {
		return '<td id="file_nav" width="25%">共 <span class="obvious">'. count($this->_included_files). '</span> 个文件 - <span class="obvious">'. ($this->_total_time - $this->_sql_total_time). '</span> secs</td>';
	}

	/**
	 *
	 * <table><caption></table>
	 *
	 */
	protected function _getDebugCaption() {
		$this->_total_time = number_format($this->_end_time - Solar::$start_time, 6);
		$out = '<caption>用时: <span class="obvious">'. $this->_total_time. '</span> secs &nbsp;&nbsp;&nbsp;';

		$m = function_exists('memory_get_usage') ? number_format(memory_get_usage()) : '';
		$mt = function_exists('memory_get_peak_usage') ? number_format(memory_get_peak_usage()) : '';
		$out .= '内存: <span class="obvious">'.$m.'</span> bytes. '.($mt ? ' 峰值 <span class="obvious">'.$mt.'</span> bytes' : '');
		$out .= '</caption>';

		return $out;
	}
}
