<?php
$title = $this->getTextRaw('TITLE_EDIT');
$this->head()->setTitle($title);
?>
<h2><?php echo $this->getText('HEADING_EDIT'); ?></h2>

<?php
echo $this->form()
          ->auto($this->form)
          ->decorateAsDivs()
          ->addProcess('save')
          ->fetch();
?>