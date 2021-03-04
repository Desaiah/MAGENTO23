<?php

namespace Desaiah\Preorder\Model\Preorder\Source;

use Desaiah\Preorder\Model\Preorder;
use Magento\Cms\Model\Block;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class Status implements OptionSourceInterface
{
    /**
     * @var Block
     */
    protected $Preorder;

    /**
     * Constructor
     *
     * @param Preorder $Preorder
     */
    public function __construct(Preorder $Preorder)
    {
        $this->preorder = $Preorder;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->preorder->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
