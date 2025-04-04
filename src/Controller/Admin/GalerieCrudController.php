<?php

namespace App\Controller\Admin;

use App\Entity\Galerie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GalerieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Galerie::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('description'),
            ImageField::new('img_url'),
        ];
    }
    
}
