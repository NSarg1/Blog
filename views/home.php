<?php require_once __DIR__ . '/layouts/header.php'; ?>

<h2>Welcome to My CMS</h2>
<p>This is a basic content management system where registered users can create, update, and delete content.</p>

<section class="blog-section">
    <h2>Recent Blog Posts</h2>
    <div class="blog-posts">
        <!-- Example Blog Post -->
        <article class="blog-post">
            <img src="assetslog/dog.jpg" alt="Blog Post 1 Image"/>
            <div class="blog-details">
                <h3><a href="single_blog_post.html">Blog Post Title 1</a></h3>
                <p class="blog-date">Published on: September 24, 2024</p>
                <p class="blog-excerpt">
                    This is a short description of the first blog post. It gives readers a preview of what to expect...
                </p>
                <a href="single_blog_post.html" class="read-more">Read More</a>
            </div>
        </article>
        <!-- Add more blog posts as needed -->
    </div>
</section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>