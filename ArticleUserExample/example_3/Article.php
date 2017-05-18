<?php

/**
 * Class Article
 */
class Article
{
    /**
     * @var User
     */
    private $author;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $body;


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

    /**
     * Обновить автора статьи
     *
     * @param User $author
     */
    public function update(User $author)
    {
        //...
        $this->author = $author;
        //...
    }
} 