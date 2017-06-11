<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit product</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editproductsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("category",$category,set_value('category',$before->category));?>
<label for="Category">Category</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("is_special",$is_special,set_value('is_special',$before->is_special));?>
<label for="Is special product">Is special product</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("status",$status,set_value('status',$before->status));?>
<label for="Status">Product status</label>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>Description</label>
<textarea name="text" class="materialize-textarea"><?php echo set_value( 'text',$before->text);?></textarea>
</div>
</div>
 <div class="row">
            <div class="file-field input-field col m6 s12">
                <?php if($before->image == "") { } else {
                ?>
                <span class="img-center big">
                <img src="<?php echo base_url('uploads')."/".$before->image; ?>">
                    <?php } ?>
                    </span>
                <div class="btn blue darken-4">
                    <span>Image</span>
                    <input name="image" type="file" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload image" value="<?php echo set_value('image',$before->image);?>">
                </div>
            </div>
        </div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewproduct"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>















<!--<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit product</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editproductsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("category",$category,set_value('category',$before->category));?>
<label for="Category">Category</label>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("is_special",$is_special,set_value('is_special',$before->is_special));?>
<label for="Is special product">Is special product</label>
</div>
</div>
<div class="row" style="display:none">
<div class="input-field col s6">
<label for="Order">Order</label>
<input type="text" id="Order" name="order" value='<?php echo set_value('order',$before->order);?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("status",$status,set_value('status',$before->status));?>
<label for="Product status">Product status</label>
</div>
</div>

   <div class="row">
            <div class="file-field input-field col m6 s12">
                <span class="img-center big">
                <?php if($before->image == "") { } else {
                ?><img src="<?php echo base_url('uploads')."/".$before->image; ?>">
                    <?php } ?>
                    </span>
                <div class="btn blue darken-4">
                    <span>Image</span>
                    <input name="image" type="file" multiple>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image',$before->image);?>">
                </div>
            </div>
        </div>
<div class="row" style="display:none">
<div class="input-field col s6">
<label for="Product Code">Product Code</label>
<input type="text" id="Product Code" name="code" value='<?php echo set_value('code',$before->code);?>'>
</div>
</div>

  <div class="row">
    <form class="col s6">
      <div class="row">
        <div class="input-field col s6">
          <textarea id="textarea1" class="materialize-textarea" value='<?php echo set_value('text',$before->text);?>'></textarea>
          <label for="textarea1">Description</label>
        </div>
      </div>
    </form>
  </div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewproduct"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
-->