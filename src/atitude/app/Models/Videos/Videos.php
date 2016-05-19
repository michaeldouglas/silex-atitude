<?php

namespace atitude\app\Models\Videos;

class Videos
{
    
    protected $table = 'tb_videos';
    
    public function getVideos($app, $id = 1)
    {
       
        if(!$app['cache']->fetch('videos')) {
            $dadosVideos = $app['entityManager']->getRepository('atitude\app\Models\Entities\Api\Videos')->findOneBy(array('id_video' => $id));
            $app['cache']->store('videos', $dadosVideos);
        } else {
            $dadosVideos = $app['cache']->fetch('videos');
        }

        return $dadosVideos;
    }
    
    public function setVideos($app, $embed = '')
    {
        return $app['db']->insert($this->table, ['embed_video' => $embed]);
    }
}