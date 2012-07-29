<?php
/**
 * PHP Class Carrousel.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 28/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Cms_Request_Carrousel
{
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
    public $dateUpdate;
    /** @var DateTime */
    public $dateDelete;
    /** @var bool */
    public $moveUp;
    /** @var bool */
    public $show;
}