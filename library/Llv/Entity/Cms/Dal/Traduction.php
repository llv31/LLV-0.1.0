<?php
/**
 * PHP Class Page.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 27/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Cms_Dal_Traduction
    extends Zend_Db_Table_Abstract
{
    protected static $_instance;
    protected static $filepath;
    protected static $fileext;
    protected static $builderPath;

    /**
     * @static
     * @return Llv_Entity_Cms_Dal_Traduction
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     *
     */
    public function __construct()
    {
        self::$filepath = APPLICATION_PATH . '/../data/locales/';
        self::$builderPath = APPLICATION_PATH . '/../scripts/job/build_translation.php';
        self::$fileext = '.csv';
    }

    /**
     * @static
     *
     * @param Llv_Entity_Cms_Filter_Traduction $request
     *
     * @return mixed
     */
    public function getAll(Llv_Entity_Cms_Filter_Traduction $request)
    {
        $locale = $request->locale->toString();
        $file = self::$filepath . $locale . self::$fileext;
        $fileContent = explode(PHP_EOL, file_get_contents($file));
        $content = array();
        foreach ($fileContent as $key=> $line) {
            $arrayLine = explode(';', $line);
            if (count($arrayLine) > 1 && strlen($arrayLine[0]) > 0) {
                $content[$key]['key_name'] = $arrayLine[0];
                $content[$key]['value'] = $arrayLine[1];
                $content[$key]['locale'] = $locale;
                $content[$key]['private'] = isset($arrayLine[2]) ? $arrayLine[2] : false;
            }
        }
        return $content;
    }

    /**
     * @param Llv_Entity_Cms_Request_Traduction $request
     *
     * @return string
     */
    public function updateAll(Llv_Entity_Cms_Request_Traduction $request)
    {
        foreach ($request->traductions as $locale=> $traductions) {
            $file = self::$filepath . $locale . self::$fileext;
            $lines = array();
            foreach ($traductions as $traduction) {
                $params = array();
                $params[] = $traduction->keyName;
                $params[] = $traduction->value;
                if ($traduction->private) {
                    $params[] = (string)$traduction->private;
                }
                $lines[] = implode(';', $params);
            }
            $document = implode(PHP_EOL, $lines);
            file_put_contents($file, $document);
        }
        return true;
    }
}