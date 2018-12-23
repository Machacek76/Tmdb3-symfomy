<?php


namespace App\Model;

use App\Entity\ProductionCompanies;







class ProductionCompaniesModel extends AbstractBaseModel {

    protected $lang;

    public function __construct($doctrine)
    {

        parent::__construct($doctrine);

        $this->entity = new ProductionCompanies();

    }

    public function makeProductionCompanies(array $production, string $lang = 'cs'): array
    {
        $this->lang = $lang;
        
        if(!$this->repository){
            $this->repository = $this->doctrine->getRepository(\App\Entity\ProductionCompanies::class);
        }


        $ret = [];
        foreach($production as $item){
            $ret[] = $this->saveProductionCompanies($item);
        }

        return $ret;

    }


    
    private function saveProductionCompanies ($item){
        

        $ar = ['uid'=>$item['id']];
        $res = $this->repository->findOneBy($ar);


        if($res){
            $res->setName($item['name']);
            $res->setLogoPath($item['logo_path']);
            $res->setOriginCountry($item['origin_country']);
            $res->setUpdatedAt(new \DateTime());
            $this->manager->flush();
            $this->manager->clear();
            return $res->getId();
        }else{
            $this->entity->setUid($item['id']);
            $this->entity->setName($item['name']);
            $this->entity->setLogoPath($item['logo_path']);
            $this->entity->setOriginCountry($item['origin_country']);
            $this->entity->setCreatedAt(new \DateTime());
            $this->manager->persist($this->entity);
            $this->manager->flush();
            $this->manager->clear();
            return $this->entity->getId();
        }
    }


}



