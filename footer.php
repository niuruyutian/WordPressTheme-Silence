		</div><!-- #primary -->
<div id="footer">
  <div id="footerbar">
      <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
          <div class="widget-area">
              <div class="footerbarcontent">
              <?php dynamic_sidebar( 'sidebar-1' ); ?>
              </div>
              <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
              <div class="footerbarcontent">
              <?php dynamic_sidebar( 'sidebar-2' ); ?>
               </div>
               <?php endif; ?>
          </div><!-- #widget-area -->
      <?php endif; ?>
  </div><!-- footerbar -->
  <div class="clear"></div>
    <div id="footertext">
    <?php echo stripslashes(get_option('mytheme_footertext')); ?>
  </div>
</div>
	</div><!-- #main .wrapper -->
</div><!-- #page -->
</div><!-- #container -->
<!-- JS -->
<!-- Statistical code begin -->
<?php if (get_option('mytheme_analytics')!="") {?>
<div id="analytics"><?php echo stripslashes(get_option('mytheme_analytics')); ?></div>
<?php }?>
<!--Statistical code end-->
<?php wp_footer(); ?>
<script type="text/javascript">
jQuery(function($){

  $(".searchicon").click(function(){
    $("#searchform").toggle(200);
    $("#s").focus();
  });


})
  </script>
</body>
</html>