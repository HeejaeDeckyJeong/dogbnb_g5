<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once G5_LIB_PATH."/thumbnail.lib.php";
include_once($board_skin_path.'/skin.config.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
$_img_rate=round($board['bo_gallery_height'] / $board['bo_gallery_width']*100);
if($_img_rate<0 || $_img_rate>1000) $_img_rate=75;
?>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo-cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo-cate-ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->
    
    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
	<div class="bo-top-wrap">
		<div class="list-total">Total <strong class="mr5"><?php echo number_format($total_count) ?></strong> <?php if($total_page){?><span class="total-page">[ <strong><?php echo $page?></strong> / <?=$total_page?> Page]</span><?php }?></div>
		<div class="board-btn<?=$_btn_text_none ? " btn-text-none" : ''?>">
            <?php if($rss_href){?><a href="<?php echo $rss_href ?>" class="btn-bo-rss" title="RSS" title="RSS">RSS</a><?php }?>
			<a href="#" id="btn-search" class="btn-bo-search" title="게시판 검색">검색</a>
            <?php if($write_href){?><a href="<?php echo $write_href ?>" class="btn-bo-write" title="글쓰기">글쓰기</a><?php }?>
			<?php if ($is_checkbox) { ?><span class="gallery-list-checkbox"><span class="check-box"><input type="checkbox" id="chkall" name="" /><span></span><label for="chkall" class="sound_only">현재 페이지 게시물 전체</label></span></span><?php }?>
		</div>
	</div>
	<!-- } 게시판 페이지 정보 및 버튼 끝 -->

	<ul class="gallery-list">
		<?php
		for ($i=0; $i<count($list); $i++) {
			if($list[$i]['is_notice']) $list[$i]['icon_pack'].="<span class='list-icon icon-notice'>Notice</span>";
			if($list[$i]['icon_new']) $list[$i]['icon_pack'].= "<span class='list-icon icon-new'>New</span>";

			$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);
			if($list[$i]['icon_secret']){
				$img_content = '<span class="gallery-list-img secret-box"></span>';
			}else{ 
				if($thumb['src']){
					$img_content = '<span class="gallery-list-img" style="background-image:url(\''.$thumb['src'].'\')"></span>';
				} else {
					$img_content = '<span class="gallery-list-img no-image"></span>';
				}
			}
			$list[$i]['content_text']=$list[$i]['icon_secret'] ? "<span class='list-content-secret'>비밀글입니다.</span>" : cut_str(strip_tags($list[$i]['wr_content']), 120);
		 ?>
		<li>
			<?php if ($is_checkbox) { ?>
			<div class="gallery-list-checkbox">
				<span class="check-box"><input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk-wr-id-<?php echo $i ?>"><span></span><label for="chk-wr-id-<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label></span>
			</div>
			<?php } ?>
			<a href="<?=$list[$i]['href']?>">
				<?php echo $list[$i]['icon_pack'] ? "<div class='gallery-icon-pack'>{$list[$i]['icon_pack']}</div>" : '';?>
				<?=$img_content?>
				<span class="gallery-list-content">
					<span class="gallery-list-category"><?php echo $list[$i]['ca_name'];?></span>
					<span class="gallery-list-title"><?php echo $list[$i]['subject'];?></span>
					<?php if($board['bo_use_list_content']){?>
					<span class="gallery-list-content-text"><?php echo $list[$i]['content_text'];?></span>
					<?php }?>
					<span class="gallery-list-content-etc">
						<span class="list-writer"><?php echo $list[$i]['name'] ?></span>
						<span class="list-date"><?php echo str_replace("-", ".", $list[$i]['datetime']);?></span>
						<span class="list-comment"><?php echo number_format($list[$i]['wr_comment']) ?></span>
					</span>
				</span>
			</a>
		</li>
		<?php } ?>
		<?php if (count($list) == 0) { echo '<li class="gallery-empty-list"><div>게시물이 없습니다.</div></li>'; } ?>
	</ul>

	<div class="bo-bottom-wrap">
		<div class="board-btn list-bottom-left">
			<?php if($is_admin == 'super' || $is_auth){?>
			<span class="bo-admin-select-wrap">
				<a href="#" class="btn-bo-admin-select">선택관리<span></span></a>
				<?php if($is_checkbox) { ?>	
				<ul class="more-opt is-list-btn">  
					<li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="select-delete">선택삭제</button></li>
					<li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="select-copy">선택복사</button></li>
					<li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="select-move">선택이동</button></li>
				</ul>
			</span>
			<?php }}?>
		</div>
		<div class="board-btn list-bottom-right<?=$_btn_text_none ? " btn-text-none" : ''?>">
			<?php if ($admin_href) { ?><a href="<?php echo $admin_href ?>" class="btn-bo-admin" title="관리자">관리자</a><?php } ?>
            <?php if($write_href){?><a href="<?php echo $write_href ?>" class="btn-bo-write" title="글쓰기">글쓰기</a><?php }?>
		</div>
	</div>

	<!-- 페이지 -->
	<?php echo $write_pages; ?>
	<!-- 페이지 -->
	</form>

	<!-- 게시판 검색 시작 { -->
	<div class="bo-sch-wrap">
		<div class="bo-sch-content">
		<fieldset class="bo-sch">
			<h3>Search</h3>
			<form name="fsearch" method="get">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sop" value="and">
				<div class="bo-sch-box">
					<div class="bo-sch-inner">
						<div class="bo-sch-input">
							<label for="sfl" class="sound_only">검색대상</label>
							<select name="sfl" id="sfl"><?php echo get_board_sfl_select_options($sfl); ?></select>
						</div>
						<div class="bo-sch-input">
							<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
							<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" placeholder=" 검색어를 입력해주세요">
						</div>
						<div class="bo-sch-btn">
							<button type="submit" value="검색" class="sch-btn">검색</button>
						</div>
					</div>
				</div>
			</form>
		</fieldset>
		<button type="button" class="bo-sch-cls" title="닫기">닫기</button>
		<div class="bo-sch-bg"></div>
		</div>
	</div>
    <script>
    jQuery(function($){
        // 게시판 검색
        $("#btn-search").on("click", function() {
            $(".bo-sch-wrap").stop().fadeIn("fast", function(){
				$(this).addClass('active');
			});
			return false;
        })
        $('.bo-sch-bg, .bo-sch-cls').click(function(){
            $('.bo-sch-wrap').stop().removeClass('active').fadeOut('fast');

        });
    });
    </script>
    <!-- } 게시판 검색 끝 --> 
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn-bo-admin-select").on("click", function(e) {
        e.stopPropagation();
		if(!$(".bo-admin-select-wrap").hasClass('active'))
		{
            $(".more-opt.is-list-btn").stop().slideDown('fast');
			$(".bo-admin-select-wrap").addClass('active');
		}
		else
		{
            $(".more-opt.is-list-btn").stop().slideUp('fast');
			$(".bo-admin-select-wrap.active").removeClass('active');
		}
		return false;
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is-list-btn').length) {
            $(".more-opt.is-list-btn").slideUp('fast');
			$(".bo-admin-select-wrap.active").removeClass('active');
        }
    });
	$("#chkall").click(function(){
		$(".gallery-list input[type='checkbox']").prop("checked", $(this).prop("checked"));
	});
});
</script>
<?php } ?>
<style>
.gallery-list .gallery-list-img{padding-top: <?=$_img_rate?>%;}
</style>
<!-- } 게시판 목록 끝 -->