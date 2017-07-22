<?php

namespace App\Model;

use Nette;

/**
 * Article
 */
class Article {
    use Nette\SmartObject;

    const
        TABLE_NAME = 'Article',
        COLUMN_ID = 'ID',
        COLUMN_USER = 'UserID',
        COLUMN_CATEGORY = 'CategoryID',
        COLUMN_CREATION_DATE = 'CreationDate',
        COLUMN_PUBLISH_DATE = 'PublishDate',
        COLUMN_TITLE = 'Title',
        COLUMN_TEXT = 'Text';


    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    public function getArticle(int $ArticleID) {
        return $this->database->table(self::TABLE_NAME)->where([
            self::COLUMN_ID => $ArticleID
        ])->fetch();
    }

    public function getArticles_ByCategoryID(int $CategoryID, int $page = 1) {
        return $this->database->table(self::TABLE_NAME)->where([
            self::COLUMN_CATEGORY => $CategoryID
        ]);
    }

}