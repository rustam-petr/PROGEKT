<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3b705;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link<?= $this->data['controllerName'] == "Main" ? " active" : "" ?>" href="?">Home <span
                            class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= $this->data['controllerName'] == "Userad" ? " active" : "" ?>"
                   href="?type=Userad&action=show">Объявления о продаже автомашин</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   href="?type=Aut&action=logout">Выйти(<?= isset($_SESSION['user']['code']) ? $_SESSION['user']['name'] : "" ?>)</a>
            </li>
        </ul>
    </div>
</nav>

