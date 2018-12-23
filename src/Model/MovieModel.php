<?php


namespace App\Model;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Cocur\Slugify\Slugify;


class MovieModel extends AbstractBaseModel {



    protected $lang;

    protected $movie;

    public $entity;

    protected $genresModel;

    protected $productionCompaniesModel;
    
    protected $productionCountriesModel;

    protected $spokenLanguagesModel;

    protected $genIds = [];

    protected $comIds = [];
    
    protected $couIds = [];

    protected $spoIds = [];

    protected $slug;
    

    
    public function __construnct($doctrine){
        parent::__construnct($doctrine );
    }


    public function generateModels()
    {
        $this->genresModel = new GenresModel($this->doctrine);
        $this->productionCompaniesModel = new ProductionCompaniesModel($this->doctrine);
        $this->productionCountriesModel = new ProductionCountriesModel($this->doctrine);
        $this->spokenLanguagesModel = new SpokenLanguagesModel($this->doctrine);

        if(!$this->entity){
            $this->entity = new Movie();
        }
    }




    ###################################################################################


    public function getAlpahCountNumList():array
    {   

        
        $sql = 'SELECT substr( UPPER (normalize_title),1,1) as alpha, count(UPPER(normalize_title))
                FROM movie
                GROUP BY substr(UPPER(normalize_title),1,1)
                ORDER BY alpha';

        $stmt = $this->manager->getConnection()->prepare($sql);
        $stmt->execute();

        return $this->sortAlphabetList($stmt->fetchAll());
    }


    ###################################################################################

    public function makeMovie(array $movie, string $lang = 'cs') : array
    {




        $this->generateModels();

        $this->lang = $lang;

        $this->movie = $movie;
        $this->repository = $this->doctrine->getRepository(\App\Entity\Movie::class);

        if($this->movie['genres']){
            $this->genIds = $this->genresModel->makeGenres($this->movie['genres'], $this->lang);
        }

        if($this->movie['production_companies']){
            $this->comIds = $this->productionCompaniesModel->makeProductionCompanies($this->movie['production_companies'], $this->lang);
        }

        if($this->movie['production_countries']){
            $this->couIds = $this->productionCountriesModel->makeProductionCountries($this->movie['production_countries'], $this->lang);
        }

        if($this->movie['spoken_languages']){
            $this->spoIds = $this->spokenLanguagesModel->makeSpokenLanguages($this->movie['spoken_languages'], $this->lang);
        }

        $this->saveMovie($this->movie);

        return [ $this->genIds, $this->comIds, $this->couIds, $this->spoIds ];

    }


    private function saveMovie( array $item ){
      //  return;
        $ar = ['uid'=>$item['id']];
        $res = $this->repository->findOneBy($ar);

        $this->slug = new Slugify();


        if($res){
            $res->setAdult($item['adult']);
            $res->setBackdropPath($item['backdrop_path']);
            $res->setBudget($item['budget']);
            $res->setHomepage($item['homepage']);
            $res->setUid($item['id']);
            $res->setImdbId($item['imdb_id']);
            $res->setOriginalLanguage($item['original_language']);
            $res->setOriginalTitle($item['original_title']);
            $res->setOverview($item['overview']);
            $res->setPopularity($item['popularity']);
            $res->setPosterPath($item['poster_path']);
            $res->setReleaseDate(new \DateTime( $item['release_date']) );
            $res->setRevenue($item['revenue']);
            $res->setRuntime($item['runtime']);
            $res->setStatus($item['status']);
            $res->setTagline($item['tagline']);
            $res->setTitle($item['title']);
            $res->setNormalizeTitle($this->slug->slugify($item['title']));
            $res->setVideo($item['video']);
            $res->setVoteAverage($item['vote_average']);
            $res->setVoteCount($item['vote_count']);
            $res->setGenresId($this->genIds);
            $res->setProductionCountriesId($this->couIds);
            $res->setProductionCompaniesId($this->comIds);
            $res->setSpokenLanguagesId($this->spoIds);


            $res->setUpdatedAt(new \DateTime());
            $this->manager->flush();
            $this->manager->clear();
            return $res->getId();
        }else{

            $this->entity->setAdult($item['adult']);
            $this->entity->setBackdropPath($item['backdrop_path']);
            $this->entity->setBudget($item['budget']);
            $this->entity->setHomepage($item['homepage']);
            $this->entity->setUid($item['id']);
            $this->entity->setImdbId($item['imdb_id']);
            $this->entity->setOriginalLanguage($item['original_language']);
            $this->entity->setOriginalTitle($item['original_title']);
            $this->entity->setOverview($item['overview']);
            $this->entity->setPopularity($item['popularity']);
            $this->entity->setPosterPath($item['poster_path']);
            $this->entity->setReleaseDate(new \DateTime( $item['release_date']) );
            $this->entity->setRevenue($item['revenue']);
            $this->entity->setRuntime($item['runtime']);
            $this->entity->setStatus($item['status']);
            $this->entity->setTagline($item['tagline']);
            $this->entity->setTitle($item['title']);
            $this->entity->setNormalizeTitle($this->slug->slugify($item['title']));
            $this->entity->setVideo($item['video']);
            $this->entity->setVoteAverage($item['vote_average']);
            $this->entity->setVoteCount($item['vote_count']);
            $this->entity->setGenresId($this->genIds);
            $this->entity->setProductionCountriesId($this->couIds);
            $this->entity->setProductionCompaniesId($this->comIds);
            $this->entity->setSpokenLanguagesId($this->spoIds);

            $this->entity->setCreatedAt(new \DateTime());
            $this->manager->persist($this->entity);
            $this->manager->flush();
            $this->manager->clear();
            return $this->entity->getId();
        }
    }


}



