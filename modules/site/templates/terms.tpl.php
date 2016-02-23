	
    <!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

    
    <!-- copied from shopify -->
    
		<header>
			<h1 id="logo"><?php echo $settings['sitename'] ?></h1>

	        <nav>
            <ul id="left">
                <li><a href="<?php echo uri('') ?>#about">关于松果</a></li>
                <li><a href="<?php echo uri('') ?>#features">微店特点</a></li>
            </ul>
            <ul id="right">
                <li><a href="<?php echo uri('') ?>#pricing">产品价格</a></li>
                <li><a href="<?php echo uri('') ?>#faq">常见问题</a></li>
            </ul>
	        </nav>
		</header>

        <div id="mobilenav" class="hidden" rel="mobile">
            <ul>
                <li><a href="<?php echo uri('users/signup') ?>">注册帐号</a></li>
                <li><a href="<?php echo uri('users') ?>">登录</a></li>
            </ul>
            <ul class="anchors">
                <li><a href="<?php echo uri('') ?>#about">关于松果</a></li>
                <li><a href="<?php echo uri('') ?>#features">微店特点</a></li>
                <li><a href="<?php echo uri('') ?>#pricing">产品价格</a></li>
                <li><a href="<?php echo uri('') ?>#faq">常见问题</a></li>
            </ul>
        </div>

        <a href="<?php echo uri('users/signup') ?>" class="signuplink button visible" id="header_signup">注册帐号</a>
        <a href="<?php echo uri('users') ?>" class="loginlink button visible" id="header_login">登录</a>
        <a href="#" id="mobiletoggle" rel="mobile">导航菜单</a>

		<div id="document_wrapper">
			<div id="document">
				
        <div class="header">
          <h1>服务及使用条款</h1>
          <dl><dt>2016年2月30日</dt><dd>最后更新</dd></dl>
        </div>
        
        <div id="document">
          <p>如果您注册并开始使用<?php echo $settings['sitename'] ?>的帐号或者任何其他<?php echo $settings['sitename_short'] ?>的服务，你即同意遵守以下的服务及使用条款。由<?php echo $settings['sitename_short'] ?>在本服务条款下所提供的一切服务或者产品都是帮助您创建并管理一个在线商店，并使用此在线商店进行商业活动。任何在现有微店平台基础上添加的新的服务或者功能都受本服务条款的约束。您可以在任何时间查看当前版本的服务条款：<a href="http://<?php echo SITEDOMAIN ?>/terms">http://<?php echo SITEDOMAIN ?>/terms</a>。<?php echo $settings['sitename_short'] ?>保留更新并修改此服务条款的权利。您应该时常查看本服务条款，以确保了解任何对您的使用有影响的条款变更。</p>
          
          <p>在成为<?php echo $settings['sitename_short'] ?>的用户之前，您必须仔细阅读并接受本服务条款中涉及的所有条目，同时同意我们的<a href="http://<?php echo SITEDOMAIN ?>/privacy">隐私条款</a>。</p>
          
          <p><strong>其他任何形式对服务条款的口语描述都仅为引用方便之用，没有正式的法律效应。请仔细阅读本“服务条款”以对您的法律要求有明确而全面的认识。您在使用任何<?php echo $settings['sitename_short'] ?>的产品或服务时，必须同意这些服务条款。请确保时常返回本页面查看最近的条款更新。</strong></p>
          
          <h2>1. 帐号条款</h2>
          <ol>
            <li>您必须年满18周岁，或者至少大于您所居住地的法定成年年龄</li>
            <li>在使用<?php echo $settings['sitename_short'] ?>的服务之前，您必须注册<?php $settings['sitename_short'] ?>的帐号，提供您的完整法定姓名，当前住址，电话，有效的邮箱地址一起其他任何<?php echo $settings['sitename_short'] ?>要求您提供的信息。<?php echo $settings['sitename_short'] ?>有权以任何理由拒绝您的帐号申请，或者取消您的现有帐号，所有解释权都有<?php echo $settings['sitename_short'] ?>单方面保有。</li>
            <li>您同意<?php echo $settings['sitename_short'] ?>将使用您提供的邮箱做与您的通信用途。</li>
            <li>您有责任和义务确保自己设置的密码是安全的。<?php echo $settings['sitename_short'] ?>无法，也不会就您对自己帐号安全性的疏忽行为造成的任何损失付任何责任。</li>
            <li>您必须对自己帐号下的所有行为以及产生的任何内容，诸如数据，图片，链接等付法律责任。您不可以传输任何形式的电脑病毒或恶意代码。</li>
            <li>任何由<?php echo $settings['sitename_short'] ?>单方面认为存在违反本服务条款的行为都会造成我们对您的服务的终止。</li>
          </ol>
          
          <h2>2. 帐号的激活</h2>
          <ol>
            <li>在条款2.2的前提下，注册使用服务的用户将被认为是“Contracting party” (“帐号拥有人”)。此用户将受被服务条款的约束，并成为唯一的授权使用以及和我们联系的主体。</li>
            <li>如果您是为你的雇主注册的帐号，您的雇主应该为帐号所有人。如果您是替您的雇主申请并使用<?php echo $settings['sitename_short'] ?>的服务，那么您将代表您的雇主并承诺您有让您的雇主遵守本服务条款的权利。</li>
            <li>注册完帐号之后，如果您选择的帐号带有在线支付功能的话，<?php echo $settings['sitename_short'] ?>会替您用您的邮箱注册<a href="https://stripe.com/au/">Stripe在线支付平台</a>的帐号，您同意提供任何在Stripe注册过程中所需要的注册信息，并授权<?php echo $settings['sitename_short'] ?>代你完成注册工作。注册工作后，我们会把具体帐号登录信息反馈给你，您承诺会修改帐号密码已确保您的Stripe帐号不被任何第三方（包括<?php echo $settings['sitename_short'] ?>）使用</li>
            <li>Stripe支付平台是和<?php echo $settings['sitename_short'] ?>没有任何合作关系的独立平台，您同意接受任何Stripe的服务条款以及收费规定，并对<?php echo $settings['sitename_short'] ?>替您注册的Stripe帐号拥有所有权和管理义务。<?php echo $settings['sitename_short'] ?>不对任何由Stripe方产生的问题或者费用承担任何法律责任。</li>
          </ol>
          
          <h2>3. 通用条款</h2>
          <p>在成为<?php echo $settings['sitename_short'] ?>的注册会员之前，您必须仔细阅读并同意接受本服务条款以及<a href="http://<?php echo SITEDOMAIN ?>/privacy">隐私条款</a>下的所有条款。</p>
          <ol>
            <li>除白金会员以外，其他会员仅享有有限的邮件技术支持</li>
            <li>本服务条款应受澳洲本地法律法规约束，任何和澳洲法律法规冲突的地方已澳洲法律法规为准。</li>
            <li>您知晓并认同<?php echo $settings['sitename_short'] ?>可能会对本服务条款在任何时间进行修改。任何修改在更改当天即时生效。您如果继续使用<?php echo $settings['sitename_short'] ?>提供的服务，即表示您接受并同意修改后的服务条款。如果您不同意或者接受任何的服务条款，请立刻终止使用我们的服务。</li>
            <li>您不可以使用<?php echo $settings['sitename_short'] ?>提供的任何服务从事非法活动，任何违反使用者当地或者澳洲本地法律法规的行为都是不被允许的。</li>
            <li>您同意不以任何的形式复制，转手贩卖，销售或暴露<?php echo $settings['sitename_short'] ?>提供的服务中的任何部分，除非您已书面的形式征求我们的同意。</li>
            <li>您在给自己的网店做推广的时候，不可以使用<?php echo $settings['sitename_short'] ?>的商业形象替代你自己的商业形象。<?php echo $settings['sitename_short'] ?>是您的技术平台，但并不对您微店的商业行为拥有所有权。</li>
            <li>您清楚地认识到您的网店内容都会以不加密的形式在各种网络环境中传输。任何信用卡信息都会以安全的加密形式传输。</li>
            <li>您认识并同意你在使用<?php echo $settings['sitename_short'] ?>的服务过程中受隐私条款的约束<a href="http://<?php echo SITEDOMAIN ?>/privacy">http://<?php echo SITEDOMAIN ?>/privacy</a></li>
            <li>本服务条款是已中文形式书写的。（The parties have required that the Terms of Service and all documents relating thereto be drawn up in Chinese. ）</li>
          </ol>
          
          <h2>4. <?php echo $settings['sitename_short'] ?>的权利</h2>
          <ol>
            <li></li>
          </ol>
        </div>
			</div>
		</div>

        <footer>
            <span>&copy; Grabby.io 2015</span>
            <ul>
                <li><a href="/terms">Terms &amp; Conditions</a></li>
                <li><a href="/privacy">Privacy Policy</a></li>
                <li><a href="/cookies">Information about Cookies</a></li>
            </ul>
        </footer>