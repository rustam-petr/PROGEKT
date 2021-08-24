<div class="container" id="reg">
    <div class="row">
        <div class="col">

        </div>
        <div class="col registr">
            <form action="?type=Aut&action=reg" method="post">
                <input class="form-control form-group" type="text" name="name" placeholder="Введите имя"
                       value="<?= $_SESSION['regData']['name'] ?? '' ?>"><br>
                <input class="form-control form-group" type="text" name="login" placeholder="Введите логин"
                       value="<?= $_SESSION['regData']['login'] ?? '' ?>"><br>
                <input class="form-control form-group" type="password" name="pass1" placeholder="Введите пароль"
                       value="<?= $_SESSION['regData']['pass1'] ?? '' ?>"><br>
                <input class="form-control form-group" type="password" name="pass2"
                       placeholder="Введите пароль повторно"
                       value="<?= $_SESSION['regData']['pass2'] ?? '' ?>"><br>

                <input id="regsub" class="btn btn-lg btn-primary btn-block btn-signin" type="submit" value="Зарегистрироваться">
            </form>

        </div>
        <div class="col">

        </div>
    </div>
</div>
<?php
unset($_SESSION['regData']);
?>