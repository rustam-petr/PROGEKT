<marquee class="strin" behavior="scroll" direction="left" bgcolor="yellow">
    Добро пожаловать на сайт продажи автомашин. Здесь вы можете зарегистрироваться и подать объявление о продаже
    автомашины.
</marquee>


<img  id="displayed" src="public/acura_PNG114.png">


<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link<?= $this->data['controllerName'] == "Main" ? " active" : "" ?>" href="?">Главная <span
                            class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= $this->data['controllerName'] == "Aut" ? " active" : "" ?>"
                   href="?type=Aut&action=show">Войти</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= $this->data['controllerName'] == "Aut" ? " active" : "" ?>"
                   href="?type=Aut&action=showreg">Регистрация</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= $this->data['controllerName'] == "Guestad" ? " active" : "" ?>"
                   href="?type=Guestad&action=show">Объявления о продаже автомашин</a>
            </li>


        </ul>
    </div>
</nav>


