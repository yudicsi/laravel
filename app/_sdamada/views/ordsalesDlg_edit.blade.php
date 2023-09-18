
ordsalesDlg_Table.on('change', 'input',function(){
  var rr = $(this).closest("tr");
  var row = {{$ViewName}}_Table.row(rr);
  if (typeof(ordsalesDlg_Data)=='undefined' || isEmpty(ordsalesDlg_Data)) window.ordsalesDlg_Data = row.data();
  if (!$(this).is('.change_')) $(this).addClass('change_');
  var r2=rr.find('TD:eq(4)');
  if (!r2.is('.change_')) r2.addClass('change_');
  var r2=$(this).closest("TD");
  if (r2.hasClass('Qty') || r2.hasClass('No_Satuan')) {
     if (r2.hasClass('Qty')) 
       ordsalesDlg_Data['Qty']=Number($(this).closest("input")[0].value); 
     else {
       ordsalesDlg_Data['No_Satuan']=Number($(this).closest("input")[0].value);
       ordsalesDlg_Data['Satuan']=ordsalesDlg_Data['Sat_'+ordsalesDlg_Data['No_Satuan']];
       ordsalesDlg_Data['Isi']=ordsalesDlg_Data['Isi_'+ordsalesDlg_Data['No_Satuan']];
       ordsalesDlg_Data['Harga']=ordsalesDlg_Data['Hrg_Beli'+ordsalesDlg_Data['No_Satuan']];     
       $('.Satuanx', rr).html(ordsalesDlg_Data['Satuan']+'/'+ordsalesDlg_Data['Isi']+'<br/>Rp. '+number_format(ordsalesDlg_Data['Harga']));
     }
     ordsalesDlg_Data['QntKecil']=ordsalesDlg_Data['Qty']*ordsalesDlg_Data['Isi'];
     ordsalesDlg_Data['Total']=ordsalesDlg_Data['Qty']*ordsalesDlg_Data['Harga'];
     $('.Totalx', rr).html(ordsalesDlg_Data['QntKecil']+'/'+'<br/>Rp. '+number_format(ordsalesDlg_Data['Total']));}
  else {
     if (r2.hasClass('Qty2')) 
       ordsalesDlg_Data['Qty2']=Number($(this).closest("input")[0].value); 
     else 
       ordsalesDlg_Data['No_Satuan2']=Number($(this).closest("input")[0].value); 
  }
});

function edit_po() {
  Result =  false;
  if (typeof(ordsalesDlg_rr) !== 'undefined') {
     r2=ordsalesDlg_rr.find('TD:eq(4)'); 
     if (r2.is('.change_') && ordsalesDlg_Data !== 'undefined') { $.ajax({
        type: "POST", 
        url: "{{url('update-ordsalesDlg')}}",
        dataType: 'json',
        data: {tgl: localStorage.getItem("Tanggal"), No_Faktur: localStorage.getItem("id"), 
          Urut: ordsalesDlg_Data['Urut'], Qty: ordsalesDlg_Data['Qty'], No_Satuan: ordsalesDlg_Data['No_Satuan'], 
          Qty2: ordsalesDlg_Data['Qty2'], No_Satuan2: ordsalesDlg_Data['No_Satuan2']},
        success: function(res) {
          if (!res) 
            alert('Terjadi kesalahan saat simpan file ');
          else {
            r2.removeClass('change_');
            $(ordsalesDlg_rr).children("td").each(function (i, it) {
              $(it).removeClass('change_');
            });
            ordsalesDlg_Data = undefined;
          }
          Result =  true;
        }
     });
   }
  }
}

ordsalesDlg_Table.on('click','.edit_, .delete_',function(){
  var rr = $(this).closest("tr");
  var _idx = rr.find('td:eq(4)').text();
  if ($(this).is('.delete_')) {
     if (rr.find('TD:eq(4)').is('.change_')) edit_po();} 
  else {
    if (typeof(ordsalesDlg_rr) !== 'undefined') {
      if (_idx == ordsalesDlg_idx) return;
      ordsalesDlg_rr.find('TD.edit_').each(function (i, it) {
        if (it.childElementCount>0) {
          zz=it.children[0];
          ss=zz.value;
          it.removeChild(zz);
          it.innerText=ss;
        }
      });
      edit_po();
    }
    window.ordsalesDlg_rr = rr;
    window.ordsalesDlg_idx = ordsalesDlg_rr.find('td:eq(4)').text();
    ordsalesDlg_rr.find('TD.edit_').each(function (i, it) {
      ss=it.innerText;
      var h = $("<input type='text' class='edit_' style='text-align:right;width:100%;border:none;outline: none;font-size:15px;'>");
      h.val(ss);
      $(it).html(h);
    });    
    if ($(this).hasClass('selected')) 
      $(this).removeClass('selected');  
    else {
      window.ordsalesDlg_oTable.$('tr.selected').removeClass('selected');
      rr.addClass('selected');
      window.ordsalesDlg_row = $(this).index();
    }    
  }
});
  