<?php

namespace App\Controller\Admin;

use App\Entity\EscapeRoom;
use App\Entity\Introduction;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IntroductionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Introduction::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural("Einführungen")
            ->setEntityLabelInSingular(fn(?Introduction $introduction) => $introduction ? sprintf('"%s"', $introduction->getTitle()) : 'Einführung')

            ->setPaginatorPageSize(10)
            ->setDefaultSort(['id' => 'DESC'])

            ->setHelp('new', 'Hier können Sie eine neue Einführung für einen Escape-Room erstellen.');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titel'),
            AssociationField::new('escapeRoom'),
            TextEditorField::new('text', 'Einführungstext'),
        ];
    }
}
