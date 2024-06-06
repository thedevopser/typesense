<?php

namespace App\Factory;

use App\Entity\Books;
use App\Repository\BooksRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Books>
 *
 * @method        Books|Proxy                     create(array|callable $attributes = [])
 * @method static Books|Proxy                     createOne(array $attributes = [])
 * @method static Books|Proxy                     find(object|array|mixed $criteria)
 * @method static Books|Proxy                     findOrCreate(array $attributes)
 * @method static Books|Proxy                     first(string $sortedField = 'id')
 * @method static Books|Proxy                     last(string $sortedField = 'id')
 * @method static Books|Proxy                     random(array $attributes = [])
 * @method static Books|Proxy                     randomOrCreate(array $attributes = [])
 * @method static BooksRepository|RepositoryProxy repository()
 * @method static Books[]|Proxy[]                 all()
 * @method static Books[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Books[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Books[]|Proxy[]                 findBy(array $attributes)
 * @method static Books[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Books[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class BooksFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->sentence,
            'publishedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTimeBetween('-30 years', 'now')),
            'author' => AuthorFactory::random(),
            'publisher' => PublisherFactory::random(),
        ];
    }

    protected static function getClass(): string
    {
        return Books::class;
    }

    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function(Books $book): void {
                $categories = CategoryFactory::randomRange(1, 3);
                foreach ($categories as $category) {
                    $book->addCategory($category->object());
                }
            })
            ;
    }
}
