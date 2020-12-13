<?php


namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends \Doctrine\Bundle\FixturesBundle\Fixture
{
    /**
     * @inheritDoc
     */

    const CATEGORIES = [
        'Action',
        'Aventure',
        'Animation',
        'Fantastique',
        'Horreur',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $catergoryName) {
            $category = new Category();
            $category->setName($catergoryName);
            $manager->persist($category);
            $this->addReference('category_' . $key, $category);
        }
            $manager->flush();
    }
}