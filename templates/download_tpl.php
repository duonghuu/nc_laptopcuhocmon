<div class="title-main">
    <span><?=$title_tcat?></span>
</div>
<div class="content-main w-clear">
    <?php
        if(count($download)>0)
        {
            for($i=0;$i<count($download);$i++)
            {
            ?>
                <div class="download">
                    <img onerror="src='assets/images/noimage.png'" alt="<?=$download[$i]['ten'.$lang]?>" src="<?=_upload_photo_l.$download[$i]['thumb']?>"/>
                    <span><?=$download[$i]['ten'.$lang]?></span>
                    <a href="<?=_upload_file_l.$download[$i]['file']?>" title="<?=$download[$i]['ten'.$lang]?>">Download</a>
                </div>
            <?php
            }
        }
        else
        {
        ?>
            <div class="notice_pro">
                <h4><?=_khongtimthayketqua?></h4>
            </div>
        <?php
        }   
    ?>
    <div class="clear"></div>
    <div class="pagination">
        <ul><?=$paging['paging']?></ul>
    </div>
</div>