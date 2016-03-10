        

        <!--[if lt IE 8]>
            <p class="browserupgrade">您在使用 <strong>过时的</strong> 浏览器. 请 <a href="http://browsehappy.com/">升级您的浏览器</a>.</p>
        <![endif]-->

        <nav>
            <ul id="left">
                <li><a href="#about">关于松果</a></li>
                <li><a href="#features">微店特点</a></li>
            </ul>
            <ul id="right">
                <li><a href="#pricing">产品价格</a></li>
                <li><a href="#faq">常见问题</a></li>
            </ul>
        </nav>

        <div id="mobilenav" class="hidden" rel="mobile">
            <ul>
                <li><a href="<?php echo uri('signup') ?>">注册帐号</a></li>
                <li><a href="<?php echo uri('users') ?>">登录</a></li>
            </ul>
            <ul class="anchors">
                <li><a href="#about">关于松果</a></li>
                <li><a href="#features">微店特点</a></li>
                <li><a href="#pricing">产品价格</a></li>
                <li><a href="#faq">常见问题</a></li>
            </ul>
        </div>

        <a href="<?php echo uri('signup') ?>" class=" button" id="header_signup">注册帐号</a>
        <a href="<?php echo uri('users') ?>" class=" button" id="header_login">登录</a>
        <a href="#" id="mobiletoggle" rel="mobile">导航菜单</a>

        <div id="navbg"></div>

        <header>
            <div id="header">
                <h1><?php echo $settings['sitename'] ?></h1>
                <div id="sub">
                    <h2>支持澳元在线支付功能的电子商务平台</h2>
                    <h3>低门槛把您的生意电商化！</h3>
                    <!--<a href="#" id="play">播放简介视频</a>-->
                    <br /><br />
                    <!--<a href="#" id="check" data-toggle="modal" data-target="#checkModal">查看演示站</a>-->

                    <a href="<?php echo uri('signup') ?>" class=" button">马上免费注册！</a>
                    <p>
                        已经注册帐号了? <a href="<?php echo uri('users') ?>" class="">登录后台</a>
                    </p>
                </div>
                <img src="<?php echo uri('modules/site/assets/images/Grabby-Peek.png', false) ?>" />
                <span id="scroll">往下滑动</span>
            </div>
            <div id="blanket"></div>
        </header>

        <section id="about">
            <div class="site_width">
                <h1>关于松果</h1>
                <h2>专为澳洲小生意度身订做的电子商务平台</h2>

                <p>随着越来越多的在澳华人选择利用互联网作为自己生意的线上销售渠道，许多商家都渴望拥有自己的微店/网店作为展示自己商业形象的在线平台。然而，高昂的技术门槛和开发维护费用又使得广大商家对搭建独立的电商网站望而却步。</p>
                <p><?php echo $settings['sitename'] ?>就是专门为澳洲小生意商家提供的专业微店平台。免费注册自己的微店，轻松在线管理支付和订单。让您把更多的精力放在拓展业务上。</p>

                <div id="testimonials">
                    <blockquote>"松果的微店可以免费注册，不用花一分钱就能开自己的微店，分分钟把我的生意互联网化！利用微信做微商真是太方便了！"</blockquote>

                    <blockquote>"作为松果微店的免费用户，我不仅可以方便地管理所有的产品，同时还能即时在线接收订单，管理订单，每笔订单都有实时提醒哦！"</blockquote>

                    <blockquote>"松果的在线支付功能实在是太好用了，我的客户可以在微信内用澳洲的信用卡购买商品，每笔交易都可以在后台查询"</blockquote>

                    <blockquote>"我升级为松果的付费用户后，每笔订单不仅有短信提醒，还能享受专属会员的各种优惠！"</blockquote>
                </div>
            </div>
        </section>

        <section id="features">
            <div class="site_width">
                <h1>平台功能</h1>
                <h2>一站式电子商务平台</h2>

                <article class="right">
                    <img src="<?php echo uri('modules/site/assets/images/Grabby-Collect.png', false) ?>" />
                    <div>
                        <h3>您可以在自己的微店内销售任意商品</h3>
                        <ul>
                            <li>自定义所有的商品价格和简介信息</li>
                            <li>上传并管理商品图片</li>
                            <li>商品库存设置，下架商品将不在前台微店显示</li>
                        </ul>
                    </div>
                </article>

                <article class="left">
                    <img src="<?php echo uri('modules/site/assets/images/Grabby-Performance.png', false) ?>" />
                    <div>
                        <h3>完善的订单保存及管理功能</h3>
                        <ul>
                            <li>每笔交易系统都会为您生成一个订单</li>
                            <li>每笔订单系统都会给您和您的客户发送提醒（白金会员可使用短信提醒功能）</li>
                            <li>登录后台可以轻松管理所有订单</li>
                        </ul>
                    </div>
                </article>

                <article class="right">
                    <img src="<?php echo uri('modules/site/assets/images/Grabby-Cost.png') ?>" />
                    <div>
                        <h3>便捷的在线支付系统（黄金以上会员）</h3>
                        <ul>
                            <li>客户在拥有在线支付功能的微店购买商品后可使用信用卡在线支付</li>
                            <li>在线支付服务使用的是业内口碑绝佳的<a href="https://stripe.com/au">Stripe</a>安全支付API，个人隐私和支付信息绝对安全</li>
                            <li>我们将为您创建Stripe帐号并全程设置所有Stripe支付选项，您只需提供银行帐号坐等收钱即可</li>
                        </ul>
                    </div>
                </article>

                <article class="left">
                    <img src="<?php echo uri('modules/site/assets/images/Grabby-Functionality.png', false) ?>" />
                    <div>
                        <h3>到位的客服和技术支持</h3>
                        <ul>
                            <li>我们向所有客户提供邮箱和微信客服及技术支持</li>
                            <li>白金会员可享受额外的优先客服通道（电话支持等）</li>
                            <li>我们会定期为您推送电商小知识和销售技巧等干货</li>
                        </ul>
                    </div>
                </article>
            </div>
        </section>

        <section id="pricing">
            <div class="site_width">
                <h1>会员收费标准</h1>
                <h2>请选择您要注册的会员类型.</h2>
                
                <div class="planwrapper">
                <div class="plan">
                  <div id="peek">
                      <img src="<?php echo uri('modules/site/assets/images/Grabby-Peek.png', false) ?>">
                  </div>
                  <h3>普通会员</h3>
                  <p>免费</p>
                  <ul>
                    <li><i class="fa fa-check"></i> 完整的微店功能 - 有</li>
                    <li><i class="fa fa-check"></i> 订单管理系统 - 有</li>
                    <li><i class="fa fa-check-circle-o"></i> 上架商品限制 - 5件</li>
                    <li><i class="fa fa-times"></i> 广告和推广 - 有</li>
                    <li><i class="fa fa-times"></i> 在线支付 - 无</li>
                    <li><i class="fa fa-times"></i> 短信提醒 - 无</li>
                  </ul>
                  <br />
                  <a class="button" href="<?php echo uri('signup?member_type=NORMAL') ?>">选择注册！</a>
                </div>
                </div>
                
                <div class="planwrapper">
                <div class="plan">
                  <div class="ribbon"><span>最 热 卖 会员！</span></div>
                  <h3><small>*</small> 黄金会员</h3>
                  <p>一次性$<?php echo $settings['member']['GOLD']['setup_fee'] ?><br />+<br />$<?php echo $settings['member']['GOLD']['transaction_fee'] ?>/笔订单</p>
                  <ul>
                    <li><i class="fa fa-check"></i> 完整的微店功能 - 有</li>
                    <li><i class="fa fa-check"></i> 订单管理系统 - 有</li>
                    <li><i class="fa fa-check-circle-o"></i> 上架商品限制 - 25件</li>
                    <li><i class="fa fa-check"></i> 广告和推广 - 无</li>
                    <li><i class="fa fa-check"></i> 在线支付 - 有</li>
                    <li><i class="fa fa-times"></i> 短信提醒 - 无</li>
                  </ul>
                  <br />
                  <a class="button" href="<?php echo uri('signup?member_type=GOLD') ?>">选择注册！</a>
                </div>
                </div>
                
                <div class="planwrapper">
                <div class="plan">
                  <h3><small>*</small> 白金会员</h3>
                  <p>一次性$<?php echo $settings['member']['PLATINUM']['setup_fee'] ?><br />+<br />$<?php echo $settings['member']['PLATINUM']['transaction_fee'] ?>/笔订单</p>
                  <ul>
                    <li><i class="fa fa-check"></i> 完整的微店功能 - 有</li>
                    <li><i class="fa fa-check"></i> 订单管理系统 - 有</li>
                    <li><i class="fa fa-check" style="color:#31B0D5;"></i> 上架商品限制 - 不限</li>
                    <li><i class="fa fa-check"></i> 广告和推广 - 无</li>
                    <li><i class="fa fa-check"></i> 在线支付 - 有</li>
                    <li><i class="fa fa-check"></i> 短信提醒 - 有</li>
                  </ul>
                  <br />
                  <a class="button" href="<?php echo uri('signup?member_type=PLATINUM') ?>">选择注册！</a>
                </div>
                </div>
                
                <div class="clearfix"></div>

                <small class="footnote">* 支付平台Stripe每笔交易会<a href="https://stripe.com/au/pricing">收取一定手续费</a><br />黄金和白金会员订单产生的费用每月月初结算.</small>
                
                <span>按您收到的订单多少收费 <span>只有您卖的好，我们才收取您小部分的会员费用</span></span>
            </div>
        </section>

        <section id="faq">
            <div class="site_width">
                <h1>常见问题及解答</h1>
                <h2>您需要知道的一些注意事项</h2>

                <div class="row">
                    <div class="col6">
                        <h3>我在<?php echo $settings['sitename_short'] ?>都能卖些什么商品？有什么限制吗？</h3>
                        <p><?php echo $settings['sitename_short'] ?>是全开放的平台，您可以自由开微店，卖任何合法的商品。<?php echo $settings['sitename_short'] ?>并不对您所卖的商品承担法律责任，您必须遵守澳洲本地的法律法规。</p>

                        <h3>我的微店客户不多，如果开微店，会支付高昂的费用吗？</h3>
                        <p><?php echo $settings['sitename_short'] ?>开放普通的会员注册，不需要您花一分钱。但是如果您需要在线支付等高级功能，<?php $settings['sitename_short'] ?>只收取您一次性的少量初始设置费用，随后的费用是由您的订单多少决定的，只有您挣钱，我们才会收您费用。</p>

                        <h3>会员费多少时间一交？</h3>
                        <p>普通会员不收取任何费用，对黄金和白金会员而言，有效订单产生的费用会在每月初结算。</p>
                    </div>
                    <div class="col6">
                        <h3>我开的微店客户客服是由谁完成的？</h3>
                        <p>您开的微店卖出的任何商品，售后服务需要您自己负责。</p>

                        <h3>每笔订单我都能及时收到提醒吗？</h3>
                        <p>是的。普通会员和黄金会员会收到系统发出的邮件提醒，您可以将邮箱关联到自己的手机，这样就可以及时收到提醒了。白金会员在收到邮件提醒的同时，还会收到短信提醒，以防部分邮箱邮件接收失败或者勿标为垃圾邮件的现象。</p>

                        <h3>每笔订单我的客户会收到提醒吗？</h3>
                        <p>是的。普通会员的微店客户会收到邮件提醒，白金会员的微店客户除了收到邮件提醒外还会收到短信提醒，以防部分邮箱邮件接收失败或者勿标为垃圾邮件的现象。</p>

                        <h3>如何咨询更多的问题？</h3>
                        <p>欢迎您随时联系我们 <script type="text/javascript">
                            document.write('<a href="mai');
                            document.write('lto');
                            document.write(':songguo.com.au');
                            document.write('@');
                            document.write('gmail.com">');
                            document.write('songguo.com.au');
                            document.write('@');
                            document.write('gmail.com<\/a>');
                        </script>.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="final">
            <a href="<?php echo uri('signup') ?>" class="button">马上免费注册！</a>
            <br /><br /><br />
            <p style="color: #AAA;">或者查看演示微店</p>
            <br />
            <div style="text-align: center; margin-bottom: 15px;">
              <a href="<?php echo uri('shop/aixin') ?>" class="btn btn-lg btn-success">演示微店1</a>
              <a href="<?php echo uri('shop/foodking') ?>" class="btn btn-lg btn-warning">演示微店2</a>
            </div>
        </section>

        <footer>
            <ul id="social">
                <li><a href="http://www.facebook.com/GrabbyIo" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="http://www.twitter.com/GrabbyIo" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="http://www.medium.com/@GrabbyIo" target="_blank"><i class="fa fa-medium"></i></a></li>
            </ul>
            <span>&copy; <?php echo $settings['sitename'] ?> 2016</span>
            <ul>
                <li><a href="<?php echo uri('terms') ?>">网站使用条款及条件</a></li>
                <li><a href="<?php echo uri('privacy') ?>">隐私权和条款</a></li>
                <li><a href="<?php echo uri('cookies') ?>">关于Cookies</a></li>
            </ul>
        </footer>