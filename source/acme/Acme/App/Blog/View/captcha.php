<img align="bottom" id="siimage" border="0" align="bottom" onclick="this.blur()" alt="Reload Image" src="'.$this->actionHref('/admin/login.png').'">

<object style="display: block" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3">
    <param name="allowScriptAccess" value="sameDomain" />
    <param name="allowFullScreen" value="false" />
    <param name="movie" value="'.$this->publicHref('/Solar/View/Helper/Pager/captcha/securimage_play.swf').'?audio='.$this->actionHref('/admin/captcha.mp3').'&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
    <param name="quality" value="high" />
    <param name="bgcolor" value="#ffffff" />
    <embed src="'.$this->publicHref('/Solar/View/Helper/Pager/captcha/securimage_play.swf').'?audio='.$this->actionHref('/admin/captcha.mp3').'&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>

<a onclick="$(\'#siimage\').attr(\'src\', \''.$this->actionHref('/admin/captcha.png').'?sid=\' + Math.random()); return false"
href="#" title="点击换张图片" style="border-style: none">
    <img src="'.$this->publicHref('/Solar/View/Helper/Pager/captcha/images/refresh.gif').'" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" />
</a>