<?php


namespace App\Data;


use App\Entity\Brand;


class SearchData
{

    /**
     * @var string
     */
    public $q = '';

    /**
     * @var Brand[]
     */
    public $brands = [];

}
