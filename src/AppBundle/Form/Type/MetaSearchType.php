<?php
namespace AppBundle\Form\Type;

use AppBundle\Service\ApiService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MetaSearchType extends AbstractType{
    public function getName()
    {
        // TODO: Implement getName() method.
    }
    //just example
    private $apiService;
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', 'text', array(
                'constraints' => array(
//                    new NotBlank(array('groups' => array('create', 'update'))
                    new Length(array('min' => 3),
                    new NotBlank()
                    ),
                )
            ))
            ->add('year_from',new ChoiceType())
            ->add('year_to',new ChoiceType(),array('choices'=>array(
                '1' => '1',
                '2' => '2'
            )))
            ->add('get',new SubmitType(),array('label'=>'Find!'))


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
//            'data_class' => 'AppBundle\Entity\Task',
            //when false then diasble val
            'validation_groups' => array('meta_search'),
            //setting callback to determine validation group
//            'validation_groups' => array(
//                'AppBundle\Entity\Client',
//                'determineValidationGroups',
//            ),

            //using closure
//            'validation_groups' => function (FormInterface $form) {
//                $data = $form->getData();
//
//                if (Client::TYPE_PERSON == $data->getType()) {
//                    return array('person');
//                }
//
//                return array('company');
//            },
        ));
    }

}