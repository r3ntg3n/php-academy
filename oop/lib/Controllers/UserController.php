<?php

namespace Academy\Controllers;

use Academy\UserIdentity\IdentityProviderFactory;

/*
    Login: [ r3ntg3n@gmail.com ]
    Password: [ ********* ]
    [ ] Google
    [*] Github
    [ ] Bitbucket
*/
class UserController
{
    /**
     * User login action.
     *
     * @return void
     */
    public function actionLogin()
    {
        $loginForm = new LoginForm();
        $authType = intval($_POST['authType']);
        // определяем тип авторизации
        $identityProvider = IdentityProviderFactory::build($authType);
        $loginForm
            ->setIdentityProvider($identityProvider)
            ->setAttributes($_POST['LoginForm']);

        if ($loginForm->authenticate()) {
            // авторизирован -- redirect
        }

        $this->render('user/login', [
            'model' => $loginForm,
        ]);
    }
}
