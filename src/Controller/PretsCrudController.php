<?php

namespace App\Controller;

use App\Entity\Prets;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;


class PretsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prets::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateField::new('Date_debut'),
            DateField::new('Date_fin'),
        ];
    }
    
}
