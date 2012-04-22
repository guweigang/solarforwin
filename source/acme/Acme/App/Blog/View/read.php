<?php $this->head()->setTitle($this->item->title); ?>
<h2><?php echo $this->escape($this->item->title); ?></h2>
<p>作者: <?php echo $this->item->author->name;?></p>
<?php echo $this->nl2p($this->item->body);?>
<br />
<?php echo $this->action("{$this->controller}/edit/{$this->item->id}",'ACTION_EDIT');?>
&nbsp;&nbsp;
<?php echo $this->action("{$this->controller}/delete/{$this->item->id}",'ACTION_DELETE');?>

<p>Tags: <?php echo implode(', ', $this->item->tags->getColVals('name'));?></p>

<?php if(NULL != $this->comment && 0 < $this->comment->count()): ?>
<p style="background-color: #8A080A; color: #FDDD9A; width: 400px; height: 30px; line-height: 30px;font-weight:bold;">所有留言</p>
<?php foreach($this->comment as $comment):?>
<div>
    <?php echo $comment['title']; ?>
</div>
<?php endforeach; ?>
<?php echo $this->pager($this->comment->getPagerInfo()); ?>

<?php endif;?>