<h2>Assignment</h2>
<div id="assignment-options" data-assignment-id="<?php echo $assignment['id'] ?>">
	<h3>Status</h3>
	<select name="status">
	<?php foreach(array('Pending','Client Review','Complete') as $status): ?>
		<option<?php echo ($status==$assignment['status'] ? ' selected="selected"' : '') ?>><?php echo $status ?></option>
	<?php endforeach; ?>
	</select>
	<br /><br />
	<a class="change_status button">Change Status</a>
	
	<h3>Tech Assigned</h3>
	<?php if($this->user->has_role('admin')): ?>
		<?php foreach($techs as $tech): ?>
		<input type="radio" name="tech_assigned" value="<?php echo $tech['id'] ?>"<?php echo ($assignment['tech_user_id']==$tech['id'] ? ' checked="checked"' : '') ?> /><label for="tech_<?php echo $tech['id'] ?>"><?php echo trim($tech['first_name'].' '.$tech['last_name']) ?></label><br />
		<?php endforeach; ?>
		<br />
		<a class="assign_tech button">Assign Tech</a>
		<?php if(!empty($assignment['tech_user_id'])): ?>
			<br /><a class="button" href="/assignments/send_reminder/<?php echo $assignment['id'] ?>">Send Reminder to Tech</a>
		<?php endif; ?>
	<?php elseif($this->user->has_role('tech')): ?>
		<?php $assigned_tech=$this->user->get($assignment['tech_user_id']) ?>
		<?php echo $assigned_tech['first_name'].' '.$assigned_tech['last_name'] ?>
	<?php endif; ?>
	
	<?php if($assignment['status']=='Complete'): ?>
		<h3>Final Report</h3>
		<a class="button" href="/reports/<?php echo $assignment['id'] ?>" target="_blank">View Final Report</a>
	<?php endif; ?>
