
<?php

class BucketListService
{
    private BucketList $bucketList;
    private BucketListRepository $repository;

    public function __construct(
        BucketList $bucketList,
        BucketListRepository $repository
    ) {
        $this->bucketList = $bucketList;
        $this->repository = $repository;
    }

    /**
     * Loads all bucket list items from the database.
     *
     * @return BucketList
     * @throws RuntimeException
     */
    public function loadBucketList(): BucketList
    {
        try {
            $items = $this->repository->findAll();

            $this->bucketList = new BucketList();

            foreach ($items as $item) {
                $this->bucketList->addItem($item);
            }

            return $this->bucketList;

        } catch (Throwable $e) {
            throw new RuntimeException(
                "Failed to load bucket list.",
                0,
                $e
            );
        }
    }

    /**
     * Adds a new item to the bucket list.
     *
     * @param BucketItem $item
     * @return void
     * @throws RuntimeException
     */
    public function addItem(BucketItem $item): void
    {
        try {
            $savedItem = $this->repository->save($item);

            if (!$savedItem instanceof BucketItem) {
                throw new RuntimeException(
                    "Failed to save bucket list item."
                );
            }

            $this->bucketList->addItem($savedItem);

        } catch (Throwable $e) {
            throw new RuntimeException(
                "Could not add bucket list item.",
                0,
                $e
            );
        }
    }

    /**
     * Updates an existing bucket list item.
     *
     * @param BucketItem $item
     * @return void
     * @throws RuntimeException
     */
    public function updateItem(BucketItem $item): void
    {
        try {
            $this->bucketList->getItemById($item->getId());

            if (!$this->repository->update($item)) {
                throw new RuntimeException(
                    "Failed to update bucket list item."
                );
            }

        } catch (Throwable $e) {
            throw new RuntimeException(
                "Could not update bucket list item.",
                0,
                $e
            );
        }
    }

    /**
     * Deletes a bucket list item by its ID.
     *
     * @param int $id
     * @return void
     * @throws RuntimeException
     */
    public function deleteItem(int $id): void
    {
        try {
            $this->bucketList->getItemById($id);

            if (!$this->repository->delete($id)) {
                throw new RuntimeException(
                    "Failed to delete bucket list item."
                );
            }

            $this->bucketList->removeItem($id);

        } catch (Throwable $e) {
            throw new RuntimeException(
                "Could not delete bucket list item.",
                0,
                $e
            );
        }
    }
}
