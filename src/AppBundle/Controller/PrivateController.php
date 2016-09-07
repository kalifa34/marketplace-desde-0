<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Trayecto;

class PrivateController extends Controller
{
    /**
     * @Route("/nuevoTrayecto", name="private_nuevoTrayecto")
     */
    public function nuevoTrayectoAction(Request $request)
    {
        
        /**
         * muestra un formulario para crear un nuevp trayecto
         * 
         * 1.- Crear carpeta nueva /app/Resources/views/trayecto
         * 1. Habría que copiar los twig de nuevoTrayecto.html.twig
         * 2. Y indicar en el render que se muestren
         *  
         * 
         * */
        return $this->render('nuevoTrayecto/index.html.twig');
    }
        
        
        
     /**
     * @Route("/publicarTrayecto", name="private_publicarTrayecto")
     */
     
    public function publicarTrayectoAction(Request $request)
    {
    
        /**
         * Guarda los datos enviados por el formulario nuevoTrayecto
         * 
         * 1. Habría que guardar los datos recibiendos en $_GET en un nuevoTrayecto
         * 1.- Crear carpeta nueva /app/Resources/views/trayecto
         * 
         * */
        
        $nuevoTrayecto=new Trayecto();
        
        $nuevoTrayecto->setOrigen(($request->get('origen')));
        $nuevoTrayecto->setDestino($request->get('destino'));
        $nuevoTrayecto->setCalle($request->get('calle'));
        $fechaDateTime = new \DateTime($request->get('fechaDeViaje'));
        $nuevoTrayecto->setFechaDeViaje($fechaDateTime);
        $horaDateTime = new \DateTime($request->get('horaDeViaje'));
        $nuevoTrayecto->setHoraDeViaje($horaDateTime);
        $nuevoTrayecto->setPrecio($request->get('precio'));
        $nuevoTrayecto->setDescripcion($request->get('descripcion'));
        $nuevoTrayecto->setPlazas($request->get('plazas'));
        $usuarioLogueado = $this->getUser();
        $nuevoTrayecto->setConductor($usuarioLogueado);
        
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($nuevoTrayecto);
        $entityManager->flush();
 
        return $this->redirect($this->generateUrl('public_home'));
    }
}

