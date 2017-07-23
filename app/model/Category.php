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

    /**
     * Returns category list
     * @param bool $articlesOnly - TRUE returns only categories with at least one article (frontend), FALSE otherwise (admin)
     * @return Nette\Database\Table\Selection
     */
    public function getList($articlesOnly = TRUE) {
        $sel = $this->database->table(self::TABLE_NAME);
        if ($articlesOnly) {
            $sel->group('Category.ID')->having('COUNT(:' . Article::TABLE_NAME . '.' . Article::COLUMN_ID . ') > 0');
        }
        return $sel;
    }

    /**
     * Returns newest articles list
     * @param bool $publishedOnly - TRUE returns only articles which has been published already (frontend), FALSE otherwise (admin)
     * @param int $limit - number of articles returned
     * @return Nette\Database\Table\Selection
     */
    public function getNewestArticles(int $limit = 3, bool $publishedOnly = TRUE) {
        $sel = $this->database->table(Article::TABLE_NAME);
        if ($publishedOnly) {
            $sel->where([
                'PublishDate IS NOT NULL'
            ]);
        }
        $sel->limit($limit)->order('PublishDate DESC');
        return $sel;
    }

}