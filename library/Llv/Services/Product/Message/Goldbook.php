<?php
/**
 * PHP Class Goldbook.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 05/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_Product_Message_Goldbook
    extends Llv_Services_Message_Abstract
{
    /** @var Llv_Dto_Product_Goldbook */
    public $goldbookMessage;
    /** @var Llv_Dto_Product_Goldbook[] */
    public $goldbook;
    /** @var int */
    public $idGoldbookMessage;
}