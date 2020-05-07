<div class="wrap-tags">
	<span>Tags: </span>
    <?php for($i=0;$i<count($tags);$i++) { ?>
        <a href="tags/<?=$tags[$i]['tenkhongdau']?>" title="<?=$tags[$i]['ten'.$lang]?>"><?=$tags[$i]['ten'.$lang]?></a><?php if($i<count($tags)-1) echo ", "; ?>
    <?php } ?>
</div>