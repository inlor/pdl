<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends DefaultCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title')
            ->add('theme')
            ->add('content')
            ->add('createdAt')
            ->add('updatedAt');
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('title')
                ->setRequired(true),
            AssociationField::new('theme')
                ->setRequired(false),
            TextEditorField::new('content')
                ->setRequired(true),
        ];
        return array_merge($fields, parent::configureFields($pageName));
    }

    public function configureActions(Actions $actions): Actions
    {
        $detail = Action::new('show', 'Show')
            ->linkToRoute('post_show', function(Post $post){
                return ['slug' => $post->getSlug()];
            });

        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, $detail);
    }
}
