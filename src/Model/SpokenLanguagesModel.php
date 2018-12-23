<?php


namespace App\Model;

use App\Entity\SpokenLanguage;





class SpokenLanguagesModel extends AbstractBaseModel {



    protected $lang;


    public function __construct($doctrine)
    {
        parent::__construct($doctrine);
        $this->entity = new SpokenLanguage();
    }



    public function makeSpokenLanguages (array $spoken, string $lang = 'cs'): array
    {

        $this->lang = $lang;
        
        if(!$this->repository){
            $this->repository = $this->doctrine->getRepository(\App\Entity\SpokenLanguage::class);
        }
        
        $return = [];

        foreach ($spoken as $item){
            $return [] = $this->saveSpokenLanguages($item);
        }

        return $return;
    }




    private function saveSpokenLanguages (array $item):int{

        $ar = ['iso_639_1'=>$item['iso_639_1']];

        $res = $this->repository->findOneBy($ar);

        if($res){
            if($this->lang === 'cs'){
                $res->setCsName($item['name']);
            }else{
                $res->setName($item['name']);
            }
            $res->setUpdatedAt(new \DateTime());
            $this->manager->flush();
            $this->manager->clear();
            return $res->getId();
        }else{
            if($this->lang === 'cs'){
                $this->entity->setCsName($item['name']);
            }else{
                $this->entity->setName($item['name']);
            }
            $this->entity->setIso($item['iso_639_1']);
            $this->entity->setCreatedAt(new \DateTime());
            $this->manager->persist($this->entity);
            $this->manager->flush();
            $this->manager->clear();
            return $this->entity->getId();
        }
    }






}






