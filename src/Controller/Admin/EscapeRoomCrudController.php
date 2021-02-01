<?php

namespace App\Controller\Admin;

use App\Entity\EscapeRoom;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Symfony\Component\HttpFoundation\Response;

class EscapeRoomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EscapeRoom::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions = parent::configureActions($actions);

        $viewQrCodes = Action::new('showQrCodes', 'QR-Codes fuer Raetsel anzeigen')
            ->linkToCrudAction('viewQrCodes');

        $actions->add(Crud::PAGE_INDEX, $viewQrCodes);

        return $actions;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural("Escape Rooms")
            ->setEntityLabelInSingular(fn(?EscapeRoom $escapeRoom) => $escapeRoom ? sprintf('"%s"', $escapeRoom->getTitle()) : 'Escape Room')

            ->setPaginatorPageSize(10)
            ->setDefaultSort(['code' => 'DESC'])

            ->setHelp('new', 'Hier können Sie einen neuen Escape-Room erstellen.');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', "Titel"),
            TextField::new('code', "Code")->setHelp("Der Code wird zum Aufrufen des Rooms benötigt."),

            FormField::addPanel("Text der Einführung")->setIcon("fa fa-file-alt"),
            TextEditorField::new('description', "Beschreibungstext")->setHelp("Hier können einleitende Worte für den Room stehen."),

            FormField::addPanel("Weitere Felder")->setIcon("fa fa-ellipsis-h")->collapsible()->renderCollapsed()->setHelp("Weitere, optionale Felder, die nicht bei jedem Rätsel verwendet werden müssen."),
            UrlField::new('youtubeLink', 'YouTube-Link')->hideOnIndex()->setHelp("Link zu einem YouTube-Video, wie er auf der YouTube-Seite unter 'Teilen' angezeigt wird.<br>Beispiel: https://youtu.be/lMFJvR199rg")
        ];
    }

    // custom actions
    public function viewQrCodes(AdminContext $context): Response
    {
        $escapeRoom = $context->getEntity()->getInstance();

        return $this->render('admin/escapeRoom/viewQrCodes.html.twig', [
            'escapeRoom' => $escapeRoom,
        ]);
    }
}
