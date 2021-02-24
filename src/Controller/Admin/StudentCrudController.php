<?php

namespace App\Controller\Admin;

use App\Entity\RiddleHint;
use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class StudentCrudController extends AbstractCrudController
{
    private UserPasswordEncoderInterface $encoder;

    public static function getEntityFqcn(): string
    {
        return Student::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural("Schüler*innen")
            ->setEntityLabelInSingular(fn(?Student $student) => $student ? sprintf('"%s"', $student->getUsername()) : 'Schüler*innen')

            ->setPaginatorPageSize(25)

            ->setHelp('new', 'Hier können Sie eine neue Schüler*innen-Kennung erstellen.');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('username', 'Userkennung'),
            TextField::new('plainPassword', 'Passwort')->hideOnIndex()->setRequired(true),
            TextField::new('class', 'Klasse'),
            TextField::new('firstname', 'Vorname'),
            TextField::new('lastname', 'Nachname'),
            DateTimeField::new("lastLoginTime", "Letzter Login")->setFormTypeOption("disabled", true),
            AssociationField::new("riddleResults", "Ergebnisse")
                ->hideOnIndex()
                ->setFormTypeOption("disabled", true)
                ->setFormTypeOption("attr.class", "col-9")
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setStudentPassword($entityInstance);
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setStudentPassword($entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }

    private function setStudentPassword(Student $student): void
    {
        if ($student->getPlainPassword()) {
            $student->setPassword($this->encoder->encodePassword($student, $student->getPlainPassword()));
        }
    }

    /**
     * @required
     * @param UserPasswordEncoderInterface $encoder
     */
    public function setEncoder(UserPasswordEncoderInterface $encoder): void
    {
        $this->encoder = $encoder;
    }
}
