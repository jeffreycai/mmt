<div class="body">
  <div class="row section" style="padding-top: 20px;">
    
    <div class="col-xs-12">
      <?php echo Message::renderMessages(); ?>
    </div>
    
    <div class="col-xs-12">
    <?php echo MySiteUser::renderUpdateFormBackend($user, '', array(
      'avatar', 'active', 'username'
    )) ?>
    </div>
    
    <div class="col-xs-12">
      <p></p>
    </div>
  </div>
  
</div>