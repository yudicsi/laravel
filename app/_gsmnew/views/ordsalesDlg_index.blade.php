window.{{$ViewName}}_Table = $('#{{$ViewName}}_table').DataTable({
  dom: "Brtp",
  autoWidth: false,
  processing: true,
  serverSide: false,
  keys: true,
  scrollX: true,
  pagingType: "numbers",
  buttons: [
      {
          text: "Add", className: "addButton",
          action: function (e, dt, bt, config) { addRow(e, dt, bt, config); }
      },
      {
          text: "Delete", className: "deleteButton",
          extend: "selectedSingle",
          action: function (e, dt, bt, config) { removeRow(e, dt, bt, config); }
      },
      {
          text: "Edit", className: "editButton",
          extend: "selectedSingle",
          action: function (e, dt, bt, config) { editRow(e, dt, bt, config); }
      },
      {
            text: "Update", className: "updateButton UnchangedRow",
            extend: "selected",
            action: function (e, dt, bt, config) { saveRow(e, dt, bt, config); }
        },
        {
            text: "Assess", className: "Assess",
            action: function (e, dt, bt, config) { 
                var deletedRows = [];
                var addedRows = [];
                var changedRows = [];
                table.rows().iterator( 'row', function ( context, index ) {
              
                var $state = $("i", this.row( index ).node() );
                    if($state.hasClass("UnchangedRow")){
                        // do noting with this row, nothing has changed
                    }
                    else if($state.hasClass("DeleteRow")) {
                        if($state.hasClass("NewRow")) {
                            // User added this row then changed mind
                            // Just let is drop off when table is refreshed
                        }
                        else {
                            deletedRows.push(this.row( index ).data());
                        }
                    }
                    else if($state.hasClass("NewRow")){
                        // if we have a new row but the row has now data, it gets ignored.
                        var newData  = this.row( index ).data();
                        var s = "";
                        $.each(cols, function(i, itme){
                            if(i > 0){
                                s += newData[cols[i].data];
                            }
                        });
                        if(s.length > 0){
                            addedRows.push(newData);
                        }
                        
                    }else
                    {
                        // Changed data
                        // I should put something here to make sure the user is not emptying out the row.
                        changedRows.push(this.row( index ).data());
                    }
                    
                  } );
                
  sendOffToAjax(addedRows, changedRows, deletedRows);
                
            }
        }
  ],

  ajax: {
    'url' : '<?php echo url("edit-{$ViewName}")?>',
    'data' : {id: localStorage.getItem("id"), tgl: localStorage.getItem("Tanggal")},
    'type' : "POST"
  },
  dataType: 'json',
  pageLength: 6,
  columns: [
    {data: 'Qty',name: 'Qty'},               //0
    {data: 'No_Satuan',name: 'No_Satuan'},  //1
    {data: 'Qty2',name: 'Qty2'}, //2
    {data: 'No_Satuan2',name: 'No_Satuan2'},  //3
    {data: 'Urut',name: 'Urut', Type: "numeric", render: function(data, type, row) {return data+'.'}},  //4
    {data: null, name: 'Kode', render: function(data, type, row) {
      return data.KdStruk + '<br />' + data.Lable;}},       //5
    {data: null, name: 'Artikel', render: function(data, type, row) {
      ss= data.NamaFg + '<br/> ';   //6
      ss+=(data.Isi_1>0 && data.Sat_1.length>0)?'<B>(<I>1</I>)</B> '+titleCase(data.Sat_1)+'/'+data.Isi_1+',/Rp. '+$.fn.dataTable.render.number('.').display(data.Hrg_Beli1):'';
      ss+=(data.Isi_2>0 && data.Sat_2.length>0)?',  <B>(<I>2</I>)</B> '+titleCase(data.Sat_2)+'/'+data.Isi_2+'/Rp. '+$.fn.dataTable.render.number('.').display(data.Hrg_Beli2):'';
      ss+=(data.Isi_3>0 && data.Sat_3.length>0)?',  <B>(<I>3</I>)</B> '+titleCase(data.Sat_3)+'/'+data.Isi_3+'/Rp. '+$.fn.dataTable.render.number('.').display(data.Hrg_Beli3):'';
      return ss;}},      
    {data: null, name: "Satuanx", "autoWidth": true,
      render: function (data, type, row) {
      return data.Satuan+'/'+data.Isi+'<br/>Rp. '+$.fn.dataTable.render.number('.').display(data.Harga);}
    },   //7
    {data: null, name: "Totalx", "autoWidth": true,
      render: function (data, type, row) {
      return $.fn.dataTable.render.number('.').display(data.QntKecil)+'/'+'<br/>Rp. '+
      $.fn.dataTable.render.number('.').display(data.Total);}
    },   //8
    {data: 'NmGroup',name: 'NmGroup'},  //9
    {data: 'Satuan',name: 'Satuan'},   //10
    {data: 'Isi',name: 'Isi'},  //11
    {data: 'Lable',name: 'Lable'},  //12
    {data: 'KdStruk',name: 'KdStruk'},  //13
    {data: 'Isi_1',name: 'Isi_1'},   //14
    {data: 'Sat_1',name: 'Sat_1'},   //15
    {data: 'Hrg_Beli1',name: 'Hrg_Beli1'},  //16
    {data: 'Isi_2',name: 'Isi_2'},   //17
    {data: 'Sat_2',name: 'Sat_2'},   //18
    {data: 'Hrg_Beli2',name: 'Hrg_Beli2'},   //19
    {data: 'Isi_3',name: 'Isi_3'},   //20
    {data: 'Sat_3',name: 'Sat_3'},  //21
    {data: 'Hrg_Beli3',name: 'Hrg_Beli3'},  //22
    {data: 'id',name: 'id'}  //23
    ],
  columnDefs: [
    {targets: [0,2],width:"5%"},
    {targets: [1,3],width:"3%"},
    {target: 4,width:"5%",
     createdCell: function (td) {
       $(td).addClass('delete_');
     }
    },
    {target: 5,width:"9%"},
    {targets: [10,11,12,13,14,15,16,17,18,19,20,21,22,23],visible: false, searchable: false,},
    {targets: [0,1,2,3,4,5,6,7,8],className: 'dt-head-center'}, 
    {targets: [1,3,4,5,7,8],className: 'dt-center'},
    {targets: [0,1,2,3], orderable: false, 
      searchable: false, className: 'dt-right', createdCell: function (td) {
        $(td).addClass('edit_');
      },
      render: function( data, type, row ) {
        return ( data == 0 || data == 0.0 ) ? '' : $.fn.dataTable.render.number( '.', ',', 0, '', '' ).display( data ) 
      }
    },
    {target: 0,className: 'Qty'},
    {target: 1,className: 'No_Satuan'},
    {target: 2,className: 'Qty2'},
    {target: 3,className: 'No_Satuan2'},
    {target: 7,className: 'Satuanx'},
    {target: 8,className: 'Totalx'},
  ],
  order: [[4, 'asc']],
  select: "single",
  initComplete: function() {
	$('div.dataTables_scrollFootInner tfoot tr#filterboxrow th').each(function() {
    var title = $(this).text().trim().toLowerCase();
    if (occurrences('x close action + add', title, 1) == 0) {
      $(this).html('<input id="input' + $(this).index() + '" type="text" style="border:none;outline: none;" class="form-control" placeholder="Search"/>')
      .css('padding-left', '4px');
      $(this).on('keyup change', function() {
      var val;
      if ($(this).index() === 0) {
        val = $('.DTFC_Cloned #input' + $(this).index()).val()
      }
      else {
        val = $('#input' + $(this).index()).val();
      }
      window.{{$ViewName}}_Table.column($(this).index()+3).search(val).draw();
      });
    }
	});
  }	
}).on("user-select", function (e, dt, type, cell, originalEvent) {
    // I do not let the user deselect until done editing the row or editing is cancelled
    if ($("#example input[type=text]").length > 0) { return false; }
  });



