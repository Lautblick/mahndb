$(function() {
	
	var uploadify_instances = {};
	
	function get_case_listitem(case_id) {
		var listitem;
		var data = {
			case_id: case_id
		}
		$.ajax({
			type: "POST",
			url: "/case/get_list_item",
			data: data,
			async: false,
			success: function(msg){
				listitem = msg;
			}
  		});
  		return listitem;
	}
	
	// -----------------------------------------------------------------------
	
	function update_case() {
		var case_id = $('#case_id').val();
		var url = "/case/update/"+case_id;
		var case_active = $('#case_active').is(':checked');
		
		if (case_active == '') {
			case_active = '0';
		}
		else {
			case_active = '1';
		}
				
		var data = {
			case_id: case_id,
			tenancy_ve: $('#tenancy_ve').val(),
			case_active: case_active,
			case_followup: $('#case_followup').val(),
			case_reason: $('#case_reason').val(),
			cl_lawyer_ref: $('#cl_lawyer_ref').val(),
			cl_lawyer_charged: $('#cl_lawyer_charged').val(),
			def_lawyer_ref: $('#def_lawyer_ref').val(),
			court_ref: $('#court_ref').val(),
			case_type: $('#case_type').val(),
			case_memo: $('#case_memo').val()
		}
		
		console.log(data);
		
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			async: false,
			success: function(msg) {
				$('#case_list_1 #'+case_id).replaceWith(get_case_listitem(case_id));
				$('#case_list_2 #'+case_id).replaceWith(get_case_listitem(case_id));
				init_gui();
			}
  		});
	}
	
	// -----------------------------------------------------------------------
	
	function delete_case(case_id) {
		var url = "/case/delete/"+case_id;
				
		var data = {
			case_id: case_id
		}
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			async: false,
			success: function(msg) {
				$('#case_list_1 #'+case_id).fadeOut();
				$('#case_list_2 #'+case_id).fadeOut();
				init_gui();
			}
  		});
	}
	
	// -----------------------------------------------------------------------
	
	function delete_person(person_id, case_id, add_as) {
		var url = "/person/unlinkperson/";
				
		var data = {
			person_id: person_id,
			case_id: case_id,
			add_as: add_as+'s'
		}
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			async: false,
			success: function(msg) {
				$('#'+add_as+'s_list .'+person_id).fadeOut();
				$('#case_list_1 #'+case_id).replaceWith(get_case_listitem(case_id));
				$('#case_list_2 #'+case_id).replaceWith(get_case_listitem(case_id));
				init_gui();
			}
  		});
	}
	
	// -----------------------------------------------------------------------
	
	function add_person(type) {
		var case_id = $( "#case_id" ).val();
		var data = {
			person_title: $('#'+type+'_add_2 #person_title').val(),
			person_firstname: $('#'+type+'_add_2 #person_firstname').val(),
			person_lastname: $('#'+type+'_add_2 #person_lastname').val(),
			address_street:  $('#'+type+'_add_2 #address_street').val(),
			address_street_number:  $('#'+type+'_add_2 #address_street_number').val(),
			address_phone_number:  $('#'+type+'_add_2 #address_phone_number').val(),
			address_fax_number:  $('#'+type+'_add_2 #address_fax_number').val(),
			address_email:  $('#'+type+'_add_2 #address_email').val(),
			zipcode:  $('#'+type+'_add_2 #zipcode').val(),
			place_name:  $('#'+type+'_add_2 #place_name').val(),
			case_id: case_id,
			add_as: type+'s'
		}
		$('#'+type+'_add_dialog').dialog('close');
		$.ajax({
			type: "POST",
			url: "/person/addperson",
			data: data,
			async: false,
			success: function(msg) {
				if(type == 'claimant' || type == 'defendant') {
					$('#'+type+'s_list').append(msg);
					$('#'+type+'s_list li:last-child').hide().slideDown();
					$('#case_list_1 #'+case_id).replaceWith(get_case_listitem(case_id));
					$('#case_list_2 #'+case_id).replaceWith(get_case_listitem(case_id));
				}
				else {
					var newid = msg.split(':')[0];
					var newname = msg.split(':')[1];
					$('#'+type+'_name').val(newname);
					$('#'+type+'_name').parent().attr("id", newid);
				}
				init_gui();
			}
  		});
	}
	
	// -----------------------------------------------------------------------
		
	function link_person(person_id, add_as) {
		
		console.log('link_person wurde gestartet');
		
		var case_id = $( "#case_id" ).val();
		var data = {
			person_id: person_id,
			case_id: case_id,
			add_as: add_as+'s'
		}
		$('#'+add_as+'_add_dialog').dialog('close');
		$.ajax({
		  type: "POST",
		  url: "/person/addperson",
		  data: data,
		  async: false,
		  success: function(msg){
			
			console.log('Success');
			
		    if(add_as == 'claimant' || add_as == 'defendant') {
				$('#'+add_as+'s_list').append(msg);
				$('#'+add_as+'s_list li:last-child').hide().slideDown();
				$('#case_list_1 #'+case_id).replaceWith(get_case_listitem(case_id));
				$('#case_list_2 #'+case_id).replaceWith(get_case_listitem(case_id));
			}
			else {
				var newid = msg.split(':')[0];
				var newname = msg.split(':')[1];
				
				console.log(newid);
				console.log(newname);
				
				$('#'+add_as+'_name').val(newname);
				$('#'+add_as+'_name').parent().attr("id", newid);
			}
			init_gui();
  		  }
  		});
	}
	
	// -----------------------------------------------------------------------
	
	function get_person_listitem(person_id, add_as) {
		var listitem;
		var data = {
			person_id: person_id,
			add_as: add_as
		}
		$.ajax({
			type: "POST",
			url: "/person/get_list_item",
			data: data,
			async: false,
			success: function(msg){
				listitem = msg;
			}
  		});
  		return listitem;
	}
	
	// -----------------------------------------------------------------------
	
	function update_person(reference) {
		var person_id = $('#person_edit_dialog #person_id').val()
		var data = {
			person_id: person_id,
			person_title: $('#person_edit_dialog #person_title').val(),
			person_firstname: $('#person_edit_dialog #person_firstname').val(),
			person_lastname: $('#person_edit_dialog #person_lastname').val(),
			address_street:  $('#person_edit_dialog #address_street').val(),
			address_street_number:  $('#person_edit_dialog #address_street_number').val(),
			address_phone_number:  $('#person_edit_dialog #address_phone_number').val(),
			address_fax_number:  $('#person_edit_dialog #address_fax_number').val(),
			address_email:  $('#person_edit_dialog #address_email').val(),
			zipcode:  $('#person_edit_dialog #zipcode').val(),
			place_name:  $('#person_edit_dialog #place_name').val()
		}
		$('#person_edit_dialog').dialog('close');
		$.ajax({
			type: "POST",
			url: "/person/update/"+person_id,
			data: data,
			async: false,
			success: function(msg) {
				$('#claimants_list #'+person_id).replaceWith(get_person_listitem(person_id, 'claimants'));
				$('#defendants_list #'+person_id).replaceWith(get_person_listitem(person_id, 'defendants'));
				$('#'+person_id+' #cl_lawyer_name').val(data.person_title+' '+data.person_firstname+' '+data.person_lastname);
				$('#'+person_id+' #def_lawyer_name').val(data.person_title+' '+data.person_firstname+' '+data.person_lastname);
			}
  		});
		init_gui();
	}
	
	// -----------------------------------------------------------------------
	
	function add_event() {
		var case_id = $( "#case_id" ).val();
		var data = {
			event_type: $('#event_type').val(),
			event_date: $('#event_date').val(),
			event_file: $('#event_file').val(),
			event_description: $('#event_description').val(),
			case_id: case_id
		}
		$('#event_add_dialog').dialog('close');
		$.ajax({
			type: "POST",
			url: "/event/addevent",
			data: data,
			async: false,
			success: function(msg) {
				$('#events_list').append(msg);
				$('#events_list li:last-child').hide().slideDown();
				init_gui();
			}
  		});
	}
	
	// -----------------------------------------------------------------------
	
	function delete_event(event_id) {
		var url = "/event/delete/";
				
		var data = {
			event_id: event_id
		}
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			async: false,
			success: function(msg) {
				$('#events_list .'+event_id).fadeOut();
			}
  		});
	}
	
	// -----------------------------------------------------------------------
	
	function get_event_listitem(event_id) {
		var listitem;
		var data = {
			event_id: event_id
		}
		$.ajax({
			type: "POST",
			url: "/event/get_list_item",
			data: data,
			async: false,
			success: function(msg){
				listitem = msg;
			}
  		});
  		return listitem;
	}
	
	// -----------------------------------------------------------------------
	
	function update_event() {
		var event_id = $('#event_edit_dialog #event_id').val();
		var data = {
			event_id: event_id,
			event_type: $('#event_edit_dialog #event_type_edit').val(),
			event_date: $('#event_edit_dialog #event_date_edit').val(),
			event_file: $('#event_edit_dialog #event_file_edit').val(),
			event_description: $('#event_edit_dialog #event_description').val(),
		}
		$('#event_edit_dialog').dialog('close');
		$.ajax({
			type: "POST",
			url: "/event/update/"+event_id,
			data: data,
			async: false,
			success: function(msg) {
				$('#events_list .'+event_id).replaceWith(get_event_listitem(event_id));
			}
  		});
		init_gui();
	}
	
	// -----------------------------------------------------------------------
	
	function add_appointment() {                    // <-- Wenn Termin vor nächster WV: WV aktualisieren
		var case_id = $( "#case_id" ).val();        // <-- VE-Nr. bearbeiten öffnet Kläger hinzufügen???    Bestätigung bei Änderung VE-Nr.
		var data = {
			appointment_date: $('#appointment_date').val(),
			appointment_hour: $('#appointment_hour').val(),
			appointment_minute: $('#appointment_minute').val(),
			appointment_location: $('#appointment_location').val(),
			appointment_description: $('#appointment_description').val(),
			case_id: case_id
		}
		$('#appointment_add_dialog').dialog('close');
		$.ajax({
			type: "POST",
			url: "/appointment/addappointment",
			data: data,
			async: false,
			success: function(msg) {
				$('#appointments_list').append(msg);
				$('#appointments_list li:last-child').hide().slideDown();
				init_gui();
			}
  		});
	}
	
	// -----------------------------------------------------------------------
	
	function delete_appointment(appointment_id) {
		var url = "/appointment/delete/";
				
		var data = {
			appointment_id: appointment_id
		}
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			async: false,
			success: function(msg) {
				$('#appointments_list .'+appointment_id).fadeOut();
			}
  		});
	}
	
	// -----------------------------------------------------------------------
	
	function get_appointment_listitem(appointment_id) {
		var listitem;
		var data = {
			appointment_id: appointment_id
		}
		$.ajax({
			type: "POST",
			url: "/appointment/get_list_item",
			data: data,
			async: false,
			success: function(msg){
				listitem = msg;
			}
  		});
  		return listitem;
	}
	
	// -----------------------------------------------------------------------
	
	function update_appointment() {
		var appointment_id = $('#appointment_edit_dialog #appointment_id').val();
		var data = {
			appointment_id: appointment_id,			
			appointment_date: $('#appointment_edit_dialog #appointment_date_edit').val(),
			appointment_hour: $('#appointment_edit_dialog #appointment_hour').val(),
			appointment_minute: $('#appointment_edit_dialog #appointment_minute').val(),
			appointment_location: $('#appointment_edit_dialog #appointment_location').val(),
			appointment_description: $('#appointment_edit_dialog #appointment_description').val()
		}
				
		$('#appointment_edit_dialog').dialog('close');
		$.ajax({
			type: "POST",
			url: "/appointment/update/"+appointment_id,
			data: data,
			async: false,
			success: function(msg) {
				$('#appointments_list .'+appointment_id).replaceWith(get_appointment_listitem(appointment_id));
			}
  		});
		init_gui();
	}
	
	// -----------------------------------------------------------------------
	
	function add_cost() {
		var case_id = $( "#case_id" ).val();
		var data = {
			cost_date: $('#cost_date').val(),
			cost_file: $('#cost_file').val(),
			cost_amount: $('#cost_amount').val().split('.').join('').split(',').join('.'),
			cost_category: $( "#costs_tabs" ).tabs( "option", "selected" ),
			cost_type: $('#cost_type').val(),
			case_id: case_id
		}
		$('#cost_add_dialog').dialog('close');
		$.ajax({
			type: "POST",
			url: "/cost/addcost",
			data: data,
			async: false,
			success: function(msg) {
				$('#costs_list_'+(data.cost_category+1)).append(msg);
				$('#costs_list_'+(data.cost_category+1)+' li:last-child').hide().slideDown();
				console.log('Element wurde angefügt in: #costs_list_'+(data.cost_category+1));
				
				var new_total = parseFloat(data.cost_amount)+parseFloat($('.cost_total strong').html().split('.').join('').split(',').join('.'));
				var new_total = new_total.toFixed(2).split('.').join(',')+' €';
				$('#costs_list_'+(data.cost_category+1)+' .cost_total strong').html(new_total);
				console.log('Hello '+new_total);
				
				$('#case_list_1 #'+case_id).replaceWith(get_case_listitem(case_id));
				$('#case_list_2 #'+case_id).replaceWith(get_case_listitem(case_id));
				init_gui();
			}
  		});
	}
	
	// -----------------------------------------------------------------------
	
	function delete_cost(cost_id) {
		var url = "/cost/delete/";
				
		var data = {
			cost_id: cost_id
		}
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			async: false,
			success: function(msg) {
				$('#costs_list_1 .'+cost_id).fadeOut();
				$('#costs_list_2 .'+cost_id).fadeOut();
			}
  		});
	}
	
	// -----------------------------------------------------------------------
	
	function get_cost_listitem(cost_id) {
		var listitem;
		var data = {
			cost_id: cost_id
		}
		$.ajax({
			type: "POST",
			url: "/cost/get_list_item",
			data: data,
			async: false,
			success: function(msg){
				listitem = msg;
			}
  		});
  		return listitem;
	}
	
	// -----------------------------------------------------------------------
	
	function update_cost() {
		var cost_id = $('#cost_edit_dialog #cost_id').val();
		var data = {
			cost_id: cost_id,
			cost_date: $('#cost_edit_dialog #cost_date_edit').val(),
			cost_file: $('#cost_edit_dialog #cost_file_edit').val(),
			cost_amount: $('#cost_edit_dialog #cost_amount').val().split('.').join('').split(',').join('.'),
			cost_category: $( "#costs_tabs" ).tabs( "option", "selected" ),
			cost_type: $('#cost_edit_dialog #cost_type_edit').val(),
		}
		var cost_amount_old = $('#costs_list_'+(data.cost_category+1)+' .'+cost_id+' .amount').html().split('.').join('').split(',').join('.').split(' €').join('');
		
		console.log(cost_amount_old);
		
		$('#cost_edit_dialog').dialog('close');
		$.ajax({
			type: "POST",
			url: "/cost/update/"+cost_id,
			data: data,
			async: false,
			complete: function(msg) {
				$('#costs_list_'+(data.cost_category+1)+' .'+cost_id).replaceWith(get_cost_listitem(cost_id));
				var new_total = parseFloat($('.cost_total strong').html().split('.').join('').split(',').join('.'))-parseFloat(cost_amount_old)+parseFloat(data.cost_amount)
				var new_total = new_total.toFixed(2).split('.').join(',')+' €';
				$('#costs_list_'+(data.cost_category+1)+' .cost_total strong').html(new_total);
			}
  		});
		init_gui();
	}
	
	// -----------------------------------------------------------------------
		
	function init_gui() {
		
		// -----------------------------------------------------------------------
		
		// Tabs
		$('#cases_tabs').tabs();
		$('#costs_tabs').tabs();
		$('#claimant_add_tabs').tabs();
		$('#defendant_add_tabs').tabs();
		$('#cl_lawyer_add_tabs').tabs();
		$('#def_lawyer_add_tabs').tabs();
		
		// -----------------------------------------------------------------------
		
		// Datepicker
		$('#case_followup').datepicker({
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'],
			onSelect: function(dateText, inst) {
				//update_case();
				return false;
			}
		});
		
		// -----------------------------------------------------------------------
		
		// Datepicker
		$('#cl_lawyer_charged').datepicker({
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'],
			onSelect: function(dateText, inst) {
				//update_case();
				return false;
			}
		});
		
		// -----------------------------------------------------------------------
		
		$('#event_date').datepicker({ 
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'], 
		});
		
		// -----------------------------------------------------------------------
		
		$('#event_date_edit').datepicker({ 
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'], 
		});
		
		// -----------------------------------------------------------------------
		
		$('#appointment_date').datepicker({ 
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'], 
		});
		
		// -----------------------------------------------------------------------
		
		$('#appointment_date_edit').datepicker({ 
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'], 
		});
		
		// -----------------------------------------------------------------------
		
		$('#cost_date').datepicker({ 
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'], 
		});
		
		// -----------------------------------------------------------------------
		
		$('#cost_date_edit').datepicker({ 
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'], 
		});
		
		// -----------------------------------------------------------------------

		$('#case_type').change(function(event) {
			//update_case();
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('#claimant_add_dialog').dialog({
			autoOpen: false,
			width: '40%',
			height: '400',
			position: ['center', 100],
			modal: true,
			resizable: false,
			show: 'fade',
			hide: 'fade',
			close: function() {
				$('#claimant_add_dialog input, #claimant_add_dialog select, #claimant_add_dialog textarea').val('');
			}
		});
		
		// -----------------------------------------------------------------------
		
		$('#defendant_add_dialog').dialog({
			autoOpen: false,
			width: '40%',
			height: '400',
			position: ['center', 100],
			modal: true,
			resizable: false,
			show: 'fade',
			hide: 'fade',
			close: function() {
				$('#defendant_add_dialog input, #event_add_dialog select, #defendant_add_dialog textarea').val('');
			}
		});
		
		// -----------------------------------------------------------------------
		
		$('#cl_lawyer_add_dialog').dialog({
			autoOpen: false,
			width: '40%',
			height: '400',
			position: ['center', 100],
			modal: true,
			resizable: false,
			show: 'fade',
			hide: 'fade',
			close: function() {
				$('#cl_lawyer_add_dialog input, #cl_lawyer_add_dialog select, #cl_lawyer_add_dialog textarea').val('');
			}
		});
		
		// -----------------------------------------------------------------------
		
		$('#def_lawyer_add_dialog').dialog({
			autoOpen: false,
			width: '40%',
			height: '400',
			position: ['center', 100],
			modal: true,
			resizable: false,
			show: 'fade',
			hide: 'fade',
			close: function() {
				$('#def_lawyer_add_dialog input, #def_lawyer_add_dialog select, #def_lawyer_add_dialog textarea').val('');
			}
		});
		
		// -----------------------------------------------------------------------
		
		$('#event_add_dialog').dialog({
			autoOpen: false,
			width: '40%',
			height: '400',
			position: ['center', 100],
			modal: true,
			resizable: false,
			show: 'fade',
			hide: 'fade',
			close: function() {
				$('#event_add_dialog input, #event_add_dialog select, #event_add_dialog textarea').val('');
			}
		});
		
		// -----------------------------------------------------------------------
		
		$('#appointment_add_dialog').dialog({
			autoOpen: false,
			width: '40%',
			height: '400',
			position: ['center', 100],
			modal: true,
			resizable: false,
			show: 'fade',
			hide: 'fade',
			close: function() {
				$('#appointment_add_dialog input, #appointment_add_dialog select, #appointment_add_dialog textarea').val('');
			}
		});
		
		// -----------------------------------------------------------------------
		
		$('#cost_add_dialog').dialog({
			autoOpen: false,
			width: '40%',
			height: '400',
			position: ['center', 100],
			modal: true,
			resizable: false,
			show: 'fade',
			hide: 'fade',
			close: function() {
				$('#cost_add_dialog input, #cost_add_dialog select, #cost_add_dialog textarea').val('');
			}
		});
		
		// -----------------------------------------------------------------------
		
		$('#person_edit_dialog').dialog({
			autoOpen: false,
			width: '40%',
			height: '400',
			position: ['center', 100],
			modal: true,
			resizable: false,
			show: 'fade',
			hide: 'fade'
		});
		
		// -----------------------------------------------------------------------
		
		$('#event_edit_dialog').dialog({
			autoOpen: false,
			width: '40%',
			height: '400',
			position: ['center', 100],
			modal: true,
			resizable: false,
			show: 'fade',
			hide: 'fade'
		});
		
		// -----------------------------------------------------------------------
		
		$('#appointment_edit_dialog').dialog({
			autoOpen: false,
			width: '40%',
			height: '400',
			position: ['center', 100],
			modal: true,
			resizable: false,
			show: 'fade',
			hide: 'fade'
		});
		
		// -----------------------------------------------------------------------
		
		$('#cost_edit_dialog').dialog({
			autoOpen: false,
			width: '40%',
			height: '400',
			position: ['center', 100],
			modal: true,
			resizable: false,
			show: 'fade',
			hide: 'fade'
		});
		
		// -----------------------------------------------------------------------
		
		if(!uploadify_instances['#select_file']) {
			uploadify_instances['#select_file'] = true;
			$('#select_file').uploadify({
				'uploader'  : '/js/uploadify/uploadify.swf',
				'script'    : '/js/uploadify/uploadify.php',
				'cancelImg' : '/js/uploadify/cancel.png',
				'folder'    : '/uploads',
				'auto'      : true,
				'onComplete': function(event, ID, fileObj, response, data) {
			    	$('#event_file').val(response);
			    }
			});
		}
		
		// -----------------------------------------------------------------------
		
		if(!uploadify_instances['#cost_select_file']) {
			uploadify_instances['#cost_select_file'] = true;
			$('#cost_select_file').uploadify({
				'uploader'  : '/js/uploadify/uploadify.swf',
				'script'    : '/js/uploadify/uploadify.php',
				'cancelImg' : '/js/uploadify/cancel.png',
				'folder'    : '/uploads',
				'auto'      : true,
				'onComplete': function(event, ID, fileObj, response, data) {
			    	$('#cost_file').val(response);
			    }
			});
		}
		
		// -----------------------------------------------------------------------
		
		$( "#claimant_search" ).autocomplete({
			source: persons,
			focus: function( event, ui ) {
				$( "#claimant_search" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
				link_person(ui.item.value, 'claimant');
				event.stopImmediatePropagation();
				return false;
			}
		})
		.data('autocomplete')._renderItem = function( ul, item ) {
			return $('<li></li>')
				.data('item.autocomplete', item )
				.append( "<a>" + item.label + "<br/><span class=\"small\">" + item.street + ", "+item.zipcode+" "+item.city+"</span></a>" )
				.appendTo( ul );
		};
		
		// -----------------------------------------------------------------------
		
		$( "#defendant_search" ).autocomplete({
			source: persons,
			focus: function( event, ui ) {
				$( "#defendant_search" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
				link_person(ui.item.value, 'defendant');
				event.stopImmediatePropagation();
				return false;
			}
		})
		.data('autocomplete')._renderItem = function( ul, item ) {
			return $('<li></li>')
				.data('item.autocomplete', item )
				.append( "<a>" + item.label + "<br/><span class=\"small\">" + item.street + ", "+item.zipcode+" "+item.city+"</span></a>" )
				.appendTo( ul );
		};
		
		// -----------------------------------------------------------------------
		
		$( "#cl_lawyer_search" ).autocomplete({
			source: persons,
			focus: function( event, ui ) {
				$( "#cl_lawyer_search" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
				link_person(ui.item.value, 'cl_lawyer');
				event.stopImmediatePropagation();
				return false;
			}
		})
		.data('autocomplete')._renderItem = function( ul, item ) {
			return $('<li></li>')
				.data('item.autocomplete', item )
				.append( "<a>" + item.label + "<br/><span class=\"small\">" + item.street + ", "+item.zipcode+" "+item.city+"</span></a>" )
				.appendTo( ul );
		};
		
		// -----------------------------------------------------------------------
		
		$( "#def_lawyer_search" ).autocomplete({
			source: persons,
			focus: function( event, ui ) {
				$( "#def_lawyer_search" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
				link_person(ui.item.value, 'def_lawyer');
				event.stopImmediatePropagation();
				return false;
			}
		})
		.data('autocomplete')._renderItem = function( ul, item ) {
			return $('<li></li>')
				.data('item.autocomplete', item )
				.append( "<a>" + item.label + "<br/><span class=\"small\">" + item.street + ", "+item.zipcode+" "+item.city+"</span></a>" )
				.appendTo( ul );
		};
		
		// -----------------------------------------------------------------------
		
		$( "#case_type" ).autocomplete({
			source: case_types
		});
		
		// -----------------------------------------------------------------------
		
		$( "#cost_type" ).autocomplete({
			source: cost_types
		});
		
		// -----------------------------------------------------------------------
		
		$( "#cost_type_edit" ).autocomplete({
			source: cost_types
		});
		
		// -----------------------------------------------------------------------
		
		$( "#event_type" ).autocomplete({
			source: event_types
		});
		
		// -----------------------------------------------------------------------
		
		$( "#event_type_edit" ).autocomplete({
			source: event_types
		});
		
		// -----------------------------------------------------------------------
		
		$('button#case_update').click(function(event) {
			update_case();
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('button#person_edit').click(function(event) {
			update_person($(this));
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('button#claimant_add').click(function(event) {
			add_person('claimant');
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('button#defendant_add').click(function(event) {
			add_person('defendant');
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('button#cl_lawyer_add').click(function(event) {
			add_person('cl_lawyer');
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('button#def_lawyer_add').click(function(event) {
			add_person('def_lawyer');
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('#cl_lawyer_name').focus(function(event) {
			$('#cl_lawyer_add_dialog').dialog('open');
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('#def_lawyer_name').focus(function(event) {
			$('#def_lawyer_add_dialog').dialog('open');
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('button#event_add').click(function(event) {
			add_event();
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('button#event_edit').click(function(event) {
			update_event($(this));
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('button#appointment_add').click(function(event) {
			add_appointment();
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('button#appointment_edit').click(function(event) {
			update_appointment();
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('button#cost_add').click(function(event) {
			add_cost();
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('button#cost_edit').click(function(event) {
			update_cost();
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('#fileElem').change(function(event) {
			handleFiles($(this).files);
		});
		
		// -----------------------------------------------------------------------
		
		// Dialog Link
		$('#claimant_add_dialog_open').click(function(event){
			$('#claimant_add_dialog').dialog('open');
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		// Dialog Link
		$('#defendant_add_dialog_open').click(function(event){
			$('#defendant_add_dialog').dialog('open');
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		// Dialog Link
		$('#event_add_dialog_open').click(function(event){
			$('#event_add_dialog').dialog('open');
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		// Dialog Link
		$('#appointment_add_dialog_open').click(function(event){
			$('#appointment_add_dialog').dialog('open');
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		// Dialog Link
		$('#cost_add_dialog_open').click(function(event){
			$('#cost_add_dialog').dialog('open');
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		// Dialog Edit
		$('.person_edit').click(function(event){
			var person_id = $(this).parent().attr('id');
			var data = {
				person_id: person_id
			}
			var url = "/person/getedit";
			$.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  async: false,
			  success: function(msg){
			  	
			  	$('#person_edit_dialog').html(msg);
				init_gui();
	  		  }
	  		});
			var url = "/person/getname";
			$.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  async: false,
			  success: function(msg){
			  	
				$('#person_edit_dialog').dialog('option', 'title', 'Details von '+ msg +' bearbeiten');
	  		  }
	  		});
			$('#person_edit_dialog').dialog('open');
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		// Dialog Edit
		$('.event_edit').click(function(event){
			var event_id = $(this).parent().attr('class');
			var data = {
				event_id: event_id
			}
			var url = "/event/getedit";
			$.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  async: false,
			  success: function(msg){
			  	
			  	$('#event_edit_dialog').html(msg);
				init_gui();
	  		  }
	  		});
			$('#event_edit_dialog').dialog('open');
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		// Dialog Edit
		$('.appointment_edit').click(function(event){
			var appointment_id = $(this).parent().attr('class');
			var data = {
				appointment_id: appointment_id
			}
			var url = "/appointment/getedit";
			$.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  async: false,
			  success: function(msg){
			  	$('#appointment_edit_dialog').html(msg);
				init_gui();
	  		  }
	  		});
			$('#appointment_edit_dialog').dialog('open');
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		// Dialog Edit
		$('.cost_edit').click(function(event){
			var cost_id = $(this).parent().attr('class');
			var data = {
				cost_id: cost_id
			}
			var url = "/cost/getedit";
			$.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  async: false,
			  success: function(msg){
			  	$('#cost_edit_dialog').html(msg);
				init_gui();
	  		  }
	  		});
			$('#cost_edit_dialog').dialog('open');
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('[rel="case"]').blur(function(event){
			//update_case();
			event.stopImmediatePropagation();
			return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('#case_list_1 a').click(function(event) {
			
			$('#case_list_1 li').removeClass('current');
			$('#case_list_2 li').removeClass('current');
			$(this).parent().addClass('current');
			var url = $(this).attr("href");
			
			$.ajax({
			  type: "POST",
			  url: url,
			  async: false,
			  success: function(msg){
			  	$('#select_file').remove();
	    		$('#case_details').html(msg);
				init_gui();
	  		  }
	  		});
	  		event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('#case_list_2 a').click(function(event) {
			
			$('#case_list_1 li').removeClass('current');
			$('#case_list_2 li').removeClass('current');
			$(this).parent().addClass('current');
			var url = $(this).attr("href");
			
			$.ajax({
			  type: "POST",
			  url: url,
			  async: false,
			  success: function(msg){
			  	$('#select_file').remove();
	    		$('#case_details').html(msg);
				init_gui();
	  		  }
	  		});
	  		event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('.case_delete').click(function(event) {
			var case_id = $(this).parent().attr('id');
			delete_case(case_id);
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('.claimant_delete').click(function(event) {
			var case_id = $('#case_id').val();
			var person_id = $(this).parent().attr('id');
			delete_person(person_id, case_id, 'claimant');
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('.defendant_delete').click(function(event) {
			var case_id = $('#case_id').val();
			var person_id = $(this).parent().attr('id');
			delete_person(person_id, case_id, 'defendant');
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('.event_delete').click(function(event) {
			var event_id = $(this).parent().attr('class');
			delete_event(event_id);
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('.appointment_delete').click(function(event) {
			var appointment_id = $(this).parent().attr('class');
			delete_appointment(appointment_id);
			event.stopImmediatePropagation();
	  		return false;
		});
		
		// -----------------------------------------------------------------------
		
		$('.cost_delete').click(function(event) {
			var cost_id = $(this).parent().attr('class');
			var answer = confirm("Möchten Sie diesen Kosteneintrag wirklich löschen?")
			if (answer){
				delete_cost(cost_id);
				event.stopImmediatePropagation();
		  		return false;
			}
			else{
		  		return false;
			}
		});
	}
	
	// -----------------------------------------------------------------------
	
	$('#case_list_1 li:first-child').addClass('current');
	var url = $('#case_list_1 li:first-child a').attr("href");
	$.ajax({
	  type: "POST",
	  url: url,
	  success: function(msg){
		$('#case_details').html(msg);
		init_gui();
	  }
	});
	
	// -----------------------------------------------------------------------
	
	$('button#case_new').click(function(event) {
		$.ajax({
		  type: "POST",
		  url: "/case/new",
		  success: function(msg){
    		
			$('#case_list_1 li').removeClass('current');
			$('#case_list_1').append(get_case_listitem(msg));
			
			var url = '/case/show/'+msg;
			$.ajax({
			  type: "POST",
			  url: url,
			  async: false,
			  success: function(msg){
	    		$('#case_details').html(msg);
				init_gui();
	  		  }
	  		});
    		
  		  }
  		});
  		event.stopImmediatePropagation();
	  	return false;
	});
	
	// -----------------------------------------------------------------------
	
	$('input#search_case').keyup(function(event) {
		var searchString = $(this).val().toLowerCase();
		var searchTerms = searchString.trim().split(' ');
		
		//console.log(searchTerms);
		
		var searchMatches = [];
		
		var listItems = $('#case_list_1 li').siblings();
		$.merge(listItems, $('#case_list_2 li').siblings())
		
		$.each(listItems, function(listItem_index, listItem_value) {
			var itemMatches = true;
			
			$.each(searchTerms, function(searchTerm_index, searchTerm_value) {
				var listItem = $(listItem_value).text().toLowerCase();
				
				if (!(listItem.indexOf(searchTerm_value) >= 0)) {
					itemMatches = false;
				}
			});
			
			
			if(itemMatches) {
				searchMatches.push(listItem_value);
			}
		});
		
		console.log(listItems.length+' : '+searchMatches.length);
		
		$(listItems).hide();
		$(searchMatches).fadeIn();
		
  		event.stopImmediatePropagation();
	  	return false;
	});
	
	// -----------------------------------------------------------------------
	
	//window.onbeforeunload = update_case;
});