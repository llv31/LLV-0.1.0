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

class Llv_Services_Route
{
    /** @var $_entity Llv_Entity_Route */
    protected static $_entity;

    /**
     * @return \Llv_Entity_Route
     */
    public static function getEntity()
    {
        return self::$_entity;
    }

    public function __construct($entity = null)
    {
        if (is_null($entity)) {
            self::$_entity = new Llv_Entity_Route();
        } elseif ($entity instanceof Llv_Entity_Route_Interface) {
            self::$_entity = $entity;
        } else {
            throw new InvalidArgumentException(_('ERROR_EXCEPTION_INVALIDARGUMENT'));
        }
    }

    /**
     * @param Llv_Services_Message_Header     $header
     * @param Llv_Services_Route_Filter_Route $filter
     *
     * @return Llv_Services_Route_Message_Route
     */
    public function getAll(
        Llv_Services_Message_Header $header,
        Llv_Services_Route_Filter_Route $filter
    )
    {
        $message = new Llv_Services_Route_Message_Route();
        try {
            $entityFilter = new Llv_Entity_Route_Filter_Route();
            $entityFilter->idLangue = $filter->idLangue;
            $message->routes = $this->getEntity()->getAll($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }
}