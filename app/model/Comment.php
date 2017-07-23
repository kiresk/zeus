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
        COLUMN_TEXT = 'Text',
        COUNT_RECENT = 2,
        COUNT_ANSWERS = 3;


    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    public function getComments_ByArticle(int $ArticleID, int $limit = self::COUNT_RECENT) {
        $sel = $this->database->table(self::TABLE_NAME)->where([
            self::COLUMN_ARTICLE => $ArticleID
        ]);
        $count = $sel->count();
        $sel->where([
            self::COLUMN_PARENT . ' IS NULL'
        ])->limit($limit);
        return ['count' => $count, 'comments' => $sel];
    }

    public function getAnswers(int $CommentID, $limit = self::COUNT_ANSWERS) {
        $sel = $this->database->table(self::TABLE_NAME)->where([
            self::COLUMN_PARENT => $CommentID
        ])->limit($limit);
        return $sel;
    }
}