<?php
    $title = $this->getTextRaw('TITLE_DELETE');
    $this->head()->setTitle($title);
?>

<h2><?php echo $this->getText('HEADING_DELETE'); ?></h2>

<h3><?php echo $this->escape($this->item->title); ?></h3>

<?php echo $this->nl2p($this->item->body); ?>

<?php
echo $this->form()
          ->addProcess('delete')
          ->fetch();
?>