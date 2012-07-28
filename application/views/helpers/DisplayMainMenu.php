<?php
/**
 * PHP Class DisplayMainMenu.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_DisplayMainMenu
    extends Zend_View_Helper_Abstract
{
    /**
     * @param array  $items
     * @param string $menuClass
     */
    public function displayMainMenu(array $items, $menuClass = 'main_menu')
    {
        if (is_array($items) == false || count($items) == 0) {
            return;
        }
        echo '<ul' . (strlen($menuClass) > 0 ? ' class="' . htmlspecialchars($menuClass) . '"' : '') . '>' . PHP_EOL;
        foreach ($items as $key=> $item) {
            $class = null;
            if ($this->view->isController($item['controller'])) {
                if (isset($item['current'])) {
                    if (in_array($this->view->getAction(), $item['current'])) {
                        $class = "current";
                    }
                } else {
                    $class = "current";
                }
            }
            echo '<li class="' . $class . '">' . PHP_EOL;
            if (isset($item['items'])) {
                echo '<span>' . $item['label'] . '</span>';
                $this->displayMainMenu($item['items'], 'sub' . $menuClass . ' ' . 'sub' . $menuClass . '_' . $key);
            } else {
                echo '<a href="' .
                    htmlspecialchars(
                        $this->view->url(
                            array(
                                 'controller' => $item['controller'],
                                 'action'     => isset($item['action']) ? $item['action'] : 'index'
                            ),
                            null,
                            true
                        )
                    )
                    . '">';
                echo htmlspecialchars($item['label']);
                echo '</a>' . PHP_EOL;
            }
            echo '</li>' . PHP_EOL;
        }
        echo '</ul>' . PHP_EOL;

    }
}