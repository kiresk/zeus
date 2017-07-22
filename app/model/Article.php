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
        COLUMN_USER = 'User',
        COLUMN_CATEGORY = 'Category',
        COLUMN_CREATION_DATE = 'CreationDate',
        COLUMN_PUBLISH_DATE = 'PublishDate',
        COLUMN_TITLE = 'Title',
        COLUMN_TEXT = 'Text';


    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

}