<?php

namespace App\Presenters;

use App\Model\Article;
use App\Model\Category;
use App\Model\Comment;

class DiscussionPresenter extends BasePresenter {
    public function renderDefault(int $ID, $Name) {
        $article = new Article($this->database);
        $category = new Category($this->database);
        $comment = new Comment($this->database);

        $this->template->article = $article->getArticle($ID);
        $this->template->comment = $comment;
        $this->template->discussion = $comment->getComments_ByArticle($ID, 0);
        $this->template->categoryList = $category->getList(); // sidebar
        $this->template->newArticles = $category->getNewestArticles(); // sidebar
        $this->template->recentComments = $comment->getComments_ByArticle()['comments'];
    }
}
