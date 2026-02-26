<?php
namespace Hyva\PunchoutGateway\Plugin;

use Magento\Framework\View\DesignInterface;
use Punchout\Gateway\Helper\GatewayEnv as EnvHelper;

class LayoutObserverPlugin
{
    protected $design;
    protected $envHelper;

    public function __construct(
        DesignInterface $design,
        EnvHelper $envHelper
    ) {
        $this->design = $design;
        $this->envHelper = $envHelper;
    }

    public function afterExecute($subject, $result, $observer)
    {
        $theme = $this->design->getDesignTheme();
        
        if (stripos($theme->getCode(), 'hyva') === false) {
            return $result;
        }

        $action = $observer->getEvent()->getFullActionName();
        $op = $this->envHelper->getGatewayOperation();
        
        $layout = $observer->getEvent()->getLayout();
        $update = $layout->getUpdate();

        // Adding the Hyva-specific handles
        $update->addHandle('hyva_punchout_logged');
        $update->addHandle('hyva_punchout_operation_' . $op);
        $update->addHandle('hyva_' . $action . '_punchout_logged');
        $update->addHandle('hyva_' . $action . '_punchout_operation_' . $op);

        return $result;
    }
}