<?php 

include 'function.php';

include 'conn.php'; ?>
<?php 

if((isset($_REQUEST['submit']))||(isset($_REQUEST['save_template']))||(isset($_REQUEST['save_prescription']))||(isset($_REQUEST['submit_sms']))||(isset($_REQUEST['submit_sms_n_print'])))

{

	// Data Edit

		if(isset($_REQUEST['save_prescription'])){

			$print_status=0;

			$temp_save=1;

		}

		else{

			$print_status=1;

			$temp_save=0;

		}		

		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);

		$mrd=mysqli_real_escape_string($conn,$_REQUEST['mrd']);	

		$created_on=mysqli_real_escape_string($conn,$_REQUEST['created_on']);

		$doctor_id=mysqli_real_escape_string($conn,$_REQUEST['doctor_id']);

		if($doctor_id==''){

			$doctor_id='';

		}

		$patients_key_notes=mysqli_real_escape_string($conn,$_REQUEST['patients_key_notes']);

		$prefix=mysqli_real_escape_string($conn,$_REQUEST['prefix']);

		$fname=mysqli_real_escape_string($conn,$_REQUEST['fname']);		

		$lname=mysqli_real_escape_string($conn,$_REQUEST['lname']);

		if($_REQUEST['dob']==''){

		$dob='NULL';

		}else{

			$dob= "'".date("Y-m-d", strtotime($_POST['dob']))."'";

		}

		$age=mysqli_real_escape_string($conn,$_REQUEST['age']);	

		if($age==''){

			$age=0;

		}	

		$religion=mysqli_real_escape_string($conn,$_REQUEST['religion']);

		$mobile=mysqli_real_escape_string($conn,$_REQUEST['mobile']);

		$email=mysqli_real_escape_string($conn,$_REQUEST['email']);

		$guardian_name=mysqli_real_escape_string($conn,$_REQUEST['guardian_name']);

		$address=mysqli_real_escape_string($conn,$_REQUEST['address']);

		$purpose_visit_id=mysqli_real_escape_string($conn,$_REQUEST['purpose_visit_id']);

		if($purpose_visit_id==''){

			$purpose_visit_id=0;

		}
		$chief_complaints_history=mysqli_real_escape_string($conn,$_REQUEST['chief_complaints_history']);	

		$past_ocular_history=mysqli_real_escape_string($conn,$_REQUEST['past_ocular_history']);

		$general_health=mysqli_real_escape_string($conn,$_REQUEST['general_health']);

		$family_history=mysqli_real_escape_string($conn,$_REQUEST['family_history']);

		$allergy_history=mysqli_real_escape_string($conn,$_REQUEST['allergy_history']);

		$pgp_block=mysqli_real_escape_string($conn,$_REQUEST['pgp_block']);

		if($pgp_block==''){

			$pgp_block=0;

		}

		$pgp=mysqli_real_escape_string($conn,$_REQUEST['pgp']);

		$sph_od=mysqli_real_escape_string($conn,$_REQUEST['sph_od']);

		$sph_add=mysqli_real_escape_string($conn,$_REQUEST['sph_add']);

		$cly_od=mysqli_real_escape_string($conn,$_REQUEST['cly_od']);

		$axis_od=mysqli_real_escape_string($conn,$_REQUEST['axis_od']);

		$sph_os=mysqli_real_escape_string($conn,$_REQUEST['sph_os']);

		$cyl_os=mysqli_real_escape_string($conn,$_REQUEST['cyl_os']);

		$axis_os=mysqli_real_escape_string($conn,$_REQUEST['axis_os']);

		$add_os=mysqli_real_escape_string($conn,$_REQUEST['add_os']);

		$ocular_block=mysqli_real_escape_string($conn,$_REQUEST['ocular_block']);

		if($ocular_block==''){

			$ocular_block=0;

		}

		$dv_glasses=mysqli_real_escape_string($conn,$_REQUEST['dv_glasses']);

		$dv_od=mysqli_real_escape_string($conn,$_REQUEST['dv_od']);

		$nv_od=mysqli_real_escape_string($conn,$_REQUEST['nv_od']);

		$dv_os=mysqli_real_escape_string($conn,$_REQUEST['dv_os']);

		$nv_os=mysqli_real_escape_string($conn,$_REQUEST['nv_os']);

		$glass_block=mysqli_real_escape_string($conn,$_REQUEST['glass_block']);

		if($glass_block==''){

			$glass_block=0;

		}

		$distance_sph_r=mysqli_real_escape_string($conn,$_REQUEST['distance_sph_r']);

		$distance_cyl_r=mysqli_real_escape_string($conn,$_REQUEST['distance_cyl_r']);

		$distance_axis_r=mysqli_real_escape_string($conn,$_REQUEST['distance_axis_r']);

		$distance_va_r=mysqli_real_escape_string($conn,$_REQUEST['distance_va_r']);

		$distance_sph_l=mysqli_real_escape_string($conn,$_REQUEST['distance_sph_l']);

		$distance_cyl_l=mysqli_real_escape_string($conn,$_REQUEST['distance_cyl_l']);

		$distance_axis_l=mysqli_real_escape_string($conn,$_REQUEST['distance_axis_l']);	

		$distance_va_l=mysqli_real_escape_string($conn,$_REQUEST['distance_va_l']);

		$near_sph_r=mysqli_real_escape_string($conn,$_REQUEST['near_sph_r']);

		$near_va_r=mysqli_real_escape_string($conn,$_REQUEST['near_va_r']);

		$near_sph_l=mysqli_real_escape_string($conn,$_REQUEST['near_sph_l']);

		$near_va_l=mysqli_real_escape_string($conn,$_REQUEST['near_va_l']);

		$cover_test_select=mysqli_real_escape_string($conn,$_REQUEST['cover_test_select']);

		$cover_test_text=mysqli_real_escape_string($conn,$_REQUEST['cover_test_text']);

		$EOM=mysqli_real_escape_string($conn,$_REQUEST['EOM']);

		$EOM_left=mysqli_real_escape_string($conn,$_REQUEST['EOM_left']);

		$pupils=mysqli_real_escape_string($conn,$_REQUEST['pupils']);

		$pupils_left=mysqli_real_escape_string($conn,$_REQUEST['pupils_left']);

		$lid_adnexa=mysqli_real_escape_string($conn,$_REQUEST['lid_adnexa']);

		$lid_adnexa_left=mysqli_real_escape_string($conn,$_REQUEST['lid_adnexa_left']);

		$anterior_chamber=mysqli_real_escape_string($conn,$_REQUEST['anterior_chamber']);

		$anterior_chamber_left=mysqli_real_escape_string($conn,$_REQUEST['anterior_chamber_left']);

		$anterior_figure=mysqli_real_escape_string($conn,$_REQUEST['anterior_figure']);

		if($anterior_figure==''){

			$anterior_figure=0;

		}

		$anterior_segment=mysqli_real_escape_string($conn,$_REQUEST['anterior_segment']);

		$anterior_left_segment=mysqli_real_escape_string($conn,$_REQUEST['anterior_left_segment']);		

		$misc_findings=mysqli_real_escape_string($conn,$_REQUEST['misc_findings']);

		$misc_findings_left=mysqli_real_escape_string($conn,$_REQUEST['misc_findings_left']);	

		$goneoscopy=mysqli_real_escape_string($conn,$_REQUEST['goneoscopy']);

		$goneoscopy_left=mysqli_real_escape_string($conn,$_REQUEST['goneoscopy_left']);

		$fundus_figure=mysqli_real_escape_string($conn,$_REQUEST['fundus_figure']);

		if($fundus_figure==''){

			$fundus_figure=0;

		}

		$fundus=mysqli_real_escape_string($conn,$_REQUEST['fundus']);

		$fundus_left=mysqli_real_escape_string($conn,$_REQUEST['fundus_left']);

		$keratometry_block=mysqli_real_escape_string($conn,$_REQUEST['keratometry_block']);

		if($keratometry_block==''){

			$keratometry_block=0;

		}

		$rk1=mysqli_real_escape_string($conn,$_REQUEST['rk1']);

		$rk2=mysqli_real_escape_string($conn,$_REQUEST['rk2']);

		$lk1=mysqli_real_escape_string($conn,$_REQUEST['lk1']);

		$lk2=mysqli_real_escape_string($conn,$_REQUEST['lk2']);

		$axial_length=mysqli_real_escape_string($conn,$_REQUEST['axial_length']);

		$axial_length_left=mysqli_real_escape_string($conn,$_REQUEST['axial_length_left']);

		$scotopic_pupil=mysqli_real_escape_string($conn,$_REQUEST['scotopic_pupil']);

		$scotopic_pupil_left=mysqli_real_escape_string($conn,$_REQUEST['scotopic_pupil_left']);

		$ww_diameter=mysqli_real_escape_string($conn,$_REQUEST['ww_diameter']);

		$ww_diameter_left=mysqli_real_escape_string($conn,$_REQUEST['ww_diameter_left']);

		$schirmers_test=mysqli_real_escape_string($conn,$_REQUEST['schirmers_test']);

		$schirmers_test_left=mysqli_real_escape_string($conn,$_REQUEST['schirmers_test_left']);

		$visual_fields=mysqli_real_escape_string($conn,$_REQUEST['visual_fields']);

		$visual_fields_left=mysqli_real_escape_string($conn,$_REQUEST['visual_fields_left']);

		$optical_coherence=mysqli_real_escape_string($conn,$_REQUEST['optical_coherence']);

		$optical_coherence_left=mysqli_real_escape_string($conn,$_REQUEST['optical_coherence_left']);

		$investigation=mysqli_real_escape_string($conn,$_REQUEST['investigation']);

		$diagnostic=mysqli_real_escape_string($conn,$_REQUEST['diagnostic']);

		$surgery_block=mysqli_real_escape_string($conn,$_REQUEST['surgery_block']);

		if($surgery_block==''){

			$surgery_block=0;

		}

		$surgery=mysqli_real_escape_string($conn,$_REQUEST['surgery']);		

		$pre_operative_block=mysqli_real_escape_string($conn,$_REQUEST['pre_operative_block']);

		if($pre_operative_block==''){

			$pre_operative_block=0;

		}

		$medication_block=mysqli_real_escape_string($conn,$_REQUEST['medication_block']);

		if($medication_block==''){

			$medication_block=0;

		}

		$medication=mysqli_real_escape_string($conn,$_REQUEST['medication']);

		$pre_operative=mysqli_real_escape_string($conn,$_REQUEST['pre_operative']);

		$general_instructions=mysqli_real_escape_string($conn,$_REQUEST['general_instructions']);

		$nextvisit_block=$_REQUEST['nextvisit_block'];

		if($nextvisit_block==''){

			$nextvisit_block=0;

		}

		$next_visit_day=$_REQUEST['next_visit_day'];

		if($next_visit_day==''){

			$next_visit_day=0;

		}

		$next_visit_week=$_REQUEST['next_visit_week'];

		if($next_visit_week==''){

			$next_visit_week=0;

		}

		$next_visit_month=$_REQUEST['next_visit_month'];

		if($next_visit_month==''){

			$next_visit_month=0;

		}

		$next_visit_year=$_REQUEST['next_visit_year'];

		if($next_visit_year==''){

			$next_visit_year=0;

		}

		

		$spglass_block=mysqli_real_escape_string($conn,$_REQUEST['spglass_block']);

		if($spglass_block==''){

			$spglass_block=0;

		}

		$near_cyl_r=mysqli_real_escape_string($conn,$_REQUEST['near_cyl_r']);

		$near_axis_r=mysqli_real_escape_string($conn,$_REQUEST['near_axis_r']);

		$near_cyl_l=mysqli_real_escape_string($conn,$_REQUEST['near_cyl_l']);

		$near_axis_l=mysqli_real_escape_string($conn,$_REQUEST['near_axis_l']);

		$glass_prescription=mysqli_real_escape_string($conn,$_REQUEST['glass_prescription']);

		$pinhole_od=mysqli_real_escape_string($conn,$_REQUEST['pinhole_od']);

		$pinhole_os=mysqli_real_escape_string($conn,$_REQUEST['pinhole_os']);

		$flash_od=mysqli_real_escape_string($conn,$_REQUEST['flash_od']);

		$flash_os=mysqli_real_escape_string($conn,$_REQUEST['flash_os']);

		$field_block=mysqli_real_escape_string($conn,$_REQUEST['field_block']);

		if($field_block==''){

			$field_block=0;

		}

		$roplas_right=mysqli_real_escape_string($conn,$_REQUEST['roplas_right']);

		$roplas_left=mysqli_real_escape_string($conn,$_REQUEST['roplas_left']);

		$pachymetery=mysqli_real_escape_string($conn,$_REQUEST['pachymetery']);

		$pachymetery_left=mysqli_real_escape_string($conn,$_REQUEST['pachymetery_left']);

		$iol_power=mysqli_real_escape_string($conn,$_REQUEST['iol_power']);

		$iol_power_left=mysqli_real_escape_string($conn,$_REQUEST['iol_power_left']);

		$spmedication_block=mysqli_real_escape_string($conn,$_REQUEST['spmedication_block']);

		if($spmedication_block==''){

			$spmedication_block=0;

		}

		$procedure_block=mysqli_real_escape_string($conn,$_REQUEST['procedure_block']);

		if($procedure_block==''){

			$procedure_block=0;

		}

		$procedure_comments=mysqli_real_escape_string($conn,$_REQUEST['procedure_comments']);

		$previous_medicine=mysqli_real_escape_string($conn,$_REQUEST['previous_medicine']);

		if($previous_medicine==''){

			$previous_medicine=0;

		}

		

		$dilatation=mysqli_real_escape_string($conn,$_REQUEST['dilatation']);

		if($dilatation==''){

			$dilatation=0;

		}

		$dilatation_time=mysqli_real_escape_string($conn,$_REQUEST['dilatation_time']);

		$dilatation_change=mysqli_real_escape_string($conn,$_REQUEST['dilatation_change']);

		if($dilatation_change==''){

			$dilatation_change=0;

		}

		$username77=mysqli_real_escape_string($conn,$_REQUEST['username77']);

		$send_sms=mysqli_real_escape_string($conn,$_REQUEST['send_sms']);

		$reffered_other_doc=mysqli_real_escape_string($conn,$_REQUEST['reffered_other_doc']);

		$important_visit=mysqli_real_escape_string($conn,$_REQUEST['important_visit']);

		if($important_visit==''){

			$important_visit=0;

		}

		

		$age_month=mysqli_real_escape_string($conn,$_REQUEST['age_month']);

		$age_days=mysqli_real_escape_string($conn,$_REQUEST['age_days']);

		$w_mobile=mysqli_real_escape_string($conn,$_REQUEST['w_mobile']);

		$pin=mysqli_real_escape_string($conn,$_REQUEST['pin']);

		$location2=mysqli_real_escape_string($conn,$_REQUEST['location2']);

		$history_of_present_illness=mysqli_real_escape_string($conn,$_REQUEST['history_of_present_illness']);

		$current_treatment=mysqli_real_escape_string($conn,$_REQUEST['current_treatment']);

		$conjunctiva=mysqli_real_escape_string($conn,$_REQUEST['conjunctiva']);

		$conjunctiva_left=mysqli_real_escape_string($conn,$_REQUEST['conjunctiva_left']);

		$oct_macula=mysqli_real_escape_string($conn,$_REQUEST['oct_macula']);

		$oct_macula_left=mysqli_real_escape_string($conn,$_REQUEST['oct_macula_left']);

		$color_vision_isihara=mysqli_real_escape_string($conn,$_REQUEST['color_vision_isihara']);

		$color_vision_isihara_left=mysqli_real_escape_string($conn,$_REQUEST['color_vision_isihara_left']);

		$ot_notes_block=mysqli_real_escape_string($conn,$_REQUEST['ot_notes_block']);

		if($ot_notes_block==''){

					$ot_notes_block=0;

		}

		$ot_notes=mysqli_real_escape_string($conn,$_REQUEST['ot_notes']);

		$flash_cly_od=mysqli_real_escape_string($conn,$_REQUEST['flash_cly_od']);

		$flash_axis_od=mysqli_real_escape_string($conn,$_REQUEST['flash_axis_od']);

		$flash_cyl_os=mysqli_real_escape_string($conn,$_REQUEST['flash_cyl_os']);

		$flash_axis_os=mysqli_real_escape_string($conn,$_REQUEST['flash_axis_os']);

		

		$certificate=mysqli_real_escape_string($conn,$_REQUEST['certificate']);

		$reffered_to_doc=mysqli_real_escape_string($conn,$_REQUEST['reffered_to_doc']);

		$no_dialation=mysqli_real_escape_string($conn,$_REQUEST['no_dialation']);

		if($no_dialation==''){

			$no_dialation=0;

		}

		$no_dialation_reason=mysqli_real_escape_string($conn,$_REQUEST['no_dialation_reason']);

		$primary_doctor=mysqli_real_escape_string($conn,$_REQUEST['primary_doctor']);

		$signed_by_doctor=mysqli_real_escape_string($conn,$_REQUEST['signed_by_doctor']);

		$patient_id=mysqli_real_escape_string($conn,$_REQUEST['patient_id']);
		
		$pr_left=mysqli_real_escape_string($conn,$_REQUEST['pr_left']);
		$pr_right=mysqli_real_escape_string($conn,$_REQUEST['pr_right']);

		$patient_related_countiop=mysqli_real_escape_string($conn,$_POST['patient_related_countiop']);  //IOP
		$patient_related_remove_id=mysqli_real_escape_string($conn,$_POST['patient_related_remove_id']); 
		
		
		$eom_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['eom_checkbox_check']);
		if($eom_checkbox_check==''){
			$eom_checkbox_check=0;
		}
		$pupils_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['pupils_checkbox_check']);
		if($pupils_checkbox_check==''){
			$pupils_checkbox_check=0;
		}
		$lid_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['lid_checkbox_check']);
		if($lid_checkbox_check==''){
			$lid_checkbox_check=0;
		}
		$conjunctiva_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['conjunctiva_checkbox_check']);
		if($conjunctiva_checkbox_check==''){
			$conjunctiva_checkbox_check=0;
		}
		
		$mb_ocular_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['mb_ocular_checkbox_check']);
		if($mb_ocular_checkbox_check==''){
			$mb_ocular_checkbox_check=0;
		}
        
        $cornea_ocular_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['cornea_ocular_checkbox_check']);
		if($cornea_ocular_checkbox_check==''){
			$cornea_ocular_checkbox_check=0;
		}
        
        $iris_ocular_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['iris_ocular_checkbox_check']);
		if($iris_ocular_checkbox_check==''){
			$iris_ocular_checkbox_check=0;
		}
        
        $ac_ocular_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['ac_ocular_checkbox_check']);
		if($ac_ocular_checkbox_check==''){
			$ac_ocular_checkbox_check=0;
		}
        
        $lens_ocular_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['lens_ocular_checkbox_check']);
		if($lens_ocular_checkbox_check==''){
			$lens_ocular_checkbox_check=0;
		}
        
        $vitreous_ocular_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['vitreous_ocular_checkbox_check']);
		if($vitreous_ocular_checkbox_check==''){
			$vitreous_ocular_checkbox_check=0;
		}
        
        $retina_ocular_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['retina_ocular_checkbox_check']);
		if($retina_ocular_checkbox_check==''){
			$retina_ocular_checkbox_check=0;
		}
        
        $onh_ocular_checkbox_check=mysqli_real_escape_string($conn,$_REQUEST['onh_ocular_checkbox_check']);
		if($onh_ocular_checkbox_check==''){
			$onh_ocular_checkbox_check=0;
		}
		
		$mb_ocular=mysqli_real_escape_string($conn,$_REQUEST['mb_ocular']);
		$mb_ocular_left=mysqli_real_escape_string($conn,$_REQUEST['mb_ocular_left']);
		$cornea_ocular=mysqli_real_escape_string($conn,$_REQUEST['cornea_ocular']);
		$cornea_ocular_left=mysqli_real_escape_string($conn,$_REQUEST['cornea_ocular_left']);
		$iris_ocular=mysqli_real_escape_string($conn,$_REQUEST['iris_ocular']);
		$iris_ocular_left=mysqli_real_escape_string($conn,$_REQUEST['iris_ocular_left']);
		$ac_ocular=mysqli_real_escape_string($conn,$_REQUEST['ac_ocular']);
		$ac_ocular_left=mysqli_real_escape_string($conn,$_REQUEST['ac_ocular_left']);
		$lens_ocular=mysqli_real_escape_string($conn,$_REQUEST['lens_ocular']);
		$lens_ocular_left=mysqli_real_escape_string($conn,$_REQUEST['lens_ocular_left']);
		$vitreous_ocular=mysqli_real_escape_string($conn,$_REQUEST['vitreous_ocular']);
		$vitreous_ocular_left=mysqli_real_escape_string($conn,$_REQUEST['vitreous_ocular_left']);
		$retina_ocular=mysqli_real_escape_string($conn,$_REQUEST['retina_ocular']);
		$retina_ocular_left=mysqli_real_escape_string($conn,$_REQUEST['retina_ocular_left']);
		$onh_ocular=mysqli_real_escape_string($conn,$_REQUEST['onh_ocular']);
		$onh_ocular_left=mysqli_real_escape_string($conn,$_REQUEST['onh_ocular_left']);
	
		$dv_glasses_left=mysqli_real_escape_string($conn,$_REQUEST['dv_glasses_left']);
		$remarks_pres=mysqli_real_escape_string($conn,$_REQUEST['remarks_pres']);

		$count_miscellaneous_eye_test=mysqli_real_escape_string($conn,$_REQUEST['count_miscellaneous_eye_test']);
		$remove_id_for_miscellaneous_eye_test=mysqli_real_escape_string($conn,$_REQUEST['remove_id_for_miscellaneous_eye_test']);
		$location_print=mysqli_real_escape_string($conn,$_REQUEST['location_print']);
		if($location_print==''){
			$location_print=0;
		}
		$tears_outflow_system=mysqli_real_escape_string($conn,$_REQUEST['tears_outflow_system']);
		$tears_outflow_system_right=mysqli_real_escape_string($conn,$_REQUEST['tears_outflow_system_right']);
		$iridotomy_left=mysqli_real_escape_string($conn,$_REQUEST['iridotomy_left']);
		$iridotomy_right=mysqli_real_escape_string($conn,$_REQUEST['iridotomy_right']);
		$explained_surgery_textarea=mysqli_real_escape_string($conn,$_REQUEST['explained_surgery_textarea']);
		$old_system_mrd=mysqli_real_escape_string($conn,$_REQUEST['old_system_mrd']);

	 $sql = "UPDATE `prescription_details_for_emr` SET `created_on`='".$created_on."',`doctor_id`='".$doctor_id."',`patients_key_notes`='".$patients_key_notes."',`prefix` ='".$prefix."',`fname`='".$fname."',`lname`='".$lname."',`dob`=".$dob.",`age`='".$age."',`religion`='".$religion."',`mobile`='".$mobile."',`email`='".$email."',`guardian_name`='".$guardian_name."',`address`='".$address."',`purpose_visit_id`='".$purpose_visit_id."',`chief_complaints_history`='".$chief_complaints_history."',`past_ocular_history`='".$past_ocular_history."',`general_health`='".$general_health."',`family_history`='".$family_history."' ,`allergy_history`='".$allergy_history."',`pgp_block`='".$pgp_block."',`pgp`='".$pgp."',`sph_od`='".$sph_od."',`sph_add`='".$sph_add."',`cly_od`='".$cly_od."',`axis_od`='".$axis_od."',`sph_os`='".$sph_os."',`cyl_os`='".$cyl_os."',`axis_os`='".$axis_os."',`add_os`='".$add_os."',`ocular_block`='".$ocular_block."',`dv_glasses`='".$dv_glasses."',`dv_od`='".$dv_od."',`nv_od`='".$nv_od."',`dv_os`='".$dv_os."',`nv_os`='".$nv_os."',`glass_block`='".$glass_block."',`distance_sph_r`='".$distance_sph_r."',`distance_cyl_r`='".$distance_cyl_r."',`distance_axis_r`='".$distance_axis_r."',`distance_va_r`='".$distance_va_r."',`distance_sph_l`='".$distance_sph_l."',`distance_cyl_l`='".$distance_cyl_l."',`distance_axis_l`='".$distance_axis_l."',`distance_va_l`='".$distance_va_l."',`near_sph_r`='".$near_sph_r."',`near_va_r`='".$near_va_r."',`near_sph_l`='".$near_sph_l."',`near_va_l`='".$near_va_l."',`cover_test_select`='".$cover_test_select."',`cover_test_text`='".$cover_test_text."',`EOM`='".$EOM."',`EOM_left`='".$EOM_left."',`pupils`='".$pupils."',`pupils_left`='".$pupils_left."',`lid_adnexa`='".$lid_adnexa."',`lid_adnexa_left`='".$lid_adnexa_left."',`anterior_chamber`='".$anterior_chamber."',`anterior_chamber_left`='".$anterior_chamber_left."',`anterior_figure`='".$anterior_figure."',`anterior_segment`='".$anterior_segment."',`anterior_left_segment`='".$anterior_left_segment."',`misc_findings`='".$misc_findings."',`misc_findings_left`='".$misc_findings_left."',`goneoscopy`='".$goneoscopy."',`goneoscopy_left`='".$goneoscopy_left."',`fundus_figure`='".$fundus_figure."',`fundus`='".$fundus."',`fundus_left`='".$fundus_left."',`keratometry_block`='".$keratometry_block."',`rk1`='".$rk1."',`rk2`='".$rk2."',`lk1`='".$lk1."',`lk2`='".$lk2."',`axial_length`='".$axial_length."',`axial_length_left`='".$axial_length_left."',`scotopic_pupil`='".$scotopic_pupil."',`scotopic_pupil_left`='".$scotopic_pupil_left."',`ww_diameter`='".$ww_diameter."',`ww_diameter_left`='".$ww_diameter_left."',`schirmers_test`='".$schirmers_test."',`schirmers_test_left`='".$schirmers_test_left."',`visual_fields`='".$visual_fields."',`visual_fields_left`='".$visual_fields_left."',`optical_coherence`='".$optical_coherence."',`optical_coherence_left`='".$optical_coherence_left."',`investigation`='".$investigation."',`diagnostic`='".$diagnostic."',`surgery_block`='".$surgery_block."',`surgery`='".$surgery."',`medication_block`='".$medication_block."',`medication`='".$medication."',`pre_operative_block`='".$pre_operative_block."',`pre_operative`='".$pre_operative."',`general_instructions`='".$general_instructions."',`nextvisit_block`='".$nextvisit_block."',`next_visit_day`='".$next_visit_day."',`next_visit_week`='".$next_visit_week."',`next_visit_month`='".$next_visit_month."',`next_visit_year`='".$next_visit_year."',`spglass_block`='".$spglass_block."',`near_cyl_r`='".$near_cyl_r."',`near_axis_r`='".$near_axis_r."',`near_cyl_l`='".$near_cyl_l."',`near_axis_l`='".$near_axis_l."',`glass_prescription`='".$glass_prescription."',`pinhole_od`='".$pinhole_od."',`pinhole_os`='".$pinhole_os."',`flash_od`='".$flash_od."',`flash_os`='".$flash_os."',`field_block`='".$field_block."',`roplas_right`='".$roplas_right."',`roplas_left`='".$roplas_left."',`pachymetery`='".$pachymetery."',`pachymetery_left`='".$pachymetery_left."',`iol_power`='".$iol_power."',`iol_power_left`='".$iol_power_left."',`spmedication_block`='".$spmedication_block."',`procedure_block`='".$procedure_block."',`procedure_comments`='".$procedure_comments."',`previous_medicine`='".$previous_medicine."',`dilatation`='".$dilatation."',`dilatation_change`='".$dilatation_change."',`username77`='".$username77."',`temp_save`='".$temp_save."',`reffered_other_doc`='".$reffered_other_doc."' ,`important_visit`='".$important_visit."',`age_month`='".$age_month."',`age_days`='".$age_days."' ,`w_mobile`='".$w_mobile."',`pin`='".$pin."',`location2`='".$location2."',`history_of_present_illness`='".$history_of_present_illness."',`current_treatment`='".$current_treatment."',`conjunctiva`='".$conjunctiva."',`conjunctiva_left`='".$conjunctiva_left."',`oct_macula`='".$oct_macula."',`oct_macula_left`='".$oct_macula_left."',`color_vision_isihara`='".$color_vision_isihara."',`color_vision_isihara_left`='".$color_vision_isihara_left."',`ot_notes_block`='".$ot_notes_block."',`ot_notes`='".$ot_notes."',`flash_cly_od`='".$flash_cly_od."',`flash_axis_od`='".$flash_axis_od."',`flash_cyl_os`='".$flash_cyl_os."',`flash_axis_os`='".$flash_axis_os."',`certificate`='".$certificate."',`no_dialation`='".$no_dialation."',`no_dialation_reason`='".$no_dialation_reason."',`signed_by_doctor`='".$signed_by_doctor."',`primary_doctor`='".$primary_doctor."',`pr_left`='".$pr_left."',`pr_right`='".$pr_right."',`eom_checkbox_check`='".$eom_checkbox_check."',`pupils_checkbox_check`='".$pupils_checkbox_check."',`lid_checkbox_check`='".$lid_checkbox_check."',`conjunctiva_checkbox_check`='".$conjunctiva_checkbox_check."',`mb_ocular_checkbox_check`='".$mb_ocular_checkbox_check."',`mb_ocular`='".$mb_ocular."',`mb_ocular_left`='".$mb_ocular_left."',`cornea_ocular_checkbox_check`='".$cornea_ocular_checkbox_check."',`cornea_ocular`='".$cornea_ocular."',`cornea_ocular_left`='".$cornea_ocular_left."',`iris_ocular_checkbox_check`='".$iris_ocular_checkbox_check."',`iris_ocular`='".$iris_ocular."',`iris_ocular_left`='".$iris_ocular_left."',`ac_ocular_checkbox_check`='".$ac_ocular_checkbox_check."',`ac_ocular`='".$ac_ocular."',`ac_ocular_left`='".$ac_ocular_left."',`lens_ocular_checkbox_check`='".$lens_ocular_checkbox_check."',`lens_ocular`='".$lens_ocular."',`lens_ocular_left`='".$lens_ocular_left."',`vitreous_ocular_checkbox_check`='".$vitreous_ocular_checkbox_check."',`vitreous_ocular`='".$vitreous_ocular."',`vitreous_ocular_left`='".$vitreous_ocular_left."',`retina_ocular_checkbox_check`='".$retina_ocular_checkbox_check."',`retina_ocular`='".$retina_ocular."',`retina_ocular_left`='".$retina_ocular_left."',`onh_ocular_checkbox_check`='".$onh_ocular_checkbox_check."',`onh_ocular`='".$onh_ocular."',`onh_ocular_left`='".$onh_ocular_left."',`dv_glasses_left`='".$dv_glasses_left."',`remarks_pres`='".$remarks_pres."' ,`location_print`='".$location_print."' ,`tears_outflow_system`='".$tears_outflow_system."',`tears_outflow_system_right`='".$tears_outflow_system_right."' ,`iridotomy_left`='".$iridotomy_left."',`iridotomy_right`='".$iridotomy_right."' ,`explained_surgery_textarea`='".$explained_surgery_textarea."',`old_system_mrd`='".$old_system_mrd."'  WHERE `id`='".$id."'";
		if($conn->query($sql)===TRUE)

		{

		$msg="Record updated successfully";

		$flg=0;		

		
		if($dilatation_time!=''){

			$sql12 = $conn->query("UPDATE `prescription_details_for_emr` SET `dilatation_time` = '".$dilatation_time."' WHERE `id`='".$id."' ");	

		}

		//iop Entry When Edit Mode	

		$countiop=mysqli_real_escape_string($conn,$_REQUEST['countiop']);		

		$remove_id_for_at_details=mysqli_real_escape_string($conn,$_REQUEST['remove_id_for_at_details']);		

		for($i=1;$i<=$countiop;$i++) {		

			if($_REQUEST['at_select'.$i]!='')		

			{		

					if($_REQUEST['at_flag'.$i]!='1')		

					{		

					$sql4 = $conn->query("INSERT INTO `at_details_for_emr` SET `prescription_id`='".$id."',`at_select`='".$_REQUEST['at_select'.$i]."',`at_flag`='1',`at_time`='".$_REQUEST['at_time'.$i]."',`at_od`='".$_REQUEST['at_od'.$i]."',`at_os`='".$_REQUEST['at_os'.$i]."'");		

					}		

					if($_REQUEST['at_flag'.$i]=='1')		

					{		

					$sql4 = $conn->query("update `at_details_for_emr` SET `prescription_id`='".$id."', `at_select`='".$_REQUEST['at_select'.$i]."', `at_flag`='1',`at_time`='".$_REQUEST['at_time'.$i]."',`at_od`='".$_REQUEST['at_od'.$i]."',`at_os`='".$_REQUEST['at_os'.$i]."' where `id`='".$_REQUEST['at_insert_id'.$i]."'");		

					}		

			} 		

		}		

		if($remove_id_for_at_details!='')		

		{		

			$remove_id_array=explode(":",$remove_id_for_at_details);		

			//print_r($remove_id_array);		

			$itemCount = sizeof($remove_id_array);		

			//exit;		

			for($i=0;$i<($itemCount-1);$i++) {		

			$sql4 = $conn->query("UPDATE `at_details_for_emr` SET `del_flag` = '1' WHERE `id`='".$remove_id_array[$i]."' ");		

			}		

		}
			

		$today=date('Y-m-d H:i:s');

		$created_by=$_SESSION['id'];

		$count_additional_optom=mysqli_real_escape_string($conn,$_REQUEST['count_additional_optom']);

		$remove_id_for_additional_optom=mysqli_real_escape_string($conn,$_REQUEST['remove_id_for_additional_optom']);	

		for($i=1;$i<=$count_additional_optom;$i++) {

			 if($_REQUEST['additional_optom_id'.$i]!=''){

					if($_REQUEST['additional_optom_flag'.$i]!='1'){

						$sql4 = $conn->query("INSERT INTO `additional_optom_for_prescription_for_emr` SET `prescription_id`='".$id."',`additional_optom_id`='".$_REQUEST['additional_optom_id'.$i]."',`additional_optom_flag`='1', `created_by`='".$created_by."', `created_on`='".$today."'");

					}

					if($_REQUEST['additional_optom_flag'.$i]=='1'){	

						$sql4 = $conn->query("update `additional_optom_for_prescription_for_emr` SET `prescription_id`='".$id."', `additional_optom_id`='".$_REQUEST['additional_optom_id'.$i]."', `additional_optom_flag`='1', `modified_by`='".$created_by."', `modified_time`='".$today."' where `id`='".$_REQUEST['additional_optom_insert_id'.$i]."'");

					}

				} 

		}

		if($remove_id_for_additional_optom!='')

		{

			 $remove_id_array=explode(":",$remove_id_for_additional_optom);

			 //print_r($remove_id_array);

			 $itemCount = sizeof($remove_id_array);

			 //exit;

			 for($i=0;$i<($itemCount-1);$i++) {

			 	 $sql4 = $conn->query("UPDATE `additional_optom_for_prescription_for_emr` SET `del_flag` = '1', `deleted_time`='".$today."' , `deleted_by`='".$created_by."' WHERE `id`='".$remove_id_array[$i]."' ");

			 }	

		 }
		 
		 
		 for($i=1;$i<=$count_miscellaneous_eye_test;$i++) {

			 if($_REQUEST['misc_eye_test_select'.$i]!=''){

					if($_REQUEST['misc_eye_test_flag'.$i]!='1'){

						$sql4 = $conn->query("INSERT INTO `miscellaneous_eye_test_for_emr` SET `prescription_id`='".$id."',`misc_eye_test_select`='".$_REQUEST['misc_eye_test_select'.$i]."',`misc_eye_test_flag`='1' ,`misc_eye_test_od`='".$_REQUEST['misc_eye_test_od'.$i]."',`misc_eye_test_os`='".$_REQUEST['misc_eye_test_os'.$i]."' ");

					}

					if($_REQUEST['misc_eye_test_flag'.$i]=='1'){	

						$sql4 = $conn->query("update `miscellaneous_eye_test_for_emr` SET `prescription_id`='".$id."',`misc_eye_test_select`='".$_REQUEST['misc_eye_test_select'.$i]."',`misc_eye_test_flag`='1' ,`misc_eye_test_od`='".$_REQUEST['misc_eye_test_od'.$i]."',`misc_eye_test_os`='".$_REQUEST['misc_eye_test_os'.$i]."' where `id`='".$_REQUEST['misc_eye_test_insert_id'.$i]."'");

					}

				} 

		}

		if($remove_id_for_miscellaneous_eye_test!='')

		{

			 $remove_id_array=explode(":",$remove_id_for_miscellaneous_eye_test);

			 //print_r($remove_id_array);

			 $itemCount = sizeof($remove_id_array);

			 //exit;

			 for($i=0;$i<($itemCount-1);$i++) {

			 	 $sql4 = $conn->query("UPDATE `miscellaneous_eye_test_for_emr` SET `del_flag` = '1' WHERE `id`='".$remove_id_array[$i]."' ");

			 }	

		 }

		

		$sql3 = "DELETE FROM `reffered_to_for_emr` WHERE `prescription_id`='".$id."'";

		$result3=$conn->query($sql3);

		//Reffered To Doc Entry When Edit Mode		

		

		 if($reffered_to_doc!='')

		   {

			  $sql4 = $conn->query("INSERT INTO `reffered_to_for_emr` SET `prescription_id` = '".$id."',`reffered_to_doc` = '".$reffered_to_doc."',`mrd_no` = '".$mrd."'");

		   }  

		////Edit Mode
		
		
		
 for($i=1;$i<=$patient_related_countiop;$i++) {

	 if($_REQUEST['patient_related_document_name'.$i]!='')

		   {

			   if($_REQUEST['patient_related_document_flag'.$i]!='1')

		   {

			   

			   if(!empty($_FILES["patient_related_document_upload".$i]["name"]))

				{

				//New Added extension	

					$file_ext=strtolower(end(explode('.',$_FILES["patient_related_document_upload".$i]["name"]))); 

					$sql_ext="SELECT `file_extension_name` FROM `file_format_extension`   ORDER BY `file_extension_name` ASC";

					$result_ext=$conn->query($sql_ext) ;

					$count_ext=$result_ext->num_rows;

					$loop_initial=1;

					$file_extension_name="";		

					while ($row_ext=mysqli_fetch_array($result_ext,MYSQLI_ASSOC))

					{

						 $file_extension_name=$file_extension_name.''.$row_ext['file_extension_name'].'';if($loop_initial<($count_ext)){ $file_extension_name=$file_extension_name. ','; }

						 $loop_initial++;

					}		

					$string = $file_extension_name;

					$expensions = explode(",",$string);		

					if(in_array($file_ext,$expensions)=== false){

						 //$errors[]="extension not allowed, please choose a JPEG or PNG file.";

						 $patient_related_document_upload='';

						 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";

					  }else{ //New Added extension	

				

						$rand8=rand(1,999999);

						$target_dir8 = "upload/patient_related_document_upload/";

						$patient_related_document_upload =$rand8.basename($_FILES["patient_related_document_upload".$i]["name"]);

						if(move_uploaded_file($_FILES["patient_related_document_upload".$i]["tmp_name"],  $target_dir8 .$patient_related_document_upload)) 

						{

						$msg2="The file ". basename( $_FILES["patient_related_document_upload".$i]["name"]). " has been uploaded.";

						} 

						else

						{

						$patient_related_document_upload=$_REQUEST['patient_related_document_upload'.$i];

						}

					 }//New Added extension

				}			

				else			

				{			

				$patient_related_document_upload=$_REQUEST['patient_related_document_upload'.$i];			

				}

			  
				if($patient_related_document_upload!=''){
				
			  $sql4 = $conn->query("INSERT INTO `patient_related_document_for_emr` SET `prescription_id`='".$id."',`patient_related_document_name` = '".$_REQUEST['patient_related_document_name'.$i]."',`patient_related_document_flag` = '1', `created_on`='".$today."' , `created_by`='".$created_by."',`patient_related_document_upload` = '".$patient_related_document_upload."'");
		  		 }

		   }

		   }   

   		}

		for($i=1;$i<=$patient_related_countiop;$i++) {

	 if($_REQUEST['patient_related_document_name'.$i]!='')

		   {

			   if($_REQUEST['patient_related_document_flag'.$i]=='1')

		   {

			    if(!empty($_FILES["patient_related_document_upload".$i]["name"]))

				{

					//New Added extension	

					$file_ext=strtolower(end(explode('.',$_FILES["patient_related_document_upload".$i]["name"]))); 

					$sql_ext="SELECT `file_extension_name` FROM `file_format_extension`   ORDER BY `file_extension_name` ASC";

					$result_ext=$conn->query($sql_ext) ;

					$count_ext=$result_ext->num_rows;

					$loop_initial=1;

					$file_extension_name="";		

					while ($row_ext=mysqli_fetch_array($result_ext,MYSQLI_ASSOC))

					{

						 $file_extension_name=$file_extension_name.''.$row_ext['file_extension_name'].'';if($loop_initial<($count_ext)){ $file_extension_name=$file_extension_name. ','; }

						 $loop_initial++;

					}		

					$string = $file_extension_name;

					$expensions = explode(",",$string);		

					if(in_array($file_ext,$expensions)=== false){

						 //$errors[]="extension not allowed, please choose a JPEG or PNG file.";

						 $patient_related_document_upload='';

						 echo "<script type=\"text/javascript\"> alert('extension not allowed, please choose correct file type!!!'); </script>";

					  }else{ //New Added extension	

					

						$rand8=rand(1,999999);

						$target_dir8 = "upload/patient_related_document_upload/";

						$patient_related_document_upload =$rand8.basename($_FILES["patient_related_document_upload".$i]["name"]);

						if(move_uploaded_file($_FILES["patient_related_document_upload".$i]["tmp_name"],  $target_dir8 .$patient_related_document_upload)) 
						{

						$msg2="The file ". basename( $_FILES["patient_related_document_upload".$i]["name"]). " has been uploaded.";

						} 

						else

						{

						$patient_related_document_upload=$_REQUEST['patient_related_document_upload'.$i];

						}

					 }//New Added extension	

				}			

				else			

				{			

				$patient_related_document_upload=$_REQUEST['patient_related_document_upload'.$i];			

				}

				if($patient_related_document_upload!=''){

			  $sql4 = $conn->query("UPDATE `patient_related_document_for_emr` SET `prescription_id`='".$id."',`patient_related_document_name` = '".$_REQUEST['patient_related_document_name'.$i]."',`patient_related_document_flag` = '1',`patient_related_document_upload` = '".$patient_related_document_upload."', `modified_time`='".$today."' , `modified_by`='".$created_by."' WHERE `id`='".$_REQUEST['patient_related_id'.$i]."' ");
			  
				}

		   }

		   }   

   		}

		   if($patient_related_remove_id!='')

		   {

			    $patient_related_remove_id_array=explode(":",$patient_related_remove_id);

			   //print_r($remove_id_array);

			    $itemCount = sizeof($patient_related_remove_id_array);

			   //exit;

			   for($i=0;$i<($itemCount-1);$i++) {

			 	 $sql4 = $conn->query("UPDATE `patient_related_document_for_emr` SET `del_flag` = '1', `deleted_time`='".$today."' , `deleted_by`='".$created_by."' WHERE `id`='".$patient_related_remove_id_array[$i]."' ");

			   }

			   

		   }

		

		

		 $prescription_id = $id;
		if(isset($_REQUEST['submit'])){
			$redirectUrlPrint=ADMIN_URL.'printPrescription_for_emr.php?id='.$prescription_id;

			 $redirectUrl=ADMIN_URL.'dashboard_for_emr.php?msg='.$msg.'&flg='.$flg;

			echo "<script type=\"text/javascript\"> window.open('$redirectUrlPrint', '_blank'); window.location.href='$redirectUrl'; </script>";	
		}else if(isset($_REQUEST['submit_sms'])){	
		
				$sms_msg_patient_name=$fname.' '.$lname;
				$sms_msg_patient_wp_no=$mobile;
				$sms_msg_patient_mrd=$mrd;
				$sms_msg_patient_id=$prescription_id;
				$sms_msg_primary_doctor=$primary_doctor;
				
				$return_flag=0;
				$arr=array();
				
				$user_name='sunetraapi';
				$password='sms@2025';
				$sms_sent_no='91'.$sms_msg_patient_wp_no;
				$sms_from='SNETRA';
				
				$text = "Dear $sms_msg_patient_name, Get your prescription from ".ADMIN_URL."printPrescription_for_emr.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
				//$text = "Dear $sms_msg_patient_name, Get your prescription from https://www.sunetrafecc.org/hms/printPrescription_for_emr.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
			
				$encoded_text = rawurlencode($text);
			
				$url_wp_send = "https://103.229.250.200/smpp/sendsms?username=$user_name&password=$password&to=$sms_sent_no&from=$sms_from&text=" . $encoded_text;
				
				
				// Initialize cURL session
				$crl_wp_send = curl_init();	
				// Set the URL option
				curl_setopt($crl_wp_send, CURLOPT_URL, $url_wp_send);	
				// Set to return the response as a string instead of outputting it directly
				curl_setopt($crl_wp_send, CURLOPT_RETURNTRANSFER, true);	
				// Set to true to get a fresh connection each time, avoiding issues with cached connections
				curl_setopt($crl_wp_send, CURLOPT_FRESH_CONNECT, true);	
				// Optionally, fail on HTTP errors
				curl_setopt($crl_wp_send, CURLOPT_FAILONERROR, true);	
				// Execute the cURL request
				$response_wp_send = curl_exec($crl_wp_send);	
				// Check for cURL errors
				if (curl_errno($crl_wp_send)) {
					//die('cURL Error: ' . curl_error($crl) . ' - Code: ' . curl_errno($crl));
					$returnVal=0;
				} else {
					$returnVal=1;
				}
				
				// Display the response
				//var_dump($response);
				//echo($response);	
				// Close the cURL session
				curl_close($crl_wp_send);
				if($returnVal==1){
				$sql12 = $conn->query("INSERT INTO  `sms_logs_for_emr` SET `mrd_no` = '".$sms_msg_patient_mrd."',`sms_type` = '1',`sms_status` = '1',`log_date` = '".date("Y-m-d H:i:s")."',`reciepent`= '".$sms_msg_patient_wp_no."',`prescription_id` = '".$sms_msg_patient_id."',`doc_id` = '".$sms_msg_primary_doctor."',`sms_body_sent` = '".$url_wp_send."' ");
				
				$return_flag=1;
				}

			 $redirectUrl=ADMIN_URL.'dashboard_for_emr.php?msg='.$msg.'&flg='.$flg;

			echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";	
		}else if(isset($_REQUEST['submit_sms_n_print'])){	
		
				$sms_msg_patient_name=$fname.' '.$lname;
				$sms_msg_patient_wp_no=$mobile;
				$sms_msg_patient_mrd=$mrd;
				$sms_msg_patient_id=$prescription_id;
				$sms_msg_primary_doctor=$primary_doctor;
				
				$return_flag=0;
				$arr=array();
				
				$user_name='sunetraapi';
				$password='sms@2025';
				$sms_sent_no='91'.$sms_msg_patient_wp_no;
				$sms_from='SNETRA';
				
				$text = "Dear $sms_msg_patient_name, Get your prescription from ".ADMIN_URL."printPrescription_for_emr.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
				//$text = "Dear $sms_msg_patient_name, Get your prescription from https://www.sunetrafecc.org/hms/printPrescription_for_emr.php?ptflag=1&id=$sms_msg_patient_id. Thanks Sunetra";
			
				$encoded_text = rawurlencode($text);
			
				$url_wp_send = "https://103.229.250.200/smpp/sendsms?username=$user_name&password=$password&to=$sms_sent_no&from=$sms_from&text=" . $encoded_text;
				
				
				// Initialize cURL session
				$crl_wp_send = curl_init();	
				// Set the URL option
				curl_setopt($crl_wp_send, CURLOPT_URL, $url_wp_send);	
				// Set to return the response as a string instead of outputting it directly
				curl_setopt($crl_wp_send, CURLOPT_RETURNTRANSFER, true);	
				// Set to true to get a fresh connection each time, avoiding issues with cached connections
				curl_setopt($crl_wp_send, CURLOPT_FRESH_CONNECT, true);	
				// Optionally, fail on HTTP errors
				curl_setopt($crl_wp_send, CURLOPT_FAILONERROR, true);	
				// Execute the cURL request
				$response_wp_send = curl_exec($crl_wp_send);	
				// Check for cURL errors
				if (curl_errno($crl_wp_send)) {
					//die('cURL Error: ' . curl_error($crl) . ' - Code: ' . curl_errno($crl));
					$returnVal=0;
				} else {
					$returnVal=1;
				}
				
				// Display the response
				//var_dump($response);
				//echo($response);	
				// Close the cURL session
				curl_close($crl_wp_send);
				if($returnVal==1){
				$sql12 = $conn->query("INSERT INTO  `sms_logs_for_emr` SET `mrd_no` = '".$sms_msg_patient_mrd."',`sms_type` = '1',`sms_status` = '1',`log_date` = '".date("Y-m-d H:i:s")."',`reciepent`= '".$sms_msg_patient_wp_no."',`prescription_id` = '".$sms_msg_patient_id."',`doc_id` = '".$sms_msg_primary_doctor."',`sms_body_sent` = '".$url_wp_send."' ");
				
				$return_flag=1;
				}
				
				$redirectUrlPrint=ADMIN_URL.'printPrescription_for_emr.php?id='.$prescription_id;

			 $redirectUrl=ADMIN_URL.'dashboard_for_emr.php?msg='.$msg.'&flg='.$flg;

			echo "<script type=\"text/javascript\">window.open('$redirectUrlPrint', '_blank');   window.location.href='$redirectUrl'; </script>";	
		}
		else{

			 $redirectUrl=ADMIN_URL.'dashboard_for_emr.php?msg='.$msg.'&flg='.$flg;

			echo "<script type=\"text/javascript\">window.location.href='$redirectUrl'; </script>";

		}				

		}

		else

		{

			$flg=1;

			$msg="Error:".$sql."<br>".$conn->error;

			$redirectUrl=ADMIN_URL.'dashboard_for_emr.php?msg='.$msg.'&flg='.$flg;

			echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";

		}

}?>
<?php include "header.php"; ?>
<link href="select2/select2.css" rel="stylesheet" />
<style>
[data-id="chief"] {
 max-width: 630px !important;
}
 [data-id="past_ocular"] {
 max-width: 390px !important;
}
 [data-id="general_hlth"] {
 max-width: 390px !important;
}
 [data-id="investigation_list"] {
 max-width: 290px !important;
}
 [data-id="surgery_select"] {
 max-width: 290px !important;
}
 [data-id="surgPackageSelect"] {
 max-width: 290px !important;
}
 [data-id="glassPrescription_select"] {
 max-width: 630px !important;
}
 [data-id="general_instructions_list_slct"] {
 max-width: 1030px !important;
}
 [data-id="diagnosticSearch"] {
 max-width: 1030px !important;
}
#s2id_autogen1 {
	width: 180px !important;
}
#s2id_medi {
	width: 320px !important;
}
</style>
<style>
.control-label {
	color: white !important;
	font-weight:bold !important;
}
.portlet-body > label {
	color: white !important;
	font-weight:bold !important;
}
.portlet-body .row {
	background:#375A90 !important;
	font-weight:bold !important;
}
.portlet.light {
	background:#375A90 !important;
	font-weight:bold !important;
}
.footer-block {
	background: transparent !important;
	font-weight:bold !important;
}
.font-white-sharp {
	color: white !important;
	font-weight:bold !important;
}
.font-black-sharp {
	color: white !important;
	font-weight:bold !important;
}
</style>
<style>
#span_title {
	color:#ffffff;
	font-weight:bold;
	text-transform:uppercase;
	font-size:16px;
	display: list-item;
	margin-left : 1em;
}
th {
	font-weight:bold !important;
}
#add_more {
	font-weight:bold !important;
	font-size:16px;
	color: #eef7e9;
}
.close_stock_span {
	font-weight:bold;
	color:#933;
}
#msg_sent {
	font-size:14px !important;
	font-weight:bold !important;
	padding:6px !important;
	text-align:center;
}
textarea, select, input {
	width: auto 100%;
	padding: 2px;
	font-size:9pt !important;
}
.form-control {
	width:100% !important
}
.col-md-12 {
	width:1600px;
}
body{
	background:#375a90
}
</style>

