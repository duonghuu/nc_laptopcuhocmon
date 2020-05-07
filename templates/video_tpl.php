<div class="title-main">
    <span><?=$title_tcat?></span>
</div>
<div class="content-main w-clear">
    <?php
        for($i=0;$i<count($video);$i++)
        {
        ?>
            <div class="video">
                <div class="pic-video">
                    <div class="youtube-player" data-id="<?=getYoutubeIdFromUrl($video[$i]['link_video'])?>"></div>
                </div>
                <h3><a title="<?=$video[$i]['ten'.$lang]?>">
                    <?=$video[$i]['ten'.$lang]?>
                </a></h3>
            </div>
        <?php
        }
    ?>
    <div class="clear"></div>
    <div class="pagination">
        <ul><?=$paging['paging']?></ul>
    </div>
</div>