function addRow(e, dt, bt, config) {
  var $nr = dt.row.add(
      {
          Urut: 0,
          hasChanged: true,
          Qty: "",
          No_Satuan: "",
          cn: "",
          No_Satuan2: ""
      });
  $nr.draw(false).select();
  // now that I have added the new row, put it in edit mode
  editRow(e, dt, bt, config);
}

// Mark or unmark row for delete
function removeRow(e, dt, bt, config) {
  var r = $("i", dt.rows(".selected").nodes()[0]);
  r.toggleClass('DeleteRow').removeClass("UnchangedRow");
  // if row is unmark for delete and there are no other changes or an add, mark unchangedd
  if (!(r.hasClass("NewRow") || r.hasClass("ChangedRow") || r.hasClass("DeleteRow"))) {
      r.addClass("UnchangedRow");
  }
}

// Updates the data object associated with a row to 
// match what is in the html cell, then take out of edit mode
function saveRow(e, dt, bt, config) {
    // get html nodes
    var r = dt.rows(".selected").nodes()[0];

    // if row is not edit mode, just return.
    if ($("input[type=text]", r).length === 0) { return; }
    // get the data object associated with the row so it can be updated
    var d = dt.rows(".selected").data()[0];


    // check for changes while converting back
    $(r).children("td").each(function (i, it) {
        
        if (i == 0) {
            // do not do anything for first column
        }
        else {
            var di = $("input", it).val();
            $(it).html(di);
            if (d[cols[i].data] != di) {
                if (!$("i", r).hasClass("NewRow")) {
                    $("i", r).addClass("ChangedRow");
                }
                $("i", r).removeClass("UnchangedRow");
            }
            d[cols[i].data] = di;
        }
    });
    setButtons("normal")

}

