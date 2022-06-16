<?php

namespace App\Controller\Admin;

use App\Entity\RP;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RPCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RP::class;
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
