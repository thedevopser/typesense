<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BooksRepository::class)]
class Books
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column]
    private \DateTimeImmutable $publishedAt;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private Author $author;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'books')]
    private Collection $category;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private Publisher $publisher;

    public function __construct(string $name, \DateTimeImmutable $publishedAt, Author $author, Publisher $publisher)
    {
        $this->name = $name;
        $this->publishedAt = $publishedAt;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->category = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function getPublishedAt(): \DateTimeImmutable
    {
        return $this->publishedAt;
    }


    public function getAuthor(): Author
    {
        return $this->author;
    }


    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function getPublisher(): Publisher
    {
        return $this->publisher;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
