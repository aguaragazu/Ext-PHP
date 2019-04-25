valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;  

function reportSelect(bt){
  dynamic_grid_persona.getTopToolbar().get(8).setText(bt.text); 
  dynamic_grid_persona.getTopToolbar().get(8).mode = bt.mode;   
}

var dynamic_grid_persona = new Ext.ux.PhpDynamicGridPanel({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:ajax_url,
    sortInfo:{field:'apellido',direction:'ASC'}, //must declaration
    baseParams:{
      action:'read'
    },
    tbar:[
    '-',{
      text:'Print Mode',
      iconCls:'report-mode',
      menu:{
        items:[
        {text:'PDF',mode:'pdf',handler:reportSelect},
        {text:'XLS',mode:'xls',handler:reportSelect}
        ]
      }
    },'-',{
      text:'Print PDF',
      iconCls:'report-mode',
      mode:'pdf',
      handler:function(){
        options = dynamic_grid_persona.getParamsFilter();
        report_link = 'report.php?id=' + page;
        options = Ext.apply(options,{mode:this.mode}); 
        winReport({
            id : this.id,
            title : 'Personas List',
            url : report_link,
            type : this.mode,
            params:options        
        }); 
      }
    }
    ],
    tbarDisable:{  //if not declaration default is true
      add:!ROLE.ADD_DATA,
      edit:!ROLE.EDIT_DATA,
      remove:!ROLE.REMOVE_DATA
    },
   
    onAddData:function(bt){
      win_persona.get(0).getForm().reset();
      win_persona.setTitle('Add Data'); 
      win_persona.show(bt.id); 
    },
    onEditData:function(bt,rec){
      win_persona.setTitle('Edit Data');
      win_persona.show(bt.id); 
      win_persona.get(0).getForm().load({
          waitMsg:'Loading Data..',
          params:{action:'edit',id:rec.data.id}
      }); 
    },
    onRemoveData:function(bt,rec){
      data = []; 
      Ext.each(rec,function(r){
        data.push(r.data.id); 
      }); 
      Ext.Ajax.request({
        url: ajax_url, 
        params:{
          action:'destroy',
          data:data.join(",")
        },
        success:function(){
          this.store.reload(); 
        },
        scope:this
      });       
    }
}); 



/**form edit dan form add **/ 
win_persona = new Ext.Window({
  id:'win-persona',
  closeAction:'hide',
  closable:true,
  title:'Add Data',
  height:200,
  border:false,
  width:350,
  modal:true,
  layout:'fit',
  items:[{
    xtype:'form',
    border:false,
    frame:true,
    labelWidth:100,
    waitMsgTarget: true,
    url:ajax_url,
    defaults:{
      anchor:'98%',
      labelSeparator:''
    },
    bodyStyle:{padding:'10px'},
    items:[
    {xtype:'hidden', name:'id'},
    {xtype:'textfield',name:'apellido',fieldLabel:'Apellido',allowBlank:false},
    {xtype:'textfield',name:'nombre',fieldLabel:'Nombre',allowBlank:false},
    {xtype:'textfield',name:'cel_numero',fieldLabel:'Celular'},
    {xtype:'textfield',name:'email',fieldLabel:'Email'}
    ]
  }], 
  buttons:[
  {
    text:'Save',
    handler:function(){
      if(!win_persona.get(0).getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
        return false; 
      }
      
      id_data = win_persona.get(0).getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      win_persona.get(0).getForm().submit({
          params:{action:action},
          waitMsg : 'Saving Data',
          success:function(){
            win_persona.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            dynamic_grid_persona.store.reload(); 
          },
          failure:function(){
            Ext.MessageBox.alert('Peringatan','Data tidak bisa disimpan, lihat difirebug errornya!!'); 
          }
      }); 
      
    }
  },{
    text:'Close',
    handler:function(){
      win_persona.hide(); 
    }
  }
  ]
}); 

/**end of form**/


var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  items : [dynamic_grid_persona],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-persona');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 
