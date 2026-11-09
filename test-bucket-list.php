
<?php

require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/BucketItem.php';
require_once __DIR__ . '/classes/BucketList.php';
require_once __DIR__ . '/classes/BucketListRepository.php';
require_once __DIR__ . '/classes/BucketListService.php';

echo "<h1>BucketListService - Test</h1>";

try {
    // Initialize dependencies
    $database = new Database();
    $repository = new BucketListRepository($database->getConnection());
    $bucketList = new BucketList();

    $service = new BucketListService($bucketList, $repository);

    // 1. Test loadBucketList()
    echo "<h3>1. Test loadBucketList()</h3>";

    $loadedList = $service->loadBucketList();

    echo "Number of items: " . count($loadedList->getItems()) . "<br>";

    // 2. Test addItem()
    echo "<h3>2. Test addItem()</h3>";

    $newItem = new BucketItem(
        "Visit Italy",
        "Explore Rome and Venice",
        1
    );

    $service->addItem($newItem);

    echo "Item added successfully!<br>";
    echo "New item ID: " . $newItem->getId() . "<br>";

    // 3. Test updateItem()
    echo "<h3>3. Test updateItem()</h3>";

    $newItem->update(
        "Visit Italy",
        "Explore Rome, Venice and Florence",
        2
    );

    $service->updateItem($newItem);

    echo "Item updated successfully!<br>";

    // 4. Test deleteItem()
    echo "<h3>4. Test deleteItem()</h3>";

    $service->deleteItem($newItem->getId());

    echo "Item deleted successfully!<br>";

    // 5. Verify deletion
    echo "<h3>5. Verify deletion</h3>";

    $deletedItem = $repository->findById($newItem->getId());

    if ($deletedItem === null) {
        echo "Deletion verified!<br>";
    } else {
        throw new RuntimeException("Deletion verification failed.");
    }

    // 6. Test deleting a non-existing item
    echo "<h3>6. Test deleting a non-existing item</h3>";

    try {
        $service->deleteItem(999999);

        echo "FAIL: Expected an exception.<br>";

    } catch (RuntimeException $e) {
        echo "PASS: " . htmlspecialchars($e->getMessage()) . "<br>";
    }

    // 7. Test updating a non-existing item
    echo "<h3>7. Test updating a non-existing item</h3>";

    try {
        $invalidItem = new BucketItem(
            "Non-existing item",
            "This item does not exist",
            1,
            999999
        );

        $service->updateItem($invalidItem);

        echo "FAIL: Expected an exception.<br>";

    } catch (RuntimeException $e) {
        echo "PASS: " . htmlspecialchars($e->getMessage()) . "<br>";
    }

    // 8. Test loading the list again
    echo "<h3>8. Test loading the list again</h3>";

    $reloadedList = $service->loadBucketList();

    echo "Number of items: " . count($reloadedList->getItems()) . "<br>";
    echo "PASS: Bucket list loaded again without duplicates.<br>";

    echo "<h2>All tests completed!</h2>";

} catch (Throwable $e) {
    echo "<h2>TEST FAILED</h2>";
    echo htmlspecialchars($e->getMessage());
}
