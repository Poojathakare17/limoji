<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<!--<?php $this->chintantable->createsearch("Enquiry Details");?>-->
<div class="panel-body">
    <div class="row">
        <div class="col m6 l6">
            <h5 class="panel-title">Enquiry Detail</h5>
        </div>
        <div class="col m12 l6">
        </div>
    </div>
</div>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id" style="display:none;">ID</th>
<th data-field="Value">Value</th>
<th data-field="Voltage">Voltage</th>
<th data-field="Category">Category</th>
<th data-field="Misc">Specific requirements</th>
</tr>
</thead>
<tbody>
<?php foreach($before as $row) { ?>
    <tr>
        <!--<td><?php echo $row->id; ?></td>-->
        <td><?php echo $row->value; ?></td>
        <td><?php echo $row->voltage; ?></td>
        <td><?php echo $row->category; ?></td>
        <td><?php echo $row->misc; ?></td>
    </tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<!--<?php $this->chintantable->createpagination();?>-->
</div>
</div>
<!--<script>
function drawtable(resultrow) {
return "<tr><td>" + resultrow.value + "</td><td>" + resultrow.voltage + "</td><td>" + resultrow.category + "</td><td>" + resultrow.misc + "</td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>-->
