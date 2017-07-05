<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use GuzzleHttp\Pool;
use GuzzleHttp\Client;
//use GuzzleHttp\Psr7\Request;


class DefaultController extends Controller
{
    public function listAction(Request $request){
        $client = new Client();
        $req = $client->request('GET', 'https://clarosports.grupo-link.com/api_futbol_v4.3/web/methods/v3_0/info/get/news/paginates/1/0');
        $decode = json_decode($req->getBody());
        $total = $decode->news;

        if ($total != 0) {
            $noticias = $decode->news;
        }
        return $this->render('AppBundle:User:home.html.twig',
            ['noticias' => $noticias]);

    }

    public function detailsAction(Request $request){
        //Recoge metodo por GET
        $id = $request->get('id');
        //var_dump("GET:".$id);
        $client = new Client();
        $req = $client->request('GET', 'https://clarosports.grupo-link.com/api_futbol_v4.3/web/methods/v3_0/info/get/detail/of/new/'.$id);
        $decode = json_decode($req->getBody());
        $noticia = $decode->data;

        
        return $this->render('AppBundle:User:details.html.twig',
            ['noticia' => $noticia]);

    }


}
