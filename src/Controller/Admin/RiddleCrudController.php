<?php

namespace App\Controller\Admin;

use App\Entity\Riddle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RiddleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Riddle::class;
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
