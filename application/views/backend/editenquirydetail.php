<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Edit enquirydetail</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editenquirydetailsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="row">
<div class="input-field col s6">
<label for="enquiryid">enquiryid</label>
<input type="text" id="enquiryid" name="enquiryid" value='<?php echo set_value('enquiryid',$before->enquiryid);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="value">value</label>
<input type="text" id="value" name="value" value='<?php echo set_value('value',$before->value);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="voltage">voltage</label>
<input type="text" id="voltage" name="voltage" value='<?php echo set_value('voltage',$before->voltage);?>'>
</div>
</div>
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("category",$category,set_value('category',$before->category));?>
<label for="category">category</label>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>misc</label>
<textarea name="misc" placeholder="Enter text ..."><?php echo set_value( 'misc',$before->misc);?></textarea>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewenquirydetail"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
