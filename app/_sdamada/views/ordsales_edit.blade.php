window.edt_{{$ViewName}}=function(id,Tanggal)
  {
    localStorage.setItem("id", id);
    localStorage.setItem("Tanggal", Tanggal);
    return window.open("{{url('edit-ordsales')}}");
  }

  {{$ViewName}}_Table.on('click','.{{$ViewName}}_table_edit, .{{$ViewName}}_table_delete',function(){
  window.{{$ViewName}}_parents=$(this).parents('tr');
  window.{{$ViewName}}_row={{$ViewName}}_Table.row($(this).closest("tr"));
  var data=window.{{$ViewName}}_row.data();
  if ($(this).hasClass('selected')) {
    $(this).removeClass('selected');
  } else {
    window.{{$ViewName}}_oTable.$('tr.selected').removeClass('selected');
    $(this).addClass('selected');
    window.{{$ViewName}}_row = $(this).index();
  }    
  var action=$(this).attr('class');
  if (occurrences(action, 'delete', 1) > 0) {
     del_{{$ViewName}}(data['id'],data['Tanggal']);}
  else {
    edt_{{$ViewName}}(data['id'],data['Tanggal']);
  }
}); 


/*    
return window.open("{{url('ordsalesdlg')}}/"+id+"/"+Tanggal);
location.replace("{{url('edit-ordsales')}}");

    ss = window.{{$ViewName}}_name;
    if (isEmpty(ss) || (typeof ss!="string")) {ss="{{Str::title($head)}}"}
    if (confirm("Hapus Data Order Beli ("+id+"/"+Tanggal.substring(0, 10)+") ?") == true) {
      $.ajax({type: "POST",
      data: {id: id, Tanggal: Tanggal},
      dataType: 'json',
      url: '<?php echo url("delete-".$ViewName)?>',
      success: function(response){
        if (response>0) {
          var row = window.{{$ViewName}}_row;
          if ($(row).hasClass('child')) {
            {{$ViewName}}_Table.row($(row).prev('tr')).remove().draw();
          } else {
            {{$ViewName}}_Table
              .row(window.{{$ViewName}}_parents)
              .remove()
              .draw();
          }
      }},
error: function (response) {
      var r = jQuery.parseJSON(response.responseText);
      alert("Message: " + r.Message);
      alert("StackTrace: " + r.StackTrace);
      alert("ExceptionType: " + r.ExceptionType);
      }})    }
  }
*/