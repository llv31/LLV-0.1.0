<?php
/**
 * PHP Class Category.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Dto_Product_Category
{
    /** @var int */
    public $id;
    /** @var string */
    public $route;
    /** @var string */
    public $adresse;
    /** @var Llv_Dto_Coordinate */
    public $location;
    /** @var string */
    public $type;
    /** @var string */
    public $title;
    /** @var string */
    public $content;
    /** @var string */
    public $pinColor;
    /** @var int */
    public $pricingType;
}