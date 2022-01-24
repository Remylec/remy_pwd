<?php

namespace App\Controller\Admin;

use App\Entity\Adverts;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdvertsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adverts::class;
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
