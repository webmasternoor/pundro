<hr />
	<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
    	<thead>
        	<tr>
            	<th><?php echo get_phrase('select_date');?></th>
            	<th><?php echo get_phrase('select_month');?></th>
            	<th><?php echo get_phrase('select_year');?></th>
            	<th><?php echo get_phrase('select_batch');?></th>
            	<th><?php echo get_phrase('action');?></th>
           </tr>
       </thead>
		<tbody>
        	<form method="post" action="<?php echo base_url();?>index.php?admin/attendance_selector" class="form">
            	<tr class="gradeA">
                    <td>
                    	<select name="date" class="form-control">
                        	<?php for($i=1;$i<=31;$i++):?>
                            	<option value="<?php echo $i;?>"
                                	<?php if(isset($date) && $date==$i)echo 'selected="selected"';?>>
										<?php echo $i;?>
                                        	</option>
                            <?php endfor;?>
                        </select>
                    </td>
                    <td>
                    	<select name="month" class="form-control">
                        	<?php
							for($i=1;$i<=12;$i++):
								if($i==1)$m='january';
								else if($i==2)$m='february';
								else if($i==3)$m='march';
								else if($i==4)$m='april';
								else if($i==5)$m='may';
								else if($i==6)$m='june';
								else if($i==7)$m='july';
								else if($i==8)$m='august';
								else if($i==9)$m='september';
								else if($i==10)$m='october';
								else if($i==11)$m='november';
								else if($i==12)$m='december';
							?>
                            	<option value="<?php echo $i;?>"
                                	<?php if($month==$i)echo 'selected="selected"';?>>
										<?php echo $m;?>
                                        	</option>
                            <?php
							endfor;
							?>
                        </select>
                    </td>
                    <td>
                    	<select name="year" class="form-control">
                        	<?php for($i=2020;$i>=2010;$i--):?>
                            	<option value="<?php echo $i;?>"
                                	<?php if(isset($year) && $year==$i)echo 'selected="selected"';?>>
										<?php echo $i;?>
                                        	</option>
                            <?php endfor;?>
                        </select>
                    </td>
                    <td>
                    	<select name="class_id" class="form-control">
                        	<option value="">Select a Batch</option>
                        	<?php 
							$classes	=	$this->db->get('batch')->result_array();
							foreach($classes as $row):?>
                        	<option value="<?php echo $row['id'];?>"
                            	<?php if(isset($class_id) && $class_id==$row['id'])echo 'selected="selected"';?>>
									<?php echo $row['batch_alias'];?>
                              			</option>
                            <?php endforeach;?>
                        </select>

                    </td>
                    <td align="center"><input type="submit" value="<?php echo get_phrase('select');?>" class="btn btn-info"/></td>
                </tr>
            </form>
		</tbody>
	</table>
<hr />



<?php if($date!='' && $month!='' && $year!='' && $class_id!=''):?>

<center>
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="tile-stats tile-white-gray">
                <div class="icon"><i class="entypo-suitcase"></i></div>
                <?php
                    $full_date	=	$year.'-'.$month.'-'.$date;
                    $timestamp  = strtotime($full_date);
                    $day        = strtolower(date('l', $timestamp));
                 ?>
                <h3>Program Name:
                <?php
                $this->db->distinct();
                $this->db->select('NameofProgram');
                $students21   =   $this->db->get_where('student_pundro' , array('NameofBatch'=>$class_id))->result_array();
                foreach($students21 as $row21):?>
                        <?php
                    //echo $row21['NameofProgram'];
                    $this->db->where('id', $row21['NameofProgram']);
                    $as = $this->db->get('course_program')->result_array();
                    foreach($as as $row334):
                        echo $row334['course_name'];
                    endforeach;
                    ?>
                <?php endforeach;?>
                </h3>
                <h3>Batch Name:
                <?php
                $this->db->select('batch_alias');
                $s21   =   $this->db->get_where('batch' , array('id'=>$class_id))->result_array();
                foreach($s21 as $r21):?>
                    <?php
                    echo $r21['batch_alias'];
                    ?>
                <?php endforeach;?>
                </h3>
                <p><?php echo $date.'-'.$month.'-'.$year;?></p>
            </div>
            <a href="#" id="update_attendance_button" onclick="return update_attendance()" 
                class="btn btn-info">
                    Update Attendance
            </a>
        </div>

    </div>
