<?php

namespace controller;

use dao\GenreDao;

class GenreController
{
    private GenreDao $genreDao;
    public function __construct()
    {
        $this->genreDao = new GenreDao();
    }
    public function index():void
    {
        $deleteCommand = filter_input(INPUT_GET,'cmd');
        if(isset($deleteCommand) && $deleteCommand = 'del'){
            $genreId = filter_input(INPUT_GET,'gid');
            $results = $this->genreDao->deleteGenreFromDb($genreId);
            if($results){
                echo '
        <div>
            Data Successfully added
        </div>
    ';
            }else{
                echo '
        <div>
            Failed to add data
        </div>
    ';
            }
        }

        $submitPressed = filter_input(INPUT_POST,'btnSave');
        if(isset($submitPressed)){
            $name = filter_input(INPUT_POST,'textName');
            if(trim($name) == ''){
                echo '
        <div class="text-center">
            Please provide with a valid name
        </div>
        ';
            }else{
                $genre = new \entity\Genre();
                $genre->setName($name);
                $results=$this->genreDao->addNewGenre($genre);
//        $results = addNewGenre($name);
                if($results){
                    echo '
            <div>
                Data Successfully added
            </div>
        ';
                }else{
                    echo '
            <div>
                Failed to add data
            </div>
        ';
                }

            }
        }
        $results = $this->genreDao->fetchGenreFromDb();
        include_once 'pages/genre.php';
    }
    public function genreUpdate():void
    {

        $editedId = filter_input(INPUT_GET,'gid');
        if(isset($editedId)){
            $genre = $this->genreDao->fetchOneGenre($editedId);
//        /**  @var $genre \entity\Genre */
        }
        $updatePressed = filter_input(INPUT_POST,'btnUpdate');
        if(isset($updatePressed)){
            $name = filter_input(INPUT_POST,'textName');
            if(trim($name) == ''){
                echo '
            <div class="text-center">
                Please provide with a valid name
            </div>
            ';
            }else{
                $genreUpdate = new \entity\Genre();
                $genreUpdate-> setId($genre->getId());
                $genreUpdate-> setName($name);
                $results = $this->genreDao->updateGenreToDb($genreUpdate);
                if($results){
                    header('location:index.php?menu=genre');
                }else{
                    echo '
                <div>
                    Failed to Update data
                </div>
            ';
                }
            }
        }
        include_once 'pages/genre_edit.php';
    }

}