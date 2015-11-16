<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><?php i18n_echo(array('en' => 'Dashboard', 'zh' => '面板')); ?></h1>
    </div>
  </div>
  
    <?php echo Backend::renderDashboard(); ?>
  <ul id="inner-side-menu" class="nav">
  <?php echo Backend::renderSideNavRegistry() ?>
  </ul>
</div>