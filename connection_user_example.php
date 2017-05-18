<?php

/**
 * Class Connection
 */
class Connection
{
    //вообще, это должно быть в конфиге
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = '123123';
    const DB_DATABASE = 'database';

    /**
     * @var mysqli|null
     */
    protected $connection;

    /**
     * Подлючиться к БД
     *
     * @throws Exception
     */
    protected function connect()
    {
        if (!$this->connection) {
            $this->connection = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASSWORD, self::DB_DATABASE);

            //или Exception, или запись в ошибки и доп. метод, или trigger_error, или просто можно в лог записать

            if(!$this->connection){
                throw new Exception("Connection error: ".mysqli_error($this->connection));
            }

            if (mysqli_connect_errno()) {
                throw new Exception("Connection failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
            }
        }
    }

    /**
     * Выполнить запрос
     *
     * @param $sql
     * @throws Exception
     * @return mysqli_result
     */
    public function query($sql)
    {
        $this->connect();
        $query_res = mysqli_query($this->connection, $sql);

        if(!$query_res) {
            throw new Exception("Query failed: " . mysqli_error($this->connection));
        }

        return $query_res;
    }

    /**
     * Закрываем соединение
     */
    public function close()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }

    /**
     * При уничтожении объекта закрываем соединение
     */
    public function __destruct()
    {
        $this->close();
    }
}

/**
 * Class User
 */
class User
{
    private $user_ids;
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param int[] $user_ids
     * @return $this
     */
    public function setUserIds($user_ids)
    {
        $this->user_ids = $user_ids;

        return $this;
    }


    /**
     * Получить данные пользователей
     *
     * @return array
     */
    public function getUsersData()
    {
        assert(!empty($this->user_ids));

        //лучше не использовать *, а писать конкретные поля в запросе
        $sql = sprintf('SELECT * FROM users WHERE id IN (%s)', implode(', ', $this->user_ids));
        $result = $this->connection->query($sql);

        $data = [];

        while($obj = $result->fetch_object()){
            $data[$obj->id] = $obj->name;
        }

        return $data;
    }

    /**
     * @param Connection $connection
     * @return $this
     */
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;

        return $this;
    }

}

//................................................

//... валидация $_GET['user_ids'] в Action
//... передаем в модель, дальше уже внутри модели:
$user_model = new User();
$user_model
    ->setConnection((new Connection()))
    ->setUserIds($user_ids);//провалидированные из $_GET['user_ids'] и уже разбитые через explode в массив

try {
    $data = $user_model->getUsersData();

    //если мы в модели, то $data нужно вернуть в Action
    foreach ($data as $user_id => $name) {
        echo "<a href=\"/show_user.php?id=$user_id\">$name</a>";//это должно быть в шаблоне
    }

} catch (Exception $e) {
    //выше описано: не обязательно использовать Exception, можно проверять и обрабатывать ошибки или писать в лог
    print $e->getMessage();
}
