<?php

namespace App\Presenters;


use App\Model\Article;
use App\Model\Category;

class CategoryPresenter extends BasePresenter {

    public function renderDefault($ID, $Name) {
        $category = new Category($this->database);
        $article = new Article($this->database);
        $this->template->categoryList = $category->getList();
        $this->template->articles = $article->getArticles_ByCategoryID($ID);
    }
}
