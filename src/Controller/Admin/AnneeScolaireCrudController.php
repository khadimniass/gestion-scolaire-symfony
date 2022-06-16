<?php

namespace App\Controller\Admin;

use App\Entity\AnneeScolaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AnneeScolaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AnneeScolaire::class;
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
