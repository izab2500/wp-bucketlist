
<?php

class BucketItem
{
    private int $id;
    private string $name;
    private string $description;
    private int $priority;
    private DateTime $createdAt;

    public function __construct(
        string $name,
        string $description,
        int $priority
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->priority = $priority;
        $this->createdAt = new DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function update(
        string $name,
        string $description,
        int $priority
    ): void {
        $this->name = $name;
        $this->description = $description;
        $this->priority = $priority;
    }
}
