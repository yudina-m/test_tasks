<?php

/**
 * Class ArticleCreator
 */
class ArticleCreator
{
    /**
     * @var User
     */
    private $author;
    /**
     * @var Article
     */
    private $article;
    private $title;
    private $body;

    /**
     * Создать новую статью
     *
     * @param User $author
     * @param $title
     * @param $body
     */
    public function __construct(User $author, $title, $body)
    {
        $this->author = $author;
        $this->article = new Article();
        //...

        $this->article->setAuthor($this->author)
            ->setTitle($this->title)
            ->setBody($this->body);
    }

    /**
     * @return User
     */
    function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return Article
     */
    function getArticle()
    {
        return $this->article;
    }
} 