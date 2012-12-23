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

class Llv_Services_Product_Message_Product
    extends Llv_Services_Message_Abstract
{
    /** @var int */
    public $idProduct;
    /** @var Llv_Dto_Product */
    public $product;
    /** @var Llv_Dto_Product[] */
    public $products;
}