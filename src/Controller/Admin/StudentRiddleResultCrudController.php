<?php

namespace App\Controller\Admin;

use App\Entity\Riddle;
use App\Entity\StudentRiddleResult;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StudentRiddleResultCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StudentRiddleResult::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural("Rätsel-Ergebnisse")

            ->setPaginatorPageSize(25)

            ->setHelp('new', 'Hier können Sie die Ergebnisse der Schüler*innen einsehen.');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('student', "Schüler*in"),
            AssociationField::new('riddle', "Rätsel"),
            TextField::new('result', "Ergebnis"),
            DateTimeField::new('resolveTime', "Zeitpunkt der Lösung"),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add("riddle")
            ->add("student");
    }


}
