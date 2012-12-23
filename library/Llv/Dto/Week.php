<?php
/**
 * PHP Class Week.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/12/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Dto_Week
{
    /** @var int */
    public $id;
    /** @var Llv_Dto_Season */
    public $season;
    /** @var int */
    public $number;
    /** @var DateTime */
    public $dateBegining;
    /** @var DateTime */
    public $dateEnding;
}