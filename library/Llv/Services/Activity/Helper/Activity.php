<?php
/**
 * PHP Class Activity.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 28/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_Activity_Helper_Activity
{
    /**
     * Retourne le chemin vers les fichiers du carrousel
     *
     * @return string
     */
    public static function getActivityFilesPath()
    {
        return Llv_Services_Referential_Helper_Files::getUploadPath() . Llv_Constant_Activity::DIRECTORY_PATH;
    }

    /**
     * @static
     * @return string
     */
    public static function getActivityFilesUrl()
    {
        return Llv_Services_Referential_Helper_Files::getUploadUrl() . Llv_Constant_Activity::DIRECTORY_PATH;
    }
}