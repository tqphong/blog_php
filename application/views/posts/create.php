<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('posts/create'); ?>
<form>
  <div class="form-group">
    <label>Tiêu Đề</label>
    <input type="text" class="form-control" name='title' placeholder="Add Title">
  </div>
  <div class="form-group">
    <label>Nội Dung</label>
    <textarea type="text" id="editor1" class="form-control" name='body' placeholder="Add Body"></textarea>
  </div>
  <div class="form-group">
    <label>Thể Loại</label>
    <select name="category_id" class="form-control">
    <?php foreach($categories as $category) : ?>
        <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
    <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label>Tải Ảnh</label>
    <input type="file" size="20" name='userfile'>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>