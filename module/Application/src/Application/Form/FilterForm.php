<?php
/**
 * Filter form
 */

namespace Application\Form;
use Zend\Form\Form;
use Doctrine\ORM\EntityManager;

class FilterForm extends Form
{
    public function __construct(EntityManager $objectManager)
    {
        parent::__construct('filter');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'department',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Department',
                'empty_option' => 'Any',
                'object_manager' => $objectManager,
                'target_class' => 'Application\Entity\Department',
                'property' => 'name',
            )
        ));
        $this->add(array(
            'name' => 'language',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Language',
                'object_manager' => $objectManager,
                'target_class' => 'Application\Entity\Language',
                'property' => 'name',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}