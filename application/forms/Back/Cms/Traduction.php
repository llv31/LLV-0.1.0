<?php
/**
 * PHP Class Traduction.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Form_Back_Cms_Traduction
    extends App_Form_Abstract
{
    public function __construct()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->setAttrib('class', 'i18ned');
        $this->setAttrib('id', 'traduction_edit');

        $this->setAction('/index/traduction/');
        if (APPLICATION_ENV == 'dev') {
            $this->setAction(App_View_Helper_BaseUrl::baseUrl() . 'index/traduction/');
        }

        $elements = $this->fillValues();

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
     * @return array
     */
    private function fillValues()
    {
        $elements = array();
        foreach (Llv_Config::getInstance()->sites->toArray() as $site) {
            $filter = new Llv_Services_Cms_Filter_Traduction();
            $filter->locale = ($site['locale'] instanceof Llv_Locale) ? $site['locale'] : new Llv_Locale($site['locale']);
            $results = Llv_Context_Cms::getInstance()->traductionGetAll($filter);

            $i = 1;
            foreach ($results as $key=> $result) {
                $params = array(
                    'name'                => $this->makeName($result),
                    'class'               => 'jq-lang',
                    'data-language'       => $result->locale->toString(),
                    'data-key'            => $result->keyName,
                    'value'               => $result->value
                );
                if (!$result->private) {
                    $input = new Zend_Form_Element_Text(
                        array_merge(
                            $params,
                            array(
                                 'label'=> $i . ' - ' . $result->value . ' (' . $result->keyName . ')'
                            )
                        )
                    );
                    $i++;
                } else {
                    $input = new Zend_Form_Element_Hidden(
                        $params
                    );
                }
                $elements[] = $input->setBelongsTo(App_Model_Constant_Cms_Traduction::FORM_PREFIX_KEY);
            }
        }
        return $elements;
    }

    /**
     * @param Llv_Dto_Cms_Traduction $dto
     * @param null                   $name
     *
     * @return array|string
     */
    public function makeName(Llv_Dto_Cms_Traduction $dto = null, $name = null)
    {
        $parseChar = '___';
        if (!is_null($dto)) {
            return $dto->locale->toString() . $parseChar . ($dto->private ? "1" : "0") . $parseChar . $dto->keyName;
        } elseif (!is_null($name)) {
            $res = explode($parseChar, $name);
            return array(
                'locale'  => new Llv_Locale($res[0]),
                'keyname' => $res[2],
                'private' => $res[1]
            );
        }
    }
}