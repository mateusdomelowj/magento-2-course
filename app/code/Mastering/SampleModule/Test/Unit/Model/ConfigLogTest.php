<?php

namespace Mastering\SampleModule\Test\Unit\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use PHPUnit\Framework\TestCase;
use Mastering\SampleModule\Model\ConfigLog;

class ConfigLogTest extends TestCase
{

    /**
     *
     * @var ConfigLog
     */
    private $config;

    private $interfaceMock;

    protected function setUp(): void
    {
        $this->interfaceMock = $this->createMock(ScopeConfigInterface::class);
        $this->config = new ConfigLog($this->interfaceMock);
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
            ->with(ConfigLog::XML_PATH_ENABLED)
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
