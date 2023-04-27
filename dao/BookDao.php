<?php

namespace dao;
use PDO;
use entity\Book;
class BookDao
{
    public function fetchJoinFromDb(){
        $link = PDOUtil::createMySQLConnection();
        $query = "SELECT ISBN,cover,title,author,publisher,publish_year,genre.name FROM book INNER JOIN genre WHERE book.genre_id = genre.id;";
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Book::class);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $link =null;
        return $result;
    }
    public function fetchBookFromDb(){
        $link = PDOUtil::createMySQLConnection();
        $query = "SELECT id,name FROM genre WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->execute();
        $result2 = $stmt->fetchAll();
        $link =null;
        return $result2;
    }
    public function fetchBook2FromDb($editedISBN){
        $link = PDOUtil::createMySQLConnection();
        $query = "SELECT * FROM genre WHERE ";
        $stmt = $link->prepare($query);
        $stmt->execute();
        $result2 = $stmt->fetchAll();
        $link =null;
        return $result2;
    }
    public function fetchOneBook($isbn){
        $link = PDOUtil::createMySQLConnection();
        $query = "SELECT ISBN,cover,title,author,publisher,publish_year,short_description,genre_id  FROM book WHERE ISBN = ?;";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$isbn);
        $stmt->SetFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $result = $stmt->fetchObject(Book::class);
//        $result = $stmt->fetch();
        $link =null;
        return $result;
    }
    public function fetchJoinFromDb2(){
        $link = PDOUtil::createMySQLConnection();
        $query = "SELECT ISBN,cover,title,author,publisher,publish_year,genre.name AS 'nama_genre' FROM book INNER JOIN genre WHERE book.genre_id = genre.id AND ISBN = ?;";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$isbna);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $link =null;
        return $result;
    }
    public function addNewBook(Book $book): int{
        $result = 0;
        $link = PDOUtil::createMySQLConnection();
        $link -> beginTransaction();
        $query = 'INSERT INTO book(ISBN,title,author,publisher,publish_year,short_description,genre_id) VALUES (?,?,?,?,?,?,?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$book->getIsbn());
        $stmt->bindValue(2,$book->getTitle());
        $stmt->bindValue(3,$book->getAuthor());
        $stmt->bindValue(4,$book->getPublisher());
        $stmt->bindValue(5,$book->getYear());
        $stmt->bindValue(6,$book->getIsbn());
        $stmt->bindValue(7,$book-> getGenre() ->getId());
        if($stmt->execute()){
            $link -> commit();
            $result = 1;
        }else{
            $link -> rollBack();
        }
        $link =null;
        return $result;
    }
    public function updateBookToDb(Book $book){
        $result = 0;
        $link = PDOUtil::createMySQLConnection();
        $link -> beginTransaction();
        $query = 'UPDATE book SET title = ?,author = ?,publisher = ?,publish_year = ?,short_description = ?,genre_id = ? WHERE ISBN = ?';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$book->getTitle(),PDO::PARAM_STR);
        $stmt->bindValue(2,$book->getAuthor(),PDO::PARAM_STR);
        $stmt->bindValue(3,$book->getPublisher(),PDO::PARAM_STR);
        $stmt->bindValue(4,$book->getYear(),PDO::PARAM_INT);
        $stmt->bindValue(5,$book->getDescription(),PDO::PARAM_STR);
        $stmt->bindValue(6,$book->getGenre()->getId(),PDO::PARAM_INT);
        $stmt->bindValue(7,$book->getIsbn(),PDO::PARAM_STR);
        if($stmt->execute()){
            $link -> commit();
            $result = 1;
        }else{
            $link -> rollBack();
        }
        $link =null;
        return $result;
    }

    public function updateCoverToDb(Book $book){
        $result = 0;
        $link = PDOUtil::createMySQLConnection();
        $link -> beginTransaction();
        $query = 'UPDATE book SET cover= ? WHERE ISBN = ?';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$book->getCover(),PDO::PARAM_STR);
        $stmt->bindValue(2,$book->getIsbn(),PDO::PARAM_STR);
        if($stmt->execute()){
            $link -> commit();
            $result = 1;
        }else{
            $link -> rollBack();
        }
        $link =null;
        return $result;
    }


    public function deleteBookFromDb($isbn){
        $result = 0;
        $link = PDOUtil::createMySQLConnection();
        $link->beginTransaction();
        $query = 'DELETE FROM book WHERE ISBN = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$isbn);
        if($stmt->execute()){
            $link -> commit();
            $result = 1;
        }else{
            $link -> rollBack();
        }
        $link =null;
        return $result;
    }
}