<?php
/**
 * PHP Class Product.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 28/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_Product_Helper_Product
{
    /**
     * Retourne le chemin vers les fichiers du carrousel
     *
     * @return string
     */
    public static function getProductFilesPath()
    {
        return Llv_Services_Referential_Helper_Files::getUploadPath() . Llv_Constant_Product::DIRECTORY_PATH;
    }

    /**
     * @static
     * @return string
     */
    public static function getProductFilesUrl()
    {
        return Llv_Services_Referential_Helper_Files::getUploadUrl() . Llv_Constant_Product::DIRECTORY_PATH;
    }
}