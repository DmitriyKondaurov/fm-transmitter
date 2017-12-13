
jQuery(document).ready(function(){



/*if the tag generator panel exists on page load, */
if(jQuery('.tag-generator-panel')){
	jQuery('.inbound-cf7-list-select').select2();

	var editorContent, 
		selectOptions,
		mappableFields,
		mappedFields = [],
		tagGeneratorPanel = jQuery('.tag-generator-panel'),
		markerTags = ['text','email','url','tel','number','date','checkbox','radio','select']; /*buttons to add inbound mapping to*/


	var mappableFieldsFallback = {	'No Mapping' : '', 'First Name' : 'wpleads_first_name', 'Last Name' : 'wpleads_last_name',
							'Email' : 'wpleads_email_address', 'Website' : 'wpleads_website', 'Job Title' : 'wpleads_job_title',
							'Company Name' : 'wpleads_company_name', 'Mobile Phone' : 'wpleads_mobile_phone', 
							'Work Phone' : 'wpleads_work_phone', 'Address' : 'wpleads_address_line_1', 
							'Address Continued' : 'wpleads_address_line_2', 'City' : 'wpleads_city', 'State/Region' : 'wpleads_region_name',
							'Zip-code' : 'wpleads_zip', 'Country' : 'wpleads_country_code', 'Billing First Name' : 'wpleads_billing_first_name',
							'Billing Last Name' : 'wpleads_billing_last_name', 'Billing Company' : 'wpleads_billing_company_name',
							'Billing Address' : 'wpleads_billing_address_line_1', 'Billing Address Continued' : 'wpleads_billing_address_line_2',
							'Billing City' : 'wpleads_billing_city', 'Billing State/Region' : 'wpleads_billing_region_name',
							'Billing Zip-code' : 'wpleads_billing_zip',  'Billing Country' : 'wpleads_billing_country_code',
							'Shipping First Name' : 'wpleads_shipping_first_name', 'Shipping Last Name' : 'wpleads_shipping_last_name',
							'Shipping Company Name' : 'wpleads_shipping_company_name', 'Shipping Address' : 'wpleads_shipping_address_line_1',
							'Shipping Address Continued' : 'wpleads_shipping_address_line_2', 'Shipping City' : 'wpleads_shipping_city',
							'Shipping State/Region' : 'wpleads_shipping_region_name', 'Shipping Zip-code' : 'wpleads_shipping_zip',
							'Shipping Country' : 'wpleads_shipping_country_code', 'Related Websites' : 'wpleads_websites', 'Notes' : 'wpleads_notes',
							'Twitter Account' : 'wpleads_social_twitter', 'Youtube Account' : 'wpleads_social_youtube', 'Facebook Account' : 'wpleads_social_facebook',};

/*get the lead fields and give the functions their initial calls*/
	jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'inbound_cf7_get_lead_fields',
				},
			success: function(response){
						mappableFields = JSON.parse(response);
//						console.log(mappableFields);
						createMapOptions();
						buildInboundFieldDropdown();
						onDropdownChange();
					},
			error: function (MLHttpRequest, textStatus, errorThrown) {
						alert("Ajax not enabled");
						mappableFields = mappableFieldsFallback;
						createMapOptions();
						buildInboundFieldDropdown();
						onDropdownChange();
					},
		});



/* Create the list of mappable options when the mappableFields are mapped. Also handles refreshing the select options*/
	function createMapOptions(refresh, whichElement, placeholderOption){
		selectOptions = '';
		
		/* placeholderOption is the option the user last used for the input type.
		 * cf7 doesn't refresh the values ,(class, id, etc), so for consistancy the placeholder has been added
		 * This is a refresh feature, not an initial pageload action*/
		if(placeholderOption){selectOptions += placeholderOption}
		
		/* walk down the mappableFields object. 
		 * mappableFields[value] is the index, and "value" is the value of the index*/
		Object.keys(mappableFields).forEach(function (value) {
			if(mappedFields.indexOf(mappableFields[value]) == -1 || value == 'No Mapping'){
				selectOptions += '<option value="' + mappableFields[value] + '">' + value + '</option>';
			}else{/*do nothing...*/}
		});
			if(refresh){
			jQuery('#' + whichElement).find('.cf7-inbound-input > option').remove();
			jQuery('#' + whichElement).find('select.cf7-inbound-input').append(selectOptions);

		}
	}

