<?php
/**
 * PHP Class Add.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 23/08/12
 * @author      : aroy <contact@aroy.fr>
 */


class App_Form_Back_Activity_Edit
    extends App_Form_Abstract
{
    public function __construct()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
        $this->_setAction('/activities/edit/');
        $this->setAttrib('id', 'activity_add');
        $this->setAttrib('class', 'i18ned');

        $elements = array();
        /**  */
        $categories = new Zend_Form_Element_Select(
            array(
                 'name'    => 'category',
                 'label'   => _('NEWS_CATEGORY_LABEL'),
                 'required'=> true
            )
        );
        $categories->setMultiOptions(
            $this->fillCategories()
        );
        $elements[] = $categories;
        /**  */
        $elements[] = new Zend_Form_Element_Hidden(
            array(
                 'name' => 'id',
                 'value'=> null
            )
        );
        /**  */
        $elements[] = new Zend_Form_Element_Text(
            array(
                 'name'            => 'location',
                 'label'           => _('NEWS_EDIT_LOCATION_LABEL'),
            )
        );
        /** @var $language Llv_Dto_Language */
        foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
            $text = new Zend_Form_Element_Text(
                array(
                     'name'            => App_Model_Constant_Activity::FORM_PREFIX_TITLE . $language->id,
                     'label'           => _('NEWS_EDIT_TITLE_LABEL') . ' ' . $language->label,
                     'class'           => 'jq-lang',
                     'data-language'   => $language->locale->toString()
                )
            );
            $textarea = new Zend_Form_Element_Textarea(
                array(
                     'name'            => App_Model_Constant_Activity::FORM_PREFIX_CONTENT . $language->id,
                     'label'           => _('NEWS_EDIT_CONTENT_LABEL') . ' ' . $language->label,
                     'class'           => 'jq-lang',
                     'data-language'   => $language->locale->toString()
                )
            );
            $link = new Zend_Form_Element_Text(
                array(
                     'name'            => App_Model_Constant_Activity::FORM_PREFIX_LINK . $language->id,
                     'label'           => _('NEWS_EDIT_LINK_LABEL') . ' ' . $language->label,
                     'class'           => 'jq-lang',
                     'data-language'   => $language->locale->toString()
                )
            );

            $elements[] = $link->setBelongsTo(App_Model_Constant_Activity::FORM_PREFIX_LINK);
            $elements[] = $text->setBelongsTo(App_Model_Constant_Activity::FORM_PREFIX_TITLE);
            $elements[] = $textarea->setBelongsTo(App_Model_Constant_Activity::FORM_PREFIX_CONTENT);
        }

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

        return parent::__construct();
    }

    /**
     * @param $idActivity
     */
    public function fillForm($idActivity)
    {
        $this->getElement('id')->setValue($idActivity);
        foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
            $filter = new Llv_Services_Activity_Filter_Activity();
            $filter->id = $idActivity;
            $filter->idLangue = $language->id;
            $activity = Llv_Context_Activity::getInstance()->getOne($filter);
            if (!is_null($activity)) {
                $this->getElement(App_Model_Constant_Activity::FORM_PREFIX_TITLE . $language->id)->setValue($activity->title);
                $this->getElement(App_Model_Constant_Activity::FORM_PREFIX_CONTENT . $language->id)->setValue($activity->content);
                $this->getElement(App_Model_Constant_Activity::FORM_PREFIX_LINK . $language->id)->setValue($activity->link);
                $this->getElement('location')->setValue($activity->location);
            }
        }
    }

    private function fillCategories()
    {
        $options = array();
        $filter = new Llv_Services_Activity_Filter_Category();
        $filter->idLangue = Llv_Context_Application::getInstance()->getCurrentLocale()->getIdLangue();
        foreach (Llv_Context_Activity::getInstance()->categoryGetAll($filter) as $category) {
            $options[$category->id] = $category->title;
        }
        return $options;
    }
}