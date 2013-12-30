<?php
/**
 * PHP Class Edit.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 24/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Product_Request_Edit
{
    /** @var int */
    public $id;
    /** @var int */
    public $idCategorie;
    /** @var int */
    public $position;
    /** @var string */
    public $coordonnees;
    /** @var bool */
    public $online;
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
    /** @var string */
    public $url;
    /** @var string */
    public $availability;
}