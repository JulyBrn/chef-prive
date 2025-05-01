<?php

namespace App\Controller\Admin;

use App\Entity\Galerie;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
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
            ImageField::new('image_file') // Utilise 'image_file' pour stocker le chemin
                ->setBasePath('uploads/images') // Dossier public où l'image sera accessible
                ->setUploadDir('public/uploads/images') // Dossier où l'image est enregistrée
                ->setUploadedFileNamePattern('[randomhash].[extension]') // Nom unique pour éviter les conflits
                ->setRequired(true), // Définir ce champ comme obligatoire
        ];
    }
}
