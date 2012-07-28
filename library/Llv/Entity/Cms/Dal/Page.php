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
    public static function pageGetRow(Llv_Entity_Cms_Request_Page $request)
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
            return false;
        }
    }

    /**
     * @static
     *
     * @param Llv_Entity_Cms_Request_Page $request
     *
     * @return bool
     */
    public static function pageUpdateRow(Llv_Entity_Cms_Request_Page $request)
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

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @static
     *
     * @param Llv_Entity_Cms_Request_Carrousel $request
     *
     * @return int|null
     */
    public static function carrouselAddRow(Llv_Entity_Cms_Request_Carrousel $request)
    {
        try {
            $params = array(
                'filename'             => $request->filename,
                'original_filename'    => $request->originalFilename,
                'mime_type'            => $request->mimeType,
                'size'                 => $request->size,
                'online'               => true,
                'position'             => self::carrouselGetLastOrder() + 1,
                'date_delete'          => null
            );
            if ($request->dateAdd instanceof DateTime) {
                $params['date_add'] = $request->dateAdd->format(Llv_Constant_Date::FORMAT_DB);
            }
            if ($request->dateUpdate instanceof DateTime) {
                $params['date_update'] = $request->dateUpdate->format(Llv_Constant_Date::FORMAT_DB);
            }
            return Llv_Db::getInstance()->insert(
                Llv_Entity_Cms_Dal_Page::getInstance()->_nameCarrousel,
                $params
            );
        } catch (Exception $e) {
            error_log($e);
            return null;
        }
    }

    /**
     * Retourne l'ordre le plus grand
     *
     * @return null|string
     */
    public function carrouselGetLastOrder()
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(Llv_Entity_Cms_Dal_Page::getInstance()->_nameCarrousel, array('MAX(position)'));
            $result = Llv_Db::getInstance()->fetchOne($sql);
            return !is_null($result) ? $result : 0;
        } catch (Exception $e) {
            Zend_Debug::dump($e);
            error_log($e);
            return null;
        }
    }

    /**
     * @param Llv_Entity_Cms_Filter_Carrousel $filter
     *
     * @return array
     */
    public static function carrouselGetList(Llv_Entity_Cms_Filter_Carrousel $filter)
    {
        $sql = Llv_Db::getInstance()->select()
            ->from(Llv_Entity_Cms_Dal_Page::getInstance()->_nameCarrousel)
            ->order('position DESC');
        if (isset($filter->online)) {
            $sql->where('online = ?', $filter->online);
        }
        return Llv_Db::getInstance()->fetchAll($sql);
    }
}