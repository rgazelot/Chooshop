<?php

namespace Chooshop\ChooshopBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;

use Chooshop\ChooshopBundle\Entity\House,
    Chooshop\ChooshopBundle\Entity\Product,
    Chooshop\ChooshopBundle\Entity\User;

class LoadPeterData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $peter = (new User('peter@chooshop.com', 'peter', 'behat'))
            ->setToken('peterToken');

        $house = (new House('peter'))
            ->addPeople($peter);

        $manager->persist($house);

        // id 13
        $manager->persist((new Product('A peter product', $peter)));

        $manager->flush();
    }
}
