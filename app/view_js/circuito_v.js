valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;  

function reportSelect(bt){
  dynamic_grid_circuito.getTopToolbar().get(8).setText(bt.text); 
  dynamic_grid_circuito.getTopToolbar().get(8).mode = bt.mode;   
}

var dynamic_grid_circuito = new Ext.ux.PhpDynamicGridPanel({
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:ajax_url,
    sortInfo:{field:'numero',direction:'ASC'}, //must declaration
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
        options = dynamic_grid_circuito.getParamsFilter();
        report_link = 'report.php?id=' + page;
        options = Ext.apply(options,{mode:this.mode}); 
        winReport({
            id : this.id,
            title : 'Circuito List',
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
      win_Circuito.get(0).getForm().reset();
      win_Circuito.setTitle('Add Data'); 
      win_Circuito.show(bt.id); 
    },
    onEditData:function(bt,rec){
      win_Circuito.setTitle('Edit Data');
      win_Circuito.show(bt.id); 
      win_Circuito.get(0).getForm().load({
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
var comboZona = new Ext.form.ComboBox({
    id: 'zona',
    typeAhead: true,
    fieldLabel: 'Zona',
    triggerAction: 'all',
    lazyRender:true,
    mode: 'local',
    store: new Ext.data.ArrayStore({
        id: 0,
        fields: [
            'zona_id',
            'zona'
        ],
        data: [['S', 'Sur'], ['N', 'Norte']]
    }),
    valueField: 'zona_id',
    displayField: 'zona'
});

var comboNivel = new Ext.form.ComboBox({
    id: 'nivel',
    typeAhead: true,
    fieldLabel: 'Nivel',
    triggerAction: 'all',
    lazyRender:true,
    mode: 'local',
    store: new Ext.data.ArrayStore({
        id: 0,
        fields: [
            'nivel_id',
            'nivel'
        ],
        data: [['inicial','Inicial'],['primario','Primario'],['secundario','Secundario'],['superior','Superior']]
    }),
    valueField: 'nivel_id',
    displayField: 'nivel'
});

/**form edit dan form add **/ 
win_Circuito = new Ext.Window({
  id:'win-Circuito',
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
    {xtype:'textfield',name:'numero',fieldLabel:'Numero',allowBlank:false},
    comboNivel,
    comboZona
    ]
  }], 
  buttons:[
  {
    text:'Guardar',
    handler:function(){
      if(!win_Circuito.get(0).getForm().isValid()){
        Ext.example.msg('Peringatan','Ada data yang kosong'); 
        return false; 
      }
      
      id_data = win_Circuito.get(0).getForm().getValues().id; 
      action = (id_data?'update':'create'); 
      win_Circuito.get(0).getForm().submit({
          params:{action:action},
          waitMsg : 'Saving Data',
          success:function(){
            win_Circuito.hide();
            Ext.example.msg('Simpan','Data telah disimpan'); 
            dynamic_grid_circuito.store.reload(); 
          },
          failure:function(){
            Ext.MessageBox.alert('Peringatan','Data tidak bisa disimpan, lihat difirebug errornya!!'); 
          }
      }); 
      
    }
  },{
    text:'Close',
    handler:function(){
      win_Circuito.hide(); 
    }
  }
  ]
}); 

/**end of form**/


var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  items : [dynamic_grid_circuito],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('win-Circuito');
      if (my_win)
          my_win.destroy(); 
    }
  }
}; 
