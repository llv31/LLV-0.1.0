<?php
/**
 * PHP Class Llv_Router.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Router extends Zend_Controller_Router_Rewrite
{
    /** @var int */
    protected $_idLangue;
    /** @var string */
    protected $_module;

    /**
     * @param int $idLangue
     */
    public function setIdLangue($idLangue)
    {
        $this->_idLangue = $idLangue;
    }

    /**
     * @return int
     */
    public function getIdLangue()
    {
        return $this->_idLangue;
    }

    /**
     * @param string $module
     */
    public function setModule($module)
    {
        $this->_module = $module;
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->_module;
    }
}