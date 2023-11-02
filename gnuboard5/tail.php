<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/tail.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/tail.php');
    return;
}
?>

    </div>
</div>

</div>
<!-- } 콘텐츠 끝 -->



<!-- 하단 시작 { -->
    <div class="wrapImg animate" data-animate="motion">
                <section class="contact animate" data-animate="motion">
                    <div class="inner">
                        <div class="leftContact">
                            <h1>PET SERVICE</h1>
                            <ul class="contactList">
                                <li>
                                    <p>문의전화</p>
                                    <a href="#">
                                        <p class="tel">010.2207.4815</p>
                                    </a>
                                </li>
                                <li>
                                    <p>플러스 친구</p>
                                    <a href="#">
                                        <img src="https://hjae950508.cafe24.com/gnuboard5/img/kakaoplus.png" alt="플러스 친구" class="plus" />
                                    </a>
                                </li>
                                <li>
                                    <p>오시는 길</p>
                                    <p class="location">서울시 <br /></p>
                                </li>
                            </ul>
                        </div>
                        <div class="rightContact">
                            <h2>상담/예약 신청</h2>
                            <form action="">
                                <input type="text" placeholder="이름" />
                                <input type="tel" placeholder="연락처 ex)01011112222" />
                                <select name="consultType" id="consultType">
                                    <option value="kakaotalk">카톡상담</option>
                                    <option value="phone">전화상담</option>
                                </select>
                                <p>
                                    <a href="#">개인정보 수집/이용 동의하기</a>
                                </p>
                                <input class="consult" type="submit" value="상담신청" />
                            </form>
                        </div>
                    </div>
                </section>
                </div>
                <div id=ft_wrapper>
    <div id="ft">
    
        <div id="ft_wr">
         <div id="ft_wr_inner">
                <div id="ft_link" class="ft_cnt">
                    <a href="<?php echo get_pretty_url('content', 'company'); ?>">회사소개</a>
                    <a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보처리방침</a>
                    <a href="<?php echo get_pretty_url('content', 'provision'); ?>">서비스이용약관</a>
                    <a href="<?php echo get_device_change_url(); ?>">모바일버전</a>
                </div>
                <div id="ft_company" class="ft_cnt">
                	<h2>사이트 정보</h2>
        	        <p class="ft_info">
        	        	회사명 : 회사명 / 대표 : 대표자명<br>
        				주소  : OO도 OO시 OO구 OO동 123-45<br>
        				사업자 등록번호  : 123-45-67890<br>
        				전화 :  02-123-4567  팩스  : 02-123-4568<br>
        				통신판매업신고번호 :  제 OO구 - 123호<br>
        				개인정보관리책임자 :  정보책임자명<br>
        			</p>
        	    </div>           
                <div id="ft_sns" class="ft_cnt">
               <a href="#"><img src="https://hjae950508.cafe24.com/gnuboard5/img/ft_kakao.png" alt=""><p>KAKAO ID: dogbnb</p></a>
               <a href="#"><img src="https://hjae950508.cafe24.com/gnuboard5/img/ft_blog.png" alt=""><p>blog.naver.com/dbdb</p></a>
               <a href="#"><img src="https://hjae950508.cafe24.com/gnuboard5/img/ft_instagram.png" alt="">@dogdogbnb</a>
        	    </div>           
         </div>
        <!-- <div id="ft_catch"><img src="<?php echo G5_IMG_URL; ?>/ft_logo.png" alt="<?php echo G5_VERSION ?>"></div> -->
        <div id="ft_copy">Copyright &copy; <b>소유하신 도메인.</b> All rights reserved.</div>
    
        <button type="button" id="top_btn">
        	<i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span>
        </button>
        <script>
        $(function() {
            $("#top_btn").on("click", function() {
                $("html, body").animate({scrollTop:0}, '500');
                return false;
            });
        });
        </script>
    </div>
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>
<?php include_once(G5_LIB_PATH.'/outlogin.modal.lib.php'); ?>
<!-- 비회원 체크 -->
<!-- <?php if($is_member) { ?>
<a href="기존링크">
<?php } else { ?>
<a href="javascript:void(0);" class="SignIn">
<?php } ?> -->
<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");