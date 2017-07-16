<?php

class Config {
    const MOD_DB = 'db'; // database module

    PUBLIC STATIC function load(string $module = '') {
        switch ($module) {
            default:
                return FALSE;
                break;
            case self::MOD_DB:
                return self::mod_database();
                break;
        }
    }

    PROTECTED STATIC function mod_database() {
        return [
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'zeus',
            'port' => 3306,
            'socket' => '',
        ];
    }
}