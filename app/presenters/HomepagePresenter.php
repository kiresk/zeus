<?php

namespace App\Presenters;


use App\Model\Category;
use App\Model\Comment;

class HomepagePresenter extends BasePresenter {

    public function renderDefault() {
        $category = new Category($this->database);
        $comment = new Comment($this->database);
        $this->template->categoryList = $category->getList();
        $this->template->newArticles = $category->getNewestArticles();
        $this->template->recentComments = $comment->getComments_ByArticle()['comments'];
    }
}
