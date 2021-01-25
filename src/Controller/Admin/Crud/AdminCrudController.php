<?php

namespace App\Controller\Admin\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class AdminCrudController extends AbstractUserCrudController
{
    protected function getUserRolesForQb(): array
    {
        return ['ROLE_ADMIN'];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Administrator')
            ->setEntityLabelInPlural('Administrators')
            ;
    }
}
