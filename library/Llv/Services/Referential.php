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

class Llv_Services_Referential
{
    /** @var $_entity Llv_Entity_Referential */
    protected static $_entity;

    /**
     * @return \Llv_Entity_Referential
     */
    public static function getEntity()
    {
        return self::$_entity;
    }

    /**
     * @param null $entity
     */
    public function __construct($entity = null)
    {
        if (is_null($entity)) {
            self::$_entity = new Llv_Entity_Referential();
        } elseif ($entity instanceof Llv_Entity_Referential_Interface) {
            self::$_entity = $entity;
        } else {
            throw new InvalidArgumentException(_('ERROR_EXCEPTION_INVALIDARGUMENT'));
        }
    }

    /**
     * Retourne la liste des modules
     *
     * @param Llv_Services_Message_Header $header
     *
     * @return Llv_Services_Referential_Message_Modules
     */
    public function getAllModules(Llv_Services_Message_Header $header)
    {
        $message = new Llv_Services_Referential_Message_Modules();
        $filter = new Llv_Entity_Referential_Filter_Modules();
        try {
            $message->modules = $this->getEntity()->getModules($filter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * Retourne un module en fonction d'un id de site
     * @param Llv_Services_Message_Header             $header
     * @param Llv_Services_Referential_Filter_Modules $filter
     *
     * @return Llv_Services_Referential_Message_Modules
     */
    public function getModuleByIdSite(
        Llv_Services_Message_Header $header,
        Llv_Services_Referential_Filter_Modules $filter
    )
    {
        $message = new Llv_Services_Referential_Message_Modules();
        $entityFilter = new Llv_Entity_Referential_Filter_Module();
        $entityFilter->idSite = $filter->idSite;
        try {
            $message->module = $this->getEntity()->getModule($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }
}