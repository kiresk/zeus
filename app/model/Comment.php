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

    public function getComments_ByArticle(int $ArticleID = 0, int $limit = self::COUNT_RECENT, string $orderby = self::COLUMN_CREATION_DATE) {
        $sel = $this->database->table(self::TABLE_NAME);
        if ($ArticleID > 0) {
            $sel->where([
                self::COLUMN_ARTICLE => $ArticleID
            ]);
        } else {
            $sel->group(self::COLUMN_ARTICLE);
        }
        $count = $sel->count();
        $sel->where([
            self::COLUMN_PARENT . ' IS NULL'
        ]);
        if ($limit > 0) {
            $sel->limit($limit);
        }
        $sel->order($orderby);
        return ['count' => $count, 'comments' => $sel];
    }

    public function getAnswers(int $CommentID, $limit = self::COUNT_ANSWERS) {
        $sel = $this->database->table(self::TABLE_NAME)->where([
            self::COLUMN_PARENT => $CommentID
        ])->limit($limit);
        return $sel;
    }
}