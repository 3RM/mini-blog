<?php

include_once ROOT.'/models/Post.php';
include_once ROOT.'/models/Comment.php';

/**
 * Description of BlogController
 *
 * @author rodnoy
 */
class BlogController {

    /**
     * Вывод всех постов и самых комментируемых
     * Если отправлена форма - создает новый пост
     * 
     * @return boolean
     */
    public function actionPosts()
    {

    	if(isset($_POST['author']) && isset($_POST['title']) && isset($_POST['description'])){
    		if(is_string($_POST['author']) && is_string($_POST['title']) && is_string($_POST['description'])){
	    		
	    		$params['author'] = filter_input(INPUT_POST, 'author');
	    		$params['title'] = filter_input(INPUT_POST, 'title');
	    		$params['description'] = filter_input(INPUT_POST, 'description');
	    		$params['created_date'] = time();
	    		$params['comment_count'] = 0;

	    		$id = Post::savePost($params);
	    		header("Location: blog/".$id);	
	    		
    		}
    	}

    	$post = [];
    	$posts = Post::getPostList();

    	if(!empty(Post::getMostCommentsPostList()) && (count(Post::getMostCommentsPostList()) >= 5)){
    		$mostCommentsPosts = Post::getMostCommentsPostList();
    	}
    	
    	require_once ROOT . '/views/blog/posts.php';
        
        return true;
    }

    /**
     * Вывод определеного поста
     * Если передана форма - добавляет комментарий к этому посту
     * 
     * @param  integer $id - id поста
     * @return boolean
     */
    public function actionPost($id)
    {
    	$post = Post::getPostById($id);
    	$comments = Comment::getCommentListForPost($id);
    	$mostCommentsPosts = Post::getMostCommentsPostList();
    	
    	if(isset($_POST['author']) && isset($_POST['description'])){
    		if(is_string($_POST['author']) && is_string($_POST['description'])){	
	    		$params['author'] = filter_input(INPUT_POST, 'author');    		
	    		$params['description'] = filter_input(INPUT_POST, 'description');
	    		$params['post_id'] = $id;
	    		$params['created_date'] = time();

	    		if(Comment::saveComment($params))
	    		{
	    			Post::updateCommentCount($id);
	    			header("Location: /blog/".$id);
	    		}
    		}
    	}

    	require_once ROOT . '/views/blog/post.php';
        
        return true;
    }
}
