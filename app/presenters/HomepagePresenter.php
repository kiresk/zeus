<?php

namespace App\Presenters;


use App\Model\Category;

class HomepagePresenter extends BasePresenter {

    public function renderDefault() {
        $category = new Category($this->database);
        $this->template->categoryList = $category->getList();
        $this->template->newArticles = $category->getNewestArticles();
    }
}
