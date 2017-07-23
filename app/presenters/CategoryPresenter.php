<?php

namespace App\Presenters;


use App\Model\Article;
use App\Model\Category;
use Nette\Utils\Paginator;

class CategoryPresenter extends BasePresenter {

    public function renderDefault($ID, $Name, $page = 1) {
        $category = new Category($this->database);
        $article = new Article($this->database);

        $paginator = new Paginator();
        $paginator->setItemCount($article->getArticlesCount_ByCategoryID($ID));
        $paginator->setItemsPerPage(Category::ARTICLES_PER_PAGE);
        $paginator->setPage($page);

        $this->template->articles = $article->getArticles_ByCategoryID($ID)->limit($paginator->getLength(), $paginator->getOffset()); // articles in category
        $this->template->paginator = $paginator;
        $this->template->openedCategory = $category->getCategory($ID, $Name); // category name in h1
        $this->template->categoryList = $category->getList(); // sidebar
        $this->template->newArticles = $category->getNewestArticles(); // sidebar
    }
}
