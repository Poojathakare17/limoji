<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("Contact Information on Website");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id">ID</th>
<th data-field="address">Address</th>
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
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.address + "</td><td></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>


