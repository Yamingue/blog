<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Media;
use App\Entity\TypeRevu;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('Fr-fr');
        $types= [];
        for ($i=0; $i < 4; $i++) { 
            $type = new TypeRevu();
            $type->setNom("type $i");
            $manager->persist($type);
            $manager->flush();
            $types[]= $type;
        }

        for ($i=0; $i < 10; $i++) { 
            $article = new Article();
            $media = new Media();
            $type = $types[rand(0,3)];
            $article->setType($type);
            $media->setPath('https://placebeard.it/640x360');
            $media->setType('photo');
            $article->setTitre($faker->sentence());
            $article->setContent($faker->text(500));
            $media->setArticle($article);
            $article->addMedium($media);
            $article->setMakeAt(new \DateTime());
            $manager->persist($media);
            $manager->persist($article);
            }
            $manager->flush();
        // $product = new Product();

    }
}
