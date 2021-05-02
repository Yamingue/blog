<?php

namespace App\Twig;

use App\Repository\TypeRevuRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    private $typeRevuRepository;
    public  function __construct(TypeRevuRepository $typeRevuRepository)
    {
        $this->typeRevuRepository = $typeRevuRepository;
    }
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('getMenu', [$this, 'getMenu']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getMenu', [$this, 'getMenu']),
        ];
    }

    public function getMenu()
    {
        return $this->typeRevuRepository->findAll();
    }
}