<!-- BEGIN PAGE CONTAINER -->

<div class="page-container"> 
  
  <!-- BEGIN PAGE HEAD -->
  
  <div class="page-head">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE TITLE -->
      
      <div class="page-title">
        <h1><small>Welcome to Electronic Medical Records System</small></h1>
        <ul class="page-breadcrumb breadcrumb">
          <li> <a href="#">Home</a><i class="fa fa-circle"></i> </li>
          <li class="active"> Manage </li>
        </ul>
      </div>
      
      <!-- END PAGE TITLE --> 
      
    </div>
  </div>
  
  <!-- END PAGE HEAD --> 
  
  <!-- BEGIN PAGE CONTENT -->
  
  <div class="page-content">
    <div class="container-fluid"> 
      
      <!-- BEGIN PAGE CONTENT INNER -->
      
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-white-sharp"></i> <span class="caption-subject font-white-sharp bold uppercase">PATIENT PRESCRIPTION</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <?php

			 $sql="SELECT * FROM `prescription_details_for_emr` WHERE `id`= '" .$_REQUEST['id']. "'";

				 $result=$conn->query($sql) ;

				 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))

				 {

			  ?>
              
              <!-- BEGIN FORM-->
              
              <form action="" method="post" enctype="multipart/form-data" class="horizontal-form">
                <div class="row number-stats">
                  <div class="col-md-12 col-sm-12 col-xs-12 blink_me" style="border:none !important; text-align:center;font-size:16px;font-weight:bolder;color:#ebec65;">
                    <marquee>
                    <strong><?php echo $row['patients_key_notes'];?></strong>
                    </marquee>
                    <br>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important; text-align:center;font-size:16px;font-weight:bolder;color: #feeaff;"> <!--<a href="javascript:;" id="basic_fetch" class="btn btn-sm yellow" style="float:left;" title="Basic Details Fetch">Basic Details Fetch</a>--><a href="javascript:void(0);" id="old_pres_pb_fetch" onClick="old_pres_pb_fetch_model();" class="btn btn-sm red" style="float:left;" title="Prescription Details Fetch">Old Prescription Details Fetch</a> <strong>UHID No.:</strong> <?php echo $row['mrd_no']; ?> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<strong>Date:</strong> <?php echo  date("d-m-Y", strtotime($row['created_on'])); ?>
                    <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $_REQUEST['id'];?>">
                    <input type="hidden" id="mrd" name="mrd" class="form-control" value="<?php echo $row['mrd_no'];?>">
                    <input type="hidden" id="created_on" name="created_on" class="form-control" value="<?php echo $row['created_on'];?>">
                    <input type="hidden" id="send_sms" name="send_sms" class="form-control" value="<?php echo $row['send_sms'];?>">
                    <input type="hidden" id="patient_id" name="patient_id" class="form-control" value="<?php echo $row['patient_registration_id'];?>">
                    <?php if($_SESSION['role']=='4'){?>
                    <input type="hidden" id="username77" name="username77" class="form-control" value="<?php if($row['username77']!=''){ echo $row['username77'];}else{ echo $_SESSION['id'];}?>">
                    <?php }else{?>                    
                    <input type="hidden" id="username77" name="username77" class="form-control" value="<?php echo $row['username77'];?>">
                    <?php }?>
                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" id="reset_new" class="btn btn-sm green" title="Reset Values">Reset Values</a> </div>
                </div>
                <div class="form-body">
                  <div class="col-md-12">
                    <div class="portlet-body">
                      <div class="row"> </div>
                    </div>
                  </div>
                  <div class="row" style="background:#59749e !important; padding:9px 0px">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="important_visit" id="important_visit" value="<?php echo $row['important_visit']; ?>" <?php if($row['important_visit']=='1') echo 'checked';  ?>>
                          <span class="caption-subject font-white-sharp"><strong>Important Visit</strong></span></label>
                          <label class="checkbox-inline">
                          <input type="checkbox" name="location_print" id="location_print" value="<?php echo $row['location_print']; ?>" <?php if($row['location_print']=='1') echo 'checked';  ?>>
                          <span class="caption-subject font-white-sharp"><strong>Include Header Footer In Print</strong></span></label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Referred by: </label>
                        <select class="form-control select2" name="doctor_id" id="doctor_id"  >
                          <option value="">None</option>
                          <?php 
								 $sql7="select * from `doctor_masters_for_emr`  WHERE `del_flag`='0' order by `doctor_name` asc";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" '; if($row['doctor_id']==$row7['id']) echo 'selected'; echo '>'.$row7['doctor_name'].'</option>';
								 }

					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">&nbsp; </label>
                        <input type="text" id="reffered_other_doc" name="reffered_other_doc" value="<?php echo $row['reffered_other_doc']; ?>" class="form-control" placeholder="Referred By Other">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <p>&nbsp;</p>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Prefix</label>
                        <select class="form-control" name="prefix" id="prefix">
                          <?php 

								  $sql7="SELECT `id`, `prefix_name` FROM `prefix_masters`  WHERE  `del_flag`='0' ORDER BY `prefix_name` ASC";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {									 

									 echo '<option value="'.$row7['id'].'" '; if($row['prefix']==$row7['id']) echo 'selected'; echo '>'.$row7['prefix_name'].'</option>';

								 }

					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">First Name</label>
                        <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter First Name" value="<?php echo $row['fname']; ?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Last Name</label>
                        <input type="text" id="lname" name="lname" class="form-control" placeholder="Enter Last Name" value="<?php echo $row['lname']; ?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Email</label>
                        <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-envelope"></i> </span>
                          <input type="email" id="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" placeholder="Enter Email ID">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Date of Birth</label>
                        <div class="input-group">
                          <input type="text" class="form-control form-control-inline date-picker" name="dob" id="dob" placeholder="Select DOB" value="<?php if($row['dob']!='') { echo date("d-m-Y", strtotime($row['dob']));} ?>" >
                          <span class="input-group-addon" style="padding:0 !important"><a href="javascript:void(0);"  id="calculate" class="btn btn-sm default" title="Calculate">Calculate</a></span> </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Age (+Yrs.)-(+Months)-(+Days)</label>
                        <div class="input-group">
                          <input type="text" id="age" name="age" class="form-control" value="<?php echo $row['age']; ?>" placeholder="Years">
                          <span class="input-group-addon" style="padding:0 !important; width:30% !important">
                          <input type="text" id="age_month" name="age_month" class="form-control" value="<?php echo $row['age_month']; ?>" placeholder="Months">
                          </span> <span class="input-group-addon" style="padding:0 !important; width:30% !important">
                          <input type="text" id="age_days" name="age_days" class="form-control" value="<?php echo $row['age_days']; ?>" placeholder="Days">
                          </span> </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Religion</label>
                        <select class="form-control" name="religion" id="religion">
                          <option value="">Select</option>
                          <option value="Hindu" <?php if($row['religion']=='Hindu') echo 'selected'; ?> >Hindu</option>
                          <option value="Muslim" <?php if($row['religion']=='Muslim') echo 'selected'; ?> >Muslim</option>
                          <option value="Christian" <?php if($row['religion']=='Christian') echo 'selected'; ?> >Christian</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Mobile</label>
                        <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-mobile"></i> </span>
                          <input type="text" id="mobile" name="mobile" class="form-control" value="<?php echo $row['mobile']; ?>" placeholder="Enter Phone No.">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <p>&nbsp;</p>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Whatsapp Mobile</label>
                        <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-mobile"></i> </span>
                          <input type="text" id="w_mobile" name="w_mobile" class="form-control" value="<?php echo $row['mobile']; ?>" placeholder="Enter Whatsapp Phone No.">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Father's/Mothers Name/Husband Name</label>
                        <input type="text" id="guardian_name" name="guardian_name" class="form-control" placeholder="Enter Father's/Mothers Name/Husband Name" value="<?php echo $row['guardian_name']; ?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Address</label>
                        <textarea id="address" name="address" class="form-control" placeholder="Enter Address"><?php echo $row['address']; ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Purpose of visit</label>
                        <select  name="purpose_visit_id" id="purpose_visit_id" class="form-control" >
                          <option value="0">None</option>
                          <?php 
								 $sql7="select * from `purposevisit_masters_for_emr`  WHERE `del_flag`='0' order by `purpose_visit` asc";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
								 {	

									 echo '<option value="'.$row7['id'].'" '; if($row['purpose_visit_id']==$row7['id']) echo 'selected'; echo '>'.$row7['purpose_visit'].'</option>';
								 }

					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <p>&nbsp;</p>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Pin Code</label>
                        <input type="text" id="pin" name="pin" class="form-control" placeholder="Enter Pin Code" value="<?php echo $row['pin']; ?>" onBlur="getstate(this.value);">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">LOCATION ACCORDING TO YOUR PIN CODE</label>
                        <select  name="location2" id="location2" class="form-control" >
                          <?php 
									 echo '<option value="'.$row['location2'].'" '; if($row['location2']!='') echo 'selected'; echo '>'.$row['location2'].'</option>';

					 			?>
                          <option value="">None</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Primary Doctor: </label>
                        <select  name="primary_doctor" id="primary_doctor" class="form-control select2" >
                          <?php 
								 $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE (`users`.`role`='5'  ) AND `users`.`id`= '".$row['primary_doctor']."' order by `user_infos`.`name` asc";
								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {		

									 echo '<option value="'.$row7['id'].'" '; if($row['primary_doctor']==$row7['id']) echo 'selected'; echo '>'.$row7['name'].'</option>';
								 }

							

					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Reffered To Doc : </label>
                        <select  name="reffered_to_doc" id="reffered_to_doc" class="form-control select2" >
                          <option value="">Choose Doctor </option>
                          <?php 
						  $sql2="SELECT * FROM `reffered_to_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' order by `reffered_to_doc` asc";

							 $result2=$conn->query($sql2) ;

							 $count2=$result2->num_rows;

							 $reffered_to_doc=0;

							if($count2!='0'){

								while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
								$reffered_to_doc=$row2['reffered_to_doc'];
								}

							}								 $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE (`users`.`role`='5'  ) order by `user_infos`.`name` asc";

								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
								 {	
									 echo '<option value="'.$row7['id'].'" '; if($reffered_to_doc==$row7['id']) echo 'selected'; echo '>'.$row7['name'].'</option>';
								 }

					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">Signed By Doctor : </label>
                        <select  name="signed_by_doctor" id="signed_by_doctor" class="form-control select2" >
                          <?php 
								if($row['signed_by_doctor']==''){

								 $sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE (`users`.`role`='5'  ) AND `users`.`id`= '".$row['primary_doctor']."' order by `user_infos`.`name` asc";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {	

									 echo '<option value="'.$row7['id'].'" '; if($row['primary_doctor']==$row7['id']) echo 'selected'; echo '>'.$row7['name'].'</option>';
								 }

								}
									$sql7="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE (`users`.`role`='5'  ) order by `user_infos`.`name` asc";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
								 {	

									 echo '<option value="'.$row7['id'].'" '; if($row['signed_by_doctor']==$row7['id']) echo 'selected'; echo '>'.$row7['name'].'</option>';
								 }
					 			?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label">OLD System MRD No.</label>
                        <div class="input-group">
                          <input type="text" id="old_system_mrd" name="old_system_mrd" class="form-control" value="<?php echo $row['old_system_mrd']; ?>" placeholder="Enter OLD System MRD No." >
                           <span class="input-group-addon"><a href="javascript:void(0);"  id="old_mrd_fetch" title="OLD data fetch" onClick="old_pres_archieve_model();"> <i class="fa fa-search"></i></a> </span>
                           
                        </div>
                      </div>
                    </div>
                  </div>
                  <p style="padding:12px 0 2px 0; text-align:center">
                    <button type="submit" name="save_prescription" id="save_template" class="btn green">Save Prescription</button>
                  </p>
                  
                  <!-- 48 hours code-->
                  
                  <?php 
				  $flag=0;
				  	/*$now = time(); // or your date as well

					$presciption_date=date("Y-m-d", strtotime($row['created_on']));

					$your_date = strtotime($presciption_date);

					$datediff = $now - $your_date;

					$diff= round($datediff / (60 * 60 * 24));

					if($diff>2){

						$flag=1;

						}*/
				  ?>
                  <div <?php if($flag==1){ echo 'style="display:none !important;"';}?>>
                    <div class="row" style="background:#375A90; padding:9px 0px">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Patients Key Notes</label>
                          <textarea id="patients_key_notes" name="patients_key_notes" class="form-control" rows="2" placeholder="Enter Patients Key Notes"><?php echo $row['patients_key_notes']; ?></textarea>
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                        <label class="control-label">Chief Complaints/History</label>
                        <div class="table-scrollable">
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                              <tr>
                                <th ><strong>EYE</strong></th>
                                <th ><strong>Chief Complaints
                                  <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                  <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('chief_complaints_masters_for_emr','chief_complaints','Chief Complaints','chief','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                  <?php } ?>
                                  </strong></th>
                                <th ><strong>COUNT </strong></th>
                                <th ><strong>DUR.UNIT</strong></th>
                                <th >&nbsp; </th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td width="10%"><div class="input-group" style="width: 100%">
                                    <select class="form-control" name="chief_eye" id="chief_eye" >
                                      <option value="">(None)</option>
                                      <option value="LE">LE</option>
                                      <option value="RE">RE</option>
                                      <option value="BE">BE</option>
                                      <option value="LE > RE">LE > RE</option>
                                      <option value="RE > LE">RE > LE</option>
                                    </select>
                                  </div></td>
                                <td width="55%"><div class="input-group" style="width: 100%">
                                    <select class="form-control select2" name="chief" id="chief" >
                                      <option value="">(None)</option>
                                      <?php 

                                             $sql7="select * from `chief_complaints_masters_for_emr` order by `chief_complaints` asc";

                                             $result7=$conn->query($sql7) ;

                                             while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
                                             {		
                                                 echo '<option value="'.$row7['chief_complaints'].'" >'.$row7['chief_complaints'].'</option>';
                                             }

                                            ?>
                                    </select>
                                  </div></td>
                                <td width="10%"><div class="input-group">
                                    <select class="form-control" name="chief_num" id="chief_num">
                                      <option value=""  ></option>
                                      <option value="today"  >today</option>
                                      <option value="<?php echo '1'; ?>"  ><?php echo '1'; ?></option>
                                      <?php $dt=2;

											  while($dt<13){

											  ?>
                                      <option value="<?php echo $dt; ?>"  ><?php echo $dt; ?></option>
                                      <?php $dt++;} ?>
                                    </select>
                                  </div></td>
                                <td width="15%"><div class="input-group">
                                    <select class="form-control" name="chief_dur" id="chief_dur">
                                      <option value=""  ></option>
                                      <option value="day">day</option>
                                      <option value="days">days</option>
                                      <option value="week">week</option>
                                      <option value="weeks">weeks</option>
                                      <option value="month">month</option>
                                      <option value="months">months</option>
                                      <option value="year">year</option>
                                      <option value="years">years</option>
                                    </select>
                                  </div></td>
                                <td width="10%"><div class="input-group"> <a href="javascript:void(0);"  id="chief_btn" class="btn btn-sm default" title="OK">OK</a> </div></td>
                              </tr>
                              <tr>
                                <td colspan="5" ><textarea id="chief_complaints_history" name="chief_complaints_history" class="form-control" rows="2" placeholder="Enter Chief Complaints/History"><?php echo $row['chief_complaints_history']; ?></textarea></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                        <!--<div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">History of Present Illness</label>
                            <textarea id="history_of_present_illness" name="history_of_present_illness" class="form-control" rows="2" placeholder="History of Present Illness"><?php echo $row['history_of_present_illness']; ?></textarea>
                          </div>
                        </div>-->
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Current Treatment</label>
                            <input type="hidden" id="history_of_present_illness" name="history_of_present_illness" />
                            <textarea id="current_treatment" name="current_treatment" class="form-control" rows="2" placeholder="Current Treatment"><?php echo $row['current_treatment']; ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                        <label class="control-label">Past Ocular History</label>
                        <div class="table-scrollable">
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                              <tr>
                                <th ><strong>EYE</strong></th>
                                <th ><strong>Past Ocular History
                                  <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                  <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('past_ocular_masters_for_emr','past_ocular_text','Past Ocular History','past_ocular','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                  <?php } ?>
                                  </strong></th>
                                <th ><strong>COUNT </strong></th>
                                <th ><strong>DUR.UNIT</strong></th>
                                <th ><strong>Year of Surgery</strong></th>
                                <th >&nbsp; </th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td width="10%"><div class="input-group" style="width: 100%">
                                    <select class="form-control" name="past_ocular_eye" id="past_ocular_eye" >
                                      <option value="">(None)</option>
                                      <option value="LE">LE</option>
                                      <option value="RE">RE</option>
                                      <option value="BE">BE</option>
                                      <option value="LE > RE">LE > RE</option>
                                      <option value="RE > LE">RE > LE</option>
                                    </select>
                                  </div></td>
                                <td width="40%"><div class="input-group" style="width: 100%">
                                    <select class="form-control select2" name="past_ocular" id="past_ocular"   >
                                      <?php 
											 $sql7="select * from `past_ocular_masters_for_emr` order by `past_ocular_text` asc";

											 $result7=$conn->query($sql7) ;

											 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

											 {	

												 echo '<option value="'.$row7['past_ocular_text'].'" >'.$row7['past_ocular_text'].'</option>';
											 }

											?>
                                    </select>
                                  </div></td>
                                <td width="10%"><div class="input-group">
                                    <select class="form-control" name="past_ocular_num" id="past_ocular_num">
                                      <option value=""  ></option>
                                      <option value="today"  >today</option>
                                      <option value="<?php echo '1'; ?>"  ><?php echo '1'; ?></option>
                                      <?php $dt=2;

											  while($dt<13){

											  ?>
                                      <option value="<?php echo $dt; ?>"  ><?php echo $dt; ?></option>
                                      <?php $dt++;} ?>
                                    </select>
                                  </div></td>
                                <td width="15%"><div class="input-group">
                                    <select class="form-control" name="past_ocular_dur" id="past_ocular_dur">
                                      <option value=""  ></option>
                                      <option value="day">day</option>
                                      <option value="days">days</option>
                                      <option value="week">week</option>
                                      <option value="weeks">weeks</option>
                                      <option value="month">month</option>
                                      <option value="months">months</option>
                                      <option value="year">year</option>
                                      <option value="years">years</option>
                                    </select>
                                  </div></td>
                                <td width="15%"><div class="input-group">
                                    <select class="form-control" name="past_ocular_year" id="past_ocular_year">
                                      <option value=""  ></option>
                                      <?php $dt=1990;

											  while($dt<2030){

											  ?>
                                      <option value="<?php echo $dt; ?>"  ><?php echo $dt; ?></option>
                                      <?php $dt++;} ?>
                                    </select>
                                  </div></td>
                               
                                <td width="10%"><div class="input-group"> <a href="javascript:void(0);"  id="past_ocular_btn" class="btn btn-sm default" title="OK">OK</a> </div></td>
                              </tr>
                              <tr>
                                <td colspan="6" ><textarea id="past_ocular_history" name="past_ocular_history" class="form-control" rows="2" placeholder="Enter Past Ocular History"><?php echo $row['past_ocular_history']; ?></textarea>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                        <label class="control-label">General Health</label>
                        <div class="table-scrollable">
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                              <tr>
                                <th ><strong>General Health
                                  <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                  <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('general_health_masters_for_emr','general_health_text','General Health','general_hlth','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                  <?php } ?>
                                  </strong></th>
                                <th ><strong>COUNT </strong></th>
                                <th ><strong>DUR.UNIT</strong></th>
                                <th >&nbsp;</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td width="65%"><div class="input-group" style="width: 100%">
                                    <select class="form-control select2" name="general_hlth" id="general_hlth"   >
                                      <option value="">(None)</option>
                                      <?php 

                                                 $sql7="select * from `general_health_masters_for_emr` order by `general_health_text` asc";

                                                 $result7=$conn->query($sql7) ;

                                                 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

                                                 {			                                                     echo '<option value="'.$row7['general_health_text'].'" >'.$row7['general_health_text'].'</option>';

                                                 }

                                                ?>
                                    </select>
                                  </div></td>
                                <td width="10%"><div class="input-group">
                                    <select class="form-control" name="general_hlth_num" id="general_hlth_num">
                                      <option value=""  ></option>
                                      <option value="today"  >today</option>
                                      <option value="<?php echo '1'; ?>"  ><?php echo '1'; ?></option>
                                      <?php $dt=2;

											  while($dt<41){

											  ?>
                                      <option value="<?php echo $dt; ?>"  ><?php echo $dt; ?></option>
                                      <?php $dt++;} ?>
                                    </select>
                                  </div></td>
                                <td width="15%"><div class="input-group">
                                    <select class="form-control" name="general_hlth_dur" id="general_hlth_dur">
                                      <option value=""  ></option>
                                      <option value="day">day</option>
                                      <option value="days">days</option>
                                      <option value="week">week</option>
                                      <option value="weeks">weeks</option>
                                      <option value="month">month</option>
                                      <option value="months">months</option>
                                      <option value="year">year</option>
                                      <option value="years">years</option>
                                    </select>
                                  </div></td>
                                <td width="10%"><div class="input-group"> <a href="javascript:void(0);"  id="general_health_btn" class="btn btn-sm default" title="OK">OK</a> </div></td>
                              </tr>
                              <tr>
                                <td colspan="4" ><textarea id="general_health" name="general_health" class="form-control" rows="2" placeholder="Enter Systemic Illness"><?php echo $row['general_health']; ?></textarea>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Family History
                            <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                            <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('family_history_masters_for_emr','family_history','Family History','family_history_select','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                            <?php } ?>
                          </label>
                          <div class="input-group" style="margin-bottom:9px; margin-top:6px;">
                            <select class="form-control select2" name="family_history_select" id="family_history_select"  >
                              <option value="">(None)</option>
                              <?php 

                                         $sql7="select * from `family_history_masters_for_emr` order by `family_history` asc";
                                         $result7=$conn->query($sql7) ;
                                         while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

                                         {									                                              echo '<option value="'.$row7['family_history'].'" >'.$row7['family_history'].'</option>';
                                         }

                                        ?>
                            </select>
                            <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="family_history_btn" class="btn btn-sm default" title="OK">OK</a></span> </div>
                        </div>
                      </div>
                      <div class="col-md-4" style="border-right:2px solid #ddd;">
                        <div class="form-group">
                          <label class="control-label">&nbsp;</label>
                          <textarea id="family_history" name="family_history" class="form-control" rows="2" placeholder="Enter Family History"><?php echo $row['family_history']; ?></textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Allergy History</label>
                          <textarea id="allergy_history" name="allergy_history" class="form-control" rows="2" placeholder="Enter Allergy History"><?php echo $row['allergy_history']; ?></textarea>
                        </div>
                      </div>
                    </div>
                    <p class="form-section" style="text-align:right">&nbsp;</p>
                    <div class="row">
                      <div class="form-group">
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-2">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline">
                                    <input type="checkbox" name="pgp_block" id="pgp_block" value="<?php echo $row['pgp_block']; ?>" <?php if($row['pgp_block']=='1') echo 'checked';  ?>>
                                    <span class="caption-subject font-white-sharp"><strong>PGP</strong></span></label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <input type="text" id="pgp" name="pgp" class="form-control" value="<?php echo $row['pgp']; ?>" placeholder="Enter PGP">
                              </div>
                            </div>
                            <div class="col-md-6 col-lg-12" style="margin-bottom:4px; padding:0;">
                              <div class="table-scrollable">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                  <thead>
                                    <tr>
                                      <th>&nbsp;</th>
                                      <th ><strong>Sph</strong><strong>&nbsp;</strong></th>
                                      <th ><strong>Cyl</strong><strong>&nbsp;</strong></th>
                                      <th><strong>Axis</strong><strong>&nbsp;</strong></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td><strong>OD</strong></td>
                                      <td ><input type="text" id="sph_od" name="sph_od" class="form-control" value="<?php echo $row['sph_od']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('sph_od','1');" /></td>
                                      <td ><input type="text" id="cly_od" name="cly_od" class="form-control" value="<?php echo $row['cly_od']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('cly_od','2');" ></td>
                                      <td><input type="text" id="axis_od" name="axis_od" class="form-control" value="<?php echo $row['axis_od']; ?>" placeholder="Enter Range" ondblclick="model_open('axis_od','3');"></td>
                                    </tr>
                                    <tr>
                                      <td><strong>ADD</strong></td>
                                      <td><input type="text" id="sph_add" name="sph_add" class="form-control" value="<?php echo $row['sph_add']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('sph_add','4');"></td>
                                      <td colspan="2">&nbsp;</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="col-md-6 col-lg-12" style="margin-bottom:4px; padding:0;">
                              <div class="table-scrollable">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                  <thead>
                                    <tr>
                                      <th>&nbsp;</th>
                                      <th ><strong>Sph</strong><strong>&nbsp;</strong></th>
                                      <th ><strong>Cyl</strong><strong>&nbsp;</strong></th>
                                      <th><strong>Axis</strong><strong>&nbsp;</strong></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td><strong>OS</strong></td>
                                      <td ><input type="text" id="sph_os" name="sph_os" class="form-control" value="<?php echo $row['sph_os']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('sph_os','1');"></td>
                                      <td ><input type="text" id="cyl_os" name="cyl_os" class="form-control" value="<?php echo $row['cyl_os']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('cyl_os','2');"></td>
                                      <td><input type="text" id="axis_os" name="axis_os" class="form-control" value="<?php echo $row['axis_os']; ?>" placeholder="Enter Range" ondblclick="model_open('axis_os','3');"></td>
                                    </tr>
                                    <tr>
                                      <td><strong>ADD</strong></td>
                                      <td><input type="text" id="add_os" name="add_os" class="form-control" value="<?php echo $row['add_os']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('add_os','4');"></td>
                                      <td colspan="2">&nbsp;</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline">
                                    <input type="checkbox" name="ocular_block" id="ocular_block" value="<?php echo $row['ocular_block']; ?>" <?php if($row['ocular_block']=='1') echo 'checked';  ?>>
                                    <span class="caption-subject font-white-sharp"><strong>Ocular Examination</strong></span></label>
                                </div>
                              </div>
                              <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                <div class="table-scrollable">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                    <tbody>
                                      <tr>
                                        <td><strong>Vision <br>
                                          OD</strong></td>
                                        <td><select class="form-control" name="dv_glasses" id="dv_glasses">
                                            <option value="">Select</option>
                                            <option value="with glasses" <?php if($row['dv_glasses']=='with glasses') echo 'selected'; ?> >with glasses</option>
                                            <option value="without glasses" <?php if($row['dv_glasses']=='without glasses') echo 'selected'; ?> >without glasses</option>
                                            <option value="with contact lens" <?php if($row['dv_glasses']=='with contact lens') echo 'selected'; ?> >with contact lens</option>
                                          </select></td>
                                        <td ><select class="form-control" name="dv_od_select" id="dv_od_select" style="width:100px">
                                            <option value="">None</option>
                                            <option value="6/5">6/5</option>
                                            <option value="6/6">6/6</option>
                                            <option value="6/9">6/9</option>
                                            <option value="6/12">6/12</option>
                                            <option value="6/18">6/18</option>
                                            <option value="6/24">6/24</option>
                                            <option value="6/36">6/36</option>
                                            <option value="6/60">6/60</option>
                                            <option value="CFCF">CFCF</option>
                                            <option value="HMCF">HMCF</option>
                                            <option value="CF1M">CF1M</option>
                                            <option value="CF2M">CF2M</option>
                                            <option value="CF3M">CF3M</option>
                                            <option value="PL+">PL+</option>
                                            <option value="PL-">PL-</option>
                                            <option value="PL+/-">PL+/-</option>
                                          </select></td>
                                        <td><input type="text" id="dv_od" name="dv_od" class="form-control" value="<?php echo $row['dv_od']; ?>" placeholder="Enter Range"></td>
                                        <td><select class="form-control" name="nv_od_select" id="nv_od_select" style="width:100px">
                                            <option value="">None</option>
                                            <option value="<N36">&lt;N36</option>
                                            <option value="N36">N36</option>
                                            <option value="N24">N24</option>
                                            <option value="N18">N18</option>
                                            <option value="N12">N12</option>
                                            <option value="N10">N10</option>
                                            <option value="N8">N8</option>
                                            <option value="N6">N6</option>
                                          </select></td>
                                        <td><input type="text" id="nv_od" name="nv_od" class="form-control" value="<?php echo $row['nv_od']; ?>" placeholder="Enter Range"></td>
                                        <td>&nbsp;</td>
                                        <td><strong>Vision <br>
                                          OS</strong> <input type="hidden" name="dv_glasses_left" id="dv_glasses_left" /></td>
                                        <!--<td><select class="form-control" name="dv_glasses_left" id="dv_glasses_left">
                                            <option value="">Select</option>
                                            <option value="with glasses" <?php if($row['dv_glasses_left']=='with glasses') echo 'selected'; ?> >with glasses</option>
                                            <option value="without glasses" <?php if($row['dv_glasses_left']=='without glasses') echo 'selected'; ?> >without glasses</option>
                                            <option value="with contact lens" <?php if($row['dv_glasses_left']=='with contact lens') echo 'selected'; ?> >with contact lens</option>
                                          </select></td>-->
                                        <td ><select class="form-control" name="dv_os_select" id="dv_os_select" style="width:100px">
                                            <option value="">None</option>
                                            <option value="6/5">6/5</option>
                                            <option value="6/6">6/6</option>
                                            <option value="6/9">6/9</option>
                                            <option value="6/12">6/12</option>
                                            <option value="6/18">6/18</option>
                                            <option value="6/24">6/24</option>
                                            <option value="6/36">6/36</option>
                                            <option value="6/60">6/60</option>
                                            <option value="CFCF">CFCF</option>
                                            <option value="HMCF">HMCF</option>
                                            <option value="CF1M">CF1M</option>
                                            <option value="CF2M">CF2M</option>
                                            <option value="CF3M">CF3M</option>
                                            <option value="PL+">PL+</option>
                                            <option value="PL-">PL-</option>
                                            <option value="PL+/-">PL+/-</option>
                                          </select></td>
                                        <td><input type="text" id="dv_os" name="dv_os" class="form-control" value="<?php echo $row['dv_os']; ?>" placeholder="Enter Range"></td>
                                        <td><select class="form-control" name="nv_os_select" id="nv_os_select" style="width:100px">
                                            <option value="">None</option>
                                            <option value="<N36">&lt;N36</option>
                                            <option value="N36">N36</option>
                                            <option value="N24">N24</option>
                                            <option value="N18">N18</option>
                                            <option value="N12">N12</option>
                                            <option value="N10">N10</option>
                                            <option value="N8">N8</option>
                                            <option value="N6">N6</option>
                                          </select></td>
                                        <td><input type="text" id="nv_os" name="nv_os" class="form-control" value="<?php echo $row['nv_os']; ?>" placeholder="Enter Range"></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"><strong>PR</strong></td>
                                        <td colspan="5"><input type="text" class="form-control" name="pr_left" id="pr_left" value="<?php echo $row['pr_left']; ?>"></td>
                                        <td colspan="5"><input type="text" class="form-control" name="pr_right" id="pr_right" value="<?php echo $row['pr_right']; ?>"></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"><strong>Pinhole</strong></td>
                                        <td><strong>OD</strong></td>
                                        <td colspan="2"><select class="form-control" name="pinhole_od_select" id="pinhole_od_select" >
                                            <option value=""></option>
                                            <option value="6/5">6/5</option>
                                            <option value="6/6">6/6</option>
                                            <option value="6/9">6/9</option>
                                            <option value="6/12">6/12</option>
                                            <option value="6/18">6/18</option>
                                            <option value="6/24">6/24</option>
                                            <option value="6/36">6/36</option>
                                            <option value="6/60">6/60</option>
                                            <option value="No Improvement">No Improvement</option>
                                          </select></td>
                                        <td colspan="2"><input type="text" id="pinhole_od" name="pinhole_od" class="form-control" value="<?php if($row['pinhole_od']!=''){echo $row['pinhole_od'];} ?>" placeholder="Enter value Or Select"></td>
                                        <td><strong>OS</strong></td>
                                        <td colspan="2"><select class="form-control" name="pinhole_os_select" id="pinhole_os_select" >
                                            <option value=""></option>
                                            <option value="6/5">6/5</option>
                                            <option value="6/6">6/6</option>
                                            <option value="6/9">6/9</option>
                                            <option value="6/12">6/12</option>
                                            <option value="6/18">6/18</option>
                                            <option value="6/24">6/24</option>
                                            <option value="6/36">6/36</option>
                                            <option value="6/60">6/60</option>
                                            <option value="No Improvement">No Improvement</option>
                                          </select></td>
                                        <td colspan="2"><input type="text" id="pinhole_os" name="pinhole_os" class="form-control" value="<?php if($row['pinhole_os']!=''){echo $row['pinhole_os'];} ?>" placeholder="Enter value Or Select"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-8">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline"> <span class="caption-subject font-white-sharp"><strong>Flash (Not Glass Prescription)</strong></span></label>
                                </div>
                              </div>
                              <div class="col-md-4" style="text-align:right"><a href="javascript:void(0);" class="btn btn-sm red" id="flash_block_div_minus_bt" title="-" style="margin:0 !important;display:none;"><i class="fa fa-minus"></i></a><a href="javascript:void(0);" class="btn btn-sm green" id="flash_block_div_plus_bt" title="+" style="margin:0 !important"><i class="fa fa-plus"></i></a></div>
                              <div id="flash_block_div" style="display:none;">
                                <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                  <div class="col-md-6" style="margin-bottom:4px; padding:0;">
                                    <div class="table-scrollable">
                                      <table class="table table-striped table-bordered table-advance table-hover">
                                        <thead>
                                          <tr>
                                            <th>&nbsp;</th>
                                            <th ><strong>Sph</strong><strong>&nbsp;</strong></th>
                                            <th ><strong>Cyl</strong><strong>&nbsp;</strong></th>
                                            <th><strong>Axis</strong><strong>&nbsp;</strong></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><strong>OD</strong></td>
                                            <td ><input type="text" id="flash_od" name="flash_od" class="form-control" value="<?php echo $row['flash_od']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('flash_od','1');" /></td>
                                            <td ><input type="text" id="flash_cly_od" name="flash_cly_od" class="form-control" value="<?php echo $row['flash_cly_od']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('flash_cly_od','2');" ></td>
                                            <td><input type="text" id="flash_axis_od" name="flash_axis_od" class="form-control" value="<?php echo $row['flash_axis_od']; ?>" placeholder="Enter Range" ondblclick="model_open('flash_axis_od','3');"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  <div class="col-md-6" style="margin-bottom:4px; padding:0;">
                                    <div class="table-scrollable">
                                      <table class="table table-striped table-bordered table-advance table-hover">
                                        <thead>
                                          <tr>
                                            <th>&nbsp;</th>
                                            <th ><strong>Sph</strong><strong>&nbsp;</strong></th>
                                            <th ><strong>Cyl</strong><strong>&nbsp;</strong></th>
                                            <th><strong>Axis</strong><strong>&nbsp;</strong></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><strong>OS</strong></td>
                                            <td ><input type="text" id="flash_os" name="flash_os" class="form-control" value="<?php echo $row['flash_os']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('flash_os','1');"></td>
                                            <td ><input type="text" id="flash_cyl_os" name="flash_cyl_os" class="form-control" value="<?php echo $row['flash_cyl_os']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('flash_cyl_os','2');"></td>
                                            <td><input type="text" id="flash_axis_os" name="flash_axis_os" class="form-control" value="<?php echo $row['flash_axis_os']; ?>" placeholder="Enter Range" ondblclick="model_open('flash_axis_os','3');"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline">
                                    <input type="checkbox" name="glass_block" id="glass_block" value="<?php echo $row['glass_block']; ?>" <?php if($row['glass_block']=='1') echo 'checked';  ?>>
                                    <span class="caption-subject font-white-sharp"><strong>Glass Prescription</strong></span></label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline">
                                    <input type="checkbox" name="spglass_block" id="spglass_block" value="<?php echo $row['spglass_block']; ?>" <?php if($row['spglass_block']=='1') echo 'checked';  ?>>
                                    <span class="caption-subject font-white-sharp"><strong>Separate Glass Prescription</strong></span></label>
                                </div>
                              </div>
                              <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                <div class="table-scrollable">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                      <tr>
                                        <th>&nbsp;</th>
                                        <th colspan="5"><strong>Right Eye</strong></th>
                                        <th colspan="5"><strong>Left Eye</strong></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td colspan="2"><strong>Sph</strong></td>
                                        <td colspan="2"><strong>Cyl</strong></td>
                                        <td><strong>Axis</strong></td>
                                        <td colspan="2"><strong>Sph</strong></td>
                                        <td colspan="2"><strong>Cyl</strong></td>
                                        <td><strong>Axis</strong></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Distance</strong></td>
                                        <td><input type="text" id="distance_sph_r" name="distance_sph_r" class="form-control" value="<?php echo $row['distance_sph_r']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('distance_sph_r','1');" /></td>
                                        <td><select class="form-control select2" name="distance_sph_r_range" id="distance_sph_r_range" style="width:75px">
                                            <option value="">(None)</option>
                                            <?php 

                                                 	$arrVal2=range(-0.25,-10.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="'.$v2.'" >'.$v2.'</option>';

													}

													echo '<option value="0.00" >0.00</option>';

													$arrVal2=range(0.25,10.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="+'.$v2.'" >+'.$v2.'</option>';

													}

                                                ?>
                                          </select></td>
                                        <td><input type="text" id="distance_cyl_r" name="distance_cyl_r" class="form-control" value="<?php echo $row['distance_cyl_r']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('distance_cyl_r','2');" /></td>
                                        <td><select class="form-control select2" name="distance_cyl_r_range" id="distance_cyl_r_range" style="width:75px">
                                            <option value="">(None)</option>
                                            <?php 

													echo '<option value="0.00" >0.00</option>';

                                                 	$arrVal2=range(-0.25,-6.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="'.$v2.'" >'.$v2.'</option>';

													}
                                                ?>
                                          </select></td>
                                        <td><input type="text" id="distance_axis_r" name="distance_axis_r" class="form-control" value="<?php echo $row['distance_axis_r']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('distance_axis_r','3');" /></td>
                                        <td><input type="text" id="distance_sph_l" name="distance_sph_l" class="form-control" value="<?php echo $row['distance_sph_l']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('distance_sph_l','1');" /></td>
                                        <td><select class="form-control select2" name="distance_sph_l_range" id="distance_sph_l_range" style="width:75px">
                                            <option value="">(None)</option>
                                            <?php 

                                                 	$arrVal2=range(-0.25,-10.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="'.$v2.'" >'.$v2.'</option>';

													}

													echo '<option value="0.00" >0.00</option>';

													$arrVal2=range(0.25,10.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="+'.$v2.'" >+'.$v2.'</option>';

													}

                                                ?>
                                          </select></td>
                                        <td><input type="text" id="distance_cyl_l" name="distance_cyl_l" class="form-control" value="<?php echo $row['distance_cyl_l']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('distance_cyl_l','2');" /></td>
                                        <td><select class="form-control select2" name="distance_cyl_l_range" id="distance_cyl_l_range" style="width:75px">
                                            <option value="">(None)</option>
                                            <?php 

													echo '<option value="0.00" >0.00</option>';

                                                 	$arrVal2=range(-0.25,-6.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="'.$v2.'" >'.$v2.'</option>';

													}

													

                                                ?>
                                          </select></td>
                                        <td><input type="text" id="distance_axis_l" name="distance_axis_l" class="form-control" value="<?php echo $row['distance_axis_l']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('distance_axis_l','3');" /></td>
                                      </tr>
                                      <tr>
                                        <td colspan="3">&nbsp;</td>
                                        <td ><strong>VA</strong></td>
                                        <td><input type="text" id="distance_va_r" name="distance_va_r" class="form-control" value="<?php echo $row['distance_va_r']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('distance_va_r','4');" /></td>
                                        <td><select class="form-control select2" name="distance_va_r_select" id="distance_va_r_select" style="width:75px">
                                            <option value=""></option>
                                            <option value="6/5">6/5</option>
                                            <option value="6/6">6/6</option>
                                            <option value="6/9">6/9</option>
                                            <option value="6/12">6/12</option>
                                            <option value="6/18">6/18</option>
                                            <option value="6/24">6/24</option>
                                            <option value="6/36">6/36</option>
                                            <option value="6/60">6/60</option>
                                          </select></td>
                                        <td colspan="2" >&nbsp;</td>
                                        <td ><strong>VA</strong></td>
                                        <td><input type="text" id="distance_va_l" name="distance_va_l" class="form-control" value="<?php echo $row['distance_va_l']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('distance_va_l','4');" /></td>
                                        <td><select class="form-control select2" name="distance_va_l_select" id="distance_va_l_select" style="width:75px">
                                            <option value=""></option>
                                            <option value="6/5">6/5</option>
                                            <option value="6/6">6/6</option>
                                            <option value="6/9">6/9</option>
                                            <option value="6/12">6/12</option>
                                            <option value="6/18">6/18</option>
                                            <option value="6/24">6/24</option>
                                            <option value="6/36">6/36</option>
                                            <option value="6/60">6/60</option>
                                          </select></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Add</strong></td>
                                        <td><input type="text" id="near_sph_r" name="near_sph_r" class="form-control" value="<?php echo $row['near_sph_r']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('near_sph_r','1');" /></td>
                                        <td><select class="form-control select2" name="near_sph_r_range" id="near_sph_r_range" style="width:75px">
                                            <option value="">(None)</option>
                                            <?php 

                                                 	$arrVal2=range(-0.25,-10.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="'.$v2.'" >'.$v2.'</option>';

													}

													echo '<option value="0.00" >0.00</option>';

													$arrVal2=range(0.25,10.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="+'.$v2.'" >+'.$v2.'</option>';

													}

                                                ?>
                                          </select></td>
                                        <td><input type="text" id="near_cyl_r" name="near_cyl_r" class="form-control" value="<?php echo $row['near_cyl_r']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('near_cyl_r','2');" /></td>
                                        <td><select class="form-control select2" name="near_cyl_r_range" id="near_cyl_r_range" style="width:75px">
                                            <option value="">(None)</option>
                                            <?php 

													echo '<option value="0.00" >0.00</option>';

                                                 	$arrVal2=range(-0.25,-6.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="'.$v2.'" >'.$v2.'</option>';

													}

													

                                                ?>
                                          </select></td>
                                        <td><input type="text" id="near_axis_r" name="near_axis_r" class="form-control" value="<?php echo $row['near_axis_r']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('near_axis_r','3');" /></td>
                                        <td><input type="text" id="near_sph_l" name="near_sph_l" class="form-control" value="<?php echo $row['near_sph_l']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('near_sph_l','1');" /></td>
                                        <td><select class="form-control select2" name="near_sph_l_range" id="near_sph_l_range" style="width:75px">
                                            <option value="">(None)</option>
                                            <?php 

                                                 	$arrVal2=range(-0.25,-10.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="'.$v2.'" >'.$v2.'</option>';

													}

													echo '<option value="0.00" >0.00</option>';

													$arrVal2=range(0.25,10.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="+'.$v2.'" >+'.$v2.'</option>';

													}

                                                ?>
                                          </select></td>
                                        <td><input type="text" id="near_cyl_l" name="near_cyl_l" class="form-control" value="<?php echo $row['near_cyl_l']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('near_cyl_l','2');" /></td>
                                        <td><select class="form-control select2" name="near_cyl_l_range" id="near_cyl_l_range" style="width:75px">
                                            <option value="">(None)</option>
                                            <?php 

													echo '<option value="0.00" >0.00</option>';

                                                 	$arrVal2=range(-0.25,-6.00,0.25);

													foreach($arrVal2 as $k=>$i){

													$v2=number_format($i,2);

													echo '<option value="'.$v2.'" >'.$v2.'</option>';

													}

													

                                                ?>
                                          </select></td>
                                        <td><input type="text" id="near_axis_l" name="near_axis_l" class="form-control" value="<?php echo $row['near_axis_l']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('near_axis_l','3');" /></td>
                                      </tr>
                                      <tr>
                                        <td colspan="3">&nbsp;</td>
                                        <td ><strong>VA</strong></td>
                                        <td><input type="text" id="near_va_r" name="near_va_r" class="form-control" value="<?php echo $row['near_va_r']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('near_va_r','4');" /></td>
                                        <td><select class="form-control" name="near_va_r_select" id="near_va_r_select" style="width:75px">
                                            <option value=""></option>
                                            <option value="N36">N36</option>
                                            <option value="N24">N24</option>
                                            <option value="N18">N18</option>
                                            <option value="N12">N12</option>
                                            <option value="N10">N10</option>
                                            <option value="N8">N8</option>
                                            <option value="N6">N6</option>
                                          </select></td>
                                        <td colspan="2">&nbsp;</td>
                                        <td ><strong>VA</strong></td>
                                        <td><input type="text" id="near_va_l" name="near_va_l" class="form-control" value="<?php echo $row['near_va_l']; ?>" placeholder="Enter Range Or Select" ondblclick="model_open('near_va_l','4');" /></td>
                                        <td><select class="form-control" name="near_va_l_select" id="near_va_l_select" style="width:75px">
                                            <option value=""></option>
                                            <option value="N36">N36</option>
                                            <option value="N24">N24</option>
                                            <option value="N18">N18</option>
                                            <option value="N12">N12</option>
                                            <option value="N10">N10</option>
                                            <option value="N8">N8</option>
                                            <option value="N6">N6</option>
                                          </select></td>
                                      </tr>
                                      <tr>
                                        <td colspan="11"><div class="input-group" style="margin-bottom:9px;">
                                            <select class="bs-select form-control" name="glassPrescription_select" id="glassPrescription_select"  multiple>
                                              <?php 

												 $sql7="select * from `gp_masters_for_emr` order by `gp_name` asc";

												 $result7=$conn->query($sql7) ;

												 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

												 {		

													 echo '<option value="'.$row7['gp_name'].'" >'.$row7['gp_name'].'</option>';

												 }

												?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="glassPrescription_btn" class="btn btn-sm default" title="OK">OK</a></span> </div>
                                          <textarea id="glass_prescription" name="glass_prescription" class="form-control"  placeholder="Enter Glass Prescription"><?php echo $row['glass_prescription']; ?></textarea></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline"> <span class="caption-subject font-black-sharp"><strong>Ocular Alignment (Cover Test / Hirschberg Test)</strong></span></label>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <select class="form-control" name="cover_test_select" id="cover_test_select">
                                  <option value="">Select</option>
                                  <option value="Cover Test" <?php if($row['cover_test_select']=='Cover Test') echo 'selected'; ?> >Cover Test</option>
                                  <option value="Hirschberg Test" <?php if($row['cover_test_select']=='Hirschberg Test') echo 'selected'; ?> >Hirschberg Test</option>
                                  <option value="Modified Krimsky Test" <?php if($row['cover_test_select']=='Modified Krimsky Test') echo 'selected'; ?> >Modified Krimsky Test</option>
                                  <option value="Krimsky Test" <?php if($row['cover_test_select']=='Krimsky Test') echo 'selected'; ?> >Krimsky Test</option>
                                </select>
                              </div>
                              <div class="col-md-2">
                                <input type="text" id="cover_test_text" name="cover_test_text" class="form-control" value="<?php echo $row['cover_test_text']; ?>" placeholder="Enter value Or Select">
                              </div>
                              <div class="col-md-4">
                                <select class="form-control" name="cover_select" id="cover_select" >
                                  <option value="">Select</option>
                                  <option value="ORTHO">ORTHO</option>
                                  <option value="RIGHT EXOTROPIA">RIGHT EXOTROPIA</option>
                                  <option value="LEFT EXOTROPIA">LEFT EXOTROPIA</option>
                                  <option value="INTERMITTENT DIVERGENT SQUINT">INTERMITTENT DIVERGENT SQUINT</option>
                                  <option value="RIGHT ESOTROPIA">RIGHT ESOTROPIA</option>
                                  <option value="LEFT  ESOTROPIA">LEFT  ESOTROPIA</option>
                                  <option value="RIGHT HYPERTROPIA">RIGHT HYPERTROPIA</option>
                                  <option value="LEFT HYPERTROPIA">LEFT HYPERTROPIA</option>
                                </select>
                              </div>
                              <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                <div class="table-scrollable">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                      <tr>
                                        <th width="11%">&nbsp;</th>
                                        <th colspan="2"><strong>Right Eye</strong></th>
                                        <th colspan="2"><strong>Left Eye</strong></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td><input type="checkbox" name="mb_ocular_checkbox_check" id="mb_ocular_checkbox_check" value="<?php echo $row['mb_ocular_checkbox_check']; ?>" <?php if($row['mb_ocular_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>MB</strong></td>
                                        <td colspan="2"><input type="text" id="mb_ocular" name="mb_ocular" class="form-control" value="<?php echo $row['mb_ocular']; ?>" placeholder="Enter value"></td>
                                        <td colspan="2"><input type="text" id="mb_ocular_left" name="mb_ocular_left" class="form-control" value="<?php echo $row['mb_ocular_left']; ?>" placeholder="Enter value"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="eom_checkbox_check" id="eom_checkbox_check" value="<?php echo $row['eom_checkbox_check']; ?>" <?php if($row['eom_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>EOM</strong></td>
                                        <td width="26%"><select class="form-control" name="EOM_select" id="EOM_select" >
                                            <option value="">(None)</option>
                                            <option value="Full, free and painless ">Full, free and painless </option>
                                          </select></td>
                                        <td width="19%" ><input type="text" id="EOM" name="EOM" class="form-control" value="<?php if($row['EOM']!=''){echo $row['EOM'];}?>" placeholder="Enter value"></td>
                                        <td width="25%"><select class="form-control" name="EOM_left_select" id="EOM_left_select" >
                                            <option value="">(None)</option>
                                            <option value="Full, free and painless ">Full, free and painless </option>
                                          </select></td>
                                        <td width="19%" ><input type="text" id="EOM_left" name="EOM_left" class="form-control" value="<?php if($row['EOM_left']!=''){echo $row['EOM_left'];}?>" placeholder="Enter value"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="lid_checkbox_check" id="lid_checkbox_check" value="<?php echo $row['lid_checkbox_check']; ?>" <?php if($row['lid_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>Lid Adnexa</strong></td>
                                        <td><select class="form-control" name="lidadnexa_select" id="lidadnexa_select" >
                                            <option value="">(None)</option>
                                            <option value="Chalazion">Chalazion</option>
                                            <option value="Dermatochalasis">Dermatochalasis</option>
                                            <option value="Ectropion">Ectropion</option>
                                            <option value="Entropion">Entropion</option>
                                            <option value="Hordeolum Externum">Hordeolum Externum</option>
                                            <option value="Hordeolum Internum">Hordeolum Internum</option>
                                            <option value="Lagophthalmos">Lagophthalmos</option>
                                            <option value="Meibomitis">Meibomitis</option>
                                            <option value="Ptosis">Ptosis</option>
                                            <option value="Squamous Blepharitis">Squamous Blepharitis</option>
                                            <option value="WNL" >WNL</option>
                                          </select></td>
                                        <td><input type="text" id="lid_adnexa" name="lid_adnexa" class="form-control" value="<?php if($row['lid_adnexa']!=''){echo $row['lid_adnexa'];} ?>" placeholder="Enter value Or Select"></td>
                                        <td><select class="form-control" name="lidadnexa_left_select" id="lidadnexa_left_select" >
                                            <option value="">(None)</option>
                                            <option value="Chalazion">Chalazion</option>
                                            <option value="Dermatochalasis">Dermatochalasis</option>
                                            <option value="Ectropion">Ectropion</option>
                                            <option value="Entropion">Entropion</option>
                                            <option value="Hordeolum Externum">Hordeolum Externum</option>
                                            <option value="Hordeolum Internum">Hordeolum Internum</option>
                                            <option value="Lagophthalmos">Lagophthalmos</option>
                                            <option value="Meibomitis">Meibomitis</option>
                                            <option value="Ptosis">Ptosis</option>
                                            <option value="Squamous Blepharitis">Squamous Blepharitis</option>
                                            <option value="WNL" >WNL</option>
                                          </select></td>
                                        <td><input type="text" id="lid_adnexa_left" name="lid_adnexa_left" class="form-control" value="<?php if($row['lid_adnexa_left']!=''){echo $row['lid_adnexa_left'];} ?>" placeholder="Enter value Or Select"></td>
                                      </tr>
                                       <tr>
                                        <td><strong>Tears Outflow System</strong></td>
                                        <td colspan="2"><input type="text" id="tears_outflow_system" name="tears_outflow_system" class="form-control" value="<?php if($row['tears_outflow_system']!=''){echo $row['tears_outflow_system'];} ?>" placeholder="Enter value Tears Outflow System Right"></td>
                                        <td colspan="2"><input type="text" id="tears_outflow_system_right" name="tears_outflow_system_right" class="form-control" value="<?php if($row['tears_outflow_system_right']!=''){echo $row['tears_outflow_system_right'];} ?>" placeholder="Enter value Tears Outflow System Right"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="conjunctiva_checkbox_check" id="conjunctiva_checkbox_check" value="<?php echo $row['conjunctiva_checkbox_check']; ?>" <?php if($row['conjunctiva_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>Conjunctiva</strong></td>
                                        <td><select class="form-control" name="conjunctiva_select" id="conjunctiva_select" >
                                            <option value="">(None)</option>
                                            <option value="WNL">WNL</option>
                                            <option value="Congestion ">Congestion </option>
                                          </select></td>
                                        <td ><input type="text" id="conjunctiva" name="conjunctiva" class="form-control" value="<?php if($row['conjunctiva']!=''){echo $row['conjunctiva'];}?>" placeholder="Enter value"></td>
                                        <td><select class="form-control" name="conjunctiva_left_select" id="conjunctiva_left_select" >
                                            <option value="">(None)</option>
                                            <option value="WNL">WNL</option>
                                            <option value="Congestion ">Congestion </option>
                                          </select></td>
                                        <td ><input type="text" id="conjunctiva_left" name="conjunctiva_left" class="form-control" value="<?php if($row['conjunctiva_left']!=''){echo $row['conjunctiva_left'];}?>" placeholder="Enter value"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="cornea_ocular_checkbox_check" id="cornea_ocular_checkbox_check" value="<?php echo $row['cornea_ocular_checkbox_check']; ?>" <?php if($row['cornea_ocular_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>Cornea</strong></td>
                                        <td colspan="2"><input type="text" id="cornea_ocular" name="cornea_ocular" class="form-control" value="<?php echo $row['cornea_ocular']; ?>" placeholder="Enter value"></td>
                                        <td colspan="2"><input type="text" id="cornea_ocular_left" name="cornea_ocular_left" class="form-control" value="<?php echo $row['cornea_ocular_left']; ?>" placeholder="Enter value"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="pupils_checkbox_check" id="pupils_checkbox_check" value="<?php echo $row['pupils_checkbox_check']; ?>" <?php if($row['pupils_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>Pupils</strong></td>
                                        <td><select class="form-control" name="pupils_select" id="pupils_select" >
                                            <option value="">(None)</option>
                                            <!--<option value="Absent Pupillary Ruff ">Absent Pupillary Ruff </option>
                                            <option value="Ectropion Uvea">Ectropion Uvea</option>
                                            <option value="Miotic">Miotic</option>
                                            <option value="Occlusion Pupillae">Occlusion Pupillae</option>
                                            <option value="Pseudoexfoliation Material On Pupillary Border ">Pseudoexfoliation Material On Pupillary Border </option>
                                            <option value="RAPD">RAPD</option>
                                            <option value="Round Reacting To Light" >Round Reacting To Light</option>
                                            <option value="Secclusio Pupillae ">Secclusio Pupillae </option>
                                            <option value="Sphincter Tear ">Sphincter Tear </option>
                                            <option value="Traumatic Mydriasis ">Traumatic Mydriasis </option>-->
                                            <?php 

													 $sql7="select * from `pupils_masters_for_emr` ORDER BY `pupils` asc";
													 $result7=$conn->query($sql7) ;
													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {									 
														 echo '<option value="'.$row7['pupils'].'">'.$row7['pupils'].'</option>';

													 }

													?>
                                          </select></td>
                                        <td><input type="text" id="pupils" name="pupils" class="form-control" value="<?php if($row['pupils']!=''){echo $row['pupils'];} ?>" placeholder="Enter value Or Select"></td>
                                        <td><select class="form-control" name="pupils_left_select" id="pupils_left_select" >
                                            <option value="">(None)</option>
                                            <!--<option value="Absent Pupillary Ruff ">Absent Pupillary Ruff </option>
                                            <option value="Ectropion Uvea">Ectropion Uvea</option>
                                            <option value="Miotic">Miotic</option>
                                            <option value="Occlusion Pupillae">Occlusion Pupillae</option>
                                            <option value="Pseudoexfoliation Material On Pupillary Border ">Pseudoexfoliation Material On Pupillary Border </option>
                                            <option value="RAPD">RAPD</option>
                                            <option value="Round Reacting To Light" >Round Reacting To Light</option>
                                            <option value="Secclusio Pupillae ">Secclusio Pupillae </option>
                                            <option value="Sphincter Tear ">Sphincter Tear </option>
                                            <option value="Traumatic Mydriasis ">Traumatic Mydriasis </option>-->
                                            <?php 

													 $sql7="select * from `pupils_masters_for_emr` ORDER BY `pupils` asc";
													 $result7=$conn->query($sql7) ;
													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {									 
														 echo '<option value="'.$row7['pupils'].'">'.$row7['pupils'].'</option>';

													 }

													?>
                                          </select></td>
                                        <td><input type="text" id="pupils_left" name="pupils_left" class="form-control" value="<?php if($row['pupils_left']!=''){echo $row['pupils_left'];} ?>" placeholder="Enter value Or Select"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="iris_ocular_checkbox_check" id="iris_ocular_checkbox_check" value="<?php echo $row['iris_ocular_checkbox_check']; ?>" <?php if($row['iris_ocular_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>Iris</strong></td>
                                        <td colspan="2"><input type="text" id="iris_ocular" name="iris_ocular" class="form-control" value="<?php echo $row['iris_ocular']; ?>" placeholder="Enter value"></td>
                                        <td colspan="2"><input type="text" id="iris_ocular_left" name="iris_ocular_left" class="form-control" value="<?php echo $row['iris_ocular_left']; ?>" placeholder="Enter value"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="ac_ocular_checkbox_check" id="ac_ocular_checkbox_check" value="<?php echo $row['ac_ocular_checkbox_check']; ?>" <?php if($row['ac_ocular_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>AC</strong></td>
                                        <td colspan="2"><input type="text" id="ac_ocular" name="ac_ocular" class="form-control" value="<?php echo $row['ac_ocular']; ?>" placeholder="Enter value"></td>
                                        <td colspan="2"><input type="text" id="ac_ocular_left" name="ac_ocular_left" class="form-control" value="<?php echo $row['ac_ocular_left']; ?>" placeholder="Enter value"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="lens_ocular_checkbox_check" id="lens_ocular_checkbox_check" value="<?php echo $row['lens_ocular_checkbox_check']; ?>" <?php if($row['lens_ocular_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>Lens</strong></td>
                                        <td colspan="2"><input type="text" id="lens_ocular" name="lens_ocular" class="form-control" value="<?php echo $row['lens_ocular']; ?>" placeholder="Enter value"></td>
                                        <td colspan="2"><input type="text" id="lens_ocular_left" name="lens_ocular_left" class="form-control" value="<?php echo $row['lens_ocular_left']; ?>" placeholder="Enter value"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="vitreous_ocular_checkbox_check" id="vitreous_ocular_checkbox_check" value="<?php echo $row['vitreous_ocular_checkbox_check']; ?>" <?php if($row['vitreous_ocular_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>Vitreous</strong></td>
                                        <td colspan="2"><input type="text" id="vitreous_ocular" name="vitreous_ocular" class="form-control" value="<?php echo $row['vitreous_ocular']; ?>" placeholder="Enter value"></td>
                                        <td colspan="2"><input type="text" id="vitreous_ocular_left" name="vitreous_ocular_left" class="form-control" value="<?php echo $row['vitreous_ocular_left']; ?>" placeholder="Enter value"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="retina_ocular_checkbox_check" id="retina_ocular_checkbox_check" value="<?php echo $row['retina_ocular_checkbox_check']; ?>" <?php if($row['retina_ocular_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>Retina</strong></td>
                                        <td colspan="2"><input type="text" id="retina_ocular" name="retina_ocular" class="form-control" value="<?php echo $row['retina_ocular']; ?>" placeholder="Enter value"></td>
                                        <td colspan="2"><input type="text" id="retina_ocular_left" name="retina_ocular_left" class="form-control" value="<?php echo $row['retina_ocular_left']; ?>" placeholder="Enter value"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="onh_ocular_checkbox_check" id="onh_ocular_checkbox_check" value="<?php echo $row['onh_ocular_checkbox_check']; ?>" <?php if($row['onh_ocular_checkbox_check']=='1') echo 'checked';  ?>>
                                          <strong>ONH</strong></td>
                                        <td colspan="2"><input type="text" id="onh_ocular" name="onh_ocular" class="form-control" value="<?php echo $row['onh_ocular']; ?>" placeholder="Enter value"></td>
                                        <td colspan="2"><input type="text" id="onh_ocular_left" name="onh_ocular_left" class="form-control" value="<?php echo $row['onh_ocular_left']; ?>" placeholder="Enter value"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="anterior_figure" id="anterior_figure" value="<?php echo $row['anterior_figure']; ?>" <?php if($row['anterior_figure']=='1') echo 'checked';  ?>>
                                          <strong>Anterior Segment
                                          <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                          <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('anterior_segment_masters_for_emr','anterior_segment','Anterior Segment','anterior_select','anterior_left_select')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                          <?php } ?>
                                          </strong> <a href="<?php echo ADMIN_URL; ?>wPaint-master/index.php?pres_id=<?php echo $_REQUEST['id'];?>&mrd=<?php echo $row['mrd_no'];?>&anterior=1" target="_blank" class="btn btn-sm green" title="Anterior Drawing">Drawing</a></td>
                                        <td colspan="2"><div class="input-group" style="margin-bottom:9px;">
                                            <select class="form-control select2" name="anterior_select" id="anterior_select" >
                                              <option value="">(None)</option>
                                              <?php 

													 $sql7="select * from `anterior_segment_masters_for_emr` ORDER BY `anterior_segment` asc";
													 $result7=$conn->query($sql7) ;
													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {									 
														 echo '<option value="'.$row7['anterior_segment'].'">'.$row7['anterior_segment'].'</option>';

													 }

													?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="anterior_select_button" class="btn btn-sm default" title="OK">OK</a></span> </div>
                                          <textarea id="anterior_segment" name="anterior_segment" class="form-control" rows="3" placeholder="Enter Anterior Segment"><?php echo $row['anterior_segment']; ?></textarea></td>
                                        <td colspan="2"><div class="input-group" style="margin-bottom:9px;">
                                            <select class="form-control select2" name="anterior_left_select" id="anterior_left_select" >
                                              <option value="">(None)</option>
                                              <?php 

													 $sql7="select * from `anterior_segment_masters_for_emr` ORDER BY `anterior_segment` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {		

														 echo '<option value="'.$row7['anterior_segment'].'">'.$row7['anterior_segment'].'</option>';

													 }

													?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="anterior_lselect_button" class="btn btn-sm default" title="OK">OK</a></span> </div>
                                          <textarea id="anterior_left_segment" name="anterior_left_segment" class="form-control" rows="3" placeholder="Enter Anterior Segment"><?php echo $row['anterior_left_segment']; ?></textarea></td>
                                      </tr>
                                       <tr>
                                        <td><strong>Iridotomy</strong></td>
                                        <td><select class="form-control" name="iridotomy_left_select" id="iridotomy_left_select" >
                                            <option value="">(None)</option>
                                            <option value="Patent">Patent</option>
                                            <option value="Blocked">Blocked</option>
                                          </select></td>
                                        <td ><input type="text" id="iridotomy_left" name="iridotomy_left" class="form-control" value="<?php if($row['iridotomy_left']!=''){echo $row['iridotomy_left'];}?>" placeholder="Enter value"></td>
                                        <td><select class="form-control" name="iridotomy_right_select" id="iridotomy_right_select" >
                                            <option value="">(None)</option>
                                            <option value="Patent">Patent</option>
                                            <option value="Blocked">Blocked</option>
                                          </select></td>
                                        <td ><input type="text" id="iridotomy_right" name="iridotomy_right" class="form-control" value="<?php if($row['iridotomy_right']!=''){echo $row['iridotomy_right'];}?>" placeholder="Enter value"></td>
                                      </tr>
                                      <tr>
                                        <td colspan="5"><div class="col-md-12">
                                            <div class="portlet-body">
                                              <div class="row">
                                                <div class="col-md-1">
                                                  <div class="checkbox-list" style="padding-top:6px !important">
                                                    <label class="checkbox-inline"><span class="caption-subject font-white-sharp"><strong>IOP</strong></span></label>
                                                  </div>
                                                </div>
                                                <div class="col-md-11 font-white-sharp" style="margin-bottom:4px; padding:0;text-align:right;"><b>To Add IOP, please click on this icon</b><a href="javascript:void(0);"  id="add_at_details_button" class="btn" title="Add more" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                                                <div class="col-md-12" style="margin-bottom:4px; padding:0">
                                                  <div class="table-scrollable">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover" id="at_details_tab">
                                                      <tbody>
                                                        <?php

														 $sl=1;

														 $sql2="SELECT * FROM `at_details_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' and `del_flag`='0'";

									

														 $result2=$conn->query($sql2) ;

									

														 $count=$result2->num_rows;

									

														if($count=='0'){

									

														  echo '<input type="hidden" name="countiop" id="countiop" value="'.($count+1).'">';

									

																 ?>
                                                        <tr id="at_details_body<?php echo ($count+1); ?>">
                                                          <input type="hidden" name="at_flag<?php echo ($count+1); ?>" id="at_flag<?php echo ($count+1); ?>" value="0">
                                                          <td ><select name="at_select<?php echo ($count+1); ?>" id="at_select<?php echo ($count+1); ?>" class="form-control" >
                                                              <option value="GAT"  >GAT</option>
                                                              <option value="I-CARE"  >I-CARE</option>
                                                              <option value="TONOPEN"  >TONOPEN</option>
                                                              <option value="FT"  >FT</option>
                                                              <option value=""> Choose..</option>
                                                            </select></td>
                                                          <td >AT
                                                            <?php //echo date('h:i A'); ?>
                                                            <input type="text" style="width: 25%" name="at_time<?php echo ($count+1); ?>" id="at_time<?php echo ($count+1); ?>" value="<?php echo date('H:i:s'); ?>">
                                                            <input type="text" placeholder="Time in 24 hour format hh:mm:ss" style="border: none; width: -webkit-fill-available" disabled></td>
                                                          <td ><div class="input-group"> <span class="input-group-addon">OD</span>
                                                              <input type="text" class="form-control" placeholder="OD" name="at_od<?php echo ($count+1); ?>" id="at_od<?php echo ($count+1); ?>" value="">
                                                            </div></td>
                                                          <td ><div class="input-group"> <span class="input-group-addon">OS</span>
                                                              <input type="text" class="form-control" placeholder="OS" name="at_os<?php echo ($count+1); ?>" id="at_os<?php echo ($count+1); ?>" value="">
                                                            </div></td>
                                                          <td >&nbsp;</td>
                                                        </tr>
                                                        <?php } else{
														 echo '<input type="hidden" name="countiop" id="countiop" value="'.$count.'">';

								

														 while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))

								

														{

								

														?>
                                                        <tr id="at_details_body<?php echo $sl; ?>">
                                                          <input type="hidden" name="at_flag<?php echo $sl; ?>" id="at_flag<?php echo $sl; ?>" value="<?php echo $row2['at_flag'];?>">
                                                          <input type="hidden" name="at_insert_id<?php echo $sl; ?>" id="at_insert_id<?php echo $sl; ?>" value="<?php echo $row2['id'];?>">
                                                          <td ><select name="at_select<?php echo $sl; ?>" id="at_select<?php echo $sl; ?>" class="form-control" >
                                                              <option value="GAT"  <?php if($row2['at_select']=='GAT') echo 'selected'; ?>>GAT</option>
                                                              <option value="I-CARE"  <?php if($row2['at_select']=='I-CARE') echo 'selected'; ?>>I-CARE</option>
                                                              <option value="TONOPEN" <?php if($row2['at_select']=='TONOPEN') echo 'selected'; ?> >TONOPEN</option>
                                                              <option value="FT"  <?php if($row2['at_select']=='FT') echo 'selected'; ?>>FT</option>
                                                              <option value=""> Choose..</option>
                                                            </select></td>
                                                          <td >AT
                                                            <input type="text" style="width: 25%" name="at_time<?php echo $sl; ?>" id="at_time<?php echo $sl; ?>" value="<?php echo date('H:i:s',strtotime($row2['at_time'])); ?>">
                                                            <input type="text" placeholder="Time in 24 hour format hh:mm:ss" style="border: none; width: -webkit-fill-available" disabled></td>
                                                          <td ><div class="input-group"> <span class="input-group-addon">OD</span>
                                                              <input type="text" class="form-control" placeholder="OD" name="at_od<?php echo $sl; ?>" id="at_od<?php echo $sl; ?>" value="<?php echo $row2['at_od']; ?>">
                                                            </div></td>
                                                          <td ><div class="input-group"> <span class="input-group-addon">OS</span>
                                                              <input type="text" class="form-control" placeholder="OS" name="at_os<?php echo $sl; ?>" id="at_os<?php echo $sl; ?>" value="<?php echo $row2['at_os']; ?>">
                                                            </div></td>
                                                          <td><a href="javascript:void(0);"  id="at_details_remove<?php echo $sl; ?>" onClick="remove_at_details_del('<?php echo $sl; ?>','<?php echo $row2['id'];?>')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td>
                                                        </tr>
                                                        <?php $sl++; }} ?>
                                                      </tbody>
                                                      <input type="hidden" name="remove_id_for_at_details" id="remove_id_for_at_details" value=""  />
                                                    </table>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Gonioscopy
                                          <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                          <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('gonio_masters_for_emr','gonio','Gonioscopy','goneoscopy_select','goneoscopy_left_select')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                          <?php } ?>
                                          </strong></td>
                                        <td><select class="form-control" name="goneoscopy_select" id="goneoscopy_select" >
                                            <option value="">(None)</option>
                                            <?php 

													 $sql7="select * from `gonio_masters_for_emr` ORDER BY `gonio` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {		

														 echo '<option value="'.$row7['gonio'].'">'.$row7['gonio'].'</option>';
													 }

													?>
                                          </select></td>
                                        <td><input type="text" id="goneoscopy" name="goneoscopy" class="form-control" value="<?php echo $row['goneoscopy']; ?>" placeholder="Enter Value Or Select"></td>
                                        <td><select class="form-control" name="goneoscopy_left_select" id="goneoscopy_left_select" >
                                            <option value="">(None)</option>
                                            <?php 

													 $sql7="select * from `gonio_masters_for_emr` ORDER BY `gonio` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
													 {		

														 echo '<option value="'.$row7['gonio'].'">'.$row7['gonio'].'</option>';
													 }

													?>
                                          </select></td>
                                        <td><input type="text" id="goneoscopy_left" name="goneoscopy_left" class="form-control" value="<?php echo $row['goneoscopy_left']; ?>" placeholder="Enter Value Or Select"></td>
                                      </tr>
                                      <tr>
                                        <td><input type="checkbox" name="fundus_figure" id="fundus_figure" value="<?php echo $row['fundus_figure']; ?>" <?php if($row['fundus_figure']=='1') echo 'checked';  ?>>
                                          <strong>Fundus
                                          <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                          <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('fundus_masters_for_emr','fundus','Fundus','fundus_select','fundus_left_select')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                          <?php } ?>
                                          </strong><a href="<?php echo ADMIN_URL; ?>wPaint-master/index.php?pres_id=<?php echo $_REQUEST['id'];?>&mrd=<?php echo $row['mrd_no'];?>&fundus=1" target="_blank" class="btn btn-sm green" title="Fundus Drawing">Drawing</a></td>
                                        <td colspan="2"><div class="input-group" style="margin-bottom:9px;">
                                            <select class="form-control select2" name="fundus_select" id="fundus_select" >
                                              <option value="">(None)</option>
                                              <?php 

													 $sql7="select * from `fundus_masters_for_emr` ORDER BY `fundus` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {		

														 echo '<option value="'.$row7['fundus'].'">'.$row7['fundus'].'</option>';
													 }
													?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="fundus_select_button" class="btn btn-sm default" title="OK">OK</a></span> </div>
                                          <textarea id="fundus" name="fundus" class="form-control" rows="3" placeholder="Enter Fundus"><?php echo $row['fundus']; ?></textarea></td>
                                        <td colspan="2"><div class="input-group" style="margin-bottom:9px;">
                                            <select class="form-control select2" name="fundus_left_select" id="fundus_left_select" >
                                              <option value="">(None)</option>
                                              <?php 
													 $sql7="select * from `fundus_masters_for_emr` ORDER BY `fundus` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {	

														 echo '<option value="'.$row7['fundus'].'">'.$row7['fundus'].'</option>';
													 }

													?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="fundus_left_select_button" class="btn btn-sm default" title="OK">OK</a></span> </div>
                                          <textarea id="fundus_left" name="fundus_left" class="form-control" rows="3" placeholder="Enter Fundus"><?php echo $row['fundus_left']; ?></textarea></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Rop las</strong></td>
                                        <td colspan="2"><select class="form-control" name="roplas_right" id="roplas_right">
                                            <option value=""></option>
                                            <option value="+ve" <?php if($row['roplas_right']=='+ve') echo 'selected'; ?> >+ve</option>
                                            <option value="-ve" <?php if($row['roplas_right']=='-ve') echo 'selected'; ?> >-ve</option>
                                          </select></td>
                                        <td colspan="2"><select class="form-control" name="roplas_left" id="roplas_left">
                                            <option value=""></option>
                                            <option value="+ve" <?php if($row['roplas_left']=='+ve') echo 'selected'; ?> >+ve</option>
                                            <option value="-ve" <?php if($row['roplas_left']=='-ve') echo 'selected'; ?> >-ve</option>
                                          </select></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-8">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline"> <span class="caption-subject font-white-sharp"><strong>Investigation</strong></span> </label>
                                </div>
                              </div>
                              <div class="col-md-4" style="text-align:right"><a href="javascript:void(0);" class="btn btn-sm red" id="investigation_block_div_minus_bt" title="-" style="margin:0 !important;display:none;"><i class="fa fa-minus"></i></a><a href="javascript:void(0);" class="btn btn-sm green" id="investigation_block_div_plus_bt" title="+" style="margin:0 !important"><i class="fa fa-plus"></i></a></div>
                              <div id="investigation_block_div" style="display:none;">
                                <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                  <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-advance table-hover">
                                      <thead>
                                        <tr>
                                          <td width="15%"><div class="input-group" style="width: 100%">
                                              <select class="form-control" name="investigation_eye" id="investigation_eye" >
                                                <option value="">(None)</option>
                                                <option value="LE">LE</option>
                                                <option value="RE">RE</option>
                                                <option value="BE">BE</option>
                                                <option value="LE > RE">LE > RE</option>
                                                <option value="RE > LE">RE > LE</option>
                                              </select>
                                            </div></td>
                                          <td><div class="input-group" style="margin-bottom:9px; margin-top:6px;"><span class="input-group-addon" style="padding:0 9px !important">Individual
                                              <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                              <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('investigation_individual_masters_for_emr','investigation_individual','Investigation','investigation_list','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                              <?php } ?>
                                              </span>
                                              <select class="form-control" name="investigation_list" id="investigation_list" multiple>
                                                <?php 

                                             $sql7="select * from `investigation_individual_masters_for_emr` order by `investigation_individual` asc";
                                             $result7=$conn->query($sql7) ;

                                             while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
                                             {			
                                                 echo '<option value="'.$row7['investigation_individual'].'" >'.limit_text($row7['investigation_individual'], 9).'</option>';
                                             }

                                            ?>
                                              </select>
                                              <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="investigation_list_id_btn" class="btn btn-sm default" title="OK">OK</a></span> </div></td>
                                          <td><div class="input-group" style="margin-bottom:9px; margin-top:6px;"><span class="input-group-addon" style="padding:0 9px !important">Package
                                              <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                              <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="package_modal_open(1,'investigation_package_masters_for_emr','investigation_package','Investigation Package','investigationPackageSelect')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                              <?php } ?>
                                              </span>
                                              <select class="form-control" name="investigationPackageSelect" id="investigationPackageSelect" >
                                                <option value="">(None)</option>
                                                <?php 

													 $sql7="select * from `investigation_package_masters_for_emr` ORDER BY `investigation_package` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {	
														 echo '<option value="'.$row7['id'].'">'.$row7['investigation_package'].'</option>';

													 }

													?>
                                              </select>
                                            </div></td>
                                        </tr>
                                        <tr>
                                          <td colspan="4"><textarea id="investigation" name="investigation" class="form-control" rows="3" placeholder="Enter Investigation"><?php echo $row['investigation']; ?></textarea></td>
                                        </tr>
                                      </thead>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline"> <span class="caption-subject font-white-sharp"><strong>MISCELLANEOUS MEASUREMENTS</strong></span> </label>
                                </div>
                              </div>
                              <div class="col-md-8" style="text-align:right"><a href="javascript:void(0);" class="btn btn-sm red" id="k_block_div_minus_bt" title="-" style="margin:0 !important;display:none;"><i class="fa fa-minus"></i></a><a href="javascript:void(0);" class="btn btn-sm green" id="k_block_div_plus_bt" title="+" style="margin:0 !important"><i class="fa fa-plus"></i></a></div>
                              <div id="k_block_div" style="display:none;">
                                <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                  <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-advance table-hover">
                                      <tbody>
                                        <tr>
                                          <td><input type="checkbox" name="keratometry_block" id="keratometry_block" value="<?php echo $row['keratometry_block']; ?>" <?php if($row['keratometry_block']=='1') echo 'checked';  ?>>
                                            <strong>Keratometry</strong></td>
                                          <td><div class="input-group" style="margin-bottom:9px;"><span class="input-group-addon" style="padding:0 9px !important">K1</span>
                                              <input type="text" id="rk1" name="rk1" class="form-control" value="<?php echo $row['rk1']; ?>" placeholder="Enter value">
                                            </div></td>
                                          <td><div class="input-group" style="margin-bottom:9px;"><span class="input-group-addon" style="padding:0 9px !important">K2</span>
                                              <input type="text" id="rk2" name="rk2" class="form-control" value="<?php echo $row['rk2']; ?>" placeholder="Enter value">
                                            </div></td>
                                          <td><div class="input-group" style="margin-bottom:9px;"><span class="input-group-addon" style="padding:0 9px !important">K1</span>
                                              <input type="text" id="lk1" name="lk1" class="form-control" value="<?php echo $row['lk1']; ?>" placeholder="Enter value">
                                            </div></td>
                                          <td><div class="input-group" style="margin-bottom:9px;"><span class="input-group-addon" style="padding:0 9px !important">K2</span>
                                              <input type="text" id="lk2" name="lk2" class="form-control" value="<?php echo $row['lk2']; ?>" placeholder="Enter value">
                                            </div></td>
                                        </tr>
                                        <tr>
                                          <td><strong>Pachymetery</strong></td>
                                          <td colspan="2"><input type="text" id="pachymetery" name="pachymetery" class="form-control" value="<?php echo $row['pachymetery']; ?>" placeholder="Enter value"></td>
                                          <td colspan="2"><input type="text" id="pachymetery_left" name="pachymetery_left" class="form-control" value="<?php echo $row['pachymetery_left']; ?>" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                          <td><strong>Axial Length</strong></td>
                                          <td colspan="2"><input type="text" id="axial_length" name="axial_length" class="form-control" value="<?php echo $row['axial_length']; ?>" placeholder="Enter value"></td>
                                          <td colspan="2"><input type="text" id="axial_length_left" name="axial_length_left" class="form-control" value="<?php echo $row['axial_length_left']; ?>" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                          <td><strong>Scotopic Pupil Diameter</strong></td>
                                          <td colspan="2"><input type="text" id="scotopic_pupil" name="scotopic_pupil" class="form-control" value="<?php echo $row['scotopic_pupil']; ?>" placeholder="Enter value"></td>
                                          <td colspan="2"><input type="text" id="scotopic_pupil_left" name="scotopic_pupil_left" class="form-control" value="<?php echo $row['scotopic_pupil_left']; ?>" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                          <td><strong>W-W Diameter</strong></td>
                                          <td colspan="2"><input type="text" id="ww_diameter" name="ww_diameter" class="form-control" value="<?php echo $row['ww_diameter']; ?>" placeholder="Enter value"></td>
                                          <td colspan="2"><input type="text" id="ww_diameter_left" name="ww_diameter_left" class="form-control" value="<?php echo $row['ww_diameter_left']; ?>" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                          <td><strong>Anterior Chamber Depth</strong></td>
                                          <td colspan="2"><input type="text" id="anterior_chamber" name="anterior_chamber" class="form-control" value="<?php echo $row['anterior_chamber']; ?>" placeholder="Enter value"></td>
                                          <td colspan="2"><input type="text" id="anterior_chamber_left" name="anterior_chamber_left" class="form-control" value="<?php echo $row['anterior_chamber_left']; ?>" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                          <td><strong>IOL Power</strong></td>
                                          <td colspan="2"><input type="text" id="iol_power" name="iol_power" class="form-control" value="<?php echo $row['iol_power']; ?>" placeholder="Enter value"></td>
                                          <td colspan="2"><input type="text" id="iol_power_left" name="iol_power_left" class="form-control" value="<?php echo $row['iol_power_left']; ?>" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                          <td><strong>Schirmer's Test (Type II)</strong></td>
                                          <td colspan="2"><input type="text" id="schirmers_test" name="schirmers_test" class="form-control" value="<?php echo $row['schirmers_test']; ?>" placeholder="Enter value"></td>
                                          <td colspan="2"><input type="text" id="schirmers_test_left" name="schirmers_test_left" class="form-control" value="<?php echo $row['schirmers_test_left']; ?>" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                          <td><strong>Visual Fields</strong></td>
                                          <td colspan="2"><input type="text" id="visual_fields" name="visual_fields" class="form-control" value="<?php echo $row['visual_fields']; ?>" placeholder="Enter value"></td>
                                          <td colspan="2"><input type="text" id="visual_fields_left" name="visual_fields_left" class="form-control" value="<?php echo $row['visual_fields_left']; ?>" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                          <td><strong>OCT RNFL</strong></td>
                                          <td colspan="2"><input type="text" id="optical_coherence" name="optical_coherence" class="form-control" value="<?php echo $row['optical_coherence']; ?>" placeholder="Enter value"></td>
                                          <td colspan="2"><input type="text" id="optical_coherence_left" name="optical_coherence_left" class="form-control" value="<?php echo $row['optical_coherence_left']; ?>" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                          <td><strong>OCT MACULA</strong></td>
                                          <td colspan="2"><input type="text" id="oct_macula" name="oct_macula" class="form-control" value="<?php echo $row['oct_macula']; ?>" placeholder="Enter value"></td>
                                          <td colspan="2"><input type="text" id="oct_macula_left" name="oct_macula_left" class="form-control" value="<?php echo $row['oct_macula_left']; ?>" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                          <td><strong>Colour Vision (Ishihara Chart)</strong></td>
                                          <td colspan="2"><input type="text" id="color_vision_isihara" name="color_vision_isihara" class="form-control" value="<?php echo $row['color_vision_isihara']; ?>" placeholder="Enter value"></td>
                                          <td colspan="2"><input type="text" id="color_vision_isihara_left" name="color_vision_isihara_left" class="form-control" value="<?php echo $row['color_vision_isihara_left']; ?>" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                          <td><strong>Miscellaneous</strong></td>
                                          <td colspan="2"><input type="text" id="misc_findings" name="misc_findings" class="form-control" value="<?php if($row['misc_findings']!=''){echo $row['misc_findings'];} ?>" placeholder="Other Miscellaneous "></td>
                                          <td colspan="2"><input type="text" id="misc_findings_left" name="misc_findings_left" class="form-control" value="<?php if($row['misc_findings_left']!=''){echo $row['misc_findings_left'];} ?>" placeholder="Other Miscellaneous "></td>
                                        </tr>
                                        <tr>
                                          <td colspan="5"><div class="col-md-12">
                                              <div class="portlet-body">
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="checkbox-list" style="padding-top:6px !important">
                                                      <label class="checkbox-inline"><span class="caption-subject font-white-sharp"><strong>Miscellaneous Eye Test</strong></span></label>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-6 font-white-sharp" style="margin-bottom:4px; padding:0;text-align:right;"><b>To Add Test, please click on this icon</b><a href="javascript:void(0);"  id="add_miscellaneous_eye_test_button" class="btn" title="Add more" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                                                  <div class="col-md-12" style="margin-bottom:4px; padding:0">
                                                    <div class="table-scrollable">
                                                      <table class="table table-striped table-bordered table-advance table-hover" id="miscellaneous_eye_test_tab">
                                                        <tbody>
                                                          <?php
						 $sl=1;
						 $sql2="SELECT * FROM `miscellaneous_eye_test_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' and `del_flag`='0'";
						 $result2=$conn->query($sql2) ;
						 $count=$result2->num_rows;
						if($count=='0'){
						  echo '<input type="hidden" name="count_miscellaneous_eye_test" id="count_miscellaneous_eye_test" value="'.($count+1).'">';
				 ?>
                                                          <tr id="miscellaneous_eye_test_body<?php echo ($count+1); ?>">
                                                            <input type="hidden" name="misc_eye_test_flag<?php echo ($count+1); ?>" id="misc_eye_test_flag<?php echo ($count+1); ?>" value="0">
                                                            <td ><select name="misc_eye_test_select<?php echo ($count+1); ?>" id="misc_eye_test_select<?php echo ($count+1); ?>" class="form-control" >
                                                                <option value=""> Choose..</option>
                                                                <?php 

								 $sql7="select * from `miscellaneous_eye_test_masters_for_emr`  WHERE `del_flag`='0' ORDER BY `misc_eye_test_name` asc";

								 $result7=$conn->query($sql7) ;

								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

								 {	
									 echo '<option value="'.$row7['id'].'">'.$row7['misc_eye_test_name'].'</option>';

								 }

								?>
                                                              </select></td>
                                                            <td colspan="2"><input type="text" class="form-control" placeholder="OD" name="misc_eye_test_od<?php echo ($count+1); ?>" id="misc_eye_test_od<?php echo ($count+1); ?>" value=""></td>
                                                            <td colspan="2"><input type="text" class="form-control" placeholder="OS" name="misc_eye_test_os<?php echo ($count+1); ?>" id="misc_eye_test_os<?php echo ($count+1); ?>" value=""></td>
                                                            <td >&nbsp;</td>
                                                          </tr>
                                                          <?php } else{
							 echo '<input type="hidden" name="count_miscellaneous_eye_test" id="count_miscellaneous_eye_test" value="'.$count.'">';	
							 while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))
							{	
				  ?>
                                                          <tr id="miscellaneous_eye_test_body<?php echo $sl; ?>">
                                                            <input type="hidden" name="misc_eye_test_flag<?php echo $sl; ?>" id="misc_eye_test_flag<?php echo $sl; ?>" value="<?php echo $row2['misc_eye_test_flag'];?>">
                                                            <input type="hidden" name="misc_eye_test_insert_id<?php echo $sl; ?>" id="misc_eye_test_insert_id<?php echo $sl; ?>" value="<?php echo $row2['id'];?>">
                                                            <td ><select name="misc_eye_test_select<?php echo $sl; ?>" id="misc_eye_test_select<?php echo $sl; ?>" class="form-control" >
                                                                <option value=""> Choose..</option>
                                                                <?php 

								 $sql7="select * from `miscellaneous_eye_test_masters_for_emr` ORDER BY `misc_eye_test_name` asc";
								 $result7=$conn->query($sql7) ;
								 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
								 {										 
									  echo '<option value="'.$row7['id'].'" '; if($row2['misc_eye_test_select']==$row7['id']) echo 'selected'; echo '>'.$row7['misc_eye_test_name'].'</option>';
								 }
								?>
                                                              </select></td>
                                                            <td colspan="2"><input type="text" class="form-control" placeholder="OD" name="misc_eye_test_od<?php echo $sl; ?>" id="misc_eye_test_od<?php echo $sl; ?>"  value="<?php echo $row2['misc_eye_test_od']; ?>"></td>
                                                            <td colspan="2"><input type="text" class="form-control" placeholder="OS" name="misc_eye_test_os<?php echo $sl; ?>" id="misc_eye_test_os<?php echo $sl; ?>"  value="<?php echo $row2['misc_eye_test_os']; ?>"></td>
                                                            <td><a href="javascript:void(0);"  id="miscellaneous_eye_test_remove<?php echo $sl; ?>" onClick="remove_miscellaneous_eye_test_del('<?php echo $sl; ?>','<?php echo $row2['id'];?>')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td>
                                                          </tr>
                                                          <?php $sl++; }} ?>
                                                        </tbody>
                                                        <input type="hidden" name="remove_id_for_miscellaneous_eye_test" id="remove_id_for_miscellaneous_eye_test" value=""  />
                                                      </table>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-2">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline"> <span class="caption-subject font-white-sharp"><strong>Diagnosis<a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="diagnosis_modal_open()"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a></strong></span></label>
                                </div>
                              </div>
                              <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                <div class="table-scrollable">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                    <tbody>
                                    
                                      <td><div class="input-group" style="margin-bottom:9px;">
                                          <select class="form-control" name="sed_drop" id="sed_drop" >
                                            <option value="">Select</option>
                                            <option value="LE">LE</option>
                                            <option value="RE">RE</option>
                                            <option value="BE">BE</option>
                                            <option value="LE > RE">LE > RE</option>
                                            <option value="RE > LE">RE > LE</option>
                                          </select>
                                        </div>
                                        <div class="input-group" style="margin-bottom:9px;">
                                          <select class=" form-control select2" name="brand-filter" id="brand-filter"  >
                                            <option value="">None</option>
                                            <?php 

                                                     $sql7="select * from `diagnosis_masters_for_emr` ORDER BY `diagnosis` asc";

                                                     $result7=$conn->query($sql7) ;

                                                     while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

                                                     {		

                                                         echo '<option value="'.$row7['code'].' '.$row7['diagnosis'].'">'.$row7['code'].' '.$row7['diagnosis'].'</option>';

                                                     }

                                                    ?>
                                          </select>
                                          <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="diagnosis_button" class="btn btn-sm default" title="OK">OK</a></span></div>
                                        <textarea id="diagnostic" name="diagnostic" class="form-control" rows="3" placeholder="Enter Diagnostic"><?php echo $row['diagnostic']; ?></textarea></td>
                                    </tr>
                                      </tbody>
                                    
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-3">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline">
                                    <input type="checkbox" name="pre_operative_block" id="pre_operative_block" value="<?php echo $row['pre_operative_block']; ?>" <?php if($row['pre_operative_block']=='1') echo 'checked';  ?>>
                                    <span class="caption-subject font-white-sharp"><strong>Pre-Operative
                                    <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                    <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="package_modal_open(2,'pre_operative_package_master_for_emr','pre_operative_package','Pre-Operative','preopePackageSelect')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                    <?php } ?>
                                    </strong></span></label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                          <div class="table-scrollable">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                              <thead>
                                <tr>
                                  <td><div class="input-group" style="margin-bottom:9px; margin-top:6px;"><span class="input-group-addon" style="padding:0 9px !important">Package</span>
                                      <select class="form-control" name="preopePackageSelect" id="preopePackageSelect" >
                                        <option value="">(None)</option>
                                        <?php 
													 $sql7="select * from `pre_operative_package_master_for_emr` ORDER BY `pre_operative_package` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {	

														 echo '<option value="'.$row7['id'].'">'.$row7['pre_operative_package'].'</option>';

													 }

													?>
                                      </select>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td colspan="3"><textarea id="pre_operative" name="pre_operative" class="form-control" rows="9" placeholder="Enter pre-operative"><?php echo $row['pre_operative']; ?></textarea></td>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-12"><br>
                                <div class="col-md-6"> <span id="span_title"><u>Prescribing medicine to the patient</u></span> </div>
                                <div class="col-md-3">
                                  <div class="checkbox-list" style="padding-top:6px !important">
                                    <label class="checkbox-inline">
                                      <input type="checkbox" name="medication_block" id="medication_block" value="<?php echo $row['medication_block']; ?>" <?php if($row['medication_block']=='1') echo 'checked';  ?>>
                                      <span class="caption-subject font-white-sharp"><strong>Medication</strong></span></label>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="checkbox-list" style="padding-top:6px !important">
                                    <label class="checkbox-inline">
                                      <input type="checkbox" name="spmedication_block" id="spmedication_block" value="<?php echo $row['spmedication_block']; ?>" <?php if($row['spmedication_block']=='1') echo 'checked';  ?>>
                                      <span class="caption-subject font-white-sharp"><strong>Separate Medication</strong></span></label>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                <div class="table-scrollable">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                      <tr>
                                        <th ><strong>EYE</strong></th>
                                        <th ><strong>DRUG
                                          <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                          <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('drug_masters_for_emr','medication_individual','Drug','medi','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                          <?php } ?>
                                          </strong></th>
                                        <th ><strong>DOSAGE
                                          <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                          <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('dosage_master_for_emr','name','Dosage','medi_num','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                          <?php } ?>
                                          </strong></th>
                                        <th ><strong>TIME</strong></th>
                                        <th ><strong>NO</strong></th>
                                        <th ><strong>DURATION</strong></th>
                                        <th ><strong>REMARK
                                          <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                          <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('remark_medi_master_for_emr','name','Remark','medi_remark','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                          <?php } ?>
                                          </strong></th>
                                        <th ><strong>&nbsp;</strong></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td width="10%"><div class="input-group">
                                            <select class="form-control" name="medi_eye" id="medi_eye">
                                              <option value="">(None)</option>
                                              <option value="LE">LE</option>
                                              <option value="RE">RE</option>
                                              <option value="BE">BE</option>
                                              <option value="LE > RE">LE > RE</option>
                                              <option value="RE > LE">RE > LE</option>
                                            </select>
                                          </div></td>
                                        <td width="30%"><div class="input-group">
                                            <select class="form-control select2" name="medi" id="medi">
                                              <option value="">(None)</option>
                                              <?php 
													 $sql7="select * from `drug_masters_for_emr` Where `medication_individual`<>'' ORDER BY `medication_individual` ";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {								 
														 echo '<option value="'.$row7['medication_individual'].'">'.limit_text($row7['medication_individual'], 10).'</option>';

													 }

													?>
                                            </select>
                                          </div></td>
                                        <td width="10%"><div class="input-group">
                                            <select class="form-control" name="medi_num" id="medi_num">
                                              <option value="">(None)</option>
                                              <?php 

												 	 $sql7="select * from `dosage_master_for_emr`  ORDER BY `name` ";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {								 
														 echo '<option value="'.$row7['name'].'">'.limit_text($row7['name'], 10).'</option>';

													 }

													?>
                                            </select>
                                          </div></td>
                                        <td width="10%"><div class="input-group">
                                            <select class="form-control" name="medi_dur" id="medi_dur">
                                              <option value="">(None)</option>
                                              <?php 

												 	 $sql7="select * from `time_master_for_emr` ORDER BY `name` ";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {								 
														 echo '<option value="'.$row7['name'].'">'.limit_text($row7['name'], 10).'</option>';

													 }

													?>
                                            </select>
                                          </div></td>
                                        <td width="10%"><div class="input-group">
                                            <select class="form-control" name="medi_time" id="medi_time">
                                              <option value="">(None)</option>
                                              <?php $dt=1;

											  while($dt<11){

											  ?>
                                              <option value="<?php echo $dt; ?>"  ><?php echo $dt; ?></option>
                                              <?php $dt++;} ?>
                                              <option value="15"  >15</option>
                                              <option value="20"  >20</option>
                                              <option value="30"  >30</option>
                                              <option value="45"  >45</option>
                                              <option value="60"  >60</option>
                                              <option value="90"  >90</option>
                                            </select>
                                          </div></td>
                                        <td width="10%"><div class="input-group">
                                            <select class="form-control" name="medi_ampm" id="medi_ampm">
                                              <option value="">(None)</option>
                                              <option value="day">day</option>
                                              <option value="days">days</option>
                                              <option value="week">week</option>
                                              <option value="weeks">weeks</option>
                                              <option value="month">month</option>
                                              <option value="months">months</option>
                                              <option value="year">year</option>
                                              <option value="years">years</option>
                                              <option value="to continue till next review">to continue till next review</option>
                                            </select>
                                          </div></td>
                                        <td width="10%"><div class="input-group">
                                            <select class="form-control" name="medi_remark" id="medi_remark">
                                              <option value="">(None)</option>
                                              <?php 

												 	 $sql7="select * from `remark_medi_master_for_emr`  ORDER BY `name` ";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {								 
														 echo '<option value="'.$row7['name'].'">'.limit_text($row7['name'], 10).'</option>';

													 }

													?>
                                            </select>
                                          </div></td>
                                        <td width="10%"><div class="input-group"> <a href="javascript:void(0);"  id="medicationid" class="btn btn-sm default" title="OK">OK</a> </div></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                <div class="table-scrollable">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                      <tr>
                                        <td><div class="input-group" style="margin-bottom:9px; margin-top:6px;"><span class="input-group-addon" style="padding:0 9px !important">Individual
                                            <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                            <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('medication_individual_masters_for_emr','medication_individual','Medication Individual','mediIndSearch','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                            <?php } ?>
                                            </span>
                                            <select class="form-control select2" name="mediIndSearch" id="mediIndSearch" >
                                              <option value="">(None)</option>
                                              <?php 
													 $sql7="select * from `medication_individual_masters_for_emr` Where `medication_individual`<>'' ORDER BY `medication_individual` ";
													 $result7=$conn->query($sql7) ;
													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
													 {									 
														 echo '<option value="'.$row7['medication_individual'].'">'.limit_text($row7['medication_individual'], 10).'</option>';
													 }
													?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="medi_individual_btn" class="btn btn-sm default" title="OK">OK</a></span> </div></td>
                                        <td><select class="form-control" name="medication_eye_select" id="medication_eye_select">
                                            <option value="">(None)</option>
                                            <option value="LE">LE</option>
                                            <option value="RE">RE</option>
                                            <option value="BE">BE</option>
                                            <option value="LE > RE">LE > RE</option>
                                            <option value="RE > LE">RE > LE</option>
                                          </select></td>
                                        <td><div class="input-group" style="margin-bottom:9px; margin-top:6px;"><span class="input-group-addon" style="padding:0 9px !important">Package
                                            <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                            <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="package_modal_open(3,'medication_package_masters_for_emr','medication_package','Medication Package','mediPackageSelect')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                            <?php } ?>
                                            </span>
                                            <select class="form-control" name="mediPackageSelect" id="mediPackageSelect" >
                                              <option value="">(None)</option>
                                              <?php 
													 $sql7="select * from `medication_package_masters_for_emr` ORDER BY `medication_package` ";
													 $result7=$conn->query($sql7) ;
													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
													 {									 
														 echo '<option value="'.$row7['id'].'">'.$row7['medication_package'].'</option>';
													 }
													?>
                                            </select>
                                          </div></td>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                <div class="table-scrollable">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                    <tr>
                                      <td colspan="3"><textarea id="medication" name="medication" class="form-control" rows="9" placeholder="Enter medication"><?php echo $row['medication']; ?></textarea>
                                        <input type="hidden" id="medication_hide" name="medication_hide" value="<?php echo $row['medication']; ?>"></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline">
                                    <input type="checkbox" name="surgery_block" id="surgery_block" value="<?php echo $row['surgery_block']; ?>" <?php if($row['surgery_block']=='1') echo 'checked';  ?>>
                                    <span class="caption-subject font-white-sharp"><strong>Surgery</strong></span> </label>
                                  <label class="checkbox-inline">
                                    <select class="form-control" name="surgery_for" id="surgery_for" >
                                      <option value="">(None)</option>
                                      <option value="LE">LE</option>
                                      <option value="RE">RE</option>
                                      <option value="BE">BE</option>
                                      <option value="LE > RE">LE > RE</option>
                                      <option value="RE > LE">RE > LE</option>
                                    </select>
                                  </label>
                                </div>
                              </div>
                              <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                <div class="table-scrollable">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                      <tr>
                                        <td><div class="input-group" style="margin-bottom:9px; margin-top:6px;"><span class="input-group-addon" style="padding:0 9px !important">Surgery Advice
                                            <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                            <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('surgery_advice_masters_for_emr','surgery_advice','Surgery Advice','surgery_select','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                            <?php } ?>
                                            </span>
                                            <select class="form-control" name="surgery_select" id="surgery_select"  multiple>
                                              <?php 

												 $sql7="select * from `surgery_advice_masters_for_emr` order by `surgery_advice` asc";

												 $result7=$conn->query($sql7) ;

												 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

												 {		

													 echo '<option value="'.$row7['surgery_advice'].'" >'.limit_text($row7['surgery_advice'], 15).'</option>';

												 }

												?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="surgery_select_btn" class="btn btn-sm default" title="OK">OK</a></span> </div></td>
                                        <td><div class="input-group" style="margin-bottom:9px; margin-top:6px;"><span class="input-group-addon" style="padding:0 9px !important">Surgery Risk
                                            <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                            <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('surgery_risk_masters_for_emr','surgery_risk','Surgery Risk','surgPackageSelect','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                            <?php } ?>
                                            </span>
                                            <select class="form-control" name="surgPackageSelect" id="surgPackageSelect"  multiple>
                                              <?php 

												 $sql7="select * from `surgery_risk_masters_for_emr` order by `surgery_risk` asc";

												 $result7=$conn->query($sql7) ;

												 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

												 {			

													 echo '<option value="'.$row7['surgery_risk'].'" >'.limit_text($row7['surgery_risk'], 7).'</option>';

				

												 }

												?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="surgPackageSelect_btn" class="btn btn-sm default" title="OK">OK</a></span> </div></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"><textarea id="surgery" name="surgery" class="form-control" rows="9" placeholder="Enter surgery"><?php echo $row['surgery']; ?></textarea></td>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                <div class="table-scrollable">
                                  <table class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                      <tr>
                                        <td  width="35%"><div class="input-group" style="margin-bottom:9px; margin-top:6px;"><span class="input-group-addon" style="padding:0 9px !important">Explained About</span>
                                            <select class="form-control select2" name="explained_surgery" id="explained_surgery"  >
                                              <?php 

                                         $sql7="select * from `surgery_risk_explains_masters_for_emr` order by `surgery_risk_exp` ";

                                         $result7=$conn->query($sql7) ;

                                         while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

                                         {									 

                                             echo '<option value="'.$row7['surgery_risk_exp'].'" >'.limit_text($row7['surgery_risk_exp'], 15).'</option>';

                                         }

                                        ?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 !important;"><a href="javascript:void(0);"  id="explained_surgery_btn" class="btn btn-sm default" title="OK">OK</a></span> </div></td>
                                        <td colspan="2"><textarea id="explained_surgery_textarea" name="explained_surgery_textarea" class="form-control" rows="2" placeholder="Enter Explained About"><?php echo $row['explained_surgery_textarea']; ?></textarea></td>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline"> <span class="caption-subject font-white-sharp"><strong>Procedure</strong></span> </label>
                                </div>
                              </div>
                              <div class="col-md-8" style="text-align:right"><a href="javascript:void(0);" class="btn btn-sm red" id="procedure_block_div_minus_bt" title="-" style="margin:0 !important;display:none;"><i class="fa fa-minus"></i></a><a href="javascript:void(0);" class="btn btn-sm green" id="procedure_block_div_plus_bt" title="+" style="margin:0 !important"><i class="fa fa-plus"></i></a></div>
                              <div id="procedure_block_div" style="display:none;">
                                <div class="col-md-12">
                                  <div class="checkbox-list" style="padding-top:6px !important">
                                    <label class="checkbox-inline">
                                      <input type="checkbox" name="procedure_block" id="procedure_block" value="<?php echo $row['procedure_block']; ?>" <?php if($row['procedure_block']=='1') echo 'checked';  ?>>
                                      <span class="caption-subject font-white-sharp"><strong>Procedure
                                      <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                      <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('procedure_package_masters_for_emr','procedure_package','Procedure Package','procedure_select','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                      <?php } ?>
                                      </strong></span></label>
                                    <label class="checkbox-inline">
                                      <select class="form-control" name="proced_drop" id="proced_drop" >
                                        <option value="">Select</option>
                                        <option value="LE">LE</option>
                                        <option value="RE">RE</option>
                                        <option value="BE">BE</option>
                                        <option value="LE > RE">LE > RE</option>
                                        <option value="RE > LE">RE > LE</option>
                                      </select>
                                    </label>
                                    <label class="checkbox-inline">
                                      <select class="form-control" name="procedure_select" id="procedure_select" >
                                        <option value="">Select</option>
                                        <?php 

                                            $sql7="select * from `procedure_package_masters_for_emr` ORDER BY `procedure_package` asc";

                                            $result7=$conn->query($sql7) ;

                                            while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

                                            {	

                                            echo '<option value="'.$row7['procedure_package'].'">'.$row7['procedure_package'].'</option>';

                                            }

                                            ?>
                                      </select>
                                    </label>
                                    <label class="checkbox-inline">
                                      <select class="form-control" name="procedure_sub_select" id="procedure_sub_select" >
                                        <option value="">(None)</option>
                                      </select>
                                    </label>
                                    <label class="checkbox-inline">
                                      <select  name="procedure_location" id="procedure_location" class="form-control" >
                                        <option value="">None</option>
                                        <?php 

                                                     $sql7="select * from `location_masters_for_emr` order by `location` asc";

                                                     $result7=$conn->query($sql7) ;

                                                     while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

                                                     {	
                                                         echo '<option value="'.$row7['location'].'" ';  echo '>'.$row7['location'].'</option>';
                                                     }

                                                    ?>
                                      </select>
                                    </label>
                                    <a href="javascript:void(0);"  id="procedureid" class="btn btn-sm default" title="OK">OK</a> </div>
                                </div>
                                <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                  <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-advance table-hover">
                                      <tbody>
                                        <tr>
                                          <td  ><textarea id="procedure_comments" name="procedure_comments" class="form-control" rows="3" placeholder="Enter Procedure Comments"><?php echo $row['procedure_comments']; ?></textarea></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-8">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline">
                                    <input type="checkbox" name="ot_notes_block" id="ot_notes_block" value="<?php echo $row['ot_notes_block']; ?>" <?php if($row['ot_notes_block']=='1') echo 'checked';  ?>>
                                    <span class="caption-subject font-white-sharp"><strong>OT Notes</strong></span></label>
                                </div>
                              </div>
                              <div class="col-md-4" style="text-align:right"><a href="javascript:void(0);" class="btn btn-sm red" id="otnotes_block_div_minus_bt" title="-" style="margin:0 !important;display:none;"><i class="fa fa-minus"></i></a><a href="javascript:void(0);" class="btn btn-sm green" id="otnotes_block_div_plus_bt" title="+" style="margin:0 !important"><i class="fa fa-plus"></i></a></div>
                              <div id="otnotes_block_div" style="display:none;">
                                <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                  <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-advance table-hover">
                                      <thead>
                                        <tr>
                                          <th ><strong>Eye</strong></th>
                                          <th><strong>Surgeon Name</strong></th>
                                          <th ><strong>Assitant Name</strong></th>
                                          <th ><strong>Anasthesia
                                            <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                            <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('anasthesia_for_emr','anasthesia_name','Anasthesia','ot_anasthesia_name','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                            <?php } ?>
                                            </strong></th>
                                          <th ><strong>Procedure Details
                                            <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                            <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('procedure_details_master_for_emr','procedure_name','Procedure','ot_procedure_name','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                            <?php } ?>
                                            </strong></th>
                                          <th ><strong>IOL Lens Power</strong></th>
                                          <th ><strong>IOL Lens Name
                                            <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                            <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('lens_masters_for_emr','lens_masters_name','Lens','lens_masters_name','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                            <?php } ?>
                                            </strong></th>
                                          <th ><strong>Any additinal remarks</strong></th>
                                          <th ><strong>Location</strong></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td width="10%"><div class="input-group">
                                              <select class="form-control" name="ot_eye" id="ot_eye">
                                                <option value="">(None)</option>
                                                <option value="LE">LE</option>
                                                <option value="RE">RE</option>
                                                <option value="BE">BE</option>
                                                <option value="LE > RE">LE > RE</option>
                                                <option value="RE > LE">RE > LE</option>
                                              </select>
                                            </div></td>
                                          <td width="15%"><div class="input-group">
                                              <select class="form-control  select2" name="ot_surgeon_name" id="ot_surgeon_name">
                                                <option value="">Choose Doctor / Optom</option>
                                                <?php 
												
												// AND `users`.`id` = '".$_SESSION['id']."'	
												  $sql7="select `users`.`id`,`user_infos`.`name` from `users` inner join `user_infos` on `users`.`id` = `user_infos`.`users_id` where `users`.`role` = '5'   order by `user_infos`.`name` asc";

												 $result7=$conn->query($sql7) ;

												 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

												 {				
													 echo '<option value="'.$row7['name'].'" ';  echo '>'.$row7['name'].'</option>';

												 }

												?>
                                              </select>
                                            </div></td>
                                          <td width="10%"><div class="input-group">
                                              <select class="form-control" name="ot_assitant_name" id="ot_assitant_name">
                                                <option value="">(None)</option>
                                                <?php 

													 $sql7="select * from `assitants_for_emr` Where `assitant_name`<>'' ORDER BY `assitant_name` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {		
														 echo '<option value="'.$row7['assitant_name'].'">'.$row7['assitant_name'].'</option>';

													 }

													?>
                                              </select>
                                            </div></td>
                                          <td width="15%"><div class="input-group">
                                              <select class="form-control" name="ot_anasthesia_name" id="ot_anasthesia_name">
                                                <option value="">(None)</option>
                                                <?php 

													 $sql7="select * from `anasthesia_for_emr` Where `anasthesia_name`<>'' ORDER BY `anasthesia_name` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {	

														 echo '<option value="'.$row7['anasthesia_name'].'">'.$row7['anasthesia_name'].'</option>';

													 }

													?>
                                              </select>
                                            </div></td>
                                          <td width="20%"><div class="input-group">
                                              <select class="form-control" name="ot_procedure_name" id="ot_procedure_name">
                                                <option value="">(None)</option>
                                                <?php 

													 $sql7="select * from `procedure_details_master_for_emr` Where `procedure_name`<>'' ORDER BY `procedure_name` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {	
														 echo '<option value="'.$row7['procedure_name'].'">'.$row7['procedure_name'].'</option>';

													 }

													?>
                                              </select>
                                            </div></td>
                                          <td width="10%"><div class="input-group">
                                              <textarea id="iol_details" name="iol_details" class="form-control"  placeholder="Enter IOL Details"></textarea>
                                            </div></td>
                                          <td width="10%"><div class="input-group">
                                              <select class="form-control" name="lens_masters_name" id="lens_masters_name">
                                                <option value="">(None)</option>
                                                <?php 

													 $sql7="select * from `lens_masters_for_emr` Where `lens_masters_name`<>'' ORDER BY `lens_masters_name` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {		

														 echo '<option value="'.$row7['lens_masters_name'].'">'.$row7['lens_masters_name'].'</option>';

													 }

													?>
                                              </select>
                                            </div></td>
                                          <td width="10%"><div class="input-group">
                                              <textarea id="any_additinal_remarks" name="any_additinal_remarks" class="form-control"  placeholder="Any additinal remarks"></textarea>
                                            </div></td>
                                          <td width="10%"><div class="input-group">
                                              <select  name="ot_location" id="ot_location" class="form-control" >
                                                <option value="">None</option>
                                                <?php 
                                                     $sql7="select * from `location_masters_for_emr` order by `location` asc";
                                                     $result7=$conn->query($sql7) ;
                                                     while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))
                                                     {		
                                                         echo '<option value="'.$row7['location'].'" ';  echo '>'.$row7['location'].'</option>';
                                                     }
                                                    ?>
                                              </select>
                                            </div></td>
                                        </tr>
                                        <tr>
                                          <td ><div class="input-group"><strong>Surgery Date</strong></div></td>
                                          <td ><div class="input-group">
                                              <input class="form-control form-control-inline date-picker" type="date"  placeholder="Select Date" id="surgery_date" name="surgery_date" />
                                            </div></td>
                                          <td colspan="7" ><a href="javascript:void(0);"  id="ot_notes_btn" class="btn btn-sm default" title="OK">OK</a></td>
                                        </tr>
                                        <tr>
                                          <td colspan="9" ><textarea id="ot_notes" name="ot_notes" class="form-control" rows="3" placeholder="Enter OT Notes"><?php echo $row['ot_notes']; ?></textarea></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline"> <span class="caption-subject font-white-sharp"><strong>General Instructions / Action Plan</strong></span></label>
                                </div>
                              </div>
                              <div class="col-md-12" style="margin-bottom:4px; padding-top:0;overflow-x:hidden;">
                                <div class="table-scrollable">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                    <thead>
                                      <tr>
                                        <th ><strong>Action Plan</strong></th>
                                        <th><strong>General Instructions
                                          <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                          <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('general_advise_masters_for_emr','general_advise','General Instructions','general_instructions_list_slct','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                          <?php } ?>
                                          </strong></th>
                                        <th ><strong>General Information
                                          <?php if($_SESSION['emr_pres_master_add_flag']=='1'){?>
                                          <a href="javascript:void(0);" id="add_complaints" data-toggle="modal" title="ADD NEW" onClick="masters_modal_open('general_information_masters_for_emr','general_information_masters_name','General Information','general_information','')"><i class="fa fa-plus" style="font-size:22px;color:green;margin-left:5px;margin-top:6px"></i></a>
                                          <?php } ?>
                                          </strong></th>
                                        <th ><strong>&nbsp; </strong></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td width="30%"><div class="input-group">
                                            <textarea id="action_plan" name="action_plan" class="form-control"  placeholder="Action Plan" cols="50" rows="4"></textarea>
                                          </div></td>
                                        <td width="20%"><div class="input-group">
                                            <select class="form-control" name="general_instructions_list_slct" id="general_instructions_list_slct"  >
                                              <option value="">(None)</option>
                                              <?php

                                         $sql7="select * from `general_advise_masters_for_emr` order by `general_advise` asc";

                                         $result7=$conn->query($sql7) ;

                                         while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

                                         {	
                                             echo '<option value="'.$row7['general_advise'].'" >'.$row7['general_advise'].'</option>';
                                         }

                                        ?>
                                            </select>
                                          </div></td>
                                        <td width="20%"><div class="input-group">
                                            <select class="form-control" name="general_information" id="general_information">
                                              <option value="">(None)</option>
                                              <?php 

													 $sql7="select * from `general_information_masters_for_emr` Where `general_information_masters_name`<>'' ORDER BY `general_information_masters_name` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {	
														 echo '<option value="'.$row7['general_information_masters_name'].'">'.$row7['general_information_masters_name'].'</option>';
													 }

													?>
                                            </select>
                                          </div></td>
                                        <td width="10%"><a href="javascript:void(0);"  id="generale_insta_btn" class="btn btn-sm default" title="OK">OK</a></td>
                                      </tr>
                                      <tr>
                                        <td colspan="4" ><textarea id="general_instructions" name="general_instructions" class="form-control" rows="9" placeholder="Enter general Instructions"><?php echo $row['general_instructions']; ?></textarea></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="myimages" style="margin-left:15px;">
                                <tr>
                                  <td><input type="button" value="Upload from camera" id="opener" class="btn btn-sm yellow-gold" />
                                    <input type="hidden" id="i_id" name="i_id" class="form-control" value="<?php echo $_REQUEST['id'];?>">
                                    <div id="dialog" >
                                      <iframe id="frame1" src="" height="100%" width="100%"></iframe>
                                    </div></td>
                                  <td><ul id="images">
                                      <?php
								   $prescription_id_=mysqli_escape_string($conn,$_REQUEST['id']);
								   	$sql_="select * from `image_list_for_emr` where `prescription_id`='".$prescription_id_."'";
									$res_=mysqli_query($conn,$sql_);
									$ctr=0;
									while($row_=mysqli_fetch_assoc($res_)){
										$ctr++;
									?>
                                      <li id='li<?php echo $ctr; ?>'><a id='a<?php echo $ctr; ?>' href='javascript:' onclick="$('#img<?php echo $ctr; ?>').modal('show');"><img src='<?php echo $row_['url']; ?>' width='120' height='160' /></a><span class='close' onclick="del_img('li<?php echo $ctr; ?>','<?php echo $row_['image_name']; ?>')" style="width:20px !important; height:20px !important">x</span>
                                        <button class='btn blue'><?php echo $row_['image_name']; ?></button>
                                        &nbsp;  &nbsp;</li>
                                      <div class="modal fade draggable-modal" id="img<?php echo $ctr; ?>" tabindex="-1" role="basic" aria-hidden="true">
                                        <div class="modal-dialog" id="model_header" style="width:672px">
                                          <div class="modal-content">
                                            <div class="modal-body"> <img src='<?php echo $row_['url']; ?>'/> </div>
                                          </div>
                                        </div>
                                      </div>
                                      <?php	
									}
								   ?>
                                    </ul>
                                    <input type="hidden" id="counter_val" value="<?php echo $ctr; ?>" /></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-8">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline"> <span class="caption-subject font-white-sharp"><strong>Certificate</strong></span></label>
                                </div>
                              </div>
                              <div class="col-md-4" style="text-align:right"><a href="javascript:void(0);" class="btn btn-sm red" id="certificate_block_div_minus_bt" title="-" style="margin:0 !important;display:none;"><i class="fa fa-minus"></i></a><a href="javascript:void(0);" class="btn btn-sm green" id="certificate_block_div_plus_bt" title="+" style="margin:0 !important"><i class="fa fa-plus"></i></a></div>
                              <div id="certificate_block_div" style="display:none;">
                                <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                  <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-advance table-hover">
                                      <thead>
                                        <tr>
                                          <th ><strong>Choose Certificate</strong></th>
                                          <th ><strong>&nbsp; </strong></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td width="70%"><div class="input-group">
                                              <select class="form-control" name="certificate_select" id="certificate_select">
                                                <option value="">(None)</option>
                                                <?php 

													 $sql7="select * from `certificate_masters_for_emr` Where `certificate_masters_name`<>'' ORDER BY `certificate_masters_name` asc";

													 $result7=$conn->query($sql7) ;

													 while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC))

													 {	

														 echo '<option value="'.$row7['certificate_masters_name'].'">'.$row7['certificate_masters_name'].'</option>';

													 }

													?>
                                              </select>
                                            </div></td>
                                          <td width="30%"><a href="javascript:void(0);"  id="certificate_btn" class="btn btn-sm default" title="OK">OK</a></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" ><textarea id="certificate" name="certificate" class="form-control" rows="3" placeholder="Enter certificate"><?php echo $row['certificate']; ?></textarea></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-2">
                                <div class="checkbox-list" style="padding-top:6px !important">
                                  <label class="checkbox-inline">
                                    <input type="checkbox" name="nextvisit_block" id="nextvisit_block" value="<?php echo $row['nextvisit_block']; ?>" <?php if($row['nextvisit_block']=='1') echo 'checked';  ?>>
                                    <span class="caption-subject font-white-sharp"><strong>Next Visit</strong></span></label>
                                </div>
                              </div>
                              <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                                <div class="table-scrollable">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                    <tbody>
                                      <tr>
                                        <td width="25%"><div class="input-group">
                                            <select class="form-control" name="next_visit_day" id="next_visit_day">
                                              <option value="0">0</option>
                                              <?php 

											  $dt=1;

											  while($dt<32){

											  ?>
                                              <option value="<?php echo $dt; ?>" <?php if($row['next_visit_day']==$dt) echo 'selected'; ?> ><?php echo $dt; ?></option>
                                              <?php $dt++;} ?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 9px !important">Day</span> </div></td>
                                        <td width="25%"><div class="input-group">
                                            <select class="form-control" name="next_visit_week" id="next_visit_week">
                                              <option value="0">0</option>
                                              <?php 

											  $dt=1;

											  while($dt<53){

											  ?>
                                              <option value="<?php echo $dt; ?>" <?php if($row['next_visit_week']==$dt) echo 'selected'; ?> ><?php echo $dt; ?></option>
                                              <?php $dt++;} ?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 9px !important">Week</span> </div></td>
                                        <td width="25%"><div class="input-group">
                                            <select class="form-control" name="next_visit_month" id="next_visit_month">
                                              <option value="0">0</option>
                                              <?php 

											  $dt=1;

											  while($dt<13){

											  ?>
                                              <option value="<?php echo $dt; ?>" <?php if($row['next_visit_month']==$dt) echo 'selected'; ?> ><?php echo $dt; ?></option>
                                              <?php $dt++;} ?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 9px !important">Month</span> </div></td>
                                        <td width="25%" ><div class="input-group">
                                            <select class="form-control" name="next_visit_year" id="next_visit_year">
                                              <option value="0">0</option>
                                              <?php 

											  $dt=1;

											  while($dt<11){

											  ?>
                                              <option value="<?php echo $dt; ?>" <?php if($row['next_visit_year']==$dt) echo 'selected'; ?> ><?php echo $dt; ?></option>
                                              <?php $dt++;} ?>
                                            </select>
                                            <span class="input-group-addon" style="padding:0 9px !important">Year</span> </div></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="portlet-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-scrollable">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                                    <tbody>
                                      <tr>
                                        <td><label class="checkbox-inline" >
                                            <input type="checkbox" name="dilatation" id="dilatation" value="<?php echo $row['dilatation']; ?>" <?php if($row['dilatation']=='1') echo 'checked';  ?>>
                                            <span class="caption-subject font-white-sharp" style="background-color:#040465;padding:0 4px 0 4px;"><strong>Dilatation</strong></span></label>
                                          <input type="hidden" class="form-control" name="dilatation_time" id="dilatation_time" value="<?php echo $row['dilatation_time']; ?>" >
                                          <input type="hidden" class="form-control" name="dilatation_change" id="dilatation_change" value="<?php echo $row['dilatation_change']; ?>" ></td>
                                        <td><label class="checkbox-inline" >
                                            <input type="checkbox" name="no_dialation" id="no_dialation" value="<?php echo $row['no_dialation']; ?>" <?php if($row['no_dialation']=='1') echo 'checked';  ?>>
                                            <span class="caption-subject font-white-sharp" style="background-color:#040465;padding:0 4px 0 4px;"><strong>No Dilatation with reason</strong></span></label></td>
                                        <td ><textarea id="no_dialation_reason" name="no_dialation_reason" class="form-control" rows="2" placeholder="Enter Reason Of No Dilatation"><?php echo $row['no_dialation_reason']; ?></textarea></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="portlet-body">
                    <div class="row">
                      <div class="col-md-2"> <span class="caption-subject font-white-sharp"><strong>Remarks</strong></span> </div>
                      <div class="col-md-12" style="margin-bottom:4px; padding-top:0;">
                        <div class="table-scrollable">
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover">
                            <tbody>
                              <tr>
                                <td ><textarea id="remarks_pres" name="remarks_pres" class="form-control" rows="9" placeholder="Enter Remarks"><?php echo $row['remarks_pres']; ?></textarea></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"><span id="span_title"><u>Patient Related Documents Upload</u></span></div>
                <div class="col-md-12" style="background:#3e9999; padding:9px 0px">
                  <div class="col-md-12" style="text-align:right"><span id="add_more">To add more, please click on this icon</span><a href="javascript:void(0);"  id="patient_related_iop_add_button" class="btn" title="Add more" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                  <div class="col-md-12" style="margin-bottom:4px;overflow-x: auto !important;">
                    <div class="table-scrollable">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover" id="patient_related_iop_tab" style="overflow-x: auto !important;">
                        <thead>
                          <tr>
                            <th style="min-width:200px !important">Document Name</th>
                            <th  style="min-width:300px !important">Upload Document File</th>
                            <th  style="min-width:200px !important">Download Updated Document File</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
													 $sl=1;
													$sql5="SELECT * FROM `patient_related_document_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' AND `del_flag`='0'";

													 $result5=$conn->query($sql5) ;

													 $count=$result5->num_rows;

													if($count=='0'){

													  echo '<input type="hidden" name="patient_related_countiop" id="patient_related_countiop" value="'.($count+1).'">';

													 ?>
                          <tr id="patient_related_iop<?php echo ($count+1); ?>">
                            <td style="min-width:200px !important"><input type="text" class="form-control" name="patient_related_document_name<?php echo ($count+1); ?>" id="patient_related_document_name<?php echo ($count+1); ?>" value="" >
                              <input type="hidden" class="form-control" name="patient_related_document_flag<?php echo ($count+1); ?>" id="patient_related_document_flag<?php echo ($count+1); ?>" value="0" ></td>
                            <td style="min-width:300px !important">Document(Upload .doc,.pdf,.jpg file) : <span style="color:#b32424;font-weight:bold;">
                              <?php  echo "Not Uploaded Yet.."; ?>
                              </span>
                              <input type="hidden" class="form-control" name="patient_related_document_upload<?php echo ($count+1); ?>" id="patient_related_document_upload<?php echo ($count+1); ?>" >
                              <input name="patient_related_document_upload<?php echo ($count+1); ?>" id="patient_related_document_upload<?php echo ($count+1); ?>"  class="form-control" type="file"></td>
                            <td style="min-width:100px !important">&nbsp;</td>
                          </tr>
                          <?php } else{
							  echo '<input type="hidden" name="patient_related_countiop" id="patient_related_countiop" value="'.$count.'">';
													 while ($row5=mysqli_fetch_array($result5,MYSQLI_ASSOC))
													{
												  ?>
                          <tr id="patient_related_iop<?php echo $sl; ?>">
                            <td><input type="text" class="form-control" name="patient_related_document_name<?php echo $sl; ?>" id="patient_related_document_name<?php echo $sl; ?>" value="<?php echo $row5['patient_related_document_name']; ?>" >
                              <input type="hidden" class="form-control" name="patient_related_document_flag<?php echo $sl; ?>" id="patient_related_document_flag<?php echo $sl; ?>" value="<?php echo $row5['patient_related_document_flag']; ?>" >
                              <input type="hidden" class="form-control" name="patient_related_id<?php echo $sl; ?>" id="patient_related_id<?php echo $sl; ?>" value="<?php echo $row5['id']; ?>" ></td>
                            <td>Document(Upload .doc,.pdf,.jpg file) : <span style="color:#b32424;font-weight:bold;">
                              <?php if($row5['patient_related_document_upload']!=''){ echo "Uploaded..";}else{ echo "Not Uploaded Yet..";} ?>
                              </span>
                              <input type="hidden" class="form-control" name="patient_related_document_upload<?php echo $sl; ?>" id="patient_related_document_upload<?php echo $sl; ?>" value="<?php echo $row5['patient_related_document_upload']; ?>" >
                              <input name="patient_related_document_upload<?php echo $sl; ?>" id="patient_related_document_upload<?php echo $sl; ?>"  class="form-control" type="file"></td>
                            <td><a href="javascript:void(0);"  id="patient_related_iop_remove<?php echo $sl; ?>" onClick="patient_related_remove_iop_del('<?php echo $sl; ?>','<?php echo $row5['id']; ?>')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a>
                              <?php if ($row5['patient_related_document_upload'] != '') { ?>
                              | <a href="<?php echo ADMIN_URL.'upload/patient_related_document_upload/'.$row5['patient_related_document_upload']; ?>" name="patient_related_document_updated_download<?php echo $sl; ?>" id="patient_related_document_updated_download<?php echo $sl; ?>"  download ><img src="<?php echo ADMIN_URL; ?>icon/download_icon.png" title="Download"  ></a>
                              <?php } ?></td>
                          </tr>
                          <?php $sl++; }} ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="patient_related_remove_id" id="patient_related_remove_id" value="" >
                </div>
                <p>&nbsp;</p>
                <?php 

                 		$optom_name="";

						if($row['username77']!=''){

							$sql25="SELECT `name` FROM `user_infos` Where `users_id`='".$row['username77']."' order by `name` asc";

								 $result25=$conn->query($sql25) ;		

								 $row25 = $result25->fetch_assoc();

								 $count25=$result25->num_rows;

								 if($count25>0)

								 {

									$optom_name=$row25['name'];

								 }

						}

						?>
                <p style="text-align:right">&nbsp;</p>
                <div class="col-md-6" style="margin-bottom:4px;">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-hover table-bordered">
                    <tbody>
                      <tr>
                        <td colspan="5"><strong>Main Optom: </strong> <?php echo $optom_name; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6" style="margin-bottom:4px;">
                  <div class="col-md-12" style="margin-bottom:4px;">
                    <div class="col-md-12" style="margin-bottom:4px; padding:0;color:white;"><b>To add more, please click on this icon</b><a href="javascript:void(0);"  id="add_additional_optom_button" class="btn" title="Add more" style="margin:0 !important"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                    <div class="table-scrollable">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-bordered table-advance table-hover" id="additional_optom_tab">
                        <thead>
                          <tr>
                            <th> SL.No </th>
                            <th> Additional Optom </th>
                            <th>&nbsp; </th>
                            <th>&nbsp; </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

								 $sl=1;

								 $sql2="SELECT * FROM `additional_optom_for_prescription_for_emr` WHERE `prescription_id`= '" .$_REQUEST['id']. "' and `del_flag`='0'";

								 $result2=$conn->query($sql2) ;

								 $count=$result2->num_rows;

								if($count=='0'){

								  echo '<input type="hidden" name="count_additional_optom" id="count_additional_optom" value="'.($count+1).'">';

							 ?>
                          <tr id="additional_optom_body<?php echo ($count+1); ?>">
                            <td ><?php echo ($count+1); ?></td>
                            <input type="hidden" name="additional_optom_flag<?php echo ($count+1); ?>" id="additional_optom_flag<?php echo ($count+1); ?>" value="0">
                            <td ><select name="additional_optom_id<?php echo ($count+1); ?>" id="additional_optom_id<?php echo ($count+1); ?>" class="form-control select2" >
                                <option value=""> Choose..</option>
                                <?php
                                   $query1="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='4' order by `user_infos`.`name` asc" ;

                                        $rslt=$conn->query($query1);

                                        while($rowd=mysqli_fetch_array($rslt)){

                                            echo '<option value="'.$rowd['id'].'" '; echo '>'.$rowd['name'].'</option>'; 
                                    }

                                  ?>
                              </select></td>
                            <td >&nbsp;</td>
                            <td >&nbsp;</td>
                          </tr>
                          <?php } else{

										 echo '<input type="hidden" name="count_additional_optom" id="count_additional_optom" value="'.$count.'">';

										 while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))

										{

								?>
                          <tr id="additional_optom_body<?php echo $sl; ?>">
                            <td ><?php echo $sl; ?></td>
                            <td ><input type="hidden" name="additional_optom_flag<?php echo $sl; ?>" id="additional_optom_flag<?php echo $sl; ?>" value="<?php echo $row2['additional_optom_flag'];?>">
                              <input type="hidden" name="additional_optom_insert_id<?php echo $sl; ?>" id="additional_optom_insert_id<?php echo $sl; ?>" value="<?php echo $row2['id'];?>"></td>
                            <td ><select name="additional_optom_id<?php echo $sl; ?>" id="additional_optom_id<?php echo $sl; ?>" class="form-control select2" >
                                <option value=""> Choose..</option>
                                <?php

                                   $query1="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='4' order by `user_infos`.`name` asc" ;

                                        $rslt=$conn->query($query1);

                                        while($rowd=mysqli_fetch_array($rslt)){

                                            echo '<option value="'.$rowd['id'].'" ';if($row2['additional_optom_id']==$rowd['id']){ echo "selected";} echo '>'.$rowd['name'].'</option>'; 

                                    }

                                  ?>
                              </select></td>
                            <td><a href="javascript:void(0);"  id="additional_optom_remove<?php echo $sl; ?>" onClick="remove_additional_optom_del('<?php echo $sl; ?>','<?php echo $row2['id'];?>')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td>
                          </tr>
                          <?php $sl++; }} ?>
                        <input type="hidden" name="remove_id_for_additional_optom" id="remove_id_for_additional_optom" value="">
                          </tbody>
                        
                      </table>
                    </div>
                  </div>
                </div>
                <p style="text-align:right">&nbsp;</p>
                <div class="col-md-12"><span id="msg_sent"></span><br />
                  <br />
                </div>
                <div <?php if($flag==1){ echo 'style="display:none !important;"';}?>>
                  <div class="form-actions right"> 
                    <!--<button type="submit" name="save_template" id="save_template" class="btn yellow">Save Template</button>-->
                    <button type="submit" name="submit" id="submit" class="btn blue">Submit & Print</button>
                    <button type="submit" name="submit_sms" id="submit_sms" class="btn purple">Submit & SMS</button>
                    <button type="submit" name="submit_sms_n_print" id="submit_sms_n_print" class="btn yellow">Submit & SMS & Print</button>
                    <!--<button type="button" name="send_sms_individual" id="send_sms_individual" class="btn purple" onClick="prescription_sms()">SMS Send</button>
                    <button type="button" name="prescription_print_individual" id="prescription_print_individual" class="btn yellow" onClick="prescription_print_page()">Print</button>
                    <button type="button" name="dashboard_individual" id="dashboard_individual" class="btn green" onClick="prescription_dashboard_page()">Dashboard</button>--> 
                  </div>
                </div>
                <p style="text-align:right">&nbsp;</p>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table table-striped table-hover table-bordered">
                  <tbody>
                    <tr>
                      <td colspan="5"><strong>Print Prescription Archive: </strong>
                        <?php 	

						

				$sql4="SELECT `id`,`created_on`,`important_visit`,`surgery`,`procedure_comments` FROM `prescription_details_for_emr` WHERE `mrd_no`='".$row['mrd_no']."' AND `del_flag`='0'  ORDER BY `prescription_details_for_emr`.`id` ASC ";

				 $result4=$conn->query($sql4) ;	

				 while ($row4=mysqli_fetch_array($result4,MYSQLI_ASSOC))

				 {

					$color='';

					if($row4['procedure_comments']!='')

					{

						$color='style="color:green !important;"';

					}

					if($row4['surgery']!='')

					{

						$color='style="color:purple !important;"';

					}

					 if($row4['important_visit']=='1')

					{

						$color='style="color:red !important;"';

					}

					?>
                        <a href="<?php echo ADMIN_URL; ?>printPrescription_for_emr.php?id=<?php echo $row4['id']; ?>"  <?php echo $color; ?> target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/printButton.png"  title="Print Prescription"> <?php echo date("d/m/Y", strtotime( $row4['created_on']));  ?> </a> |
                        <?php

				   } ?></td>
                    </tr>
                  </tbody>
                </table>
                <p style="text-align:right">&nbsp;</p>
                <table class="table table-striped table-hover table-bordered">
                  <tbody>
                    <tr>
                      <td colspan="5"><?php 			

					$sql4="SELECT `id` FROM `prescription_details_for_emr` WHERE `mrd_no`='".$row['mrd_no']."'  AND `del_flag`='0' ORDER BY `id` ASC ";

					$result4=$conn->query($sql4) ;	

					$all_emr_id='';	

					while ($row4=mysqli_fetch_array($result4,MYSQLI_ASSOC))

					 {
							$all_emr_id=$row4['id'].','.$all_emr_id;
					 }

					?>
                        <a href="<?php echo ADMIN_URL; ?>casesummery_for_emr.php?all_mrd_id=<?php echo $all_emr_id; ?>" target="_blank" style="font-weight:bold !important; color:#900 !important;">Click on it to view Case Summary </a></td>
                    </tr>
                  </tbody>
                </table>
                <p style="text-align:right">&nbsp;</p>
              </form>
              
              <!-- END FORM-->
              
              <?php } ?>
            </div>
            <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
              <div class="modal-dialog" id="model_header">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="portlet box blue-hoki">
                      <div class="portlet-title" >
                        <div class="caption"> <i class="fa fa-gift"></i>Choose An Option</div>
                      </div>
                      <div class="portlet-body form"> 
                        
                        <!-- BEGIN FORM-->
                        
                        <form action="" method="post" class="form-horizontal">
                          <div class="form-body">
                            <div class="form-group">
                              <label class="col-md-4"><strong>&nbsp; &nbsp; SPHERE</strong></label>
                              <div class="col-md-7">
                                <div class="input-group" style="float:right;">
                                  <input type="hidden" name="select_id1" id="select_id1"  class="form-control" >
                                  <input type="hidden" name="select_id2" id="select_id2"  class="form-control" >
                                  <input type="hidden" name="select_id3" id="select_id3"  class="form-control" >
                                  <input type="hidden" name="select_id4" id="select_id4"  class="form-control" >
                                  <input type="hidden" name="select_type" id="select_type"  class="form-control" >
                                  <a href="javascript:void(0);" class="btn btn-sm red" id="sphere_block_div_minus_bt" title="-" style="margin: 0px !important; display: none;"><i class="fa fa-minus"></i></a><a href="javascript:void(0);" class="btn btn-sm green" id="sphere_block_div_plus_bt" title="+" style="margin: 0px !important; display: inline-block;"><i class="fa fa-plus"></i></a> </div>
                              </div>
                            </div>
                            <div id="sphere_block_div" style="display:none;">
                              <div class="form-group">
                                <div class="col-md-12">
                                  <table class="table table-striped table-hover table-bordered" id="table_atch_camera_image">
                                    <tbody>
                                      <tr>
                                        <?php 

                                     $arrVal2=range(-15.00,15.00,0.25);

                                     $counter=1;

                                     foreach($arrVal2 as $k=>$i){

                                     $v2=number_format($i,2);

                                    ?>
                                        <td><label>
                                            <input type="radio" name="option_choose1" id="option_choose1" value="<?php if($v2>0){ echo '+'.$v2;}else{ echo $v2;} ?>" class="form-control" >
                                            <?php if($v2>0){ echo '+'.$v2;}else{ echo $v2;} ?>
                                          </label></td>
                                        <?php if($counter!=1 && $counter%5==0){ ?>
                                      </tr>
                                      <tr>
                                        <?php } ?>
                                        <?php  

                              $counter++; }?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4"><strong>&nbsp; &nbsp; CYL</strong></label>
                              <div class="col-md-7">
                                <div class="input-group" style="float:right;">&nbsp; <a href="javascript:void(0);" class="btn btn-sm red" id="cyl_block_div_minus_bt" title="-" style="margin: 0px !important; display: none;"><i class="fa fa-minus"></i></a><a href="javascript:void(0);" class="btn btn-sm green" id="cyl_block_div_plus_bt" title="+" style="margin: 0px !important; display: inline-block;"><i class="fa fa-plus"></i></a> </div>
                              </div>
                            </div>
                            <div id="cyl_block_div" style="display:none;">
                              <div class="form-group">
                                <div class="col-md-12">
                                  <table class="table table-striped table-hover table-bordered" id="table_atch_camera_image">
                                    <tbody>
                                      <tr>
                                        <?php 

                                     $arrVal2=range(-0.25,-6.00,0.25);

                                     $counter=1;

                                     foreach($arrVal2 as $k=>$i){

                                     $v2=number_format($i,2);

                                    ?>
                                        <td><label>
                                            <input type="radio" name="option_choose2" id="option_choose2" value="<?php echo $v2; ?>" class="form-control" >
                                            <?php echo $v2; ?></label></td>
                                        <?php if($counter!=1 && $counter%5==0){ ?>
                                      </tr>
                                      <tr>
                                        <?php } ?>
                                        <?php  

                              $counter++; } ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4"><strong>&nbsp; &nbsp; AXIS</strong></label>
                              <div class="col-md-7">
                                <div class="input-group" style="float:right;">&nbsp; <a href="javascript:void(0);" class="btn btn-sm red" id="axis_block_div_minus_bt" title="-" style="margin: 0px !important; display: none;"><i class="fa fa-minus"></i></a><a href="javascript:void(0);" class="btn btn-sm green" id="axis_block_div_plus_bt" title="+" style="margin: 0px !important; display: inline-block;"><i class="fa fa-plus"></i></a> </div>
                              </div>
                            </div>
                            <div id="axis_block_div" style="display:none;">
                              <div class="form-group">
                                <div class="col-md-12">
                                  <table class="table table-striped table-hover table-bordered" id="table_atch_camera_image">
                                    <tbody>
                                      <tr>
                                        <?php 

                                     $arrVal2=range(5.00,180.00,5.00);

                                     $counter=1;

                                     foreach($arrVal2 as $k=>$i){

                                     $v2=number_format($i,2);

                                    ?>
                                        <td><label>
                                            <input type="radio" name="option_choose3" id="option_choose3" value="<?php echo $v2; ?>" class="form-control" >
                                            <?php echo $v2; ?></label></td>
                                        <?php if($counter!=1 && $counter%5==0){ ?>
                                      </tr>
                                      <tr>
                                        <?php } ?>
                                        <?php 

                              $counter++; }?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4"><strong>&nbsp; &nbsp; ADD / VA</strong></label>
                              <div class="col-md-7">
                                <div class="input-group" style="float:right;"> <a href="javascript:void(0);" class="btn btn-sm red" id="add_block_div_minus_bt" title="-" style="margin: 0px !important; display: none;"><i class="fa fa-minus"></i></a><a href="javascript:void(0);" class="btn btn-sm green" id="add_block_div_plus_bt" title="+" style="margin: 0px !important; display: inline-block;"><i class="fa fa-plus"></i></a> </div>
                              </div>
                            </div>
                            <div id="add_block_div" style="display:none;">
                              <div class="form-group">
                                <div class="col-md-12">
                                  <table class="table table-striped table-hover table-bordered" id="table_atch_camera_image">
                                    <tbody>
                                      <tr>
                                        <?php 

                                     $arrVal2=range(0.00,15.00,0.25);

                                     $counter=1;

                                     foreach($arrVal2 as $k=>$i){

                                     $v2=number_format($i,2);

                                    ?>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="<?php if($v2>0){ echo '+'.$v2;}else{ echo $v2;} ?>" class="form-control" >
                                            <?php if($v2>0){ echo '+'.$v2;}else{ echo $v2;} ?>
                                          </label></td>
                                        <?php if($counter!=1 && $counter%5==0){ ?>
                                      </tr>
                                      <tr>
                                        <?php } ?>
                                        <?php  

                              $counter++; }?>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="6/5" class="form-control" >
                                            6/5</label></td>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="6/6" class="form-control" >
                                            6/6</label></td>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="6/9" class="form-control" >
                                            6/9</label></td>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="6/12" class="form-control" >
                                            6/12</label></td>
                                      <tr>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="6/18" class="form-control" >
                                            6/18</label></td>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="6/24" class="form-control" >
                                            6/24</label></td>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="6/36" class="form-control" >
                                            6/36</label></td>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="6/60" class="form-control" >
                                            6/60</label></td>
                                      </tr>
                                      <tr>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="N36" class="form-control" >
                                            N36</label></td>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="N24" class="form-control" >
                                            N24</label></td>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="N18" class="form-control" >
                                            N18</label></td>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="N12" class="form-control" >
                                            N12</label></td>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="N10" class="form-control" >
                                            N10</label></td>
                                      </tr>
                                      <tr>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="N8" class="form-control" >
                                            N8</label></td>
                                        <td><label>
                                            <input type="radio" name="option_choose4" id="option_choose4" value="N6" class="form-control" >
                                            N6</label></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-actions top">
                            <div class="row" style="background:white !important;">
                              <div class="col-md-offset-4 col-md-7"> 
                                
                                <!--<button type="button" class="btn default">Cancel</button>-->
                                
                                <button type="button" class="btn red" data-dismiss="modal" id="model_close3">Okay</button>
                              </div>
                            </div>
                          </div>
                        </form>
                        
                        <!-- END FORM--> 
                        
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- /.modal-content --> 
                
              </div>
              
              <!-- /.modal-dialog --> 
              
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><strong>Select Old Patient Date</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              </div>
              <div class="modal-body" id="old_patient_date_popup_show"> </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        
         <div class="modal fade" id="OldSystemArchieveModal" tabindex="-1" role="dialog" aria-labelledby="OldSystemArchieveModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="OldSystemArchieveModalLabel"><strong>Select Old System Archieve Prescription Date</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              </div>
              <div class="modal-body" id="old_archive_date_popup_show"> </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- END EXAMPLE TABLE PORTLET--> 
        
      </div>
    </div>
    
    <!-- END PAGE CONTENT INNER --> 
    
  </div>
</div>

<!-- END PAGE CONTENT --> 

<!--Modal For All Masters-->

<div class="modal fade draggable-modal" id="master_modal" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog" id="model_header">
    <div class="modal-content"> 
      <!--<div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                         <h4 class="modal-title"><strong>Add Purpose Of Visit</strong></h4>
                        </div>-->
      <div class="modal-body">
        <div class="portlet box blue-hoki">
          <div class="portlet-title" >
            <div class="caption" id="main_heading"> <i class="fa fa-gift"></i></div>
          </div>
          <div class="portlet-body form"> 
            <!-- BEGIN FORM-->
            <form action="" method="post" id="cornia_form" class="form-horizontal">
              <div class="form-body">
                <div class="form-group">
                  <label class="col-md-4 common_class" style="text-align:center" id="sub_heading"></label>
                  <div class="col-md-7">
                    <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                      <input type="text" name="master_name" id="master_name" class="form-control" placeholder="Enter text" />
                      <input type="hidden" name="table_db" id="table_db" class="form-control" placeholder="Enter text" />
                      <input type="hidden" name="column_db" id="column_db" class="form-control" placeholder="Enter text" />
                      <input type="hidden" name="master_head" id="master_head" class="form-control" placeholder="Enter text" />
                      <input type="hidden" name="dropdown_id" id="dropdown_id" class="form-control" placeholder="Enter text" />
                      <input type="hidden" name="dropdown_id_left" id="dropdown_id_left" class="form-control" placeholder="Enter text" />
                    </div>
                    <span class="help-block"></span> </div>
                  <div class="col-md-offset-4">
                    <input type="hidden" id="flag">
                    <button type="button"   class="btn green" onClick="add_on()">Submit</button>
                    <!--<button type="button" class="btn default">Cancel</button>-->
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </form>
            <!-- END FORM--> 
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>

<!--Modal For All Packages/Subpackages-->
<div class="modal fade draggable-modal" id="pkg_modal" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog" id="model_header">
    <div class="modal-content"> 
      <!-- <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                         <h4 class="modal-title"><strong>Add New Doctor</strong></h4>
                        </div>-->
      <div class="modal-body">
        <div class="portlet box blue-hoki">
          <div class="portlet-title" >
            <div class="caption" id="pkg_heading"> <i class="fa fa-gift"></i></div>
          </div>
          <div class="portlet-body form"> 
            <!-- BEGIN FORM-->
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="form-body">
                <div class="form-group">
                  <label class="col-md-4 control-label">Name</label>
                  <div class="col-md-7">
                    <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                      <textarea name="pkg_name" id="pkg_name" class="form-control" placeholder="Enter text" required></textarea>
                      <input type="hidden" name="pkg_table" id="pkg_table" class="form-control" placeholder="Enter id" />
                      <input type="hidden" name="pkg_col" id="pkg_col" class="form-control" placeholder="Enter id" />
                      <input type="hidden" name="pac_heading" id="pac_heading" class="form-control" placeholder="Enter id" />
                      <input type="hidden" name="pkg_list" id="pkg_list" class="form-control" placeholder="Enter id" />
                      <input type="hidden" name="pkg_flag" id="pkg_flag" class="form-control" placeholder="Enter id" />
                    </div>
                    <span class="help-block"> A block of help text. </span> </div>
                </div>
                <div class="col-md-11" style="text-align:right"><b>To Add Subpackage, Please Click On This Icon</b><a href="javascript:void(0);"  id="investigation_add_button" class="btn" title="Add One IOP" style="margin:0 !important" onClick="add_one_pkg()"><img src="assets/admin/layout3/img/add1.png" class="img-responsive" alt="add one"></a></div>
                <input type="hidden" name="count_inv" id="count_inv" value="0">
                <!-- BEGIN FORM-->
                <table class="table table-striped table-hover table-bordered" id="investigation_tab">
                </table>
              </div>
              <div class="form-actions top"> 
                <!--<div class="row">-->
                <div class="col-md-offset-4 col-md-7">
                  <button type="button" name="submit_inv" id="submit_inv" class="btn green" onClick="save_pkg()">Submit</button>
                  
                  <!--<button type="button" class="btn default">Cancel</button>-->
                  <button type="button" id="model_close" class="btn default" data-dismiss="modal">Close</button>
                </div>
                <!--</div>--> 
              </div>
            </form>
            <!-- END FORM--> 
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>

<!--Modal For Diagnosis-->

<div class="modal fade draggable-modal" id="diagnosis_modal" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog" id="model_header">
    <div class="modal-content"> 
      <!--<div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                         <h4 class="modal-title"><strong>Add Purpose Of Visit</strong></h4>
                        </div>-->
      <div class="modal-body">
        <div class="portlet box blue-hoki">
          <div class="portlet-title" >
            <div class="caption"> <i class="fa fa-gift"></i>Add Diagnosis</div>
          </div>
          <div class="portlet-body form"> 
            <!-- BEGIN FORM-->
            <form action="" method="post" id="cornia_form" class="form-horizontal">
              <div class="form-body">
                <div class="form-group">
                  <label class="col-md-4" style="text-align:center">Diagnosis Code</label>
                  <div class="col-md-7">
                    <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                      <input type="text" name="diagnosis_code" id="diagnosis_code" class="form-control" placeholder="Enter text" />
                      </br>
                    </div>
                  </div>
                  <label class="col-md-4" style="text-align:center">Diagnosis Name</label>
                  <div class="col-md-7">
                    <div class="input-group"><span class="input-group-addon"> <i class="fa fa-stethoscope"></i> </span>
                      <input type="text" name="diagnosis_text" id="diagnosis_text" class="form-control" placeholder="Enter text" />
                    </div>
                  </div>
                  <span class="help-block"></span> </div>
                <div class="col-md-offset-4">
                  <button type="button" onclick="save_diagnosis()" class="btn green">Submit</button>
                  <!--<button type="button" class="btn default">Cancel</button>-->
                  <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </form>
            <!-- END FORM--> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal-content --> 
</div>
<!-- /.modal-dialog --> 

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--> 

<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script src="select2/select2.min.js"></script> 
<script type = "text/javascript" >

  

$(document).ready(function() {
	

			$("#drug1").select2();
			$("#explained_surgery").select2();
			//$("#drug1").select2();
			$("#ot_surgeon_name").select2();
			$("#chart_date1").datepicker({

					format: 'dd-mm-yyyy'

				});

            $("#additional_optom_id1").select2();

            var count_additional_optom = $("#count_additional_optom").val();

            if (count_additional_optom != 0) {

                for (var sa = 1; sa <= count_additional_optom; sa++) {

                    $("#additional_optom_id" + sa).select2();

                }

            }

			var total_countiop_for_drug=$("#countiop_for_drug").val();

				if(total_countiop_for_drug>1){	

					var intial=2;

					while(intial<=total_countiop_for_drug){

						$("#drug"+intial).select2();		

						intial=parseInt(intial)+1;

					}

				}

			var total_countiop_for_drug=$("#countiop_for_drug").val();

		 	if(total_countiop_for_drug!=0){

				for(var c=1;c<=total_countiop_for_drug;c++){	

					$("#chart_date"+c).datepicker({

						format: 'dd-mm-yyyy'

					});

				}

				for(var c=1;c<=total_countiop_for_drug;c++){	

					stock_value_check(c);

				}			

			}

			

			$("#iop_add_button_for_drug").live('click',function(){

			 var patient_id=$("#patient_id").val();

			 var i=$("#countiop_for_drug").val();

			 i=parseInt(i)+1;

			 $("#countiop_for_drug").val(i);			

			 $("#iop_tab_for_drug").append('<tr id="iop_for_drug' + i + '"><td style="min-width:150px !important"><input type="text" class="form-control form-control-inline date-picker" placeholder="Select Admitting Date" name="chart_date' + i + '" id="chart_date' + i + '" value="<?php echo date("d-m-Y");?>" ><input type="hidden" class="form-control" name="billing_flag' + i + '" id="billing_flag' + i + '" value="0" ><input type="hidden" class="form-control" name="prescription_flag' + i + '" id="prescription_flag' + i + '" value="0" ></td> <td style="min-width:200px !important"><select class="form-control select2" name="drug' + i + '" id="drug' + i + '" onChange="stock_value_check(\'' + i + '\');"><option value="">-Select Medicine-</option></select> </td><td style="min-width:100px !important"><select class="form-control" name="dose' + i + '" id="dose' + i + '" onChange="qty_get(\'' + i + '\');"><?php  $sql7="SELECT `id`, `timing_name` FROM `medicine_timing_masters` WHERE  `del_flag`='0' ORDER BY `id` ASC "; $result7=$conn->query($sql7) ; echo '<option value="">Select</option>'; while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)) {	 echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['timing_name'].'</option>'; } ?></select></td> <td style="min-width:100px !important"><select class="form-control" name="drugsheet_time' + i + '" id="drugsheet_time' + i + '" onChange="qty_get(\'' + i + '\');"> <?php 	$days=1; while($days<32) { echo '<option value="'.$days.'" ';  echo '>'.$days.' days</option>'; $days++; } ?></select></td><td style="min-width:100px !important"> <input type="number" class="form-control" name="qty_dose' + i + '" id="qty_dose' + i + '" value="1" > </td> <td style="min-width:100px !important"> <input type="number" class="form-control" name="qty' + i + '" id="qty' + i + '" value="1" ><span class="close_stock_span" id="close_stock_span' + i + '" name="close_stock_span' + i + '">Closing Stock: 0</span> </td>  <td style="min-width:100px !important"><select class="form-control" name="route' + i + '" id="route' + i + '"> <?php $sql7="SELECT `id`, `name` FROM `route_masters` WHERE  `del_flag`='0' ORDER BY `id` ASC ";	 $result7=$conn->query($sql7) ; while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)) { echo '<option value="'.$row7['id'].'" ';  echo '>'.$row7['name'].'</option>';	 } ?> </select></td><td style="min-width:200px !important"><textarea name="advice_given' + i + '" id="advice_given' + i + '" class="form-control" cols="" rows="4"></textarea></td><td style="min-width:300px !important"><select class="form-control" name="purchased_flag' + i + '" id="purchased_flag' + i + '"> <option value="1">To Be Purchased From Pharmacy Store</option><option value="2">Otherwise</option></select></td><td style="min-width:50px !important"><a href="javascript:void(0);"  id="iop_remove' + i + '" onClick="remove_iop_for_drug('+ i +')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');

		$("#drug"+i).select2();

		$("#chart_date"+i).datepicker({

			format: 'dd-mm-yyyy'

		});

		retrieve_procedure_next(i);
	 }); 	

	 

	 

	 

				

            $("#add_additional_optom_button").click(function() {

                    var i = $("#count_additional_optom").val();

                    i = parseInt(i) + 1;

                    $("#count_additional_optom").val(i);

                    //alert(i);

                    $("#additional_optom_tab").append('<tr id="additional_optom_body' + i + '"><td>' + i + '</td><input type="hidden" name="additional_optom_flag' + i + '" id="additional_optom_flag' + i + '" value="0"><td><select name="additional_optom_id' + i + '" id="additional_optom_id' + i + '" class="form-control select2" ><option value=""> Choose..</option> <?php $query1="SELECT `users`.`id`,`user_infos`.`name` FROM `users` INNER JOIN `user_infos` ON `users`.`id` =`user_infos`.`users_id` WHERE `users`.`role`='4'" ; $rslt=$conn->query($query1); while($rowd=mysqli_fetch_array($rslt)){ echo ' < option value = "'.$rowd['id'].'"'; echo ' > '.$rowd['name'].' < /option>'; } ?> </select > </td> <td><a href="javascript:void(0);"  id="additional_optom_remove' + i + '" onClick="remove_additional_optom(' + i + ');" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i > </a></td> </tr>');

                        $("#additional_optom_id" + i).select2();

                    });

                /*End OF this*/

                $("#dob").datepicker({

                    format: 'dd-mm-yyyy'

                });

				 $("#basic_fetch").click(function() {

                    var mrd_check_val = $("#mrd").val();

                    $.ajax({

                        type: "POST",

                        url: "<?php echo ADMIN_URL; ?>ajax_for_emr/get_basic_val_bill_for_emr.php",

                        dataType: "json",

                        data: "mrd=" + mrd_check_val,

                        success: function(data) {

                            //alert(data.age);

                            try {

                                $("#prefix").val(data.prefix);

                                $("#fname").val(data.fname);

                                $("#lname").val(data.lname);

                                $("#dob").val(data.dob);

                                $("#age").val(data.age);

                                $("#mobile").val(data.phone);

                                $("#w_mobile").val(data.phone);

                            } catch (err) {

                                alert(err.message);

                            }

                        }

                    });

                }); 

				

				$("#general_instructions_subpackage").select2(); 

				$("#doctor_id").select2(); 

				$("#brand-filter").select2(); 

				$("#chief").select2(); 

				$("#past_ocular").select2();

				$("#general_hlth").select2();

				$("#family_history_select").select2();

				$("#anterior_select").select2(); 

				$("#anterior_left_select").select2();

				$("#fundus_select").select2();

				$("#fundus_left_select").select2(); 

				$("#medi").select2();

				$("#mediIndSearch").select2(); 

				$("#primary_doctor").select2();

				$("#reffered_to_doc").select2(); 

				$("#signed_by_doctor").select2(); 

					   

				$("#reset_new").click(function() {

                    var ety = '';

                    var zr = 0;

                    //$("#patients_key_notes").val(ety);

                    $("#chief_complaints_history").val(ety);

                    $("#history_of_present_illness").val(ety);

                    $("#current_treatment").val(ety);

                    $("#past_ocular_history").val(ety);

                    $("#general_health").val(ety);

                    $("#family_history").val(ety);

                    $("#allergy_history").val(ety);

                    $("#dv_od").val(ety);

                    $("#nv_od").val(ety);

                    $("#dv_os").val(ety);

                    $("#nv_os").val(ety);

                    $("#pinhole_od").val(ety);

                    $("#pinhole_os").val(ety);

                    $("#flash_od").val(ety);

                    $("#flash_cly_od").val(ety);

                    $("#flash_axis_od").val(ety);

                    $("#flash_os").val(ety);

                    $("#flash_cyl_os").val(ety);

                    $("#flash_axis_os").val(ety);

                    $("#cover_test_text").val(ety);

                    $("#EOM").val(ety);

                    $("#EOM_left").val(ety);

                    $("#pupils").val(ety);

                    $("#pupils_left").val(ety);

                    $("#lid_adnexa").val(ety);

                    $("#lid_adnexa_left").val(ety);

                    $("#conjunctiva").val(ety);

                    $("#conjunctiva_left").val(ety);

                    $("#anterior_segment").val(ety);

                    $("#anterior_left_segment").val(ety);

                    $("#goneoscopy").val(ety);

                    $("#goneoscopy_left").val(ety);

                    $("#fundus").val(ety);

                    $("#fundus_left").val(ety);

                    $("#investigation").val(ety);

                    $("#diagnostic").val(ety);

                    $("#surgery").val(ety);

                    $("#procedure_comments").val(ety);

                    $("#ot_notes").val(ety);

                    $("#general_instructions").val(ety);

                    $("#certificate").val(ety);

                    $("#rk1").val(ety);

                    $("#rk2").val(ety);

                    $("#rk3").val(ety);

                    $("#rk4").val(ety);

                    $("#pachymetery").val(ety);

                    $("#pachymetery_left").val(ety);

                    $("#axial_length").val(ety);

                    $("#axial_length_left").val(ety);

                    $("#scotopic_pupil").val(ety);

                    $("#scotopic_pupil_left").val(ety);

                    $("#ww_diameter").val(ety);

                    $("#ww_diameter_left").val(ety);

                    $("#anterior_chamber").val(ety);

                    $("#anterior_chamber_left").val(ety);

                    $("#iol_power").val(ety);

                    $("#iol_power_left").val(ety);

                    $("#schirmers_test").val(ety);

                    $("#schirmers_test_left").val(ety);

                    $("#visual_fields").val(ety);

                    $("#visual_fields_left").val(ety);

                    $("#optical_coherence").val(ety);

                    $("#oct_macula").val(ety);

                    $("#color_vision_isihara").val(ety);

                    $("#misc_findings").val(ety);

                    $("#optical_coherence_left").val(ety);

                    $("#oct_macula_left").val(ety);

                    $("#color_vision_isihara_left").val(ety);

                    $("#misc_findings_left").val(ety);

                    var countiop = $("#countiop").val();

                    var s = 1;

                    for (s = 1; s <= countiop; s++) {

                        remove_iop(s);

                    }

                    $("#procedure_block").val(zr);

                    $("#procedure_block").prop('checked', false);

                    $('#uniform-procedure_block:first span').removeClass('checked');

                });

            });
        function remove_additional_optom(j) {

            $("#additional_optom_body" + j).remove();

        }
        function remove_additional_optom_del(j, id) {

            $("#additional_optom_body" + j).remove();

            var remove_id_for_additional_optom = $("#remove_id_for_additional_optom").val();

            var values_drug = remove_id_for_additional_optom + id + ":";

            $("#remove_id_for_additional_optom").val(values_drug);

        } 
</script> 
<script >

        $(document).ready(function() {

            /************************************ Checkbox tick  ********************************/

            /************************************ dob calculation ********************************/

            $("#calculate").click(function() {

                var dob = $("#dob").val();

                //alert(dob);

                try {

                    //alert(id);

                    $.ajax({

                        type: "POST",

                        url: "<?php echo ADMIN_URL; ?>ajax_for_emr/age_change_ajax_for_emr.php",

                        dataType: "json",

                        data: "dob=" + dob,

                        success: function(data) {

                            //alert(data.flag);

                            try {

                                // $("#investigation_package").val(data.optm_name);

                                $("#age").val(data.age);

                                $("#age_month").val(data.age_month);

                                $("#age_days").val(data.age_days);

                            } catch (err) {

                                alert(err.message);

                            }

                        }

                    });

                } catch (err) {

                    alert(err.message);

                }

            });

            $("#dialog").dialog({

                autoOpen: false,

                height: 600,

                width: 800,

                click: function() {

                    $(this).dialog("close");

                }

            });

            $("#opener").click(function() {

                <?php

                if (isset($_REQUEST['id'])) {

                    $id_ = $_REQUEST['id'];

                } ?>

                var id =  <?php echo $id_; ?> ;

                $("#dialog").dialog("open");

                $("#frame1").attr("src", "web-cam?id=" + id);

            });

            $("#chief_btn").click(function() {

                var chief = $("#chief").val();

                var chief_eye = $("#chief_eye").val();

                var chief_num = $("#chief_num").val();

                var chief_dur = $("#chief_dur").val();

                var final_value = "";

                var chief_value = $("#chief_complaints_history").val();

                if (chief_value != '') {
					if(chief_eye==''){
                    final_value = chief_value + " ; " + chief + " " + chief_num + " " + chief_dur;
					}else{
						final_value = chief_value + " ; " + chief_eye + " - " + chief + " " + chief_num + " " + chief_dur;
					}

                } else {
					if(chief_eye==''){
                    final_value =  chief + " " + chief_num + " " + chief_dur;
					}else{
						 final_value = chief_eye + " - " + chief + " " + chief_num + " " + chief_dur;
					}

                }

                $("#chief_complaints_history").val(final_value);

            });

            $("#past_ocular_btn").click(function() {

                var chief = $("#past_ocular").val();

                var chief_eye = $("#past_ocular_eye").val();

                var chief_num = $("#past_ocular_num").val();

                var chief_dur = $("#past_ocular_dur").val();

                var past_ocular_year = $("#past_ocular_year").val();
				

                var final_value = "";

                var chief_value = $("#past_ocular_history").val();

                if (chief_value != '') {
					if(chief_eye==''){

                    	final_value = chief_value + " ; " + chief + " " + chief_num + " " + chief_dur + " " + past_ocular_year;
					}else{
						final_value = chief_value + " ; " + chief_eye + " - " + chief + " " + chief_num + " " + chief_dur + " " + past_ocular_year;
					}

                } else {
					if(chief_eye==''){
                    	final_value =  chief + " " + chief_num + " " + chief_dur + " " + past_ocular_year;
					}else{
						 final_value = chief_eye + " - " + chief + " " + chief_num + " " + chief_dur + " " + past_ocular_year;
					}

                }

                $("#past_ocular_history").val(final_value);

            });

            $("#general_health_btn").click(function() {

                var chief = $("#general_hlth").val();

                var chief_num = $("#general_hlth_num").val();

                var chief_dur = $("#general_hlth_dur").val();

                var final_value = "";

                var chief_value = $("#general_health").val();

                if (chief_value != '') {

                    final_value = chief_value + "\n" + chief + " " + chief_num + " " + chief_dur;

                } else {

                    final_value = chief + " " + chief_num + " " + chief_dur;

                }

                $("#general_health").val(final_value);

            });

            $("#family_history_btn").click(function() {

                var chief = $("#family_history_select").val();

                var final_value = "";

                var chief_value = $("#family_history").val();

                if (chief_value != '') {

                    final_value = chief_value + "\n" + chief;

                } else {

                    final_value = chief;

                }

                $("#family_history").val(final_value);

            });

            $("#pgp_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#pgp_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#pgp_block").val(empty);

                }

            });

            $("#pgp_div_plus_bt").click(function() {

                $("#pgp_div").toggle();

                $("#pgp_div").show();

                $("#pgp_div_minus_bt").show();

                $("#pgp_div_plus_bt").hide();

            });

            $("#pgp_div_minus_bt").click(function() {

                $("#pgp_div").toggle();

                $("#pgp_div").hide();

                $("#pgp_div_minus_bt").hide();

                $("#pgp_div_plus_bt").show();

            });

            $("#sph_od_range").change(function() {

                var dd = $("#sph_od_range").val();

                $("#sph_od").val(dd);

            });

            $("#sph_add_range").change(function() {

                var dd = $("#sph_add_range").val();

                $("#sph_add").val(dd);

            });

            $("#cly_od_range").change(function() {

                var dd = $("#cly_od_range").val();

                $("#cly_od").val(dd);

            });

            $("#sph_os_range").change(function() {

                var dd = $("#sph_os_range").val();

                $("#sph_os").val(dd);

            });

            $("#cly_os_range").change(function() {

                var dd = $("#cly_os_range").val();

                $("#cyl_os").val(dd);

            });

            $("#os_add_range").change(function() {

                var dd = $("#os_add_range").val();

                $("#add_os").val(dd);

            });

            $("#ocular_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#ocular_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#ocular_block").val(empty);

                }

            });

            $("#vision_select").change(function() {

                var dd = $("#vision_select").val();

                $("#dv_od").val(dd);

            });

            $("#nv_od_select").change(function() {

                var dd = $("#nv_od_select").val();

                $("#nv_od").val(dd);

            });

            $("#dv_os_select").change(function() {

                var dd = $("#dv_os_select").val();

                $("#dv_os").val(dd);

            });

            $("#nv_os_select").change(function() {

                var dd = $("#nv_os_select").val();

                $("#nv_os").val(dd);

            });

            $("#glass_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#glass_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#glass_block").val(empty);

                }

            });

            $("#distance_sph_r_range").change(function() {

                var dd = $("#distance_sph_r_range").val();

                $("#distance_sph_r").val(dd);

            });

            $("#distance_cyl_r_range").change(function() {

                var dd = $("#distance_cyl_r_range").val();

                $("#distance_cyl_r").val(dd);

            });

            $("#distance_va_r_select").change(function() {

                var dd = $("#distance_va_r_select").val();

                $("#distance_va_r").val(dd);

            });

            $("#distance_sph_l_range").change(function() {

                var dd = $("#distance_sph_l_range").val();

                $("#distance_sph_l").val(dd);

            });

            $("#distance_cyl_l_range").change(function() {

                var dd = $("#distance_cyl_l_range").val();

                $("#distance_cyl_l").val(dd);

            });

            $("#distance_va_l_select").change(function() {

                var dd = $("#distance_va_l_select").val();

                $("#distance_va_l").val(dd);

            });

            $("#near_sph_r_range").change(function() {

                var dd = $("#near_sph_r_range").val();

                $("#near_sph_r").val(dd);

            });

            $("#near_va_r_select").change(function() {

                var dd = $("#near_va_r_select").val();

                $("#near_va_r").val(dd);

            });

            $("#near_sph_l_range").change(function() {

                var dd = $("#near_sph_l_range").val();

                $("#near_sph_l").val(dd);

            });

            $("#near_va_l_select").change(function() {

                var dd = $("#near_va_l_select").val();

                $("#near_va_l").val(dd);

            });

            $("#near_cyl_r_range").change(function() {

                var dd = $("#near_cyl_r_range").val();

                $("#near_cyl_r").val(dd);

            });

            $("#near_cyl_l_range").change(function() {

                var dd = $("#near_cyl_l_range").val();

                $("#near_cyl_l").val(dd);

            });

            $("#cover_select").change(function() {

                var dd = $("#cover_select").val();

                $("#cover_test_text").val(dd);

            });

            $("#pupils_select").change(function() {

                var dd = $("#pupils_select").val();

                $("#pupils").val(dd);

            });

            $("#pupils_left_select").change(function() {

                var dd = $("#pupils_left_select").val();

                $("#pupils_left").val(dd);

            });

            $("#lidadnexa_select").change(function() {

                var dd = $("#lidadnexa_select").val();

                $("#lid_adnexa").val(dd);

            });

            $("#lidadnexa_left_select").change(function() {

                var dd = $("#lidadnexa_left_select").val();

                $("#lid_adnexa_left").val(dd);

            });

            $("#anterior_figure").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#anterior_figure").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#anterior_figure").val(empty);

                }

            });
			
			
			 $("#eom_checkbox_check").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#eom_checkbox_check").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#eom_checkbox_check").val(empty);

                }

            });
			 $("#pupils_checkbox_check").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#pupils_checkbox_check").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#pupils_checkbox_check").val(empty);

                }

            });
			 $("#lid_checkbox_check").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#lid_checkbox_check").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#lid_checkbox_check").val(empty);

                }

            });
			 $("#conjunctiva_checkbox_check").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#conjunctiva_checkbox_check").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#conjunctiva_checkbox_check").val(empty);

                }

            });
			
			$("#mb_ocular_checkbox_check").click(function() {
                if ($(this).prop("checked") == true) {
                    var empty = 1;
                    $("#mb_ocular_checkbox_check").val(empty);
                } else if ($(this).prop("checked") == false) {
                    var empty = 0;
                    $("#mb_ocular_checkbox_check").val(empty);
                }
            });
            
            $("#cornea_ocular_checkbox_check").click(function() {
                if ($(this).prop("checked") == true) {
                    var empty = 1;
                    $("#cornea_ocular_checkbox_check").val(empty);
                } else if ($(this).prop("checked") == false) {
                    var empty = 0;
                    $("#cornea_ocular_checkbox_check").val(empty);
                }
            });            
            
            $("#iris_ocular_checkbox_check").click(function() {
                if ($(this).prop("checked") == true) {
                    var empty = 1;
                    $("#iris_ocular_checkbox_check").val(empty);
                } else if ($(this).prop("checked") == false) {
                    var empty = 0;
                    $("#iris_ocular_checkbox_check").val(empty);
                }
            });
            
            $("#ac_ocular_checkbox_check").click(function() {
                if ($(this).prop("checked") == true) {
                    var empty = 1;
                    $("#ac_ocular_checkbox_check").val(empty);
                } else if ($(this).prop("checked") == false) {
                    var empty = 0;
                    $("#ac_ocular_checkbox_check").val(empty);
                }
            });
            
            $("#lens_ocular_checkbox_check").click(function() {
                if ($(this).prop("checked") == true) {
                    var empty = 1;
                    $("#lens_ocular_checkbox_check").val(empty);
                } else if ($(this).prop("checked") == false) {
                    var empty = 0;
                    $("#lens_ocular_checkbox_check").val(empty);
                }
            });
            
            $("#vitreous_ocular_checkbox_check").click(function() {
                if ($(this).prop("checked") == true) {
                    var empty = 1;
                    $("#vitreous_ocular_checkbox_check").val(empty);
                } else if ($(this).prop("checked") == false) {
                    var empty = 0;
                    $("#vitreous_ocular_checkbox_check").val(empty);
                }
            });
            
            $("#retina_ocular_checkbox_check").click(function() {
                if ($(this).prop("checked") == true) {
                    var empty = 1;
                    $("#retina_ocular_checkbox_check").val(empty);
                } else if ($(this).prop("checked") == false) {
                    var empty = 0;
                    $("#retina_ocular_checkbox_check").val(empty);
                }
            });
            
            $("#onh_ocular_checkbox_check").click(function() {
                if ($(this).prop("checked") == true) {
                    var empty = 1;
                    $("#onh_ocular_checkbox_check").val(empty);
                } else if ($(this).prop("checked") == false) {
                    var empty = 0;
                    $("#onh_ocular_checkbox_check").val(empty);
                }
            });
			

            $("#anterior_select_button").click(function() {

                var slVal = $("#anterior_select").val();

                var chief_value = $("#anterior_segment").val();

                if (chief_value != '') {

                    var slVal = chief_value + "\n" + slVal;

                }

                $("#anterior_segment").val(slVal);

                $("#anterior_select").val("");

            });

            $("#anterior_lselect_button").click(function() {

                var slVal = $("#anterior_left_select").val();

                var chief_value = $("#anterior_left_segment").val();

                if (chief_value != '') {

                    var slVal = chief_value + "\n" + slVal;

                }

                $("#anterior_left_segment").val(slVal);

                $("#anterior_left_select").val("");

            });

            $("#add_at_details_button").click(function() {
				var now = updateTime();

                var i = $("#countiop").val();

                i = parseInt(i) + 1;

                $("#countiop").val(i);

                
				
				$("#at_details_tab").append('<tr id="at_details_body' + i + '"><input type="hidden" name="at_flag' + i + '" id="at_flag' + i + '" value="0"><td ><select name="at_select' + i + '" id="at_select' + i + '" class="form-control" ><option value="GAT"  >GAT</option> <option value="I-CARE"  >I-CARE</option> <option value="TONOPEN"  >TONOPEN</option><option value="FT"  >FT</option><option value=""> Choose..</option></select></td><td >AT <input type="text" style="width: 25%" name="at_time' + i + '" id="at_time' + i + '" value="<?php echo date('H:i:s'); ?>"><input type="text" placeholder="Time in 24 hour format hh:mm:ss" style="border: none; width: -webkit-fill-available" disabled></td><td ><div class="input-group"> <span class="input-group-addon">OD</span><input type="text" class="form-control" placeholder="OD" name="at_od' + i + '" id="at_od' + i + '" value=""></div></td><td ><div class="input-group"> <span class="input-group-addon">OS</span><input type="text" class="form-control" placeholder="OS" name="at_os' + i + '" id="at_os' + i + '" value=""></div></td> <td ><a href="javascript:void(0);"  id="at_details_remove' + i + '" onClick="remove_at_details(' + i + ');" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');

            });

            $("#gonio_div_plus_bt").click(function() {

                $("#gonio_div").toggle();

                $("#gonio_div").show();

                $("#gonio_div_minus_bt").show();

                $("#gonio_div_plus_bt").hide();

            });

            $("#gonio_div_minus_bt").click(function() {

                $("#gonio_div").toggle();

                $("#gonio_div").hide();

                $("#gonio_div_minus_bt").hide();

                $("#gonio_div_plus_bt").show();

            });

            $("#goneoscopy_select").change(function() {

                var dd = $("#goneoscopy_select").val();

                $("#goneoscopy").val(dd);

            });

            $("#goneoscopy_left_select").change(function() {

                var dd = $("#goneoscopy_left_select").val();

                $("#goneoscopy_left").val(dd);

            });

            $("#fundus_figure").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#fundus_figure").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#fundus_figure").val(empty);

                }

            });


			$("#explained_surgery_btn").click(function(){

			  	 var slVal=$("#explained_surgery").val();			

				 var chief_value=$("#explained_surgery_textarea").val();

				 if(chief_value!='')

				 {

					 var slVal=chief_value+"\n"+slVal;

				 }

				 $("#explained_surgery_textarea").val(slVal);			

				 $("#explained_surgery").val("");

			});
			
            $("#fundus_select_button").click(function() {

                var slVal = $("#fundus_select").val();

                var chief_value = $("#fundus").val();

                if (chief_value != '') {

                    var slVal = chief_value + "\n" + slVal;

                }

                $("#fundus").val(slVal);

                $("#fundus_select").val("");

            });
			
			$("#location_print").click(function(){

				if($(this).prop("checked") == true){

					var empty=1;

					$("#location_print").val(empty);

				}

				else if($(this).prop("checked") == false){

					var empty=0;

					$("#location_print").val(empty);

				}

			});

            $("#fundus_left_select_button").click(function() {

                var slVal = $("#fundus_left_select").val();

                var chief_value = $("#fundus_left").val();

                if (chief_value != '') {

                    var slVal = chief_value + "\n" + slVal;

                }

                $("#fundus_left").val(slVal);

                $("#fundus_left_select").val("");

            });

            $("#k_block_div_plus_bt").click(function() {

                $("#k_block_div").toggle();

                $("#k_block_div").show();

                $("#k_block_div_minus_bt").show();

                $("#k_block_div_plus_bt").hide();

            });

            $("#k_block_div_minus_bt").click(function() {

                $("#k_block_div").toggle();

                $("#k_block_div").hide();

                $("#k_block_div_minus_bt").hide();

                $("#k_block_div_plus_bt").show();

            });

            $("#keratometry_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#keratometry_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#keratometry_block").val(empty);

                }

            });

            $("#investigation_list_id_btn").click(function() {

                var investigation_eye = $("#investigation_eye").val();

                var slVal = $("#investigation_list").val();

                var chief_value = $("#investigation").val();

                if (chief_value != '') {
                    
					if(investigation_eye==''){

                    	slVal2 = chief_value + "\n" + slVal ;
					}else{
						slVal2 = chief_value + "\n" + investigation_eye + " - " + slVal ;
					}

                } else {
					
					if(investigation_eye==''){

                    	slVal2 = slVal ;
					}else{
						slVal2 = investigation_eye + " - " + slVal ;
					}

                }

                $("#investigation").val(slVal2);

                // $('#chief').empty();

            });

            $("#diagnosis_button").click(function() {

                var empty = "";

                var drop = $("#sed_drop").val();

                var multval = $("#brand-filter").val();

                var eyes = $("#diagnostic").val();               
				
				if (eyes != '') {
                    
					if(drop==''){

                    	slVal2 = eyes + "\n" + multval ;
					}else{
						slVal2 = eyes + "\n" + drop + " - " + multval ;
					}

                } else {
					
					if(drop==''){

                    	slVal2 = multval ;
					}else{
						slVal2 = drop + " - " + multval ;
					}
					
				}

                $("#diagnostic").val(slVal2);

                $("#brand-filter").val(empty);

            });

            $("#surgery_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#surgery_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#surgery_block").val(empty);

                }

            });

            $("#surgery_div_plus_bt").click(function() {

                $("#surgery_div1").toggle();

                $("#surgery_div1").show();

                $("#surgery_div2").toggle();

                $("#surgery_div2").show();

                $("#surgery_div_minus_bt").show();

                $("#surgery_div_plus_bt").hide();

            });

            $("#surgery_div_minus_bt").click(function() {

                $("#surgery_div1").toggle();

                $("#surgery_div1").hide();

                $("#surgery_div2").toggle();

                $("#surgery_div2").hide();

                $("#surgery_div_minus_bt").hide();

                $("#surgery_div_plus_bt").show();

            });

            $("#surgery_select_btn").click(function() {

                var sel = $("#surgery_for").val();

                var slVal = $("#surgery_select").val();

                var chief_value = $("#surgery").val();
                
				var slVal2 ="";
				if (chief_value != '') {
                    
					if(sel==''){

                    	slVal2 = chief_value + "\n" + slVal ;
					}else{
						slVal2 = chief_value + "\n" + sel + " - " + slVal ;
					}

                } else {
					
					if(sel==''){

                    	slVal2 = slVal ;
					}else{
						slVal2 = sel + " - " + slVal ;
					}
					
				}

                $("#surgery").val(slVal2);

                // $('#chief').empty();

            });
			

            $("#surgPackageSelect_btn").click(function() {

                var sel = $("#surgery_for").val();

                var slVal = $("#surgPackageSelect").val();

                var chief_value = $("#surgery").val();               
				
				var slVal2 ="";
				if (chief_value != '') {
                    
					if(sel==''){

                    	slVal2 = chief_value + "\n" + slVal ;
					}else{
						slVal2 = chief_value + "\n" + sel + " - " + slVal ;
					}

                } else {
					
					if(sel==''){

                    	slVal2 = slVal ;
					}else{
						slVal2 = sel + " - " + slVal ;
					}
					
				}

                $("#surgery").val(slVal2);

                // $('#chief').empty();

            });

            $("#investigationPackageSelect").change(function() {

                var id = $("#investigationPackageSelect").val();

                var chief_value = $("#investigation_package").val();

                try {

                    //alert(id);

                    $.ajax({

                        type: "POST",

                        url: "<?php echo ADMIN_URL; ?>ajax_for_emr/investigation_detials_load_ajax_for_emr.php",

                        dataType: "json",

                        data: "id=" + id,

                        success: function(data) {

                            //alert(data.flag);

                            try {

                                if (chief_value != '') {

                                    var slVal2 = chief_value + "\n" + data.optm_name;

                                    $("#investigation_package").val(slVal2);

                                } else {

                                    var slVal2 = data.optm_name;

                                    $("#investigation_package").val(slVal2);

                                }

                                // $("#investigation_package").val(data.optm_name);

                            } catch (err) {

                                alert(err.message);

                            }

                        }

                    });

                } catch (err) {

                    alert(err.message);

                }

            });

            $("#medication_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#medication_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#medication_block").val(empty);

                }

            });

           $("#medi_individual_btn").click(function(){

			  var slVal=$("#mediIndSearch").val();	

			 var chief_value=$("#medication").val();

			 if(chief_value!='')

			 {

				 var slVal=chief_value+"\n"+slVal;

			 }

			 $("#medication").val(slVal);

			});
			 

            $("#mediPackageSelect").change(function() {

                var eye = $("#medication_eye_select").val();

                var id = $("#mediPackageSelect").val();

                var chief_value = $("#medication").val();                    $.ajax({

                        type: "POST",

                        url: "<?php echo ADMIN_URL; ?>ajax_for_emr/medication_detials_load_ajax_for_emr.php",

                        dataType: "json",

                        data: "id=" + id,

                        success: function(data) {

                            
								var slVal2='';
								
								if (chief_value != '') {
                    
									if(eye==''){
				
										slVal2 = chief_value + "\n" + data.optm_name ;
									}else{
										slVal2 = chief_value + "\n" + eye + " - " + data.optm_name ;
									}
				
								} else {
									
									if(eye==''){
				
										slVal2 =  data.optm_name; 
									}else{
										slVal2 = eye + " - "+ data.optm_name;
									}
									
								}
								 $("#medication").val(slVal2);

                                // $("#investigation_package").val(data.optm_name);

                           
                        }

                    });

                
            });

            $("#preopePackageSelect").change(function() {

                var id = $("#preopePackageSelect").val();

                var chief_value = $("#pre_operative").val();

                try {

                    //alert(id);

                    $.ajax({

                        type: "POST",

                        url: "<?php echo ADMIN_URL; ?>ajax_for_emr/pre-operative_details_load_ajax_for_emr.php",

                        dataType: "json",

                        data: "id=" + id,

                        success: function(data) {

                            //alert(data.flag);

                            try {

                                if (chief_value != '') {

                                    var slVal2 = chief_value + "\n" + " - " + data.optm_name;

                                    $("#pre_operative").val(slVal2);

                                } else {

                                    var slVal2 = data.optm_name;

                                    $("#pre_operative").val(slVal2);

                                }

                                // $("#investigation_package").val(data.optm_name);

                            } catch (err) {

                                alert(err.message);

                            }

                        }

                    });

                } catch (err) {

                    alert(err.message);

                }

            });

            $("#pre_operative_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#pre_operative_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#pre_operative_block").val(empty);

                }

            });
			
			$("#iridotomy_left_select").change(function(){

				var dd=$("#iridotomy_left_select").val();		

				$("#iridotomy_left").val(dd);

			});
			
			$("#iridotomy_right_select").change(function(){

				var dd=$("#iridotomy_right_select").val();		

				$("#iridotomy_right").val(dd);

			});

            $("#general_instructions_list_id_btn").click(function() {

                var slVal = $("#general_instructions_list_slct").val();

                var chief_value = $("#general_instructions").val();

                if (chief_value != '') {

                    var slVal = chief_value + "\n" + slVal;

                }

                $("#general_instructions").val(slVal);

                // $('#chief').empty();

            });

            $("#nextvisit_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#nextvisit_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#nextvisit_block").val(empty);

                }

            });

            $("#spglass_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#spglass_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#spglass_block").val(empty);

                }

            });

            $("#glassPrescription_btn").click(function() {

                var slVal = $("#glassPrescription_select").val();

                var chief_value = $("#glass_prescription").val();

                if (chief_value != '') {

                    var slVal = chief_value + "\n" + slVal;

                }

                $("#glass_prescription").val(slVal);

                // $('#chief').empty();

            });

            $("#pinhole_od_select").change(function() {

                var dd = $("#pinhole_od_select").val();

                $("#pinhole_od").val(dd);

            });

            $("#pinhole_os_select").change(function() {

                var dd = $("#pinhole_os_select").val();

                $("#pinhole_os").val(dd);

            });

            $("#flash_od_select").change(function() {

                var dd = $("#flash_od_select").val();

                $("#flash_od").val(dd);

            });

            $("#flash_os_select").change(function() {

                var dd = $("#flash_os_select").val();

                $("#flash_os").val(dd);

            });
			
			
			$("#dv_od_select").change(function() {

                var dd = $("#dv_od_select").val();

                $("#dv_od").val(dd);

            });
            $("#nv_od_select").change(function() {

                var dd = $("#nv_od_select").val();

                $("#nv_od").val(dd);

            });
            
            $("#dv_os_select").change(function() {

                var dd = $("#dv_os_select").val();

                $("#dv_os").val(dd);

            });
            $("#nv_os_select").change(function() {

                var dd = $("#nv_os_select").val();

                $("#nv_os").val(dd);

            });

            $("#field_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#field_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#field_block").val(empty);

                }

            });

            $("#spmedication_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#spmedication_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#spmedication_block").val(empty);

                }

            });

            $("#curmedication_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#curmedication_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#curmedication_block").val(empty);

                }

            });

           $("#medicationid").click(function(){ 

				var medication = $("#medication").val();				

				var medi_eye = $("#medi_eye").val();

				var medi=$("#medi").val(); // search drop down				   

				var medi_num = $("#medi_num").val(); // select RE LE

				var medi_dur = $("#medi_dur").val();

				var medi_time = $("#medi_time").val();

				var medi_ampm = $("#medi_ampm").val();

				var medi_remark = $("#medi_remark").val();

				if(medication!='')

				 {
					if(medi_eye==''){
						var slVal = medication+"\n" +medi+ "  " + medi_num+ "  " + medi_dur+ "  " + medi_time+ "  " + medi_ampm +"  " + medi_remark +"   ";
					}else{
					 var slVal = medication+"\n" +  medi_eye+ " " +medi+ "  " + medi_num+ "  " + medi_dur+ "  " + medi_time+ "  " + medi_ampm +"  " + medi_remark +"   ";
					}

				 }
				 else{
					 if(medi_eye==''){
						var slVal = medi+ "  " + medi_num+ "  " + medi_dur+ "  " + medi_time+ "  " + medi_ampm +"  " + medi_remark +"   ";
					}else{				
				
					 var slVal =  medi_eye+ " " +medi+ "  " + medi_num+ "  " + medi_dur+ "  " + medi_time+ "  " + medi_ampm +"  " + medi_remark +"   ";
					}

				}		

				$("#medication").val(slVal);

				

			});	

            $("#investigationPackageSelect").change(function() {

                var id = $("#investigationPackageSelect").val();

                var chief_value = $("#investigation").val();

                try {

                    //alert(id);

                    $.ajax({

                        type: "POST",

                        url: "<?php echo ADMIN_URL; ?>ajax_for_emr/investicationpkg_detials_load_ajax_for_emr.php",

                        dataType: "json",

                        data: "id=" + id,

                        success: function(data) {

                            //alert(data.flag);

                            try {

                                if (chief_value != '') {

                                    var slVal2 = chief_value + "\n" + data.optm_name;

                                    $("#investigation").val(slVal2);

                                } else {

                                    var slVal2 = data.optm_name;

                                    $("#investigation").val(slVal2);

                                }

                            } catch (err) {

                                alert(err.message);

                            }

                        }

                    });

                } catch (err) {

                    alert(err.message);

                }

            });

            $("#procedure_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#procedure_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#procedure_block").val(empty);

                }

            });

            $("#procedureid").click(function() {

                var slValp = $("#procedure_select").val(); // search drop down

                var diagnop = $("#procedure_comments").val(); // comment textarea

                var proced_drop = $("#proced_drop").val(); // search drop down

                var procedure_sub_select = $("#procedure_sub_select").val(); // search drop down

                var procedure_location = $("#procedure_location").val(); // search drop down

                if (diagnop != '') {

                    slValp = diagnop + "\n" + " " + proced_drop + " - " + slValp + " - " + procedure_sub_select + " - " + procedure_location + " - ";

                } else {

                    slValp = proced_drop + " - " + slValp + " - " + procedure_sub_select + " - " + procedure_location + " - ";

                }

                $("#procedure_comments").val(slValp);

                $("#procedure_select").val("");

                $("#proced_drop").val("");

            });

            $("#previous_medicine").click(function() {

                if ($(this).prop("checked") == true) {

                    var medihid = $("#medication_hide").val();

                    var curmedi = $("#current_medicine").val();

                    slVal = medihid + "\n" + curmedi;

                    $("#current_medicine").val(slVal);

                } else if ($(this).prop("checked") == false) {

                    $("#current_medicine").val("");

                }

            });

            $("#previous_medicine").click(function() {

                if ($(this).prop("checked") == true) {

                    var medihid = $("#medicationnew_hide").val();

                    var curmedi = $("#current_medicine").val();

                    slVal = medihid + "\n" + curmedi;

                    $("#current_medicine").val(slVal);

                } else if ($(this).prop("checked") == false) {

                    $("#current_medicine").val("");

                }

            });

            $("#curmedibtn").click(function() {

                var curmedi = $("#current_medicine").val();

                $("#medication").val(curmedi);

            });

            $("#curmedibtn").click(function() {

                var curmedi = $("#current_medicine").val();

                $("#medicationnew").val(curmedi);

            });

            $("#previous_medicine2").click(function() {

                if ($(this).prop("checked") == true) {

                    var medihid = $("#medication_hide").val();

                    var curmedi = $("#current_medicine").val();

                    slVal = medihid + "\n" + curmedi;

                    $("#current_medicine").val(slVal);

                } else if ($(this).prop("checked") == false) {

                    $("#current_medicine").val("");

                }

            });

            $("#previous_medicine2").click(function() {

                if ($(this).prop("checked") == true) {

                    var medihid = $("#medicationnew_hide").val();

                    var curmedi = $("#current_medicine").val();

                    slVal = medihid + "\n" + curmedi;

                    $("#current_medicine").val(slVal);

                } else if ($(this).prop("checked") == false) {

                    $("#current_medicine").val("");

                }

            });

            

            $("#curmedibtn2").click(function() {

                var curmedi = $("#current_medicine").val();
                $("#medication").val(curmedi);

            });

            $("#curmedibtn2").click(function() {

                var curmedi = $("#current_medicine").val();

                $("#medicationnew").val(curmedi);

            });

            $("#dilatation").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#dilatation").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#dilatation").val(empty);

                }

            });

            $("#no_dialation").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#no_dialation").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#no_dialation").val(empty);

                }

            });

            $("#dilatation").click(function() {

                var dtc = $("#dilatation_change").val();

                //alert("ani");

                if (dtc == 0) {

                    if ($("#dilatation").prop("checked") == true) {

                        var dt = new Date();

                        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

                        $("#dilatation_time").val(time);

                    } else if ($("#dilatation").prop("checked") == false) {

                        var dt = "";

                        $("#dilatation_time").val(dt);

                    }

                } else {

                    if ($(this).prop("checked") == true) {

                        var dlt = $("#dilatation_time").val();

                        if (dlt == '') {

                            var dt = new Date();

                            var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

                            $("#dilatation_time").val(time);

                        }

                    }

                }

            });

            $("#age").click(function() {

                //alert("Ani");

                var empty = $("#age").val();

                if (empty == "0") {

                    var empty2 = "";

                    $("#age").val(empty2);

                }

            });

            $("#doctor_id").click(function() {

                $("#doctor_id").removeAttr("readonly");

                $("#reffered_other_doc").prop('readonly', true);

            });

            $("#reffered_other_doc").click(function() {

                $("#reffered_other_doc").prop('readonly', false);

                $("#doctor_id").attr('readonly', 'readonly');

            });

            $("#doctor_id").change(function() {

                $("#reffered_other_doc").val("");

                $("#reffered_other_doc").prop('readonly', true);

            });

            $("#reffered_other_doc").keyup(function() {

                $("#doctor_id").val("");

                $("#doctor_id").attr('readonly', 'readonly');

            });

            $("#mediIndSearch_cur_btn").click(function() {

                var slVal = $("#mediIndSearch_cur").val();

                var chief_value = $("#current_medicine").val();

                if (chief_value != '') {

                    var slVal = chief_value + "\n" + slVal;

                }

                $("#current_medicine").val(slVal);

                // $('#chief').empty();

            });

            $("#EOM_select").change(function() {

                var dd = $("#EOM_select").val();

                $("#EOM").val(dd);

            });

            $("#EOM_left_select").change(function() {

                var dd = $("#EOM_left_select").val();

                $("#EOM_left").val(dd);

            });

            $("#important_visit").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#important_visit").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#important_visit").val(empty);

                }

            });

            $("#conjunctiva_select").change(function() {

                var dd = $("#conjunctiva_select").val();

                $("#conjunctiva").val(dd);

            });

            $("#conjunctiva_left_select").change(function() {

                var dd = $("#conjunctiva_left_select").val();

                $("#conjunctiva_left").val(dd);

            });

            $("#ot_notes_btn").click(function() {

                var ot_notes = $("#ot_notes").val();

                var ot_eye = $("#ot_eye").val();

                var ot_surgeon_name = $("#ot_surgeon_name").val();

                var ot_assitant_name = $("#ot_assitant_name").val();

                var ot_anasthesia_name = $("#ot_anasthesia_name").val();

                var ot_procedure_name = $("#ot_procedure_name").val(); // search drop down

                var iol_details = $("#iol_details").val(); // textarea

                var lens_masters_name = $("#lens_masters_name").val();

                var any_additinal_remarks = $("#any_additinal_remarks").val();

                var ot_location = $("#ot_location").val();

                var surgery_date = $("#surgery_date").val();

                //alert(surgery_date);

                var dateAr = surgery_date.split('-');

                //var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0].slice(-2);
				if(surgery_date==''){
               	 	var newDate = "";
				
				}else{
					 var newDate = " - " + dateAr[2] + '/' + dateAr[1] + '/' + dateAr[0];	
				}
				
				if(ot_surgeon_name==''){
               	  	ot_surgeon_name = "";
				
				}else{
					 ot_surgeon_name = "" +ot_surgeon_name	;	
				}
				
				if(ot_assitant_name==''){
               	  	ot_assitant_name = "";
				
				}else{
					 ot_assitant_name = " - " +ot_assitant_name	;	
				}
				
				if(ot_anasthesia_name==''){
               	  	ot_anasthesia_name = "";
				
				}else{
					 ot_anasthesia_name = " - " +ot_anasthesia_name	;	
				}
				
				if(ot_procedure_name==''){
               	  	ot_procedure_name = "";
				
				}else{
					 ot_procedure_name = " - " +ot_procedure_name	;	
				}
				
				if(iol_details==''){
               	  	iol_details = "";
				
				}else{
					 iol_details = " - " +iol_details	;	
				}
				
				if(lens_masters_name==''){
               	  	lens_masters_name = "";
				
				}else{
					 lens_masters_name = " - " +lens_masters_name	;	
				}
				
				
				if(any_additinal_remarks==''){
               	  	any_additinal_remarks = "";
				
				}else{
					 any_additinal_remarks = " - " +any_additinal_remarks	;	
				}
				
				if(ot_location==''){
               	  	ot_location = "";
				
				}else{
					 ot_location = " - " +ot_location	;	
				}
				
				if(ot_eye==''){
               	  	ot_eye = "";
				
				}else{
					 ot_eye = " - " +ot_eye	;	
				}

                

                if (ot_notes != '') {

                    var slVal = ot_notes + "\n" + ot_surgeon_name  + ot_assitant_name  + ot_anasthesia_name  + ot_eye  + ot_procedure_name  + iol_details  + lens_masters_name  + any_additinal_remarks  + ot_location + newDate ;

                } else {

                    var slVal = ot_surgeon_name  + ot_assitant_name  + ot_anasthesia_name  + ot_eye  + ot_procedure_name  + iol_details  + lens_masters_name  + any_additinal_remarks  + ot_location  + newDate ;

                }

                $("#ot_notes").val(slVal);

            });

            $("#model_close3").click(function() {

                var radioValue1 = $("input[name='option_choose1']:checked").val();

                if (radioValue1) {

                    var id1 = $("#select_id1").val();

                    $("#" + id1).val(radioValue1);

                }

                var radioValue2 = $("input[name='option_choose2']:checked").val();

                if (radioValue2) {

                    var id2 = $("#select_id2").val();

                    $("#" + id2).val(radioValue2);

                }

                var radioValue3 = $("input[name='option_choose3']:checked").val();

                if (radioValue3) {

                    var id3 = $("#select_id3").val();

                    $("#" + id3).val(radioValue3);

                }

                var radioValue4 = $("input[name='option_choose4']:checked").val();

                if (radioValue4) {

                    var id4 = $("#select_id4").val();

                    $("#" + id4).val(radioValue4);

                }

                $("input[name='option_choose1']").prop('checked', false);

                $("input[name='option_choose2']").prop('checked', false);

                $("input[name='option_choose3']").prop('checked', false);

                $("input[name='option_choose4']").prop('checked', false);

            });

            $("#sphere_block_div_plus_bt").click(function() {

                $("#sphere_block_div").toggle();

                $("#sphere_block_div").show();

                $("#sphere_block_div_minus_bt").show();

                $("#sphere_block_div_plus_bt").hide();

                $("#cyl_block_div").hide();

                $("#cyl_block_div_minus_bt").hide();

                $("#cyl_block_div_plus_bt").show();

                $("#axis_block_div").hide();

                $("#axis_block_div_minus_bt").hide();

                $("#axis_block_div_plus_bt").show();

                $("#add_block_div").hide();

                $("#add_block_div_minus_bt").hide();

                $("#add_block_div_plus_bt").show();

            });

            $("#sphere_block_div_minus_bt").click(function() {

                $("#sphere_block_div").toggle();

                $("#sphere_block_div").hide();

                $("#sphere_block_div_minus_bt").hide();

                $("#sphere_block_div_plus_bt").show();

                $("#cyl_block_div").hide();

                $("#cyl_block_div_minus_bt").hide();

                $("#cyl_block_div_plus_bt").show();

                $("#axis_block_div").hide();

                $("#axis_block_div_minus_bt").hide();

                $("#axis_block_div_plus_bt").show();

                $("#add_block_div").hide();

                $("#add_block_div_minus_bt").hide();

                $("#add_block_div_plus_bt").show();

            });

            $("#cyl_block_div_plus_bt").click(function() {

                $("#cyl_block_div").toggle();

                $("#cyl_block_div").show();

                $("#cyl_block_div_minus_bt").show();

                $("#cyl_block_div_plus_bt").hide();

                $("#sphere_block_div").hide();

                $("#sphere_block_div_minus_bt").hide();

                $("#sphere_block_div_plus_bt").show();

                $("#axis_block_div").hide();

                $("#axis_block_div_minus_bt").hide();

                $("#axis_block_div_plus_bt").show();

                $("#add_block_div").hide();

                $("#add_block_div_minus_bt").hide();

                $("#add_block_div_plus_bt").show();

            });

            $("#cyl_block_div_minus_bt").click(function() {

                $("#cyl_block_div").toggle();

                $("#cyl_block_div").hide();

                $("#cyl_block_div_minus_bt").hide();

                $("#cyl_block_div_plus_bt").show();

                $("#sphere_block_div").hide();

                $("#sphere_block_div_minus_bt").hide();

                $("#sphere_block_div_plus_bt").show();

                $("#axis_block_div").hide();

                $("#axis_block_div_minus_bt").hide();

                $("#axis_block_div_plus_bt").show();

                $("#add_block_div").hide();

                $("#add_block_div_minus_bt").hide();

                $("#add_block_div_plus_bt").show();

            });

            $("#axis_block_div_plus_bt").click(function() {

                $("#axis_block_div").toggle();

                $("#axis_block_div").show();

                $("#axis_block_div_minus_bt").show();

                $("#axis_block_div_plus_bt").hide();

                $("#sphere_block_div").hide();

                $("#sphere_block_div_minus_bt").hide();

                $("#sphere_block_div_plus_bt").show();

                $("#cyl_block_div").hide();

                $("#cyl_block_div_minus_bt").hide();

                $("#cyl_block_div_plus_bt").show();

                $("#add_block_div").hide();

                $("#add_block_div_minus_bt").hide();

                $("#add_block_div_plus_bt").show();

            });

            $("#axis_block_div_minus_bt").click(function() {

                $("#axis_block_div").toggle();

                $("#axis_block_div").hide();

                $("#axis_block_div_minus_bt").hide();

                $("#axis_block_div_plus_bt").show();

                $("#sphere_block_div").hide();

                $("#sphere_block_div_minus_bt").hide();

                $("#sphere_block_div_plus_bt").show();

                $("#cyl_block_div").hide();

                $("#cyl_block_div_minus_bt").hide();

                $("#cyl_block_div_plus_bt").show();

                $("#add_block_div").hide();

                $("#add_block_div_minus_bt").hide();

                $("#add_block_div_plus_bt").show();

            });

            $("#add_block_div_plus_bt").click(function() {

                $("#add_block_div").toggle();

                $("#add_block_div").show();

                $("#add_block_div_minus_bt").show();

                $("#add_block_div_plus_bt").hide();

                $("#sphere_block_div").hide();

                $("#sphere_block_div_minus_bt").hide();

                $("#sphere_block_div_plus_bt").show();

                $("#cyl_block_div").hide();

                $("#cyl_block_div_minus_bt").hide();

                $("#cyl_block_div_plus_bt").show();

                $("#axis_block_div").hide();

                $("#axis_block_div_minus_bt").hide();

                $("#axis_block_div_plus_bt").show();

            });

            $("#add_block_div_minus_bt").click(function() {

                $("#add_block_div").toggle();

                $("#add_block_div").hide();

                $("#add_block_div_minus_bt").hide();

                $("#add_block_div_plus_bt").show();

                $("#sphere_block_div").hide();

                $("#sphere_block_div_minus_bt").hide();

                $("#sphere_block_div_plus_bt").show();

                $("#cyl_block_div").hide();

                $("#cyl_block_div_minus_bt").hide();

                $("#cyl_block_div_plus_bt").show();

                $("#axis_block_div").hide();

                $("#axis_block_div_minus_bt").hide();

                $("#axis_block_div_plus_bt").show();

            });

            $('input[data-list]').each(function() {

                var availableTags = $('#' + $(this).attr("data-list")).find('option').map(function() {

                    return this.value;

                }).get();

                $(this).autocomplete({

                    source: availableTags

                }).on('focus', function() {

                    $(this).autocomplete('search', ' ');

                }).on('search', function() {

                    if ($(this).val() === '') {

                        $(this).autocomplete('search', ' ');

                    }

                });

            });

            $("#generale_insta_btn").click(function() {

                var general_instructions = $("#general_instructions").val();

                var action_plan = $("#action_plan").val();

                var general_instructions_list_slct = $("#general_instructions_list_slct").val();

                var general_instructions_subpackage = $("#general_instructions_subpackage").val();

                var general_information = $("#general_information").val(); // search drop down
				
				if(action_plan==''){
               	  	action_plan = "";
				
				}else{
					 action_plan = "" +action_plan	;	
				}
				
				if(general_instructions_list_slct==''){
               	  	general_instructions_list_slct = "";
				
				}else{
					 general_instructions_list_slct = "" +general_instructions_list_slct	;	
				}
				
				
				
				if(general_information==''){
               	  	general_information = "";
				
				}else{
					 general_information = "" +general_information	;	
				}

                if (general_instructions != '') {

                    var slVal = general_instructions + "\n" + action_plan  + general_instructions_list_slct    + general_information;

                } else {

                    var slVal = action_plan  + general_instructions_list_slct    + general_information;

                }

                $("#general_instructions").val(slVal);

            });

            $("#certificate_btn").click(function() {

                var certificate = $("#certificate").val();

                var certificate_select = $("#certificate_select").val();

                if (general_instructions != '') {

                    var slVal = certificate + "\n" + certificate_select;

                } else {

                    var slVal = certificate_select;

                }

                $("#certificate").val(slVal);

            });

           
            $("#ot_notes_block").click(function() {

                if ($(this).prop("checked") == true) {

                    var empty = 1;

                    $("#ot_notes_block").val(empty);

                } else if ($(this).prop("checked") == false) {

                    var empty = 0;

                    $("#ot_notes_block").val(empty);

                }

            });

            $("#certificate_block_div_plus_bt").click(function() {

                $("#certificate_block_div").toggle();

                $("#certificate_block_div").show();

                $("#certificate_block_div_minus_bt").show();

                $("#certificate_block_div_plus_bt").hide();

            });

            $("#certificate_block_div_minus_bt").click(function() {

                $("#certificate_block_div").toggle();

                $("#certificate_block_div").hide();

                $("#certificate_block_div_minus_bt").hide();

                $("#certificate_block_div_plus_bt").show();

            });

            $("#otnotes_block_div_plus_bt").click(function() {

                $("#otnotes_block_div").toggle();

                $("#otnotes_block_div").show();

                $("#otnotes_block_div_minus_bt").show();

                $("#otnotes_block_div_plus_bt").hide();

            });

            $("#otnotes_block_div_minus_bt").click(function() {

                $("#otnotes_block_div").toggle();

                $("#otnotes_block_div").hide();

                $("#otnotes_block_div_minus_bt").hide();

                $("#otnotes_block_div_plus_bt").show();

            });

            $("#flash_block_div_plus_bt").click(function() {

                $("#flash_block_div").toggle();

                $("#flash_block_div").show();

                $("#flash_block_div_minus_bt").show();

                $("#flash_block_div_plus_bt").hide();

            });

            $("#flash_block_div_minus_bt").click(function() {

                $("#flash_block_div").toggle();

                $("#flash_block_div").hide();

                $("#flash_block_div_minus_bt").hide();

                $("#flash_block_div_plus_bt").show();

            });

            $("#investigation_block_div_plus_bt").click(function() {

                $("#investigation_block_div").toggle();

                $("#investigation_block_div").show();

                $("#investigation_block_div_minus_bt").show();

                $("#investigation_block_div_plus_bt").hide();

            });

            $("#investigation_block_div_minus_bt").click(function() {

                $("#investigation_block_div").toggle();

                $("#investigation_block_div").hide();

                $("#investigation_block_div_minus_bt").hide();

                $("#investigation_block_div_plus_bt").show();

            });

            $("#procedure_block_div_plus_bt").click(function() {

                $("#procedure_block_div").toggle();

                $("#procedure_block_div").show();

                $("#procedure_block_div_minus_bt").show();

                $("#procedure_block_div_plus_bt").hide();

            });

            $("#procedure_block_div_minus_bt").click(function() {

                $("#procedure_block_div").toggle();

                $("#procedure_block_div").hide();

                $("#procedure_block_div_minus_bt").hide();

                $("#procedure_block_div_plus_bt").show();

            });

            $("#procedure_select").change(function() {

                // get the currently selected country ID

                var countryId = $(this).val();

                var emty = "";

                $.ajax({

                    type: "POST",

                    dataType: "json",

                    url: "<?php echo ADMIN_URL; ?>ajax_for_emr/get_procedure_subpackage_for_emr.php",

                    data: 'countryId=' + countryId,

                    success: function(data) {

                        $('#procedure_sub_select').empty();

                        $('#procedure_sub_select').append($('<option/>', {

                            value: emty,

                            text: emty

                        }));

                        $.each(data, function(index, element) {

                            //alert(element.medication_package_subtext);

                            $('#procedure_sub_select').append($('<option/>', {

                                value: element.medication_package_subtext,

                                text: element.medication_package_subtext

                            }));

                        });

                    }

                });

            });
			
			$("#patient_related_iop_add_button").live('click',function(){ 

					 var i=$("#patient_related_countiop").val();
		
					 i=parseInt(i)+1;
		
					 $("#patient_related_countiop").val(i);
		
					 //alert(i);			
		
					 $("#patient_related_iop_tab").append('<tr id="patient_related_iop' + i + '"><td style="min-width:200px !important"><input type="text" class="form-control" name="patient_related_document_name' + i + '" id="patient_related_document_name' + i + '" value="" ><input type="hidden" class="form-control" name="patient_related_document_flag' + i + '" id="patient_related_document_flag' + i + '" value="0" ></td> <td style="min-width:300px !important">Document(Upload .doc,.pdf,.jpg file) : <span style="color:#b32424;font-weight:bold;"><?php  echo "Not Uploaded Yet.."; ?></span><input type="hidden" class="form-control" name="patient_related_document_upload' + i + '" id="patient_related_document_upload' + i + '" > <input name="patient_related_document_upload' + i + '" id="patient_related_document_upload' + i + '"  class="form-control" type="file"></td> <td style="min-width:100px !important"><a href="javascript:void(0);"  id="patient_related_iop_remove' + i + '" onClick="patient_related_remove_iop('+ i +')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');
		
			 }); 
			 
			 $("#add_miscellaneous_eye_test_button").click(function() {
                var i = $("#count_miscellaneous_eye_test").val();
                i = parseInt(i) + 1;
                $("#count_miscellaneous_eye_test").val(i);                
				
				$("#miscellaneous_eye_test_tab").append('<tr id="miscellaneous_eye_test_body' + i + '">  <input type="hidden" name="misc_eye_test_flag' + i + '" id="misc_eye_test_flag' + i + '" value="0"><td ><select name="misc_eye_test_select' + i + '" id="misc_eye_test_select' + i + '" class="form-control" ><option value=""> Choose..</option><?php $sql7="select * from `miscellaneous_eye_test_masters_for_emr` ORDER BY `misc_eye_test_name` asc"; $result7=$conn->query($sql7) ; while($row7=mysqli_fetch_array($result7,MYSQLI_ASSOC)){ echo '<option value="'.$row7['id'].'">'.$row7['misc_eye_test_name'].'</option>';} ?> </select></td> <td colspan="2"><input type="text" class="form-control" placeholder="OD" name="misc_eye_test_od' + i + '" id="misc_eye_test_od' + i + '" value=""></td><td colspan="2"><input type="text" class="form-control" placeholder="OS" name="misc_eye_test_os' + i + '" id="misc_eye_test_os' + i + '" value=""></td><td ><a href="javascript:void(0);"  id="at_details_remove' + i + '" onClick="remove_miscellaneous_eye_test(' + i + ');" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');

            });

        });
		
		function remove_miscellaneous_eye_test(j) {

            $("#miscellaneous_eye_test_body" + j).remove();

        }
        function remove_miscellaneous_eye_test_del(j, id) {

            $("#miscellaneous_eye_test_body" + j).remove();

            var remove_id_for_miscellaneous_eye_test = $("#remove_id_for_miscellaneous_eye_test").val();

            var values_drug = remove_id_for_miscellaneous_eye_test + id + ":";

            $("#remove_id_for_miscellaneous_eye_test").val(values_drug);

        }
		
		function patient_related_remove_iop(j) {

		  $("#patient_related_iop"+j).remove();
		
		}
		
		function patient_related_remove_iop_del(j,id) {
		
		  $("#patient_related_iop"+j).remove();	  
		
		  var remove_id=$("#patient_related_remove_id").val();
		
		  var values_drug=remove_id+id+":";
		
		  $("#patient_related_remove_id").val(values_drug);
		
		}

        function remove_at_details(j) {

            $("#at_details_body" + j).remove();

        }
        function remove_at_details_del(j, id) {

            $("#at_details_body" + j).remove();

            var remove_id_for_at_details = $("#remove_id_for_at_details").val();

            var values_drug = remove_id_for_at_details + id + ":";

            $("#remove_id_for_at_details").val(values_drug);

        }
        function model_open(j, k) {

            $('#draggable').modal('show');

            if ((j == 'sph_od') || (j == 'cly_od') || (j == 'axis_od') || (j == 'sph_add')) {

                $("#select_id1").val('sph_od');

                $("#select_id2").val('cly_od');

                $("#select_id3").val('axis_od');

                $("#select_id4").val('sph_add');

            }

            if ((j == 'sph_os') || (j == 'cyl_os') || (j == 'axis_os') || (j == 'add_os')) {

                $("#select_id1").val('sph_os');

                $("#select_id2").val('cyl_os');

                $("#select_id3").val('axis_os');

                $("#select_id4").val('add_os');

            }

            if ((j == 'flash_od') || (j == 'flash_cly_od') || (j == 'flash_axis_od')) {

                $("#select_id1").val('flash_od');

                $("#select_id2").val('flash_cly_od');

                $("#select_id3").val('flash_axis_od');

            }

            if ((j == 'flash_os') || (j == 'flash_cyl_os') || (j == 'flash_axis_os')) {

                $("#select_id1").val('flash_os');

                $("#select_id2").val('flash_cyl_os');

                $("#select_id3").val('flash_axis_os');

            }

            if ((j == 'distance_sph_r') || (j == 'distance_cyl_r') || (j == 'distance_axis_r') || (j == 'distance_va_r')) {

                $("#select_id1").val('distance_sph_r');

                $("#select_id2").val('distance_cyl_r');

                $("#select_id3").val('distance_axis_r');

                $("#select_id4").val('distance_va_r');

            }

            if ((j == 'distance_sph_l') || (j == 'distance_cyl_l') || (j == 'distance_axis_l') || (j == 'distance_va_l')) {

                $("#select_id1").val('distance_sph_l');

                $("#select_id2").val('distance_cyl_l');

                $("#select_id3").val('distance_axis_l');

                $("#select_id4").val('distance_va_l');

            }

            if ((j == 'near_sph_r') || (j == 'near_cyl_r') || (j == 'near_axis_r') || (j == 'near_va_r')) {

                $("#select_id1").val('near_sph_r');

                $("#select_id2").val('near_cyl_r');

                $("#select_id3").val('near_axis_r');

                $("#select_id4").val('near_va_r');

            }

            if ((j == 'near_sph_l') || (j == 'near_cyl_l') || (j == 'near_axis_l') || (j == 'near_va_l')) {

                $("#select_id1").val('near_sph_l');

                $("#select_id2").val('near_cyl_l');

                $("#select_id3").val('near_axis_l');

                $("#select_id4").val('near_va_l');

            }

            $("#select_type").val(k);

            if (k == '1') {

                $("#sphere_block_div").toggle();

                $("#sphere_block_div").show();

                $("#sphere_block_div_minus_bt").show();

                $("#sphere_block_div_plus_bt").hide();

                $("#cyl_block_div").hide();

                $("#cyl_block_div_minus_bt").hide();

                $("#cyl_block_div_plus_bt").show();

                $("#axis_block_div").hide();

                $("#axis_block_div_minus_bt").hide();

                $("#axis_block_div_plus_bt").show();

                $("#add_block_div").hide();

                $("#add_block_div_minus_bt").hide();

                $("#add_block_div_plus_bt").show();

            }

            if (k == '2') {

                $("#cyl_block_div").toggle();

                $("#cyl_block_div").show();

                $("#cyl_block_div_minus_bt").show();

                $("#cyl_block_div_plus_bt").hide();

                $("#sphere_block_div").hide();

                $("#sphere_block_div_minus_bt").hide();

                $("#sphere_block_div_plus_bt").show();

                $("#axis_block_div").hide();

                $("#axis_block_div_minus_bt").hide();

                $("#axis_block_div_plus_bt").show();

                $("#add_block_div").hide();

                $("#add_block_div_minus_bt").hide();

                $("#add_block_div_plus_bt").show();

            }

            if (k == '3') {

                $("#axis_block_div").toggle();

                $("#axis_block_div").show();

                $("#axis_block_div_minus_bt").show();

                $("#axis_block_div_plus_bt").hide();

                $("#sphere_block_div").hide();

                $("#sphere_block_div_minus_bt").hide();

                $("#sphere_block_div_plus_bt").show();

                $("#cyl_block_div").hide();

                $("#cyl_block_div_minus_bt").hide();

                $("#cyl_block_div_plus_bt").show();

                $("#add_block_div").hide();

                $("#add_block_div_minus_bt").hide();

                $("#add_block_div_plus_bt").show();

            }

            if (k == '4') {

                $("#add_block_div").toggle();

                $("#add_block_div").show();

                $("#add_block_div_minus_bt").show();

                $("#add_block_div_plus_bt").hide();

                $("#sphere_block_div").hide();

                $("#sphere_block_div_minus_bt").hide();

                $("#sphere_block_div_plus_bt").show();

                $("#cyl_block_div").hide();

                $("#cyl_block_div_minus_bt").hide();

                $("#cyl_block_div_plus_bt").show();

                $("#axis_block_div").hide();

                $("#axis_block_div_minus_bt").hide();

                $("#axis_block_div_plus_bt").show();

            }

        }
        function getstate(value) {

            //alert(value); 

            $.ajax({

                type: 'post',

                url: "<?php echo  ADMIN_URL; ?>Pincode/getstate.php",

                data: {

                    'cid': value

                },

                success: function(resultData) {

                    console.log(resultData);

                    $('#location2').html(resultData);

                }

            });

        }
      
        function del_img(id, img_name) {

            if (confirm("Are you sure you want to delete this image?")) {

                $('#' + id).remove();

                var i_id = $("#i_id").val();

                try {

                    $.ajax({

                        type: "POST",

                        url: "<?php echo ADMIN_URL; ?>delete_upload_ajax_for_emr.php?i_id=" + i_id,

                        dataType: "json",

                        data: "id=" + img_name,

                        success: function(data) {

                            //alert(data.amount);

                            try {

                                $("#amount").val(data.amount);

                            } catch (err) {

                                alert(err.message);

                            }

                        }

                    });

                } catch (err) {

                    alert(err.message);

                }

                setInterval(function() {

                    $('#error_msg').html('');

                }, 5000);

            }

        }
        function old_pres_pb_fetch(p_id) {

            $('#exampleModal').modal('hide');

            //alert(p_id);

            var data = {

                "mrd": $("#mrd").val(),

                "id": p_id

            }

            $.ajax({

                beforeSend: function() {

                    $('.ajax-loader').css("visibility", "visible");

                },

                url: "<?php echo ADMIN_URL; ?>ajax_for_emr/dr_pb_values_fetch_from_trenetralaya_for_emr.php?flag=2",

                type: "POST",

                dataType: 'json',

                data: data,

                success: function(data) {

                    $("#chief_complaints_history").val(data.chief_complaints_history);

                    $("#past_ocular_history").val(data.past_ocular_history);

                    $("#general_health").val(data.general_health);

                    $("#family_history").val(data.family_history);

                    $("#allergy_history").val(data.allergy_history);

                    $("#pgp_block").val(data.pgp_block);

                    $("#pgp").val(data.pgp);

                    $("#sph_od").val(data.sph_od);

                    $("#sph_add").val(data.sph_add);

                    $("#cly_od").val(data.cly_od);

                    $("#axis_od").val(data.axis_od);

                    $("#sph_os").val(data.sph_os);

                    $("#cyl_os").val(data.cyl_os);

                    $("#axis_os").val(data.axis_os);

                    $("#add_os").val(data.add_os);

                    $("#ocular_block").val(data.ocular_block);

                    $("#dv_glasses").val(data.dv_glasses);

                    $("#dv_od").val(data.dv_od);

                    $("#nv_od").val(data.nv_od);

                    $("#dv_os").val(data.dv_os);

                    $("#nv_os").val(data.nv_os);

                    $("#glass_block").val(data.glass_block);

                    $("#distance_sph_r").val(data.distance_sph_r);

                    $("#distance_cyl_r").val(data.distance_cyl_r);

                    $("#distance_axis_r").val(data.distance_axis_r);

                    $("#distance_va_r").val(data.distance_va_r);

                    $("#distance_sph_l").val(data.distance_sph_l);

                    $("#distance_cyl_l").val(data.distance_cyl_l);

                    $("#distance_axis_l").val(data.distance_axis_l);

                    $("#distance_va_l").val(data.distance_va_l);

                    $("#near_sph_r").val(data.near_sph_r);

                    $("#near_va_r").val(data.near_va_r);

                    $("#near_sph_l").val(data.near_sph_l);

                    $("#near_va_l").val(data.near_va_l);

                    $("#cover_test_select").val(data.cover_test_select);

                    $("#cover_test_text").val(data.cover_test_text);

                    $("#EOM").val(data.EOM);

                    $("#EOM_left").val(data.EOM_left);

                    $("#pupils").val(data.pupils);

                    $("#pupils_left").val(data.pupils_left);

                    $("#lid_adnexa").val(data.lid_adnexa);

                    $("#lid_adnexa_left").val(data.lid_adnexa_left);

                    $("#anterior_chamber").val(data.anterior_chamber);

                    $("#anterior_chamber_left").val(data.anterior_chamber_left);

                    $("#anterior_figure").val(data.anterior_figure);

                    $("#anterior_segment").val(data.anterior_segment);

                    $("#anterior_left_segment").val(data.anterior_left_segment);

                    $("#misc_findings").val(data.misc_findings);

                    $("#misc_findings_left").val(data.misc_findings_left);

                    $("#goneoscopy").val(data.goneoscopy);

                    $("#goneoscopy_left").val(data.goneoscopy_left);

                    $("#fundus_figure").val(data.fundus_figure);

                    $("#fundus").val(data.fundus);

                    $("#fundus_left").val(data.fundus_left);

                    $("#keratometry_block").val(data.keratometry_block);

                    $("#rk1").val(data.rk1);

                    $("#rk2").val(data.rk2);

                    $("#lk1").val(data.lk1);

                    $("#lk2").val(data.lk2);

                    $("#axial_length").val(data.axial_length);

                    $("#axial_length_left").val(data.axial_length_left);

                    $("#scotopic_pupil").val(data.scotopic_pupil);

                    $("#scotopic_pupil_left").val(data.scotopic_pupil_left);

                    $("#ww_diameter").val(data.ww_diameter);

                    $("#ww_diameter_left").val(data.ww_diameter_left);

                    $("#schirmers_test").val(data.schirmers_test);

                    $("#schirmers_test_left").val(data.schirmers_test_left);

                    $("#visual_fields").val(data.visual_fields);

                    $("#visual_fields_left").val(data.visual_fields_left);

                    $("#optical_coherence").val(data.optical_coherence);

                    $("#optical_coherence_left").val(data.optical_coherence_left);

                    $("#investigation").val(data.investigation);

                    $("#diagnostic").val(data.diagnostic);

                    $("#surgery_block").val(data.surgery_block);

                    $("#surgery").val(data.surgery);

                    $("#medication_block").val(data.medication_block);

                    $("#medication").val(data.medication);

                    $("#pre_operative_block").val(data.pre_operative_block);

                    $("#pre_operative").val(data.pre_operative);

                    $("#general_instructions").val(data.general_instructions);

                    $("#spglass_block").val(data.spglass_block);

                    $("#near_cyl_r").val(data.near_cyl_r);

                    $("#near_axis_r").val(data.near_axis_r);

                    $("#near_cyl_l").val(data.near_cyl_l);

                    $("#near_axis_l").val(data.near_axis_l);

                    $("#glass_prescription").val(data.glass_prescription);

                    $("#pinhole_od").val(data.pinhole_od);

                    $("#pinhole_os").val(data.pinhole_os);

                    $("#flash_od").val(data.flash_od);

                    $("#flash_os").val(data.flash_os);

                    $("#field_block").val(data.field_block);

                    $("#roplas_right").val(data.roplas_right);

                    $("#roplas_left").val(data.roplas_left);

                    $("#pachymetery").val(data.pachymetery);

                    $("#pachymetery_left").val(data.pachymetery_left);

                    $("#iol_power").val(data.iol_power);

                    $("#iol_power_left").val(data.iol_power_left);

                    $("#spmedication_block").val(data.spmedication_block);

                    $("#procedure_block").val(data.procedure_block);

                    $("#procedure_comments").val(data.procedure_comments);

                    $("#previous_medicine").val(data.previous_medicine);

                    $("#w_mobile").val(data.w_mobile);

                    $("#pin").val(data.pin);

                    $("#location2").val(data.location2);

                    $("#history_of_present_illness").val(data.history_of_present_illness);

                    $("#current_treatment").val(data.current_treatment);

                    $("#conjunctiva").val(data.conjunctiva);

                    $("#conjunctiva_left").val(data.conjunctiva_left);

                    $("#oct_macula").val(data.oct_macula);

                    $("#oct_macula_left").val(data.oct_macula_left);

                    $("#color_vision_isihara").val(data.color_vision_isihara);

                    $("#color_vision_isihara_left").val(data.color_vision_isihara_left);

                    $("#ot_notes_block").val(data.ot_notes_block);

                    $("#ot_notes").val(data.ot_notes);

                    $("#flash_cly_od").val(data.flash_cly_od);

                    $("#flash_axis_od").val(data.flash_axis_od);

                    $("#flash_cyl_os").val(data.flash_cyl_os);

                    $("#flash_axis_os").val(data.flash_axis_os);

                    $("#certificate").val(data.certificate);
					
					$("#dv_glasses_left").val(data.dv_glasses_left);
					
					$("#pr_left").val(data.pr_left);
					$("#pr_right").val(data.pr_right);
					$("#mb_ocular").val(data.mb_ocular);
					$("#mb_ocular_left").val(data.mb_ocular_left);
					$("#tears_outflow_system").val(data.tears_outflow_system);
					$("#tears_outflow_system_right").val(data.tears_outflow_system_right);
					$("#cornea_ocular").val(data.cornea_ocular);
					$("#cornea_ocular_left").val(data.cornea_ocular_left);
					$("#iris_ocular").val(data.iris_ocular);
					$("#iris_ocular_left").val(data.iris_ocular_left);
					$("#lens_ocular").val(data.lens_ocular);
					$("#lens_ocular_left").val(data.lens_ocular_left);
					$("#vitreous_ocular").val(data.vitreous_ocular);
					$("#vitreous_ocular_left").val(data.vitreous_ocular_left);
					$("#retina_ocular").val(data.retina_ocular);					
					$("#retina_ocular_left").val(data.retina_ocular_left);
					$("#onh_ocular").val(data.onh_ocular);
					$("#onh_ocular_left").val(data.onh_ocular_left);
					$("#remarks_pres").val(data.remarks_pres);
					$("#iridotomy_left").val(data.iridotomy_left);					
					$("#iridotomy_right").val(data.iridotomy_right);
					$("#explained_surgery_textarea").val(data.explained_surgery_textarea);
					$("#ac_ocular").val(data.ac_ocular);
					$("#ac_ocular_left").val(data.ac_ocular_left);

                },

                complete: function() {

                    $('.ajax-loader').css("visibility", "hidden");

                }

            });

        }
        
		
		function age_calculate_auto() {

            var dob = $("#dob").val();

            //alert(dob);

            try {

                //alert(id);

                $.ajax({

                    type: "POST",

                    url: "<?php echo ADMIN_URL; ?>ajax_for_emr/age_change_ajax_for_emr.php",

                    dataType: "json",

                    data: "dob=" + dob,

                    success: function(data) {

                        //alert(data.flag);

                        try {

                            // $("#investigation_package").val(data.optm_name);

                            $("#age").val(data.age);

                            $("#age_month").val(data.age_month);

                            $("#age_days").val(data.age_days);

                        } catch (err) {

                            alert(err.message);

                        }

                    }

                });

            } catch (err) {

                alert(err.message);

            }

        };

        var fname = $("#fname").val();

        var dob = $("#dob").val();

        if (fname != '') {

            if (dob != '') {

                //alert(dob);

                age_calculate_auto();

            }

        }
        function old_pres_pb_fetch_model() {

            $("#old_patient_date_popup_show").html("loading...");

            var form_data = {

                "mrd": $("#mrd").val(),

                "id": $("#id").val()

            }

            $.ajax({

                url: '<?php echo ADMIN_URL; ?>ajax_for_emr/dr_pb_values_fetch_from_trenetralaya_for_emr.php?flag=3',

                dataType: 'json',

                type: 'POST',

                data: form_data,

                success: function(data) {

                    //alert(data);

                    $('#exampleModal').modal();

                    $("#old_patient_date_popup_show").html("");

                    $.each(data, function(index, element) {

                        //var html='<a href="javascript:void(0)" target="_blank">'+data.created_on+'</a>';

                        var html = '<label><span id="mrd"><a href="javascript:void(0)" onClick="old_pres_pb_fetch(\'' + element.id + '\');">' + element.created_on + '</a></span></label><br>';

                        $("#old_patient_date_popup_show").append(html);

                    });

                }

            });

        } 

		

