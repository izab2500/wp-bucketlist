
<?php

session_start();

// Load application classes
require_once __DIR__ . '/classes/BucketItem.php';
require_once __DIR__ . '/classes/bucketlist.php';
require_once __DIR__ . '/classes/database.php';
require_once __DIR__ . '/classes/bucketlistrepository.php';
require_once __DIR__ . '/classes/bucketlistservice.php';
require_once __DIR__ . '/classes/bucketlistcontroller.php';

// Create application dependencies
$database = new Database();
$repository = new BucketListRepository($database->getConnection());
$bucketList = new BucketList();

$service = new BucketListService($bucketList, $repository);
$controller = new BucketListController($service);

// CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$errors = [];
$name = '';
$description = '';
$priority = 3;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $token = $_POST['csrf_token'] ?? '';

    if (
        !is_string($token) ||
        !hash_equals($_SESSION['csrf_token'], $token)
    ) {
        $errors[] = 'Invalid request. Please refresh the page and try again.';

    } else {

        $action = $_POST['action'] ?? '';

        try {

            // Add new bucketlist item
            if ($action === 'add') {

                $name = trim($_POST['name'] ?? '');
                $description = trim($_POST['description'] ?? '');
                $priorityInput = $_POST['priority'] ?? '';

                if ($name === '') {
                    $errors[] = 'Please enter a name for your activity.';
                } elseif (mb_strlen($name) > 100) {
                    $errors[] = 'The name cannot exceed 100 characters.';
                }

                if ($description === '') {
                    $errors[] = 'Please enter a description.';
                } elseif (mb_strlen($description) > 1000) {
                    $errors[] = 'The description cannot exceed 1000 characters.';
                }

                $validPriority = filter_var(
                    $priorityInput,
                    FILTER_VALIDATE_INT
                );

                if (
                    $validPriority === false ||
                    $validPriority < 1 ||
                    $validPriority > 5
                ) {
                    $errors[] = 'Please select a valid priority.';
                } else {
                    $priority = $validPriority;
                }

                if (empty($errors)) {

                    $controller->store(
                        $name,
                        $description,
                        $priority
                    );

                    header('Location: bucketlist.php?status=added');
                    exit;
                }
            }

            // Update bucketlist item ************
elseif ($action === 'update') {

    $id = filter_var(
        $_POST['id'] ?? '',
        FILTER_VALIDATE_INT
    );

    $editName = trim($_POST['name'] ?? '');
    $editDescription = trim($_POST['description'] ?? '');

    $editPriority = filter_var(
        $_POST['priority'] ?? '',
        FILTER_VALIDATE_INT
    );

    if ($id === false || $id < 1) {
        $errors[] = 'Invalid activity ID.';
    }

    if ($editName === '') {
        $errors[] = 'Please enter an activity name.';
    } elseif (mb_strlen($editName) > 100) {
        $errors[] = 'The name cannot exceed 100 characters.';
    }

    if ($editDescription === '') {
        $errors[] = 'Please enter a description.';
    } elseif (mb_strlen($editDescription) > 1000) {
        $errors[] = 'The description cannot exceed 1000 characters.';
    }

    if (
        $editPriority === false ||
        $editPriority < 1 ||
        $editPriority > 5
    ) {
        $errors[] = 'Please select a valid priority.';
    }

    if (empty($errors)) {

        $controller->update(
            $id,
            $editName,
            $editDescription,
            $editPriority
        );

        header('Location: bucketlist.php?status=updated');
        exit;
    }
}

            // Delete bucketlist item
            elseif ($action === 'delete') {

                $id = filter_var(
                    $_POST['id'] ?? '',
                    FILTER_VALIDATE_INT
                );

                if ($id === false || $id < 1) {
                    throw new RuntimeException('Invalid item ID.');
                }

                // Load items before deleting because the service
                // checks that the item exists in the collection.
                $controller->index();

                $controller->delete($id);

                header('Location: bucketlist.php?status=deleted');
                exit;
            }

            else {
                $errors[] = 'Unknown request.';
            }

        } catch (Throwable $e) {
            error_log($e->getMessage());

            $errors[] = 'Something went wrong. Please try again.';
        }
    }
}

// Load bucketlist items
try {
    $bucketList = $controller->index();
    $items = $bucketList->getItems();

} catch (Throwable $e) {
    error_log($e->getMessage());

    $items = [];
    $errors[] = 'Could not load your bucketlist. Please check the database connection.';
}

// Sort items by priority
usort($items, function ($a, $b) {
    return $a->getPriority() <=> $b->getPriority();
});

// Priority labels
$priorityLabels = [
    1 => 'Very high',
    2 => 'High',
    3 => 'Medium',
    4 => 'Low',
    5 => 'Very low'
];

require_once __DIR__ . '/includes/header.php';

?>

<!-- PAGE HERO -->
<section class="page-hero">
    <div class="container">

        <span class="section-label">Dream it. Plan it. Do it.</span>

        <h1>My bucketlist.</h1>

        <p>
            A collection of experiences, adventures and goals
            I want to accomplish. Every dream starts somewhere.
        </p>

    </div>
</section>


<!-- BUCKETLIST SECTION -->
<section class="section">

    <div class="container">

        <div class="section-header">

            <span class="section-label">My personal collection</span>

            <h2 class="section-heading">
                Things worth experiencing.
            </h2>

            <p class="section-description">
                Add your dreams, organize them by priority
                and keep track of the things you want to achieve.
            </p>

        </div>


        <!-- SUCCESS MESSAGES -->
<?php if (isset($_GET['status']) && $_GET['status'] === 'added'): ?>

    <div class="form-success" role="status">
        Your activity has been added successfully!
    </div>

