<?php
/**
 * PHP Interface Interface.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 28/07/12
 * @author      : aroy <contact@aroy.fr>
 */
interface Llv_Entity_Uploader_Interface
{
    /**
     * @param Llv_Dto_File $file
     * @param              $path
     *
     * @return bool
     */
    public function moveFile(Llv_Dto_File $file, $path);
}
