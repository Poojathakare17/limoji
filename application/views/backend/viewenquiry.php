<!--<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch("Enquiries");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id">ID</th>
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

<script>
function drawtable(resultrow) {
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.email + "</td><td>" + resultrow.contact + "</td><td><div id='modal1' class='modal'><div class='modal-content'><h4>Modal Header</h4><p>A bunch of text</p></div><div class='modal-footer'><a href='#!' class='modal-action modal-close waves-effect waves-green btn-flat'>Agree</a></div></div></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
<div id='modal1' class='modal'><div class='modal-content'><h4>Modal Header</h4><p>A bunch of text</p></div><div class='modal-footer'><a href='#!' class='modal-action modal-close waves-effect waves-green btn-flat'>Agree</a></div></div>





<a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editcontact?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a>




 <a class='waves-effect waves-light btn' href='#modal1'>Modal</a><div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>




return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.address + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editcontact?id=');?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Edit'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=\"return confirm('Are you sure you want to delete?');\") href='<?php echo site_url('site/deletecontact?id='); ?>"+resultrow.id+"' data-position='top' data-delay='50' data-tooltip='Delete'><i class='material-icons propericon'>delete</i></a></td></tr>";



</script>-->
