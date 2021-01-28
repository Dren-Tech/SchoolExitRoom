<?php

namespace App\Controller\Admin;

use App\Entity\Introduction;
use App\Entity\Riddle;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

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
            FormField::addPanel("Allgemeine Daten")->setIcon("fa fa-info-circle"),
            TextField::new('identifier', 'Kenncode'),
            TextField::new('title', 'Titel'),
            AssociationField::new('escapeRoom')->setRequired(true),
            AssociationField::new('nextRiddle', 'Nächstes Rätsel'),

            FormField::addPanel("Texte")->setIcon("fa fa-file-alt"),
            TextEditorField::new('text', 'Rätseltext'),
            TextEditorField::new('successMessage', 'Erfolgsmeldung')->hideOnIndex()->setRequired(true)->setHelp("Dieser Text wird angezeigt, wenn der korrekte Code eingegeben wurde."),

            FormField::addPanel("Codes und Hinweise")->setIcon("fa fa-question-circle")->collapsible()->renderCollapsed()->setHelp("Codes zum Lösen des Rätsel sowie Hinweis für eben diese."),
            TextField::new('entryCode', 'Einstiegscode')->hideOnIndex(),
            TextField::new('solutionCode', 'Lösungscode')->hideOnIndex()->setHelp("Code, der zum Lösen des Rätsels eingegeben werden muss."),
            AssociationField::new('riddleHints', 'Hinweis')->hideOnIndex(),

            FormField::addPanel("Weitere Felder")->setIcon("fa fa-ellipsis-h")->collapsible()->renderCollapsed()->setHelp("Weitere, optionale Felder, die nicht bei jedem Rätsel verwendet werden müssen."),
            UrlField::new('appLink','App Link')->hideOnIndex()->setHelp("Link zu einer externen App, etwa von LearningApps.org. Diese wird dann in das Rätsel eingebunden."),
            UrlField::new('youtubeLink', 'YouTube-Link')->hideOnIndex()->setHelp("Link zu einem YouTube-Video, wie er auf der YouTube-Seite unter 'Teilen' angezeigt wird.<br>Beispiel: https://youtu.be/lMFJvR199rg"),
            ImageField::new("pdfFilename")->setUploadDir("./public/uploads/pdf")->hideOnIndex(),
            BooleanField::new('isUnlocked', 'Ist freigeschalten')->hideOnIndex()->setHelp("Vorerst nicht benötigt."),
        ];
    }
}
