<?php

/**
 * Иодель для работы с комментариями
 */

class Comment extends Db
{
	/**
	 * Возвращает массив комментариев для поста
	 * @param  integer $id - id поста
	 * @return array
	 */
	public static function getCommentListForPost($id)
	{
		$comments = array();

        $sql = "SELECT id, post_id, author, description, created_date FROM comment WHERE post_id = ".$id;

        $result = self::getConnection()->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()) {
            $comments[$i]['id'] = $row['id'];
            $comments[$i]['author'] = $row['author'];
            $comments[$i]['description'] = $row['description'];
            $comments[$i]['post_id'] = $row['post_id'];
            $comments[$i]['created_date'] = $row['created_date'];
            $i++;
        }
        return $comments;
	}

	/**
	 * @param  array $params - массив с параметрами
	 * @return boolean
	 */
	public static function saveComment($params)
	{
		$currentCount = Post::getPostCommentCount($params['post_id']);

		//!!
        $db = Db::getConnection();
        //!!

    	$sql = "INSERT INTO comment "
                . "(author, post_id, description, created_date) "
                . "VALUES "
                . "(:author, :post_id, :description, :created_date)";
                
        $result = $db->prepare($sql);
        $result->bindParam(':author', $params['author'], PDO::PARAM_STR);
        $result->bindParam(':description', $params['description'], PDO::PARAM_STR);
        $result->bindParam(':post_id', $params['post_id'], PDO::PARAM_INT);
        $result->bindParam(':created_date', $params['created_date'], PDO::PARAM_INT);
        if ($result->execute()) {
            //Если запрос выполнен успешно, возвращает id добавленной записи
            return true;
        }
	}

}