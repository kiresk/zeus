<?php

namespace App\Model;

use Nette;

/**
 * Comment
 */
class Comment {
    use Nette\SmartObject;

    const
        TABLE_NAME = 'Comment',
        COLUMN_ID = 'ID',
        COLUMN_USER = 'User',
        COLUMN_ARTICLE = 'Article',
        COLUMN_PARENT = 'Parent',
        COLUMN_CREATION_DATE = 'CreationDate',
        COLUMN_TEXT = 'Text';


    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

}