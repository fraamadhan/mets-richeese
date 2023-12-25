<?php
$data = file_get_contents('data/menu.json');
$menu = json_decode($data, true);

$menu = $menu["menu"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>METS Richeese</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" alt="mets logo" width="80">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="#" onclick="filterMenu('All Menu')">All Menu</a>
                    <?php
                    $categories = array_column($menu, 'menuType');
                    $unique_categories = array_unique($categories);
                    foreach ($unique_categories as $category) {
                    ?>
                        <a class="nav-link" href="#" onclick="filterMenu('<?= $category; ?>')"><?= $category; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h1>All Menus</h1>
            </div>
        </div>

        <div class="row" id="menuItems">
            <?php foreach ($menu as $data) : ?>
                <div class="col-lg-4 d-flex flex-column menuItem" data-category="<?= $data["menuType"]; ?>">
                    <div class="card mb-3 flex-fill">
                        <img src="img/menu/<?= $data["image"]; ?>" class="card-img-top" alt="alacarte beef">
                        <div class="card-body">
                            <h5 class="card-title"><?= $data["menuName"] ?></h5>
                            <p class="card-text"><?= $data["description"] ?></p>
                            <h5 class="card-title">Rp<?= number_format($data["price"], 0, ",", "."); ?></h5>
                            <a href="#" class="btn btn-primary mt-3">Order now</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function filterMenu(category) {
            const menuItems = document.querySelectorAll('.menuItem');
            menuItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                if (category === 'All Menu' || itemCategory === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
        const categories = document.querySelectorAll('.nav-link');
        categories.forEach(category => {
            category.addEventListener('click', function() {
                const categoryName = this.innerText;
                filterMenu(categoryName);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>

</body>

</html>