function remove_iop_for_drug(j) {

  $("#iop_for_drug"+j).remove();

}

function remove_iop_del_for_drug(j,id) {

  $("#iop_for_drug"+j).remove();	  

  var remove_id_for_drug=$("#remove_id_for_drug").val();

  var values_drug=remove_id_for_drug+id+":";

  $("#remove_id_for_drug").val(values_drug);

}

function qty_get(no){

	var dose_id=$("#dose"+no).val();

	var drugsheet_time=$("#drugsheet_time"+no).val();

	//alert(dose_id);

	//return 0;

	//alert(id);

	try{					

				$.ajax({

								type : "POST",

								url : "<?php echo ADMIN_URL; ?>ajax/qty_calculation.php?drugsheet_time="+drugsheet_time,

								dataType : "json", 

								data : "dose_id="+dose_id,

								success : function(data) {						

									//alert(data.amount);

									try{ 									 

										 $("#qty"+no).val(data.qty);

										  $("#qty_dose"+no).val(data.qty);

										 		 

									}

									catch(err){

										alert(err.message);

									}

								}

							});

						}catch(err){

							alert(err.message);

						}

					setInterval(function(){

					   $('#error_msg').html('');

					  }, 5000);

}

function stock_value_check(no){	

		

	$('#close_stock_span'+no).html('');

	var item_id=$('#drug'+no).val();

	$.ajax({

			type : "POST",

			url : "<?php echo ADMIN_URL; ?>ajax/inventory_stock_get_ajax.php",

			dataType : "json", 

			data : "item_id="+item_id,

			success : function(data) {

					$('#close_stock_span'+no).html('Closing Stock : '+data.closing_stock);																			

			}

		});	

};
function retrieve_procedure_next(sl_no){		

	$("#drug"+sl_no).html("");

	$("#drug"+sl_no).append($('<option/>', { 

	value: "",

	text : "Select Medicine" 

	}));	

	$.ajax({

		url: '<?php echo ADMIN_URL; ?>get_json_data_inventory.php?flag=88',

		dataType: 'json',

		type: 'POST',		

		success: function (data) {

						

			 $.each(data, function(index, element) {

				$("#drug"+sl_no).append($('<option/>', { 

					value: element.id,

					text : element.text 

				}));				

			 });

			 

		 }

		 

	 });	

}

