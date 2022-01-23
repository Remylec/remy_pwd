<?php


namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('genderFilter',[$this,'formatGender'])
        ];
    }

    public function formatGender($gender)
    {
        switch ($gender) {
            case 'h':
                $gender = 'Homme';
                break;
            case 'f':
                $gender = 'Femme';
                break;
            case 'j':
                $gender = 'Junior';
                break;
        }
        return $gender;
    }
}
