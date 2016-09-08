<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PublicController extends Controller
{
    /**
     * @Route("/", name="public_home")
     */
    public function homeAction(Request $request)
    {
        return $this->render('home/index.html.twig');
    }
    
    /**
     * @Route("/list", name="list")
     */
    public function listAction(Request $request)
    {
        // replace this example code with whatever you need
        
        
        $entityManager = $this->getDoctrine()->getManager();
        $repositorioTrayecto = $entityManager->getRepository("AppBundle:Trayecto");
        $trayectos = $repositorioTrayecto->findAll();
        
        
        if ($request->get('posted') != "" || $request->get('country') != "") {
        $parameters=array();
        $queryBuilder = $repositorioTrayecto
            ->createQueryBuilder('trayecto');
        if ($request->get('country')!="") {
            $queryBuilder->where('trayecto.origen = :country')
            ->orWhere('trayecto.destino = :country');
            $parameters['country']=$request->get('country');
        }   
        if($request->get('posted') != ""){
            if ($request->get('country') !="") {
                $queryBuilder->andWhere('fecha.createdAt > :posted');
            } 
            else {
                $queryBuilder->where('fecha.createdAt > :posted');
            } 
            $date=new DateTime();
            $date->modify('-'.$request->get('posted').' day');
            $parameters['posted']=$date;
        }
        $trayectosFiltrados =$queryBuilder->setParameters($parameters)
        ->getQuery()->execute();
    } else {
        $trayectosFiltrados = $trayectos;
    }    
    
        return $this->render('list/index.html.twig', array(
            
            'country' => $request->get('country'),
            'posted' => $request->get('posted'),
            'trayectos' => $trayectosFiltrados
        )
    );
        
        //return $this->render('list/list.html.twig');
        
        /**
         *  0. Para que funcionen estas instrucciones suponemos que tenemos creada nuestra BBDD con la entidad trayectos y persona y
         *   todas las variables correctamente
         *  1. Habría que crear la carpeta app/Resources/views/list
         *  2. Mover dentro de la carpeta .../list los ficheros del proyecto anterior siguientes:
         *      filtroCiudad.html.twig
         *      filtoFecha.html.twig
         *      listadoTrayectos.html.twig
         *      trayecto.html.twig
         * 3. Cambiar los actions de los ficheros por "#"
         * 4. Habría que copiar dentro de esta acción el contenido del fichero controllers/list.php del proyecto anterior donde
         *  se encuentran los filtros para poder mostrar todos los datos de forma correcta (Habría que modificar la variable $_GET por $request
         *  y las demás variables que puedan cambiar en el nuevo proyecto).
         * 5. Incluir un array en el render con als variables que necesita la página para poder mostrar los datos (country, posted, trayectos).
         *
         * 
         * 
         * Copiar fichero list/index.html.twig:
         * https://github.com/sopinet-curso-php/marketplace-symfony/blob/semana7/app/Resources/views/list/index.html.twig
         *
         * Poner _ a los ficheros que se incluyen
         *
         * En el controlador, cargar el list/index.html.twig
         **/
    }
    
    
    
    
}
