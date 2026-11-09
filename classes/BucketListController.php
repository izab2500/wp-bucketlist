
<?php

class BucketListController
{
    private BucketListService $service;

    public function __construct(BucketListService $service)
    {
        $this->service = $service;
    }

    public function index(): BucketList
    {
        return $this->service->loadBucketList();
    }

    public function store(
        string $name,
        string $description,
        int $priority
    ): void {
        try {
            $item = new BucketItem(
                $name,
                $description,
                $priority
            );

            $this->service->addItem($item);

        } catch (Throwable $e) {
            throw new RuntimeException(
                "Could not create bucket list item.",
                0,
                $e
            );
        }
    }

    public function update(
        int $id,
        string $name,
        string $description,
        int $priority
    ): void {
        try {
            $bucketList = $this->service->loadBucketList();

            $item = $bucketList->getItemById($id);

            $item->update(
                $name,
                $description,
                $priority
            );

            $this->service->updateItem($item);

        } catch (Throwable $e) {
            throw new RuntimeException(
                "Could not update bucket list item.",
                0,
                $e
            );
        }
    }

    public function delete(int $id): void
    {
        $this->service->deleteItem($id);
    }
}
