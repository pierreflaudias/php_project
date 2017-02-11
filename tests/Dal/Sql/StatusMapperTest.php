<?php

namespace Dal\Sql;

class StatusMapperTest extends \TestCase
{
    private $status;

    public function setUp()
    {
        $this->status = $this->createMock('Model\Status');
    }

    public function testPersist()
    {
        $mock = $this->createMock('Dal\Sql\MockConnection');
        $mock
            ->expects($this->once())
            ->method('lastInsertId')
            ->will($this->returnValue('1'));
        $statusMapper = new StatusMapper($mock);
        $this->assertEquals('1', $statusMapper->persist($this->status));
    }

    public function testRemove()
    {
        $mock = $this->createMock('Dal\Sql\MockConnection');
        $mock
            ->expects($this->once())
            ->method('executeQuery')
            ->will($this->returnValue('1'));
        $statusMapper = new StatusMapper($mock);
        $this->assertEquals('1', $statusMapper->remove($this->status));
    }
}