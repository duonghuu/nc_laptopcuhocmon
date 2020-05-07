<div class="title-main"><span><?=$title_tcat?></span></div>
<div class="content-main w-clear">
    <?php for($i=0;$i<count($tintuc);$i++) { ?>
        <div class="news w-clear">
            <a class="pic-news" href="<?=$com?>/<?=$tintuc[$i]['tenkhongdau']?>-<?=$tintuc[$i]['id']?>.html" title="<?=$tintuc[$i]['ten'.$lang]?>"><img class="lazy" src="assets/images/pixel.gif" data-src="<?=_upload_news_l?>160x120x1/<?=$tintuc[$i]['photo']?>" alt="<?=$tintuc[$i]['ten'.$lang]?>"></a>
            <div class="info-news w-clear">
                <h3 class="name-news"><a href="<?=$com?>/<?=$tintuc[$i]['tenkhongdau']?>-<?=$tintuc[$i]['id']?>.html" title="<?=$tintuc[$i]['ten'.$lang]?>"><?=$tintuc[$i]['ten'.$lang]?></a></h3>
                <div class="desc-news w-clear"><?=catchuoi($tintuc[$i]['mota'.$lang],400)?></div>
                <a class="btn-news" href="<?=$com?>/<?=$tintuc[$i]['tenkhongdau']?>-<?=$tintuc[$i]['id']?>.html" title="<?=_xemthem?>"><?=_xemthem?></a>
            </div>
        </div>
    <?php } ?>
    <div class="clear"></div>
    <div class="pagination"><ul><?=$paging['paging']?></ul></div>
</div>