<?php

/**
 * Class User
 */
class User
{
    /**
     * @var Article[]
     */
    protected $articles;

    /**
     * Создать новую статью
     *
     * @param $title
     * @param $body
     * @return Article
     */
    public function createArticle($title, $body)
    {
        $article = new Article();
        $article->setAuthor($this)
            ->setTitle($title)
            ->setBody($body);

        //...

        $this->articles[] = $article;

        return $article;
    }

    /**
     * Получить все статьи пользователя
     *
     * @return Article[]
     */
    public function getArticles()
    {
        //...

        return $this->articles;
    }

} 