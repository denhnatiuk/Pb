<?php 
/** 
 * @package Pb
 * 
 * Theme file for Site Footer
 */ 
?>
<footer class="site-footer">
    <div id="<?php echo esc_html( wp_get_theme()->get( 'TextDomain' ) ) ?>-footscripts" class="sr-only">
            <?php wp_footer(); ?>
    </div>
</footer>    
</body>
</html>