<?php
/**
 * PHP Class Uploader.phtml
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 28/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Uploader
    implements Llv_Entity_Uploader_Interface
{
    /**
     * @param Llv_Dto_File $file
     * @param              $type
     *
     * @return bool|null|string
     */
    public function moveFile(Llv_Dto_File $file, $type)
    {
        if (Llv_Constant_File_Category::isValid($type)) {
            $path = Llv_Services_Referential_Helper_Files::getUploadPath() . $type . '/';
            $filename = explode('.', $file->filename);
            $file->extension = $filename[count($filename) - 1];
            unset($filename[count($filename) - 1]);
            $file->filename = uniqid();

            if (move_uploaded_file($file->tmpName, $path . $file->filename . '.' . $file->extension)) {
                return $file->filename . '.' . $file->extension;
            }
        }
        return null;
    }

    /**
     * @param $filename
     * @param $type
     */
    public function deleteFile($filename, $type)
    {
        if (Llv_Constant_File_Category::isValid($type)) {
            $path = Llv_Services_Referential_Helper_Files::getUploadPath() . $type . '/';
            unlink($path . $filename);
        }
    }
}