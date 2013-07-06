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
require_once APPLICATION_PATH . '/../library/Sitemap/Generator.php';

$sites = Llv_Config::getInstance()->get('sites')->toArray();

echo date('d-m-Y H:i:s') . PHP_EOL;
foreach ($sites as $site) {
    if ($site['front']) {
        $url = 'http://' . $site['host'];
        $lang = substr($site['locale'], 0, 2);

        $sitemapFile = APPLICATION_PATH . '/../public/referencement/sitemap-' . $lang . '.xml';
        $sitemapGenerator = new Sitemap_Generator($url);
        $f = fopen($sitemapFile, "w+");
        fwrite($f, $sitemapGenerator->generateSiteMap());
        fclose($f);
        echo $url . ' => ' . $sitemapFile . PHP_EOL;
    }
}
echo date('d-m-Y H:i:s') . PHP_EOL;
