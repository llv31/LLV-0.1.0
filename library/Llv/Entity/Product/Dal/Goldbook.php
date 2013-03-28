<?php
/**
 * PHP Class Goldbook.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Product_Dal_Goldbook
    extends Zend_Db_Table_Abstract
{
    protected static $_nameTable = "product_category_goldbook";
    protected $_rowClass = "Llv_Entity_Dal_Row_Abstract";
    protected static $_instance;

    /**
     * @static
     * @return Llv_Entity_Cms_Dal_Page
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @static
     *
     * @param Llv_Entity_Product_Filter_Goldbook $filter
     *
     * @return array
     */
    public static function getOne(Llv_Entity_Product_Filter_Goldbook $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('pcg'=> self::$_nameTable));

            if (isset($filter->id)) {
                $sql->where('pcg.id = ?', $filter->id);
            } else {
                if (isset($filter->idCategorie)) {
                    $sql->where('pcg.product_category_id = ?', $filter->idCategorie);
                }
                if (isset($filter->valid)) {
                    $sql->where('pcg.validated = ?', $filter->valid);
                }
            }

            return Llv_Db::getInstance()->fetchRow($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return array();
    }

    /**
     * @static
     *
     * @param Llv_Entity_Product_Filter_Goldbook $filter
     *
     * @return array
     */
    public static function getAll(Llv_Entity_Product_Filter_Goldbook $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('pcg'=> self::$_nameTable))
                ->order('date_add DESC');

            if (isset($filter->idCategorie)) {
                $sql->where('pcg.product_category_id = ?', $filter->idCategorie);
            }
            if (isset($filter->valid)) {
                $sql->where('pcg.validated = ?', $filter->valid);
            }
            return Llv_Db::getInstance()->fetchAll($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return array();
    }

    /**
     * @static
     *
     * @param Llv_Entity_Product_Request_EditGoldbook $request
     *
     * @return int|null
     */
    public static function createOne(Llv_Entity_Product_Request_EditGoldbook $request)
    {
        try {
//            Zend_Debug::dump($request);die;
            $params = array(
                'product_category_id'        => $request->idCategorie,
                'content'                    => htmlentities($request->content),
                'validated'                  => $request->valid,
            );

            if (strlen($request->dateBegin) > 0) {
                $request->dateBegin = new DateTime($request->dateBegin);
                $params['date_begining'] = $request->dateBegin->format(Llv_Constant_Date::FORMAT_DB);
            }
            if (strlen($request->dateEnd) > 0) {
                $request->dateEnd = new DateTime($request->dateEnd);
                $params['date_ending'] = $request->dateEnd->format(Llv_Constant_Date::FORMAT_DB);
            }
            $request->dateAdd = new DateTime();
            $params['date_add'] = $request->dateAdd->format(Llv_Constant_Date::FORMAT_DB);
            return Llv_Db::getInstance()->insert(
                self::$_nameTable,
                $params
            );
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return null;
    }

    /**
     * @static
     *
     * @param Llv_Entity_Product_Request_EditGoldbook $request
     *
     * @return int|null
     */
    public static function updateOne(Llv_Entity_Product_Request_EditGoldbook $request)
    {
        try {
            $where = "";
            if (!is_null($request->id)) {
                $where = "id = " . $request->id;
            }
            $params = array();
            if (!is_null($request->idCategorie) > 0) {
                $params['product_category_id'] = $request->idCategorie;
            }
            if (is_bool($request->valid) > 0) {
                $params['validated'] = $request->valid;
            }
            if (strlen($request->content) > 0) {
                $params['content'] = $request->content;
            }

            if (strlen($request->dateBegin) > 0) {
                $request->dateBegin = new DateTime($request->dateBegin);
                $params['date_begining'] = $request->dateBegin->format(Llv_Constant_Date::FORMAT_DB);
            }
            if (strlen($request->dateEnd) > 0) {
                $request->dateEnd = new DateTime($request->dateEnd);
                $params['date_ending'] = $request->dateEnd->format(Llv_Constant_Date::FORMAT_DB);
            }
            if (strlen($request->dateUpdate) > 0) {
                $request->dateUpdate = new DateTime($request->dateUpdate);
                $params['date_update'] = $request->dateUpdate->format(Llv_Constant_Date::FORMAT_DB);
            }
            if (strlen($request->dateDelete) > 0) {
                $request->dateDelete = new DateTime($request->dateDelete);
                $params['date_delete'] = $request->dateDelete->format(Llv_Constant_Date::FORMAT_DB);
            }
            return Llv_Db::getInstance()->update(
                self::$_nameTable,
                $params,
                $where
            );
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return null;
    }

    /**
     * @static
     *
     * @param Llv_Entity_Product_Request_EditGoldbook $request
     *
     * @return int|null
     */
    public static function deleteOne(Llv_Entity_Product_Request_EditGoldbook $request)
    {
        try {
            $where = "";
            if (!is_null($request->id)) {
                $where = "id = " . $request->id;
            }
            return Llv_Db::getInstance()->delete(
                self::$_nameTable,
                $where
            );
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return null;
    }
}