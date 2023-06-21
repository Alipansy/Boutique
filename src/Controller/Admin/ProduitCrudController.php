<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextField::new('couleur'),
            ChoiceField::new('taille')->setChoices([
                'XS'=> 'xs', 
                'S'=> 's',
                'M'=>'m', 
                'L'=>'l', 
                'XL'=>'xl',
                'XXL' =>'XXL'
            ]),
            ChoiceField::new('collection')->setChoices([
                'Femme' =>'femme',
                'Homme' => 'homme',
                'Enfant'=>'enfant'
            ]),
            ImageField::new('photo')->setBasePath('photo')->setUploadDir('public/photos')->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),
            NumberField::new('prix'),
            NumberField::new('stock'),
            TextEditorField::new('description'),
            DateTimeField::new('date_enregistrement')->setFormat('d/M/Y à H:m:s')->hideOnForm(),
            
        ];
            
    }
    public function createEntity(string $entityFqcn)
    {
        $produit = new $entityFqcn; 
        $produit->setDateEnregistrement(new DateTime);
        return $produit; 
    }
    
}
