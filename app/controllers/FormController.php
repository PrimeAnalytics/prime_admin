<?php
namespace PRIME\Controllers;

class FormController extends ControllerBase
{
    protected function initialize()
    {
        \Phalcon\Tag::prependTitle('PRIME | ');
        $this->view->setViewsDir('../app/views/');
        $this->view->setLayoutsDir('/layouts/');
    }
    
    public function renderAction($layout)
    {        
        $struct=json_decode($layout,true);
        
        $this->view->disable();
        $echo_array= array();

        $echo_array['ref'][]='
        <link href="/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" media="screen"/>
        <script src="/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>
        <script src="/assets/plugins/select2/js/select2.js" type="text/javascript"></script>
        ';
        $echo_array['ref'][]= '
        <link href="/assets/plugins/icon-picker/css/fontawesome-iconpicker.min.css" rel="stylesheet">
        <script src="/assets/plugins/icon-picker/js/fontawesome-iconpicker.js"></script>
        ';

        //references end
        
        $echo_array['html']['footer']='
                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    '.$this->tag->submitButton(array("Save","class"=>"btn btn-primary")).'
                    </div>
                  </form>
                </div>';
        
        //modal end
        
        //body settings start
        
        
        $echo_array['html']['body']['parm'][]='<h4>Basic Settings</h4>
                                        <div class="row form-row" >';
        
        $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                            <label class="form-label">Width</label>
                                            <select name="width" style="width:100%">
                                                <option value="col-md-12">100%</option>
                                                <option value="col-md-9">75%</option>
                                                <option value="col-md-8">66%</option>
                                                <option value="col-md-6">50%</option>
                                                <option value="col-md-4">33%</option>
                                                <option value="col-md-3">25%</option>
                                            </select>
                                          </div>';  
        $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                            <label class="form-label">CSV Export</label>
                                            <select name="csv" style="width:100%">
                                                <option value="enable">Enable</option>
                                                <option value="disable">Disable</option>
                                            </select>
                                          </div>';  
        
        if( array_key_exists ( 'parm' , $struct))
        {
            $parms = $struct['parm'];
            foreach($parms as $parm)
            {
                if($parm['type']== 'input')
                {
                    $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                <label class="form-label">'.$parm['label'].'</label>
                                <input type="text" name="parameters[parm]['.$parm['name'].']" style="width:100%" ></input>
                                </div>';  
                }
                elseif($parm['type']== 'select')
                {
                    $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                <label class="form-label">'.$parm['label'].'</label>
                                <select name="parameters[parm]['.$parm['name'].']" style="width:100%" >';
                    foreach($parm['values'] as $option)
                    {
                        $echo_array['html']['body']['parm'][]= '<option value="'.$option['id'].'" >'.$option['value'].'</$option>';
                    };      
                    $echo_array['html']['body']['parm'][]= '</select>
                                </div>';
                } 
                elseif($parm['type']== 'color')
                {
                    $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                <label class="form-label">'.$parm['label'].'</label>
                                <select name="parameters[parm]['.$parm['name'].']" style="width:100%" >
                                <option value="[\'#058DC7\', \'#50B432\', \'#ED561B\', \'#DDDF00\', \'#24CBE5\', \'#64E572\',\'#FF9655\', \'#FFF263\', \'#6AF9C4\']">Default</option>
                                <option value="[\'#99ff99\', \'#99ffff\', \'#e7a3fd\', \'#e8e8e8\', \'#ffeb99\', \'#ff3300\']">Lumen</option>
                                <option value="[\'#f1511b\', \'#80cc28\', \'#00adef\', \'#fbbc09\', \'#706d6e\']">Microsoft</option>
                                </select>
                                </div>';
                } 
                
                elseif($parm['type']== 'icon')
                {
                    $echo_array['html']['body']['parm'][]= '<div class="col-md-6">
                                <label class="form-label">'.$parm['label'].'</label>
                                <div class="input-group">
                                <input class="form-control icp icp-auto" name="parameters[parm]['.$parm['name'].']" style="width:100%" ></input>
                                <span class="input-group-addon"></span>
                        </div>
                                </div>';
                } 
                
                elseif($parm['type']== 'table')
                {
                    $echo_array['html']['body']['parm'][]= '
                                                <div class="col-md-12">
                                                        <label class="form-label">Database Table</label>
                                                        <input class="dbTable" style="width:100%" name="parameters[parm]['.$parm['name'].']">
                                                        </input>
                                                </div>';
                }  
                
            } 

        }
        
        $echo_array['html']['body']['parm'][] = '</div>';   
        
        //body settings end
        
        //body database start
        
        if( array_key_exists ( 'db' , $struct))
        {
            $db_tables = $struct['db'];
            foreach($db_tables as $key=>$db_table)
            {
                $echo_array['html']['body']['db'][$key][] = '<h4>'.ucwords(str_replace ("_" , " " , $key)).'</h4>
                                                    <div class="row form-row" >';
                
                $echo_array['html']['body']['db'][$key][]  = '<div class="col-md-6">
                                                        <label class="form-label">Data Source Type</label>                    
                                                        <select id="'.$key.'dbType" style="width:100%" name="parameters[db]['.$key.'][type]">
                                                          <option value="table">Table</option>
                                                          <option value="procedure">Procedure</option>
                                                        </select>
                                                </div>';
                
                $echo_array['html']['body']['db'][$key][]  = '<div class="col-md-6">
                                                        <label class="form-label">Data Source</label>
                                                        <input id="'.$key.'dbTable" class="dbTable" style="width:100%" name="parameters[db]['.$key.'][table]">
                                                        </input>
                                                </div>
                                                </div>

                                                <div id="'.$key.'data_source_countainer">
                                                
                                                </div>
                                                <div class="row form-row" >
                                                
                                                ';
                
                foreach($db_table as $entry)
                {
                    if($entry['type'] == 'single')
                    {
                        $echo_array['html']['body']['db'][$key][] = '
                                        <div class="col-md-6 '.$key.'column" style="display:none">
                                                <label class="form-label">'.$entry['label'].'</label>
                                                <input class="'.$key.'column_s" style="width:100%" name="parameters[db]['.$key.']['.$entry['name'].']">
                                                </input>
                                          </div>';
                    }
                    elseif ($entry['type'] == 'multiple')
                    {
                        $echo_array['html']['body']['db'][$key][] = '
                                        <div class="col-md-6 '.$key.'column" style="display:none">
                                                <label class="form-label">'.$entry['label'].'</label>
                                                <input class="'.$key.'column_sm" style="width:100%"  " ></input>
                                                <select id = "'.$key.$entry['name'].'" style="display:none" multiple="multiple" name="parameters[db]['.$key.']['.$entry['name'].'][]" >
                                                </select>
                                          </div>';
                        
                    }
                    
                    elseif ($entry['type']=='link')
                    {
                        $echo_array['html']['body']['db'][$key][] = '
                                        <div class="col-md-6 '.$key.'column" style="display:none">
                                                <label class="form-label">Link</label>
                                                <input id="'.$key.'-widget-dashboard-link" class="dashboardLinks_s" name="parameters[link]['.$key.']" style="width:100%">
                                                </input>
                                          </div>

                                                     <div class="col-md-6 '.$key.'column" style="display:none">
                                                        <label class="form-label">Linking Column</label>
                                                        <div style="width:100%">
                                                          <input id="'.$key.'-widget-link-column" class="'.$key.'column_s" name="parameters[db]['.$key.'][widget_link_column]" style="width:100%" >
                                                          </input>
                                                        </div>
                                                      </div>
                                          ';
                    }

                    elseif ($entry['type']=='click_link')
                    {
                        $echo_array['html']['body']['db'][$key][] = '
                                        <div class="col-md-6 '.$key.'column" style="display:none">
                                                <label class="form-label">Link</label>
                                                <input id="'.$key.'-widget-dashboard-link" class="dashboardLinks_s" name="parameters[link]['.$key.']" style="width:100%">
                                                </input>
                                          </div>

                                                     <div class="col-md-6 '.$key.'column" style="display:none">
                                                        <label class="form-label">Linking Value</label>
                                                        <div style="width:100%">
                                                          <input class="form-control" name="parameters[parm]['.$key.'][widget_link]" style="width:100%" >
                                                          </input>
                                                        </div>
                                                      </div>
                                          ';
                    }

                    elseif($entry['type']== 'dashboard_link')
                    {
                        $echo_array['html']['body']['db'][$key][] = '
                                                <div class="col-md-12 '.$key.'column" style="display:none">
                                                        <label class="form-label">Target Dashboard</label>
                                                        <input class="dashboardList" style="width:100%" name="parameters[dashboard_link]['.$key.']">
                                                        </input>
                                                </div>

                                        <div class="col-md-6 '.$key.'dashboard_column" style="display:none">
                                                <label class="form-label">Target Dashboard Link</label>
                                                <input id="'.$key.'-widget-dashboard-link" class="dashboardLinks_rs" name="parameters[link]['.$key.']" style="width:100%">
                                                </input>
                                          </div>
                                                     <div class="col-md-6 '.$key.'dashboard_column" style="display:none">
                                                        <label class="form-label">Linking Column</label>
                                                        <div style="width:100%">
                                                          <input id="'.$key.'-widget-link-column" class="'.$key.'column_s" name="parameters[db]['.$key.'][widget_link_column]" style="width:100%" >
                                                          </input>
                                                        </div>
                                                      </div>
                                          ';

                    }

                }
                
                
                $echo_array['html']['body']['db'][$key][]  = '              
                                          </div>
                                          ';            
            }
            

            $echo_array['html']['body']['db']['update'] = '
           <h4>Update Links</h4>
           <div class="row form-row">
                  <div class="col-md-12">
                    <label class="form-label">Links</label>
                    <div style="width:100%">
                      <input multiple="multiple" class="dashboardLinks_sm" style="width:100%"></input>
                      <select id="widget-dashboard-link" multiple="multiple"  name="parameters[link][widget_update_links][]" style="width:100%; display: none;"></select>
                    </div>
                </div>
            </div>
            ';
            
        }
        
        
        
        // html part end
        
        
        
        
        
        // script part start
        
        $echo_array['script'][]='<script>';
        
        if( array_key_exists ( 'parm' , $struct))
        {
            $parms = $struct['parm'];
            foreach($parms as $parm)
            {
                if($parm['type']== 'input')
                {
                    

                }
                elseif($parm['type']== 'select')
                {
                    

                } 
                elseif($parm['type']== 'icon')
                {
                    
                    $echo_array['script']['parm']['icon']='$(".icp-auto").iconpicker();
                       ';

                } 
                
                elseif($parm['type']== 'table')
                {
                    
                    $echo_array['script']['parm']['table']=' 
                                                        $.getJSON("/widget/getDBTables", function(data){
                                                        $(".dbTable").select2({
                                                        placeholder: "Select a Table",
                                                        data:data
                                                        })
                                                        });
                       ';

                } 
                
            }

        }

        //body settings end
        
        //body database start
        
        if( array_key_exists ( 'db' , $struct))
        {
            
            $echo_array['script']['db'][]=' 
            $.getJSON("/widget/getDBTables", function(data){
                                                        $(".dbTable").select2({
                                                        placeholder: "Select a Table",
                                                        data:data
                                                        })
                                                        });
                                                    ';    
            
            $db_tables = $struct['db'];
            foreach($db_tables as $key=>$db_table)
            {
                $echo_array['script']['db'][$key][] ='$("#'.$key.'dbType").on("change", function (e){
             
                                                        var type_select=$( this ).val();
                                                        
                                                        if(type_select=="procedure")
                                                        {
                                                        
                                                        $.getJSON("/widget/getDBProcedures", function(data){
                                                        $(".dbTable").select2({
                                                        placeholder: "Select a Procedure",
                                                        data:data
                                                        })
                                                        });      
                                                        
                                                        }
                                                        else if (type_select=="table")
                                                        {
                                                        $.getJSON("/widget/getDBTables", function(data){
                                                        $(".dbTable").select2({
                                                        placeholder: "Select a Table",
                                                        data:data
                                                        })
                                                        });                                                 
                                                        }
                                                        });
                                                        ';

                
                $echo_array['script']['db'][$key][] ='$("#'.$key.'dbTable").on("change", function (e){
                                                        $(".'.$key.'column").show();
                                                        var db_table = e.val;
                                                        
                                                        var type = $("#'.$key.'dbType").val();
                                                        
                                                        var action;
                                                        
                                                        if (type=="procedure")
                                                        {
                                                        
                                                        action="getProcedureColumns";
                                                        
                                                        $.getJSON("/widget/getProcedureParameters/"+db_table, function(data){
                                                        if(data!="")
                                                        {
                                                        var parms_html=\'<h5>Procedure Parameter Links</h5><div class="row form-row" >\';
                                                        
                                                        $.each( data, function( key, value ) {
                                                        var str= \'<div class="col-md-6"><label class="form-label">\' + value.id + \'</label><input class="dashboardLinks_s" name="parameters[link]['.$key.'][\' + value.id + \']" style="width:100%"></input></div> \';
                                                        parms_html = parms_html + str;
                                                        });
                                                        
                                                        parms_html = parms_html + \'</div>\';
                                                        
                                                        $("#'.$key.'data_source_countainer").html(parms_html);
                                                        update_dashboard_links();
                                                        }
                                                        });
                                                        }
                                                        else if (type=="table")
                                                        {

                                                        action="getDBColumns";
                                                        
                                                        $("#'.$key.'data_source_countainer").html("");
                                                        
                                                        }
                                                        
                                                        $.getJSON("/widget/"+action+"/"+db_table, function(data){';
                
                foreach($db_table as $entry_key=>$entry)
                {
                    if($entry['type'] == 'single')
                    {
                        
                        $echo_array['script']['db'][$key]['single']='$(".'.$key.'column_s").select2({
                                                                                        placeholder: "Select a Column",
                                                                                        data:data
                                                                                        });
                                                                                        ';

                    }
                    elseif ($entry['type'] == 'multiple')
                    {
                        $echo_array['script']['db'][$key]['multiple']['head']='
                                 $(".'.$key.'column_sm").select2({
                                                                  placeholder: "Select Columns",
                                                                  data:data,
                                                                  multiple: true
                                                                  }).on("change", function (e){
                                                                  ';
                        
                        $echo_array['script']['db'][$key]['multiple'][$entry_key]='
                                data = e.val;
                                        
                                $("#'.$key.$entry['name'].'").empty();
                                                             
                                $.each(data , function(key, value) 
                                       {
                                         $("#'.$key.$entry['name'].'").append("<option value=" + data[key] + ">" + data[key] + "</option>");
                                       })
                                                            
                                $("#'.$key.$entry['name'].' option").prop("selected", true)
                                                                                                                       
                                 });
                                 ';

                    }
                    elseif ($entry['type']=='link')
                    {
                        $echo_array['script']['db'][$key]['single']='$(".'.$key.'column_s").select2({
                                                                                        placeholder: "Select a Column",
                                                                                        data:data
                                                                                        });
                                                                                        ';
                    }

