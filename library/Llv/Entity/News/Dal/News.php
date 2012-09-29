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

class Llv_Entity_News_Dal_News
    extends Zend_Db_Table_Abstract
{
    protected static $_nameTable = "news";
    protected static $_nameTrad = "news_language";
    protected static $_nameFile = "news_illustration";
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
     * @param Llv_Entity_News_Filter_News $filter
     *
     * @return array
     */
    public static function getOne(Llv_Entity_News_Filter_News $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('n'=> self::$_nameTable))
                ->joinLeft(
                array(
                     'nl'=> self::$_nameTrad
                ),
                'n.id = nl.news_id',
                array('title', 'content', 'link', 'language_id')
            )
                ->joinLeft(
                array('l'=> 'language'),
                'l.id = nl.language_id',
                array('label', 'locale', 'short_tag')
            )
                ->where('n.id = ?', $filter->id);
            if (isset($filter->idLangue)) {
                $sql->where('l.id = ?', $filter->idLangue);
            }
            return Llv_Db::getInstance()->fetchRow($sql);
            return Llv_Db::getInstance()->fetchAll($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return array();
    }

    /**
     * @static
     *
     * @param Llv_Entity_News_Filter_News $filter
     *
     * @return array
     */
    public static function getAll(Llv_Entity_News_Filter_News $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('n'=> self::$_nameTable))
                ->joinLeft(
                array(
                     'nl'=> self::$_nameTrad
                ),
                'n.id = nl.news_id',
                array('title', 'content', 'link', 'language_id')
            )
                ->joinLeft(array('l'=> 'language'), 'l.id = nl.language_id', array())
                ->where('l.id = ?', $filter->idLangue);
            if ($filter->online) {
                $sql->where('n.online = ?', $filter->online);
            }
            return Llv_Db::getInstance()->fetchAll($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return array();
    }

    /**
     * Retourne l'ordre le plus grand
     *
     * @return null|string
     */
    public static function getLastOrder()
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(self::$_nameTable, array('MAX(position)'));
            $result = Llv_Db::getInstance()->fetchOne($sql);
            return !is_null($result) ? $result : 0;
        } catch (Exception $e) {
            Zend_Debug::dump($e);
            error_log($e);
            return null;
        }
    }

    /**
     * @static
     *
     * @param Llv_Entity_News_Request_Edit $request
     *
     * @return bool|int
     */
    public static function addRow(Llv_Entity_News_Request_Edit $request)
    {
        try {
            $params = array();
            $params['category_id'] = $request->idCategorie;
            $params['position'] = self::getLastOrder() + 1;
            $params['location'] = $request->coordonnees;
            $params['online'] = $request->online;
            if ($request->dateAdd instanceof DateTime) {
                $params['date_add'] = $request->dateAdd->format(Llv_Constant_Date::FORMAT_DB);
            }
            if ($request->dateUpdate instanceof DateTime) {
                $params['date_update'] = $request->dateUpdate->format(Llv_Constant_Date::FORMAT_DB);
            }
            if ($request->dateDelete instanceof DateTime) {
                $params['date_delete'] = $request->dateDelete->format(Llv_Constant_Date::FORMAT_DB);
            }
            Zend_Debug::dump($params);
            Llv_Db::getInstance()
                ->insert(
                self::$_nameTable,
                $params
            );
            return Llv_Db::getInstance()->lastInsertId(self::$_nameTable);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return false;
    }

    /**
     * @static
     *
     * @param Llv_Entity_News_Request_Edit $request
     *
     * @return bool|int
     */
    public static function updateRow(Llv_Entity_News_Request_Edit $request)
    {
        try {
            $params = array();
            $params['category_id'] = $request->idCategorie;
            $params['position'] = $request->position;
            $params['location'] = $request->coordonnees;
            $params['online'] = (bool)$request->online;
            if ($request->dateAdd instanceof DateTime) {
                $params['date_add'] = $request->dateAdd->format(Llv_Constant_Date::FORMAT_DB);
            }
            if ($request->dateUpdate instanceof DateTime) {
                $params['date_update'] = $request->dateUpdate->format(Llv_Constant_Date::FORMAT_DB);
            }
            if ($request->dateDelete instanceof DateTime) {
                $params['date_delete'] = $request->dateDelete->format(Llv_Constant_Date::FORMAT_DB);
            }
            return Llv_Db::getInstance()
                ->update(
                self::$_nameTable,
                $params,
                'id = ' . $request->id
            );
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return false;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_News_Request_EditContent $request
     *
     * @return int
     */
    public static function addRowContent(Llv_Entity_News_Request_EditContent $request)
    {
        try {
            $params = array();
            $params['news_id'] = $request->idNews;
            $params['language_id'] = $request->idLangue;
            $params['title'] = $request->title;
            $params['content'] = $request->content;
            $params['link'] = $request->lien;
            return Llv_Db::getInstance()
                ->insert(
                self::$_nameTrad,
                $params
            );
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
    }

    /**
     * @param Llv_Entity_News_Request_EditContent $request
     *
     * @return int
     */
    public static function updateRowContent(Llv_Entity_News_Request_EditContent $request)
    {
        try {
            $params = array();
            $where = 'news_id = ' . $request->idNews . ' AND language_id = ' . $request->idLangue;
            $params['title'] = $request->title;
            $params['content'] = $request->content;
            $params['link'] = $request->lien;
            return Llv_Db::getInstance()
                ->update(
                self::$_nameTrad,
                $params,
                $where
            );
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @static
     *
     * @param Llv_Entity_News_Filter_File $filter
     *
     * @return array
     */
    public static function getNewsFile(Llv_Entity_News_Filter_File $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(self::$_nameFile)
                ->where('id = ?', $filter->id);
            return Llv_Db::getInstance()->fetchRow($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return array();

    }

    /**
     * @static
     *
     * @param Llv_Entity_News_Filter_File $filter
     *
     * @return array
     */
    public static function getNewsFiles(Llv_Entity_News_Filter_File $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(self::$_nameFile)
                ->where('news_id = ?', $filter->idNews)
                ->order('position ASC');
            if (isset($filter->online)) {
                $sql->where('online = ?', $filter->online);
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
     * @param Llv_Entity_News_Request_File $request
     *
     * @return bool|int
     */
    public static function addRowFile(Llv_Entity_News_Request_File $request)
    {
        try {
            $params = array();
            $params['news_id'] = $request->idNews;
            $params['online'] = 1;
            $params['position'] = self::getFileLastOrder() + 1;
            $params['original_filename'] = $request->originalFilename;
            $params['filename'] = $request->filename;
            if ($request->dateAdd instanceof DateTime) {
                $params['date_add'] = $request->dateAdd->format(Llv_Constant_Date::FORMAT_DB);
            }
            if ($request->dateDelete instanceof DateTime) {
                $params['date_delete'] = $request->dateDelete->format(Llv_Constant_Date::FORMAT_DB);
            }
            return Llv_Db::getInstance()
                ->insert(
                self::$_nameFile,
                $params
            );
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return false;
    }

    /**
     * @static
     *
     * @param Llv_Entity_News_Request_File $request
     *
     * @return bool
     */
    public static function updateRowFile(Llv_Entity_News_Request_File $request)
    {
        $filter = new Llv_Entity_News_Filter_File();
        $filter->id = $request->id;
        $file = self::getNewsFile($filter);
        if (!is_null($file)) {
            $params = array();
            /** On veut déplacer le fichier */
            if (isset($request->moveUp)) {
                /**
                 * On veut déplacer vers le haut
                 * On va donc augmenter la valeur de la position
                 */
                $positionInitiale = $file['position'];
                if (!$request->moveUp) {
                    $nouvellePosition = $positionInitiale + 1;
                    $params['position'] = $positionInitiale;
                    $where = 'position > ' . $positionInitiale . ' AND ' . 'position <= ' . $nouvellePosition;
                    /**
                     * Sinon on déplace vers le bas
                     */
                } else {
                    $nouvellePosition = $positionInitiale - 1;
                    $nouvellePosition = $nouvellePosition > 0 ? $nouvellePosition : 1;
                    $params['position'] = $positionInitiale;
                    $where = 'position < ' . $positionInitiale . ' AND ' . 'position >= ' . $nouvellePosition;
                }
                /** On met à jour tous les éléments avant ou après l'élément courant */
                Llv_Db::getInstance()->update(
                    self::$_nameFile,
                    $params,
                    $where
                );
                $params['position'] = $nouvellePosition;
            }
            /** Affichage masquage du fichier */
            if (isset($request->show)) {
                $params['online'] = $request->show;
            }

            /** On met à jour l'élément courant */
            Llv_Db::getInstance()->update(
                self::$_nameFile,
                $params,
                'id = ' . $file['id']
            );
            return self::getNewsFile($filter);
        }
        return false;
    }

    /**
     * @static
     *
     * @param Llv_Entity_News_Filter_File $filter
     *
     * @return int|null
     */
    public static function deleteRowFile(Llv_Entity_News_Filter_File $filter)
    {
        try {
            $where = array();
            if (isset($filter->id)) {
                $where[] = 'id = ' . $filter->id;
            }
            if (isset($filter->idNews)) {
                $where[] = 'news_id = ' . $filter->idNews;
            }
            $where = implode(
                ' AND ',
                $where
            );
            $file = self::getNewsFile($filter);
            Llv_Db::getInstance()->delete(
                self::$_nameFile,
                $where
            );
            return $file['news_id'];
        } catch (Exception $e) {
            Zend_Debug::dump($e);
            error_log($e);
            return null;
        }
    }

    /**
     * Retourne l'ordre le plus grand
     *
     * @return null|string
     */
    public static function getFileLastOrder()
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(self::$_nameFile, array('MAX(position)'));
            $result = Llv_Db::getInstance()->fetchOne($sql);
            return !is_null($result) ? $result : 0;
        } catch (Exception $e) {
            Zend_Debug::dump($e);
            error_log($e);
            return null;
        }
    }

}