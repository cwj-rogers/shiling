<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/5 0005
 * Time: 下午 5:53
 */
?>
<!--<div class="side-head nav-open1">-->
<!--    <div class="side-logo">-->
<!--        <a href="https://show.metinfo.cn/muban/M1156010/328/" title="APP应用开发|网站建设|平面设计">-->
<!--            <img data-original="https://images.metinfo.cn/m/M1156010/328/upload/M1156010/328/201707/1500552335.png" data-size="175_40" alt="APP应用开发|网站建设|平面设计" title="APP应用开发|网站建设|平面设计">-->
<!---->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="sign-box">-->
<!--        <ul class="sign-ul swiper-nav">-->
<!--            <li class="sign-li active">-->
<!--                <a href="../message/"  title="全部">-->
<!--                    <b>全部</b>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li class="sign-li ">-->
<!--                <a href="../message/message.php?lang=cn"  title="提交留言">-->
<!--                    <b>提交留言</b>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li class="sign-li ">-->
<!--                <a href="../message/"  title="查看留言">-->
<!--                    <b>查看留言</b>-->
<!--                </a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<!--</div>-->
<div class="side-content ">
    <div class="banner-sub auto not-has" data-height="420|350|200">
    </div>
    <div class="side-html">
        <div class="side-body swiper-lazy" data-background="https://images.metinfo.cn/m/M1156010/328/upload/M1156010/328/201707/1500274209.jpg">
            <section class="met-show animsition">
                <div class="container">
                    <div class="row">
                        <div class="met-editor lazyload clearfix">
                            <div>
                                <div id="map" style="height:410px" coordinate="121.45184,31.383667"></div>
                                <p>&nbsp;</p>
                                <p class="b">Internet service technology, Limited by Share Ltd</p>
                                <p class="p">
                                    <em>网络服务</em>技术股份有限公司
                                </p>
                                <p>网络服务技术股份有限公司（Internet service technology, Limited by Share Ltd）成立于2017年7月，凭借拔尖的团队、优秀的业务能力，星如雨迅速成长为国内SEO的领军者。我们专注网络营销业务，助力您的企业腾飞。同时，我们还拥有一支健全的建站团队，向外界承接APP应用开发/微网站/公众号策划营销等业务。</p>
                                <div class="contact-bin">
                                    <h3>全国统一服务热线：400-000-0000</h3>
                                    <p>
                                        <em class="fa fa-cloud-download"></em> 广东省揭阳市老城区河南北路电子商务产业园2楼
                                    </p>
                                    <p>
                                        <em class="fa fa-tty"></em> (010) 8000000 / (+86) 1370000000
                                    </p>
                                    <p>
                                        <em class="fa fa-envelope"></em> test@metinfo.cn
                                    </p>
                                    <p>&nbsp;</p>
                                </div>
                            </div>
                            <div class="message-subpage">
                                <h4>给我们留言</h4>
                                <form method="post" class="met-form met-form-validation" action="../message/message.php?action=add">
                                    <input type="hidden" name="lang" value="cn">
                                    <div class="form-group ftype_input">
                                        <div>
                                            <input name='para115' class='form-control' type='text' placeholder='姓名 ' data-fv-notempty="true" data-fv-message="不能为空" />
                                        </div>
                                    </div>
                                    <div class="form-group ftype_input">
                                        <div>
                                            <input name='para116' class='form-control' type='text' placeholder='电话 ' data-fv-notempty="true" data-fv-message="不能为空" />
                                        </div>
                                    </div>
                                    <div class="form-group ftype_input">
                                        <div>
                                            <input name='para117' class='form-control' type='text' placeholder='邮箱 ' data-fv-notempty="true" data-fv-message="不能为空" />
                                        </div>
                                    </div>
                                    <div class="form-group ftype_textarea">
                                        <div>
                                            <textarea name='para119' class='form-control' data-fv-notempty="true" data-fv-message="不能为空" placeholder='内容 ' rows='5'></textarea>
                                        </div>
                                    </div>
                                    <div class="submint">
                                        <button type="submit" class="btn btn-primary btn-block btn-squared more-box">
                                            <span>提 交</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?= $this->render('/layouts/hjz/side-foot.php')?>
            <input type="hidden" name="lazyloadbg" value="base64">
        </div>
    </div>
    <div class="side-scroll swiper-scrollbar"></div>
</div>