                    elseif($entry['type']== 'dashboard_link')
                    {

                        $echo_array['script']['db'][$key]['dashboard_link']=' 
                                                        $.getJSON("/dashboard/getDashboards", function(data){
                                                        $(".dashboardList").select2({
                                                        placeholder: "Select a Table",
                                                        data:data
                                                        })
                                                        });

                                    $(".dashboardList").on("change", function (e){
                                        $(".'.$key.'dashboard_column").show();
                                        var type_select=$( this ).val();
                                       $.getJSON("/dashboard/getLinks/"+type_select, function(data_in){
                                        var data=[];
                                        $.each(data_in, function(i, item) {
                                        item=JSON.stringify(item);
                                                    var jsonObj =
                                                        {
                                                        "text":data_in[i].name,
                                                        "id": data_in[i].name
                                                        };
                                                        data.push(jsonObj);
                                            });
                
                                            $(".dashboardLinks_rs").select2({
                                                          placeholder: "Select Dashboard Linking Variable",
                                                          data:data
                                              });
                                                
                                            });
                                            
                                            });

                                            ';

                        $echo_array['script']['db'][$key]['single']='$(".'.$key.'column_s").select2({
                                                                                        placeholder: "Select a Column",
                                                                                        data:data
                                                                                        });
                                                                                        ';

                    } 
                }
                
                $echo_array['script']['db'][$key][] ='
                                   });
                                   });
                                   '; 
            }
            

            $echo_array['script']['db'][]= '
           function update_dashboard_links()
           {
           $.getJSON("/dashboard/getLinks/'.$dashboard_id.'", function(data_in){
                                        var data=[];
                                        $.each(data_in, function(i, item) {
                                        item=JSON.stringify(item);
                                                    var jsonObj =
                                                        {
                                                        "text":data_in[i].name,
                                                        "id": data_in[i].name
                                                        };
                                                        data.push(jsonObj);
                                            });
                
                                            $(".dashboardLinks_s").select2({
                                                          placeholder: "Select Dashboard Linking Variable",
                                                          data:data
                                              });
                                                
                                              $(".dashboardLinks_sm").select2({
                                                placeholder: "Select Dashboard Linking Variables",
                                                data:data,
                                                multiple: true
                                                }).on("change", function (e){
                                                 data = e.val;
                                         
                                                 $("#widget-dashboard-link").empty();
                                         
                                                 $.each(data, function(i, item) {
                  
                                                      $("#widget-dashboard-link").append("<option value="+ item +" >" + item + "</option>");
                                                    })

                                                $("#widget-dashboard-link option").prop("selected", true);
                                                 });
                                        
                                            });
                                            
                                            }
                                            
                                            update_dashboard_links();
                                            
                                            ';
            
        }
        
        $echo_array['script'][]='</script>';
        
        
        function echo_func($data)
        {
            foreach($data as $result)
            {
                if (is_array ($result))
                {
                    
                    echo_func($result);
                    
                }
                else
                
                {
                    echo $result;
                }
                
            }
            
        }
        
        
        echo_func($echo_array);
         
    } 


    public function StyleSheets()
    {
        $output=array();
        $output[]= '<link href="/assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>';
        $output[]= '<link href="/assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" media="screen"/>';
        $output[]= '<link href="/assets/plugins/icon-picker/css/fontawesome-iconpicker.min.css" rel="stylesheet">';

        return implode('\r\n',$output);
    }


    public function JavaScript()
    {
        $output=array();
        $output[]= '<script src="/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>';
        $output[]= '<script src="/assets/plugins/select2/js/select2.js" type="text/javascript"></script>';
        $output[]= '<script src="/assets/plugins/icon-picker/js/fontawesome-iconpicker.js"></script>';

        return implode('\r\n',$output);
    }
    
}