<?php elseif (isset($_GET['status']) && $_GET['status'] === 'updated'): ?>

    <div class="form-success" role="status">
        Your activity has been updated successfully!
    </div>

<?php elseif (isset($_GET['status']) && $_GET['status'] === 'deleted'): ?>

    <div class="form-success" role="status">
        Your activity has been removed successfully.
    </div>

<?php endif; ?>


        <!-- ERROR MESSAGES -->
        <?php if (!empty($errors)): ?>

            <div class="form-error" role="alert">

                <strong>Please check the following:</strong>

                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li>
                            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>

        <?php endif; ?>


        <div class="bucketlist-layout">

            <!-- ADD ITEM FORM -->
            <div class="bucket-form">

                <span class="section-label">New adventure</span>

                <h2>Add to your list.</h2>

                <p>
                    What is something you have always wanted to do?
                </p>

                <form action="bucketlist.php" method="POST">

                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>"
                    >

                    <input type="hidden" name="action" value="add">


                    <div class="form-group">

                        <label for="name">Activity name</label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="e.g. Visit Japan"
                            value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"
                            maxlength="100"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="description">Description</label>

                        <textarea
                            id="description"
                            name="description"
                            placeholder="Describe what you want to experience..."
                            maxlength="1000"
                            required
                        ><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></textarea>

                    </div>


                    <div class="form-group">

                        <label for="priority">Priority</label>

                        <select id="priority" name="priority" required>

                            <option value="">Choose priority</option>

                            <?php foreach ($priorityLabels as $value => $label): ?>

                                <option
                                    value="<?= $value ?>"
                                    <?= $priority === $value ? 'selected' : '' ?>
                                >
                                    <?= $value ?> - <?= htmlspecialchars($label) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <button type="submit" class="btn btn-primary" style="width:100%;">
                        Add to my bucketlist
                        <span aria-hidden="true">&rarr;</span>
                    </button>

                </form>

            </div>


            <!-- BUCKETLIST ITEMS -->
            <div class="bucketlist-content">

                <div class="bucketlist-heading">

                    <div>
                        <span class="section-label">My adventures</span>
                        <h2>Your list.</h2>
                    </div>

                    <span class="priority-badge">
                        <?= count($items) ?> activities
                    </span>

                </div>


                <?php if (empty($items)): ?>

                    <div class="empty-state">

                        <h3>Your journey starts here.</h3>

                        <p>
                            Your bucketlist is currently empty.
                            Add your first dream using the form.
                        </p>

                    </div>

                <?php else: ?>

                    <div class="bucket-items">

                        <?php foreach ($items as $item): ?>

                            <article class="bucket-item">

                                <div class="bucket-item-content">

                                    <span class="priority-badge">
                                        Priority <?= $item->getPriority() ?>
                                        &middot;
                                        <?= htmlspecialchars(
                                            $priorityLabels[$item->getPriority()] ?? 'Unknown'
                                        ) ?>
                                    </span>

                                    <h3>
                                        <?= htmlspecialchars(
                                            $item->getName(),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </h3>

                                    <p>
                                        <?= nl2br(htmlspecialchars(
                                            $item->getDescription(),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        )) ?>
                                    </p>

                                    <div class="bucket-meta">

                                        <span>
                                            Added:
                                            <?= htmlspecialchars(
                                                $item->getCreatedAt()->format('Y-m-d'),
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </span>

                                        <span>
                                            #<?= $item->getId() ?>
                                        </span>

                                    </div>

                                </div>

<!-- EDIT FORM ********** -->
<details class="bucket-edit">

    <summary>Edit activity</summary>

    <form action="bucketlist.php" method="POST">

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <input type="hidden" name="action" value="update">

        <input
            type="hidden"
            name="id"
            value="<?= $item->getId() ?>"
        >

        <div class="form-group">

            <label for="edit-name-<?= $item->getId() ?>">
                Activity name
            </label>

            <input
                type="text"
                id="edit-name-<?= $item->getId() ?>"
                name="name"
                value="<?= htmlspecialchars($item->getName(), ENT_QUOTES, 'UTF-8') ?>"
                maxlength="100"
                required
            >

        </div>

        <div class="form-group">

            <label for="edit-description-<?= $item->getId() ?>">
                Description
            </label>

            <textarea
                id="edit-description-<?= $item->getId() ?>"
                name="description"
                maxlength="1000"
                required
            ><?= htmlspecialchars($item->getDescription(), ENT_QUOTES, 'UTF-8') ?></textarea>

        </div>

        <div class="form-group">

            <label for="edit-priority-<?= $item->getId() ?>">
                Priority
            </label>

            <select
                id="edit-priority-<?= $item->getId() ?>"
                name="priority"
                required
            >
                <option value="" disabled>Choose priority</option>

                <?php foreach ($priorityLabels as $value => $label): ?>

                    <option
                        value="<?= $value ?>"
                        <?= $item->getPriority() === $value ? 'selected' : '' ?>
                    >
                        <?= $value ?> - <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <button type="submit" class="btn btn-primary">
            Save changes
        </button>

    </form>

</details>

                                <!-- DELETE FORM -->
                                <form
                                    action="bucketlist.php"
                                    method="POST"
                                    class="delete-form"
                                >

                                    <input
                                        type="hidden"
                                        name="csrf_token"
                                        value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>"
                                    >

                                    <input type="hidden" name="action" value="delete">

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $item->getId() ?>"
                                    >

                                    <button
                                        type="submit"
                                        class="delete-button"
                                        aria-label="Delete <?= htmlspecialchars($item->getName(), ENT_QUOTES, 'UTF-8') ?>"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </article>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</section>


<?php
require_once __DIR__ . '/includes/footer.php';
?>
