<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
            ChoiceField::new('role')->setChoices([
                'ROLE_ADMIN' =>'ROLE_ADMIN',
                'ROLE_USER' => 'ROLE_USER',
                
            ]),
        ];
        }
        public function createEntity(string $entityFqcn)
    {
        $user = new $entityFqcn; 
        $user->setDateEnregistrement(new DateTime);
        return $user; 
    }
}
