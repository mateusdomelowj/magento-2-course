<?php

namespace Mastering\SampleModule\Model;

use Mastering\SampleModule\Model\ResourceModel\Item as ItemResource;

class Item extends \Magento\Framework\Model\AbstractModel
{
    /** * @codeCoverageIgnore */
    protected function _construct()
    {
        $this->_init(ItemResource::class);
    }
}
