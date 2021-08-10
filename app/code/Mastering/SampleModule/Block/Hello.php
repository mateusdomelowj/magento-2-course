<?php

namespace Mastering\SampleModule\Block;

use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\View\Element\Template\Context;
use Mastering\SampleModule\Model\ResourceModel\Item\Collection;
use Mastering\SampleModule\Model\ResourceModel\Item\CollectionFactory;
use Mastering\SampleModule\Model\ConfigLog;

class Hello extends \Magento\Framework\View\Element\Template
{

    private $collectionFactory;
    // Definir o atributo eventManager que vai receber um objeto do tipo ManagerInterface;
    private $eventManager;
    private $configLog;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        ManagerInterface $eventManager,
        ConfigLog $configLog,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->eventManager = $eventManager;
        $this->configLog = $configLog;
        parent::__construct($context, $data);
    }

    /** @return \Mastering\SampleModule\Model\Item[] */
    public function getItems()
    {
        if ($this->configLog->isEnabled()) {
            $this->eventManager->dispatch('event_page');
        }
        return $this->collectionFactory->create()->getItems();
    }
}
