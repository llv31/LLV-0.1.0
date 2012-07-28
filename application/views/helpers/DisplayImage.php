<?php
/**
 * PHP Class Image.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 29/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_DisplayImage
    extends Zend_View_Helper_Abstract
{

    public function displayImage($filename, $fileCategory, $width = 800, $height = 600)
    {
        if (in_array($fileCategory, Llv_Constant_File_Category::getAssociativeArray())) {
            $fileParentPath = '';
            switch ($fileCategory) {
                case Llv_Constant_File_Category::CARROUSEL:
                    $fileParentPath = Llv_Services_Cms_Helper_Carrousel::getCarrouselFilesPath();
                    break;
                case Llv_Constant_File_Category::NEWS:
                    $fileParentPath = Llv_Services_News_Helper_News::getNewsFilesPath();
                    break;
                case Llv_Constant_File_Category::ACTIVITY:
                    $fileParentPath = Llv_Services_Activity_Helper_Activity::getActivityFilesPath();
                    break;
            }
            $thumb = PhpThumbFactory::create($fileParentPath . $filename);
            return $fileParentPath . $filename;
        }
        return null;
    }
}