<?php

Namespace App\Services;

use App\Entity\Triangle;
use App\Repository\TriangleRepository;
use Psr\Container\ContainerInterface;


class GeometryCalculator {

    public $trirep;
    public function __construct(TriangleRepository $triangleRepository){
        $this->trirep = $triangleRepository;
    }

    public function numOfTri(){
        $i=0;
        $triangles = $this->trirep->findAll();
        foreach ($triangles as $var => $value) {
            $i++;
        }

        return($i);
    }


    public function calculateCirc(){
        $circsum=0;
        $triangles = $this->trirep->findAll();
        $triangle = new Triangle();
        foreach ($triangles as $var => $value) {
            $circ = $triangle->circumference($value->SideA, $value->SideB, $value->SideC);
            $circsum = $circsum + $circ;
        }

        return($circsum);
    }


    public function calculateSurf(){
        $surfsum=0;
        $triangles = $this->trirep->findAll();
        $triangle = new Triangle();
        foreach ($triangles as $var => $value) {
            $surf = $triangle->surface($value->SideA, $value->SideB, $value->SideC);
            $surfsum = $surfsum + $surf;
        }

        return($surfsum);
    }
}