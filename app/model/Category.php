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
        COLUMN_NAME = 'Name';


    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    public function getList() {
        return $this->database->table(self::TABLE_NAME);
    }

}