
<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create product</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createproductsubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("category",$category,set_value('category'));?>
<label>Category</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("special_category",$special_category,set_value('special_category'));?>
<label>Special Category</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("is_special",$is_special,set_value('is_special','2'));?>
<label>Show on Home</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("status",$status,set_value('status',1));?>
<label>Product status</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<textarea name="text" class="materialize-textarea" length="400"><?php echo set_value( 'text');?></textarea>
<label>Description</label>
</div>
</div>
<div class="row big">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Image</span>
<input type="file" name="image" accept="image/*">
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload image" value='<?php echo set_value('image');?>'>
</div>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewproduct"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>

























<!--<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create product</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createproductsubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("category",$category,set_value('category'));?>
<label>Category</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("is_special",$is_special,set_value('is_special'));?>
<label>Is special product</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("status",$status,set_value('status'));?>
<label>Product status</label>
</div>
</div>

<div class="row big">
<div class="file-field input-field col s12 m6">
<div class="btn blue darken-4">
<span>Image</span>
<input type="file" name="image" multiple>
</div>
<div class="file-path-wrapper">
<input class="file-path validate" type="text" placeholder="Upload image" value='<?php echo set_value('image');?>'>
</div>
</div>
</div>

  <div class="row">
    <form class="col s6">
      <div class="row">
        <div class="input-field col s6">
          <textarea id="textarea1" class="materialize-textarea" value='<?php echo set_value('text');?>'></textarea>
          <label for="textarea1">Description</label>
        </div>
      </div>
    </form>
  </div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewproduct"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
-->