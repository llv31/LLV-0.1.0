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
    public function availableLanguages()
    {
        $currentLanguage = Llv_Context_Application::getInstance()->getCurrentLocale()->toString();
        echo '<ul class="languages">' . PHP_EOL;
        foreach (Llv_Config::getInstance()->sites->toArray() as $site) {
            if ($site['front']) {
                echo '<li class="' . htmlspecialchars($site['locale']) . ' ' .
                    ($site['locale'] == $currentLanguage ? 'current' : '') . '">' . PHP_EOL;
                echo '<a href="http://' . $site['host'] . '/' . $this->getCurrentPage() . '">';
                echo htmlspecialchars($site['locale']);
                echo '</a>' . PHP_EOL;
                echo '</li>' . PHP_EOL;
            }
        }
        echo '</ul>' . PHP_EOL;
    }

    public function getCurrentPage()
    {
    }
}