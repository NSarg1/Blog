<?php require_once __DIR__ . '/layouts/header.php'; ?>
    <article class="blog-post-detail">
        <h2><?= $post['title'] ?></h2>
        <p class="post-meta">Posted on <span><?= $post['created_at'] ?></span> by <span><?= $post['author'] ?></span>
        </p>

        <div class="post-image">
            <img src="../../uploads/<?= $post['image'] ?>" alt="Post Image"/>
        </div>

        <div class="post-content">
            <?= $post['content'] ?>
        </div>
    </article>

    <section class="comments-section">
        <h3>Comments</h3>
        <?php foreach ($comments ?? [] as $comment) : ?>
            <div class="comment">
                <p><strong><?= $comment['username'] ?></strong> on <span><?= $comment['created_at'] ?></span></p>
                <p>
                    <?= $comment['comment'] ?>
                </p>
                <br>
                <?php if ($comment['user_id'] ===( $_SESSION['user_id'] ?? 0)) : ?>
                    <form action="/delete_comment" method="POST">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <input type="hidden" name="comment_id" value="<?=$comment['id'] ?>">

                        <button class="btn">Delete</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <!-- Comment Form -->
        <div class="comment-form">
            <h4>Leave a Comment</h4>
            <form action="/add_comment" method="POST">
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <div class="form-group">
                    <label for="comment_content">Comment</label>
                    <textarea id="comment_content" name="comment" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn">Submit Comment</button>
            </form>
        </div>
    </section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>