<?php

namespace App\Controller;

use App\Entity\Triangle;
use App\Repository\TriangleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/triangle", name="triangle")
 */
class TriangleController extends AbstractController
{

    /**
     * @Route("/", name="index")
     * @param TriangleRepository $triangleRepository
     * @return Response
     */
    public function index(TriangleRepository $triangleRepository)
    {
        $triangles = $triangleRepository->findAll();
        dump($triangles);
        $sql = "SELECT * FROM triangle";
        $connect = mysqli_connect("localhost","root","","triangle_db");
        $result = mysqli_query($connect, $sql);
        $json_array = array();
        while($row=mysqli_fetch_assoc($result)){
            $json_array[] = $row;
        }
        echo json_encode($json_array);
        return $this->render('triangle/index.html.twig', [
            'controller_name' => 'TriangleController',
        ]);
    }
    /**
     * @Route("/triangles", name="triangles")
     */
    public function GeometryCalculator()
    {
        $connect = mysqli_connect("localhost","root","","triangle_db");
        $sql = "SELECT * FROM triangle";
        $result = mysqli_query($connect, $sql);
        $json_array = array();
        $A = array();
        $B = array();
        $C = array();
        $triangle = new Triangle();
        $i=0;
        $circsum=0;
        $surfsum=0;

        while($row=mysqli_fetch_assoc($result)){

            $json_array[] = $row;
            $A[] = "" . $row['side_a'] . "";
            $B[] = "" . $row['side_b'] . "";
            $C[] = "" . $row['side_c'] . "";

            $circ = $triangle->circumference($A[$i],$B[$i],$C[$i]);
            $circsum = $circsum + $circ;
            $surf = $triangle->surface($A[$i],$B[$i],$C[$i]);
            $surfsum = $surfsum + $surf;
            $i++;
        }
        echo json_encode($json_array);
        echo json_encode($A);
        echo json_encode($B);
        echo json_encode($C);
        echo "<br>";
        echo '"number_of_triangles": ',json_encode($i),"<br>";
        echo '"total_surface": ',json_encode($surfsum),"<br>";
        echo '"total_circumference": ',json_encode($circsum),"<br>";
        return $this->render('triangle/index.html.twig', [
            'controller_name' => 'TriangleController',
        ]);
    }

    /**
     * @Route("/{slug_a}/{slug_b}/{slug_c}")
     * @param Request $request
     * @param $slug_a
     * @param $slug_b
     * @param $slug_c
     * @return Response
     */

    public function create(Request $request, $slug_a, $slug_b, $slug_c){
        $triangle_create = new Triangle();

        $triangle_create->setSideA($slug_a);
        $triangle_create->setSideB($slug_b);
        $triangle_create->setSideC($slug_c);


        $em = $this->getDoctrine()->getManager();
        $em->persist($triangle_create);
        $em->flush();

        return new Response('Triangle was created');

    }
}

