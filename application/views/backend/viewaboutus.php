<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("About us content");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id" style="display:none;">ID</th>
<th data-field="text">Description</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<script>
function drawtable(resultrow) {
return "<tr><td>" + resultrow.text + "</td><td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editaboutus?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
