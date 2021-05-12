<?php

namespace App\Controller\Admin;

use App\Entity\Theme;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ThemeCrudController extends DefaultCrudController
{
    public static function getEntityFqcn(): string
    {
        return Theme::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')
                ->setRequired(true),
        ];
    }
}
