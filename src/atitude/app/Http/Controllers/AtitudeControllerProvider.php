<?php

namespace atitude\app\Http\Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use atitude\app\Models\Videos\Videos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Atitude API
 *
 * @category   API
 * @package    atitude\app\Http\Controllers
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      2016-05-19
 *
 * @copyright  Atitude
 */
class AtitudeControllerProvider implements ControllerProviderInterface
{
    private $videos;
    
    public function __construct() {
        $this->videos = new Videos();
    }
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];
        
        /**
         * Rota para obtenção de vídeos.
         * @return json retorna o Json contendo o objeto do vídeo
         */
        $controllers->get('/{id}', function (Application $app, $id) {
            if(count($this->getVideos($app, $id)) == 0) {
                return new Response('Vídeos não encontrado', 400 , array('X-Status-Code' => 200));
            }
            return $app->json($this->getVideos($app, $id), 201);
        });
        
        /**
         * Rota para inserção de vídeos.
         * @return retorna como inserido com sucesso!
         */
        $controllers->post('/inserir', function(Application $app, Request $request) {
            if(!$this->setVideos($app, $request))
            {
                return $app->abort(500, 'Inserção de vídeo falhou!.');
            }
            
            return new Response('Vídeos inserido com sucesso!', 201);
            
        });

        return $controllers;
    }
    
    /**
     * @ApiDescription(section="Obter videos", description="Serviço responsável por obter os vídeos da atitude")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/atitude/{id}")
     * @ApiParams(name="id", type="integer", nullable=false, description="Identificador do vídeo")
     * @ApiReturnHeaders(sample="HTTP 201 OK")
     * @ApiReturn(type="object", sample="{
     *  'id_video':'int',
     *  'embed_video':'string'
     * }")
     */
    protected function getVideos($app, $id)
    {
        return $this->videos->getVideos($app, $id);
    }
    
    /**
     * @ApiDescription(section="Inserir videos", description="Serviço responsável por inserir um novo vídeo")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/atitude")
     * @ApiParams(name="embed", type="string", nullable=false, description="String do vídeo a ser inserido")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *  'embed':'OK'
     * }")
     */
    protected function setVideos($app, $request)
    {
        return $this->videos->setVideos($app, $request->get('embed'));
    }
}