<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<div id="BoardBox" style="width:<?php echo $width; ?>">
<div id="bo_top">
    <div id="bo_top_bg"></div>
    <div id="bo_top_txt">
        <strong>
            NOTICE
        </strong>
    </div>
</div>
    <div class="table_wrap">
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

            <div id="bo_btn_top">
                <div id="bo_list_total">
                    <span>Total <?php echo number_format($total_count) ?>건</span>
                    <?php echo $page ?> 페이지
                </div>

                <ul class="btn_bo_user">

                    <?php if ($is_admin == 'super' || $is_auth) { ?>

                    <li>

                        <?php if ($is_checkbox) { ?>

                        <ul class="is_list_btn">
                            <li>
                                <button type="submit" name="btn_submit" class="btn_inc" value="선택삭제" onclick="document.pressed=this.value">
                                    선택삭제
                                </button>
                            </li>
                            <li>
                                <button type="submit" name="btn_submit" class="btn_inc" value="선택복사" onclick="document.pressed=this.value">
                                    선택복사
                                </button>
                            </li>
                            <li>
                                <button type="submit" name="btn_submit" class="btn_inc" value="선택이동" onclick="document.pressed=this.value">
                                    선택이동
                                </button>
                            </li>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php }  ?>
                </ul>
            </div>

            <?php if ($is_category) { ?>

            <nav id="bo_cate">
                <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
                <ul id="bo_cate_ul">
                    <?php echo $category_option ?>
                </ul>
            </nav>
            <?php } ?>

            <table class="board_list">
                <!--// <caption><?php echo $board['bo_subject'] ?> 목록</caption> -->
                <colgroup>
                    <?php if ($is_checkbox) { ?><col style="width:3%"><?php } ?>
                    <col style="width:7%">
                    <col style="width:auto">
                    <col style="width:13%">
                    <col style="width:5%">
                    <?php if ($is_good) { ?><col style="width:6%"><?php } ?>
                    <?php if ($is_nogood) { ?><col style="width:6%"><?php } ?>
                    <col style="width:8%">
                </colgroup>
                <thead>
                    <tr>
                        <?php if ($is_checkbox) { ?>
                        <th class="tit">
                            <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
                            <label for="chkall">
                                <span></span>
                                <b class="sound_only">현재 페이지 게시물  전체선택</b>
                            </label>
                        </th>
                        <?php } ?>

                        <th class="tit"><strong>번호</strong></th>
                        <th class="tit"><strong>제목</strong></th>
                        <th class="tit"><strong>글쓴이</strong></th>
                        <th class="tit"><strong><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회</strong></th>
                        <?php if ($is_good) { ?>
                        <th class="tit"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천 </a></th>
                        <?php } ?>
                        <?php if ($is_nogood) { ?>
                        <th class="tit"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추천 </a></th>
                        <?php } ?>
                        <th class="tit"><strong><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜</strong></th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    for ($i=0; $i<count($list); $i++) {
                        if ($i%2==0) $lt_class = "even";
                        else $lt_class = "";
                    ?>

                    <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> <?php echo $lt_class ?>">

                        <?php if ($is_checkbox) { ?>

                        <td class="td_chk chk_box">
                            <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="selec_chk">
                            <label for="chk_wr_id_<?php echo $i ?>">
                                <span></span>
                                <b class="sound_only"><?php echo $list[$i]['subject'] ?></b>
                            </label>
                        </td>
                        <?php } ?>

                        <td>
                            <?php
                            if ($list[$i]['is_notice']) // 공지사항
                                echo '<strong class="notice_icon">공지</strong>';
                            else if ($wr_id == $list[$i]['wr_id'])
                                echo "<span class=\"bo_current\">열람중</span>";
                            else
                                echo $list[$i]['num'];
                            ?>
                        </td>

                        <td class="td_subject">

                            <?php
                            if ($is_category && $list[$i]['ca_name']) {
                            ?>
                            <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                            <?php } ?>
                            <div class="bo_tit">
                                <a href="<?php echo $list[$i]['href'] ?>">
                                    <?php echo $list[$i]['icon_reply'] ?>
                                    <?php
                                        if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);
                                     ?>
                                    <?php echo $list[$i]['subject'] ?>
                                </a>
                                <?php
                                if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
                                // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }
                                if (isset($list[$i]['icon_hot'])) echo rtrim($list[$i]['icon_hot']);
                                if (isset($list[$i]['icon_file'])) echo rtrim($list[$i]['icon_file']);
                                if (isset($list[$i]['icon_link'])) echo rtrim($list[$i]['icon_link']);
                                ?>
                                <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><span class="cnt_cmt"><?php echo $list[$i]['wr_comment']; ?></span><span class="sound_only">개</span><?php } ?>
                            </div>

                        </td>

                        <td><?php echo $list[$i]['name'] ?></td>
                        <td><?php echo $list[$i]['wr_hit'] ?></td>
                        <?php if ($is_good) { ?>
                        <td><?php echo $list[$i]['wr_good'] ?></td>
                        <?php } ?>
                        <?php if ($is_nogood) { ?>
                        <td><?php echo $list[$i]['wr_nogood'] ?></td>
                        <?php } ?>

                        <td><?php echo $list[$i]['datetime2'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>

                </tbody>
            </table>

        </form>
    </div>





    <!--// 페이지 -->
    <div class="bbs_page">
        <?php echo $write_pages; ?>
    </div>

    <div style="width:100%;" class="bbs_search">
        <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">

            <div class="board_searching">
                <div class="searching">
                    <span class="tt"><em>S</em>earching </span>
                    <select name="sfl" id="sfl" class="input_st1" title="검색항목을 선택해주세요.">
                        <?php echo get_board_sfl_select_options($sfl); ?>
                    </select>
                    <input type="text" name="key" value="<?php echo stripslashes($stx) ?>" required id="stx" class="input_st1" size="25" maxlength="20" placeholder=" 검색어를 입력해주세요">
                    <button type="submit" value="검색" class="btn_inc search">검색</button>
                </div>

                <?php if ($list_href || $is_checkbox || $write_href) { ?>

                <div class="board_btn">
                    <?php if ($list_href || $write_href) { ?>

                    <?php if ($admin_href) { ?>
                    <button type="button" class="btn_inc admin" onclick="javascript:location.href='<?php echo $admin_href ?>'" title="관리자">관리자</button>
                    <?php } ?>

                    <?php if ($rss_href) { ?>
                    <button type="button" class="btn_inc rss" onclick="javascript:location.href='<?php echo $rss_href ?>'" title="RSS">RSS</button>
                    <?php } ?>

                    <?php if ($write_href) { ?>
                    <button type="button" class="btn_inc write" onclick="javascript:location.href='<?php echo $write_href ?>'" title="글쓰기">글쓰기</button>
                    <?php } ?>

                    <?php } ?>
                </div>
                <?php } ?>

            </div>
        </form>
    </div>
</div>


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

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
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });
});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
