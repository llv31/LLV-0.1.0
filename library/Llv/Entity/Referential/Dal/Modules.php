<?php
/**
 * PHP Class Modules.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 20/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Referential_Dal_Modules
{
    /**
     * Retourne un tableau associatif des modules
     * Clé      => Id du module
     * Valeur   => Nom du module
     *
     * @static
     *
     * @param Llv_Entity_Referential_Filter_Modules $filter
     *
     * @return array
     */
    public static function getAll(Llv_Entity_Referential_Filter_Modules $filter)
    {
        return array(
            1 => 'front',
            2 => 'back'
        );
    }

    /**
     * Retourne un module en fonction d'un id de site
     * @static
     *
     * @param $idSite
     *
     * @return null
     */
    public static function getOneBySiteId($idSite)
    {
        $modules = self::getAll(new Llv_Entity_Referential_Filter_Modules());
        if (array_key_exists($idSite, $modules)) {
            return $modules[$idSite];
        }
        return null;
    }
}