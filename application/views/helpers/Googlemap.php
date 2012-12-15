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
        return Zend_Json::encode(
            array(
                 array(
                     "couleur"   => 'yellow',
                     "latitude"  => 42.812443,
                     "longitude" => 0.484208,
                     "html"      => implode(
                         PHP_EOL,
                         array(
                              "<ul class=\"adresse\">",
                              "<li><strong>Etch Soulet</strong></li>",
                              "<li>ADRESSE</li>",
                              "<li>CODE POSTAL - VILLE</li>",
                              "<li class=\"phone\">" . _('GLOBAL_COORDONNEES_TELEPHONE_LABEL') . "&nbsp;" . _('GLOBAL_COORDONNEES_TELEPHONE') . "</li>",
                              "<li class=\"mobile\">" . _('GLOBAL_COORDONNEES_MOBILE_LABEL') . "&nbsp;" . _('GLOBAL_COORDONNEES_MOBILE') . "</li>",
                              "</ul>"
                         )
                     )
                 ),
                 array(
                     "couleur"   => 'red',
                     "latitude"  => 42.782654,
                     "longitude" => 0.601339,
                     "html"      => implode(
                         PHP_EOL,
                         array(
                              "<ul class=\"adresse\">",
                              "<li><strong>Au delà du temps</strong></li>",
                              "<li>ADRESSE</li>",
                              "<li>CODE POSTAL - VILLE</li>",
                              "<li class=\"phone\">" . _('GLOBAL_COORDONNEES_TELEPHONE_LABEL') . "&nbsp;" . _('GLOBAL_COORDONNEES_TELEPHONE') . "</li>",
                              "<li class=\"mobile\">" . _('GLOBAL_COORDONNEES_MOBILE_LABEL') . "&nbsp;" . _('GLOBAL_COORDONNEES_MOBILE') . "</li>",
                              "</ul>"
                         )
                     )
                 ),
            )
        );
    }
}