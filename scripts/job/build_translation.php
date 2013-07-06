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
$converter->writePos(
    APPLICATION_PATH . '/../data/locales'
);

/** On créé les fichiers PO */
echo "PO Files successfuly generated" . PHP_EOL;

/** On créé les fichiers MO en fonction des PO */
//$converter->writeMos(
//    APPLICATION_PATH . '/../data/locales'
//);
//
///** On créé les fichiers PO */
//echo "MO Files successfuly generated" . PHP_EOL;

