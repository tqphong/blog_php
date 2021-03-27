<h2><?php echo $post['title'];?></h2>
<img src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
<small class='post-date'>Posted on: <?php echo $post['created_at'] ?></small><br>
<div class='post-body'>
    <?php echo $post['body']; ?>
</div>
<?php if($this->session->userdata('user_id') == $post['user_id']): ?>
<hr>
<a class='btn btn-default pull-left' href='<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>'>Edit</a>
<?php echo form_open('posts/delete/'.$post['id']); ?>
<form>
    <input type='submit' value='delete' class='btn btn-danger'>
</form>
<?php endif; ?>
<hr>
<h3>Bình luận</h3>
<?php if($comments) : ?> 
    <?php foreach($comments as $comment) : ?>
        <div class="well">
            <h5><?php echo $comment['body']; ?> [by <strong><?php echo $comment['name'] ?></strong>]</h5>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p>Không có bình luận nào để hiển thị</p>
<?php endif; ?>
<hr>
<h3>Thêm bình luận</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('comments/create/'.$post['id']); ?>
    <div class="form-group">
        <label>Tên</label>
        <input class="form-control" type="text" name="name">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input class="form-control" type="text" name="email">
    </div>
    <div class="form-group">
        <label>Nội dung</label>
        <textarea class="form-control" name="body"></textarea>
    </div>
    <input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
    <button class="btn btn-primary" type="submit">Submit</button>
</form>