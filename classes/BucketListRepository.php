
<?php

require_once __DIR__ . '/BucketItem.php';

class BucketListRepository
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Retrieves all bucket list items from the database.
     *
     * @return array
     */
    public function findAll(): array
    {
        $sql = "SELECT id, name, description, priority, created_at
                FROM bucket_items
                ORDER BY priority ASC, created_at ASC";

        $result = $this->connection->query($sql);

        $items = [];

        while ($row = $result->fetch_assoc()) {
            $items[] = new BucketItem(
                $row['name'],
                $row['description'],
                (int) $row['priority'],
                (int) $row['id'],
                new DateTime($row['created_at'])
            );
        }

        return $items;
    }

    /**
     * Retrieves a bucket list item by its ID.
     *
     * @param int $id
     * @return BucketItem|null
     */
    public function findById(int $id): ?BucketItem
    {
        $sql = "SELECT id, name, description, priority, created_at
                FROM bucket_items
                WHERE id = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();

        if (!$row) {
            return null;
        }

        return new BucketItem(
            $row['name'],
            $row['description'],
            (int) $row['priority'],
            (int) $row['id'],
            new DateTime($row['created_at'])
        );
    }

    /**
     * Saves a new bucket list item.
     *
     * @param BucketItem $item
     * @return BucketItem
     */
    public function save(BucketItem $item): BucketItem
    {
        $sql = "INSERT INTO bucket_items
                (name, description, priority)
                VALUES (?, ?, ?)";

        $stmt = $this->connection->prepare($sql);

        $name = $item->getName();
        $description = $item->getDescription();
        $priority = $item->getPriority();

        $stmt->bind_param(
            "ssi",
            $name,
            $description,
            $priority
        );

        $stmt->execute();

        $id = $this->connection->insert_id;

        $stmt->close();

        return $this->findById($id);
    }

    /**
     * Updates an existing bucket list item.
     *
     * @param BucketItem $item
     * @return bool
     */
    public function update(BucketItem $item): bool
    {
        $sql = "UPDATE bucket_items
                SET name = ?, description = ?, priority = ?
                WHERE id = ?";

        $stmt = $this->connection->prepare($sql);

        $name = $item->getName();
        $description = $item->getDescription();
        $priority = $item->getPriority();
        $id = $item->getId();

        $stmt->bind_param(
            "ssii",
            $name,
            $description,
            $priority,
            $id
        );

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    /**
     * Deletes a bucket list item by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM bucket_items WHERE id = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }
}
