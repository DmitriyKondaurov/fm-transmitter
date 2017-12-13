<?php
/*
Plugin Name: Inbound Extension - GeoDetect
Plugin URI: http://www.inboundnow.com/
Description: Adds GeoIP Detection plugin to the WordPress environment and enhances the Lead Profile with geolocation information
Version: 1.0.2
Author: Inbound Now
Contributors: Hudson Atwell, Benjamin Pick
Author URI: http://www.inboundnow.com/
*/


if (!class_exists('Inbound_GeoDetect')) {


    class Inbound_GeoDetect {

        static $map;
        static $settings;

        /**
         *  Initialize class
         */
        public function __construct() {
            self::define_constants();
            self::include_files();
            self::load_hooks();
        }


        /**
         *  Define constants
         */
        public static function define_constants() {
            define('INBOUND_GEODETECT_CURRENT_VERSION', '1.0.2');
            define('INBOUND_GEODETECT_LABEL', __('Inbound GeoDetect', 'inbound-pro'));
            define('INBOUND_GEODETECT_SLUG', 'inbound-geodetect' );
            define('INBOUND_GEODETECT_FILE', __FILE__);
            define('INBOUND_GEODETECT_REMOTE_ITEM_NAME', 'inbound-geodetect');
            define('INBOUND_GEODETECT_PATH', realpath(dirname(__FILE__)) . '/');
            $upload_dir = wp_upload_dir();
            $url = ( !strstr( INBOUND_GEODETECT_PATH , 'plugins' )) ? $upload_dir['baseurl'] . '/inbound-pro/extensions/' .plugin_basename( basename(__DIR__) ) .'/' : WP_PLUGIN_URL.'/'.plugin_basename( dirname(__FILE__) ).'/' ;
            define('INBOUND_GEODETECT_URLPATH', $url );
        }

        public static function include_files() {
            /* load wp-geoip-detect plugin */
            if (!defined('GEOIP_DETECT_VERSION')) {
                include_once INBOUND_GEODETECT_PATH . 'assets/geoip-detect/geoip-detect.php';
            }

            if (is_admin()) {

            }

        }

        /**
         * Load Hooks & Filters
         */
        public static function load_hooks() {

            /* Setup Automatic Updating & Licensing */
            add_action('admin_init', array(__CLASS__, 'license_setup'));

            /* Add Metaboxes */
            add_action('add_meta_boxes', array(__CLASS__, 'define_metaboxes'));

        }




        /**
         * Setups Software Update API
         */
        public static function license_setup() {

            /* ignore these hooks if inbound pro is active */
            if (defined('INBOUND_PRO_CURRENT_VERSION')) {
                return;
            }

            /*PREPARE THIS EXTENSION FOR LICESNING*/
            if (class_exists('Inbound_License')) {
                $license = new Inbound_License(INBOUND_GEODETECT_FILE, INBOUND_GEODETECT_LABEL, INBOUND_GEODETECT_SLUG, INBOUND_GEODETECT_CURRENT_VERSION, INBOUND_GEODETECT_REMOTE_ITEM_NAME);
            }
        }


        /**
         *
         */
        public static function define_metaboxes() {
            global $post, $wp_meta_boxes;

            if ($post->post_type != 'wp-lead') {
                return;
            }

            /* Show IP Address & Geolocation metabox */
            add_meta_box('lp-ip-address-sidebar-preview', __('GeoDetect', 'inbound-pro'), array(__CLASS__, 'display_geolocation'), 'wp-lead', 'side', 'low');

        }

        /**
         *  Display information about last visit given ip address
         */
        public static function display_geolocation() {
            global $post;

            $ip_address = get_post_meta($post->ID, 'wpleads_ip_address', true);
            $geodata = json_decode(get_post_meta($post->ID, 'wpleads_geodata', true));

            /* not sure why this is neccecary but it cleans it */
            $ip_address = str_replace('"' , '' , $ip_address );

            if (!$geodata) {
                $geodata = geoip_detect2_get_info_from_ip($ip_address);
                $geodata = json_decode(json_encode($geodata));
                update_post_meta( $post->ID , 'wpleads_geodata' , json_encode($geodata)  );
            }

            if (!isset($geodata) || !is_object($geodata) || is_wp_error($geodata) || !$ip_address) {
                echo "<h2>" . __('No Geo data collected', 'inbound-pro') . "</h2>";
                return;
            }

            /* get local */
            $locale = get_locale();
            $locale =  (isset($geodata->city->names->$locale)) ? $geodata->city->names->$locale : 'en';

            ?>
            <div>
                <div class="inside" style='margin-left:-8px;text-align:left;'>
                    <div id='last-conversion-box'>
                        <div id='lead-geo-data-area'>

                            <?php
                            if (isset($geodata->city->names->$locale)) {
                                echo "<div class='lead-geo-field'><span class='geo-label'>" . __('City:', 'inbound-pro') . "</span>" . $geodata->city->names->$locale . "</div>";
                            }
                            if (isset($geodata->subdivisions[0]->names->$locale)) {
                                echo "<div class='lead-geo-field'><span class='geo-label'>" . __('State:', 'inbound-pro') . "</span>" . $geodata->subdivisions[0]->names->$locale . "</div>";
                            }

                            if (isset($geodata->postal->code)) {
                                echo "<div class='lead-geo-field'><span class='geo-label'>" . __('Postal Code:', 'inbound-pro') . "</span>" . $geodata->postal->code . "</div>";
                            }

                            if (isset($geodata->country->names->$locale)) {
                                echo "<div class='lead-geo-field'><span class='geo-label'>" . __('Country:', 'inbound-pro') . "</span>" . $geodata->country->names->$locale . "</div>";
                            }
                            if (isset($geodata->continent->names->$locale)) {
                                echo "<div class='lead-geo-field'><span class='geo-label'>" . __('Continent:', 'inbound-pro') . "</span>" . $geodata->continent->names->$locale . "</div>";
                            }


                            if (($geodata->location->latitude != 0) && ($geodata->location->longitude != 0)) {
                                echo '<a class="maps-link" href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=' . $geodata->location->latitude . ',' . $geodata->location->longitude . '&z=12" target="_blank">' . __('View Map:', 'inbound-pro') . '</a>';
                                echo '<div id="lead-google-map">
                                    <iframe width="278" height="276" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;q=' . $geodata->location->latitude . ',' . $geodata->location->longitude . '&amp;aq=&amp;output=embed&amp;z=11"></iframe>
                                    </div>';
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

    }


    new Inbound_GeoDetect();

}


