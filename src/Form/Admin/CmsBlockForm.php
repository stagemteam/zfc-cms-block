<?php
namespace Stagem\ZfcCmsBlock\Form\Admin;

use Zend\Form\Form;
use Stagem\ZfcTranslator\TranslatorAwareTrait;
use Zend\I18n\Translator\TranslatorAwareInterface;

class CmsBlockForm extends Form implements TranslatorAwareInterface
{
    use TranslatorAwareTrait;

    public function init() {
        $this->setName('cmsBlocks');

            /*$this->setAttribute('method', 'post')
                        ->setBindOnValidate(self::BIND_ON_VALIDATE)
                        ->setInputFilter(new InputFilter());*/

        /*$this->add([
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'mnemo',
        ]);*/

        $this->add([
            'name' => 'cmsBlocks',
            'type' => 'Zend\Form\Element\Collection',
            'options' => [
                'use_as_base_fieldset' => true,
                'label' => $this->translate('Cms BLock'),
                //'count' => 3,
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                'target_element' => ['type' => \Stagem\ZfcCmsBlock\Form\Admin\CmsBlockFieldset::class],
            ],
        ]);

        /*$this->add([
            'name' => 'add-cmsBlock',
            'attributes' => [
                'type' => 'submit',
                'value' => '+',
                'class' => 'add-cmsBlock add-field-group btn small-btn',
                'data-group-id' => 'keys',
            ]
        ]);*/

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => $this->translate('Save'),
                'class' => 'btn btn-primary',
            ]
        ]);
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [];
    }
}