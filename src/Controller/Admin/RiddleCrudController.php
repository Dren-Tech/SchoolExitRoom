<?php

namespace App\Controller\Admin;

use App\Entity\Introduction;
use App\Entity\Riddle;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RiddleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Riddle::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural("Rätsel")
            ->setEntityLabelInSingular(fn(?Riddle $riddle) => $riddle ? sprintf('"%s"', $riddle->getTitle()) : 'Rätsel')

            ->setPaginatorPageSize(25)
            ->setDefaultSort(['identifier' => 'DESC'])

            ->setHelp('new', 'Hier können Sie ein neues Rätsel für einen Escape-Room erstellen.');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('identifier', 'Kenncode'),
            TextField::new('title', 'Titel'),
            AssociationField::new('escapeRoom'),
            TextEditorField::new('text', 'Rätseltext'),
            TextEditorField::new('successMessage', 'Erfolgsmeldung')->hideOnIndex()->setHelp("Dieser Text wird angezeigt, wenn der korrekte Code eingegeben wurde."),
            TextField::new('entryCode', 'Einstiegscode')->hideOnIndex(),
            TextField::new('solutionCode', 'Lösungscode')->hideOnIndex()->setHelp("Code, der zum Lösen des Rätsels eingegeben werden muss."),
            BooleanField::new('isUnlocked', 'Ist freigeschalten')->hideOnIndex()->setHelp("Vorerst nicht benötigt."),
            AssociationField::new('riddleHints', 'Hinweis')->hideOnIndex(),
        ];
    }
}
