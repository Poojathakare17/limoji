<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("Enquiry Details");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id">ID</th>
<th data-field="Value">Value</th>
<th data-field="Voltage">Voltage</th>
<th data-field="Category">Category</th>
<th data-field="Misc">Specific requirements</th>
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
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.value + "</td><td>" + resultrow.voltage + "</td><td>" + resultrow.category + "</td><td>" + resultrow.misc + "</td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
