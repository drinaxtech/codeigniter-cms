<?php foreach($categories as $category) :
	$posts = $this->category_model->get_posts($category['category_slug']);
	$posts_count = count($posts);
	$image = ($posts_count == 0) ? 'noimage.png' : $posts[0]['post_image'];
	?>

	<div class="col-lg-4 col-md-6">
		<div class="portfolio-block">
			<div class="portfolio-img">
				<img src="<?= base_url('assets/images/posts/'.$image); ?>" alt="<?= ucfirst($category['name']); ?>">
			</div>
			<div class="portfolio-details">
				<span><small><?= $posts_count;?> posts</small></span>
				<h5><a href="<?= base_url('category/').$category['category_slug']; ?>"><?= ucfirst($category['name']); ?></a></h5>
			</div>
		</div>
  </div>
  
<?php endforeach; ?>