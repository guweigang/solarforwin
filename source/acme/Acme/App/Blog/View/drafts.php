<?php
$title = $this->getTextRaw('TITLE_DRAFTS');
$this->head()->setTitle($title);
?>
<h2><?php echo $this->getText('HEADING_DRAFTS'); ?></h2>
<?php if(! $this->list): ?>
    <p><?php echo $this->getText('ERR_NO_RECORDS'); ?></p>
<?php else: ?>
    <ul>
    <?php foreach($this->list as $item): ?>
    <li><?php
        echo $this->escape($item->title);
        echo "&nbsp;&nbsp";
        echo $this->action("{$this->controller}/edit/{$item->id}","ACTION_EDIT");
    ?></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
<p><?php
    echo $this->action("{$this->controller}/add", "ACTION_ADD");
?></p>