<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('session');?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_record');?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------>

        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                    <tr>
                        <th><div>#</div></th>
                        <th><div><?php echo get_phrase('year');?></div></th>
                        <th><div><?php echo get_phrase('session_name');?></div></th>
                        <th><div><?php echo get_phrase('admission_duration');?></div></th>
                        <th><div><?php echo get_phrase('class_commencement');?></div></th>
                        <th><div><?php echo get_phrase('semester_duration');?></div></th>
                        <th><div><?php echo get_phrase('options');?></div></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1;foreach($acdSession as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php
                                //echo $row['Year'];
                                $this->db->where('id', $row['Year']);
                                $aas = $this->db->get('year_calendar')->result_array();
                                foreach($aas as $r334):
                                    echo $r334['Name'];
                                endforeach;
                                ?>
                                </td>
                            <td><?php echo $row['SessionName'];?></td>
                            <td><?php echo $row['AdmissionDuration'];?></td>
                            <td><?php echo $row['ClassCommencement'];?></td>
                            <td><?php echo $row['SemesterDuration'];?></td>
                            <td>
                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_session_pundro/<?php echo $row['id'];?>');">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit');?>
                                </a>
                                &nbsp;  &nbsp;  &nbsp;
                                <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/session_pundro/delete/<?php echo $row['id'];?>');">
                                    <i class="entypo-trash"></i>
                                    <?php echo get_phrase('delete');?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?admin/session_pundro/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('session_name');?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="SessionName"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('admission_duration');?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="AdmissionDuration"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('class_commencement');?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="ClassCommencement"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('semester_duration');?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="SemesterDuration"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('year');?></label>
                            <div class="col-sm-5">
                                <select name="Year" class="form-control">
                                    <option value=""><?php echo get_phrase('select');?></option>
                                    <?php
                                    $yy = $this->db->get('year_calendar')->result_array();
                                    foreach($yy as $rowyy):
                                        ?>
                                        <option value="<?php echo $rowyy['id'];?>">
                                            <?php echo $rowyy['Name'];?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('add_session');?></button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!----CREATION FORM ENDS-->
            </div>
        </div>
    </div>



    <!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
    <script type="text/javascript">

        jQuery(document).ready(function($)
        {


            var datatable = $("#table_export").dataTable({

                //"sPaginationType": "full_numbers",
                //"lengthMenu": [ 10, 25, 50, 75, 100 ],
                /*"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
                 "pageLength" : 25,*/
                /*"aLengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],*/
                "aLengthMenu": [ [30, 50, 100, 200, 500, 1000, 2000, 3000,  -1], [30, 50, 100, 200, 500, 1000, 2000, 3000, "All"] ],
                "iDisplayLength" : 30,
                /*"aLengthMenu": "bootstrap",*/
                //"iDisplayLength": "500",
                "paging": "false",
                //"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
                "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
                "oTableTools": {
                    "aButtons": [

                        {
                            "sExtends": "xls",
                            "mColumns": [1,2]
                        },
                        {
                            "sExtends": "pdf",
                            "mColumns": [1,2]
                        },
                        {
                            "sExtends": "print",
                            "fnSetText"	   : "Press 'esc' to return",
                            "fnClick": function (nButton, oConfig) {
                                datatable.fnSetColumnVis(0, false);
                                datatable.fnSetColumnVis(3, false);

                                this.fnPrint( true, oConfig );

                                window.print();

                                $(window).keyup(function(e) {
                                    if (e.which == 27) {
                                        datatable.fnSetColumnVis(0, true);
                                        datatable.fnSetColumnVis(3, true);
                                    }
                                });
                            },

                        },
                    ]
                },

            });

            $(".dataTables_wrapper select").select2({
                minimumResultsForSearch: -1
            });
        });

    </script>