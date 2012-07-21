<?php
/**
 * PHP Class Converter.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Translate_Converter
{
    /** @var array */
    private $_locales;

    private $_entries;


    /**
     * @param $adapter Llv_Translate_Adapter_Abstract
     */
    private function treatAdapter($adapter)
    {
        $locales = $adapter->getLocales();
        $this->_locales = array_merge($this->_locales, $locales);
        foreach ($locales as $locale) {
            foreach ($adapter->getEntries($locale) as $entry) {
                $this->_entries[$locale][] = $entry;
            }
        }
    }

    function __construct()
    {
        $this->_locales = array();
        $this->_entries = array();
    }

    /**
     * Ajoute un nouvel adapter
     *
     * @param Llv_Translate_Adapter_Abstract $adapter
     */
    public function addAdapter(Llv_Translate_Adapter_Abstract $adapter)
    {
        $adapter->init();
        $this->treatAdapter($adapter);
    }

    /**
     * @param $outputDir
     *
     * @return array
     */
    public function writePos($outputDir)
    {
        $files = array();
        foreach ($this->_locales as $locale) {
            $poDir = $outputDir . '/' . $locale . '/LC_MESSAGES';
            if (!file_exists($poDir)) {
                mkdir($poDir, 0777, true);
            }
            $outputFile = $poDir . '/application.po';

            $handler = fopen($outputFile, 'w');
            // PO Header
            fprintf($handler, 'msgid ""' . "\n");
            fprintf($handler, 'msgstr ""' . "\n");
            fprintf($handler, '"Content-Type: text/plain; charset=UTF-8"' . "\n");

            foreach ($this->_entries[$locale] as $entry) {
                /** @var $entry Llv_Translate_Entry */
                if ($entry->getValue() != "") {
                    $flags = $entry->getFlags();
                    if (is_array($flags) && count($flags)) {
                        fprintf(
                            $handler,
                            '#. %s' . "\n", implode(',', $flags)
                        );
                    }
                    fprintf(
                        $handler,
                        'msgid "%s"' . "\n", $this->convertString($entry->getKey())
                    );
                    fprintf(
                        $handler,
                        'msgstr "%s"' . "\n", $this->convertString($entry->getValue())
                    );
                }
            }
            fclose($handler);
            $files[] = $outputFile;
        }
        return $files;
    }

    /**
     * @param $str
     *
     * @return string
     */
    private function convertString($str)
    {
        return addcslashes($str, '"');
    }

    /**
     * @param        $outputFileFormat
     * @param string $flag
     */
    public function writeToJsArray($outputFileFormat, $flag = 'js')
    {
        foreach ($this->_locales as $locale) {
            if (isset($this->_entries[$locale])) {
                $outFile = sprintf($outputFileFormat, $locale);
                $outDir = dirname($outFile);
                if (!file_exists($outDir)) {
                    mkdir($outDir, 0777, true);
                }
                $handler = fopen($outFile, 'w');
                fprintf($handler, "var localizedStrings = {\n");
                $matchingEntries = array_filter(
                    $this->_entries[$locale],
                    function ($entry) use ($flag)
                    {
                        /** @var $entry Llv_Translate_Entry */
                        return in_array($flag, $entry->getFlags());
                    }
                );
                array_walk(
                    $matchingEntries,
                    function (&$item, $key)
                    {
                        /** @var $item Llv_Translate_Entry */
                        $item = sprintf('"%s" : "%s"', $item->getKey(), $item->getValue());
                    }
                );
                fprintf($handler, "%s\n}\n", implode(",\n", $matchingEntries));
                fclose($handler);
            }
        }
    }
}