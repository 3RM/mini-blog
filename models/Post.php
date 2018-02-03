<?php

/**
 * Модель для работы с постами
 */
class Post extends Db
{
	//Количество постов по умолчанию
	const SHOW_BY_DEFAULT = 5;

	/**
     * Возвращает весь список постов
     * @return array <p>Массив с постами</p>
     */
    public static function getPostList() {

        $posts = array();

        $sql = "SELECT id, author, description, title, created_date, comment_count FROM post ORDER BY id DESC";

        $result = self::getConnection()->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()) {
            $posts[$i]['id'] = $row['id'];
            $posts[$i]['author'] = $row['author'];
            $posts[$i]['description'] = $row['description'];
            $posts[$i]['title'] = $row['title'];
            $posts[$i]['created_date'] = $row['created_date'];
            $posts[$i]['comment_count'] = $row['comment_count'];
            $i++;
        }
        return $posts;
    }

    /**
     * Возвращает пост с указанным id
     * @param integer $id <p>id поста</p>
     * @return array <p>Массив с информацией о посте</p>
     */
    public static function getPostById($id) {

        $id = intval($id);

        $result = self::getConnection()->query("SELECT * FROM post "
                . "WHERE id=$id");
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->fetch();
    }

    /**
    * Возвращает самые коментируемые посты
    * @param integer $count <p>количество постов</p>
    * @return array <p>Массив с постами</p>
     */
    public static function getMostCommentsPostList($count = self::SHOW_BY_DEFAULT)
    {
    	$posts = [];

    	$sql = "SELECT * FROM post ORDER BY comment_count DESC LIMIT 5";

    	$result = self::getConnection()->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()) {
            $posts[$i]['id'] = $row['id'];
            $posts[$i]['author'] = $row['author'];
            $posts[$i]['description'] = $row['description'];
            $posts[$i]['title'] = $row['title'];
            $posts[$i]['created_date'] = $row['created_date'];
            $posts[$i]['comment_count'] = $row['comment_count'];
            $i++;
        }
        return $posts;
    }

    /**
     * Сохранение нового поста
     * @param  array $params <p>Массив с даными</p>
     * @return id добаленой новости
     */
    public static function savePost($params)
    {
    	//!!
        $db = Db::getConnection();
        //!!

    	$sql = "INSERT INTO post "
                . "(author, title, description, "
                . "created_date, comment_count) "
                . "VALUES "
                . "(:author, :title, :description, :created_date, :comment_count)";
                
        $result = $db->prepare($sql);
        $result->bindParam(':author', $params['author'], PDO::PARAM_STR);
        $result->bindParam(':title', $params['title'], PDO::PARAM_STR);
        $result->bindParam(':description', $params['description'], PDO::PARAM_STR);
        $result->bindParam(':created_date', $params['created_date'], PDO::PARAM_INT);
        $result->bindParam(':comment_count', $params['comment_count'], PDO::PARAM_INT);
        if ($result->execute()) {
            //Если запрос выполнен успешно, возвращает id добавленной записи
            return $db->lastInsertId();
        }

    }

    /**
     * Возвращает количество коментариев к посту
     * @param  integer $id - id поста
     * @return string количество коментариев поста
     */
    public static function getPostCommentCount($id)
    {
    	$sql = "SELECT comment_count FROM post WHERE id = ".$id;

    	$result = self::getConnection()->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $row =  $result->fetch();
        return $row['comment_count'];
    }

    /**
     * Обновляет количество коментариев поста
     * @param  integer $id - id поста
     * @return boolean
     */
    public static function updateCommentCount($id)
    {
    	$currentCount = self::getPostCommentCount($id);
    	$currentCount = +$currentCount;

		$db = Db::getConnection();

		$sql = "UPDATE post SET comment_count = :count WHERE id = ".$id;
                
        $result = $db->prepare($sql);
        $result->bindParam(':count', ++$currentCount, PDO::PARAM_INT);

        if ($result->execute()) {
            //Если запрос выполнен успешно, возвращает id добавленной записи
            return true;
        }
    }
}