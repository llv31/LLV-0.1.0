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

class Llv_Entity_Product_Dal_Season
    extends Zend_Db_Table_Abstract
{
    protected static $_nameTable = "season_type";
    protected static $_nameTrad = "season_type_language";
    protected static $_nameWeek = "season_week";

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
     * @param Llv_Entity_Product_Filter_Season $filter
     *
     * @return array|null
     */
    public static function getAll(Llv_Entity_Product_Filter_Season $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('st'=> self::$_nameTable))
                ->joinLeft(
                array('stl'=> self::$_nameTrad),
                'st.id = stl.type_id'
            )
                ->joinLeft(
                array('l'=> 'language'),
                'stl.language_id = l.id',
                array('')
            );
            if ($filter->idLangue) {
                $sql->where('stl.language_id = ?', $filter->idLangue);
            }
            return Llv_Db::getInstance()->fetchAll($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
            error_log($e);
            return null;
        }
    }

    /**
     * @static
     *
     * @param Llv_Entity_Product_Filter_Season $filter
     *
     * @return array|null
     */
    public static function getAllWeeks(Llv_Entity_Product_Filter_Season $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('sw'=> self::$_nameWeek));
            if ($filter->idSeasonType) {
                $sql->where('type_id = ?', $filter->idSeasonType);
            }
            if ($filter->weekNumber) {
                $sql->where('number = ?', $filter->weekNumber);
            }
            if ($filter->dateDebut) {
                $sql->where('date_begining >= ?', $filter->dateDebut->format(Llv_Constant_Date::FORMAT_DB));
            }
            if ($filter->dateFin) {
                $sql->where('date_ending <= ?', $filter->dateFin->format(Llv_Constant_Date::FORMAT_DB));
            }
            print($sql->assemble());
            return Llv_Db::getInstance()->fetchAll($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
            error_log($e);
            return null;
        }
    }

    /**
     * @static
     *
     * @param Llv_Entity_Product_Request_Season $request
     *
     * @return bool
     */
    public static function weekUpdateLot(Llv_Entity_Product_Request_Season $request)
    {
        try {
            foreach ($request->idWeekList as $idWeek) {
                $params = array();
                $params['type_id'] = $request->id;
                Llv_Db::getInstance()->update(
                    self::$_nameWeek,
                    $params,
                    'id = ' . $idWeek
                );
            }
            return true;
        } catch (Exception $e) {
            Zend_Debug::dump($e);
            error_log($e);
            return false;
        }
    }

    /**
     * @static
     *
     * @param Llv_Entity_Product_Filter_Season $filter
     *
     * @return mixed|null
     */
    public static function getOneWeek(Llv_Entity_Product_Filter_Season $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('sw'=> self::$_nameWeek));
            if ($filter->id) {
                $sql->where('id = ?', $filter->id);
            }
            if ($filter->idSeasonType) {
                $sql->where('type_id = ?', $filter->idSeasonType);
            }
            if ($filter->weekNumber) {
                $sql->where('number = ?', $filter->weekNumber);
            }
            if ($filter->dateDebut) {
                $sql->where('date_begining <= ?', $filter->dateDebut->format(Llv_Constant_Date::FORMAT_DB))
                    ->order('date_begining DESC');
            }
            if ($filter->dateFin) {
                if ($filter->dateDebut) {
                    $sql->orWhere('date_ending <= ?', $filter->dateFin->format(Llv_Constant_Date::FORMAT_DB));
                } else {
                    $sql->where('date_ending <= ?', $filter->dateFin->format(Llv_Constant_Date::FORMAT_DB));
                }
            }
            return Llv_Db::getInstance()->fetchRow($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
            error_log($e);
            return null;
        }
    }

}