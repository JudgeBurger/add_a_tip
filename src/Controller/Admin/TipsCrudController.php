<?php

namespace App\Controller\Admin;

use App\Entity\Tips;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TipsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tips::class;
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
