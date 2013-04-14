<?php
/**
 * PHP Class Image.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 29/07/12
 * @author      : aroy <contact@aroy.fr>
 */
class App_View_Helper_DisplayProductPrice
    extends Zend_View_Helper_Abstract
{
    /**
     * @param $productPrice
     */
    public function displayProductPrice($productPrice)
    {
        $html[] = "<table>";
        $html[] = "<thead>";
        $html[] = "<tr>";
        if ($productPrice instanceof Llv_Dto_Product_Night_Price) {
            $html[] = "<th>" . _('PRODUCT_PRICE_NIGHT_EMPTY') . "</th>";
            if (isset($productPrice->one) && !is_null($productPrice->one)) {
                $html[] = "<th>" . _('PRODUCT_PRICE_NIGHT_PERSONNES_1') . "</th>";
            }
            if (isset($productPrice->two) && !is_null($productPrice->two)) {
                $html[] = "<th>" . _('PRODUCT_PRICE_NIGHT_PERSONNES_2') . "</th>";
            }
            if (isset($productPrice->three) && !is_null($productPrice->three)) {
                $html[] = "<th>" . _('PRODUCT_PRICE_NIGHT_PERSONNES_3') . "</th>";
            }
            if (isset($productPrice->four) && !is_null($productPrice->four)) {
                $html[] = "<th>" . _('PRODUCT_PRICE_NIGHT_PERSONNES_4') . "</th>";
            }
            $html[] = "</tr>";
            $html[] = "</thead>";
            $html[] = "<tbody>";
            for ($i = 1; $i < 8; $i++) {
                $html[] = "<tr>";
                if ($i < 2) {
                    $label = _('PRODUCT_PRICE_NIGHT_NUIT_SING');
                } else {
                    $label = _('PRODUCT_PRICE_NIGHT_NUIT_PLUR');
                }
                $html[] = "<td>" . $i . "&nbsp;" . $label . "</td>";
                if (isset($productPrice->one) && !is_null($productPrice->one)) {
                    $html[] = "<td>" .
                        $this->calculatePrice($productPrice->one, $i) .
                        "&nbsp;" . _('GLOBAL_MONNAIE') .
                        "</td>";
                }
                if (isset($productPrice->two) && !is_null($productPrice->two)) {
                    $html[] = "<td>" .
                        $this->calculatePrice($productPrice->two, $i) .
                        "&nbsp;" . _('GLOBAL_MONNAIE') .
                        "</td>";
                }
                if (isset($productPrice->three) && !is_null($productPrice->three)) {
                    $html[] = "<td>" .
                        $this->calculatePrice($productPrice->three, $i) .
                        "&nbsp;" . _('GLOBAL_MONNAIE') .
                        "</td>";
                }
                if (isset($productPrice->four) && !is_null($productPrice->four)) {
                    $html[] = "<td>" .
                        $this->calculatePrice($productPrice->four, $i) .
                        "&nbsp;" . _('GLOBAL_MONNAIE') .
                        "</td>";
                }
                $html[] = "</tr>";
            }
        } elseif (is_array($productPrice) && $productPrice[0] instanceof Llv_Dto_Product_Season_Price) {
            $html[] = "<th colspan=\"2\">" . _('PRODUCT_PRICE_SEASON_EMPTY') . "</th>";
            $html[] = "<th>" . _('PRODUCT_PRICE_SEASON_PERIODES_WEEK') . "</th>";
            $html[] = "<th>" . _('PRODUCT_PRICE_SEASON_PERIODES_WEEKEND') . "</th>";
            $html[] = "<th>" . _('PRODUCT_PRICE_SEASON_PERIODES_MIDWEEK') . "</th>";
            $html[] = "</tr>";
            $html[] = "</thead>";
            $html[] = "<tbody>";
            foreach ($productPrice as $price) {
                $html[] = "<tr>";
                $html[] = "<td>" . $price->season->label . "</td>";
                $html[] = "<td class=\"legende saison" . $price->season->id . "\"></td>";
                $html[] = "<td>" . (!is_null($price->week) ? $price->week . "&nbsp;" . _('GLOBAL_MONNAIE') :
                    _('PRODUCT_PRICE_SEASON_EMPTY')) . "</td>";
                $html[] = "<td>" . (!is_null($price->weekend) ? $price->weekend . "&nbsp;" . _('GLOBAL_MONNAIE') :
                    _('PRODUCT_PRICE_SEASON_EMPTY')) . "</td>";
                $html[] = "<td>" . (!is_null($price->midweek) ? _('PRODUCT_PRICE_SEASON_CONTACT_US') :
                    _('PRODUCT_PRICE_SEASON_EMPTY')) . "</td>";
                $html[] = "</tr>";
            }
        }
        $html[] = "</tbody>";
        $html[] = "</table>";
        echo implode(PHP_EOL, $html);
    }

    /**
     * @param $price
     * @param $nights
     *
     * @return mixed
     */
    private function calculatePrice($price, $nights)
    {
        if($nights>1){
            return ($price * $nights) - (Llv_Constant_Product_Price_Night::PROMOTION_NIGHT_SUPP * ($nights));
        }
        return $price;
    }
}