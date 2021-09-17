<?php
/**
 * @package         pb
 * @since           1.0.0
 * @author          Den Hnatiuk
 * @copyright       Copyright (c) 2021, Den Hnatiuk (@denhnatiuk)
 * @link            https://denyshnatiuk.github.io/Pb/
 * 
 * Description: Site header file.
*/
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--link rel="profile" href="https://gmpg.org/xfn/11"-->
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta name="description" content="<?php echo get_bloginfo( 'description' ) ?>">
	<meta name="keywords" content="">
	<?php wp_head(); ?>
</head>

<body <?php body_class( esc_html( wp_get_theme()->get( 'TextDomain' ) ) ); ?>>

<?php 	wp_body_open(); ?>


<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e( 'Skip to content', esc_html( wp_get_theme()->get( 'TextDomain' ) ) ); ?>
	</a>


    <header class="site-header">

        <div class="container">

            <div class="site-branding">
                <div class="brand-logo">
				<?php
					if (has_custom_logo()):
						the_custom_logo();
					else:
						// svg
					endif;
					?>
                </div>

                <h1 class="brand-title">

                    <span class="brand-title__kicker">
                        <?
                        $color = get_theme_mod('brand_color_main');
                        echo $color;                
                        ?>
                    </span>
                    <span class="brand-title__main"><?php echo get_bloginfo( 'title' )?></span>
                    <span class="brand-title__tagline"><?php echo get_bloginfo( 'description' )?></span>      
                    
                </h1>


    <?php
        wp_get_nav_menus();
    ?>

            </div>
        </div>
    </header>

    
    <?php
    $supports = (object) array(
        'title-tag' => null
        , 'custom-logo' => array(
            'height'               => 100,
            'width'                => 100,
            'flex-height'          => true,
            'flex-width'           => true,
            'header-text'          => array( 
                'site-title'
                , 'site-description' 
            ),
            'unlink-homepage-logo' => true, 
        )
        , 'post-tumbnails'      => null
        , 'wp-block-styles'     => null    
        , 'responsive-embeds'   => null
        , 'editor-styles'       => null    
        , 'custom-units'        => null    
        , 'editor-color-palette' => array(
            array(
                'name' => esc_attr__( 
                    'strong magenta'
                    , esc_html( wp_get_theme()->get( 'TextDomain' ) ) 
                )
                , 'slug' => 'strong-magenta'
                , 'color' => '#a156b4'
            )
            , array(
                'name' => esc_attr__( 
                    'light grayish magenta'
                    , esc_html( wp_get_theme()->get( 'TextDomain' ) )
                )
                , 'slug' => 'light-grayish-magenta'
                , 'color' => '#d0a5db'
            )
            , array(
                'name' => esc_attr__( 
                    'very light gray'
                    , esc_html( wp_get_theme()->get( 'TextDomain' ) )
                )
                , 'slug' => 'very-light-gray'
                , 'color' => '#eee'
            )
            , array(
                'name' => esc_attr__( 
                    'very dark gray'
                    , esc_html( wp_get_theme()->get( 'TextDomain' ) )
                )
                , 'slug' => 'very-dark-gray'
                , 'color' => '#444'
            )
        )
        , 'html5' => array(
            'search-form'
            ,'comment-form'
            ,'comment-list'
            ,'gallery'
            ,'caption'
            ,'style'
            ,'script'
        )
    );
    ?><h3>This theme supports:</h3><ul><?php
    foreach ($supports as $key => $value){
        if (current_theme_supports( $key )){
            ?><li><p><?php
            echo $key;
            ?></p></li><?php
        } 
    }
    ?>
    </ul>