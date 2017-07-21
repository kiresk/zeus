<?php

namespace App\Presenters;

use App\Forms;


class SignPresenter extends BasePresenter {
    /** @var Forms\SignInFormFactory */
    private $signInFactory;

    /** @var Forms\SignUpFormFactory */
    private $signUpFactory;


    public function __construct(Forms\SignInFormFactory $signInFactory, Forms\SignUpFormFactory $signUpFactory) {
        parent::__construct();
        $this->signInFactory = $signInFactory;
        $this->signUpFactory = $signUpFactory;
    }

    public function actionOut() {
        $this->getUser()->logout();
    }

    /**
     * Sign-in form factory.
     * @return \Nette\Application\UI\Form
     */
    protected function createComponentSignInForm() {
        return $this->signInFactory->create(function() {
            $this->redirect('Homepage:');
        });
    }

    /**
     * Sign-up form factory.
     * @return \Nette\Application\UI\Form
     */
    protected function createComponentSignUpForm() {
        return $this->signUpFactory->create(function() {
            $this->redirect('Homepage:');
        });
    }
}
