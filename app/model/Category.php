<?php

namespace App\Model;

use Nette;

/**
 * Category
 */
class Category {
    use Nette\SmartObject;

    const
        TABLE_NAME = 'Category',
        COLUMN_ID = 'ID',
        COLUMN_NAME = 'Name',
        ARTICLES_PER_PAGE = 7;


    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    public function getCategory($ID, $Name) {
        return $this->database->table(self::TABLE_NAME)->where([
            self::COLUMN_ID => $ID,
        ])->fetch();
    }


    public function getList() {
        return $this->database->table(self::TABLE_NAME);
    }

    public function getNewestArticles() {
        return $this->database->table('Article')->where([
            'PublishDate IS NOT NULL'
        ])->limit(3)->order('ID DESC');
    }

}