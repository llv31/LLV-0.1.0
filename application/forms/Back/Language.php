<?php
/**
 * PHP Class Language.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 27/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Back_Language
    extends App_Form_Abstract
{
    public function __construct()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->setAttrib('id', 'language_toggler');

        /** Login */
        $elements = new Zend_Form_Element_Select(
            array(
                 'name'    => 'language',
                 'label'   => _('GLOBAL_LANGUAGETOGGLER_LABEL'),
                 'required'=> true,
                 'class'   => 'jq-language_toggler'
            )
        );
        $elements->setMultiOptions($this->fillLanguages());

        /** Ajout des éléments au formulaire */
        $this->addElement($elements);

        return parent::__construct();
    }

    /**
     * @return array
     */
    private function fillLanguages()
    {
        $options = array();
        foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
            $options[$language->locale->toString()] = $language->label;
        }
        return $options;
    }
}