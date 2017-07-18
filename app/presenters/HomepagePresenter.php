<?php

namespace App\Presenters;


class HomepagePresenter extends BasePresenter {

    public function renderDefault() {
        $res = $this->database->table('test')->fetch();
        $this->template->test = $res;
    }
}
