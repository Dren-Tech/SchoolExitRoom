<?php

namespace App\Controller\Admin;

use App\Entity\EscapeRoom;
use App\Entity\Introduction;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

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

            FormField::addPanel("Weitere Felder")->setIcon("fa fa-ellipsis-h")->collapsible()->renderCollapsed()->setHelp("Weitere, optionale Felder, die nicht bei jedem Rätsel verwendet werden müssen."),
            UrlField::new('youtubeLink', 'YouTube-Link')->hideOnIndex()->setHelp("Link zu einem YouTube-Video, wie er auf der YouTube-Seite unter 'Teilen' angezeigt wird.<br>Beispiel: https://youtu.be/lMFJvR199rg")
        ];
    }
}
