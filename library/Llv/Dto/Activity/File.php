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

class Llv_Dto_Activity_File
{
    /** @var int */
    public $id;
    /** @var int */
    public $idActivity;
    /** @var bool */
    public $online;
    /** @var string */
    public $filename;
    /** @var int */
    public $position;
    /** @var DateTime */
    public $dateAdd;
    /** @var DateTime */
    public $dateDelete;
}