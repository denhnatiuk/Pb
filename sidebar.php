<?php
/**
 * Description: Sidebar file.
 *
 * @package     pb
 * @since       1.0.0
 * @author      Den Hnatiuk
 * @copyright   Copyright(c ) 2021, Den Hnatiuk(@denhnatiuk )
 * @link        https://denyshnatiuk.github.io/Pb/
 *
 */

?> 

<aside id="secondary" class="sidebar">

<?php if ( is_active_sidebar( 'left-sidebar' ) ) { ?>
	<ul id="sidebar">
		<?php dynamic_sidebar( 'left-sidebar' ); ?>
	</ul> 
<?php } ?>

</aside>
