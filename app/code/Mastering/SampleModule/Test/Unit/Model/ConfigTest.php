<?php

namespace Mastering\SampleModule\Test\Unit\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use PHPUnit\Framework\TestCase;
use Mastering\SampleModule\Model\Config;

class ConfigTest extends TestCase
{

    /**
     *
     * @var Config
     */
    private $config;

    private $interfaceMock;

    protected function setUp(): void
    {
        $this->interfaceMock = $this->createMock(ScopeConfigInterface::class);
        $this->config = new Config($this->interfaceMock);
    }

    /**
     * @param $status
     * @param $value
     * 
     * @dataProvider valuesProvider
     */
    public function testIsEnableIsReturningTrueOrFalse($status, $value)
    {
        $this->interfaceMock->expects($this->once())
            ->method('getValue')
            ->with(Config::XML_PATH_ENABLED)
            ->willReturn($value);

        $this->assertEquals($status, $this->config->isEnabled());
    }

    /** * @codeCoverageIgnore */
    public function valuesProvider()
    {
        return [
            'enabled' => [true, 1],
            'disabled' => [false, 0]
        ];
    }
}
