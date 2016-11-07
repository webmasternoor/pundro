<div class="row">
	<div class="head_block col-md-12 col-sm-12 clearfix" style="text-align:center;">
		<div class="col-md-1">
			<div class="logo" style="margin:5px 0;">
	            <a href="<?php echo base_url(); ?>">
	                <img src="uploads/logopundro.jpg"  style="max-height:60px;"/>
	            </a>
	        </div>
		</div>
		<div class="col-md-6">
			<h2 class="system_name_head"><?php echo $system_name;?></h2>
			<h3 class="system_name_sub_head">Management Information System (MIS)</h3>	
		</div>
		<div class="col-md-2 social_links">
			<!--<a href="<?php /*echo base_url(); */?>">
	            <img src="uploads/social_links/fb.png"/>
	        </a>
	        <a href="<?php /*echo base_url(); */?>">
	            <img src="uploads/social_links/tt.png"/>
	        </a>
	        <a href="<?php /*echo base_url(); */?>">
	            <img src="uploads/social_links/linkedin.png"/>
	        </a>-->
		</div>
		<div class="col-md-3">
		<div class="col-md-12 col-sm-12 clearfix user_settings">
		
        <ul class="list-inline links-list pull-left">
        <!-- Language Selector -->			
           <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        	<?php
                        	if($this->session->userdata('login_type') == 'admin'){
	                        	$user_photo = $this->db->get('admin')->result_array();
	                        	foreach($user_photo as $ee):
	                        	?>
	                        	<img src="<?php echo "uploads/".$ee[photo]; ?>" width="73" height="73" />
	                        	<?php	
	                        	endforeach;
	                        }
                        	?>
                        	<?php 
								if($this->session->userdata('login_type') == 'student'){
								   	//$this->session->userdata('id');
								   	$this->db->where('id', $this->session->userdata('id'));
								   	$user_photo12 = $this->db->get('student_pundro')->result_array();
		                        	foreach($user_photo12 as $ee12):
		                        	?>
		                        	<img src="<?php echo "uploads/student_image/".$ee12[PhotoApplicant]; ?>" width="73" height="73" />
		                        	<?php	
		                        	endforeach;
								}
                        	?>
                        	<?php echo $this->session->userdata('login_type');?>
                    </a>

				<?php if ($account_type != 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
				</ul>
				<?php endif;?>
				<?php if ($account_type == 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo base_url();?>index.php?parents/manage_profile">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>index.php?parents/manage_profile">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
				</ul>
				<?php endif;?>
			</li>
        </ul>
        
        
		<ul class="list-inline links-list pull-right">
			
			<!-- Language Selector 			
           <li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        <i class="entypo-globe"></i> language
                    </a>
				
				<ul class="dropdown-menu <?php if ($text_align == 'left-to-right') echo 'pull-left'; else echo 'pull-right';?>">
					<?php
                            $fields = $this->db->list_fields('language');
                            foreach ($fields as $field)
                            {
                                if($field == 'phrase_id' || $field == 'phrase')continue;
                                ?>
                                    <li class="<?php if($this->session->userdata('current_language') == $field)echo 'active';?>">
                                        <a href="<?php echo base_url();?>index.php?multilanguage/select_language/<?php echo $field;?>">
                                            <img src="assets/images/flag/<?php echo $field;?>.png" style="width:16px; height:16px;" />	
												 <span><?php echo $field;?></span>
                                        </a>
                                    </li>
                                <?php
                            }
                            ?>
                    
				</ul>
				
			</li>
			-->
			<!--<li class="sep"></li>-->
			
			<li>
				<a href="<?php echo base_url();?>index.php?login/logout">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
	</div>
		</div>
    </div>

	<!-- Raw Links -->
</div>

<hr style="margin-top:0px;" />