<?php

namespace App\Controller\Admin;

use App\Entity\CategoryOne;
use App\Entity\CategoryThree;
use App\Entity\CategoryTwo;
use App\Entity\Customers;
use App\Entity\OrderItems;
use App\Entity\Orders;
use App\Entity\Product;
use App\Entity\Status;
use App\Entity\StockMouvements;
use App\Entity\Suppliers;
use App\Entity\Units;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Minosoa');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Categories');
        yield MenuItem::linkToCrud('Categorie 1', 'fas fa-list', CategoryOne::class);
        yield MenuItem::linkToCrud('Categorie 2', 'fas fa-list', CategoryTwo::class);
        yield MenuItem::linkToCrud('Categorie 3', 'fas fa-list', CategoryThree::class);

        yield MenuItem::section('Client');
        yield MenuItem::linkToCrud('Client', 'fas fa-list', Customers::class);

        yield MenuItem::section('Commande');
        yield MenuItem::linkToCrud('Commande', 'fas fa-list', Orders::class);
        yield MenuItem::linkToCrud('Article de Commande', 'fas fa-list', OrderItems::class);

        yield MenuItem::section('Produits');
        yield MenuItem::linkToCrud('Produit', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Status', 'fas fa-list', Status::class);
        yield MenuItem::linkToCrud('Mouvemnet de stock', 'fas fa-list', StockMouvements::class);
        yield MenuItem::linkToCrud('Fournisseur', 'fas fa-list', Suppliers::class);
        yield MenuItem::linkToCrud('Unité', 'fas fa-list', Units::class);

    }
}
