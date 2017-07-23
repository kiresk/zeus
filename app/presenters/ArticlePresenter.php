<?php

namespace App\Presenters;


use App\Model\Article;
use App\Model\Category;
use App\Model\Comment;

class ArticlePresenter extends BasePresenter {

    public function renderDefault($ID, $Name) {
        $category = new Category($this->database);
        $article = new Article($this->database);
        $comment = new Comment($this->database);
        $this->template->categoryList = $category->getList();

        $article = $article->getArticle($ID);
        if ($article === FALSE) {
            $this->flashMessage('Článok neexistuje');
            $this->redirect("Homepage:");
        }
        $this->template->article = $article;
        $this->template->newArticles = $category->getNewestArticles();
        $this->template->recentComments = $comment->getComments_ByArticle()['comments'];
        $this->template->comment = $comment;
        $this->template->discussion = $comment->getComments_ByArticle($ID, Comment::COUNT_RECENT, Comment::COLUMN_CREATION_DATE . ' DESC');
    }
}