function masters_modal_open(table,column,heading,ele_id,ele_left_id){
	 $("#master_modal").modal("show");
	 $("#table_db").val(table);
	 $("#column_db").val(column);
	 $("#main_heading").html(heading);
	 $("#sub_heading").html(heading);
	 $("#dropdown_id").val(ele_id);
	 $("#dropdown_id_left").val(ele_left_id);
	 //alert(ele_id);
	 $("#master_name").val('');
}
function add_on(){
	var table=$("#table_db").val();
	var column=$("#column_db").val();
	var name=$("#master_name").val();
	var ele=$("#dropdown_id").val();
	var ele_left=$("#dropdown_id_left").val();
	//alert(table);
	//alert(column);
	//return false;
	if(name != ''){
		$.ajax({
			     type: 'post',
				 url: "get_data.php",
				 data: {'purpose':1,'table':table,'column':column,'name':name},
				 success:function(data){
					 if(data==1){
						  load_masters(table,column,ele,ele_left);
					 }		 										
				 }
		      });
	}
	$("#master_modal").modal("hide");
}
function load_masters(table,column,ele,ele_left){
	$.ajax({
			     type: 'post',
				 url: "get_data.php",
				 data: {'purpose':2,'table':table,'column':column},
				 success:function(data){
					 var value=$("#"+ele).val(); 					
					 $("#"+ele).html(data);
					 $("#"+ele).val(value);	
					 if(ele_left != ''){
						 var value_left=$("#"+ele_left).val(); 					
						 $("#"+ele_left).html(data);
						 $("#"+ele_left).val(value_left);	
					 }
				 }
		      });
}
$(document).ready( function() {
	  $('#investigation_list').select2();
	  $('#surgery_select').select2();
	  $('#surgPackageSelect').select2();
	  
	  });
	  
	  function package_modal_open(pkg_flag,table,column,heading,ele_id){
		 $("#pkg_modal").modal("show");
		 $("#pkg_table").val(table);
		 $("#pkg_col").val(column);
		 $("#pkg_heading").html(heading);
		 $("#pkg_flag").val(pkg_flag);
		 $("#pkg_list").val(ele_id);
		 //$("#dropdown_id_left").val(ele_left_id);
		 //alert(ele_id);
		 $("#pkg_name").val('');
		 $('#count_inv').val('0');
		 $("#investigation_tab").html('');
}

