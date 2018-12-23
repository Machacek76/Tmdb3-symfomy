<?php


namespace App\Model;




class Peoplemovie extends AbstractBaseModel {



    /**
     * __construnc
     *
     * @param mixed $doctrine
     * @return void
     */
    public function __construnc($doctrine){
        parent::__construnc($doctrine );
    }




    /**
     * makePeople
     *
     * @param array $data
     * @return void
     */
    public function makePeople(array $data) 
    {

        if(!$this->repository){
            $this->repository = $this->doctrine->getRepository(\App\Entity\People::class);
        }

        if(!$this->entity){
            $this->entity = new People();
        }

    }


    /**
     * savePeople
     *
     * @param array $item
     * @return void
     */
    public function savePeople(array $item)
    {
        
    }


}





