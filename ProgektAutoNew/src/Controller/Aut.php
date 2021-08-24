<?php


namespace App\Controller;


use App\Helper\Password;
use App\Model\AutModel;

class Aut extends AbstractController
{
    /**
     * @var AutModel
     */
    protected AutModel $model;

    public function __construct()
    {
        parent::__construct();
        $config = include __DIR__ . "/../../config.php";
        $config["table"] = "users";
        $this->model = new AutModel($config);
    }

    public function actionShow(): void
    {
        $this->view->setTemplate("Aut/login");
    }

    public function actionShowReg(): void
    {
        $this->view->setTemplate("Aut/registration");
    }

    public function actionReg(): void
    {
        $ok = true;

        $pass = new Password((string)$_POST['pass1']);

        if ($_POST['name'] == '') {
            /**
             * $_SESSION['warnings'] array<string>
             */
            $_SESSION['warnings'][] = 'Имя не может быть пустым!';
            $ok = false;
        }

        if ($_POST['pass1'] != $_POST['pass2']) {
            $_SESSION['warnings'][] = 'Пароли не совпадают!';
            $ok = false;
        } elseif (!$pass->checkMinSize()) {
            $_SESSION['warnings'][] = 'Пароль не может быть меньше 8 символов!';
            $ok = false;
        } elseif (!$pass->checkMaxSize()) {
            $_SESSION['warnings'][] = 'Пароль не может быть больше 128 символов!';
            $ok = false;
        } elseif (!$pass->checkLatin()) {
            $_SESSION['warnings'][] = 'Пароль должен содержать латинские символы!';
            $ok = false;
        }
        elseif ($pass->checkSpaceSymbol()) {
            $_SESSION['warnings'][] = 'Пароль не должен содержать пробел!';
            $ok = false;
        } elseif (!$pass->containsNumbers()) {
            $_SESSION['warnings'][] = 'Пароль должен содержать цифры!';
            $ok = false;
        }

        if ($this->model->checkUserExists($_POST['login'])) {
            $_SESSION['warnings'][] = "Имя пользователя <b>{$_POST['login']}</b> занято!";
            $ok = false;
        } elseif ($_POST['login'] == '') {
            $_SESSION['warnings'][] = "Логин не может быть пустым!";
            $ok = false;
        }

        if ($ok) {
            $config = include __DIR__ . "/../../config.php";
            $this->model->addNewUser($_POST['login'], md5($_POST['pass1'] . $config['salt']), $_POST['name'], 'guest');
//            $this->model->addNewUser($_POST['login'], $_POST['pass1'], $_POST['name']);
            $this->redirect("?");
        } else {
            $_SESSION['regData'] = $_POST;
            $this->redirect("?type=Aut&action=showreg");
        }

    }

    /**
     * @throws \Exception
     */
    public function actionLogin(): void
    {
        $config = include __DIR__ . "/../../config.php";
        $user = $this->model->checkUser($_POST['login'], md5($_POST['pass'] . $config['salt']));
//        print_r($user);
        if (empty($user)) {
            $this->redirect("?type=Aut&action=show");
        } else {
            $_SESSION['user'] = $user[0];
            $this->redirect("?");
        }

    }

    public function actionLogout(): void
    {
        unset($_SESSION['user']);
        $this->redirect("?type=Aut&action=show");
    }
}