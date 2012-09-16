<?php
/**
 * PHP Class File.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 15/09/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_News_Message_File
    extends Llv_Services_Message_Abstract
{
    /** @var int */
    public $idActualite;
    /** @var Llv_Dto_News_File */
    public $file;
    /** @var Llv_Dto_News_File[] */
    public $files;
}