<?php
/**
 * PHP Class Season.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Back_Season
    extends App_Form_Abstract
{
    public function __construct()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);

        /** Season */
        $select = new Zend_Form_Element_Select(
            array(
                 'name'    => 'id',
                 'label'   => _('SEASON_TYPE'),
            )
        );
        $select->addMultiOptions($this->fillSeasons());
        $elements[] = $select;

        $semaines = new Zend_Form_Element_MultiCheckbox('semaines');
        $elements[] = $semaines;

        /** Bouton de validation */
        $elements[] = new Zend_Form_Element_Submit(
            array(
                 'name'    => 'submit',
                 'label'   => _('GLOBAL_FORM_SUBMIT')
            )
        );
        /** Ajout des éléments au formulaire */
        $this->addElements($elements);

        return parent::__construct();
    }

    /**
     *
     */
    private function fillSeasons()
    {
        $options = array();
        $filter = new Llv_Services_Product_Filter_Season();
        foreach (Llv_Context_Product::getInstance()->seasonGetAll($filter) as $saison) {
            $options[$saison->id] = $saison->label;
        }
        return $options;
    }
}