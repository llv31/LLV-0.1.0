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
     *
     * @return array|null
     */
    public function dateFormat(DateTime $date)
    {
        if (!is_null($date)) {
            $locale = Llv_Context_Application::getInstance()->getCurrentLocale();
            $format = Zend_Locale_Format::getDate(
                $date->format(Llv_Constant_Date::FORMAT_DB),
                array(
                     'locale'     => $locale,
                     'date_format'=> Zend_Locale_Format::STANDARD,
                     'fix_date'   => true
                )
            );
            $result = array();
            switch ($locale) {
                default:
                case Llv_Constant_Locale::FRANCAIS_FRANCE_LOCALE:
                case Llv_Constant_Locale::ESPAGNOL_ESPAGNE_LOCALE:
                    $result[] = $format['day'];
                    $result[] = _('GLOBAL_MONTH_LABEL' . $format['month']);
                    $result[] = $format['year'];
                    break;
                case Llv_Constant_Locale::ANGLAIS_GB_LOCALE:
                    $result[] = $format['year'];
                    $result[] = _('GLOBAL_MONTH_LABEL') . $format['month'];
                    $result[] = $format['day'];
                    break;
            }
            return implode(' ', $result);
        }
        return null;
    }
}