</center>
<hr />
<div class="row" id="attendance_list">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td><?php echo get_phrase('program_name');?></td>
                <td><?php echo get_phrase('batch_name');?></td>
                <td><?php echo get_phrase('course_name');?></td>
                <td><?php echo get_phrase('course_instructor');?></td>
                <td><?php echo get_phrase('duration');?></td>
            </tr>
            </thead>
            <tbody>

            <?php
            $this->db->limit(1);
            $studentsd   =   $this->db->get_where('student_pundro' , array('NameofBatch'=>$class_id))->result_array();
            foreach($studentsd as $rowd):?>
                <tr class="gradeA">
                    <?php
                    $verify_data    =   array(  'student_id' => $rowd['id'],
                        'date' => $full_date);

                    $query = $this->db->get_where('attendance' , $verify_data);
                    if($query->num_rows() < 1)
                        $this->db->insert('attendance' , $verify_data);

                    //showing the attendance status editing option
                    $attendance = $this->db->get_where('attendance' , $verify_data)->row();
                    $status     = $attendance->status;
                    ?>
                    <td align="center"><?php
                        $ProgramName     = $attendance->ProgramName;
                        $this->db->where('id', $ProgramName);
                        $as1 = $this->db->get('course_program')->result_array();
                        foreach($as1 as $row34):
                            echo $row34['course_name'];
                        endforeach;
                        ?></td>
                    <td align="center"><?php
                        $BatchName     = $attendance->BatchName;
                        $this->db->where('id', $BatchName);
                        $as2 = $this->db->get('batch')->result_array();
                        foreach($as2 as $row4):
                            echo $row4['batch_alias'];
                        endforeach;
                        ?></td>
                    <td align="center"><?php
                        $CourseName     = $attendance->CourseName;
                        $this->db->where('id', $CourseName);
                        $as3 = $this->db->get('subjects')->result_array();
                        foreach($as3 as $row33):
                            echo $row33['CourseName'];
                        endforeach;
                        ?></td>
                    <td align="center"><?php
                        $CourseInstructor     = $attendance->CourseInstructor;
                        $this->db->where('id', $CourseInstructor);
                        $as32 = $this->db->get('course_instructor')->result_array();
                        foreach($as32 as $row323):
                            echo $row323['InstructorName'];
                        endforeach;
                        ?></td>
                    <td align="center"><?php echo $Duration     = $attendance->Duration." Hours";?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-offset-3 col-md-6">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td><?php echo get_phrase('roll');?></td>
                    <td><?php echo get_phrase('name');?></td>
                    <td><?php echo get_phrase('status');?></td>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $students   =   $this->db->get_where('student_pundro' , array('NameofBatch'=>$class_id))->result_array();
                        foreach($students as $row):?>
                        <tr class="gradeA">
                            <td><?php echo $row['ClassRollNo'];?></td>
                            <td><?php echo $row['NameofApplicant'];?></td>
                            <?php
                                //inserting blank data for students attendance if unavailable
                                $verify_data    =   array(  'student_id' => $row['id'],
                                                            'date' => $full_date);
                                $query = $this->db->get_where('attendance' , $verify_data);
                                if($query->num_rows() < 1)
                                $this->db->insert('attendance' , $verify_data);
                                
                                //showing the attendance status editing option
                                $attendance = $this->db->get_where('attendance' , $verify_data)->row();
                                $status     = $attendance->status;
                            ?>
                        <?php if ($status == 1):?>
                            <td align="center">
                              <span class="badge badge-success"><?php echo get_phrase('present');?></span>  
                            </td>
                        <?php endif;?>
                        <?php if ($status == 2):?>
                            <td align="center">
                              <span class="badge badge-danger"><?php echo get_phrase('absent');?></span>  
                            </td>
                        <?php endif;?>
                            <?php if ($status == 3):?>
                                <td align="center">
                                    <span class="badge badge-danger"><?php echo get_phrase('late');?></span>
                                </td>
                            <?php endif;?>
                        <?php if ($status == 0):?>
                            <td></td>
                        <?php endif;?>
                        </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>




