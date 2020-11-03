
<script>
    var spinner =new jQuerySpinner({
        parentId:'container'
    });

    spinner.show();

    function msg(text) { 
        $("#log").prepend(text + "<br/>");
    }

        $(document).on('click','#load_units',function(){
            
            var sess = wialon.core.Session.getInstance();
            var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;
            wialon.core.Remote.getInstance().remoteCall(
                'core/batch',
                {
                    "params":[
                        {
                            "svc":"core/search_items",
                            "params":{
                                "spec":{
                                    "itemsType":"avl_unit",
                                    "propName":"sys_name",
                                    "propValueMask":"*",
                                    "sortType":"sys_name"
                                },
                                "force":1,
                                "flags":1439,
                                "from":0,
                                "to":100
                            }
                        }
                    ],
                    "flags":0
                },
    
                function(callback,response){

                    if(callback==0){
                                        
                        var html='';
                        for(var i=0;i<response[0]['items'].length;i++){
                            html+="<option value="+response[0]['items'][i].id+">"+response[0]['items'][i].nm+"</option>";
                        }
                        $("#all_units").html(html);
                        spinner.hide();
                    }else{
                        Swal.fire("Operation failed", '', 'error')
                        spinner.hide();
                    }
                    
                }
            )
            spinner.hide();
        });


        $(document).on('click','.editUser',function(){

            var sess = wialon.core.Session.getInstance();
            var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;
            $("#editname").val($(this).data('name'));
            $("#userId").val($(this).data('id'));

            var user_id = $(this).data('id');

            wialon.core.Remote.getInstance().remoteCall(
                'core/batch',
                {
                    "params":[                                    
                        {
                            "svc":"core/search_items",
                            "params":{
                                "spec":{
                                    "itemsType":"user",
                                    "propName":"sys_name",
                                    "propValueMask":"*",
                                    "sortType":"sys_name",
                                    "propType":"avl_unit"
                                },
                                "force":1,
                                "flags":1,
                                "from":0,
                                "to":0 
                            }
                        },    
                        
                        {
                            "svc":"core/search_items",
                            "params":{
                                "spec":{
                                    "id":"400200808",
                                },
                                "flags":256,
                            }
                        },    
                    
                        {{-- {                
                            "svc":"user/get_items_access",
                            "params":{
                               "userId": user_id,
                               "directAccess":0,
                               "itemSuperclass":"avl_unit",
                               "flags":0
                            }
                         },  --}}
                         {{--  {
                            "svc":"core/check_accessors",
                            "params":{
                               "items": ['400209678'],
                               "flags":1
                            }                                  
                         }, 
                         {
                            "svc":"core/check_items_billing",
                            "params":{
                               "items": ['400181610'],
                               "accessFlags":0xfffffffffffffff,
                               "serviceName": "avl_unit"
                            } 
                         },               
                         {  
                            "svc":"account/get_account_data",
                            "params":{
                               "itemId": 400209678,
                               "type":'avl_unit',
                            } 
                         },  --}}
                        

                    ],
                    "flags":0
                },
    
                function(callback,response){ 
                    if(callback==0){ 
                       spinner.hide();

                       get_user_permission();

                       {{--  let unit_items = response[1].items;
                       let user_unit = response[2];
                       var user_unit_data = [];
                        for (var i = 0; i < response[1].items.length; i++) {
                            for (let key in user_unit) {
                                if (response[1].items[i].id == key) { 
                                    user_unit_data.push(response[1].items[i]);
                                } 
                            }     
                        } 
                        console.log(user_unit_data);  --}}
                    }else{
                        Swal.fire("Operation failed", '', 'error')
                        spinner.hide();
                    }
                } 
            )
            spinner.hide();
            $("#editUser").modal(); 

          })

          function get_user_permission(){
                var sess = wialon.core.Session.getInstance();
                var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;
                $("#editname").val($(this).data('name'));
                $("#userId").val($(this).data('id'));
                var user_id = $(this).data('id');


                wialon.core.Remote.getInstance().remoteCall(

            
                    'core/search_item', 
                    {
                        "id": 400200808,
                        "flags": 4294967295
                    },

                    function(callback, response)
                    {
                        if(callback==0){ 
                            spinner.hide();                        
                         }else{
                             Swal.fire("Operation failed", '', 'error')
                             spinner.hide();
                         }
                    }

                )


          }


          $(document).on('click','.assign_unit_model',function(){ 


            var sess = wialon.core.Session.getInstance();
            var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;
            $("#assign_u_id").val($(this).data('id'));
            var user_id = $(this).data('id');

            wialon.core.Remote.getInstance().remoteCall(                        
                'core/batch',
                {
                    "params":[
                        { 
                            "svc":"core/search_items",
                            "params":{
                                "spec":{
                                    "itemsType":"user",
                                    "propName":"sys_name",
                                    "propValueMask":"*",
                                    "sortType":"sys_name",
                                    "propType":"avl_unit"
                                },
                                "force":1,
                                "flags":1,
                                "from":0,
                                "to":0
                            } 
                        },                 
                        {                    
                            "svc":"core/search_items",
                            "params":{  
                                "spec":{   
                                    "itemsType":"avl_unit",
                                    "propName":"sys_name", 
                                    "propValueMask":"*",
                                    "sortType":"sys_name"
                                },
                                "force":1, 
                                "flags":1439,
                                "from":0,
                                "to":0
                            }
                        },
                        {
                            "svc":"user/get_items_access", 
                            "params":{
                               "userId": user_id,
                               "directAccess":0,
                               "itemSuperclass":"avl_unit",
                               "flags":0
                            }
                         },
                         {{--  {
                            "svc":"core/check_accessors",
                            "params":{
                               "items": ['400209678'],
                               "flags":1
                            }
                         }, 
                         {  
                            "svc":"core/check_items_billing",
                            "params":{
                               "items": ['400181610'],
                               "accessFlags":0xfffffffffffffff,
                               "serviceName": "avl_unit" 
                            }
                         },
                         { 
                            "svc":"account/get_account_data",      
                            "params":{ 
                               "itemId": 400209678, 
                               "type":'avl_unit', 
                            }
                         },  --}} 
                        

                    ],
                    "flags":0
                },
    
                function(callback,response){ 
                    if(callback==0){ 
                        let unit_items = response[1].items; 
                        let user_unit = response[2];
                        var user_unit_data = [];
                        for (var i = 0; i < response[1].items.length; i++) {
                            for (let key in user_unit) {
                                if (response[1].items[i].id == key) {  
                                    user_unit_data.push(response[1].items[i]);
                                } 
                            } 
                        }
                        var html='';
                        for(var i=0;i<response[1]['items'].length;i++){
                              let obj=_.find(user_unit_data,{id:response[1]['items'][i].id});
                              if(obj){
                                html+="<option disabled  value="+response[1]['items'][i].id+">"+response[1]['items'][i].nm+"</option>";
                              }else{
                                html+="<option   value="+response[1]['items'][i].id+">"+response[1]['items'][i].nm+"</option>";
                              }
                        }
                        $("#assign_unit").html(html);
                        spinner.hide();
                    }else{
                        Swal.fire("Operation failed", '', 'error')
                        spinner.hide();
                    }
                }
            )
            spinner.hide();
            $("#assign_unit_model").modal();

          })
          
          
          $(document).on('click','.units_model',function(){ 


            var sess = wialon.core.Session.getInstance();
            var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;
            $("#assign_u_id").val($(this).data('id'));
            var user_id = $(this).data('id');

            wialon.core.Remote.getInstance().remoteCall(                        
                'core/batch',
                {
                    "params":[
                        { 
                            "svc":"core/search_items",
                            "params":{
                                "spec":{
                                    "itemsType":"user",
                                    "propName":"sys_name",
                                    "propValueMask":"*",
                                    "sortType":"sys_name",
                                    "propType":"avl_unit"
                                },
                                "force":1,
                                "flags":1,
                                "from":0,
                                "to":0
                            } 
                        },                 
                        {                    
                            "svc":"core/search_items",
                            "params":{  
                                "spec":{   
                                    "itemsType":"avl_unit",
                                    "propName":"sys_name", 
                                    "propValueMask":"*",
                                    "sortType":"sys_name"
                                },
                                "force":1, 
                                "flags":1439,
                                "from":0,
                                "to":0
                            }
                        },
                        {
                            "svc":"user/get_items_access", 
                            "params":{
                               "userId": user_id,
                               "directAccess":0,
                               "itemSuperclass":"avl_unit",
                               "flags":0
                            }
                         },
                         {{--  {
                            "svc":"core/check_accessors",
                            "params":{
                               "items": ['400209678'],
                               "flags":1
                            }
                         }, 
                         {  
                            "svc":"core/check_items_billing",
                            "params":{
                               "items": ['400181610'],
                               "accessFlags":0xfffffffffffffff,
                               "serviceName": "avl_unit" 
                            }
                         },
                         { 
                            "svc":"account/get_account_data",      
                            "params":{ 
                               "itemId": 400209678, 
                               "type":'avl_unit', 
                            }
                         },  --}} 
                        

                    ],
                    "flags":0
                },
    
                function(callback,response){ 
                    if(callback==0){ 
                        let unit_items = response[1].items; 
                        let user_unit = response[2];
                        var user_unit_data = [];
                        for (var i = 0; i < response[1].items.length; i++) {
                            for (let key in user_unit) {
                                if (response[1].items[i].id == key) {  
                                    user_unit_data.push(response[1].items[i]);
                                } 
                            } 
                        }
                        var html='';
                        console.log('skndr');
                        console.log(user_unit);
                        console.log('bajwa');
                        for(var i=0;i<response[1]['items'].length;i++){
                              let obj=_.find(user_unit_data,{id:response[1]['items'][i].id});
                              if(obj){
                                html+="<option  value="+response[1]['items'][i].id+">"+response[1]['items'][i].nm+"</option>";
                              }
                              {{--  else{
                                html+="<option   value="+response[1]['items'][i].id+">"+response[1]['items'][i].nm+"</option>";
                              }  --}}
                        }
                        $("#units_assigned").html(html);
                        spinner.hide();
                    }else{
                        Swal.fire("Operation failed", '', 'error')
                        spinner.hide();
                    }
                }
            )
            spinner.hide();
            $("#units_model").modal();

          })

          $(document).on('click','.view_units_model',function(){ 


            var sess = wialon.core.Session.getInstance();
            var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;
            $("#assign_u_id").val($(this).data('id'));
            var user_id = $(this).data('id');

            wialon.core.Remote.getInstance().remoteCall(                        
                'core/batch',
                {
                    "params":[       
                        {                    
                            "svc":"core/search_items",
                            "params":{  
                                "spec":{   
                                    "itemsType":"avl_unit",
                                    "propName":"sys_name", 
                                    "propValueMask":"*",
                                    "sortType":"sys_name"
                                },
                                "force":1, 
                                "flags":1439,
                                "from":0,
                                "to":0
                            }
                        },
                        {
                            "svc":"user/get_items_access", 
                            "params":{
                               "userId": user_id,
                               "directAccess":0,
                               "itemSuperclass":"avl_unit",
                               "flags":0
                            }
                         },
                    ],
                    "flags":0
                },
    
                function(callback,response){ 
                    if(callback==0){ 
                        let unit_items = response[0].items; 
                        let user_unit = response[1];
                        var user_unit_data = [];
                        for (var i = 0; i < response[0].items.length; i++) {
                            for (let key in user_unit) {
                                if (response[0].items[i].id == key) {  
                                    user_unit_data.push(response[0].items[i]);
                                } 
                            } 
                        }
                        var html='';
                        for(var i=0;i<response[0]['items'].length;i++){
                            let obj=_.find(user_unit_data,{id:response[0]['items'][i].id});
                            if(obj){
                                html+="<div>"+response[0]['items'][i].nm+"</div>";
                            }
                            {{--  if(!obj){
                                html+="<div>This user does not have access to any units.</div>";
                            }  --}}
                        }
                        $("#user_assigned_units1").html(html);
                        spinner.hide();
                    }else{
                        Swal.fire("Operation failed", '', 'error')
                        spinner.hide();
                    }
                }
            )
            spinner.hide();
            $("#view_units_model").modal();

          })

    
    $(document).on("click",".units_assigned",function(){      
        var u_id = document.getElementById('assign_u_id').value;   
        var unit_id =  $(".units_assigned").val();
        getUserUnitPremission(u_id, unit_id)
    });

    
    function getUserUnitPremission(user_id, unit_id){
        var sess = wialon.core.Session.getInstance();
            var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;
            var unit_premission = 0;
            wialon.core.Remote.getInstance().remoteCall(                        
                'core/batch',
                {
                    "params":[
                        {
                            "svc":"user/get_items_access", 
                            "params":{
                               "userId": user_id,
                               "directAccess":0,
                               "itemSuperclass":"avl_unit",
                               "flags":0
                            }
                         }
                    ],
                    "flags":0
                },
    
                function(callback,response){ 
                    if(callback==0){ 
                        let user_unit = response[0];
                        for (const [key, value] of Object.entries(user_unit)) {
                            if(key == unit_id){
                                unit_premission = value;
                            }
                        }                        
                        
                        if(unit_premission == 880333094911){
                            var text="";
                            text+="<label class='raido_unit_prem_a; for='all_units'>Unit Access Premission:</label>";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='0'> NoAccess (It will un-assign unit)";
                            text+="<br>";
                            text+="<input type='radio' checked name='user_unit_access_p1' value='880333094911'> Full Access";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='16931'> Read Only";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='549760026423'> Standrad Accesss";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='17201'> Basic Access";
                            text+="<br>";
                            $("#user_u_prem").html(text);
                        }else if(unit_premission == 16931){
                            var text="";
                            text+="<label class='raido_unit_prem_a; for='all_units'>Unit Access Premission:</label>";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='0'> NoAccess (It will un-assign unit)";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='880333094911'> Full Access";
                            text+="<br>";
                            text+="<input type='radio' checked name='user_unit_access_p1' value='16931'> Read Only";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='549760026423'> Standrad Accesss";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='17201'> Basic Access";
                            text+="<br>";
                            $("#user_u_prem").html(text);
                        }else if(unit_premission == 549760026423){
                            var text="";
                            text+="<label class='raido_unit_prem_a; for='all_units'>Unit Access Premission:</label>";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='0'> NoAccess (It will un-assign unit)";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='880333094911'> Full Access";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='16931'> Read Only";
                            text+="<br>";
                            text+="<input type='radio' checked name='user_unit_access_p1' value='549760026423'> Standrad Accesss";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='17201'> Basic Access";
                            text+="<br>";
                            $("#user_u_prem").html(text);
                        }else if(unit_premission == 17201){
                            var text="";
                            text+="<label class='raido_unit_prem_a; for='all_units'>Unit Access Premission:</label>";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='0'> NoAccess (It will un-assign unit)";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='880333094911'> Full Access";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='16931'> Read Only";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='549760026423'> Standrad Accesss";
                            text+="<br>";
                            text+="<input type='radio' checked name='user_unit_access_p1' value='17201'> Basic Access";
                            text+="<br>";
                            $("#user_u_prem").html(text);
                        }else{
                            var text="";
                            text+="<label class='raido_unit_prem_a; for='all_units'>Unit Access Premission:</label>";
                            text+="<br>";
                            text+="<input type='radio' checked name='user_unit_access_p1' value='0'> NoAccess (It will un-assign unit)";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='880333094911'> Full Access";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='16931'> Read Only";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='549760026423'> Standrad Accesss";
                            text+="<br>";
                            text+="<input type='radio' name='user_unit_access_p1' value='17201'> Basic Access";
                            text+="<br>";
                            $("#user_u_prem").html(text);
                        }

                        spinner.hide();
                    }else{
                        Swal.fire("Operation failed", '', 'error')
                        spinner.hide();
                    }
                }
            )
            spinner.hide();
            $("#units_model").modal();
    }

    $("#assign-unit-form").submit(function(e){
        e.preventDefault();
        $(this).validate({
            submitHandler:function(form){
                var sess = wialon.core.Session.getInstance(); 
                var user = wialon.core.Session.getInstance().getCurrUser();
                payload.push({
                    "svc":"user/update_item_access", 
                    "params":{ 
                        "userId":     $("#assign_u_id").val(),
                        "itemId":     $("#assign_unit").val(),
                        "accessMask": $("input[name='user_unit_access_p']:checked").val(),
                    }
                  }
                );
                wialon.core.Remote.getInstance().
                remoteCall(
                    'core/batch', 
                    {
                        "params":payload,
                        "flags":0
                    },
                    function(callback){
                    if(callback==0){
                    $("#editUser").modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Unit Assigned Successfully.',
                        showConfirmButton: false,
                        timer: 1500
                        })
                        location.reload();
                    }
                });
            }
        })
    })
    
    
    $("#units-form").submit(function(e){
        e.preventDefault();
        $(this).validate({
            submitHandler:function(form){
                var sess = wialon.core.Session.getInstance(); 
                var user = wialon.core.Session.getInstance().getCurrUser();
                payload.push({
                    "svc":"user/update_item_access", 
                    "params":{ 
                        "userId":     $("#assign_u_id").val(),
                        "itemId":     $("#units_assigned").val(),
                        "accessMask": $("input[name='user_unit_access_p1']:checked").val(),
                    }
                  }
                );
                wialon.core.Remote.getInstance().
                remoteCall(
                    'core/batch', 
                    {
                        "params":payload,
                        "flags":0
                    },
                    function(callback){
                    if(callback==0){
                    $("#editUser").modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Unit Access Updated Successfully.',
                        showConfirmButton: false,
                        timer: 1500
                        })
                        location.reload();
                    }
                });
            }
        })
    })

</script>

