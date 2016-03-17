	
    <!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

    
    <!-- copied from shopify -->
    
		<header>
			<h1 id="logo"><?php echo $settings['sitename'] ?></h1>
      <?php $html->renderOut('site/components/home_nav'); ?>
		</header>

    <?php $html->renderOut('site/components/mobile_nav') ?>

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
            <li>我们保留在任何时间，以任何理由更改以及终止服务的权利。</li>
            <li>我们保留在任何时间，以任何理由向任何人拒绝服务的权利。</li>
            <li>我们可以删除我们单方面认为是非法，带有攻击性，威胁性，诽谤或者有损名誉，黄色，淫秽或者其他有异议和侵犯任何个体知识产权及本服务条款的网店内容。我们并不在法律上有必须要删除上述内容的责任。</li>
            <li>如用户有任何以口头或者书面形式的侮辱言论或者人生攻击（包括威胁，辱骂和报复言论等），我们将立即关闭帐号。</li>
            <li><?php echo $settings['sitename_short'] ?>并不对用户网店的商品进行预检，我们保留单方面拒绝，或者删除用户网店内容的权利。</li>
            <li>我们保留向您的竞争对手提供服务的权利，我们不对任何人提供排他的专卖权。<?php echo $settings['sitename_short'] ?>的工作人员同时也可能是<?php echo $settings['sitename_short'] ?>的客户或者用户（店主），他们是有权和您在本平台上的网店竞争的。当然，他们不可以使用您的隐私数据做竞争之用。</li>
            <li>如果出现任何形式的帐号所有权争执，我们保留向您索要身份证件以确认帐号所有权的权利。身份证件可以但不局限于您的营业执照，政府颁发的身份证明，您信用卡的最后4位数字，等等。</li>
            <li><?php echo $settings['sitename_short'] ?>保留单方面判断及决定帐号所有权的权利。如果我们无法合理的决定帐号的所有人，<?php echo $settings['sitename_short'] ?>保留暂时暂停帐号的权利。直至帐号的所有权有合理的仲裁。</li>
            <li>如果您委托<?php echo $settings['sitename_short'] ?>代为设置支付帐号，您即同意提供设置帐号所需要的所有信息，包括但不限于您的银行帐号，个人信息，ABN等等。您以任何形式提供的材料如有意外泄漏，<?php echo $settings['sitename_short'] ?>对此不承担任何法律责任。</li>
          </ol>
          
          <h2>5. 免责声明</h2>
          <ol>
            <li>您清楚地理解并且同意<?php echo $settings['sitename_short'] ?>不会对任何您使用我们服务（或者无法使用我们的服务）过程中产生的直接，间接，意外发生的或者特殊情况造成的损失负责。这些损失包括但不局限于利润损失，信誉损失，数据或者其他形式的无形资产损失。</li>
            <li><?php echo $settings['sitename_short'] ?>不对任何和我们的网站，网店平台或者提供的服务的使用过程中产生的特殊事故或者由事故间接产生的损失承担任何责任。在您违反本服务条款的时候，我们同样不对由此产生的任何形式的损失承担责任。您同意承担任何由您违反法律，第三方的法规和条例，以及我们的服务条款而产生的诉讼费，律师费以及其他相关费用。</li>
            <li>您同意使用我们的服务的前提是自担风险。我们的服务提供的标准是"as is"及"as available"。我们不对提供的服务承担任何质量担保，不论是明确声明的还是隐晦的或者法定意义上的。</li>
            <li><?php echo $settings['sitename_short'] ?>不承诺服务是100%不间断的，实时的，安全的以及无差错的。</li>
            <li><?php echo $settings['sitename_short'] ?>不承诺使用我们的服务得到的结果是准确和可靠的。</li>
            <li><?php echo $settings['sitename_short'] ?>不承诺任何您在我们平台上购买的商品，服务，信息以及其他您在我们平台上购买的物品会达到您的期望值。我们同时也不承诺任何服务中出现的错误会被纠正。虽然我们会尽力纠正出现的所有问题。</li>
          </ol>
          
          <h2>6. Waiver and Complete Agreement</h2>
          <p>如果<?php echo $settings['sitename_short'] ?>未实施或应用本条款中属于我们的任何权利，并不代表我们放弃追究或者履行的权利。本服务条款是由您本人以及<?php echo $settings['sitename_short'] ?>共同的共识，同时也是您使用我们提供的服务的指南。如果您和<?php echo $settings['sitename_short'] ?>有任何之前的协议，和本服务条款冲突的地方应以本条款为主。</p>
          
          <h2>7. 知识产权和用户产生的内容</h2>
          <ol>
            <li>我们对您向<?php $settings['sitename_short'] ?>提供的内容并不享有知识产权。您上传的任何内容都归您本人所有。您可以随时申请删除您的帐号以及所有上传的内容。</li>
            <li>在您上传网店内容的时候，您同意：(a) 允许其他互联网用户查看您上传的内容。 (b) 允许<?php echo $settings['sitename_short'] ?>显示并存储您上传的内容。 (c) <?php echo $settings['sitename_short'] ?>可以在任何时间对您上传的内容进行审查。</li>
            <li>您对您网店内的内容保有所有权，然而，您的网店是对公众开放的，您同意所有其他的网络用户查看您网店上的内容。你对您网店上的内容的合法性负有责任。</li>
            <li>我们不会向第三方泄漏您的保密信息，除非是以向您提供服务为前提。保密信息包括您向我们提供的任何不公开的信息。保密信息不包括：(a) 我们接受到信息的时候，信息本身已经是公开的了。 (b) 我们收到您的保密信息后，因非我方的过失而流露给了公众。 (c) 我们从第三方处获得了您的信息，并且第三方和我方都没有违反保密的义务。 (d) 我方被法律要求提供您们的保密信息。</li>
            <li><?php echo $settings['sitename_short'] ?>对您的昵称，网店名以及网店商标，服务商标，logo以及其他和您的网店有关的形象资产享有推广的使用权。</li>
          </ol>
          
          <h2>7. 取消和终止服务</h2>
          <ol>
            <li>您可以在任何时候联系我们取消您的帐号。</li>
            <li>不论任意一方因何种原因终止服务的时候：
              <ol>
                <li><?php echo $settings['sitename_short'] ?>将停止向您提供服务。您将无法登陆您的帐号</li>
                <li>除非在服务条款中另外申明，您将不会获得任何的退款或者经济补偿</li>
                <li>您欠<?php echo $settings['sitename_short'] ?>的任何未支付款项需立即支付</li>
                <li>您的网店将会下线。</li>
              </ol>
            </li>
            <li>如在终止服务的当天你在<?php echo $settings['sitename_short'] ?>有任何未支付款项，您会收到我们发出的账单。账单支付之后，您不会被要求再支付任何款项。</li>
            <li>我们保留在未通知您的前提下，以任何理由更改，终止或关闭您的帐号的权利。</li>
            <li>如果我们怀疑您以任何形式从事任何欺诈活动，我们会暂停或者终止您的帐号。</li>
          </ol>
          
          <h2>8. 服务和费用的更改</h2>
          <ol>
            <li><?php echo $settings['sitename_short'] ?>保留随时更改收费价格的权利。我们会在网站上登出最新的价格。</li>
            <li><?php echo $settings['sitename_short'] ?>保留在未给出通知的前提下随时更改服务或终止服务的权利。</li>
          </ol>
          
          <h2>9. 第三方服务条款</h2>
          <ol>
            <li>除了本服务条款之外，您同时也同意遵守和我们平台所使用的，或者有合作关系的第三方服务商的服务条款。</li>
            <li><?php echo $settings['sitename_short'] ?>可能会经常向您推荐，或者使用第三方提供的软件，网络服务接口，网站链接，网络服务等等（统称第三方服务）。这些第三方服务仅您的方便而提供，您在使用这些服务的时候需自己承担风险，您必须实现同意第三方服务的服务条款和隐私条款。<?php echo $settings['sitename_short'] ?>不对任何有使用第三方服务而产生的问题或损失承担责任。</li>
            <li>我们对第三方提供的服务不承担质量担保。您理解并认可我们对第三方服务不拥有控制权，而且并不对第三方服务负任何责任。我们和第三方服务之间不存在认可关系，授权关系，赞助关系及营销关系。<?php echo $settings['sitename_short'] ?>强烈建议您在使用第三方服务的时候详细了解清楚服务条款，或者找专业人士帮助您理解服务条款。</li>
          </ol>
        </div>
			</div>
		</div>

<?php $html->renderOut('site/components/footer') ?>