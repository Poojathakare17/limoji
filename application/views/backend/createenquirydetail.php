<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create enquirydetail</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createenquirydetailsubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="enquiryid">enquiryid</label>
<input type="text" id="enquiryid" name="enquiryid" value='<?php echo set_value('enquiryid');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="value">value</label>
<input type="text" id="value" name="value" value='<?php echo set_value('value');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="voltage">voltage</label>
<input type="text" id="voltage" name="voltage" value='<?php echo set_value('voltage');?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("category",$category,set_value('category'));?>
<label>category</label>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<textarea name="misc" class="materialize-textarea" length="400"><?php echo set_value( 'misc');?></textarea>
<label>misc</label>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewenquirydetail"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
