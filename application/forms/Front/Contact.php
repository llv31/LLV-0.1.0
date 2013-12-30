<?php
/**
 * PHP Class Contact.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Front_Contact
    extends App_Form_Abstract
{
    public function __construct()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);

        $this->setAction('/contact/');
        if (APPLICATION_ENV == 'dev') {
            $this->setAction(App_View_Helper_BaseUrl::baseUrl() . 'contact/');
        }

        /** INFOS PERSOS */
        /** Nom */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'agezegaga',
                 'label'   => _('agezegaga')
            )
        );

        /** INFOS PERSOS */
        /** Nom */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'nom',
                 'label'   => _('CONTACT_FORM_LABEL_NOM'),
//                 'required'=> true
            )
        );
        /** Prénom */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'prenom',
                 'label'   => _('CONTACT_FORM_LABEL_PRENOM'),
//                 'required'=> true
            )
        );
        /** Email */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'     => 'email',
                 'label'    => _('CONTACT_FORM_LABEL_EMAIL'),
                 'required' => true,
                 //                 'validator'=> new Zend_Validate_EmailAddress()
            )
        );
        /** Tel.Mob. */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'telephone',
                 'label'   => _('CONTACT_FORM_LABEL_TELEPHONE'),
//                 'required'=> true
            )
        );
        /** Adresse */
        $elements[] = new Zend_Form_Element_Textarea(
            array(
                 'name'    => 'adresse',
                 'label'   => _('CONTACT_FORM_LABEL_ADRESSE'),
//                 'required'=> true
            )
        );

        /** RESERVATION */
        /** Découverte */
        $options = array(
            null                                                    => _('CONTACT_FORM_SELECT_DECOUVERTE_OPTION_VIDE'),
            _('CONTACT_FORM_SELECT_DECOUVERTE_OPTION_SE')           => _('CONTACT_FORM_SELECT_DECOUVERTE_OPTION_SE'),
            _('CONTACT_FORM_SELECT_DECOUVERTE_OPTION_ABRITEL')      => _('CONTACT_FORM_SELECT_DECOUVERTE_OPTION_ABRITEL'),
            _('CONTACT_FORM_SELECT_DECOUVERTE_OPTION_BOUCHEOREILLE')=> _('CONTACT_FORM_SELECT_DECOUVERTE_OPTION_BOUCHEOREILLE'),
            _('CONTACT_FORM_SELECT_DECOUVERTE_OPTION_AUTRES')       => _('CONTACT_FORM_SELECT_DECOUVERTE_OPTION_AUTRES')
        );
        $decouverte = new Zend_Form_Element_Select(
            array(
                 'name'    => 'decouverte',
                 'label'   => _('CONTACT_FORM_LABEL_DECOUVERTE'),
                 //                 'required'=> true
            )
        );
        $decouverte->addMultiOptions($options);
        $elements[] = $decouverte;
        /** Nb adultes */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'adultes',
                 'label'   => _('CONTACT_FORM_LABEL_ADULTES'),
//                 'required'=> true
            )
        );
        /** Nb enfants */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'enfants',
                 'label'   => _('CONTACT_FORM_LABEL_ENFANTS'),
//                 'required'=> true
            )
        );
        /** Arrivée */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'arrivee',
                 'label'   => _('CONTACT_FORM_LABEL_ARRIVEE'),
                 'required'=> true,
                 'class'   => 'jq-datepicker'
            )
        );
        /** Depart */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'depart',
                 'label'   => _('CONTACT_FORM_LABEL_DEPART'),
                 'required'=> true,
                 'class'   => 'jq-datepicker'
            )
        );
        /** Locations */
        $options = $this->fillLocations();
        $decouverte = new Zend_Form_Element_Select(
            array(
                 'name'    => 'locations',
                 'label'   => _('CONTACT_FORM_LABEL_LOCATIONS'),
                 'required'=> true
            )
        );
        $decouverte->addMultiOptions($options);
        $elements[] = $decouverte;
        /** Précisions */
        $elements[] = new Zend_Form_Element_Textarea(
            array(
                 'name'    => 'precisions',
                 'label'   => _('CONTACT_FORM_LABEL_PRECISIONS')
            )
        );

        /** Bouton de validation */
        $elements[] = new Zend_Form_Element_Submit(
            array(
                 'name'    => 'submit',
                 'label'   => _('CONTACT_FORM_SUBMIT')
            )
        );
        /** Ajout des éléments au formulaire */
        $this->addElements($elements);

        $this->addDisplayGroup(
            array(
                 'agezegaga'
            ),
            'antibot',
            array('legend'=> _('antibot'))
        );
        $this->addDisplayGroup(
            array(
                 'decouverte',
                 'nom',
                 'prenom',
                 'email',
                 'telephone',
                 'adresse',
            ),
            'informations',
            array('legend'=> _('CONTACT_FORM_FIELDSET_INFORMATIONS'))
        );


        $this->addDisplayGroup(
            array(
                 'locations',
                 'adultes',
                 'enfants',
                 'arrivee',
                 'depart',
                 'precisions',
                 'submit'
            ),
            'demande',
            array('legend'=> _('CONTACT_FORM_FIELDSET_DEMANDE'))
        );

        return parent::__construct();
    }

    /**
     * @return array
     */
    private function fillLocations()
    {
        $filter = new Llv_Services_Product_Filter_Product();
        $produits = Llv_Context_Product::getInstance()->getAll($filter);
        $result[null] = _('CONTACT_FORM_SELECT_DECOUVERTE_OPTION_VIDE');
        foreach ($produits as $produit) {
            $result[$produit->title] = $produit->title;
        }
        $result[_('CONTACT_OPTION_CHALET')] = _('CONTACT_OPTION_CHALET');
        return $result;
    }

    /**
     * @param $locationTitle
     */
    public function setLocation($locationTitle)
    {
        $this->getElement('locations')->setValue($locationTitle)->setAttrib('disabled', 'disabled');
    }
}