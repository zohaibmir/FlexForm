<?php
/**
 * WPBakery Visual Composer Abstract classes
 *
 * @package WPBakeryVisualComposer
 *
 */

/* abstract VisualComposer class to create structural object of any type */

abstract class WPBakeryVisualComposerAbstract {

    public static $version;
    public static $config;

    public function __construct() {
    }

    public function init( $settings ) {
        self::$config = (array)$settings;
    }

    public function addAction($action, $method, $priority = 10) {
        add_action($action, array($this, $method), $priority);
    }

    public function addFilter($filter, $method, $priority = 10) {
        add_action($filter, array($this, $method), $priority);
    }
    /* Shortcode methods */
    public function addShortCode($tag, $func) {
        add_shortcode($tag,$func);
    }

    public function doShortCode($content) {
        do_shortcode($content);
    }

    public function removeShortCode($tag) {
        remove_shortcode($tag);
    }

    public function post($param) {
        return isset($_POST[$param]) ? $_POST[$param] : null;
    }

    public function get($param) {
        return isset($_GET[$param]) ? $_GET[$param] : null;
    }
    public function assetURL($asset) {
        return get_template_directory_uri() . '/includes/page-builder/' . self::$config['ASSETS_DIR'] . $asset;
    }
}

interface WPBakeryVisualComposerTemplateInterface
{
    public function output($post = null);
}