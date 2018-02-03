<?php
    include ROOT . '/views/layouts/header.php';
    include ROOT . '/components/StringHelper.php';
?>

<!--main content start-->
<div class="main-content">
    <div class="container">

    	<div class="row">
    		<div class="col-sm-8 col-sm-offset-2">
    			<div class="related-post-carousel"><!-- related post carousel -->
	                <div class="related-heading">
	                    <h4>Most popular posts</h4>
	                </div>
	                <div class="items">
	                	<?php foreach($mostCommentsPosts as $popular): ?>
	                    <div class="single-item">
	                        <a href="/blog/<?= $popular['id']; ?>">
	                            <img src="/template/images/blog11.jpg" alt="">
	            
	                            <p><?= $popular['title']; ?></p>
	                        </a>
	                    </div>
	                	<?php endforeach; ?>
	                </div>
            	</div><!-- related post carousel -->
    		</div>
    	</div>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="leave-comment"><!--leave comment-->
                <h4>Create Post</h4>
                <form class="form-horizontal contact-form" role="form" method="post">
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="author" name="author" placeholder="Author">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea class="form-control" rows="6" name="description"
                            placeholder="Write Massage"></textarea>
                        </div>
                    </div>
                    <input type="submit" class="btn send-btn" value="Send  Message">
                </form>
                </div><!--end leave comment-->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <?php foreach($posts as $post): ?>
                    <article class="post">                        
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                <h1 class="entry-title"><a href="/blog/<?= $post['id']; ?>"><?= $post['title']; ?></a></h1>
                            </header>
                            <div class="entry-content">
                                <p><?= StringHelper::getShortSymbolText($post['description']); ?></p>

                                <div class="btn-continue-reading text-center text-uppercase">
                                    <a href="/blog/<?= $post['id'];?>" class="more-link">Continue Reading</a>
                                </div>
                            </div>
                            <div class="social-share">
                                <span class="social-share-title pull-left text-capitalize">By <?= $post['author']; ?> on 
                                	<?= date('F j, Y',$post['created_date']); ?></span>
                                <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="/blog/<?= $post['id']; ?>"><i class="fa fa-pencil"></i></a></li><?= $post['comment_count']; ?>
                                </ul>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>                
            </div>                
        </div>

    </div>
</div>
<!-- end main content-->


<?php include ROOT . '/views/layouts/footer.php'; ?>