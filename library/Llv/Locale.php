<?php
/**
 * PHP Class Locale.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 20/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Locale extends Zend_Locale
{
    /**
     * Convertit un id de langue en locale
     *
     * @param $idLangue
     *
     * @return string
     */
    public function convertIdLangueToLocale($idLangue)
    {
        switch ($idLangue) {
            default :
            case Llv_Constant_Locale::FRANCAIS_FRANCE_ID :
                return Llv_Constant_Locale::FRANCAIS_FRANCE_LOCALE;
                break;
        }
    }

    /**
     * Convertit un code court de langue en id
     *
     * @return int
     */
    public function getIdLangue()
    {
        switch ($this->getLanguage()) {
            default :
            case Llv_Constant_Locale::FRANCAIS_FRANCE_SHORT :
                return Llv_Constant_Locale::FRANCAIS_FRANCE_ID;
                break;
        }
    }
}