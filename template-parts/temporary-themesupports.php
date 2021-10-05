<?php 
/**
 * Debug theme-supports template
*/

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
?>
<aside class="debug-info">
    <style>
        @counter-style checked {
            system: cyclic;
            symbols: "✔";
            suffix: " ";
        }
        @counter-style removed {
            system: cyclic;
            symbols: "❌";
            suffix: " ";
        }
        .debug-info{
            display: flex;
            flex-flow: column;
            background:aliceblue;
            border-left: 15px solid #4a90e2;
            color:black;
            padding:1.25rem;
            border-radius:5px;
        }
        .debug-info h3{
            margin:0;
        }
        .debug-info h3 .kicker{
            display: block;
            font-size:1rem;
            font-weight: 700;
            color:#4a90e2;
        }
        .debug-info h3 .kicker:before{
            content: "i";
            color: #4a90e2;
            border: 1px solid #4a90e2;
            border-radius: 50%;
            display: inline-block;
            width: 1.75rem;
            height: 1.75rem;
            padding: 0.45rem 0.6rem;
            box-sizing: border-box;
            font-size: 1.5rem;
            font-style: italic;
            line-height: .75rem;
            margin-right: 0.75rem;
            font-family: serif;
            font-weight: bold;
        }
        .debug-info ul {
            margin:0;
           /* list-style: thumbs; */
        }
        .debug-info li.checked{
            /* list-style-type: custom-counter-style; */
            list-style-type: checked;
        }
        .debug-info li.removed{
            /* list-style-type: custom-counter-style; */
            list-style-type: removed;
        }
    </style>
    <h3><span class="kicker">DEBUG INFO</span> Theme supports tests:</h3>
    <ul>
<?php
foreach ($supports as $key => $value){
    if (current_theme_supports( $key )){
        ?><li class="checked"><p><?php
        echo $key;
        ?></p></li><?php
    } else {
        ?><li class="removed"><p><?php
        echo $key;
        ?></p></li><?php
    }
}
?>
    </ul>
</aside>