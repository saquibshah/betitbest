<?php
	
$this->load->helper('form_helper');
	
?>
<?php echo form_open('backend/language/add_string') ?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">String hinzufügen</h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">		 

			 	<div class="form-body">

			       <div class="form-group">
			             <label>Identifier</label>
			             <input type="text" name="identifier" class="form-control input" id="insert_language_identifier" />
			       </div>
			   
			       <div class="form-group">
			             <label>Wert</label>
			             <input type="text" name="value" class="form-control input" id="insert_language_value" />
			       </div>
				   
				   <input type="hidden" name="language_uid" id="insert_language_language_uid" value="<?= $language_uid ?>" />

			   </div>

			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn default" data-dismiss="modal">Schließen</button>
		<button type="submit" class="btn blue" id="saveLanguageString">Speichern</button>
	</div>
</form>