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
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;
use Zend\Hydrator\ArraySerializable;

class CmsBlockFieldset extends Fieldset implements InputFilterProviderInterface, ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

    protected $entity = CmsBlock::class;

    public function getObjectName()
    {
        return $this->entity;
    }

    public function init()
    {
        $this->setName('cms-block');

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
        ]);
        $this->add([
            'name' => 'mnemo',
            'attributes' => [
                'required' => 'required',
            ],
        ]);

        $this->add([
            'name' => 'content',
            'type' => 'textarea',
            'attributes' => [
                'placeholder' => 'Content En'
            ],
            'options' => [
                'label' => 'Content En'
            ]
        ]);
        /*$this->add([
            'name' => 'add-answers',
            'attributes' => [
                'type' => 'submit',
                'value' => '+',
                'class' => 'add-answer add-field-group btn btn-success small-btn',
                'data-group-id' => 'answers',
            ]
        ]);*/
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
