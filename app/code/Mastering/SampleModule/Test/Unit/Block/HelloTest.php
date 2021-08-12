<?php

namespace Mastering\SampleModule\Test\Unit\Block;

use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\View\Element\Template\Context;
use Mastering\SampleModule\Block\Hello;
use Mastering\SampleModule\Model\ConfigLog;
use Mastering\SampleModule\Model\ResourceModel\Item\Collection;
use Mastering\SampleModule\Model\ResourceModel\Item\CollectionFactory;
use PHPUnit\Framework\TestCase;

class HelloTest extends TestCase
{
    /**
     *
     * @var Hello
     */
    private $hello;
    private $mockCollectionFactory;
    private $mockEventManager;
    private $mockConfigLog;
    private $mockContext;
    private $mockCollection;
    private $data;

    public function setUp(): void
    {
        $this->mockContext = $this->createMock(Context::class);
        $this->mockCollectionFactory = $this->createMock(CollectionFactory::class);
        $this->mockCollection =  $this->createMock(Collection::class);
        $this->mockEventManager = $this->createMock(ManagerInterface::class);
        $this->mockConfigLog = $this->createMock(ConfigLog::class);

        $this->hello = new Hello(
            $this->mockContext,
            $this->mockCollectionFactory,
            $this->mockEventManager,
            $this->mockConfigLog,
            $this->data = []
        );
    }

    /**
     *
     * @dataProvider dataProvider
     */
    public function testGetItems(?bool $on, int $exactly)
    {
        $this->mockConfigLog->expects($this->once())
            ->method('isEnabled')
            ->willReturn($on);

        $this->mockEventManager->expects($this->exactly($exactly))
            ->method('dispatch')
            ->with('event_page');

        $this->mockCollectionFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->mockCollection);

        $this->mockCollection
            ->expects($this->once())
            ->method('getItems')
            ->willReturn([]);

        $this->assertEquals([], $this->hello->getItems());
    }

    /** * @codeCoverageIgnore */
    public function dataProvider(): array
    {
        return [
            'enabled' =>  [
                'On' => true,
                'exactly' => 1
            ],
            'disabled' =>  [
                'Off' => null,
                'exactly' => 0
            ]
        ];
    }
}
