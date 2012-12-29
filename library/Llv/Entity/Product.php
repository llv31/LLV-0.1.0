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

class Llv_Entity_Product
    implements Llv_Entity_Product_Interface
{
    /**
     * @param Llv_Entity_Product_Filter_Product $filter
     *
     * @return Llv_Dto_Product
     */
    public function getOne(Llv_Entity_Product_Filter_Product $filter)
    {
        $product = Llv_Entity_Product_Helper_Product::convertFromDalToDto(
            Llv_Entity_Product_Dal_Product::getOne($filter)
        );
        return $this->fillProduct($product, $filter);
    }

    /**
     * @param Llv_Entity_Product_Filter_Product $filter
     *
     * @return array
     */
    public function getAll(Llv_Entity_Product_Filter_Product $filter)
    {
        $products = Llv_Entity_Product_Helper_Product::convertListFromDalToDto(
            Llv_Entity_Product_Dal_Product::getAll($filter)
        );
        $result = array();
        if (count($products) > 0) {
            foreach ($products as $product) {
                $result[] = $this->fillProduct($product, $filter);
            }
        }
        return $result;
    }

    /**
     * @param Llv_Dto_Product                   $product
     * @param Llv_Entity_Product_Filter_Product $filter
     *
     * @return Llv_Dto_Product
     */
    public function fillProduct(Llv_Dto_Product $product, Llv_Entity_Product_Filter_Product $filter = null)
    {
        if (is_null($filter)) {
            $filter = new Llv_Entity_Product_Filter_Product();
        }
        if (!is_null($product)) {
            $filter->id = $product->id;

            $filesFilter = new Llv_Entity_Product_Filter_File();
            $filesFilter->idProduct = $product->id;
            $filesFilter->online = $filter->onlineIllustration;
            $product->illustrations = Llv_Entity_Product_Helper_File::convertListFromDalToDto(
                Llv_Entity_Product_Dal_Product::getProductFiles($filesFilter)
            );

            $categoryFilter = new Llv_Entity_Product_Filter_Category();
            $categoryFilter->id = $product->category->id;
            $categoryFilter->idLangue = $filter->idLangue;
            $category = Llv_Entity_Product_Helper_Category::convertFromDalToDto(
                Llv_Entity_Product_Dal_Category::getOne($categoryFilter)
            );
            $product->category = $category;

            $filter->priceType = $product->category->pricingType;
            $price = Llv_Entity_Product_Dal_Product::getPriceForProduct($filter);
            switch ($product->category->pricingType) {
                case Llv_Constant_Product_Price_Type::NUIT:
                    $product->price = Llv_Entity_Product_Helper_Product::convertNightPriceFromDalToDto($price);
                    break;
                case Llv_Constant_Product_Price_Type::SAISON:
                    $product->price = Llv_Entity_Product_Helper_Product::convertListSeasonPriceFromDalToDto($price);
                    break;
            }
            return $product;
        }
        return null;
    }

    /**
     * @param Llv_Entity_Product_Request_Edit $request
     *
     * @return int
     */
    public function addRow(Llv_Entity_Product_Request_Edit $request)
    {
        return Llv_Entity_Product_Dal_Product::addRow($request);
    }

    /**
     * @param Llv_Entity_Product_Request_Edit $request
     *
     * @return bool
     */
    public function updateRow(Llv_Entity_Product_Request_Edit $request)
    {
        return Llv_Entity_Product_Dal_Product::updateRow($request);
    }

    /**
     * @param Llv_Entity_Product_Filter_Product $filter
     *
     * @return null
     */
    public function deleteRow(Llv_Entity_Product_Filter_Product $filter)
    {
        return Llv_Entity_Product_Dal_Product::deleteRow($filter);
    }

    /**
     * @param Llv_Entity_Product_Request_EditContent $request
     *
     * @return int
     */
    public function addRowContent(Llv_Entity_Product_Request_EditContent $request)
    {
        return Llv_Entity_Product_Dal_Product::addRowContent($request);
    }

    /**
     * @param Llv_Entity_Product_Request_EditContent $request
     *
     * @return bool
     */
    public function updateRowContent(Llv_Entity_Product_Request_EditContent $request)
    {
        return Llv_Entity_Product_Dal_Product::updateRowContent($request);
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Product_Request_File $request
     *
     * @return bool|int
     */
    public function addRowFile(Llv_Entity_Product_Request_File $request)
    {
        return Llv_Entity_Product_Dal_Product::addRowFile($request);
    }

    /**
     * @param Llv_Entity_Product_Filter_File $filter
     *
     * @return array
     */
    public function getProductFiles(Llv_Entity_Product_Filter_File $filter)
    {
        return Llv_Entity_Product_Helper_File::convertListFromDalToDto(
            Llv_Entity_Product_Dal_Product::getProductFiles($filter)
        );
    }

    /**
     * @param Llv_Entity_Product_Request_File $request
     *
     * @return Llv_Dto_Product
     */
    public function updateRowFile(Llv_Entity_Product_Request_File $request)
    {
        return Llv_Entity_Product_Helper_File::convertFromDalToDto(
            Llv_Entity_Product_Dal_Product::updateRowFile($request)
        );
    }

    /**
     * @param Llv_Entity_Product_Filter_File $filter
     *
     * @return mixed
     */
    public function deleteRowFile(Llv_Entity_Product_Filter_File $filter)
    {
        return Llv_Entity_Product_Dal_Product::deleteRowFile($filter);
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Product_Filter_Category $filter
     *
     * @return Llv_Dto_Product
     */
    public function categoryGetOne(Llv_Entity_Product_Filter_Category $filter)
    {
        return Llv_Entity_Product_Helper_Category::convertFromDalToDto(
            Llv_Entity_Product_Dal_Category::getOne($filter)
        );
    }

    /**
     * @param Llv_Entity_Product_Filter_Category $filter
     *
     * @return array
     */
    public function categoryGetAll(Llv_Entity_Product_Filter_Category $filter)
    {
        return Llv_Entity_Product_Helper_Category::convertListFromDalToDto(
            Llv_Entity_Product_Dal_Category::getAll($filter)
        );
    }

    /**
     * @param Llv_Entity_Product_Request_EditCategory $request
     *
     * @return array
     */
    public function categoryUpdateRow(Llv_Entity_Product_Request_EditCategory $request)
    {
        return Llv_Entity_Product_Dal_Category::categoryUpdateRow($request);
    }

    /**
     * @param Llv_Entity_Product_Request_EditCategoryContent $request
     *
     * @return mixed
     */
    public function categoryEditRowContent(Llv_Entity_Product_Request_EditCategoryContent $request)
    {
        return Llv_Entity_Product_Dal_Category::categoryEditRowContent($request);
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Product_Filter_Season $filter
     *
     * @return array
     */
    public function weeksGetOne(Llv_Entity_Product_Filter_Season $filter)
    {
        return Llv_Entity_Product_Helper_Season::convertWeekFromDalToDto(
            Llv_Entity_Product_Dal_Season::getOneWeek($filter)
        );
    }

    /**
     * @param Llv_Entity_Product_Filter_Season $filter
     *
     * @return array
     */
    public function weeksGetAll(Llv_Entity_Product_Filter_Season $filter)
    {
        return Llv_Entity_Product_Helper_Season::convertWeekListFromDalToDto(
            Llv_Entity_Product_Dal_Season::getAllWeeks($filter)
        );
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Product_Filter_Season $filter
     *
     * @return array
     */
    public function seasonGetAll(Llv_Entity_Product_Filter_Season $filter)
    {
        return Llv_Entity_Product_Helper_Season::convertListFromDalToDto(
            Llv_Entity_Product_Dal_Season::getAll($filter)
        );
    }

    /**
     * @param Llv_Entity_Product_Request_Season $request
     *
     * @return mixed|void
     */
    public function weekUpdateLot(Llv_Entity_Product_Request_Season $request)
    {
        return Llv_Entity_Product_Dal_Season::weekUpdateLot($request);
    }
}