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
     *
     * @return null|string
     */
    public function dateFormat(DateTime $date, $withTime = false)
    {
        if (!is_null($date)) {
            $locale = Llv_Context_Application::getInstance()->getCurrentLocale();
            $format = $date->format(Llv_Constant_Date::FORMAT_DB);
            $dateTime = explode(' ', $format);
            $date = explode('-', $dateTime[0]);


            $result = array();
            switch ($locale) {
                default:
                    $result[] = $date[2];
                    $result[] = _('GLOBAL_MONTH_LABEL' . $date[1]);
                    $result[] = $date[0];
                    break;
                case Llv_Constant_Locale::ANGLAIS_GB_LOCALE:
                    $result[] = $date[0];
                    $result[] = _('GLOBAL_MONTH_LABEL') . $date[1];
                    $result[] = $date[2];
                    break;
            }
            if ($withTime) {
                $result[] = _('GLOBAL_TIME_SEPARATOR_LABEL').'&nbsp;' . $dateTime[1];
            }
            return implode(' ', $result);
        }
        return null;
    }
}