<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\FamilleArticle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('prix_euro')
            ->add('prix_fidelite')
            ->add('fidelite')
            ->add('description')
            ->add('reference')
            ->add('famille', EntityType::class, array(
                'class' => FamilleArticle::class,
                'choice_label' => 'libelle',
                'multiple' => false,
            ))
        ;
        if (!$builder->getData()->getImage()) {
            $builder->add('image', FileType::class);
        } else {

        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
