<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Product;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('category', EntityType::class, array('class' => 'AppBundle:Category', 'choice_label' => 'name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('sku', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('price', MoneyType::class, array('divisor' => 100, 'currency' => 'USD', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('quantity', NumberType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('save', SubmitType::class, array('label' => 'Save Product' , 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Product::class, 'allow_extra_fields' => true));
    }
}
