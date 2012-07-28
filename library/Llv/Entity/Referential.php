<?php
/**
 * PHP Class Referential.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 20/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Referential
    extends Llv_Entity_Abstract
    implements Llv_Entity_Referential_Interface
{

    /**
     * Retourne la liste des modules
     *
     * @param Llv_Entity_Referential_Filter_Modules $filter
     *
     * @return array|mixed
     */
    public function getModules(Llv_Entity_Referential_Filter_Modules $filter)
    {
        return Llv_Entity_Referential_Dal_Modules::getAll($filter);
    }

    /**
     * Retourne un module
     *
     * @param Llv_Entity_Referential_Filter_Module $filter
     *
     * @return mixed
     */
    public function getModule(Llv_Entity_Referential_Filter_Module $filter)
    {
        return Llv_Entity_Referential_Dal_Modules::getOneBySiteId($filter->idSite);
    }

    /**
     * Retourne la liste des langues du site
     * @return Llv_Dto_Language
     */
    public function getLanguages()
    {
        return Llv_Entity_Referential_Helper_Language::convertFromDalToDtoAll(
            Llv_Entity_Referential_Dal_Language::getAll()
        );
    }
}