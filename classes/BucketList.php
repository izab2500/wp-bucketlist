
<?php

class BucketList
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function addItem(BucketItem $item): void
    {
        $this->items[] = $item;
    }

    public function removeItem(int $id): void
    {
        foreach ($this->items as $index => $item) {
            if ($item->getId() === $id) {
                unset($this->items[$index]);
                $this->items = array_values($this->items);
                return;
            }
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getItemById(int $id): BucketItem
    {
        foreach ($this->items as $item) {
            if ($item->getId() === $id) {
                return $item;
            }
        }

        throw new RuntimeException("Bucket item not found.");
    }
}
