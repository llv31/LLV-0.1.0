<?php
/**
 * PHP Class Csv.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Translate_Adapter_Csv
    extends Llv_Translate_Adapter_Abstract
{
    const SEPARATOR = '|';
    /** @var string */
    private $_csvPath;

    /**
     * @param $csvPath
     */
    public function __construct($csvPath)
    {
        $this->_csvPath = $csvPath;
    }

    /**
     * Ajoute le slignes CSV au PO
     */
    protected function addEntries()
    {
        foreach (scandir($this->_csvPath) as $file) {
            $pathInfo = pathinfo($file);
            if (isset($pathInfo['extension']) && $pathInfo['extension'] == 'csv') {
                $content = file($this->_csvPath . '/' . $file);
                foreach ($content as $line) {
                    $values = explode(self::SEPARATOR, $line);
                    $key = $values[0];
                    $value = rtrim($values[1]);
                    $flag = isset($values[2]) ? explode(',', rtrim($values[2])) : array();

                    $this->addEntry(
                        new Llv_Translate_Entry(
                            $pathInfo['filename'],
                            $key,
                            $value,
                            $flag
                        )
                    );
                }
            }
        }
    }
}