function add_one_pkg(){
				var count=$('#count_inv').val();
				count=parseInt(count)+1;
				$('#count_inv').val(count);
				//alert(count);
				$("#investigation_tab").append('<tr id="iop' + count + '"><td width="80%"> <div class="input-group"> <span class="input-group-addon">Subpackage</span><input type="text" class="form-control" placeholder="Enter Subpackage Name" name="investigation_package_subtext' + count + '" id="investigation_package_subtext' + count + '" ></div></td><td width="20%"><a href="javascript:void(0);"  id="inv_remove' + count + '" onClick="remove_inv('+ count +')" class="btn btn-sm default" title="OK"><i class="fa fa-times" style="font-size:16px;color:red"></i></a></td></tr>');
			}
	function remove_inv(j) {
	  $("#iop"+j).hide();
	  $("#investigation_package_subtext"+j).val('');
}	

function save_pkg(){
	var table=$("#pkg_table").val();
	var column=$("#pkg_col").val();
	var name=$("#pkg_name").val();
	var ele=$("#pkg_list").val();
	var pkg_flag=$("#pkg_flag").val();
	var arr=[];
	var k=0;
	var count=parseInt($('#count_inv').val());
	for(var i=1;i<=count;i++){
		var sub_pkg=$('#investigation_package_subtext'+i).val();
		if(sub_pkg != ''){
			arr[k]=sub_pkg;
			k++;
		}
	}
	//var ele_left=$("#dropdown_id_left").val();
	//alert(table);
	//alert(column);
	//return false;
	if(name != ''){
		$.ajax({
			     type: 'post',
				 url: "get_data.php",
				 data: {'purpose':3,'table':table,'column':column,'name':name,'pkg_flag':pkg_flag,'sub_pac':arr},
				 success:function(data){
					 if(data==1){
						  load_pkg(table,column,ele);
					 }		 										
				 }
		      });
	}
	$("#pkg_modal").modal("hide");
}
function load_pkg(table,column,ele){
	$.ajax({
			     type: 'post',
				 url: "get_data.php",
				 data: {'purpose':4,'table':table,'column':column},
				 success:function(data){
					 var value=$("#"+ele).val(); 					
					 $("#"+ele).html(data);
					 $("#"+ele).val(value);	
					 
				 }
		      });
}

