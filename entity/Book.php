<?php

namespace entity;

class Book
{
    private string $ISBN;
    private string $title;
    private string $author;
    private string $publisher;
    private int $publish_year;
    private string $short_description;
    private ?string $cover;

    private Genre $genre;

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->ISBN;
    }

    /**
     * @param string $ISBN
     */
    public function setIsbn(string $ISBN): void
    {
        $this->ISBN = $ISBN;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getPublisher(): string
    {
        return $this->publisher;
    }

    /**
     * @param string $publisher
     */
    public function setPublisher(string $publisher): void
    {
        $this->publisher = $publisher;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->publish_year;
    }

    /**
     * @param int $publish_year
     */
    public function setYear(int $publish_year): void
    {
        $this->publish_year = $publish_year;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->short_description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $short_description): void
    {
        $this->short_description = $short_description;
    }

    /**
     * @return string|null
     */
    public function getCover(): ?string
    {
        return $this->cover;
    }

    /**
     * @param string $cover
     */
    public function setCover(string $cover): void
    {
        $this->cover = $cover;
    }

    /**
     * @return Genre
     */
    public function getGenre(): Genre
    {
        if(!isset($this->genre)){
            $this->genre=new Genre();
        }
        return $this->genre;
    }

    /**
     * @param Genre $genre
     */
    public function setGenre(Genre $genre): void
    {
        $this->genre = $genre;
    }

    public function __set(string $name, $value): void
    {
        if(!isset($this->genre)){
            $this->genre=new Genre();
        }
        switch ($name){
            case 'name':
                $this->genre->setName($value);
                break;
            case 'genre_id':
                $this->genre->setId($value);
                break;
        }
    }


}