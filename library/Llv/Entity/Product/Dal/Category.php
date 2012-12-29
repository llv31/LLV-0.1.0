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

class Llv_Entity_Product_Dal_Category
    extends Zend_Db_Table_Abstract
{
    protected static $_nameTable = "product_category";
    protected static $_nameTrad = "product_category_language";
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
     * @param Llv_Entity_Product_Filter_Category $filter
     *
     * @return array
     */
    public static function getOne(Llv_Entity_Product_Filter_Category $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('pc'=> self::$_nameTable))
                ->joinLeft(
                array(
                     'pcl'=> self::$_nameTrad
                ),
                'pc.id = pcl.category_id',
                array('title', 'content', 'language_id')
            )
                ->joinLeft(
                array('l'=> 'language'),
                'l.id = pcl.language_id',
                array());

            if (isset($filter->id)) {
                $sql->where('pc.id = ?', $filter->id);
            } elseif (isset($filter->route)) {
                $sql->where('pc.route = ?', $filter->route);
            }

            if (isset($filter->idLangue)) {
                $sql->where('l.id = ?', $filter->idLangue);
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
     * @param Llv_Entity_Product_Filter_Category $filter
     *
     * @return array
     */
    public static function getAll(Llv_Entity_Product_Filter_Category $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('pc'=> self::$_nameTable))
                ->joinLeft(
                array(
                     'pcl'=> self::$_nameTrad
                ),
                'pc.id = pcl.category_id',
                array('title', 'content', 'language_id')
            )
                ->joinLeft(
                array('l'=> 'language'),
                'l.id = pcl.language_id',
                array()
            );
            if (isset($filter->idLangue)) {
                $sql->where('l.id = ?', $filter->idLangue);
            }
//            Zend_Debug::dump($sql->assemble());
//            die;
            return Llv_Db::getInstance()->fetchAll($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return array();
    }

}