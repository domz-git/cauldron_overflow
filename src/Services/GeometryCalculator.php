<?php

Namespace App\Services;

use App\Entity\Triangle;
use App\Repository\TriangleRepository;
use Symfony\Component\HttpFoundation\Response;


class GeometryCalculator {
    public function numOfTri(TriangleRepository $triangleRepository){
        $i=0;
        $triangles = $triangleRepository->findAll();
        foreach ($triangles as $var => $value) {
            $i++;
        }

        return($i);
    }

    /**
     * @param TriangleRepository $triangleRepository
     * @return float|int|Response
     */
    public function calculateCirc(TriangleRepository $triangleRepository){
        $circsum=0;
        $triangles = $triangleRepository->findAll();
        $triangle = new Triangle();
        foreach ($triangles as $var => $value) {
            $circ = $triangle->circumference($value->SideA, $value->SideB, $value->SideC);
            $circsum = $circsum + $circ;
        }

        return($circsum);
    }
    /**
     * @param TriangleRepository $triangleRepository
     * @return float|int|Response
     */
    public function calculateSurf(TriangleRepository $triangleRepository){
        $surfsum=0;
        $triangles = $triangleRepository->findAll();
        $triangle = new Triangle();
        foreach ($triangles as $var => $value) {
            $surf = $triangle->surface($value->SideA, $value->SideB, $value->SideC);
            $surfsum = $surfsum + $surf;
        }

        return($surfsum);
    }
}