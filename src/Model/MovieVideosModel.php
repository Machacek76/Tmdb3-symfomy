<?php

namespace App\Model;

use App\Entity\MovieVideos;









class MovieVideosModel extends AbstractBaseModel {
    
    public $entity;



    private $movieId;

    public function __construnc($doctrine){
        parent::__construnc($doctrine );
    }



    /**
     * makeMovieVideos
     *
     * @param array $data
     * @return void
     */
    public function makeMovieVideos (array $data) {

        if(!$this->repository){
            $this->repository = $this->doctrine->getRepository(\App\Entity\MovieVideos::class);
        }

        if(!$this->entity){
            $this->entity = new MovieVideos();
        }

        $this->movieId = $data['id'];

        foreach ($data['results'] as $item){
            $this->saveMovieVideos($item);
        }


        return $data;
    }



    /**
     * saveGenres
     *
     * @param array $item
     * @return void
     */
    private function saveMovieVideos (array $item)
    {
    
        $uid = $item['id'];
        $ar = ['uid'=>$uid];

        $res = $this->repository->findOneBy($ar);

        if($res){
            $res->setSite($item['site']);
            $res->setIso6391($item['iso_639_1']);
            $res->setIso31661($item['iso_3166_1']);
            $res->setKey($item['key']);
            $res->setName($item['name']);
            $res->setSize($item['size']);
            $res->setType($item['type']);
            $res->setMovieID($this->movieId);

            $res->setUpdatedAt(new \DateTime());
            $this->manager->flush();
            $this->manager->clear();
        }else{
            
            $this->entity->setSite($item['site']);
            $this->entity->setUid($item['id']);
            $this->entity->setIso6391($item['iso_639_1']);
            $this->entity->setIso31661($item['iso_3166_1']);
            $this->entity->setKey($item['key']);
            $this->entity->setName($item['name']);
            $this->entity->setSize($item['size']);
            $this->entity->setType($item['type']);
            $this->entity->setMovieID($this->movieId);

            $this->entity->setCreatedAt(new \DateTime());
            $this->manager->persist($this->entity);
            $this->manager->flush();
            $this->manager->clear();
        }
    }





}



