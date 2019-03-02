<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="index.php"><img class="logo" src="./img/sqstorage.png" /></a>
    <ul class="nav">
        <li class="nav-item"><a href="index.php" class="nav-link">{'Eintragen'|gettext}</a></li>
        <li class="nav-item"><a href="inventory.php" class="nav-link">{'Inventar'|gettext}</a></li>
        <li class="nav-item"><a href="categories.php" class="nav-link">{'Kategorien'|gettext}</a></li>
        <li class="nav-item"><a href="transfer.php" class="nav-link">{'Transferieren'|gettext}</a></li>
    </ul>

    <form class="form-inline my-2 " method="GET" action="inventory.php">
        <input class="form-control mr-sm-2" name="searchValue" type="search" placeholder="{'Suche'|gettext}" aria-label="{'Suche'|gettext}">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">{'Suchen'|gettext}</button>
    </form>
</nav>