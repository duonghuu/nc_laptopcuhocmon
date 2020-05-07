<?php
	session_start();
	error_reporting(0);

	@define ( '_lib' , '../admin/lib/');
	@define ( '_source' , '../sources/');
	
	if(!isset($_SESSION['lang'])) $_SESSION['lang']='vi';
    $lang=$_SESSION['lang'];

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	require_once _source."lang.php";

	$cu=sanitize($_POST['curpage']);
	$name_pro=sanitize($_POST['name_pro']);
	$comment = get_result_array("SELECT * FROM table_comment WHERE hienthi=1 AND url='$cu' AND pid=0 ORDER BY ngaydang DESC");
?>
<style type="text/css">
	ul.jpage_items > li
	{
		float: none;
		margin: 0px;
		margin-bottom: 10px;
	}
</style>

<div class="w-cm">
	<div class="ctsp-tit"><?=_co?> <b><?=count($comment)?></b> <?=_binhluanve?> <strong><?=$name_pro?></strong></div>

	<form name="frm_cm" action="" method="post" class="frm_cm">
		<div><textarea name="cm[noidung]" placeholder="<?=_moibanthaoluan?>" required="required" minlength="10" rows="5"></textarea></div>
	    <div class="btn-cmt"><input type="button" value="<?=_gui?>" /></div>
	    <div class="btn-cms"><input type="text" name="cm[hoten]" placeholder="<?=_hoten?>" required="required" /></div>
	    <div class="btn-cms"><input type="text" name="cm[email]" placeholder="Email" required="required"/></div>
	    <div class="btn-cms"><input type="submit" value="<?=_xacnhan?>" /></div>
	</form>

	<!-- Item Jpage Comment -->
  	<ul class="jpage_items" id="jpage_comment">
		<?php for($i=0;$i<count($comment);$i++) {
			$ip = getRealIPAddress();
			$id_comment = $comment[$i]['id'];
			$comment_tool = get_fetch_array("SELECT * FROM table_comment_tool WHERE id_comment=$id_comment AND ip='".$ip."'"); ?>
			<li>
				<div class="box-cm">
			    	<div class="w-clear">
			        	<div class="box-cm-c">
			            	<?=split_name($comment[$i]['hoten']);?>
			            </div>
			            <div class="box-cm-name <?php if(strtolower($comment[$i]['typereply'])=='admin') { echo ' box-cm-namead'; } ?>">
			            	<?=$comment[$i]['hoten']?><p>- <?=date("h:i d/m/Y",$comment[$i]['ngaydang'])?></p>
			            </div>
			            <div class="box-cm-tool w-clear">
			            	<div class="tool-like <?=($comment_tool['id']>0)?'liked':''?>" data-id="<?=$id_comment?>">
			            		<i class="fa fa-thumbs-up"></i>
			            		<span class="count-like count-like-<?=$id_comment?>"><?=$comment[$i]['thich']?></span>
			            		<span class="text-like text-like-<?=$id_comment?>"><?=($comment_tool['id']>0)?_dathich:_thich?></span>
			            	</div>
			            	<div class="tool-share">
			            		<span class="title-share" data-id="<?=$id_comment?>"><?=_chiase?></span>
								<div class="list-share list-share-<?=$id_comment?>">
									<a class="facebook" target="_blank" href="//www.facebook.com/sharer.php?u=<?=$comment[$i]['url']?>?&amp;quote=<?=$comment[$i]['hoten']." (bình luận): ".$comment[$i]['noidung']?>" title="Facebook"><i class="fa fa-facebook-f"></i></a>
									<a class="twitter" target="_blank" href="//twitter.com/intent/tweet?source=webclient&amp;text=<?=$comment[$i]['hoten']." (bình luận): ".$comment[$i]['noidung']." ".$comment[$i]['url']?>" title="Tweet"><i class="fa fa-twitter"></i></a>
									<a class="google" target="_blank" href="//plus.google.com/share?url=<?=$comment[$i]['url']?>" title="Google+"><i class="fa fa-google"></i></a>
								</div>
			            	</div>
			            </div>
			        </div>
			        <div class="box-cm-info">
			        	<div><?=$comment[$i]['noidung']?></div>
			            <div class="clear"></div>
			           	<div class="box-cm-tl" data-pid="<?=$id_comment?>"><?=_traloi?></div>
			           	<div class="clear"></div>
			           	<?php
							$ccm = get_result_array("SELECT * FROM table_comment WHERE pid=$id_comment ORDER BY ngaydang DESC");
			           	?>
			           	<?php if(count($ccm)>0) { ?>
				           	<div class="w-cm-rl">
				           		<?php for($j=0;$j<5;$j++) { ?>
				           			<?php if(isset($ccm[$j]['hoten'])) { ?>
							           	<div class="box-cm">
						                    <div class="w-clear">
						                        <div class="box-cm-c">
						                        	<?=split_name($ccm[$j]['hoten']);?>
						                        </div>
						                        <div class="box-cm-name <?php if(strtolower($ccm[$j]['typereply'])=='admin'){echo ' box-cm-namead';}?>">
						                            <?=$ccm[$j]['hoten']?>
						                        </div>
						                    </div>
						                    <div class="box-cm-info">
						                        <div><?=$ccm[$j]['noidung']?></div>
						                        <div class="clear"></div>
						                    </div>
						                </div>
					                <?php } ?>
					           	<?php } ?>
					           	<?php if(count($ccm)>5) { ?>
					           		<div class="w-load-cm-<?=$id_comment?>"></div>
							        <span class="span-load-cm" data-load="<?=$id_comment?>"><?=_taithembinhluan?></span>
						        <?php } ?>
				           	</div>
			           	<?php } ?>
			        </div>
			    </div>
			</li>
		<?php } ?>
	</ul>
	<?php if(count($comment)>15) { ?>
	    <div class="holder holder-comment"></div>
	<?php } ?>
