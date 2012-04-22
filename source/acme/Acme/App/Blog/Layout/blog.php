<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh" dir="ltr">
<head>
<?php
    $title = $this->getTextRaw('TITLE_INDEX');
    echo $this->head()
         ->setTitle($title)
         ->addMetaHttp('Content-Type', 'text/html; charset=utf-8')->fetch();
?>
</head>
<body>
<?php echo $this->layout_content; ?>


</body>
</html>