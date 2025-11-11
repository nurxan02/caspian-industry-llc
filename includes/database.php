<?php
require_once 'config.php';

class Database {
    private static $instance = null;
    private $db;

    private function __construct() {
        try {
            $this->db = new PDO('sqlite:' . DB_PATH);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->createTables();
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->db;
    }

    private function createTables() {
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS contacts (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT NOT NULL,
                phone TEXT,
                subject TEXT,
                message TEXT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                is_read INTEGER DEFAULT 0
            )
        ");

        $this->db->exec("
            CREATE TABLE IF NOT EXISTS news (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title_en TEXT NOT NULL,
                title_ru TEXT NOT NULL,
                title_az TEXT NOT NULL,
                content_en TEXT NOT NULL,
                content_ru TEXT NOT NULL,
                content_az TEXT NOT NULL,
                excerpt_en TEXT,
                excerpt_ru TEXT,
                excerpt_az TEXT,
                image TEXT,
                published_date DATE,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                is_published INTEGER DEFAULT 1
            )
        ");

        $this->db->exec("
            CREATE TABLE IF NOT EXISTS projects (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title_en TEXT NOT NULL,
                title_ru TEXT NOT NULL,
                title_az TEXT NOT NULL,
                description_en TEXT NOT NULL,
                description_ru TEXT NOT NULL,
                description_az TEXT NOT NULL,
                category_en TEXT,
                category_ru TEXT,
                category_az TEXT,
                client TEXT,
                completion_date DATE,
                location TEXT,
                images TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                is_published INTEGER DEFAULT 1,
                sort_order INTEGER DEFAULT 0
            )
        ");

        $this->db->exec("
            CREATE TABLE IF NOT EXISTS gallery (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title_en TEXT,
                title_ru TEXT,
                title_az TEXT,
                image TEXT NOT NULL,
                description_en TEXT,
                description_ru TEXT,
                description_az TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                sort_order INTEGER DEFAULT 0
            )
        ");

        $this->db->exec("
            CREATE TABLE IF NOT EXISTS partners (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                logo TEXT NOT NULL,
                website TEXT,
                description_en TEXT,
                description_ru TEXT,
                description_az TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                sort_order INTEGER DEFAULT 0
            )
        ");

        $this->db->exec("
            CREATE TABLE IF NOT EXISTS faq (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                question_en TEXT NOT NULL,
                question_ru TEXT NOT NULL,
                question_az TEXT NOT NULL,
                answer_en TEXT NOT NULL,
                answer_ru TEXT NOT NULL,
                answer_az TEXT NOT NULL,
                category TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                sort_order INTEGER DEFAULT 0
            )
        ");

        $this->db->exec("
            CREATE TABLE IF NOT EXISTS site_settings (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                setting_key TEXT UNIQUE NOT NULL,
                setting_value TEXT,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");

        // Insert default settings if not exist
        $this->insertDefaultSettings();
    }

    private function insertDefaultSettings() {
        $defaults = [
            ['contact_email', 'info@caspianindustry.com'],
            ['contact_phone', '+994 12 123 45 67'],
            ['contact_address_en', 'Baku, Azerbaijan'],
            ['contact_address_ru', 'Баку, Азербайджан'],
            ['contact_address_az', 'Bakı, Azərbaycan'],
            ['facebook_url', '#'],
            ['linkedin_url', '#'],
            ['instagram_url', '#'],
            ['twitter_url', '#']
        ];

        $stmt = $this->db->prepare("INSERT OR IGNORE INTO site_settings (setting_key, setting_value) VALUES (?, ?)");
        foreach ($defaults as $setting) {
            $stmt->execute($setting);
        }
    }
}

// Initialize database
Database::getInstance();
