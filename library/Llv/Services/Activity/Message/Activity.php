<?php
/**
 * PHP Class News.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_Activity_Message_Activity
    extends Llv_Services_Message_Abstract
{
    /** @var int */
    public $idActivite;
    /** @var Llv_Dto_Activity */
    public $activite;
    /** @var Llv_Dto_Activity[] */
    public $activites;
}