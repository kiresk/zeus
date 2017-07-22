<?php

namespace App\Presenters;


use App\Model\Article;
use App\Model\Category;

class ArticlePresenter extends BasePresenter {

    public function renderDefault($ID, $Name) {
        $category = new Category($this->database);
        $article = new Article($this->database);
        $this->template->categoryList = $category->getList();

        $article = $article->getArticle($ID);
        if ($article === FALSE) {
            $this->flashMessage('Článok neexistuje');
            $this->redirect("Homepage:");
        }
        $this->template->article = $article;
    }
}
