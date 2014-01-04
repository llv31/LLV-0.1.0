<?php
/**
 * PHP Class DateFormat.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 28/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_DateFormat
    extends Zend_View_Helper_Abstract
{
    /**
     * @param DateTime $date
     * @param bool     $withTime
     * @param bool     $short
     *
     * @return null|string
     */
    public function dateFormat(DateTime $date, $withTime = false, $short = false)
    {
        if (!is_null($date)) {
            $result = $this->dateExplode($date, $withTime, $short);
            return implode(' ', $result);
        }
        return null;
    }
}