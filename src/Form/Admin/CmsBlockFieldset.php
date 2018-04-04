<?php
/**
 * @category Stagem
 * @package Stagem_Question
 * @author Kozak Vlad <vlad.gem.typ@gmail.com>
 * @datetime: 04.01.2018 16:14
 */

namespace Stagem\ZfcCmsBlock\Form\Admin;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;
use Stagem\ZfcCmsBlock\Model\CmsBlock;
use Stagem\ZfcLang\Model\Lang;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Stagem\ZfcTranslator\TranslatorAwareTrait;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Zend\Hydrator\ArraySerializable;

class CmsBlockFieldset extends Fieldset implements InputFilterProviderInterface, ObjectManagerAwareInterface, TranslatorAwareInterface
{
    use ProvidesObjectManager;
    use TranslatorAwareTrait;

    protected $entity = CmsBlock::class;

    public function getObjectName()
    {
        return $this->entity;
    }

    public function init()
    {
        $this->setName('cmsBlock');

        //$this->setHydrator(new ArraySerializable())
        //                ->setObject(new CmsBlock());

        $this->add([
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
        ]);

        $this->add([
            'name' => 'title',
            'attributes' => [
                'required' => 'required',
            ],
			'options' => [
                'label' => $this->translate('Title')
            ]
        ]);
        $this->add([
            'name' => 'mnemo',
            'attributes' => [
                'required' => 'required',
            ],
			'options' => [
                'label' => $this->translate('Mnemo')
            ]
        ]);

        $this->add([
            'name' => 'content',
            'type' => 'textarea',
            'attributes' => [
                'placeholder' => $this->translate('Content')
            ],
            'options' => [
                'label' => $this->translate('Content')
            ]
        ]);

        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'lang',
            'options' => [
                'object_manager' => $this->getObjectManager(),
                'target_class' => Lang::class,
                'property' => 'name',
                'label'    => $this->translate('Choose language'),
                //'is_method' => true,
                /*'find_method' => [
                    'name' => 'findServiceByServiceCategoryMnemo',
                    'params' => [
                        'criteria' => ['orthopedic'],
                    ],
                ],*/
            ],
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
