<?php

namespace Mastering\SampleModule\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Mastering\SampleModule\Model\ItemRepository;
use Mastering\SampleModule\Model\ResourceModel\Item\Collection;
use Mastering\SampleModule\Model\ResourceModel\Item\CollectionFactory;

class ItemRepositoryTest extends TestCase
{
    /**
     *
     * @var ItemRepository
     */
    private $itemRepository;

    private $mockCollectionFactory;

    private $mockCollection;


    public function setUp(): void
    {
        $this->mockCollectionFactory = $this->createMock(CollectionFactory::class);
        $this->mockCollection = $this->createMock(Collection::class);
        $this->itemRepository = new ItemRepository($this->mockCollectionFactory);
    }

    public function testGetListAsArray()
    {
        $this->mockCollectionFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->mockCollection);

        $this->mockCollection
            ->method('getItems')
            ->willReturn([]);

        $this->assertEquals([], $this->itemRepository->getList());
    }
}
