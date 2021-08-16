<?php

namespace Mastering\SampleModule\Test\Unit\Controller\Adminhtml\Item;

use Mastering\SampleModule\Controller\Adminhtml\Item\NewAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use PHPUnit\Framework\TestCase;

class NewActionTest extends TestCase
{

    private $newAction;
    private $contextMock;
    private $resultFactoryMock;
    private $resultInterfaceMock;

    protected function setUp(): void
    {
        $this->contextMock = $this->createMock(Context::class);
        $this->resultFactoryMock = $this->createMock(ResultFactory::class);
        $this->resultInterfaceMock = $this->createMock(ResultInterface::class);
        $this->contextMock
            ->method('getResultFactory')
            ->willReturn($this->resultFactoryMock);

        $this->resultFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->resultInterfaceMock);
        $this->newAction = new NewAction($this->contextMock);
    }

    public function testExecute()
    {
        $this->assertEquals($this->resultInterfaceMock, $this->newAction->execute());
    }
}
