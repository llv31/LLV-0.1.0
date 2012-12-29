<?php
/**
 * PHP Class Route.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Route_Dal_Route
    extends Zend_Db_Table_Abstract
{
    protected static $_nameTable = "route";
    protected static $_nameTrad = "route_language";
    protected static $_nameParams = "route_parameters";
    protected $_rowClass = "Llv_Entity_Dal_Row_Abstract";
    protected static $_instance;


    /**
     * @static
     * @return mixed
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
     * @param Llv_Entity_Route_Filter_Route $filter
     */
    public static function getAll(Llv_Entity_Route_Filter_Route $filter)
    {
        try {
            $sql = Llv_Db::getInstance()->select()
                ->from(array('r'=> self::$_nameTable))
                ->joinLeft(
                array(
                     'rl'=> self::$_nameTrad
                ),
                'r.id = rl.route_id',
                array('value')
            )
                ->joinLeft(
                array('l'=> 'language'),
                'l.id = rl.language_id',
                array('label', 'locale', 'short_tag')
            );

            if (isset($filter->idLangue)) {
                $sql->where('l.id = ?', $filter->idLangue);
            }
            return Llv_Db::getInstance()->fetchAll($sql);
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        return array();
    }
}