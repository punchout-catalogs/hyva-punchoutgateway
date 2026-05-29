<?php

namespace Hyva\PunchoutGateway\Block\Adminhtml\System\Config\Form\Field;

use Magento\Framework\Data\Form\Element\AbstractElement;

class Version extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * @var \Magento\Framework\Module\ResourceInterface
     */
    protected $moduleResource;
    
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Module\ResourceInterface $moduleResource
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Module\ResourceInterface $moduleResource,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->moduleResource = $moduleResource;
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->moduleResource->getDbVersion('Hyva_PunchoutGateway');
    }
}
