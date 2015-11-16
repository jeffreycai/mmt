

<?php HTML::renderOutFooterUpperRegistry(); ?>
<?php Asset::printBottomAssets('frontend'); ?>
<?php HTML::renderOutFooterLowerRegistry(); ?>

<?php echo Asset::getDynamicAsset('user', 'js', 'frontend') ?>

</body>

</html>
