<?php
namespace Stagem\ZfcCmsBlock\Form\Admin;

use Zend\Form\Form;
use Stagem\ZfcTranslator\TranslatorAwareTrait;
use Zend\I18n\Translator\TranslatorAwareInterface;

class ContentForm extends Form implements TranslatorAwareInterface
{
    use TranslatorAwareTrait;

    public function init() {
        $this->setName('content');

        // Add the user fieldset, and set it as the base fieldset
        $this->add([
            'name' => 'id',
            'type' => 'hidden'
        ]);

        $this->add([
            'name' => 'name',
            'attributes' => [
                'required' => 'required',
            ],
        ]);
        $this->add([
            'name' => 'mnemo',
            'attributes' => [
                'required' => 'required',
            ],
        ]);

        $this->add([
            'name' => 'contentUk',
            'type' => 'textarea',
            'attributes' => [
                'placeholder' => $this->translate('Content Uk'),
            ],
            'options' => [
                'label' => 'Content Uk'
            ]
        ]);

        $this->add([
            'name' => 'contentRu',
            'type' => 'textarea',
            'attributes' => [
                'placeholder' => $this->translate('Content Ru'),
            ],
            'options' => [
                'label' => 'Content Ru'
            ]
        ]);

        $this->add([
            'name' => 'contentEn',
            'type' => 'textarea',
            'attributes' => [
                'placeholder' => $this->translate('Content En'),
            ],
            'options' => [
                'label' => 'Content En'
            ]
        ]);

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