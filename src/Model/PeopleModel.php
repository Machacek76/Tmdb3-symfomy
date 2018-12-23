<?php


namespace App\Model;



use App\Entity\People;

class PeopleModel extends AbstractBaseModel {


    /**
     * $lang
     *
     * @var string
     */
    private $lang;


    /**
     * __construnc
     *
     * @param mixed $doctrine
     * @return void
     */
    public function __construnct($doctrine){
        parent::__construnct($doctrine );
    }




    /**
     * makePeople
     *
     * @param array $data
     * @return void
     */
    public function makePeople(array $data, string $lang) 
    {

        if(!$this->repository){
            $this->repository = $this->doctrine->getRepository(\App\Entity\People::class);
        }

        if(!$this->entity){
            $this->entity = new People();
        }

        $this->lang = $lang;
        $this->savePeople($data);
    }


    /**
     * savePeople
     *
     * @param array $item
     * @return void
     */
    public function savePeople(array $item)
    {
            //  return;
        $ar = ['uid'=>$item['id']];
        $res = $this->repository->findOneBy($ar);

        if($res){
            $res->setUid($item['id']);
            $res->setKnowForDepartment($item['known_for_department']);
            $res->setName($item['name']);
            $res->setAlsoKnowAs($item['also_known_as']);
            $res->setGender($item['gender']);
            $res->setPopularity($item['popularity']);
            $res->setPlaceOfBirth($item['place_of_birth']);
            $res->setProfilePath($item['profile_path']);
            $res->setAdult($item['adult']);
            $res->setImdbId($item['imdb_id']);
            $res->setHomepage($item['homepage']);
            
            $bir = \DateTime::createFromFormat('Y-m-d', $item['birthday']);
            $dea = \DateTime::createFromFormat('Y-m-d', $item['deathday']);

            if($bir){
                $res->setBirthday( $bir );
            }

            if($dea){
                $res->setDeathday( $dea );
            }

            if($this->lang === 'cs'){
                $res->setCsBiography($item['biography']);
            }else{
                $res->setBiography($item['biography']);
            }


            $res->setUpdatedAt(new \DateTime());

            $this->manager->flush();
            $this->manager->clear();
            return $res->getId();
        }else{

            $this->entity->setUid($item['id']);
            $this->entity->setKnowForDepartment($item['known_for_department']);
            $this->entity->setName($item['name']);
            $this->entity->setAlsoKnowAs($item['also_known_as']);
            $this->entity->setGender($item['gender']);
            $this->entity->setPopularity($item['popularity']);
            $this->entity->setPlaceOfBirth($item['place_of_birth']);
            $this->entity->setProfilePath($item['profile_path']);
            $this->entity->setAdult($item['adult']);
            $this->entity->setImdbId($item['imdb_id']);
            $this->entity->setHomepage($item['homepage']);
           
            
            $bir = \DateTime::createFromFormat('Y-m-d', $item['birthday']);
            $dea = \DateTime::createFromFormat('Y-m-d', $item['deathday']);

            if($bir){
                $this->entity->setBirthday( $bir );
            }

            if($dea){
                $this->entity->setDeathday( $dea );
            }


            if($this->lang === 'cs'){
                $this->entity->setCsBiography($item['biography']);
            }else{
                $this->entity->setBiography($item['biography']);
            }

            $this->entity->setCreatedAt(new \DateTime());
            $this->manager->persist($this->entity);
            $this->manager->flush();
            $this->manager->clear();
            return $this->entity->getId();
        }
    }






}





