<?php
/**
 * PHP Class Abstract.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Dal_Row_Abstract
    extends Zend_Db_Table_Row_Abstract
{
    /**
     * Retourne une valeur de propriété
     * @param $propertyName
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get($propertyName)
    {
        $propertyName = $this->_transformColumn($propertyName);
        if (!in_array($propertyName, $this->_data)) {
            throw new InvalidArgumentException(_('ERROR_EXCEPTION_INVALIDARGUMENT_DAL_ROW_PROPERTYNAME'));
        }
        return $this->_data[$propertyName];
    }
}