function diagnosis_modal_open(){
	$("#diagnosis_modal").modal("show"); 
	$("#diagnosis_text").val('');
	$("#diagnosis_code").val('');
}
function save_diagnosis(){
	var diagnosis=$("#diagnosis_text").val();
	var code=$("#diagnosis_code").val();
	
	if(diagnosis != ''){
		$.ajax({
			     type: 'post',
				 url: "get_data.php",
				 data: {'purpose':5,'diagnosis':diagnosis,'code':code},
				 success:function(data){
					 if(data==1){
						  load_diagnosis();
					 }		 										
				 }
		      });
	}
	$("#diagnosis_modal").modal("hide");

}
function load_diagnosis(){
	$.ajax({
			     type: 'post',
				 url: "get_data.php",
				 data: {'purpose':6},
				 success:function(data){
					 var value=$("#brand-filter").val(); 					
					 $("#brand-filter").html(data);
					 $("#brand-filter").val(value);	
					 
				 }
		      });
}
	  

	

function updateTime() {
  
  // Get current time
  const now = new Date();
  const currentTime = now.toLocaleTimeString(); // Format the time as HH:MM:SS
  
return currentTime;
}function prescription_sms(){
		var sms_msg_patient_wp_no=$("#mobile").val();
		if(sms_msg_patient_wp_no==''){
			$("#msg_sent").html("SMS no. is not provided, please edit prescription to enter SMS no.");
			$("#msg_sent").css("color","#cc335c");
			setInterval(function(){
				   $('#msg_sent').html('');
				}, 8000);
			return false;
		}
		var error_mobile_no_flag=$("#error_mobile_no_flag").val();
		if(error_mobile_no_flag=='1'){
			$("#msg_sent").html("SMS no. is not valid, please edit prescription to enter valid SMS no.");
			$("#msg_sent").css("color","#cc335c");
			setInterval(function(){
				   $('#msg_sent').html('');
				}, 8000);
			return false;
		}
		var form_data={
					"sms_msg_patient_name":$("#fname").val()+ ' '+$("#lname").val(),
					"sms_msg_patient_wp_no":$("#mobile").val(),	
					"sms_msg_patient_mrd":$("#mrd").val(),
					"sms_msg_patient_id":$("#id").val(),
					"sms_msg_primary_doctor":$("#primary_doctor").val()			
			};
		
		$.ajax({
			type : "POST",
			url : "<?php echo ADMIN_URL; ?>get_json_sms.php?data_flag=2",
			dataType : "json", 
			data : form_data,
			success : function(data) {	
				if(data.return_flag==1){			
					$("#msg_sent").html("SMS Message Sent Successfully...");
					$("#msg_sent").css("color","#33cc80");
				}else{
					$("#msg_sent").html("SMS Message did not sent, try again..");
					$("#msg_sent").css("color","#cc335c");
				}
				setInterval(function(){
				   $('#msg_sent').html('');
				}, 6000);
			}
		});				
 
} 

