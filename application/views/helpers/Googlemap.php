<?php
/**
 * PHP Class GoogleMap.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 15/12/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_Googlemap
    extends Zend_View_Helper_Abstract
{
    public function googlemap()
    {
        $filter = new Llv_Services_Product_Filter_Category();
        $categories = Llv_Context_Product::getInstance()->categoryGetAll($filter);
        $result = array();
        /** @var $categorie Llv_Dto_Product_Category */
        foreach ($categories as $categorie) {
            $result[$categorie->id] = array(
                "couleur"   => $categorie->pinColor,
                "latitude"  => $categorie->location->latitude,
                "longitude" => $categorie->location->longitude,
                "html"      => implode(
                    PHP_EOL,
                    array(
                         "<ul class=\"adresse\">",
                         "<li><strong>" . $categorie->title . "</strong></li>",
                         "<li class=\"type\">(" . _('CONTACT_CATEGORY_TYPE' . $categorie->id) . ")</li>",
                         "<li>" . $categorie->adresse . "</li>",
                         "<li class=\"phone\"><span>" . _('GLOBAL_COORDONNEES_TELEPHONE_LABEL') . "</span>&nbsp;"
                             . _('GLOBAL_COORDONNEES_TELEPHONE') . "</li>",
                         "<li class=\"mobile\"><span>" . _('GLOBAL_COORDONNEES_MOBILE_LABEL') . "</span>&nbsp;"
                             . _('GLOBAL_COORDONNEES_MOBILE') . "</li>",
                         "<li class=\"localisation\"><span>" . _('GLOBAL_COORDONNEES_GPS_LABEL') . "</span>&nbsp;
                         <a href=\"https://maps.google.fr/maps?q=" . $categorie->location->value . "\" target=\"_blank\">"
                             . $categorie->location->value . "</a></li>",
                         "</ul>"
                    )
                )
            );
        }
        $result['centerOn']['lat'] = _('CONTACT_CENTER_COORDINATES_LAT');
        $result['centerOn']['long'] = _('CONTACT_CENTER_COORDINATES_LONG');
        return Zend_Json::encode($result);
    }
}