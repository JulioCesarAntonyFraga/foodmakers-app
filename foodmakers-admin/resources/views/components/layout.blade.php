<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/index.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/food-makers-high-resolution-logo-transparent.png">
    <title>Food Makers</title>
</head>
<body>
    <div class="nav">
        <div id="nav-logo">
            <a href="/product-list">
                <img src="/food-makers-high-resolution-logo-transparent.png" alt="Logo Food Makers">
            </a>
        </div>
        <div id="nav-actions">
            @auth
            <a href="/product-list">
                Produtos
            </a>
            <a href="/logout">
                Logout
            </a>
            @else

            @endauth
        </div>
    </div>
    <div class="main">
        {{ $slot }}
    </div>
</body>
</html>
