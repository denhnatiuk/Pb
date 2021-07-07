<?php 
/**
 * 
*/

if ( ! class_exists( 'Daynight' ) ) {

    final class Daynight {

        public static $instance;
        public $options;
        public $contents;
        private $temp;

        public $asset = array(
            'dependencies' => array(
                'wp-block-editor'
                , 'wp-blocks'
                , 'wp-element'
                , 'wp-i18n'
                , 'wp-polyfill'
            )
            , 'version' => 'e3fd02b56e410cfc13892e482946eee0'
        );

        public function __construct( $args = array() ){
            $this->set_options( $args );
        }

        /**
         * Create instance.
         *
         * @param  array $args Options
         * @return object Instance
         */
        static function init( $args = [] ){

            is_null( self::$instance ) && self::$instance = new self( $args );

            if( $args )
                self::$instance->set_options( $args );

            return self::$instance;
        }

        public function set_options( $args = array() ){
            $this->options = (object) array_merge( (array) $this->options, (array) $args );
        }

        public function button(){

        }

        

    }

}