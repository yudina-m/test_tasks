<?php

/**
 * Class Article
 */
class Article
{
    /**
     * @var User
     */
    protected $author;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $body;


    /**
     * Получить автора статьи
     *
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Поменять автора статьи
     *
     * @param User $author
     * @return $this
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Получить заголовок статьи
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Задать заголовок статьи
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Получить текст статьи
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Задать текст статьи
     *
     * @param string $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }
} 