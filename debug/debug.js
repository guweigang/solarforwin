//
// Solar_Debug
// life
//
$(document).ready(function() {
	var cookies = getCookies();
	$('#cookie_content').html(cookies);

	// 显示或隐藏 call trace
	$('.call_trace_op').live('click', function() {
		if($(this).next().css('display') == 'none') {
			$(this).next().css('display', 'block');
			$(this).html('隐藏');
		} else {
			$(this).next().css('display', 'none');
			$(this).html('详情');
		}
	});

	// 格式化SQL代码
	$('.sql_trace_op').live('click', function() {
		var sql_code_obj = $(this).next();
		var sql_code = $(sql_code_obj).html();
		if(sql_code.substr(0, 5) == '<pre>') {
			$(sql_code_obj).html($(sql_code_obj).children('pre').html());
			$(this).html('格式化Sql');
		} else {
			$(sql_code_obj).html('<pre>' + sql_code + '</pre>');
			$(this).html('返回');
		}
	});

	// 点击导航td, 显示子信息
	$('#debug_nav td').click(function() {
		var id_name = $(this).attr('id');
		var content_id = id_name.substr(0, id_name.indexOf('_nav')) + '_content';

		var ids = ['sql_content', 'file_content', 'ajax_sql_content', 'cookie_content'];
		// 先全部隐藏
		for(var i in ids) {
			$('#' + ids[i]).hide();
		}
		if($('#' + content_id).css('display') == 'none') {
			$('#' + content_id).show();
		} else {
			$('#' + content_id).hide();
		}
	});

	function getSrc(src) {
		var pos = src.indexOf('?');
		if(pos != -1) {
			src = src.substr(0, pos);
		}
		src += '?ajax=1';
		return src;
	}

	// ajax sql
	$('#sql_ajax_nav').click(function() {
		// 表明不是iframe中打开debug的!
		if(window.top == window.self) {
			src = window.location.href;
			src = getSrc(src);
			window.location.href = src;
			return;
		}

		var iframe = $(window.parent.document).find("#debug_iframe");
		var src = $(iframe).attr('src');
		src = getSrc(src);
		
		$(iframe).attr('src', src);
	});

	// 鼠标在tr, 样式改变	
	$('#sql_content tr, li').live('mouseover', function() {
//        $(this).addClass('tr_hover');
	});
	$('#sql_content tr, li').live('mouseout', function() {
//        $(this).removeClass('tr_hover');
	});
	// ajax sql content  seq
//    var n = 1;
//    $('.ajax_sql_content .sql_seq').each(function() {
//        $(this).html(n++);
//    });
//    $('.sql_ajax_nav').append('(<span class="obvious">' + (n - 1) + '</span>)');
});

// 获取全部Cookie
function getCookies() {
	var cookies = document.cookie.split("; ");
	var cookies_str = '<ul>';
	for(var i = 0; i < cookies.length; i++) {
		var temp = cookies[i].split("=");
		cookies_str += '<li>[\'' + temp[0] + '\'] => ' + temp[1] + '</li>';
	}
	cookies_str += '</ul>';
	$('#cookie_nav').append(' - <span class="obvious">(' + cookies.length + ')</span>');
	return cookies_str;
}
getCookies();

