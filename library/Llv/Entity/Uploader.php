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
     * @param null         $id
     *
     * @return bool|null|string
     */
    public function moveFile(Llv_Dto_File $file, $type, $id = null)
    {
        if (Llv_Constant_File_Category::isValid($type)) {
            $path = Llv_Services_Referential_Helper_Files::getUploadPath() . $type . '/';
            $filename = explode('.', $file->filename);
            $file->extension = $filename[count($filename) - 1];
            unset($filename[count($filename) - 1]);
            $file->filename = uniqid();

            $file->filename = (is_null($id) ? $file->filename . '.' . $file->extension : $id . '.jpg');
            if (move_uploaded_file($file->tmpName, $path . $file->filename)) {
                return $file->filename;
            }
        }
        return null;
    }

    /**
     * @param $filenameWithExt
     * @param $type
     */
    public function deleteFile($filenameWithExt, $type)
    {
        if (Llv_Constant_File_Category::isValid($type)) {
            $path = Llv_Services_Referential_Helper_Files::getUploadPath() . $type . '/';
            $thumbPath = Llv_Services_Referential_Helper_Files::getUploadPath() . $type . '/_thumb/';
            unlink($path . $filenameWithExt);

            $files = new DirectoryIterator($thumbPath);
            $filename = explode('.', $filenameWithExt);
            $filename = $filename[0];
            /** @var $file SplFileInfo */
            foreach ($files as $file) {
                if (!$file->isDir()) {
                    if (strstr($file->getFilename(), $filename)) {
                        unlink($thumbPath . $file->getFilename());
                    }
                }
            }
        }
    }
}