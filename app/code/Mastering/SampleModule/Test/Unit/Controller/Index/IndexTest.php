<?php

namespace Mastering\SampleModule\Test\Unit\Controller\Index;

use Magento\Backend\Model\View\Result\Page as ResultPage;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use PHPUnit\Framework\TestCase;
use Mastering\SampleModule\Controller\Index\Index;

class IndexTest extends TestCase
{
    private $pageFactoryMock;
    private $pageMock;
    private $index;
    private $context;

    protected function setUp(): void
    {
        $this->pageFactoryMock = $this->createMock(PageFactory::class);
        $this->pageMock = $this->createMock(Page::class);
        $this->context = $this->createMock(Context::class);
        $this->index = new Index($this->context, $this->pageFactoryMock);
    }

    public function testExecute()
    {
        $this->pageFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->pageMock);

        $this->assertEquals($this->pageMock, $this->index->execute());
    }
}
