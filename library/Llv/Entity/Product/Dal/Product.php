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

class Llv_Entity_Product_Dal_Product
    extends Zend_Db_Table_Abstract
{
    protected static $_nameTable = "product";
    protected static $_nameTrad = "product_language";
    protected static $_nameFile = "product_illustration";
    protected static $_namePriceNight = "product_night_price";
    protected static $_namePriceSeason = "product_season_price";
    protected static $_nameSeasonType = "season_type";
    protected static $_nameSeasonTypeTrad = "season_type_language";
    protected static $_nameCategory = "product_category";

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
     * @param Llv_Entity_Product_Filter_Product $filter
     *
     * @return array
     */
    public static function getOne(Llv_Entity_Product_Filter_Product $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('p'=> self::$_nameTable))
                ->joinLeft(
                array(
                     'pl'=> self::$_nameTrad
                ),
                'p.id = pl.product_id',
                array('title', 'content', 'introduction', 'language_id')
            )
                ->joinLeft(
                array('l'=> 'language'),
                'l.id = pl.language_id',
                array('label', 'locale', 'short_tag')
            );

            if (isset($filter->id)) {
                $sql->where('p.id = ?', $filter->id);
            } else if (isset($filter->url)) {
                $sql->where('p.url = ?', $filter->url);
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
     * @param Llv_Entity_Product_Filter_Product $filter
     *
     * @return array
     */
    public static function getAll(Llv_Entity_Product_Filter_Product $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('p'=> self::$_nameTable))
                ->joinLeft(
                array(
                     'pl'=> self::$_nameTrad
                ),
                'p.id = pl.product_id',
                array('title', 'content', 'introduction', 'language_id')
            )
                ->joinLeft(
                array('l'=> 'language'),
                'l.id = pl.language_id',
                array('label', 'locale', 'short_tag')
            );

            if (isset($filter->exceptThisId)) {
                $sql->where('p.id NOT IN (?)', $filter->exceptThisId);
            }

            if (isset($filter->idCategory)) {
                $sql->where('p.product_category_id = ?', $filter->idCategory);
            }

            if (isset($filter->idLangue)) {
                $sql->where('l.id = ?', $filter->idLangue);
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
     * @param Llv_Entity_Product_Request_Edit $request
     *
     * @return bool|int
     */
    public static function addRow(Llv_Entity_Product_Request_Edit $request)
    {
        try {
            $params = array();
            $params['product_category_id'] = $request->idCategorie;
            $params['position'] = self::getLastOrder() + 1;
//            $params['location'] = $request->coordonnees;
            if (isset($request->online)) {
                $params['online'] = !is_null($request->online) ? $request->online : false;
            }
            if ($request->dateAdd instanceof DateTime) {
                $params['date_add'] = $request->dateAdd->format(Llv_Constant_Date::FORMAT_DB);
            }
            if ($request->dateUpdate instanceof DateTime) {
                $params['date_update'] = $request->dateUpdate->format(Llv_Constant_Date::FORMAT_DB);
            }
            if ($request->dateDelete instanceof DateTime) {
                $params['date_delete'] = $request->dateDelete->format(Llv_Constant_Date::FORMAT_DB);
            }
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
     * @param Llv_Entity_Product_Request_Edit $request
     *
     * @return bool|int
     */
    public static function updateRow(Llv_Entity_Product_Request_Edit $request)
    {
        try {
            $params = array();
            if (isset($request->show) || isset($request->moveUp)) {
                $filter = new Llv_Entity_Product_Filter_Product();
                $filter->id = $request->id;
                $product = self::getOne($filter);
                /** On veut déplacer le fichier */
                if (isset($request->moveUp)) {
                    $positionInitiale = $product['position'];
                    if ($request->moveUp) {
                        $nouvellePosition = $positionInitiale + 1;
                        $params['position'] = $positionInitiale;
                        $where = 'position > ' . $positionInitiale . ' AND ' . 'position <= ' . $nouvellePosition;
                    } else {
                        $nouvellePosition = $positionInitiale - 1;
                        $nouvellePosition = $nouvellePosition > 0 ? $nouvellePosition : 1;
                        $params['position'] = $positionInitiale;
                        $where = 'position < ' . $positionInitiale . ' AND ' . 'position >= ' . $nouvellePosition;
                    }
                    $where .= ' AND date_delete is null';
                    Llv_Db::getInstance()->update(
                        self::$_nameTable,
                        $params,
                        $where
                    );
                    $params['position'] = $nouvellePosition;
                }
                if (isset($request->show)) {
                    $params['online'] = $request->show;
                }
            } else {
                if (!is_null($request->idCategorie)) {
                    $params['product_category_id'] = $request->idCategorie;
                }
                if (!is_null($request->availability)) {
                    $params['availability'] = $request->availability;
                }
                if (!is_null($request->position)) {
                    $params['position'] = $request->position;
                }
                if (isset($request->online)) {
                    $params['online'] = !is_null($request->online) ? $request->online : true;
                }
//                if ($request->dateAdd instanceof DateTime) {
//                    $params['date_add'] = $request->dateAdd->format(Llv_Constant_Date::FORMAT_DB);
//                }
//                if ($request->dateUpdate instanceof DateTime) {
//                    $params['date_update'] = $request->dateUpdate->format(Llv_Constant_Date::FORMAT_DB);
//                }
//                if ($request->dateDelete instanceof DateTime) {
//                    $params['date_delete'] = $request->dateDelete->format(Llv_Constant_Date::FORMAT_DB);
//                }
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

    /**
     * @static
     *
     * @param Llv_Entity_Product_Filter_Product $filter
     *
     * @return null
     */
    public static function deleteRow(Llv_Entity_Product_Filter_Product $filter)
    {
        try {
            $file = self::getOne($filter);
            $date = new DateTime();
            $params['date_delete'] = $date->format(Llv_Constant_Date::FORMAT_DB);
            Llv_Db::getInstance()->update(
                self::$_nameTable,
                $params,
                'id = ' . $filter->id
            );
            return $file['product_id'];
        } catch (Exception $e) {
            Zend_Debug::dump($e);
            error_log($e);
            return null;
        }
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Product_Request_EditContent $request
     *
     * @return int
     */
    public static function addRowContent(Llv_Entity_Product_Request_EditContent $request)
    {
        try {
            $params = array();
            $params['product_id'] = $request->idProduct;
            $params['language_id'] = $request->idLangue;
            $params['title'] = $request->title;
            $params['content'] = $request->content;
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
     * @param Llv_Entity_Product_Request_EditContent $request
     *
     * @return int
     */
    public static function updateRowContent(Llv_Entity_Product_Request_EditContent $request)
    {
        try {
            $params = array();
            $where = 'product_id = ' . $request->idProduct . ' AND language_id = ' . $request->idLangue;
            $params['title'] = $request->title;
            $params['content'] = $request->content;
            $params['introduction'] = $request->introduction;
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
     * @param Llv_Entity_Product_Request_EditSeason $request
     *
     * @return int
     */
    public static function updateRowTarifSeason(Llv_Entity_Product_Request_EditSeason $request)
    {
        try {
            $params = array();
            $where = 'product_id = ' . $request->idProduct . ' AND season_type_id = ' . $request->idSeason;
            $params['week'] = strlen($request->week) > 0 ? $request->week : null;
            $params['weekend'] = strlen($request->weekend) > 0 ? $request->weekend : null;
            $params['midweek'] = strlen($request->midweek) > 0 ? $request->midweek : null;
            return Llv_Db::getInstance()
                ->update(
                self::$_namePriceSeason,
                $params,
                $where
            );
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
    }

    /**
     * @static
     *
     * @param Llv_Entity_Product_Request_EditNight $request
     *
     * @return int
     */
    public static function updateRowTarifNight(Llv_Entity_Product_Request_EditNight $request)
    {
        try {
            $params = array();
            $where = 'product_id = ' . $request->idProduct;
            $params['one'] = strlen($request->one) > 0 ? $request->one : null;
            $params['two'] = strlen($request->two) > 0 ? $request->two : null;
            $params['three'] = strlen($request->three) > 0 ? $request->three : null;
            $params['four'] = strlen($request->four) > 0 ? $request->four : null;
            return Llv_Db::getInstance()
                ->update(
                self::$_namePriceNight,
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
     * @param Llv_Entity_Product_Filter_File $filter
     *
     * @return array
     */
    public static function getProductFile(Llv_Entity_Product_Filter_File $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(self::$_nameFile)
                ->where('date_delete is null')
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
     * @param Llv_Entity_Product_Filter_File $filter
     *
     * @return array
     */
    public static function getProductFiles(Llv_Entity_Product_Filter_File $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(self::$_nameFile)
                ->where('product_id = ?', $filter->idProduct)
                ->where('date_delete is null')
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
     * @param Llv_Entity_Product_Request_File $request
     *
     * @return bool|int
     */
    public static function addRowFile(Llv_Entity_Product_Request_File $request)
    {
        try {
            $params = array();
            $params['product_id'] = $request->idProduct;
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
     * @param Llv_Entity_Product_Request_File $request
     *
     * @return bool
     */
    public static function updateRowFile(Llv_Entity_Product_Request_File $request)
    {
        $filter = new Llv_Entity_Product_Filter_File();
        $filter->id = $request->id;
        $file = self::getProductFile($filter);
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
                $where .= ' AND date_delete is null';
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
            return self::getProductFile($filter);
        }
        return false;
    }

    /**
     * Suppression logique
     *
     * @static
     *
     * @param Llv_Entity_Product_Filter_File $filter
     *
     * @return int|null
     */
    public static function deleteRowFile(Llv_Entity_Product_Filter_File $filter)
    {
        try {
            $file = self::getProductFile($filter);
            $date = new DateTime();
            $params['date_delete'] = $date->format(Llv_Constant_Date::FORMAT_DB);
            $params['position'] = 0;
            Llv_Db::getInstance()->update(
                self::$_nameFile,
                $params,
                'id = ' . $filter->id
            );
            return $file['filename'];
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

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    public static function getPriceForProduct(Llv_Entity_Product_Filter_Product $filter)
    {
        try {
            if (!is_null($filter->priceType) && Llv_Constant_Product_Price_Type::isValid($filter->priceType)) {
                $table = null;
                switch ($filter->priceType) {
                    case Llv_Constant_Product_Price_Type::NUIT:
                        $sql = Llv_Db::getInstance()->select()
                            ->from(array('p'=> self::$_namePriceNight))
                            ->where('product_id = ?', $filter->id);
                        break;
                    case Llv_Constant_Product_Price_Type::SAISON:
                        $sql = Llv_Db::getInstance()->select()
                            ->from(array('p'=> self::$_namePriceSeason))
                            ->joinLeft(
                            array('st'=> self::$_nameSeasonType),
                            'p.season_type_id = st.id',
                            array('')
                        )
                            ->joinLeft(
                            array('stl'=> self::$_nameSeasonTypeTrad),
                            'st.id = stl.type_id'
                        )
                            ->joinLeft(
                            array('l'=> 'language'),
                            'stl.language_id = l.id',
                            array('')
                        )
                            ->where('product_id = ?', $filter->id);
                        break;
                }
                return Llv_Db::getInstance()->fetchAll($sql);
            }
        } catch (Exception $e) {
            Zend_Debug::dump($e);
            error_log($e);
            return null;
        }
    }

}