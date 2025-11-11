<?php
require_once 'config.php';

class Language {
    private static $currentLang = DEFAULT_LANG;
    private static $translations = [];

    public static function init() {
        // Check if language is set in session or GET parameter
        if (isset($_GET['lang']) && in_array($_GET['lang'], AVAILABLE_LANGS)) {
            self::$currentLang = $_GET['lang'];
            $_SESSION['lang'] = $_GET['lang'];
        } elseif (isset($_SESSION['lang']) && in_array($_SESSION['lang'], AVAILABLE_LANGS)) {
            self::$currentLang = $_SESSION['lang'];
        }

        // Load translations
        self::loadTranslations();
    }

    private static function loadTranslations() {
        $file = __DIR__ . '/../languages/' . self::$currentLang . '.json';
        if (file_exists($file)) {
            $json = file_get_contents($file);
            self::$translations = json_decode($json, true);
        }
    }

    public static function get($key, $default = '') {
        return self::$translations[$key] ?? $default;
    }

    public static function getCurrentLang() {
        return self::$currentLang;
    }

    public static function getSuffix() {
        return '_' . self::$currentLang;
    }
}

// Initialize language
Language::init();

// Helper function
function t($key, $default = '') {
    return Language::get($key, $default);
}
