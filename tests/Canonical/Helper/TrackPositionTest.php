<?php

namespace Kompakt\B3d\Tests\Canonical\Helper;

use Kompakt\B3d\Canonical\Entity\Product;
use Kompakt\B3d\Canonical\Entity\Track;
use Kompakt\B3d\Canonical\Helper\TrackPosition;

class TrackPositionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPosition()
    {
        $product = new Product();

        $track11 = new Track();
        $track11->setSetNo(1);
        $track11->setSeqNo(1);
        $product->addTrack($track11);

        $track12 = new Track();
        $track12->setSetNo(1);
        $track12->setSeqNo(2);
        $product->addTrack($track12);

        $track13 = new Track();
        $track13->setSetNo(1);
        $track13->setSeqNo(3);
        $product->addTrack($track13);

        $track21 = new Track();
        $track21->setSetNo(2);
        $track21->setSeqNo(1);
        $product->addTrack($track21);

        $track22 = new Track();
        $track22->setSetNo(2);
        $track22->setSeqNo(2);
        $product->addTrack($track22);

        $track23 = new Track();
        $track23->setSetNo(2);
        $track23->setSeqNo(3);
        $product->addTrack($track23);

        // sequence 3 is missing

        $track41 = new Track();
        $track41->setSetNo(4);
        $track41->setSeqNo(1);
        $product->addTrack($track41);

        $track42 = new Track();
        $track42->setSetNo(4);
        $track42->setSeqNo(2);
        $product->addTrack($track42);

        $track43 = new Track();
        $track43->setSetNo(4);
        $track43->setSeqNo(3);
        $product->addTrack($track43);

        $position = new TrackPosition($product);
        $this->assertEquals(1, $position->getPosition($track11));
        $this->assertEquals(2, $position->getPosition($track12));
        $this->assertEquals(3, $position->getPosition($track13));
        $this->assertEquals(4, $position->getPosition($track21));
        $this->assertEquals(5, $position->getPosition($track22));
        $this->assertEquals(6, $position->getPosition($track23));
        $this->assertEquals(7, $position->getPosition($track41));
        $this->assertEquals(8, $position->getPosition($track42));
        $this->assertEquals(9, $position->getPosition($track43));
    }

    public function testMissingSetNoAndSeqNo()
    {
        $product = new Product();

        $track11 = new Track();
        $product->addTrack($track11);

        $track12 = new Track();
        $track12->setSetNo(1);
        $track12->setSeqNo(2);
        $product->addTrack($track12);

        $position = new TrackPosition($product);
        $this->assertEquals(1, $position->getPosition($track11));
        $this->assertEquals(1, $position->getPosition($track12));
    }
}