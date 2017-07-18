<?php

namespace App\Presenters;

use Nette;

abstract class BasePresenter extends Nette\Application\UI\Presenter {
    /** @inject @var Nette\Database\Context */
    public $database;
}