</div>
<div id="tabs">
	<ul>
		<li><a href="#details">Details</a></li>
		<li><a href="#vehicles">Vehicles</a></li>
		<li><a href="#claimants">Claimants</a></li>
		<li><a href="#attachments">Attachments</a></li>
		<li><a href="#correspondence">Correspondence</a></li>
		<li><a href="#findings">Findings</a></li>
	</ul>
	<div id="details">
		<h2>Assignment Details</h2>
		<div class="readonly horizontal field">
			<?php echo form_label('Claim Type:') ?>
			<?php echo $this->assignment->get_type($assignment['type']) ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('File Number:') ?>
			<?php echo $assignment['file_number'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Date of Loss:') ?>
			<?php echo $assignment['date_of_loss_displayed'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Insured Name:') ?>
			<?php echo $assignment['insured_name'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Loss Description:') ?>
			<?php echo $assignment['loss_description'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Services Requested:') ?>
			<?php echo $assignment['services_requested'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Loss Location:') ?>
			<?php echo $assignment['loss_location'] ?>
		</div>
		<?php foreach($assignment['answers'] as $answer): ?>
			<div class="readonly horizontal field">
				<?php echo form_label('Type:') ?>
				<?php echo $answer['answer'] ?>
			</div>
		<?php endforeach; ?>
		<h2>Representative Information</h2>
		<div class="readonly horizontal field">
			<?php echo form_label('Name:') ?>
			<?php echo $assignment['rep']['first_name'].' '.$assignment['rep']['last_name'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Company:') ?>
			<?php echo $assignment['rep']['company_name'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('E-mail:') ?>
			<?php echo $assignment['rep']['email'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Address:') ?>
			<?php echo $assignment['rep']['street_address'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('City:') ?>
			<?php echo $assignment['rep']['city'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('State:') ?>
			<?php echo $assignment['rep']['state'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Zip:') ?>
			<?php echo $assignment['rep']['zip'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Phone:') ?>
			<?php echo $assignment['rep']['phone'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Mobile:') ?>
			<?php echo $assignment['rep']['mobile'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Fax:') ?>
			<?php echo $assignment['rep']['fax'] ?>
		</div>
	</div>
	<?php
		$vehicles=array();
		$claimants=array();
		foreach($assignment['vehicles'] as $vehicle)
		{
			if($vehicle['type']=='vehicle')
				$vehicles[]=$vehicle;
			elseif($vehicle['type']=='claimant')
				$claimants[]=$vehicle;
		}
	?>
	<div id="vehicles">
		<?php if(count($vehicles)==0): ?>
			<p>There are no vehicles.</p>
		<?php else: ?>
			<?php $i=1 ?>
			<?php foreach($vehicles as $vehicle): ?>
				<h2>Vehicle #<?php echo $i++ ?></h2>
				<div class="readonly horizontal field">
					<?php echo form_label('VIN Number:') ?>
					<?php echo $vehicle['vin_number'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Year:') ?>
					<?php echo $vehicle['year'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Make:') ?>
					<?php echo $this->assignment->get_make($vehicle['make']) ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Model:') ?>
					<?php echo $vehicle['model'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Operator:') ?>
					<?php echo $vehicle['operator'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Color:') ?>
					<?php echo $vehicle['color'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Registration Number:') ?>
					<?php echo $vehicle['registration_number'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Additional Info:') ?>
					<?php echo $vehicle['additional_info'] ?>
				</div>
				<?php $vehicle_answers=$this->vehicle_answer->get_many_by('vehicle_id',$vehicle['id']) ?>
				<?php foreach($vehicle_answers as $answer): ?>
					<div class="readonly horizontal field">
						<?php echo form_label($answer['question'].':') ?>
						<?php echo $answer['answer'] ?>
					</div>
				<?php endforeach; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<div id="claimants">
		<?php if(count($claimants)==0): ?>
			<p>There are no claimants.</p>
		<?php else: ?>
			<?php $i=1 ?>
			<?php foreach($claimants as $vehicle): ?>
				<h2>Claimant #<?php echo $i++ ?></h2>
				<div class="readonly horizontal field">
					<?php echo form_label('Claimant Name:') ?>
					<?php echo $vehicle['claimant_name'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('VIN Number:') ?>
					<?php echo $vehicle['vin_number'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Year:') ?>
					<?php echo $vehicle['year'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Make:') ?>
					<?php echo $this->assignment->get_make($vehicle['make']) ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Model:') ?>
					<?php echo $vehicle['model'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Operator:') ?>
					<?php echo $vehicle['operator'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Color:') ?>
					<?php echo $vehicle['color'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Registration Number:') ?>
					<?php echo $vehicle['registration_number'] ?>
				</div>
				<div class="readonly horizontal field">
					<?php echo form_label('Additional Info:') ?>
					<?php echo $vehicle['additional_info'] ?>
				</div>
				<?php $vehicle_answers=$this->vehicle_answer->get_many_by('vehicle_id',$vehicle['id']) ?>
				<?php foreach($vehicle_answers as $answer): ?>
					<div class="readonly horizontal field">
						<?php echo form_label($answer['question'].':') ?>
						<?php echo $answer['answer'] ?>
					</div>
				<?php endforeach; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<div id="attachments">
		<?php if(empty($photo_attachments) && empty($other_attachments)): ?>
			<p>There are no attachments with this assignment.</p>
		<?php else: ?>
			<?php if(!empty($photo_attachments)): ?>
				<h2>Photo Attachments</h2>
				<?php foreach($photo_attachments as $photo): ?>
				<div class="attachment">
					<a class="image" rel="attachments" href="//accidentreview.com/uploads/<?php echo $photo['url'] ?>" title="<?php echo htmlentities($photo['description'],ENT_QUOTES) ?>"><img src="//accidentreview.com/uploads/<?php echo $photo['url'] ?>" /></a>
					<div class="details">
						<?php echo $photo['description'] ?>
						<div class="name"><?php echo $photo['name'] ?></div>
					</div>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if(!empty($other_attachments)): ?>
				<h2>Other Attachments</h2>
				<?php foreach($other_attachments as $attachment): ?>
					<a href="//accidentreview.com/uploads/<?php echo $attachment['url'] ?>" target="_blank"><?php echo $attachment['name'] ?></a><?php echo ( empty($attachment['description']) || $attachment['name']==$attachment['description'] ? '' : ' - '.$attachment['description'] ) ?><br /><br />
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<div id="correspondence">
	<?php if(empty($assignment['correspondence'])): ?>
		<p>There is no correspondence to show.</p>
	<?php else: ?>
		<?php foreach($assignment['correspondence'] as $message): ?>
			<?php $message['from_user']=$this->user->get($message['from_user_id']) ?>
			<div class="<?php echo $message['from_user_id']==$assignment['client_user_id'] ? 'assignment-owner ' : '' ?>correspondence">
				<div class="user-details">
					<div class="from">From:</div>
					<div class="name"><?php echo $message['from_user']['first_name'].' '.$message['from_user']['last_name'] ?></div>
					<div class="email"><?php echo $message['from_user']['email'] ?></div>
					<div class="role"><?php echo ucfirst($message['from_user']['role']) ?></div>
					<div class="timestamp"><?php echo date('m/d/Y h:ia',strtotime($message['created_at'])) ?></div>
				</div>
				<div class="message"><?php echo nl2br($message['message']) ?></div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
		<h2>Create New Message</h2>
		<?php echo form_open('assignments/create_message','',array(
			'assignment_id'=>$assignment['id'],
		)) ?>
			<div class="readonly field">
				<?php echo form_label('From:') ?>
				<?php echo $user['first_name'].' '.$user['last_name']; ?>
			</div>
			<div class="readonly field c1">
				<?php echo form_label('Message:','message') ?>
				<?php echo form_textarea(array(
					'class'=>'message',
					'name'=>'message',
					'value'=>set_value('message'),
					'style'=>'width:610px',
				)) ?>
			</div>
			<?/*
			<div class="checkbox field">
				<?= form_checkbox(array(
					'id'=>'change_status',
					'name'=>'change_status',
					'value'=>1,
					'checked'=>set_value('change_status')==1,
				)) ?>
				<?php echo form_label('Change the status of the assignment to "Client Review"','change_status') ?>
			</div>
			*/?>
			<div class="buttons">
				<?php echo form_submit('create_message','Create Message') ?>
			</div>
		</form>
	</div>
	<div id="findings">
		<h2>Findings</h2>
		<p>Write up your findings in the word processor below. They will not be sent to the client until you are ready.</p>
		<?php if(!empty($final_report_versions)): ?>
			<div id="findings-version">
				Version: <?php echo form_dropdown('findings_version',$final_report_versions,$version) ?>
			</div>
		<?php endif; ?>
		<?php echo form_open('assignments/save_final_report','',array(
			'assignment_id'=>$assignment['id'],
		)) ?>
			<textarea id="final-report-editor" name="final_report" style="width: 100%; height: 200px;"><?php echo $assignment['final_report'] ?></textarea>
			<div class="checkbox field">
				<?php echo form_checkbox(array(
					'id'=>'assignment_completed',
					'name'=>'assignment_completed',
					'value'=>1,
					'checked'=>set_value('assignment_completed')==1,
				)) ?>
				<?php echo form_label('Change the status of the assignment to "Complete" and send an e-mail to the representative','assignment_completed') ?>
			</div>
			<div class="buttons">
				<?php echo form_submit('save_report','Save Report') ?>
			</div>
		</form>
	</div>
</div>
<script>
	activeTab=<?php echo empty($tab) ? 0 : $tab ?>
</script>