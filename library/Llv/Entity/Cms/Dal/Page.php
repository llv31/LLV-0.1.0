<?php
/**
 * PHP Class Page.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 27/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Cms_Dal_Page
    extends Zend_Db_Table_Abstract
{
    protected $_namePage = "cms_page";
    protected $_nameCarrousel = "cms_caroussel_element";
    protected $_nameTrad = "cms_page_language";
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
     * @param Llv_Entity_Cms_Request_Page $request
     *
     * @return bool|mixed
     */
    public static function getRow(Llv_Entity_Cms_Request_Page $request)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(
                array(
                     'p'=> Llv_Entity_Cms_Dal_Page::getInstance()->_namePage
                ),
                array(
                     'date_add', 'date_update', 'date_delete'
                )
            )
                ->joinLeft(
                array(
                     'pl'=> Llv_Entity_Cms_Dal_Page::getInstance()->_nameTrad
                ),
                'p.id = pl.page_id',
                array(
                     'title', 'content', 'url', 'page_id', 'language_id'
                )
            )
                ->joinLeft(
                array(
                     'l'=> 'language'
                ),
                'l.id = pl.language_id',
                array()
            )
                ->where('page_id = ?', $request->id)
                ->where('language_id = ?', $request->idLangue);
            return Llv_Db::getInstance()->fetchRow($sql);
        } catch (Exception $e) {
            error_log($e);
            return array();
        }
    }

    /**
     * @static
     *
     * @param Llv_Entity_Cms_Request_Page $request
     *
     * @return bool
     */
    public static function updateRow(Llv_Entity_Cms_Request_Page $request)
    {
        try {
            /** Maj de la page */
            $params = array();
            if ($request->dateAdd instanceof DateTime) {
                $params['date_add'] = $request->dateAdd->format(Llv_Constant_Date::FORMAT_DB);
            }
            if ($request->dateUpdate instanceof DateTime) {
                $params['date_update'] = $request->dateUpdate->format(Llv_Constant_Date::FORMAT_DB);
            }
            if ($request->dateDelete instanceof DateTime) {
                $params['date_delete'] = $request->dateDelete->format(Llv_Constant_Date::FORMAT_DB);
            }
            Llv_Db::getInstance()->update(
                Llv_Entity_Cms_Dal_Page::getInstance()->_namePage,
                $params,
                'id = ' . $request->id
            );
            /** Maj de la traduction */
            Llv_Db::getInstance()->update(
                Llv_Entity_Cms_Dal_Page::getInstance()->_nameTrad,
                array(
                     'title'    => $request->title,
                     'content'  => $request->content,
                     'url'      => $request->url
                ),
                'page_id = ' . $request->id . ' AND language_id = ' . $request->idLangue

            );
            return true;
        } catch (Exception $e) {
            error_log($e);
            return false;
        }
    }
}