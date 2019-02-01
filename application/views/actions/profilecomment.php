<?php
if($newcomments==='on'&&$allcomments==='on'){
if($this->Functions->isLoged()){
	?>
		<?php if($this->session->flashdata('error')){
		?>	
		<div class="alert alert-danger alert-dismissible fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Danger!</strong> <?php echo $this->session->flashdata('error'); ?>
	</div>
	<?php
		}	
		$this->session->unmark_flash('error');
	?>
	<?php echo form_open('action/postcom'); ?>
	<div class="form-group">
    <label style="padding-top: 15px">Comment</label>
    <?= form_textarea(array('name' => 'comment','id' => 'comment', 'maxlength' => '', 'minlength' => '', 'type' => 'email', 'style' => 'height: 100px !important;resize: vertical;'), '', array('class'=>'form-control', 'placeholder'=>'Text', 'data-validation'=>'required alphanumeric')); ?>
    	<?=  form_input(array('name' => 'id','id' => 'id', 'maxlength' => '', 'minlength' => '', 'type' => 'hidden', 'style' => '', 'value' => $id), '', array('class'=>'form-control', 'placeholder'=>'', 'data-validation'=>'')); ?>
	</div>
	<button value="submit" role="submit" class="btn btn-primary">Comment</button>
<?php
}else{
?>
<h2>Login to post comments.</h2>

<?php
}
}else{
?>
	<h2>This user has disabled new comments.</h2>
<?php	
}
?>




