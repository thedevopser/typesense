<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    /**
     * @var Collection<int, Books>
     */
    #[ORM\OneToMany(targetEntity: Books::class, mappedBy: 'author', orphanRemoval: true)]
    private Collection $books;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->books = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Books>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
