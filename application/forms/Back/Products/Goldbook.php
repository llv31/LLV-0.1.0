<?php
/**
 * PHP Class Goldbook.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Back_Products_Goldbook
    extends App_Form_Abstract
{
    public function __construct($id)
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->setAction('/products/edit-goldbook-message/');

        /**  */
        $elements[] = new Zend_Form_Element_Hidden(
            array(
                 'name' => 'id_category',
                 'value'=> null
            )
        );

        /**  */
        $elements[] = new Zend_Form_Element_Hidden(
            array(
                 'name' => 'id',
                 'value'=> null
            )
        );

        /** Arrivée */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'arrivee',
                 'label'   => _('GOLDBOOK_FORM_LABEL_ARRIVEE'),
                 'required'=> true,
                 'class'   => 'jq-datepicker'
            )
        );

        /** Départ */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'depart',
                 'label'   => _('GOLDBOOK_FORM_LABEL_DEPART'),
                 'required'=> true,
                 'class'   => 'jq-datepicker'
            )
        );

        /**  */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'            => 'location',
                 'label'           => _('GOLDBOOK_FORM_LABEL_CONTENU'),
                 'required'        => true
            )
        );

        /** Bouton de validation */
        $elements[] = new Zend_Form_Element_Submit(
            array(
                 'name'    => 'submit',
                 'label'   => _('GLOBAL_FORM_SUBMIT')
            )
        );
        $elements[] = new Zend_Form_Element_Submit(
            array(
                 'name'    => 'submit_quit',
                 'label'   => _('GLOBAL_FORM_SUBMIT_QUIT')
            )
        );

        /** Ajout des éléments au formulaire */
        $this->addElements($elements);
        $this->fillForm($id);
        return parent::__construct();
    }

    /**
     * @param Llv_Dto_Product $product
     */
    public function fillForm(Llv_Dto_Product $product)
    {
        $this->getElement('id_category')->setValue($product->category->id);
        $this->setAction('/products/location/type/' . $product->category->route . '/set/' . $product->url);
    }

}