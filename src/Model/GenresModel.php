<?php 


namespace App\Model;



use App\Entity\Genres;





class GenresModel extends AbstractBaseModel {



    
    protected $lang;


    /**
     * __construnc
     *
     * @param mixed $doctrine
     * @return void
     */
    public function __construnct($doctrine)
    {
        parent::__construnct($doctrine );
    }




    /**
     * makeGenres
     *
     * @param array $genres
     * @param mixed string
     * @return void
     */
    public function makeGenres(array $genres, string $lang = 'cs'): array
    {
        $this->lang = $lang;
        

        if(!$this->repository){
            $this->repository = $this->doctrine->getRepository(\App\Entity\Genres::class);
        }

        $ret = [];
        foreach($genres as $genre){
            $ret[] = $this->saveGenres($genre);
        }
        return $ret;
    }


    /**
     * saveGenres
     *
     * @param array $item
     * @return int
     */
    private function saveGenres (array $item):int{
        
    
        $uid = $item['id'];
        $ar = ['uid'=>$uid];

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
            $this->entity->setUid($item['id']);
            $this->entity->setCreatedAt(new \DateTime());
            $this->manager->persist($this->entity);
            $this->manager->flush();
            $this->manager->clear();
            return $this->entity->getId();
        }
    }




}







