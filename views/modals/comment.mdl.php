<section id="comments">
  <div class="row">
      <div class="M3">
        <p class="title-separator">Commentaires</p>
      </div>
      <div class="M12">
        <div class="full-hr-separation"></div>
      </div>
  </div>

  <form action="comment/add" method="post">
    <input type="hidden" name="user" value="<?= $_SESSION['userId'] ?>">
    <input type="hidden" name="chapter_id" value="<?= $chapter->getId() ?>">
    <div class="row">
      <div class="M12 X12">
          <textarea class="input" name="content" placeholder="Enter a comment here"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="M3 X12 M--offset9 wrapper-flex M--end">
            <input type="submit" class="input-btn btn-filled-blue btn-icon" name="" value="Commenter">
      </div>
    </div>
  </form>

  <div id="comments-result" class="row M--center">
    <?php // foreach comments ?>
    <div class="M12">
      <p>No comments</p>
    </div>
  </div>
</section>
