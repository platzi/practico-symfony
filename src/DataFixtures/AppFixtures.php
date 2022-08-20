<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\CommentFactory;
use App\Factory\PostFactory;
use App\Factory\UserFactory;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'roles' => ['ROLE_ADMIN']
        ]);

        UserFactory::createOne([
            'name' => 'User',
            'email' => 'user@app.com'
        ]);

        UserFactory::createMany(8);

        CategoryFactory::createMany(8);

        PostFactory::createMany(40, function () {
            return [
                'comments' => CommentFactory::new()->many(0, 8),
                'category' => CategoryFactory::random(),
                'user'     => UserFactory::random(),
            ];
        });
    }
}
