<?php

namespace controller;

use dao\BookDao;
use dao\GenreDao;
use entity\Book;

class BookController
{
    private BookDao $bookDao;
    private GenreDao $genreDao;

    public function __construct()
    {
        $this->bookDao=new BookDao();
        $this->genreDao=new GenreDao();
    }
    public function index(): void
    {
        $deletecmd = filter_input(INPUT_GET,'comd');
        if(isset($deletecmd) && $deletecmd = 'dele'){
            $ISBNdel = filter_input(INPUT_GET,'idb');
            $book=$this->bookDao->fetchOneBook($ISBNdel);
            if($book->getCover()!=null){
                unlink('uploads/'.$book->getCover());
            }

            $results =$this->bookDao->deleteBookFromDb($ISBNdel);

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
            $ISBN = filter_input(INPUT_POST,'ISBN');
            $title = filter_input(INPUT_POST,'title');
            $author = filter_input(INPUT_POST,'author');
            $publisher = filter_input(INPUT_POST,'publisher');
            $publishYear = filter_input(INPUT_POST,'publishYear');
            $shortDesc = filter_input(INPUT_POST,'shortDesc');
            $cover = filter_input(INPUT_POST,'cover');
            $idGenre = filter_input(INPUT_POST,'idGenre');
            if(trim($ISBN) == ''||trim($title) == ''||trim($author) == ''||trim($publisher) == ''||trim($shortDesc) == ''||trim($idGenre) == ''){
                echo `
        <div class="text-center">
            Please provide with a valid name
        </div>
        `;
            }else{
                $bookAdd= new \entity\Book();
                $bookAdd->setIsbn($ISBN);
                $bookAdd->setTitle($title);
                $bookAdd->setAuthor($author);
                $bookAdd->setPublisher($publisher);
                $bookAdd->setYear($publishYear);
                $bookAdd->setDescription($shortDesc);
                $bookAdd->setCover($cover);
                $genreBook= new \entity\Genre();
                $genreBook->setId($idGenre);
                $bookAdd->setGenre($genreBook);
                $results = $this->bookDao->addNewBook($bookAdd);
            }
        }

        $result = $this->bookDao->fetchJoinFromDb();
        $genres = $this->genreDao->fetchGenreFromDb();
        include_once 'pages/book.php';
    }
    public function bookUpdate():void
    {
        $editedISBN = filter_input(INPUT_GET,'isbn');
        if(isset($editedISBN)){
            $book = $this->bookDao->fetchOneBook($editedISBN);
        }
        $updatePressed = filter_input(INPUT_POST,'btnUpdate');
        if(isset($updatePressed)){;
            $title = filter_input(INPUT_POST,'title');
            $author = filter_input(INPUT_POST,'author');
            $publisher = filter_input(INPUT_POST,'publisher');
            $publishYear = filter_input(INPUT_POST,'publishYear');
            $shortDesc = filter_input(INPUT_POST,'shortDesc');
            $idGenre = filter_input(INPUT_POST,'idGenre');
            $bookUpdate=new \entity\Book();
            $bookUpdate->setIsbn($editedISBN);
            $bookUpdate->setTitle($title);
            $bookUpdate->setAuthor($author);
            $bookUpdate->setPublisher($publisher);
            $bookUpdate->setYear($publishYear);
            $bookUpdate->setDescription($shortDesc);
            $genreUpdate=new \entity\Genre();
            $genreUpdate->setId($idGenre);
            $bookUpdate->setGenre($genreUpdate);
            if(trim($title) == ''||trim($author) == ''||trim($publisher) == ''||trim($shortDesc) == ''||trim($idGenre) == ''){
                echo '
            <div class="text-center">
                Please provide with a valid name
            </div>
            ';}else{
                $results = $this->bookDao->updateBookToDb($bookUpdate);
                if($results){
                    header('location:index.php?menu=book');
                }else{
                    echo '
                <div>
                    Failed to add data
                </div>
            ';
                }
            }
        }

        $changePressed = filter_input(INPUT_POST,'coverUpload');
        if(isset($changePressed)){
            $isbn = $book->getIsbn();
            $targetDir = 'uploads/';
            $fileExtension = pathinfo($_FILES['txtFile']['name'],PATHINFO_EXTENSION);
            $fileNameExtension=$isbn.'.'.$fileExtension;
            $fileUploadPath = $targetDir.$isbn.'.'.$fileExtension;
            if($_FILES['txtFile']['size']>1024*8192){
                echo '<div>Uploaded file exceed 8MB</div>';
            }
            else{
                move_uploaded_file($_FILES['txtFile']['tmp_name'],$fileUploadPath);
                $coverUpdate=new \entity\Book();
                $coverUpdate->setIsbn($isbn);
                $coverUpdate->setCover($fileNameExtension);
                $results = $this->bookDao->updateCoverToDb($coverUpdate);
                if($results){
                    header('location:index.php?menu=book');
                }else{
                    echo '
                        <div>
                            Failed to add data
                        </div>
                    ';
                }
            }
        }
        $result = $this->genreDao->fetchGenreFromDb();
        include_once 'pages/book_edit.php';
    }
    public function coverUpdate(): void
    {
        $editedISBN = filter_input(INPUT_GET,'isbna');
        if(isset($editedISBN)){
            $book = $this->bookDao->fetchOneBook($editedISBN);
            $updatePressed = filter_input(INPUT_POST,'btnUpload');
            if(isset($updatePressed)){
                $isbn = $book->getIsbn();
                $fileName = filter_input(INPUT_GET,'isbna');
                $targetDir = 'uploads/';
                $fileExtension = pathinfo($_FILES['txtFile']['name'],PATHINFO_EXTENSION);
                $fileNameExtension=$fileName.'.'.$fileExtension;
                $fileUploadPath = $targetDir.$fileName.'.'.$fileExtension;
                if($_FILES['txtFile']['size']>1024*8192){
                    echo '<div>Uploaded file exceed 8MB</div>';
                }
                else{
                    move_uploaded_file($_FILES['txtFile']['tmp_name'],$fileUploadPath);
                    $coverUpdate=new \entity\Book();
                    $coverUpdate->setIsbn($isbn);
                    $coverUpdate->setCover($fileNameExtension);
                    $results = $this->bookDao->updateCoverToDb($coverUpdate);
                    if($results){
                        header('location:index.php?menu=book');
                    }else{
                        echo '
                    <div>
                        Failed to add data
                    </div>
                ';
                    }
                }
            }
        }
        include_once 'pages/cover_edit.php';
    }
}