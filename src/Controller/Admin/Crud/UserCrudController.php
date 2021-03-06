<?php

namespace App\Controller\Admin\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class UserCrudController extends AbstractUserCrudController
{
    protected function getUserRolesForQb(): array
    {
        return ['-ROLE_ADMIN'];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('Users')
        ;
    }
}
