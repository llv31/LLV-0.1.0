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

class Llv_Entity_User
    implements Llv_Entity_User_Interface
{

    /**
     * @param Llv_Entity_User_Filter_User $filter
     *
     * @return Llv_Dto_User|null
     */
    public function getUser(Llv_Entity_User_Filter_User $filter)
    {
        if (isset($filter->id)) {
            return Llv_Entity_User_Helper_User::convertFromDalToDto(
                Llv_Entity_User_Dal_User::getOne($filter->id)
            );
        } elseif (isset($filter->login) && isset($filter->password)) {
            return Llv_Entity_User_Helper_User::convertFromDalToDto(
                Llv_Entity_User_Dal_User::getOneByCreditentials($filter->login, $filter->password)
            );
        }
        return null;
    }
}