<?php
/**
 * PHP Class User.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Services_User
{
    /** @var $_entity Llv_Entity_User */
    protected static $_entity;

    /**
     * @return \Llv_Entity_User
     */
    public static function getEntity()
    {
        return self::$_entity;
    }

    public function __construct($entity = null)
    {
        if (is_null($entity)) {
            self::$_entity = new Llv_Entity_User();
        } elseif ($entity instanceof Llv_Entity_User_Interface) {
            self::$_entity = $entity;
        } else {
            throw new InvalidArgumentException(_('ERROR_EXCEPTION_INVALIDARGUMENT'));
        }
    }

    /**
     * Retourne un message en fonction de son id
     * @param Llv_Services_Message_Header    $header
     * @param Llv_Services_User_Request_User $request
     *
     * @return Llv_Services_User_Message_User
     */
    public function getOneById(
        Llv_Services_Message_Header $header,
        Llv_Services_User_Request_User $request
    )
    {
        $message = new Llv_Services_User_Message_User();
        try {
            $entityFilter = new Llv_Entity_User_Filter_User();
            $entityFilter->id = $request->id;
            $message->user = $this->getEntity()->getUser($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }

    /**
     * Retourne un message en fonction de son login et son mot de passe
     * @param Llv_Services_Message_Header    $header
     * @param Llv_Services_User_Request_User $request
     *
     * @return Llv_Services_User_Message_User
     */
    public function getUserByCreditential(
        Llv_Services_Message_Header $header,
        Llv_Services_User_Request_User $request
    )
    {
        $message = new Llv_Services_User_Message_User();
        try {
            $entityFilter = new Llv_Entity_User_Filter_User();
            $entityFilter->login = $request->login;
            $entityFilter->password = $request->password;
            $message->user = $this->getEntity()->getUser($entityFilter);
            $message->success = true;
        } catch (Exception $e) {
            $message->errorList[] = $e;
        }
        return $message;
    }
}