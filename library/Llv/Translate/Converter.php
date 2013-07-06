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
     * @param $outputDir
     *
     * @return bool
     */
    public function writeMos($outputDir)
    {
        $result = false;
        foreach ($this->_locales as $locale) {
            $moDir = $outputDir . '/' . $locale . '/LC_MESSAGES';
            $inputFile = $moDir . '/application.po';
            $result = $this->phpmo_convert($inputFile);
        }
        return $result;
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

    /******************************************************************/



    /**
     * The main .po to .mo function
     */
    public function phpmo_convert($input, $output = false)
    {
        if (!$output)
            $output = str_replace('.po', '.mo', $input);
        $hash = $this->phpmo_parse_po_file($input);
        if ($hash === false) {
            return false;
        } else {
            $this->phpmo_write_mo_file($hash, $output);
            return true;
        }
    }

    function phpmo_clean_helper($x)
    {
        if (is_array($x)) {
            foreach ($x as $k => $v) {
                $x[$k] = $this->phpmo_clean_helper($v);
            }
        } else {
            if ($x[0] == '"')
                $x = substr($x, 1, -1);
            $x = str_replace("\"\n\"", '', $x);
            $x = str_replace('$', '\\$', $x);
        }
        return $x;
    }

    /* Parse gettext .po files. */
    /* @link http://www.gnu.org/software/gettext/manual/gettext.html#PO-Files */
    function phpmo_parse_po_file($in)
    {
        // read .po file
        $fh = fopen($in, 'r');
        if ($fh === false) {
            // Could not open file resource
            return false;
        }

        // results array
        $hash = array();
        // temporary array
        $temp = array();
        // state
        $state = null;
        $fuzzy = false;

        // iterate over lines
        while (($line = fgets($fh, 65536)) !== false) {
            $line = trim($line);
            if ($line === '')
                continue;

            list ($key, $data) = preg_split('/\s/', $line, 2);

            switch ($key) {
                case '#,' : // flag...
                    $fuzzy = in_array('fuzzy', preg_split('/,\s*/', $data));
                case '#' : // translator-comments
                case '#.' : // extracted-comments
                case '#:' : // reference...
                case '#|' : // msgid previous-untranslated-string
                    // start a new entry
                    if (sizeof($temp) && array_key_exists('msgid', $temp) && array_key_exists('msgstr', $temp)) {
                        if (!$fuzzy)
                            $hash[] = $temp;
                        $temp = array();
                        $state = null;
                        $fuzzy = false;
                    }
                    break;
                case 'msgctxt' :
                    // context
                case 'msgid' :
                    // untranslated-string
                case 'msgid_plural' :
                    // untranslated-string-plural
                    $state = $key;
                    $temp[$state] = $data;
                    break;
                case 'msgstr' :
                    // translated-string
                    $state = 'msgstr';
                    $temp[$state][] = $data;
                    break;
                default :
                    if (strpos($key, 'msgstr[') !== FALSE) {
                        // translated-string-case-n
                        $state = 'msgstr';
                        $temp[$state][] = $data;
                    } else {
                        // continued lines
                        switch ($state) {
                            case 'msgctxt' :
                            case 'msgid' :
                            case 'msgid_plural' :
                                $temp[$state] .= "\n" . $line;
                                break;
                            case 'msgstr' :
                                $temp[$state][sizeof($temp[$state]) - 1] .= "\n" . $line;
                                break;
                            default :
                                // parse error
                                fclose($fh);
                                return FALSE;
                        }
                    }
                    break;
            }
        }
        fclose($fh);

        // add final entry
        if ($state == 'msgstr')
            $hash[] = $temp;

        // Cleanup data, merge multiline entries, reindex hash for ksort
        $temp = $hash;
        $hash = array();
        foreach ($temp as $entry) {
            foreach ($entry as & $v) {
                $v = $this->phpmo_clean_helper($v);
                if ($v === FALSE) {
                    // parse error
                    return FALSE;
                }
            }
            $hash[$entry['msgid']] = $entry;
        }

        return $hash;
    }

    /* Write a GNU gettext style machine object. */
    /* @link http://www.gnu.org/software/gettext/manual/gettext.html#MO-Files */
    function phpmo_write_mo_file($hash, $out)
    {
        // sort by msgid
        ksort($hash, SORT_STRING);
        // our mo file data
        $mo = '';
        // header data
        $offsets = array();
        $ids = '';
        $strings = '';

        foreach ($hash as $entry) {
            $id = $entry['msgid'];
            if (isset ($entry['msgid_plural']))
                $id .= "\x00" . $entry['msgid_plural'];
            // context is merged into id, separated by EOT (\x04)
            if (array_key_exists('msgctxt', $entry))
                $id = $entry['msgctxt'] . "\x04" . $id;
            // plural msgstrs are NUL-separated
            $str = implode("\x00", $entry['msgstr']);
            // keep track of offsets
            $offsets[] = array(
                strlen($ids
                ), strlen($id), strlen($strings), strlen($str)
            );
            // plural msgids are not stored (?)
            $ids .= $id . "\x00";
            $strings .= $str . "\x00";
        }

        // keys start after the header (7 words) + index tables ($#hash * 4 words)
        $key_start = 7 * 4 + sizeof($hash) * 4 * 4;
        // values start right after the keys
        $value_start = $key_start + strlen($ids);
        // first all key offsets, then all value offsets
        $key_offsets = array();
        $value_offsets = array();
        // calculate
        foreach ($offsets as $v) {
            list ($o1, $l1, $o2, $l2) = $v;
            $key_offsets[] = $l1;
            $key_offsets[] = $o1 + $key_start;
            $value_offsets[] = $l2;
            $value_offsets[] = $o2 + $value_start;
        }
        $offsets = array_merge($key_offsets, $value_offsets);

        // write header
        $mo .= pack('Iiiiiii', 0x950412de, // magic number
            0, // version
            sizeof($hash), // number of entries in the catalog
            7 * 4, // key index offset
            7 * 4 + sizeof($hash) * 8, // value index offset,
            0, // hashtable size (unused, thus 0)
            $key_start // hashtable offset
        );
        // offsets
        foreach ($offsets as $offset)
            $mo .= pack('i', $offset);
        // ids
        $mo .= $ids;
        // strings
        $mo .= $strings;

        file_put_contents($out, $mo);
    }
}