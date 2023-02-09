<div class="postCard border rounded-top rounded-2">

    <div class="postHeader">
        <div class="userAvater">
            <img src="assets/images/moji.png" alt="">

            <?php 
                $userNamesResult = new UserDbQuery();
                $userNames = $userNamesResult->getFullNames()
            ?>
                <p class="avaterDetails ms-3"> <?= $_SESSION['user_details']['firstName'] . ' '.  $_SESSION['user_details']['lastName'] ?> </p>

        </div>
        
        <div class="postInfo">

            <?php 
                $rawPostTime = $post['created_at'];
                $postTime = strtotime($rawPostTime);
                $formatPostTime = new PostValidator();
                $formattedPostTime = $formatPostTime->setTimeAgo($postTime);
                $formattedPostTime = $formatPostTime->getTimeAgo();
            ?>

            <p><?= $formattedPostTime ?></p>

            <i class="bi bi-three-dots-vertical" data-bs-toggle="modal" data-bs-target="#moreInfoModal"></i>
            
            <?php include './modals/postMoreInfoModal.php' ?> <!-- More info modal -->

        </div>
    </div>

    <div class="postPhoto">
        <a href="./postDetails.php?id=<?= $post['post_id'] ?>">
            <img class="img-fluid" src="<?= $post['photo'] ?>"> <!-- fetches post photo -->
        </a>
        <div class="postIconsContainer d-flex justify-content-end">
            <div class="rightIconsDiv d-flex flex-column justify-content-between align-items-center">
                <div class="likes">
                    
                    <i id="heart-icon" class="bi bi-heart" onclick="replaceLikeIcon(this)"></i>
                    <p>221.9k</p>

                </div>
                <div class="comments">
                    <i class="bi bi-chat-square"></i>
                    <p>1907</p>
                </div>
                <div class="shares">
                    <i class="bi bi-reply"></i>
                    <p>1805</p>
                </div>
            </div>
        </div>
    </div>

    <div class="postTextWrapper">

        <p class="postCategory"> <?= $post['categoryName'] ?> </p>

        <p class="postParagraph"> <?= $post['title'] ?> </p>

        <!-- <p class="commentsCount">View all 142 comments</p> -->
    </div>

    <div class="postCommentWrapper d-flex align-items-center align-items-center">
        <div class="emojiWrapper">
            <i class="bi bi-emoji-smile"></i>
        </div>

        <div class="commentWrapper">
            <textarea name="comment" onclick="autoResizeTextarea()" id="expandable-textarea" placeholder="Add a comment..."></textarea>
        </div>

        <div class="postBtnWrapper d-flex justify-content-end">
            <button id="postBtnWrapper" type="submit">Post</button>
        </div>
    </div>

</div>