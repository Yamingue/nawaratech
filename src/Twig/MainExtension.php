<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\TwigFunction;
use App\Entity\Service;
use App\Entity\Realisation;
use App\Repository\ServiceRepository;
use Twig\Extension\AbstractExtension;
use App\Repository\RealisationRepository;

class MainExtension extends AbstractExtension
{
    private $realisationRepo;
    private $serviceRepository;

    public function __construct(RealisationRepository $realisationRepo, ServiceRepository $serviceRepository)
    {
        $this->realisationRepo= $realisationRepo;
        $this->serviceRepository= $serviceRepository;
    }
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            //new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('realisations', [$this, 'realisations']),
            new TwigFunction('services', [$this, 'services']),
        ];
    }
    /**
     * @param $number int
     * @return Realisation[] | null
     */
    public function realisations($number = 10) 
    {
        return $this->realisationRepo->findLimite($number);
    }

    /**
     * @param $number int
     * @return Service[] | null
     */
    public function services($number = 4) 
    {
        return $this->serviceRepository->findLimite($number);
    }
}
