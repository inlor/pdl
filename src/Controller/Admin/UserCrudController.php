<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends DefaultCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('email')
                ->setRequired(true),
        ];

        return array_merge($fields, parent::configureFields($pageName));
    }
}
