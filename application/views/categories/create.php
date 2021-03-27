<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('categories/create'); ?>
<div class="form-group">
    <label>Tên Thể Loại</label>
    <input type="text" name="name" class="form-control" placeholder="Enter name">
</div>
<br>
<button class="btn btn-default" type="submit">Submit</button>
</form>