function prescription_print_page(){
	var sms_msg_patient_id=$("#id").val();
	var new_url="<?php echo ADMIN_URL; ?>printPrescription_for_emr.php?id="+sms_msg_patient_id;
	window.open(new_url, '_blank');
}

function prescription_dashboard_page(){
	var msg="Record updated successfully";
	var new_url="<?php echo ADMIN_URL; ?>dashboard_for_emr.php?msg="+msg+"&flg=0";
	window.location.href=new_url; 
}

function old_pres_archieve_model() {

            $("#old_archive_date_popup_show").html("loading...");

            var form_data = {

                "old_system_mrd": $("#old_system_mrd").val(),

                "id": $("#id").val()
            }

            $.ajax({

                url: '<?php echo ADMIN_URL; ?>ajax_for_emr/old_emr_archieve_value_fetch.php?flag=3',

                dataType: 'json',

                type: 'POST',

                data: form_data,

                success: function(data) {

                    //alert(data);

                    $('#OldSystemArchieveModal').modal();

                    $("#old_archive_date_popup_show").html("");

                    $.each(data, function(index, element) {

                        //var html='<a href="javascript:void(0)" target="_blank">'+data.created_on+'</a>';

                        var html = '<label><span id="mrd"><a href="javascript:void(0)" onClick="old_pres_archieve_fetch(\'' + element.id + '\');">' + element.created_on + '</a></span>  -  <span id="mrd"><a href="<?php echo ADMIN_URL2; ?>emr/templates/admin3/printPrescription.php?id=' + element.id + '" target="_blank"><img src="<?php echo ADMIN_URL; ?>icon/printButton.png"  title="Print Prescription"></a></span>  </label><br>';

                        $("#old_archive_date_popup_show").append(html);

                    });

                }

            });

        } 
		
		
 function old_pres_archieve_fetch(p_id) {

            $('#OldSystemArchieveModal').modal('hide');

            //alert(p_id);

            var data = {

                "mrd": $("#old_system_mrd").val(),

                "id": p_id

            }

            $.ajax({

                beforeSend: function() {

                    $('.ajax-loader').css("visibility", "visible");

                },

                url: "<?php echo ADMIN_URL; ?>ajax_for_emr/old_emr_archieve_value_fetch.php?flag=2",

                type: "POST",

                dataType: 'json',

                data: data,

                success: function(data) {

                    $("#chief_complaints_history").val(data.chief_complaints_history);

                    $("#past_ocular_history").val(data.past_ocular_history);

                    $("#general_health").val(data.general_health);

                    $("#family_history").val(data.family_history);

                    $("#allergy_history").val(data.allergy_history);

                    $("#pgp_block").val(data.pgp_block);

                    $("#pgp").val(data.pgp);

                    $("#sph_od").val(data.sph_od);

                    $("#sph_add").val(data.sph_add);

                    $("#cly_od").val(data.cly_od);

                    $("#axis_od").val(data.axis_od);

                    $("#sph_os").val(data.sph_os);

                    $("#cyl_os").val(data.cyl_os);

                    $("#axis_os").val(data.axis_os);

                    $("#add_os").val(data.add_os);

                    $("#ocular_block").val(data.ocular_block);

                    $("#dv_glasses").val(data.dv_glasses);

                    $("#dv_od").val(data.dv_od);

                    $("#nv_od").val(data.nv_od);

                    $("#dv_os").val(data.dv_os);

                    $("#nv_os").val(data.nv_os);

                    $("#glass_block").val(data.glass_block);

                    $("#distance_sph_r").val(data.distance_sph_r);

                    $("#distance_cyl_r").val(data.distance_cyl_r);

                    $("#distance_axis_r").val(data.distance_axis_r);

                    $("#distance_va_r").val(data.distance_va_r);

                    $("#distance_sph_l").val(data.distance_sph_l);

                    $("#distance_cyl_l").val(data.distance_cyl_l);

                    $("#distance_axis_l").val(data.distance_axis_l);

                    $("#distance_va_l").val(data.distance_va_l);

                    $("#near_sph_r").val(data.near_sph_r);

                    $("#near_va_r").val(data.near_va_r);

                    $("#near_sph_l").val(data.near_sph_l);

                    $("#near_va_l").val(data.near_va_l);

                    $("#cover_test_select").val(data.cover_test_select);

                    $("#cover_test_text").val(data.cover_test_text);

                    $("#EOM").val(data.EOM);

                    $("#EOM_left").val(data.EOM_left);

                    $("#pupils").val(data.pupils);

                    $("#pupils_left").val(data.pupils_left);

                    $("#lid_adnexa").val(data.lid_adnexa);

                    $("#lid_adnexa_left").val(data.lid_adnexa_left);

                    $("#anterior_chamber").val(data.anterior_chamber);

                    $("#anterior_chamber_left").val(data.anterior_chamber_left);

                    $("#anterior_figure").val(data.anterior_figure);

                    $("#anterior_segment").val(data.anterior_segment);

                    $("#anterior_left_segment").val(data.anterior_left_segment);

                    $("#misc_findings").val(data.misc_findings);

                    $("#misc_findings_left").val(data.misc_findings_left);

                    $("#goneoscopy").val(data.goneoscopy);

                    $("#goneoscopy_left").val(data.goneoscopy_left);

                    $("#fundus_figure").val(data.fundus_figure);

                    $("#fundus").val(data.fundus);

                    $("#fundus_left").val(data.fundus_left);

                    $("#keratometry_block").val(data.keratometry_block);

                    $("#rk1").val(data.rk1);

                    $("#rk2").val(data.rk2);

                    $("#lk1").val(data.lk1);

                    $("#lk2").val(data.lk2);

                    $("#axial_length").val(data.axial_length);

                    $("#axial_length_left").val(data.axial_length_left);

                    $("#scotopic_pupil").val(data.scotopic_pupil);

                    $("#scotopic_pupil_left").val(data.scotopic_pupil_left);

                    $("#ww_diameter").val(data.ww_diameter);

                    $("#ww_diameter_left").val(data.ww_diameter_left);

                    $("#schirmers_test").val(data.schirmers_test);

                    $("#schirmers_test_left").val(data.schirmers_test_left);

                    $("#visual_fields").val(data.visual_fields);

                    $("#visual_fields_left").val(data.visual_fields_left);

                    $("#optical_coherence").val(data.optical_coherence);

                    $("#optical_coherence_left").val(data.optical_coherence_left);

                    $("#investigation").val(data.investigation);

                    $("#diagnostic").val(data.diagnostic);

                    $("#surgery_block").val(data.surgery_block);

                    $("#surgery").val(data.surgery);

                    $("#medication_block").val(data.medication_block);

                    $("#medication").val(data.medication);

                    $("#pre_operative_block").val(data.pre_operative_block);

                    $("#pre_operative").val(data.pre_operative);

                    $("#general_instructions").val(data.general_instructions);

                    $("#spglass_block").val(data.spglass_block);

                    $("#near_cyl_r").val(data.near_cyl_r);

                    $("#near_axis_r").val(data.near_axis_r);

                    $("#near_cyl_l").val(data.near_cyl_l);

                    $("#near_axis_l").val(data.near_axis_l);

                    $("#glass_prescription").val(data.glass_prescription);

                    $("#pinhole_od").val(data.pinhole_od);

                    $("#pinhole_os").val(data.pinhole_os);

                    $("#flash_od").val(data.flash_od);

                    $("#flash_os").val(data.flash_os);

                    $("#field_block").val(data.field_block);

                    $("#roplas_right").val(data.roplas_right);

                    $("#roplas_left").val(data.roplas_left);

                    $("#pachymetery").val(data.pachymetery);

                    $("#pachymetery_left").val(data.pachymetery_left);

                    $("#iol_power").val(data.iol_power);

                    $("#iol_power_left").val(data.iol_power_left);

                    $("#spmedication_block").val(data.spmedication_block);

                    $("#procedure_block").val(data.procedure_block);

                    $("#procedure_comments").val(data.procedure_comments);

                    $("#previous_medicine").val(data.previous_medicine);

                    $("#w_mobile").val(data.w_mobile);

                    $("#pin").val(data.pin);

                    $("#location2").val(data.location2);

                    $("#history_of_present_illness").val(data.history_of_present_illness);

                    $("#current_treatment").val(data.current_treatment);

                    $("#conjunctiva").val(data.conjunctiva);

                    $("#conjunctiva_left").val(data.conjunctiva_left);

                    $("#oct_macula").val(data.oct_macula);

                    $("#oct_macula_left").val(data.oct_macula_left);

                    $("#color_vision_isihara").val(data.color_vision_isihara);

                    $("#color_vision_isihara_left").val(data.color_vision_isihara_left);

                    $("#ot_notes_block").val(data.ot_notes_block);

                    $("#ot_notes").val(data.ot_notes);

                    $("#flash_cly_od").val(data.flash_cly_od);

                    $("#flash_axis_od").val(data.flash_axis_od);

                    $("#flash_cyl_os").val(data.flash_cyl_os);

                    $("#flash_axis_os").val(data.flash_axis_os);

                    $("#certificate").val(data.certificate);
					
					$("#dv_glasses_left").val(data.dv_glasses_left);
					
					$("#pr_left").val(data.pr_left);
					$("#pr_right").val(data.pr_right);
					$("#mb_ocular").val(data.mb_ocular);
					$("#mb_ocular_left").val(data.mb_ocular_left);
					$("#tears_outflow_system").val(data.tears_outflow_system);
					$("#tears_outflow_system_right").val(data.tears_outflow_system_right);
					$("#cornea_ocular").val(data.cornea_ocular);
					$("#cornea_ocular_left").val(data.cornea_ocular_left);
					$("#iris_ocular").val(data.iris_ocular);
					$("#iris_ocular_left").val(data.iris_ocular_left);
					$("#lens_ocular").val(data.lens_ocular);
					$("#lens_ocular_left").val(data.lens_ocular_left);
					$("#vitreous_ocular").val(data.vitreous_ocular);
					$("#vitreous_ocular_left").val(data.vitreous_ocular_left);
					$("#retina_ocular").val(data.retina_ocular);					
					$("#retina_ocular_left").val(data.retina_ocular_left);
					$("#onh_ocular").val(data.onh_ocular);
					$("#onh_ocular_left").val(data.onh_ocular_left);
					$("#remarks_pres").val(data.remarks_pres);
					$("#iridotomy_left").val(data.iridotomy_left);					
					$("#iridotomy_right").val(data.iridotomy_right);
					$("#explained_surgery_textarea").val(data.explained_surgery_textarea);
					$("#ac_ocular").val(data.ac_ocular);
					$("#ac_ocular_left").val(data.ac_ocular_left);

                },

                complete: function() {

                    $('.ajax-loader').css("visibility", "hidden");

                }

            });

        }
        
		

 </script>
<?php include "footer.php" ?>

<!-- END JAVASCRIPTS -->

</body><!-- END BODY -->

</html>