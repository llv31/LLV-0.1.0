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

class App_View_Helper_DateExplode
    extends Zend_View_Helper_Abstract
{
    /**
     * @param DateTime $date
     * @param bool     $withTime
     * @param bool     $short
     *
     * @return array|null
     */
    public function dateExplode(DateTime $date, $withTime = false, $short = true)
    {
        if (!is_null($date)) {
            $locale = Llv_Context_Application::getInstance()->getCurrentLocale();
            $format = $date->format(Llv_Constant_Date::FORMAT_DB);
            $dateTime = explode(' ', $format);
            $date = explode('-', $dateTime[0]);
            $key = 'GLOBAL_MONTH_LABEL';
            if ($short) {
                $key .= '_SHORT';
            }

            $result = array();
            switch ($locale) {
                default:
                    $result['day'] = $date[2];
                    $result['month'] = _($key . $date[1]);
                    $result['year'] = $date[0];
                    break;
                case Llv_Constant_Locale::ANGLAIS_GB_LOCALE:
                    $result['year'] = $date[0];
                    $result['month'] = _($key . $date[1]);
                    $result['day'] = $date[2];
                    break;
            }
            if ($withTime) {
                $result['time'] = _('GLOBAL_TIME_SEPARATOR_LABEL') . '&nbsp;' . $dateTime[1];
            }
            return $result;
        }
        return null;
    }
}