</div>

<div style="display:none;">
	<form name="frm_cm" action="" method="post" class="frm_cm frm_cmcl">
		<div><input type="text" name="cm[hoten]" placeholder="<?=_hoten?>" required="required" /></div>
	    <div><input type="text" name="cm[email]" placeholder="Email" required="required"/></div>
		<div><textarea name="cm[noidung]" placeholder="<?=_moibanthaoluan?>" required="required" minlength="10" rows="5"></textarea></div>
	    <input type="hidden" name="cm[pid]" class="hdpid" />
	    <div><input type="submit" value="<?=_traloi?>" /></div>
	</form>
</div>

<!-- Begin Comment -->
<script src="assets/jpage/jPages.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
		// Share
	    $(".title-share").click(function(){
	    	var id=$(this).data("id");
	    	$(".list-share-"+id).stop(true,true).slideToggle("fast");
	    })

	    // Like comment
		$('.tool-like').click(function(){
			var id_comment=$(this).data('id');
			var $this=$(this);
			$.ajax({
                url: "ajax/ajax_tool_comment.php",
                type: 'post',
                dataType: 'json',
                data: 
                {
                    id_comment: id_comment
                },
                success: function (response) {
                    $('.count-like-'+id_comment).html(response.thich);
                    if($this.hasClass("liked"))
                    {
                    	$('.text-like-'+id_comment).html("<?=_thich?>");
                    	$this.removeClass("liked");
                    }
                    else
                    {
                    	$('.text-like-'+id_comment).html("<?=_dathich?>");
                    	$this.addClass("liked");
                    }
                }
            });
		})

		$('.frm_cm textarea').focusin(function(e) {
			$(this).parent().parent().children('.btn-cmt').show();
		});
		
		$('.frm_cm textarea').focusout(function(e) {
            if($(this).val().length<10)
			{
				$('.btn-cmt').hide();	
			}
		});
		
		$('.btn-cmt').click(function(){
			$(this).hide();
			$('.btn-cms').slideDown();	
		})
		
		// Answer comment
		$('.box-cm-tl').click(function(){
			if($(this).hasClass('active'))
			{
				$(this).text('<?=_traloi?>');
				$(this).removeClass('active');
				$('.frm_cmcl .hdpid').val('');
				$(this).next().children('.frm_cm').remove();
			}
			else
			{
				$(this).text('<?=_huy?>');
				$('.frm_cmcl .hdpid').val($(this).attr('data-pid'));
				var $frm_cm=$('.frm_cmcl').clone();
				$frm_cm.removeClass('frm_cmcl');
				$(this).next().append($frm_cm);
				$(this).addClass('active');
			}
		})

		// Load comment
		$('span.span-load-cm').click(function(){
			var id_wrap=$(this).data('load');
			var $this=$(this);
			$.ajax({
                url: "ajax/ajax_load_comment.php",
                type: 'post',
                data: 
                {
                    id_wrap: id_wrap
                },
                success: function (response) {
                    $('.w-load-cm-'+id_wrap).html(response);
                    $this.hide();
                }
            });
		})

		// Jpage comment
		$("div.holder-comment").jPages({
	        containerID  : "jpage_comment",
	        perPage: 15,
	        first       : "<?=_trangdau?>",
	        previous    : "<?=_trangtruoc?>",
	        next        : "<?=_trangke?>",
	        last        : "<?=_trangcuoi?>"
	    });
	    
	    $("div.holder-comment a").click(function(){
	        var vitri=$(".w-cm").offset().top;
	        $("html, body").animate({ scrollTop: (vitri) }, 1000);
	    });
    });
</script>
<!-- End Comment -->