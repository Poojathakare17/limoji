<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("Enquiries");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id" style="display:none;">ID</th>
<th data-field="name">Name</th>
<th data-field="email">Email</th>
<th data-field="contact">Contact</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
</div>
</div>
<script>
function drawtable(resultrow) {
return "<tr><td>" + resultrow.name + "</td><td>" + resultrow.email + "</td><td>" + resultrow.contact + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/viewenquirydetail?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deleteenquiry?id='); ?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='material-icons propericon'>delete</i></a></td></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
