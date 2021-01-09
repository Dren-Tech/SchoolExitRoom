<?php

namespace App\Controller\Admin;

use App\Entity\EscapeRoom;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EscapeRoomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EscapeRoom::class;
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
        ];
    }
}
