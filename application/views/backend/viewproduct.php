<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("Products");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id" style="display:none;">ID</th>

<th data-field="name">Name</th>
<th data-field="category">Category</th>
<th data-field="image">Image</th>
<th data-field="status">Product status</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createproduct"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
</div>
</div>
<script>
function drawtable(resultrow) {
	   if(resultrow.status==1){
        resultrow.status="Enable";
    }
    else if(resultrow.status==2){
        resultrow.status="Disable";
    }
	 var image = "<a class='img-center' href='<?php echo base_url().'uploads/thumb/thumb_w_800_'; ?>" + resultrow.image + "' ><img src='<?php echo base_url().'uploads/thumb/thumb_w_800_'; ?>" + resultrow.image + "'></a>";
        if (resultrow.image == "") {
            image = "No Image Available";
        }
return "<tr><td>" + resultrow.name + "</td><td>" + resultrow.category + "</td><td>" + image + "</td><td>" + resultrow.status + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editproduct?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deleteproduct?id='); ?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='material-icons propericon'>delete</i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
