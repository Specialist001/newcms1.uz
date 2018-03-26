<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Админ-панель</title>

    <!-- Bootstrap core CSS -->
    <link href="/admin/Assets/semantic/semantic.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/Assets/semantic/components/dropdown.min.css">
    <link rel="stylesheet" href="/admin/Assets/semantic/components/transition.min.css">
    <link rel="stylesheet" href="/admin/Assets/semantic/components/icon.min.css">
    <link rel="stylesheet" href="/admin/Assets/semantic/components/segment.min.css">
    <link rel="stylesheet" href="/admin/Assets/semantic/components/sidebar.min.css">

    <!-- Custom styles for this template -->
    <link href="/admin/Assets/css/dashboard.css" rel="stylesheet">

    <!-- simplelineicons for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">

    <!-- Redactor CSS -->
    <link rel="stylesheet" href="/admin/Assets/js/plugins/redactor/redactor.css">
</head>

<body>

<header>
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> <!--
            <a class="navbar-brand" href="#">Admin CMS</a>
            <?php foreach (Customize::getInstance()->getAdminMenuItems() as $key => $item): ?>
                <a class="item" href="<?= $item['urlPath'] ?>">
                    <i class="<?= $item['classIcon'] ?>"></i>
                    <?= $lang->dashboardMenu[$key] ?>
                </a>
            <?php endforeach; ?>  -->
    <!--        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin/">
                            <i class="icon-speedometer icons"></i>
                            <?= $lang->dashboardMenu['home'] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/pages/">
                            <i class="icon-doc icons"></i>
                            <?= $lang->dashboardMenu['pages'] ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/posts/">
                            <i class="icon-pencil icons"></i>
                            <?= $lang->dashboardMenu['posts'] ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/admin/settings/general/">
                            <i class="icon-equalizer icons"></i>
                            <?= $lang->dashboardMenu['settings'] ?>
                        </a>
                    </li>
                </ul>
            </div>  -->

            <div class="ui borderless main menu top-header">
                <div class="ui container">
                    <div href="/admin/" class="header item logo-item">
                        <img class="logo" src="/admin/Assets/images/logo.png">
                    </div>
                    <a href="/admin/" class="item">
                        <i class="icon-speedometer icons"></i>
                        <?= $lang->dashboardMenu['home'] ?>
                        </a>
                    <a href="/admin/pages/" class="item">
                        <i class="icon-doc icons"></i>
                        <?= $lang->dashboardMenu['pages'] ?>
                        </a>
                    <a href="/admin/posts/" class="item">
                        <i class="icon-pencil icons"></i>
                        <?= $lang->dashboardMenu['posts'] ?>
                        </a>
                    <a href="/admin/settings/general/" class="item">
                        <i class="icon-equalizer icons"></i>
                        <?= $lang->dashboardMenu['settings'] ?>
                        </a>
                    <a href="/admin/logout/" class="ui right floated item" tabindex="0">
                        <i class="icon-logout icons"></i> Logout
                        </a>
            </div>

            <div class="right-toolbar">
                <a href="/admin/logout/">
                    <i class="icon-logout icons"></i> Logout
                </a>
            </div>
        </div>
    </nav>
</header>