<?php

namespace atitude\app\Models\Entities\Api;

/**
 * 
 * @Entity
 * @Table(name="tb_videos")
 */
class Videos 
{
    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="id_video")
     */
    public $id_video;
    
    /**
     * @Column(type="string", nullable=false, name="embed_video")
     */
    public $embed_video;
    
    public function getIDVideo() 
    {
        return $this->id_video; 
    }
    
    public function getEmbedVideo()
    {
        return $this->embed_video; 
    }
}