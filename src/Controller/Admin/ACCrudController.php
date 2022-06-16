<?php

namespace App\Controller\Admin;

use App\Entity\AC;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ACCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AC::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
