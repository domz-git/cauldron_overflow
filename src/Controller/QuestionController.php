<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController{

    /**
     * @Route("/")
     */
public function homepage(){

    return new Response('This is some text');
}

    /**
     * @Route("/questions/{slug}")
     */
public function show($slug){

    return new Response(sprintf('This page is how to "%s"!', ucwords(str_replace('-',' ',$slug))));


}
}