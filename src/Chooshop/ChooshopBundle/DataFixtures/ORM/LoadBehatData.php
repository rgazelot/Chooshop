<?php

namespace Chooshop\ChooshopBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;

use Chooshop\ChooshopBundle\Entity\House,
    Chooshop\ChooshopBundle\Entity\Product,
    Chooshop\ChooshopBundle\Entity\User;

class LoadBehatData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $behat = (new User('behat@chooshop.com', 'mister', 'behat'))
            ->setToken('myBehatToken');

        $thomas = (new User('thomas.behat@chooshop.com', 'thomas', 'behat'))
            ->setToken('thomasBehatToken');

        $house = (new House('behat'))
            ->addPeople($behat)
            ->addPeople($thomas);

        $manager->persist($house);

        // Behat products
        // id 1
        $manager->persist((new Product('to be deleted', $behat)));
        // id 2
        $manager->persist((new Product('to be edited', $behat)));

        // Thomas products
        // id 3 => 12
        for($i = 0; $i < 10; $i++) {
            $manager->persist($this->createProduct($i, $thomas));
        }

        $manager->flush();
    }

    private function createProduct($index, User $user)
    {
        return (new Product(
            'product ' . $index,
            $user,
            3 < $index ? 0 : $index,
            'This is the product ' . $index
        ));
    }
}
