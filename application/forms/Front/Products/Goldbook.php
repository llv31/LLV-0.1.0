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

class App_Form_Front_Products_Goldbook
    extends App_Form_Abstract
{
    public function __construct()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);

        /**  */
        $elements[] = new Zend_Form_Element_Hidden(
            array(
                 'name' => 'id_category',
                 'value'=> null
            )
        );

        /** Arrivée */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'arrivee',
                 'label'   => _('GOLDBOOK_FORM_LABEL_ARRIVEE'),
                 'class'   => 'jq-datepicker'
            )
        );

        /** Départ */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'    => 'depart',
                 'label'   => _('GOLDBOOK_FORM_LABEL_DEPART'),
                 'class'   => 'jq-datepicker'
            )
        );

        /**  */
        $elements[] = new Zend_Form_Element_Textarea(
            array(
                 'name'            => 'content',
                 'label'           => _('GOLDBOOK_FORM_LABEL_CONTENU'),
                 'required'        => true
            )
        );

        /** Bouton de validation */
        $elements[] = new Zend_Form_Element_Submit(
            array(
                 'name'    => 'submit',
                 'label'   => _('GOLDBOOK_FORM_SUBMIT')
            )
        );

        /** Ajout des éléments au formulaire */
        $this->addElements($elements);
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