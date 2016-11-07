<?php 
$edit_data		=	$this->db->get_where('training_and_camps' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_training_and_camps');?>
            	</div>
            </div>
			<div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?admin/training_and_camps/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('from_date');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="datepicker form-control" name="strt_dt" value="<?php echo $row['strt_dt'];?>"/>
                        </div>
                    </div>

                        <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('to_date');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="end_dt" value="<?php echo $row['end_dt'];?>"/>
                        </div>
                    </div>
                <!--<div class="form-group">
                    <label class="col-sm-3 control-label"><?php /*echo get_phrase('note');*/?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="is_open" value="<?php /*echo $row['is_open'];*/?>" />
                    </div>
                </div>-->
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_training_and_camps');?></button>
						</div>
					</div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>


