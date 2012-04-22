
<style>
div.operate{border: 1px black solid; width: 500px;}
div.operate ul{list-style:none; margin: 2px 0 2px 0;}
div.operate ul li{float:left; padding-left:3px;}
.clear{clear:both;}
</style>
<a href="<?php echo '/'.$this->controller;?>"><img src="/public/Acme/App/Blog/solar-blog.png" /></a>
<h2><?php echo $this->getText('HEADING_INDEX'); ?></h2>
<div class="operate">
<ul>
    <li><?php echo $this->action("{$this->controller}/add",'ACTION_ADD');?></li>
    <li><?php echo $this->action("{$this->controller}/index/public",'ACTION_INDEX_PUBLIC');?></li>
    <li><?php echo $this->action("{$this->controller}/index/draft",'ACTION_INDEX_DRAFT');?></li>
    <div class="clear"></div>
</ul>
</div>
<?php if (! $this->list): ?>
    <p><?php echo $this->getText('ERR_NO_RECORDS'); ?></p>
<?php else: ?>
    <ul>
        <?php foreach($this->list as $item): ?>
            <li><?php
                echo $this->escape($item->title);
                echo "&nbsp;&nbsp;";
                echo $item->author->name;
                echo "&nbsp;&nbsp;";
                echo $item->summary->comment_count;
                echo "&nbsp;&nbsp;";
                echo $this->action("{$this->controller}/read/{$item->id}",'ACTION_READ');
                echo "<br />";
		        echo '共有 '.$item->comments->count().' 条留言<br />';
		        $comments = $item->comments->toArray();
                echo '<ul>';
                $paging = 2;
                $comments = array_slice($comments, 0, $paging);
                foreach($comments as $comment)
                {
                    //print_r($comment);
                    echo '<li>';
                            echo $comment['title'].'<br/>';
                    echo '</li>';
                }

            ?>
        </ul>
            </li>
        <?php endforeach; ?>
        <?php echo $this->pager($this->list->getPagerInfo()); ?>
    </ul>
<?php endif; ?>
