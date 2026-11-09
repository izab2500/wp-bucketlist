
<?php
$currentPage = basename($_SERVER['PHP_SELF']);

$navigation = [
    'index.php' => 'Home',
    'about.php' => 'About',
    'bucketlist.php' => 'Bucketlist',
    'ai.php' => 'AI & Development'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="A personal bucket list project built with object-oriented PHP and MySQL.">

    <title>
        <?php
        $pageTitles = [
            'index.php' => 'Home',
            'about.php' => 'About',
            'bucketlist.php' => 'My Bucketlist',
            'ai.php' => 'AI & Development'
        ];

        echo htmlspecialchars($pageTitles[$currentPage] ?? 'Bucketlist');
        ?> | Bucketlist
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

    <script src="assets/js/main.js" defer></script>
</head>

<body id=top>

<header class="site-header">
    <div class="container header-container">

        <a href="index.php" class="site-logo" aria-label="Bucketlist home">
            <span class="logo-mark">B</span>
            <span class="logo-text">bucket<span>list.</span></span>
        </a>

        <button
            class="menu-toggle"
            id="menuToggle"
            aria-label="Open navigation menu"
            aria-expanded="false"
            aria-controls="mainNavigation"
            type="button"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="main-navigation" id="mainNavigation" aria-label="Main navigation">

            <?php foreach ($navigation as $url => $label): ?>

                <a
                    href="<?= htmlspecialchars($url) ?>"
                    class="nav-link <?= $currentPage === $url ? 'active' : '' ?>"
                    <?= $currentPage === $url ? 'aria-current="page"' : '' ?>
                >
                    <?= htmlspecialchars($label) ?>
                </a>

            <?php endforeach; ?>

            <a href="bucketlist.php" class="nav-cta">
                Explore my list
                <span aria-hidden="true">&rarr;</span>
            </a>

        </nav>

    </div>
</header>

<main class="site-main">
