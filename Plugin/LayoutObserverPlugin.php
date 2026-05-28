<?php
namespace Hyva\PunchoutGateway\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\DesignInterface;
use Punchout\Gateway\Helper\GatewayEnv as EnvHelper;
use Punchout\Gateway\Helper\Utils as UtilsHelper;

class LayoutObserverPlugin
{
    protected const CONFIG_PATH_DETECT_HYVA = 'hyva_punchoutgateway/general/detect_hyva';

    protected const CONFIG_PATH_ADDITIONAL_THEMES = 'hyva_punchoutgateway/general/additional_themes';
    protected $scopeConfig;
    protected $design;
    protected $envHelper;
    protected $utilsHelper;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        DesignInterface $design,
        EnvHelper $envHelper,
        UtilsHelper $utilsHelper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->design = $design;
        $this->envHelper = $envHelper;
        $this->utilsHelper = $utilsHelper;
    }

    public function afterExecute($subject, $result, $observer)
    {
        $detectHyva = $this->scopeConfig->getValue(
            static::CONFIG_PATH_DETECT_HYVA, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        $additionalThemes = $this->scopeConfig->getValue(
            static::CONFIG_PATH_ADDITIONAL_THEMES, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $additionalThemes = $this->utilsHelper->parseTextareaValues($additionalThemes);

        $theme = $this->design->getDesignTheme()->getThemePath();
        
        if (!in_array($theme, $additionalThemes)) {
            if (
                !$detectHyva || ($detectHyva && stripos($theme, 'hyva') === false)
            ) {
                return $result;
            }
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