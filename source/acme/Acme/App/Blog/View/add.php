<?php
    $title = $this->getTextRaw('TITLE_ADD');
    $this->head()->setTitle($title);
?>

<h2><?php echo $this->getText('HEADING_ADD'); ?></h2>

<?php
    echo $this->form()
              ->auto($this->form)
              ->decorateAsDivs()
              ->addProcess('save')
              ->fetch();
?>