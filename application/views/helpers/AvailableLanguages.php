<?php
/**
 * PHP Class AvailableLanguages.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_AvailableLanguages
    extends Zend_View_Helper_Abstract
{
    /**
     *
     */
    public function availableLanguages()
    {

        $currentLanguage = Llv_Context_Application::getInstance()->getCurrentLocale()->toString();
        $flags[] = '<ul class="languages">' . PHP_EOL;
        $count = 0;
        foreach (Llv_Config::getInstance()->sites->toArray() as $site) {
            if ($site['front'] && $site['locale'] != $currentLanguage) {
                $count += 1;
                $flags[] = '<li class="' . htmlspecialchars($site['locale']) . ' ' .
                    ($site['locale'] == $currentLanguage ? 'current' : '') . '">' . PHP_EOL;
                $flags[] = '<a href="http://' . $site['host'] . '/' . $this->getCurrentPage() . '">';
                $flags[] = htmlspecialchars($site['locale']);
                $flags[] = '</a>' . PHP_EOL;
                $flags[] = '</li>' . PHP_EOL;
            }
        }
        $flags[] = '</ul>' . PHP_EOL;
        if ($count > 1) {
            echo implode(PHP_EOL, $flags);

        }
    }

    /**
     * @return string
     */
    private function getCurrentPage()
    {
        $result = array();
        $allParams = Zend_Controller_Front::getInstance()->getRequest()->getParams();
        foreach ($allParams as $param=> $value) {
            if ($param != 'module') {
                if ((count($allParams) == 3 && ($param == 'controller' && $value == 'index')) ||
                    (count($allParams) == 3 && ($param == 'action' && $value == 'index'))
                ) {

                } else {
                    if ($param == 'controller' || $param == 'action') {
                        $result[] = $value;
                    } else {
                        $result[] = $param . '/' . $value;
                    }
                }
            }
        }
        return implode('/', $result);
    }
}