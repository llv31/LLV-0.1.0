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

abstract class Llv_Translate_Adapter_Abstract
{
    /** @var Llv_Translate_Entry[][] */
    private $_entries = array();

    public function init()
    {
        $this->addEntries();
    }

    /**
     * @return array
     */
    public function getLocales()
    {
        return array_keys($this->_entries);
    }

    /**
     * @param $locale
     *
     * @return Llv_Translate_Entry[]
     */
    public function getEntries($locale)
    {
        return $this->_entries[$locale];
    }

    /**
     * @param Llv_Translate_Entry $entry
     */
    protected function addEntry(Llv_Translate_Entry $entry)
    {
        $this->_entries[$entry->getLocale()][] = $entry;
    }

    protected abstract function addEntries();
}