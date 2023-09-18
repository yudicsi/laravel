<style>

.table td,
.table th {
  background-color: #FCF8E8;
  vertical-align: middle;
  border-top: 1px solid #b2d6b0;}
  
table.dataTable thead tr {
  background-color: olive;
  color: white;
  }

.table thead th {
  background-color: #A9907E;
  vertical-align: middle;
  border-bottom: 2px solid #dee2e6;}
</style>


<div class="modal fade" id="Dialog_{{$ViewName}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="pb-0 text-center border-0 modal-header d-block">
        <h4 class="modal-title" id="Title_{{$ViewName}}"></h4>
      </div>
      <div class="pt-0 modal-body">
        <table class="table table-bordered compact sm-12 hover stripe display" head="{{$head}}" style="width:100%" id="{{$ViewName}}_table" name="{{$ViewName}}_table" fluid=1> 
					<thead>
						<tr>
							<th width="134px" colspan='3'><center>ACTION</center></th>    
							@include($blade,['choice'=>'th_1'])
							<th width="101px"><input type="text" size="10"></th>
							<th width="101px"><input type="text" size="10"></th>
							<th width="101px"><input type="text" size="10"></th>
							<th width="101px"><input type="text" size="10"></th>
						</tr>
						<tr>
							<th><a class="btn btn-secondary {{$ViewName}}_refresh fa fa-refresh" href="javascript:void(0)"></a></th>    
							<th width="44px"><a class="btn btn-warning {{$ViewName}}_close text-primary fa fa-times" 
							    href="javascript:tutup('Dialog_{{$ViewName}}','{{$caller}}')"></a></th>
							<th width="44px"><a class="btn btn-primary {{$ViewName}}_add text-white fa fa-solid fa-plus"></a></th>
							@include($blade,['choice'=>'th_2'])
							<th width="101px">UserAdd</th>
							<th width="101px">DateAdd</th>
							<th width="101px">UserEdit</th>
							<th width="101px">DateEdit</th>
						</tr>
					</thead>
				</table>
      </div>
      <div class="border-0 modal-footer" style="display:none"></div>
    </div>
  </div>
</div> 

@include($blade,['choice'=>'form'])

