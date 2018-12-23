<?php

namespace App\Model;




abstract class AbstractBaseModel {


    public $doctrine;


    public $repository;


    public $manager;

    public $queryBuilder;

    public $entity;




    public function __construct($doctrine)
    {
        
        $this->doctrine = $doctrine;
        $this->manager = $doctrine->getManager();

        $this->queryBuilder = $this->manager->createQueryBuilder();
        
    }
    


    public function sortAlphabetList($list):array
    {

        $ln = 0;
        $out = [];

        foreach($list as $key=>$val){
            if($val['alpha'] !== null && $val['count'] > 0){
                $ln += $val['count'];
                $out[] = $val;
            }
        }

        $out[] = ['alpha'=>'sum', 'count'=>$ln ];

        return $out;
    }




    public function normalize(string $str = null):string
    {
        $out = preg_replace('/[^A-Za-z0-9\ ]/', '', $str) . "\n";
        $out = trim($out);
        return strlen($out) > 0 ? $out : ' ';
    }



    public function getKey (string $key, array $array)
    {
        if(array_key_exists($key, $array)){
            return $array[$key];
        }else{
            return '';
        }
    }


}






