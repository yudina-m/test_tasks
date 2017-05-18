<?php

/**
 * Class User
 */
class User
{
    //...
    private $id;
    private $name;
    //...
    /**
     * @var Article[]
     */
    private $articles;
    private $observers = array();

    /**
     * Прикрепить объект наблюдателя
     *
     * @param Article $observer_in
     */
    public function attach(Article $observer_in)
    {
        $this->observers[] = $observer_in;
    }

    /**
     * Открепить объект наблюдателя
     *
     * @param Article $observer_in
     */
    public function detach(Article $observer_in)
    {
        foreach ($this->observers as $okey => $oval) {
            if ($oval == $observer_in) {
                unset($this->observers[$okey]);
            }
        }
    }

    /**
     * Обновить всех наблюдателей (статьи)
     */
    public function notify()
    {
        foreach ($this->observers as $obs) {
            $obs->update($this);
        }
    }

    /**
     * Обновить статьи пользователя
     *
     * @param Article[] $newArticles
     */
    function updateArticles($newArticles)
    {
        //...
        $this->articles = $newArticles;
        $this->notify();
    }

    /**
     * Получить статьи пользователя
     *
     * @return Article[]
     */
    function getArticles()
    {
        return $this->articles;
    }

}