/*build and append an InboundNow Mapping dropdown to each of the targeted input types. Which inputs are set by markerTags*/
	function buildInboundFieldDropdown(){	
		for(var i = 0; i < tagGeneratorPanel.length; i++){
			if(markerTags.indexOf(tagGeneratorPanel[i].getAttribute('data-id')) !== -1){
//				console.log(tagGeneratorPanel[i].getAttribute('data-id'));
				var inboundFieldDropdown = '<tr class="inboundnow-field-row">\
												<th scope="row"><label for="tag-generator-panel-inbound-input">Inbound Now Mapping</label></th>\
												<td>\
													<select name="inbound" class="classvalue oneline option cf7-inbound-input" id="tag-generator-panel-'+ tagGeneratorPanel[i].getAttribute('data-id') +'-inbound-input" >'+ selectOptions +' </select>\
													<input type="text" name="inbound" class="classvalue oneline option ghost-input cf7-inbound-input" id="tag-generator-panel-'+ tagGeneratorPanel[i].getAttribute('data-id') +'-inbound-input" style="display: none;" value/>\
												</td>\
											</tr>';
				jQuery(tagGeneratorPanel[i]).find('tbody').append(inboundFieldDropdown);
			}
		}
	}
	
/* refresh mapping fields by finding which fields have been mapped, and adding them to an array
 * of fields to NOT use. */
	function refreshInboundMappingFields(){
		/*get the string value of the editor's input*/
		editorContent = jQuery('textarea#wpcf7-form').val();
		/*clear mappedFields*/
		mappedFields = [];
		
		/*find the start and end of the first lead field to map*/
		var startIndex = editorContent.indexOf('wpleads_');
		var endIndex;
			/*If ']' is closer than the nearest space, then the mapped field is on the end of the shortcode*/
		if(editorContent.indexOf(']', startIndex ) < editorContent.indexOf(' ', startIndex)){
				endIndex = editorContent.indexOf(']', startIndex );
		}else{ endIndex =  editorContent.indexOf(' ', startIndex)}
	
		
		/*create an array of all mapped fields*/
		do{
			mappedFields.push(editorContent.slice(startIndex, endIndex));
			startIndex = editorContent.indexOf('wpleads_', endIndex);
			if(editorContent.indexOf(']', startIndex ) < editorContent.indexOf(' ', startIndex)){
					endIndex = editorContent.indexOf(']', startIndex );
			}else{  endIndex = editorContent.indexOf(' ', startIndex )}
		
		}while(startIndex != -1);	
		
	}

	/* The 'ghost-input' is a hidden input that has its value set to that of the inbound field dropdown.
	 * Cf7 scans the ghost-input, and uses its set value for the shortcode. */
	function onDropdownChange(){ 
		jQuery('.cf7-inbound-input').change(function(event) {
			var form = jQuery(this).closest('form.tag-generator-panel');
			/* find the ghost-input in the form where the cf7-inbound-input dropdown changed
			 * and set the value to that of the dropdown. */
			jQuery(form).find('.ghost-input').val(jQuery(this).val());
			
			wpcf7.taggen.normalize(jQuery(this));
			wpcf7.taggen.update(form);
			
			});
		}


	/*This refreshes the fields available to be mapped*/
	jQuery('a.thickbox.button').on('click', function(){
		/*get the link from the button clicked.*/
		var buttonLink = jQuery(this)[0]['href'];
		/*slice the id portion out of the link. ex: 'tag-generator-panel-email'*/
		buttonLink = buttonLink.slice(buttonLink.indexOf('Id=') + 3);
		//console.log(buttonLink.slice(buttonLink.indexOf('panel-') + 6 ));  //ex: 'email' out of 'tag-generator-panel-email'
		/*if the sliced part of buttonLink is present in markerTags, do the refresh*/
		if(markerTags.indexOf(buttonLink.slice(buttonLink.indexOf('panel-') + 6 )) !== -1){
			/*create a placeholder option for a better UX*/
			var ghostInputVal = jQuery('#' + buttonLink).find('.ghost-input').val();
			if(ghostInputVal != ''){
				var placeholderOption;
				console.log(mappableFields);
				Object.keys(mappableFields).forEach(function (index) {
					if(mappableFields[index] == ghostInputVal){
						placeholderOption = '<option value="' + ghostInputVal + '">' + index + '</option>';
					}
				});
			}
		/*refresh the field dropdown*/
			refreshInboundMappingFields();
			/*'true' means its refresh mode, and buttonLink is the #id of the element to apply the refreshed dropdown to,
			 * and placeholderOption is  the option the user last set for that input type.*/
			createMapOptions(true, buttonLink, placeholderOption);
		}
	});


	
	}	
});
