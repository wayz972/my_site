<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            // les inputs de la page product
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name'),
             ImageField::new('Illustration')->setBasePath('uploads')->setUploadDir('public/uploads/')->setUploadedFileNamePattern('[uuid][name].[extension]')->setRequired('false'),
             TextField::new('subtitle'),
             TextareaField::new('description'),
             MoneyField::new('price')->setCurrency('EUR'),
             AssociationField::new('category'),
        ];
    }
}
