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

        $searchRequest = [
            (new TypesenseQuery($this->search))->addParameter('collection', 'author'),
            (new TypesenseQuery($this->search))->addParameter('collection', 'publisher'),
            (new TypesenseQuery($this->search))->addParameter('collection', 'books'),
        ];

        $commonParams = new TypesenseQuery($this->search, 'name');

        $results = $this->bookFinder->multisearch($searchRequest, $commonParams);

        return $results;
    }
}