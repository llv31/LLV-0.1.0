<?php
/**
 * PHP Class Llv_Entity_User_Helper_User.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_User_Helper_User
{
    /**
     * @static
     *
     * @param array $dal
     *
     * @return Llv_Dto_User
     */
    public static function convertFromDalToDto($dal)
    {
        $dto = new Llv_Dto_User();
        $dto->id = $dal['id'];
        $dto->login = $dal['login'];
        $dto->password = $dal['password'];
        return $dto;
    }
}