window.del_{{$ViewName}}=function(id,Tanggal)
  {
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
