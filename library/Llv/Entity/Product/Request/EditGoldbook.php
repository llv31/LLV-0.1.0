<?php
/**
 * PHP Class EditGoldbook.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 23/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Product_Request_EditGoldbook
{
    /** @var int */
    public $id;
    /** @var int */
    public $idCategorie;
    /** @var string */
    public $content;
    /** @var boolean */
    public $valid;
    /** @var Datetime */
    public $dateBegin;
    /** @var Datetime */
    public $dateEnd;
    /** @var Datetime */
    public $dateAdd;
    /** @var Datetime */
    public $dateUpdate;
    /** @var Datetime */
    public $dateDelete;
}