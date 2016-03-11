	
    <!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->


    
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
          <h1>联系我们</h1>
        </div>
        
        <div id="document">
          <h3>客服邮箱</h3>
          <p><script type="text/javascript">
                            document.write('<a href="mai');
                            document.write('lto');
                            document.write(':songguo.com.au');
                            document.write('@');
                            document.write('gmail.com">');
                            document.write('songguo.com.au');
                            document.write('@');
                            document.write('gmail.com<\/a>');
          </script></p>
          <h3>客服微信</h3>
          <p>aueightnews</p>
          <p><img src="<?php echo uri('modules/site/assets/images/qr-code.png', false) ?>" /></p>
        </div>
			</div>
		</div>

        <footer>
          <!--
            <ul id="social">
                <li><a href="http://www.facebook.com/GrabbyIo" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="http://www.twitter.com/GrabbyIo" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="http://www.medium.com/@GrabbyIo" target="_blank"><i class="fa fa-medium"></i></a></li>
            </ul>
          -->
            <span>&copy; <?php echo $settings['sitename'] ?> 2016</span>
            <ul>
                <li><a href="<?php echo uri('terms') ?>">网站使用条款及条件</a></li>
                <li><a href="<?php echo uri('privacy') ?>">隐私权和条款</a></li>
                <li><a href="<?php echo uri('cookies') ?>">关于Cookies</a></li>
                <li><a href="<?php echo uri('contact') ?>">联系我们</a></li>
            </ul>
        </footer>