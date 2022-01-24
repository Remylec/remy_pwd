<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\RoleType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email','email'),
            TextField::new('pseudo','pseudo'),
            TextField::new('plainPassword','mot de passe')->hideOnIndex(),
            ChoiceField::new('roles','role')
            ->setChoices([
                'utilisateur'=>'ROLE_USER',
                'administrateur'=>'ROLE_ADMIN',
            ])
            ->allowMultipleChoices(false)
            ->renderExpanded(true)
            ->setFormType(RoleType::class),

        ];
    }

}