<div class="row" id="update_attendance">

<!-- STUDENT's attendance submission form here -->
<form method="post" 
    action="<?php echo base_url();?>index.php?admin/manage_attendance/<?php echo $date.'/'.$month.'/'.$year.'/'.$class_id;?>">
    <div class="col-sm-offset-3 col-md-6">
        <input type="hidden" name="ProgramName" value="<?php echo $row334['id'];?>">
        <div class="col-md-3">
            <select name="CourseInstructor" class="form-control">
                <option value=""><?php echo get_phrase('select_instructor');?></option>
                <?php
                $ds = $this->db->get('course_instructor')->result_array();
                foreach($ds as $rowds):
                    ?>
                    <option value="<?php echo $rowds['id'];?>">
                        <?php echo $rowds['InstructorName']." (".$rowds['id'].")";?>
                    </option>
                    <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="CourseName" class="form-control">
                <option value=""><?php echo get_phrase('select_course');?></option>
                <?php
                $ds2 = $this->db->get('subjects')->result_array();
                foreach($ds2 as $rowd2s):
                    ?>
                    <option value="<?php echo $rowd2s['id'];?>">
                        <?php echo $rowd2s['CourseCode']." (".$rowd2s['CourseName'].")";?>
                    </option>
                    <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="StartTime" placeholder="Start Time" />
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="EndTime" placeholder="End Time" />
        </div>
    </div>
    <div class="col-md-12 clearboth">
            <table  class="table table-bordered">
        		<thead>
        			<tr class="gradeA">
                    	<th><?php echo get_phrase('Roll');?></th>
                    	<th><?php echo get_phrase('Name');?></th>
                    	<th><input type="text" class="datepicker form-control" name="Date1" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date2" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date3" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date4" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date5" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date6" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date7" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date8" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date9" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date10" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date11" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date12" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date13" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date14" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date15" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date16" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date17" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date18" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date19" placeholder="Date" /></th>
                    	<th><input type="text" class="datepicker form-control" name="Date20" placeholder="Date" /></th>
                        <th>Number of class attendance</th>
                        <th>Marks obtain in class attendance</th>
        			</tr>
                </thead>
                <tbody>
                		
                	<?php 
        			//STUDENTS ATTENDANCE
        			$students	=	$this->db->get_where('student_pundro' , array('NameofBatch'=>$class_id))->result_array();
        				
        			foreach($students as $row)
        			{
        				?>
        				<tr class="gradeA tr">
        					<td><?php echo $row['ClassRollNo'];?></td>
        					<td><div class="stdname"><?php echo $row['NameofApplicant'];?></div></td>
        					<td align="center">
                                <select name="status1" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status2" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status3" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status4" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status5" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status6" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status7" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status8" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status9" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status10" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status11" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status12" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status13" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status14" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status15" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status16" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status17" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status18" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status19" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="status20" class="form-control">
                                    <option value="#"></option>
                                    <option value="1">P</option>
                                    <option value="2">A</option>
                                    <option value="3">L</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="NofClassAttn">
                            </td>
                            <td>
                                <input type="text" name="MObtClassAttn">
                            </td>
        				</tr>
        				<?php 
        			}
        			?>
                    <tr>
                        <td>&nbsp;</td>
                        <td><div class="stdname">&nbsp;</div></td>
                        <td align="center">
                            <form method="post" action="<?php echo base_url();?>index.php?admin/manage_attendance/<?php echo $date.'/'.$month.'/'.$year.'/'.$class_id;?>">
                                <input type="submit" class="btn btn-info" value="save">
                            </form>
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td align="center">
                            <input type="submit" class="btn btn-info" value="save">
                        </td>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="date" value="<?php echo $full_date;?>" />
            <!--<center>
                <input type="submit" class="btn btn-info" value="save">
            </center>-->
        </div>
</form>
</div>
<?php endif;?>
<script type="text/javascript">

    $("#update_attendance").hide();

    function update_attendance() {

        $("#attendance_list").hide();
        $("#update_attendance_button").hide();
        $("#update_attendance").show();

    }
</script>