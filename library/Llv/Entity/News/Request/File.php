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

class Llv_Entity_News_Request_File
{
    /** @var int */
    public $idNews;
    /** @var int */
    public $id;
    /** @var string */
    public $filename;
    /** @var string */
    public $originalFilename;
    /** @var string */
    public $mimeType;
    /** @var int */
    public $size;
    /** @var DateTime */
    public $dateAdd;
    /** @var DateTime */
    public $dateDelete;
    /** @var bool */
    public $moveUp;
    /** @var bool */
    public $show;
}