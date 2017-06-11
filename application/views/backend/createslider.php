<div class="row">
<div class="col s12">


<?php if ($this->input->get_post('type')==1){ ?>
<h4 class="pad-left-15 capitalize">Add Category Sliders</h4>
<?php } ?>
<?php if ($this->input->get_post('type')==2){ ?>
<h4 class="pad-left-15 capitalize">Add Product Sliders</h4>
<?php } ?>

</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createslidersubmit?type=").$this->input->get('type');?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Text">Text</label>
<input type="text" id="Text" name="text" value='<?php echo set_value('text');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Order">Order</label>
<input type="number" id="Order" name="order" value='<?php echo set_value('order');?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("status",$status,set_value('status',1));?>
<label>Status</label>
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
<a href="<?php echo site_url("site/viewslider?type=").$this->input->get('type'); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
