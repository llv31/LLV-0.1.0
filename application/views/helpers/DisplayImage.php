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
require_once APPLICATION_PATH . '/../library/PhpThumb/ThumbLib.inc.php';
class App_View_Helper_DisplayImage
    extends Zend_View_Helper_Abstract
{
    /**
     * Retourne l'url vers une miniature de l'image en paramètre
     *
     * @param     $filename
     * @param     $fileCategory
     * @param int $width
     * @param int $height
     * @param int $quality
     *
     * @return null|string
     */
    public function displayImage($filename, $fileCategory, $width = 800, $height = 600, $quality = 100)
    {
        if (!is_null($filename)) {
            if (in_array($fileCategory, Llv_Constant_File_Category::getAssociativeArray())) {
                $thumbDirectory = '/_thumb/';
                $fileParentPath = Llv_Services_Referential_Helper_Files::getUploadPath() . $fileCategory . '/';

                $thumbname = self::getThumbName($filename, $width, $height);
                $thumbpath = $fileParentPath . $thumbDirectory . $thumbname;

                if (!file_exists($thumbpath)) {
                    $filepath = $fileParentPath . $filename;
                    if (file_exists($filepath)) {
                        $fileParentPathThumb = $fileParentPath . '_thumb';
                        if (!is_dir($fileParentPathThumb)) {
                            mkdir($fileParentPathThumb);
                        }
                        $thumb = PhpThumbFactory::create($filepath);
                        $destPath = $fileParentPathThumb . '/' . ltrim($thumbname, '/');
                        if (!file_exists($destPath)) {
                            $thumb->resize($width, $height);
                            $thumb->save($destPath);
                        }
                    }
                }
                return $this->view->baseUrl()
                    . Llv_Services_Referential_Helper_Files::getUploadUrl()
                    . $fileCategory
                    . $thumbDirectory
                    . ltrim($thumbname, '/');
            }
        }
        return null;
    }

    /**
     * @param $filename
     * @param $width
     * @param $height
     *
     * @return string
     */
    private function getThumbName($filename, $width, $height)
    {
        $filename = explode('.', $filename);
        $extension = $filename[count($filename) - 1];
        unset($filename[count($filename) - 1]);
        $filename = implode('.', $filename);

        return strtolower(
            basename($filename)
                . '_thumb_'
                . $width . '_'
                . $height . '.'
                . $extension
        );
    }
}