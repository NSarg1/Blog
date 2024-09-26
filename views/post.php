<?php require_once __DIR__ . '/layouts/header.php'; ?>
<article class="blog-post-detail">
    <h2><?= $post['title'] ?></h2>
    <p class="post-meta">Posted on <span><?= $post['created_at'] ?></span> by <span><?=$post['author']?></span></p>

    <div class="post-image">
        <img src="../../uploads/<?= $post['image'] ?>" alt="Post Image" />
    </div>

    <div class="post-content">
        <?= $post['content'] ?>
    </div>
</article>

<section class="comments-section">
    <h3>Comments</h3>
    <div class="comment">
        <p><strong>John Doe</strong> on <span>September 24, 2024</span></p>
        <p>This is a very insightful post. Thanks for sharing!</p>
    </div>

    <div class="comment">
        <p><strong>Jane Smith</strong> on <span>September 25, 2024</span></p>
        <p>I enjoyed reading this, it really helped me understand the topic better.</p>
    </div>

    <!-- Comment Form -->
    <div class="comment-form">
        <h4>Leave a Comment</h4>
        <form action="submit_comment.php" method="POST">
            <div class="form-group">
                <label for="comment_author">Name</label>
                <input type="text" id="comment_author" name="comment_author" required />
            </div>
            <div class="form-group">
                <label for="comment_content">Comment</label>
                <textarea id="comment_content" name="comment_content" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn">Submit Comment</button>
        </form>
    </div>
</section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>