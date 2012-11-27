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

class Llv_Dto_Activity
{
    /** @var int */
    public $id;
    /** @var int */
    public $idLangue;
    /** @var string */
    public $title;
    /** @var string */
    public $content;
    /** @var string */
    public $link;
    /** @var int */
    public $position;
    /** @var string */
    public $location;
    /** @var string */
    public $filename;
    /** @var bool */
    public $online;
    /** @var DateTime */
    public $dateAdd;
    /** @var DateTime */
    public $dateUpdate;
    /** @var DateTime */
    public $dateDelete;
    /** @var Llv_Dto_Activity_Category */
    public $category;
    /** @var Llv_Dto_Activity_File[] */
    public $illustrations;
}