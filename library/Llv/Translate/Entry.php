<?php
/**
 * PHP Class Entry.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Translate_Entry
{
    /** @var Llv_Locale */
    private $_locale;
    /** @var string */
    private $_key;
    /** @var string */
    private $_value;
    /** @var array */
    private $_flags;

    /**
     * @param       $locale
     * @param       $key
     * @param       $value
     * @param array $flags
     */
    public function __construct($locale, $key, $value, $flags = array())
    {
        $this->_locale = $locale;
        $this->_key = $key;
        $this->_value = $value;
        $this->_flag = $flags;
    }

    /**
     * @return array
     */
    public function getFlags()
    {
        return is_array($this->_flags) ? $this->_flags : array();
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->_key;
    }

    /**
     * @return \Llv_Locale
     */
    public function getLocale()
    {
        return $this->_locale;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

}