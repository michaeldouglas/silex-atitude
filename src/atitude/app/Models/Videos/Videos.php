<?php

namespace atitude\app\Models\Videos;

class Videos
{
    
    protected $table = 'tb_videos';
    
    public function getVideos($app, $id = 1)
    {
        return $app['entityManager']->getRepository('atitude\app\Models\Entities\Api\Videos')
        ->findOneBy(array('id_video' => $id));
    }
    
    public function setVideos($app, $embed = '')
    {
        return $app['db']->insert($this->table, ['embed_video' => $embed]);
    }
}