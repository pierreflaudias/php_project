<?php

namespace Dal\Sql;

class StatusFinderTest extends \TestCase
{
    private $status;

    public function setUp()
    {
        $this->status = $this->createMock('Model\Status');
        $this->status
            ->expects($this->once())
            ->method('getId')
            ->will($this->returnValue('1'));
    }

    public function testFindAll()
    {
        $mock = $this->createMock('\PDOStatement');
        $mock
            ->expects($this->once())
            ->method('fetchAll')
            ->will($this->returnValue([$this->status]));
        $statusFinder = new StatusFinder($mock);
        $this->assertEquals([$this->status], $statusFinder->findAll());
    }

    public function testFindOneById()
    {
        $mock = $this->createMock('\PDOStatement');
        $mock
            ->expects($this->once())
            ->method('fetch')
            ->will($this->returnValue($this->status));
        $statusFinder = new StatusFinder($mock);
        $this->assertEquals($this->status, $statusFinder->findOneById($this->status->getId()));
    }
}
