<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Basic PHP Project</title>
    <link rel="stylesheet" href="../../assets/styles.css"/>
</head>
<body class="wrapper">
<!-- Header -->
<header>
    <div class="header container">
        <div class="logo">
            <a href="/" class="logo">My CMS</a>
        </div>
        <nav>
            <ul>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
                <?php if ($_SESSION['user']) : ?>
                    <li>
                        <?= $_SESSION['user']['username'] ?>
                    </li>
                    <li><a href="/logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<!-- Main Content -->
<main class="main">
    <div class="container">