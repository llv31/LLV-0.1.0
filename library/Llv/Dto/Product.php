<?php
/**
 * PHP Class Product.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Dto_Product
{
    /** @var int */
    public $id;
    /** @var Llv_Dto_Product_Category */
    public $category;
    /** @var int */
    public $idLangue;
    /** @var string */
    public $title;
    /** @var string */
    public $introduction;
    /** @var string */
    public $content;
    /** @var string */
    public $availability;
    /** @var string */
    public $url;
    /** @var int */
    public $position;
    /** @var Llv_Dto_Product_File[] */
    public $illustrations;
    /** @var Llv_Dto_Product_Goldbook[] */
    public $goldbook;
    /** @var Llv_Dto_Product_Night_Price|Llv_Dto_Product_Season_Price[] */
    public $price;
}