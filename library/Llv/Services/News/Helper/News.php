<?php
/**
 * PHP Class News.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 28/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_News_Helper_News
{
    /**
     * Retourne le chemin vers les fichiers du carrousel
     *
     * @return string
     */
    public static function getNewsFilesPath()
    {
        return Llv_Services_Referential_Helper_Files::getUploadPath() . Llv_Constant_News::DIRECTORY_PATH;
    }

    /**
     * @static
     * @return string
     */
    public static function getNewsFilesUrl()
    {
        return Llv_Services_Referential_Helper_Files::getUploadUrl() . Llv_Constant_News::DIRECTORY_PATH;
    }
}