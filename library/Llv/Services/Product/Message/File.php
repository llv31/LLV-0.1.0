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

class Llv_Services_Product_Message_File
    extends Llv_Services_Message_Abstract
{
    /** @var int */
    public $idProduct;
    /** @var Llv_Dto_Product_File */
    public $file;
    /** @var Llv_Dto_Product_File[] */
    public $files;
}