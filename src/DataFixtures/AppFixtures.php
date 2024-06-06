<?php

namespace App\DataFixtures;

use App\Factory\AuthorFactory;
use App\Factory\CategoryFactory;
use App\Factory\PublisherFactory;
use App\Factory\BooksFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const BATCH_SIZE = 250;

    public function load(ObjectManager $manager): void
    {
        $this->createAuthors($manager, 500);
        $this->createCategories($manager, 50);
        $this->createPublishers($manager, 50);
        $this->createBooks($manager, 30000);
    }

    private function createAuthors(ObjectManager $manager, int $totalCount): void
    {
        for ($i = 0; $i < $totalCount; $i += self::BATCH_SIZE) {
            $batchSize = min(self::BATCH_SIZE, $totalCount - $i);
            AuthorFactory::createMany($batchSize);
            $manager->clear();
        }
    }

    private function createCategories(ObjectManager $manager, int $totalCount): void
    {
        for ($i = 0; $i < $totalCount; $i += self::BATCH_SIZE) {
            $batchSize = min(self::BATCH_SIZE, $totalCount - $i);
            CategoryFactory::createMany($batchSize);
            $manager->clear();
        }
    }

    private function createPublishers(ObjectManager $manager, int $totalCount): void
    {
        for ($i = 0; $i < $totalCount; $i += self::BATCH_SIZE) {
            $batchSize = min(self::BATCH_SIZE, $totalCount - $i);
            PublisherFactory::createMany($batchSize);
            $manager->clear();
        }
    }

    private function createBooks(ObjectManager $manager, int $totalCount): void
    {
        for ($i = 0; $i < $totalCount; $i += self::BATCH_SIZE) {
            $batchSize = min(self::BATCH_SIZE, $totalCount - $i);
            BooksFactory::createMany($batchSize);
            $manager->clear();
        }
    }
}
