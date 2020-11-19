<?php

namespace App\Controller\Admin\Crud;

use App\Entity\User;
use App\EventSubscriber\Form\EncodePasswordSubscriber;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

class UserCrudController extends AbstractCrudController
{
    /**
     * @var EncodePasswordSubscriber
     */
    private $encodePasswordSubscriber;

    public function __construct(EncodePasswordSubscriber $encodePasswordSubscriber)
    {
        $this->encodePasswordSubscriber = $encodePasswordSubscriber;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('Users')
            ->setSearchFields([
                'firstname',
                'lastname',
                'email',
            ])
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        $legalInformationsPanel = FormField::addPanel('Legal informations')->setIcon('fa fa-id-card');
        $accountInformationsPanel = FormField::addPanel('Account informations')->setIcon('fa fa-user');
        $passwordPanel = FormField::addPanel('Password')->setIcon('fa fa-key');

        $firstnameField = TextField::new('firstname');
        $lastnameField = TextField::new('lastname');
        $rolesField = ArrayField::new('roles');
        $emailField = EmailField::new('email');
        $oldPassword = TextField::new('oldPassword')
            ->setFormType(PasswordType::class)
            ->setRequired(false)
        ;
        $plainPasswordField = TextField::new('plainPassword')
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'first_options' => ['label' => 'New password'],
                'second_options' => ['label' => 'Repeat password'],
            ])
            ->setRequired(false)
        ;
        $enabledField = BooleanField::new('enabled');
        $enabledAtField = DateTimeField::new('enabledAt');
        $lockedField = BooleanField::new('locked');
        $lockedAtField = DateTimeField::new('lockedAt');
        $companiesField = AssociationField::new('companies');
        $createdAtField = DateTimeField::new('createdAt');

        if (Crud::PAGE_INDEX === $pageName) {
            yield $firstnameField;
            yield $lastnameField;
            yield $emailField;
            yield $rolesField;
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            // Legal Informations panel
            yield $legalInformationsPanel;
            yield $firstnameField;
            yield $lastnameField;

            // Account informations panel
            yield $accountInformationsPanel;
            yield $emailField;
            yield $companiesField;
            yield $rolesField;
            yield $enabledField;
            yield $enabledAtField;
            yield $lockedField;
            yield $lockedAtField;
            yield $createdAtField;
        } elseif (
            Crud::PAGE_NEW === $pageName
            || Crud::PAGE_EDIT === $pageName
        ) {
            // Legal Informations panel
            yield $legalInformationsPanel;
            yield $firstnameField;
            yield $lastnameField;

            // Account informations panel
            yield $accountInformationsPanel;
            yield $emailField;
            yield $companiesField;
            yield $rolesField;
            yield $enabledField;
            yield $lockedField;

            // Password Panel
            yield $passwordPanel;

            if (Crud::PAGE_EDIT === $pageName) {
                yield $oldPassword;
            }

            yield $plainPasswordField;
        }
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);

        $this->addEncodePasswordSubscriber($formBuilder);

        return $formBuilder;
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);

        $this->addEncodePasswordSubscriber($formBuilder);

        return $formBuilder;
    }

    protected function addEncodePasswordSubscriber(FormBuilderInterface $formBuilder)
    {
        $formBuilder->addEventSubscriber($this->encodePasswordSubscriber);
    }
}