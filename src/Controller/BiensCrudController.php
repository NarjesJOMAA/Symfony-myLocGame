<?php

namespace App\Controller;

use App\Entity\Biens;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;


class BiensCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Biens::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('proprietaire'),
            TextField::new('categories'),
            TextEditorField::new('description'),
            ImageField::new('imageFile'),
            TextField::new('imageName'),
        ];
    }
    
}
