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
     * @param array $items
     */
    public function displayMainMenu(array $items)
    {
        if (is_array($items) == false || count($items) == 0) {
            return;
        }
        echo '<nav class="w-nav">' . PHP_EOL;
        echo '<div class="w-nav-h">' . PHP_EOL;
        echo '<div class="w-nav-control">' . PHP_EOL;
        echo '<i class="fa fa-bars"></i>' . PHP_EOL;
        echo '</div>' . PHP_EOL;
        echo '<div class="w-nav-list layout_hor width_auto level_1">' . PHP_EOL;
        echo '<div class="w-nav-list-h">' . PHP_EOL;
        foreach ($items as $item) {
            echo '<div class="w-nav-item level_1">' . PHP_EOL;
            echo '<div class="w-nav-item-h">' . PHP_EOL;
            echo '<a href="#' . $item['anchor'] . '" class="w-nav-anchor level_1">' . PHP_EOL;
            echo '<span class="w-nav-title">' . $item['label'] . '</span>' . PHP_EOL;
            echo '<span class="w-nav-hint"></span></a>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
        }
        echo '</div>' . PHP_EOL;
        echo '</div>' . PHP_EOL;
        echo '</div>' . PHP_EOL;
        echo '</nav>' . PHP_EOL;

    }
}