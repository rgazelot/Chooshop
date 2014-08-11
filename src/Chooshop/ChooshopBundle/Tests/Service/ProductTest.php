<?php

namespace Chooshop\ChooshopBundle\Tests\Service;

use PHPUnit_Framework_TestCase;

use Doctrine\ORM\NoResultException;

use Chooshop\ChooshopBundle\DTO\ProductTransfer,
    Chooshop\ChooshopBundle\Service\Product,
    Chooshop\ChooshopBundle\Entity\User,
    Chooshop\ChooshopBundle\Entity\Product as ProductEntity,
    Chooshop\ChooshopBundle\Entity\House;

class ProductTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $productTransfer = (new ProductTransfer)
            ->setName('foo')
            ->setPriority(1)
            ->setDescription('bar');

        $owner = new User('foo@bar.fr', 'foo', 'bar');

        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();
        $em->expects(self::once())
            ->method('persist')
            ->with(self::isInstanceOf('Chooshop\ChooshopBundle\Entity\Product'));
        $em->expects(self::once())
            ->method('flush');

        $product = (new Product($em))->create($productTransfer, $owner);

        $this->assertEquals('foo', $product->getName());
        $this->assertEquals(1, $product->getPriority());
        $this->assertEquals('bar', $product->getDescription());
        $this->assertEquals($owner, $product->getOwner());
    }

    /**
     * @expectedException Chooshop\ChooshopBundle\Exception\ProductNotFoundException
     */
    public function testGetWithoutResult()
    {
        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->setMethods(['getRepository', 'get'])
            ->getMock();
        $em->expects(self::once())
            ->method('getRepository')
            ->with('ChooshopBundle:Product')
            ->will(self::returnSelf());
        $em->expects(self::once())
            ->method('get')
            ->with(1)
            ->will(self::throwException(new NoResultException));

        (new Product($em))->get(1, new House('foo'));
    }

    public function testGet()
    {
        $product = new ProductEntity('foo', new User('foo@bar.fr', 'foo', 'bar'));

        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->setMethods(['getRepository', 'get'])
            ->getMock();
        $em->expects(self::once())
            ->method('getRepository')
            ->with('ChooshopBundle:Product')
            ->will(self::returnSelf());
        $em->expects(self::once())
            ->method('get')
            ->with(1)
            ->will(self::returnValue($product));

        $product = (new Product($em))->get(1, new House('foo'));

        $this->assertInstanceOf('Chooshop\ChooshopBundle\Entity\Product', $product);
    }

    public function testEdit()
    {
        $product = new ProductEntity('foo', new User('foo@bar.fr', 'foo', 'bar'));
        $productTransfer = (new ProductTransfer)
            ->setName('foo edited')
            ->setPriority(1)
            ->setDescription('bar edited');

        $this->assertEquals(0, $product->getPriority());
        $this->assertEquals('foo', $product->getName());
        $this->assertNull($product->getDescription());

        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();
        $em->expects(self::once())
            ->method('persist')
            ->with($product);
        $em->expects(self::once())
            ->method('flush');

        (new Product($em))->edit($product, $productTransfer);

        $this->assertEquals(1, $product->getPriority());
        $this->assertEquals('foo edited', $product->getName());
        $this->assertEquals('bar edited', $product->getDescription());
    }
}
