<?php

namespace App\Model;

use App\Entity\MovieCredit;









class MovieCreditsModel extends AbstractBaseModel {
    
    public $entity;

    private $movieId;
    



    public function __construnc($doctrine)
    {
        parent::__construnc($doctrine );
    }



    public function makeMovieCredits (array $data) 
    {        
        if(!$this->repository){
            $this->repository = $this->doctrine->getRepository(\App\Entity\MovieCredit::class);
        }

        if(!$this->entity){
            $this->entity = new MovieCredit();
        }
        

        $this->movieId = $data['id'];

        $cnt = 0;
        foreach ($data['crew'] as $item){
            $this->saveMovieCredits($item, 'crew', $cnt++);
        }

        foreach ($data['cast'] as $item){
            $this->saveMovieCredits($item, 'cast', $item['order']);
        }
        
    }
    
    
    public function saveMovieCredits(array $item, string $type, int $order)
    {
        $ar = ['credit_id'=>$item['credit_id']];
        $res = $this->repository->findOneBy($ar);
        

        if($res){
            $res->setMovieId($this->movieId);
            $res->setCastId($item['id']);
            $res->setCharacter($this->getKey('character', $item));
            $res->setCreditId($item['credit_id']);
            $res->setGender($item['gender']);
            $res->setName($item['name']);
            $res->setProfilePath($item['profile_path']);
            $res->setType($type);
            $res->setOrderBy($order);
            $res->setDepartment($this->getKey('department', $item));
            $res->setJob($this->getKey('job', $item));

            $res->setUpdatedAt(new \DateTime());
            $this->manager->flush();
            $this->manager->clear();
        }else{
            $this->entity->setMovieId($this->movieId);
            $this->entity->setCastId($item['id']);
            $this->entity->setCharacter($this->getKey('character', $item));
            $this->entity->setCreditId($item['credit_id']);
            $this->entity->setGender($item['gender']);
            $this->entity->setName($item['name']);
            $this->entity->setProfilePath($item['profile_path']);
            $this->entity->setType($type);
            $this->entity->setOrderBy($order);
            $this->entity->setDepartment($this->getKey('department', $item));
            $this->entity->setJob($this->getKey('job', $item));

            $this->entity->setCreatedAt(new \DateTime());
            $this->manager->persist($this->entity);
            $this->manager->flush();
            $this->manager->clear();
        }




    }




}
