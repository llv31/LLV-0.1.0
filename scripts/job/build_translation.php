<?php
/**
 * PHP build_translation.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 20/07/12
 * @author      : aroy <contact@aroy.fr>
 */

require_once dirname(__FILE__) . '/../initializer.php';

$converter = new Llv_Translate_Converter();

/** On ajoute les CSV à la liste des fichiers à convertir */
$converter->addAdapter(
    new Llv_Translate_Adapter_Csv(
        APPLICATION_PATH . '/../data/locales/'
    )
);

/** On créé les fichiers PO en fonction des fichiers sources */
$poFiles = $converter->writePos(
    APPLICATION_PATH . '/../data/locales'
);

/** On créé les fichiers MO */
echo "PO File successfuly generated" . PHP_EOL;