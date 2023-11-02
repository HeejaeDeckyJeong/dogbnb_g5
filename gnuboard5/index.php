<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_PATH.'/head.php');
?>
            <div class="container">
                <div id="mainslide">
                    <div>
                        <div class="textholder">
                            <p>1시간부터 오랜 기간까지, 유치원 & 호텔 동시 운영</p>
                            <h1>PET CARE</h1>
                        </div>
                        <img src="./img/main_slide1.jpg" alt="" />
                    </div>
                    <div>
                        <div class="textholder">
                            <p>털 관리, 애견 마사지, 스파 등 폭 넓은 서비스</p>
                            <h1>GROOMING</h1>
                        </div>
                        <img src="./img/main_slide2.png" />
                    </div>
                    <div>
                        <div class="textholder">
                            <p>사실 천재견이었던 우리집 강아지</p>
                            <h1>EDUCATION</h1>
                        </div>
                        <img src="./img/main_slide3.jpg" />
                    </div>
                </div>
            </div>
            <section class="main_1 animate" data-animate="motion">
                <div class="inner main_inner">
                    <div class="leftImg">
                        <p class="imgBox">
                            <img src="img/main_cont1.jpg" alt="" />
                        </p>
                        <h2 class="tit"><span>Meal</span></h2>
                        <p class="txt">
                            확실한 품질의 재료만을 사용하여 <br />
                            맛있고 건강한 끼니를 제공합니다.
                        </p>
                    </div>
                    <div class="center">
                        <h3>걱정없이 떠나는 당신의 여행</h3>
                        <h1>Don't Worry</h1>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore sit nihil accusantium amet
                            vitae. Corrupti explicabo ipsum in, rerum expedita, cumque officia eveniet quidem nostrum
                            esse quod tempore quasi necessitatibus.
                        </p>
                        <a href="#"> PET CARE SERVICE <span class="lnr lnr-arrow-right"></span> </a>
                    </div>
                    <div class="rightImg">
                        <p class="imgBox">
                            <img src="img/main_cont2.png" alt="" />
                        </p>
                        <h2 class="tit"><span>Photo</span></h2>
                        <p class="txt">
                            걱정 많은 견주님들을 위해 시간 단위로<br />
                            아이들 사진을 촬영하여 보내드리고 있습니다
                        </p>
                    </div>
                </div>
            </section>
            <section class="main_2 animate" data-animate="motion">
               <div class="inner">
                    <div class="title2">
                        <h3>배변 훈련부터 어려운 개인기까지</h3>
                        <h1>
                            Training Programs<br />&<br />
                            Education
                        </h1>
                        <a href="#"> VIEW MORE <span class="lnr lnr-arrow-right"></span> </a>
                    </div>
                    <div class="videoArea">
                        <p>TRANING PROGRAM</p>
                        <div class="videoBox">
                            <video src="video/main_video.mp4" autoplay loop muted controls></video>
                            <p class="videoTxt">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                <br class="mo" />
                                Odit perferendis pariatur non, qui quisquam itaque
                                <br class="mo" />
                                마odio veniam dolorum consequatur ipsam!
                            </p>
                        </div>
                    </div>
                </section>
                <section class="main_3 animate" data-animate="motion">
                    <div class="title3">
                        <h3>365일, 당신의 반려견이 건강하기를</h3>
                        <h1>
                            365 days of thinking about<br />
                            your dog
                        </h1>
                        <a href="#"> SIGN UP<span class="lnr lnr-arrow-right"></span> </a>
                    </div>
                    <div class="inner">
                        <ul class="list">
                            <li>
                                <a href="#">
                                    <div class="listImg">
                                        <img src="img/main3_1.png" alt="" />
                                    </div>
                                    <h2>돌봄</h2>
                                    <p>
                                        Lorem ipsum dolor sit amet conse <br />
                                        ctetur adipisicing elit.
                                        <span class="lnr lnr-arrow-right"></span>
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="listImg">
                                        <img src="img/main3_2.png" alt="" />
                                    </div>
                                    <h2>훈련</h2>
                                    <p>
                                        Lorem ipsum dolor sit amet conse <br />
                                        ctetur adipisicing elit.
                                        <span class="lnr lnr-arrow-right"></span>
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="listImg">
                                        <img src="img/main3_3.png" alt="" />
                                    </div>
                                    <h2>미용</h2>
                                    <p>
                                        Lorem ipsum dolor sit amet conse <br />
                                        ctetur adipisicing elit.
                                        <span class="lnr lnr-arrow-right"></span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
               </div>
            </section>
         
<?php
include_once(G5_PATH.'/tail.php');