// Put row in edit mode
function editRow(e, dt, bt, config) {
    var r = dt.rows(".selected").nodes()[0];
    // This section takes the row out of edit mode without 
    if ($(window.{{$ViewName}}_Table.buttons(".editButton")[0].node).find("span").text() == "Cancel") {
        $(r).children("td").each(function (i, it) {
            if (i > 0) {
                var od = dt.cells(it).data()[0];
                $(it).html(od);
            }
        });
        // Put code here if you want to get rid of empty rows that 
        setButtons('cancel');
    }
    else {
        $(r).children("td").each(function (i, it) {
            if (i > 0) {
                var h = $("<input type='text'>");
                h.val(it.innerText);
                $(it).html(h);
            }
        });
        setButtons('edit');
    }
}

// set button enabled state and visiblility
function setButtons(mode) {
  window.{{$ViewName}}_Table.buttons().enable(false);
  window.{{$ViewName}}_Table.buttons(".Assess").enable(true);
  switch (mode) {
    case "edit":
      window.{{$ViewName}}_Table.buttons([".editButton", ".updateButton"]).enable(true);
        $(window.{{$ViewName}}_Table.buttons(".editButton")[0].node).find("span").text('Cancel');
        $(window.{{$ViewName}}_Table.buttons(".updateButton")[0].node).removeClass("UnchangedRow");
        break;
    case "cancel":
    case "normal":
      window.{{$ViewName}}_Table.buttons([".editButton", ".addButton", ".deleteButton"]).enable(true);
        $(window.{{$ViewName}}_Table.buttons(".editButton")[0].node).find("span").text('Edit');
        $(window.{{$ViewName}}_Table.buttons(".updateButton")[0].node).addClass("UnchangedRow");
        break;
  }
}
function sendOffToAjax(addedRows, changedRows, deletedRows){
    
    alert("Added Rows: " + addedRows.length + 
          "\n Changed Rows: " + changedRows.length +
          "\n Deleted Rows: " + deletedRows.length);
    /*
    and ajax to do the save
    $.ajax(
        {
            "url":" My web method",
            "data": JSON.stringify({"AddedRows":addedRows, "ChangedRows":changedRows, "DeletedRows":deletedRows}),
            "success":function(response){
                // put code here that updates the table after a save
            },
            "error":function(err){
                // handle error
            }
            
        }
    )
    */
}
