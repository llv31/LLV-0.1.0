<?php
/**
 * PHP Class Carrousel.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 28/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_Cms_Helper_Carrousel
{
    /**
     * Retourne le chemin vers les fichiers du carrousel
     * @return string
     */
    public static function getCarrouselFilesPath()
    {
        return Llv_Services_Referential_Helper_Files::getUploadPath() . Llv_Constant_Cms_Carrousel::DIRECTORY_PATH;
    }
}