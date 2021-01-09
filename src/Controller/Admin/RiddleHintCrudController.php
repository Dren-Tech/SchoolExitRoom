<?php

namespace App\Controller\Admin;

use App\Entity\Riddle;
use App\Entity\RiddleHint;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RiddleHintCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RiddleHint::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural("Hinweise")
            ->setEntityLabelInSingular(fn(?RiddleHint $riddleHint) => $riddleHint ? sprintf('"%s"', $riddleHint->getTitle()) : 'Hinweis')

            ->setPaginatorPageSize(25)

            ->setHelp('new', 'Hier können Sie ein neues Rätsel für einen Escape-Room erstellen.');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titel'),
            TextEditorField::new('text', 'Hinweistect'),
            AssociationField::new('riddles', 'Rätsel'),
        ];
    }
}
