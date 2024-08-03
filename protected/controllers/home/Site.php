<?php

namespace app\controllers;

use dee\base\Controller;

use Dee;
class Site extends Controller
{

    public function actionAku()
    {
        $sql = 'select * from users';
        $users = Dee::$app->db->queryAll($sql);
        return $this->render('site/user', ['users' => $users]);
    }

    public function actionJson()
    {
        $model = new \app\models\User();
        Dee::$app->response->format = "json";
        return $model->getAll();
    }

    public function actionIndex()
    {
        $data['theme'] = 'biznews';
        return $this->render('biznews/contact.html', $data);
    }

    public function actionLogin()
    {
        $message = $username = $password = null;
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($username == 'admin' && $password == 'admin') {
                Dee::$app->user->login($username);
                Dee::redirect('home/site/aku');
            } else {
                $message = 'Wrong username password';
            }
        }

        return $this->render('site/login', [
            'message' => $message,
            'username' => $username,
            'password' => $password,
        ]);
    }

    public function actionLogout()
    {
        Dee::$app->user->logout();
        Dee::redirect('home/site');
    }

    public function actionContoh()
    {
        return $this->render('site/contoh');
    }

    public function actionPage($page)
    {
        return $this->render('site/pages/' . $page);
    }
}
