<?php
/**
 * PHP Class Category.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Back_Products_Category
    extends App_Form_Abstract
{
    public function __construct($id)
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->setAttrib('class', 'i18ned');

        /**  */
        $elements[] = new Zend_Form_Element_Hidden(
            array(
                 'name' => 'id',
                 'value'=> null
            )
        );

        /** @var $language Llv_Dto_Language */
        foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
            $type = new Zend_Form_Element_Text(
                array(
                     'name'            => App_Model_Constant_Products_Category::FORM_PREFIX_TYPE . $language->id,
                     'label'           => _('PRODUCTS_LIST_TYPE') . ' ' . $language->label,
                     'class'           => 'jq-lang',
                     'data-language'   => $language->locale->toString()
                )
            );
            $text = new Zend_Form_Element_Text(
                array(
                     'name'            => App_Model_Constant_Products_Category::FORM_PREFIX_TITLE . $language->id,
                     'label'           => _('PRODUCTS_LIST_TITRE') . ' ' . $language->label,
                     'class'           => 'jq-lang',
                     'data-language'   => $language->locale->toString()
                )
            );
            $textarea = new Zend_Form_Element_Textarea(
                array(
                     'name'            => App_Model_Constant_Products_Category::FORM_PREFIX_CONTENT . $language->id,
                     'label'           => _('PRODUCTS_LIST_CATEGORIE') . ' ' . $language->label,
                     'class'           => 'jq-lang',
                     'data-language'   => $language->locale->toString()
                )
            );

            $elements[] = $type->setBelongsTo(App_Model_Constant_Products_Category::FORM_PREFIX_TYPE);
            $elements[] = $text->setBelongsTo(App_Model_Constant_Products_Category::FORM_PREFIX_TITLE);
            $elements[] = $textarea->setBelongsTo(App_Model_Constant_Products_Category::FORM_PREFIX_CONTENT);
        }

        /**  */
//        $elements[] = new Zend_Form_Element_Text(
//            array(
//                 'name'            => 'route',
//                 'label'           => _('PRODUCTS_LIST_CATEGORIE_ROUTE'),
//                 'required'        => true
//            )
//        );

        /**  */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'            => 'location',
                 'label'           => _('PRODUCTS_LIST_CATEGORIE_COORDONNEES'),
                 'required'        => true
            )
        );

        /** @var $princingType  */
        $princingType = new Zend_Form_Element_Radio(
            array(
                 'name'    => 'princing_type',
                 'label'   => _('PRODUCTS_LIST_CATEGORIE_PRICINGTYPE')
            )
        );
        $princingType->addMultiOptions($this->fillPrincingTypes());
        $elements[] = $princingType;

        /** @var $princingType  */
        $pinColor = new Zend_Form_Element_Select(
            array(
                 'name'    => 'pin_color',
                 'label'   => _('PRODUCTS_LIST_CATEGORIE_PINCOLOR')
            )
        );
        $pinColor->addMultiOptions($this->fillPinColor());
        $elements[] = $pinColor;


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
     * @param $id
     */
    public function fillForm($id)
    {
        $this->getElement('id')->setValue($id);
        foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
            $filter = new Llv_Services_Product_Filter_Category();
            $filter->id = $id;
            $filter->idLangue = $language->id;
            $category = Llv_Context_Product::getInstance()->categoryGetOne($filter);
            if (!is_null($category)) {
                $this->getElement(App_Model_Constant_Products_Category::FORM_PREFIX_TYPE . $language->id)->setValue($category->type);
                $this->getElement(App_Model_Constant_Products_Category::FORM_PREFIX_TITLE . $language->id)->setValue($category->title);
                $this->getElement(App_Model_Constant_Products_Category::FORM_PREFIX_CONTENT . $language->id)->setValue($category->content);
            }
        }
//                $this->getElement('route')->setValue($category->route);
        $this->getElement('princing_type')->setValue($category->pricingType);
        $this->getElement('location')->setValue($category->location->value);
        $this->getElement('pin_color')->setValue($category->pinColor);
    }

    /**
     * @return array
     */
    private function fillPrincingTypes()
    {
        return array(
            Llv_Constant_Product_Price_Type::NUIT  => _('PRODUCTS_LIST_CATEGORIE_PRICINGTYPE1'),
            Llv_Constant_Product_Price_Type::SAISON=> _('PRODUCTS_LIST_CATEGORIE_PRICINGTYPE2')
        );
    }

    /**
     * @return array
     */
    private function fillPinColor()
    {
        return array(
            'red'      => _('PRODUCTS_LIST_CATEGORIE_PINCOLOR_RED'),
            'blue'     => _('PRODUCTS_LIST_CATEGORIE_PINCOLOR_BLUE'),
            'green'    => _('PRODUCTS_LIST_CATEGORIE_PINCOLOR_GREEN'),
            'purple'   => _('PRODUCTS_LIST_CATEGORIE_PINCOLOR_PURPLE'),
            'yellow'   => _('PRODUCTS_LIST_CATEGORIE_PINCOLOR_YELLOW')
        );
    }

}