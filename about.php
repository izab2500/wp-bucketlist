
<?php
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
    <div class="container">

        <span class="section-label">About the project</span>

        <h1>Behind the bucketlist.</h1>

        <p>
            A closer look at the idea, technology and development
            behind this personal web application.
        </p>

    </div>
</section>


<!-- PROJECT INTRODUCTION -->
<section class="content-section">
    <div class="container">

        <div class="content-layout">

            <div class="content-text">

                <span class="section-label">The idea</span>

                <h2 class="section-heading">
                    More than just a list.
                </h2>

                <p>
                    This project is a personal bucketlist application
                    developed as part of a web development assignment.
                    The idea is to create a place where goals, dreams
                    and experiences can be collected and organized.
                </p>

                <p>
                    Users can add new activities, write descriptions,
                    assign priorities and remove activities when they
                    are no longer relevant.
                </p>

                <p>
                    All information is stored in a MySQL database,
                    which means that the bucketlist remains available
                    even after leaving the website.
                </p>

                <p>
                    Beyond its personal purpose, the application
                    demonstrates how PHP can be used to build
                    dynamic websites connected to a database.
                </p>

            </div>

            <div>
                <img
                    src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1000&q=85"
                    alt="Mountain landscape representing adventure and personal goals"
                    class="content-image"
                    loading="lazy"
                >
            </div>

        </div>

    </div>
</section>


<!-- DEVELOPMENT -->
<section class="section section-dark">
    <div class="container">

        <div class="section-header">
            <span class="section-label">Development process</span>

            <h2 class="section-heading">
                Built with structure and purpose.
            </h2>

            <p class="section-description">
                The application is developed using several technologies
                that work together to create a functional web application.
            </p>
        </div>

        <div class="card-grid">

            <article class="card">
                <div class="card-icon">01</div>

                <h3>Object-oriented PHP</h3>

                <p>
                    PHP classes are used to separate responsibilities
                    and organize the application into manageable parts.
                </p>
            </article>

            <article class="card">
                <div class="card-icon">02</div>

                <h3>MySQL database</h3>

                <p>
                    A relational database stores bucketlist items,
                    including their names, descriptions, priorities
                    and creation dates.
                </p>
            </article>

            <article class="card">
                <div class="card-icon">03</div>

                <h3>Responsive frontend</h3>

                <p>
                    HTML, CSS and JavaScript provide the interface,
                    responsive layout and interactive elements.
                </p>
            </article>

        </div>

    </div>
</section>


<!-- APPLICATION STRUCTURE -->
<section class="section">
    <div class="container">

        <div class="section-header">
            <span class="section-label">Application architecture</span>

            <h2 class="section-heading">
                A clear and maintainable structure.
            </h2>

            <p class="section-description">
                The project uses a structured file organization
                to separate database operations, business logic
                and presentation.
            </p>
        </div>

        <div class="content-layout">

            <div class="content-text">

                <h3>Classes and responsibilities</h3>

                <p>
                    The application uses several PHP classes to
                    organize its functionality.
                </p>

                <p>
                    <strong>BucketItem</strong> represents an individual
                    bucketlist item, while <strong>BucketList</strong>
                    manages the collection of items.
                </p>

                <p>
                    <strong>BucketListRepository</strong> handles
                    communication with the database.
                    <strong>BucketListService</strong> manages the
                    application logic, and
                    <strong>BucketListController</strong> handles
                    the operations requested by the application.
                </p>

                <p>
                    The <strong>Database</strong> class manages
                    the MySQL connection using MySQLi.
                </p>

            </div>

            <div class="content-text">

                <h3>Database operations</h3>

                <p>
                    The application uses SQL to communicate with
                    the database and manage bucketlist information.
                </p>

                <p>
                    <strong>SELECT</strong> retrieves saved activities.
                </p>

                <p>
                    <strong>INSERT</strong> adds new activities.
                </p>

                <p>
                    <strong>UPDATE</strong> modifies existing activities.
                </p>

                <p>
                    <strong>DELETE</strong> removes activities.
                </p>

                <p>
                    Prepared statements are used when handling
                    user input in database queries.
                </p>

            </div>

        </div>

    </div>
</section>


<!-- TECHNOLOGY OVERVIEW -->
<section class="section section-dark">
    <div class="container">

        <div class="section-header">
            <span class="section-label">Technologies</span>

            <h2 class="section-heading">
                The tools behind the application.
            </h2>
        </div>

        <div class="card-grid">

            <article class="card">
                <h3>PHP</h3>
                <p>
                    Handles server-side logic, form processing
                    and communication between application layers.
                </p>
            </article>

            <article class="card">
                <h3>MySQL & MySQLi</h3>
                <p>
                    Stores information and provides a connection
                    between PHP and the relational database.
                </p>
            </article>

            <article class="card">
                <h3>Git & GitHub</h3>
                <p>
                    Version control makes it possible to track
                    changes, manage development and maintain
                    the project over time.
                </p>
            </article>

        </div>

    </div>
</section>


<!-- PROJECT GOAL -->
<section class="section">
    <div class="container text-center">

        <span class="section-label">The bigger picture</span>

        <h2 class="section-heading" style="margin-left:auto;margin-right:auto;">
            Learning by building.
        </h2>

        <p class="section-description" style="margin:0 auto 2rem;">
            The main goal of this project is not only to create
            a working bucketlist, but also to understand how
            different parts of a web application work together.
        </p>

        <a href="bucketlist.php" class="btn btn-primary">
            Explore the bucketlist
            <span aria-hidden="true">&rarr;</span>
        </a>

    </div>
</section>


<?php
require_once __DIR__ . '/includes/footer.php';
?>
