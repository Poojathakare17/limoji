<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php if($this->input->get('type')==1){
$this->chintantable->createsearch("Category Sliders");
}
else if($this->input->get('type')==2){
$this->chintantable->createsearch("Product Sliders");
}
?>

<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id" style="display:none;">ID</th>
<th data-field="name">Name</th>
<th data-field="order">Order</th>
<th data-field="status">Status</th>
<th data-field="image">Image</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createslider?type=").$this->input->get_post('type'); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>

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
      var image = "<a class='img-center' href='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "' ><img src='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "'></a>";
        if (resultrow.image == "") {
            image = "No Receipt Available";
        }
return "<tr><td>" + resultrow.name + "</td><td>" + resultrow.order + "</td><td>" + resultrow.status + "</td><td>" + image + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editslider?id=');?>"+resultrow.id+"&type="+resultrow.type+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deleteslider?id='); ?>"+resultrow.id+"&type="+resultrow.type+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='material-icons propericon'>delete</i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>

