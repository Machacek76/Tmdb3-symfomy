<?php



namespace App\Repository\Tmdb;






class MyTmdb extends TMDb {


    public $tmdb;



    public function __construct()
    {
        parent::__construct('1016fca9f2b482782f70a11868ca6556', 'cs',  FALSE, TMDb::API_SCHEME_SSL);

//        $tmdb = new TMDb();
    }




}





