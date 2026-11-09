
<?php
require_once __DIR__ . '/includes/header.php';
?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="container">
        <div class="hero-content">

            <span class="section-label">A personal journey</span>

            <h1>
                Life is short.<br>
                Make it <span>meaningful.</span>
            </h1>

            <p class="hero-description">
                A collection of dreams, goals and experiences I want
                to accomplish. Because life is about creating memories,
                exploring possibilities and making every moment count.
            </p>

            <div class="hero-actions">
                <a href="bucketlist.php" class="btn btn-primary">
                    Explore my bucketlist
                    <span aria-hidden="true">&rarr;</span>
                </a>

                <a href="about.php" class="btn btn-outline">
                    Discover the project
                </a>
            </div>

        </div>
    </div>

    <div class="hero-decoration" aria-hidden="true"></div>
</section>


<!-- INTRODUCTION -->
<section class="section">
    <div class="container">

        <div class="section-header">
            <span class="section-label">The project</span>

            <h2 class="section-heading">
                Dreams are meant to be pursued.
            </h2>

            <p class="section-description">
                This website is developed as part of a PHP assignment.
                It combines web development, database management and
                personal goals in one application.
            </p>
        </div>

        <div class="card-grid">

            <article class="card">
                <div class="card-icon" aria-hidden="true">
                    &#10022;
                </div>

                <h3>Personal goals</h3>

                <p>
                    Create a personal bucketlist with experiences,
                    adventures and goals that are worth pursuing.
                </p>
            </article>

            <article class="card">
                <div class="card-icon" aria-hidden="true">
                    &#9881;
                </div>

                <h3>Web development</h3>

                <p>
                    Explore object-oriented PHP, MySQL, HTML, CSS
                    and JavaScript through a practical project.
                </p>
            </article>

            <article class="card">
                <div class="card-icon" aria-hidden="true">
                    &#8599;
                </div>

                <h3>Continuous learning</h3>

                <p>
                    Develop programming skills, understand application
                    architecture and learn through practical experience.
                </p>
            </article>

        </div>

    </div>
</section>


<!-- PHP REFLECTION -->
<section class="section section-dark">
    <div class="container">

        <div class="content-layout">

            <div class="content-text">
                <span class="section-label">My reflections</span>

                <h2 class="section-heading">
                    Learning PHP through practice.
                </h2>

                <p>
                    PHP has been an interesting language to work with.
                    One thing I appreciate is how easily it integrates
                    with HTML and how quickly it allows you to build
                    dynamic websites.
                </p>

                <p>
                    I also like that PHP supports object-oriented
                    programming. By separating the application into
                    classes, repositories, services and controllers,
                    the code becomes easier to understand and maintain.
                </p>

                <p>
                    Another advantage is its integration with MySQL.
                    Connecting a database, retrieving information and
                    processing form submissions makes it possible to
                    create applications that store and manage real data.
                </p>

            </div>

            <div class="content-text">

                <span class="section-label">Advantages & challenges</span>

                <h2 class="section-heading">
                    What I have learned.
                </h2>

                <p>
                    Compared with JavaScript, which I have also worked
                    with, PHP handles server-side operations in a
                    straightforward way. JavaScript is particularly
                    useful for interactive features in the browser,
                    while PHP is responsible for processing requests
                    and communicating with the database.
                </p>

                <p>
                    One challenge with PHP is keeping the application
                    organized. Without a clear file structure, it can
                    quickly become difficult to maintain.
                </p>

                <p>
                    Overall, I think PHP is a useful language for
                    developing dynamic websites, especially when
                    combined with MySQL and object-oriented programming.
                </p>

            </div>

        </div>

    </div>
</section>


<!-- TECHNOLOGIES -->
<section class="section">
    <div class="container">

        <div class="section-header text-center">
            <span class="section-label">Under the hood</span>

            <h2 class="section-heading" style="margin-left:auto;margin-right:auto;">
                Built with modern web technologies.
            </h2>

            <p class="section-description" style="margin-left:auto;margin-right:auto;">
                The project combines several technologies to create
                a structured, responsive and database-driven application.
            </p>
        </div>

        <div class="card-grid">

            <article class="card">
                <div class="card-icon">P</div>
                <h3>PHP</h3>
                <p>
                    Server-side programming and object-oriented
                    application architecture.
                </p>
            </article>

            <article class="card">
                <div class="card-icon">DB</div>
                <h3>MySQL</h3>
                <p>
                    Database storage, SQL queries and persistent
                    bucketlist information.
                </p>
            </article>

            <article class="card">
                <div class="card-icon">UI</div>
                <h3>HTML, CSS & JS</h3>
                <p>
                    Responsive layouts, visual design and interactive
                    browser functionality.
                </p>
            </article>

        </div>

    </div>
</section>


<!-- FINAL CTA -->
<section class="section section-dark">
    <div class="container text-center">

        <span class="section-label">Start exploring</span>

        <h2 class="section-heading" style="margin-left:auto;margin-right:auto;">
            Every great adventure starts with a dream.
        </h2>

        <p class="section-description" style="margin:0 auto 2rem;">
            Take a look at the things I want to experience,
            accomplish and remember.
        </p>

        <a href="bucketlist.php" class="btn btn-primary">
            View my bucketlist
            <span aria-hidden="true">&rarr;</span>
        </a>

    </div>
</section>


<?php
require_once __DIR__ . '/includes/footer.php';
?>
