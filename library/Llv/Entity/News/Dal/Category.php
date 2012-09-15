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

class Llv_Entity_News_Dal_Category
    extends Zend_Db_Table_Abstract
{
    protected static $_nameTable = "news_category";
    protected static $_nameTrad = "news_category_language";
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
     * @param Llv_Entity_News_Filter_Category $filter
     *
     * @return array
     */
    public static function getOne(Llv_Entity_News_Filter_Category $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('n'=> self::$_nameTable))
                ->joinLeft(
                array(
                     'nl'=> self::$_nameTrad
                ),
                'n.id = nl.category_id',
                array('title', 'language_id')
            )
                ->joinLeft(array('l'=> 'language'), 'l.id = nl.language_id')
                ->where('n.id = ?', $filter->id);
            return Llv_Db::getInstance()->fetchRow($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return array();
    }

    /**
     * @static
     *
     * @param Llv_Entity_News_Filter_Category $filter
     *
     * @return array
     */
    public static function getAll(Llv_Entity_News_Filter_Category $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('n'=> self::$_nameTable))
                ->joinLeft(
                array(
                     'nl'=> self::$_nameTrad
                ),
                'n.id = nl.category_id',
                array('title', 'language_id')
            )
                ->joinLeft(array('l'=> 'language'), 'l.id = nl.language_id', array());
            if (isset($filter->idLangue)) {
                $sql->where('l.id = ?', $filter->idLangue);
            }
            if ($filter->online) {
                $sql->where('n.online = ?', $filter->online);
            }
            return Llv_Db::getInstance()->fetchAll($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return array();
    }

}