<?php
/**
 * PHP Class Carrousel.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 29/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Cms_Dal_Carrousel
    extends Zend_Db_Table_Abstract
{
    protected $_name = "cms_caroussel_element";
    protected $_rowClass = "Llv_Entity_Dal_Row_Abstract";
    protected static $_instance;

    /**
     * @static
     * @return Llv_Entity_Cms_Dal_Carrousel
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
     * @param Llv_Entity_Cms_Request_Carrousel $request
     *
     * @return int|null
     */
    public static function addRow(Llv_Entity_Cms_Request_Carrousel $request)
    {
        try {
            $params = array(
                'filename'             => $request->filename,
                'original_filename'    => $request->originalFilename,
                'mime_type'            => $request->mimeType,
                'size'                 => $request->size,
                'online'               => true,
                'position'             => self::getLastOrder() + 1,
                'date_delete'          => null
            );
            if ($request->dateAdd instanceof DateTime) {
                $params['date_add'] = $request->dateAdd->format(Llv_Constant_Date::FORMAT_DB);
            }
            if ($request->dateUpdate instanceof DateTime) {
                $params['date_update'] = $request->dateUpdate->format(Llv_Constant_Date::FORMAT_DB);
            }
            return Llv_Db::getInstance()->insert(
                Llv_Entity_Cms_Dal_Carrousel::getInstance()->_name,
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
    public function getLastOrder()
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(Llv_Entity_Cms_Dal_Carrousel::getInstance()->_name, array('MAX(position)'));
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
    public static function getList(Llv_Entity_Cms_Filter_Carrousel $filter)
    {
        $sql = Llv_Db::getInstance()->select()
            ->from(Llv_Entity_Cms_Dal_Carrousel::getInstance()->_name)
            ->order('date_delete')
            ->order('position DESC');
        if (isset($filter->online)) {
            $sql->where('online = ?', $filter->online);
        }
        if (isset($filter->includeDeleted)) {
            if (!$filter->includeDeleted) {
                $sql->where('date_delete IS NULL');
            }
        }
        return Llv_Db::getInstance()->fetchAll($sql);
    }

    /**
     * @static
     *
     * @param Llv_Entity_Cms_Filter_Carrousel $filter
     *
     * @return mixed
     */
    public static function getOne(Llv_Entity_Cms_Filter_Carrousel $filter)
    {
        $sql = Llv_Db::getInstance()->select()
            ->from(Llv_Entity_Cms_Dal_Carrousel::getInstance()->_name)
            ->where('id = ?', $filter->id);
        return Llv_Db::getInstance()->fetchRow($sql);
    }

    /**
     * @static
     *
     * @param Llv_Entity_Cms_Request_Carrousel $request
     *
     * @return bool|int
     */
    public static function updateRow(Llv_Entity_Cms_Request_Carrousel $request)
    {
        $filter = new Llv_Entity_Cms_Filter_Carrousel();
        $filter->id = $request->id;
        $carrousel = self::getOne($filter);
        if (!is_null($carrousel)) {
            $params = array();
            /** On veut déplacer le fichier */
            if (isset($request->moveUp)) {
                /**
                 * On veut déplacer vers le haut
                 * On va donc augmenter la valeur de la position
                 */
                $positionInitiale = $carrousel['position'];
                if ($request->moveUp) {
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
                    Llv_Entity_Cms_Dal_Carrousel::getInstance()->_name,
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
                Llv_Entity_Cms_Dal_Carrousel::getInstance()->_name,
                $params,
                'id = ' . $carrousel['id']
            );
        }
        return false;
    }

    /**
     * @static
     *
     * @param Llv_Entity_Cms_Request_Carrousel $request
     *
     * @return bool|int
     */
    public static function deleteRow(Llv_Entity_Cms_Request_Carrousel $request)
    {
        $filter = new Llv_Entity_Cms_Filter_Carrousel();
        $filter->id = $request->id;
        $carrousel = self::getOne($filter);
        if (!is_null($carrousel)) {
            if (self::deleteRowFiles($carrousel)) {
                /** Suppression Définitive */
//                return Llv_Db::getInstance()->delete(
//                    Llv_Entity_Cms_Dal_Carrousel::getInstance()->_name,
//                    'id = ' . $request->id
//                );
                /** Suppression logique */
                $dateDelete = new DateTime();
                $params['date_delete'] = $dateDelete->format(Llv_Constant_Date::FORMAT_DB);
                $params['position'] = 0;
                $params['online'] = false;
                return Llv_Db::getInstance()->update(
                    Llv_Entity_Cms_Dal_Carrousel::getInstance()->_name,
                    $params,
                    'id = ' . $request->id
                );
            }
        }
        return false;
    }

    /**
     * @static
     *
     * @param array $carrousel
     *
     * @return bool
     */
    public static function deleteRowFiles(array $carrousel)
    {
        /** On supprime l'image associée */
        $filePath = Llv_Services_Cms_Helper_Carrousel::getCarrouselFilesPath() . $carrousel['filename'];
        $filename = explode('.', $carrousel['filename']);
        unset($filename[count($filename) - 1]);
        $filename = implode('.', $filename);
        if (unlink($filePath)) {
            /** On supprime les miniatures associées */
            $thumbPath = Llv_Services_Cms_Helper_Carrousel::getCarrouselFilesPath() . '_thumb/';
            $directory = opendir($thumbPath);
            while (($file = readdir($directory)) !== false) {
                $explodedFile = explode('_thumb_', $file);
                if ($explodedFile[0] == $filename) {
                    unlink($thumbPath . $file);
                }
            }
            return true;
        }
        return false;
    }
}