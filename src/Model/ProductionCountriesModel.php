<?php


namespace App\Model;

use App\Entity\ProductionCountries;








class ProductionCountriesModel extends AbstractBaseModel {


    protected $lang;


    public function __construct($doctrine)
    {
        parent::__construct($doctrine);

        $this->entity = new ProductionCountries();

    }



    public function makeProductionCountries(array $production, string $lang = 'cs'): array
    {

        $this->lang = $lang;
        
        if(!$this->repository){
            $this->repository = $this->doctrine->getRepository(\App\Entity\ProductionCountries::class);
        }

        $ret = [];
        foreach($production as $item){
            $ret[] = $this->saveProductionCountries($item);
        }

        return $ret;
    }



    private function saveProductionCountries(array $item):int
    {
        $ar = ['iso_3166_1'=>$item['iso_3166_1']];
        $res = $this->repository->findOneBy($ar);

        
        if($res){
            $res->setName($item['name']);
            $res->setIso($item['iso_3166_1']);
            $res->setUpdatedAt(new \DateTime());
            $this->manager->flush();
            $this->manager->clear();
            return $res->getId();
        }else{
            $this->entity->setIso($item['iso_3166_1']);
            $this->entity->setName($item['name']);
            $this->entity->setCreatedAt(new \DateTime());
            $this->manager->persist($this->entity);
            $this->manager->flush();
            $this->manager->clear();
            return $this->entity->getId();
        }
    }




}




