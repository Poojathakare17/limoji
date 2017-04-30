<div class="row">
<div class="col s12">
<h4 class="pad-left-15 capitalize">Create enquiry</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createenquirysubmit");?>' enctype= 'multipart/form-data'>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Email">Email</label>
<input type="email" id="Email" name="email" value='<?php echo set_value('email');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Contact">Contact</label>
<input type="text" id="Contact" name="contact" value='<?php echo set_value('contact');?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewenquiry"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
