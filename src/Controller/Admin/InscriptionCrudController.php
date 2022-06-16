<?php

namespace App\Controller\Admin;

use App\Entity\Inscription;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InscriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inscription::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            //ceci affiche le titre des elements à afficher en singulier/pluriel
            ->setEntityLabelInPlural('Les Inscriptions')
            ->setEntityLabelInSingular('Inscription')
            ;
    }
    /*
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->renderSidebarMinimized()
            ->setEntityLabelInSingular('Inscription')
            ->setEntityLabelInPlural('Inscription')
            ->setEntityLabelInPlural(
                function (?Inscription $inscription, ?string $pageName){
                    return 'edit'=== $pageName ? $inscription->getEtudiant() : 'Inscription';
                })
            // the Symfony Security permission needed to manage the entity
            // (none by default, so you can manage all instances of the entity)
            ->setEntityPermission('') //c'est la ou il faut dire qui quel role a le droit de voir ça
            ;
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
