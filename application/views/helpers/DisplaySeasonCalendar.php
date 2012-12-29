<?php
/**
 * PHP Class DisplaySeasonCalendar.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 29/07/12
 * @author      : aroy <contact@aroy.fr>
 */
class App_View_Helper_DisplaySeasonCalendar
    extends Zend_View_Helper_Abstract
{
    protected static $_moisParLigne = 3;
    protected static $_nombreMois = 12;
    protected static $_nombreColonneDansMois = 8;

    /**
     *
     */
    public function displaySeasonCalendar($productPrice = null, $anneeCourante = null)
    {
        $siteCourant = Llv_Context_Application::getInstance()->getCurrentSite();
        $anneeCourante = !is_null($anneeCourante) ? $anneeCourante : date('Y');
        $semainesAjoutees = array();

        if (self::$_nombreMois % self::$_moisParLigne == 0) {
            $moisCourant = 1;
            $html[] = "<table class=\"calendrier\">";
            $html[] = "<tbody>";
            /** Affichage des lignes */
            for ($ligneMois = 1; $ligneMois <= (self::$_nombreMois / self::$_moisParLigne); $ligneMois++) {
                $html[] = "<tr>";
                /** Affichage des colonnes */
                for ($colonneMois = 1; $colonneMois <= self::$_moisParLigne; $colonneMois++) {
                    /** On vient de récupérer le mois courant et le nombre de jours qu'il contient */
                    $timestampPremierJour = strtotime($anneeCourante . '-' . $moisCourant . '-01');
                    $nombreJourDansMois = date("t", $timestampPremierJour);
                    if ($moisCourant < 10) {
                        $moisCourant = "0" . $moisCourant;
                    }
                    $html[] = "<td class=\"mois\">";
                    $html[] = "<table>";
                    $html[] = "<thead>";
                    $html[] = "<tr class=\"mois\">";
                    $html[] = "<th colspan=\"8\">" . _('GLOBAL_MONTH_LABEL' . $moisCourant) .
                        "&nbsp;" . $anneeCourante . "</th>";
                    $html[] = "</tr>";
                    $html[] = "<tr class=\"days\">";
                    $html[] = "<td>" . _('GLOBAL_WEEK_LABEL_SHORT') . "</td>";
                    $html[] = "<td>" . _('GLOBAL_DAY_LABEL_SHORT6') . "</td>";
                    $html[] = "<td>" . _('GLOBAL_DAY_LABEL_SHORT0') . "</td>";
                    $html[] = "<td>" . _('GLOBAL_DAY_LABEL_SHORT1') . "</td>";
                    $html[] = "<td>" . _('GLOBAL_DAY_LABEL_SHORT2') . "</td>";
                    $html[] = "<td>" . _('GLOBAL_DAY_LABEL_SHORT3') . "</td>";
                    $html[] = "<td>" . _('GLOBAL_DAY_LABEL_SHORT4') . "</td>";
                    $html[] = "<td>" . _('GLOBAL_DAY_LABEL_SHORT5') . "</td>";
                    $html[] = "</tr>";
                    $html[] = "</thead>";
                    /** On va maintenant afficher le corps du mois */
                    $html[] = "<tbody>";
                    $colonne = self::$_nombreColonneDansMois;
                    for ($jour = 1; $jour <= $nombreJourDansMois; $jour++) {
                        /** @var $colonne Sert à determiner la colonne du jour de la semaine */
                        $timestampJour = strtotime($anneeCourante . '-' . $moisCourant . '-' . $jour);
                        if ($colonne % self::$_nombreColonneDansMois == 0) {
                            /** @var $week Llv_Dto_Week */
                            $week = $this->getWeekFromDate($timestampJour);

                            $infobulle = array();
                            if (!is_null($productPrice)) {
                                /** @var $price Llv_Dto_Product_Season_Price */
                                $price = $this->getPriceForSeason($productPrice, $week->season->id);

                                /** Le prix apparîtra en infobulle au survol */
                                if (!is_null($price->week)) {
                                    $infobulle[] = "<em>" . _('PRODUCT_PRICE_SEASON_PERIODES_WEEK') . "</em> : "
                                        . "<strong>"
                                        . $price->week . "&nbsp;" . _('GLOBAL_MONNAIE')
                                        . "</strong>";
                                } else {
                                    $infobulle[] = "<em>" . _('PRODUCT_PRICE_SEASON_PERIODES_WEEK') . "</em> : "
                                        . _('PRODUCT_PRICE_SEASON_PERIODES_INDISPO');
                                }

                                if (!is_null($price->weekend)) {
                                    $infobulle[] = "<em>" . _('PRODUCT_PRICE_SEASON_PERIODES_WEEKEND') . "</em> : "
                                        . "<strong>"
                                        . $price->weekend . "&nbsp;" . _('GLOBAL_MONNAIE')
                                        . "</strong>";
                                } else {
                                    $infobulle[] = "<em>" . _('PRODUCT_PRICE_SEASON_PERIODES_WEEKEND') . "</em> : "
                                        . _('PRODUCT_PRICE_SEASON_PERIODES_INDISPO');
                                }

                                if (!is_null($price->midweek)) {
                                    $infobulle[] = "<em>" . _('PRODUCT_PRICE_SEASON_PERIODES_MIDWEEK') . "</em> : "
                                        . _('PRODUCT_PRICE_SEASON_CONTACT_US');
                                } else {
                                    $infobulle[] = "<em>" . _('PRODUCT_PRICE_SEASON_PERIODES_MIDWEEK') . "</em> : "
                                        . _('PRODUCT_PRICE_SEASON_PERIODES_INDISPO');
                                }
                            }


                            $html[] = "<tr class=\"jq-semaine semaine saison" . $week->season->id . "\"
                            data-infobulle=\"" . nl2br(implode(PHP_EOL, $infobulle)) . "\">";
                            /** Numero de semaine */
                            if ($siteCourant == Llv_Constant_Application::FRONT) {
                                $html[] = "<td class=\"jq-week week\">" . $this->getDayWeekNumber($timestampJour) . "</td>";
                            } elseif ($siteCourant == Llv_Constant_Application::BACK) {
                                $html[] = "<td class=\"jq-week week\">";
                                if (!in_array($week->id, $semainesAjoutees)) {
                                    $html[] = "<input type=\"checkbox\" name=\"semaines[]\" value=\"" . $week->id . "\" id=\"week" . $week->id . "\" />";
                                    $semainesAjoutees[] = $week->id;
                                }
                                $html[] = "</td>";
                            }
                            $colonne = 1;
                        }

                        if ($jour == 1) {
                            $numeroJourDansSemaine = date('w', $timestampJour);
                            $numeroJourCompteurDansSemaine = 6;
                            $jourMalPlace = true;
                            do {
                                if ($numeroJourDansSemaine != $numeroJourCompteurDansSemaine) {
                                    $colonne++;
                                    $html[] = "<td></td>";
                                    /** On incrémente */
                                    if ($numeroJourCompteurDansSemaine == 6) {
                                        $numeroJourCompteurDansSemaine = 0;
                                    } else {
                                        $numeroJourCompteurDansSemaine++;
                                    }
                                } else {
                                    $jourMalPlace = false;
                                }
                            } while ($jourMalPlace);
                        }
                        $html[] = "<td><label for=\"week" . $week->id . "\">" . date('d', $timestampJour) . "</label></td>";
                        $colonne++;

                        if ($colonne % self::$_nombreColonneDansMois == 0) {
                            $html[] = "</tr>";
                        }
                    }
                    $html[] = "</tr>";
                    $html[] = "</tbody>";
                    $html[] = "</table>";
                    $html[] = "</td>";
                    $moisCourant++;
                }
                $html[] = "</tr>";
            }
            $html[] = "</tbody>";
            $html[] = "</table>";
            echo implode(PHP_EOL, $html);
        }
    }

    /**
     * @param $timestampJour
     *
     * @return Llv_Dto_Week[]|null
     */
    private function getWeekFromDate($timestampJour)
    {
        $debut = date(Llv_Constant_Date::FORMAT_DB_TIME17, $timestampJour);
        $numeroJourDansSemaine = date('w', $timestampJour);
        $debut = new DateTime($debut);

        if (7 - (2 + $numeroJourDansSemaine) > 0 && date('d', $timestampJour) != 1) {
            $dateDebut = new DateTime(
                date(
                    Llv_Constant_Date::FORMAT_DB_TIME17,
                    strtotime('-7 days', $debut->getTimestamp())
                )
            );
        } else {
            $dateDebut = $debut;
        }
        $filter = new Llv_Services_Product_Filter_Season();
        $filter->dateDebut = $dateDebut;
        return Llv_Context_Product::getInstance()->weeksGetOne($filter);
    }

    /**
     * @param array $productPrices
     * @param       $seasonId
     *
     * @return null
     */
    private function getPriceForSeason(array $productPrices, $seasonId)
    {
        foreach ($productPrices as $price) {
            if ($price->season->id == $seasonId) {
                return $price;
            }
        }
        return null;
    }

    /**
     * @param $dayTs
     *
     * @return string
     */
    private function getDayWeekNumber($dayTs)
    {
        $result = date('W', $dayTs);
        return $result;
    }
}