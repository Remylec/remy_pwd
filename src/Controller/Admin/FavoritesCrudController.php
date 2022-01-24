<?php

namespace App\Controller\Admin;

use App\Entity\Favorites;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FavoritesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Favorites::class;
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
