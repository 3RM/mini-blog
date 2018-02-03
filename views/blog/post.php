<?php include ROOT . '/views/layouts/header.php'; ?>

<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">                    
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h1 class="entry-title"><a href="/"><?= $post['title'] ?></a></h1>
                        </header>
                        <div class="entry-content">
                            <p><?= $post['description']; ?></p>
                        </div>
                        <div class="decoration">
                            <a href="#" class="btn btn-default">Decoration</a>
                            <a href="#" class="btn btn-default">Decoration</a>
                        </div>

                        <div class="social-share">
                         <span
                         class="social-share-title pull-left text-capitalize">By <?= $post['author']; ?> On 
                     			<?= date('F j, Y', $post['created_date']);?></span>
                         <ul class="text-center pull-right">
                            <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </article>

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
            
      <?php if(!empty($comments)): ?>
                <?php foreach($comments as $comment): ?>
                    <!-- bottom comment -->
                    <div class="bottom-comment">

                        <div class="comment-img">
                            <img class="img-circle" src="assets/images/comment-img.jpg" alt="">
                        </div>

                        <div class="comment-text">
                            <a href="#" class="replay btn pull-right"> Replay</a>
                            <h5><?= $comment['author'] ?></h5>

                            <p class="comment-date">
                                <?= date('F j, Y', $comment['created_date']); ?>
                            </p>


                            <p class="para"><?= $comment['description']; ?> </p>
                        </div>
                    </div>
                    <!-- end bottom comment -->
                <?php endforeach; ?>
            <?php endif; ?>

            <!--leave comment-->
			<div class="leave-comment">
				<h4>Leave a reply</h4>
				<form class="form-horizontal contact-form" role="form" method="post">
					<div class="form-group">
						<div class="col-md-6">
							<input type="text" class="form-control" id="author" name="author" placeholder="Author">
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
			</div>
            <!--end leave comment-->

      </div>
      
    </div>
</div>
</div>


<!-- end main content-->

<?php include ROOT . '/views/layouts/footer.php'; ?>