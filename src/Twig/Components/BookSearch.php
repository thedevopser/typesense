<?php

namespace App\Twig\Components;

use ACSEO\TypesenseBundle\Finder\TypesenseQuery;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class BookSearch
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $search = '';

    private $bookFinder;

    public function __construct($bookFinder)
    {
        $this->bookFinder = $bookFinder;
    }

    public function getData(): array
    {
        if (empty($this->search)) {
            return [];
        }

        $query = new TypesenseQuery($this->search, 'name');

        return $this->bookFinder->rawQuery($query)->getResults();
    }
}