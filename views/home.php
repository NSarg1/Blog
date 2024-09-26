<?php require_once __DIR__ . '/layouts/header.php'; ?>
    <div class="welcome">
        <h2>Welcome to My CMS</h2>
        <p>This is a basic content management system where registered users can create, update, and delete content.</p>

        <section class="blog-section">
            <div class="title">
                <h2>Recent Blog Posts</h2>
                <?php if ($_SESSION['user_id'] ?? false) : ?>
                    <button class="btn" onclick="handleCreateButtonClick()">Create</button>

                    <div class="blog-section__popup login-box" id="blog-create-edit-popup">
                        <h2>Create post</h2>
                        <form class="content" method="POST" action="/post" enctype="multipart/form-data">
                            <input type="file" name="image" accept="image/png, image/gif, image/jpeg"/>

                            <?php if ($_SESSION['errors']['image'] ?? false) : ?>
                                <small class="invalid-message"><?= $_SESSION['errors']['image'] ?></small>
                            <?php endif; ?>
                            <label>
                                <input type="text" name="title" placeholder="Blog title" class="input" value="<?=$_SESSION['old_values']['title'] ?? ''?>"/>

                                <?php if ($_SESSION['errors']['title'] ?? false) : ?>
                                    <small class="invalid-message"><?= $_SESSION['errors']['title'] ?></small>
                                <?php endif; ?>
                            </label>
                            <label>
                                <textarea name="content" class="input" rows="5"
                                          placeholder="Blog description"><?=$_SESSION['old_values']['content'] ?? ''?></textarea>

                                <?php if ($_SESSION['errors']['content'] ?? false) : ?>
                                    <small class="invalid-message"><?= $_SESSION['errors']['content'] ?></small>
                                <?php endif; ?>
                            </label>

                            <div class="actions">
                                <button type="reset" class="btn--text" onclick="handlePopupCancel()">Cancel</button>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <div class="blog-posts">
                <?php if (empty($posts)) : ?>
                    <h1>No Blogs yet.</h1>
                <?php endif; ?>

                <?php foreach ($posts ?? [] as $post) : ?>
                    <article class="blog-post">
                        <img src="../../uploads/<?= $post['image'] ?>" alt="Blog Post 1 Image"/>
                        <div class="blog-details">
                            <h3>
                                <a href="/post/<?= $post['id'] ?>">
                                    <?= $post['title'] ?>
                                </a>
                            </h3>
                            <p class="blog-date">Published on: <?= $post['created_at'] ?></p>
                            <p class="blog-excerpt">
                                <?= $post['content'] ?>
                            </p>
                            <a href="/post/<?= $post['id'] ?>" class="read-more">Read More</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <script>
        const popupContainer = document.getElementById("blog-create-edit-popup");

        <?php if (count($_SESSION['errors'] ?? [])) :?>
        popupContainer.style.display = "block";
        <?php endif; ?>

        const handleCreateButtonClick = () => {
            popupContainer.style.display = "block";
        };
        const handlePopupCancel = () => {
            popupContainer.style.display = "none";
        };
    </script>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>