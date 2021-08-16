<?php

namespace Mastering\SampleModule\Test\Unit\Controller\Adminhtml\Item;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
// use Magento\Framework\Model\AbstractModel;
use PHPUnit\Framework\TestCase;
use Mastering\SampleModule\Controller\Adminhtml\Item\Save;
use Mastering\SampleModule\Model\Item;
use Mastering\SampleModule\Model\ItemFactory;

class SaveTest extends TestCase
{
    private $contextMock;
    private $itemFactoryMock;
    private $itemMock;
    private $abstractModelMock;
    private $requestInterfaceMock;
    private $resultRedirectFactoryMock;
    private $resultRedirectMock;
    private $save;

    protected function setUp(): void
    {
        $this->contextMock = $this->createMock(Context::class);
        $this->itemMock = $this->getMockBuilder(Item::class)
            ->disableOriginalConstructor()
            ->setMethods(['save', 'setData'])
            ->getMock();
        // $this->abstractModelMock = $this->getMockBuilder(AbstractModel::class)
        //     ->disableOriginalConstructor()
        //     ->setMethods(['save', 'setData'])
        //     ->getMock();
        $this->itemFactoryMock = $this->createMock(ItemFactory::class);
        $this->requestInterfaceMock = $this->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPostValue'])
            ->getMockForAbstractClass();

        $this->resultRedirectFactoryMock = $this->createMock(RedirectFactory::class);
        $this->resultRedirectMock = $this->createMock(Redirect::class);

        $this->contextMock->method('getRequest')->willReturn($this->requestInterfaceMock);
        $this->contextMock->method('getResultRedirectFactory')->willReturn($this->resultRedirectFactoryMock);

        // $this->save = $this->createMock(Save::class);
        $this->save = new Save($this->contextMock, $this->itemFactoryMock);
    }

    public function testExecute()
    {
        $this->itemFactoryMock
            ->method('create')
            ->willReturn($this->itemMock);

        $this->requestInterfaceMock->expects($this->once())
            ->method('getPostValue')
            ->willReturn(['general' => 'Objeto']);

        $this->resultRedirectFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($this->resultRedirectMock);

        $this->resultRedirectMock->expects($this->once())
            ->method('setPath')
            ->with('mastering/index/index')
            ->willReturnSelf();

        $this->itemMock->expects($this->once())
            ->method('setData')
            ->with('Objeto')
            ->willReturnSelf();

        $result = $this->save->execute();
        $this->assertEquals($this->resultRedirectMock, $result);
    }
}
