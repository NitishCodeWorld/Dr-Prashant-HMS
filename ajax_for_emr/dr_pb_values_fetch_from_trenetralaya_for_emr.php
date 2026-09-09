<?php	

include '../conn.php';

$flag=$_REQUEST["flag"];

if($flag=="1"){

	dr_pb_prescription_fetch_from_trenetralaya();

}else if($flag=="2"){

	prescription_fetch_from_trenetralaya();

}else if($flag=="3"){

	fetch_old_patient_basic_data();

}

else{

	echo "Flag  Not Selected";

}



function dr_pb_prescription_fetch_from_trenetralaya(){

	global $conn;

	$mrd=$_POST['mrd'];

	$id=$_POST['id'];

	$sql4="SELECT * FROM `prescription_details_for_emr` WHERE `mrd_no`='".$mrd."' AND `id`='".$id."' ORDER BY `id` DESC LIMIT 1 ";

				 $result4=$conn->query($sql4) ;		

				 $count=$result4->num_rows;

				 if($count>0)

				{	

					$row4 = $result4->fetch_assoc();	

					

						 $chief_complaints_history=$row4['chief_complaints_history'];

						 $past_ocular_history=$row4['past_ocular_history'];

						 $general_health=$row4['general_health'];

						 $family_history=$row4['family_history'];

						 $allergy_history=$row4['allergy_history'];

						 $pgp_block=$row4['pgp_block'];

						 $pgp=$row4['pgp'];

						 $sph_od=$row4['sph_od'];

						 $sph_add=$row4['sph_add'];

						 $cly_od=$row4['cly_od'];

						 $axis_od=$row4['axis_od'];

						 $sph_os=$row4['sph_os'];

						 $cyl_os=$row4['cyl_os'];

						 $axis_os=$row4['axis_os'];

						 $add_os=$row4['add_os'];

						 $ocular_block=$row4['ocular_block'];

						 $dv_glasses=$row4['dv_glasses'];

						 $dv_od=$row4['dv_od'];

						 $nv_od=$row4['nv_od'];

						 $dv_os=$row4['dv_os'];

						 $nv_os=$row4['nv_os'];

						 $glass_block=$row4['glass_block'];

						 $distance_sph_r=$row4['distance_sph_r'];

						 $distance_cyl_r=$row4['distance_cyl_r'];

						 $distance_axis_r=$row4['distance_axis_r'];

						 $distance_va_r=$row4['distance_va_r'];

						 $distance_sph_l=$row4['distance_sph_l'];

						 $distance_cyl_l=$row4['distance_cyl_l'];

						 $distance_axis_l=$row4['distance_axis_l'];

						 $distance_va_l=$row4['distance_va_l'];

						 $near_sph_r=$row4['near_sph_r'];

						 $near_va_r=$row4['near_va_r'];

						 $near_sph_l=$row4['near_sph_l'];

						 $near_va_l=$row4['near_va_l'];

						 $near_cyl_r=$row4['near_cyl_r'];

						 $near_axis_r=$row4['near_axis_r'];

						 $near_cyl_l=$row4['near_cyl_l'];

						 $near_axis_l=$row4['near_axis_l'];

						 $add_re_eye=$row4['add_re_eye'];

						 $add_le_eye=$row4['add_le_eye'];

						 $glass_prescription=$row4['glass_prescription'];

						 $cover_test_select=$row4['cover_test_select'];

						 $cover_test_text=$row4['cover_test_text'];

						 $EOM=$row4['EOM'];

						 $EOM_left=$row4['EOM_left'];

						 $pupils=$row4['pupils'];

						 $pupils_left=$row4['pupils_left'];

						 $lid_adnexa=$row4['lid_adnexa'];

						 $lid_adnexa_left=$row4['lid_adnexa_left'];

						 $anterior_chamber=$row4['anterior_chamber'];

						 $anterior_chamber_left=$row4['anterior_chamber_left'];

						 $anterior_figure=$row4['anterior_figure'];

						 $anterior_segment=$row4['anterior_segment'];

						 $anterior_left_segment=$row4['anterior_left_segment'];

						 $misc_findings=$row4['misc_findings'];

						 $misc_findings_left=$row4['misc_findings_left'];

						 $goneoscopy=$row4['goneoscopy'];

						 $goneoscopy_left=$row4['goneoscopy_left'];

						 $fundus_figure=$row4['fundus_figure'];

						 $fundus=$row4['fundus'];

						 $fundus_left=$row4['fundus_left'];

						 $keratometry_block=$row4['keratometry_block'];

						 $rk1=$row4['rk1'];

						 $rk2=$row4['rk2'];

						 $lk1=$row4['lk1'];

						 $lk2=$row4['lk2'];

						 $axial_length=$row4['axial_length'];

						 $axial_length_left=$row4['axial_length_left'];

						 $scotopic_pupil=$row4['scotopic_pupil'];

						 $scotopic_pupil_left=$row4['scotopic_pupil_left'];

						 $ww_diameter=$row4['ww_diameter'];

						 $ww_diameter_left=$row4['ww_diameter_left'];

						 $schirmers_test=$row4['schirmers_test'];

						 $schirmers_test_left=$row4['schirmers_test_left'];

						 $visual_fields=$row4['visual_fields'];

						 $visual_fields_left=$row4['visual_fields_left'];

						 $optical_coherence=$row4['optical_coherence'];

						 $optical_coherence_left=$row4['optical_coherence_left'];

						 $investigation='';

						 $diagnostic=$row4['diagnostic'];

						 $pinhole_od=$row4['pinhole_od'];

						 $pinhole_os=$row4['pinhole_os'];

						 $flash_od=$row4['flash_od'];

						 $flash_os=$row4['flash_os'];

						 $roplas_right=$row4['roplas_right'];

						 $roplas_left=$row4['roplas_left'];

						 $pachymetery=$row4['pachymetery'];

						 $pachymetery_left=$row4['pachymetery_left'];

						 $iol_power=$row4['iol_power'];

						 $iol_power_left=$row4['iol_power_left'];

						 $medication_block=$row4['medication_block'];

						 $medication=$row4['medication'];

						 //$medication_block=$row4['medication_block'];

						 //$medication=$row4['medication'];

						 $general_instructions=$row4['general_instructions'];

						 $surgery_block=$row4['surgery_block'];

						 $surgery=$row4['surgery'];

						 $pin=$row4['pin'];

						 $location2=$row4['location2'];

												 

						$arr=array("chief_complaints_history"=>$chief_complaints_history,"past_ocular_history"=>$past_ocular_history,"general_health"=>$general_health,"family_history"=>$family_history,"allergy_history"=>$allergy_history,"pgp_block"=>$pgp_block,"pgp"=>$pgp,"sph_od"=>$sph_od,"sph_add"=>$sph_add,"cly_od"=>$cly_od,"axis_od"=>$axis_od,"sph_os"=>$sph_os,"cyl_os"=>$cyl_os,"axis_os"=>$axis_os,"add_os"=>$add_os,"ocular_block"=>$ocular_block,"dv_glasses"=>$dv_glasses,"dv_od"=>$dv_od,"nv_od"=>$nv_od,"dv_os"=>$dv_os,"nv_os"=>$nv_os,"glass_block"=>$glass_block,"distance_sph_r"=>$distance_sph_r,"distance_cyl_r"=>$distance_cyl_r,"distance_axis_r"=>$distance_axis_r,"distance_va_r"=>$distance_va_r,"distance_sph_l"=>$distance_sph_l,"distance_cyl_l"=>$distance_cyl_l,"distance_axis_l"=>$distance_axis_l,"distance_va_l"=>$distance_va_l,"near_sph_r"=>$near_sph_r,"near_va_r"=>$near_va_r,"near_sph_l"=>$near_sph_l,"near_va_l"=>$near_va_l,"near_cyl_r"=>$near_cyl_r,"near_axis_r"=>$near_axis_r,"near_cyl_l"=>$near_cyl_l,"near_axis_l"=>$near_axis_l,"add_re_eye"=>$add_re_eye,"add_le_eye"=>$add_le_eye,"glass_prescription"=>$glass_prescription,"cover_test_select"=>$cover_test_select,"cover_test_text"=>$cover_test_text,"EOM"=>$EOM,"EOM_left"=>$EOM_left,"pupils"=>$pupils,"pupils_left"=>$pupils_left,"lid_adnexa"=>$lid_adnexa,"lid_adnexa_left"=>$lid_adnexa_left,"anterior_chamber"=>$anterior_chamber,"anterior_chamber_left"=>$anterior_chamber_left,"anterior_figure"=>$anterior_figure,"anterior_segment"=>$anterior_segment,"anterior_left_segment"=>$anterior_left_segment,"misc_findings"=>$misc_findings,"misc_findings_left"=>$misc_findings_left,"goneoscopy"=>$goneoscopy,"goneoscopy_left"=>$goneoscopy_left,"fundus_figure"=>$fundus_figure,"fundus"=>$fundus,"fundus_left"=>$fundus_left,"keratometry_block"=>$keratometry_block,"rk1"=>$rk1,"rk2"=>$rk2,"lk1"=>$lk1,"lk2"=>$lk2,"axial_length"=>$axial_length,"axial_length_left"=>$axial_length_left,"scotopic_pupil"=>$scotopic_pupil,"scotopic_pupil_left"=>$scotopic_pupil_left,"ww_diameter"=>$ww_diameter,"ww_diameter_left"=>$ww_diameter_left,"schirmers_test"=>$schirmers_test,"schirmers_test_left"=>$schirmers_test_left,"visual_fields"=>$visual_fields,"visual_fields_left"=>$visual_fields_left,"optical_coherence"=>$optical_coherence,"optical_coherence_left"=>$optical_coherence_left,"investigation"=>$investigation,"diagnostic"=>$diagnostic,"pinhole_od"=>$pinhole_od,"pinhole_os"=>$pinhole_os,"flash_od"=>$flash_od,"flash_os"=>$flash_os,"roplas_right"=>$roplas_right,"roplas_left"=>$roplas_left,"pachymetery"=>$pachymetery,"pachymetery_left"=>$pachymetery_left,"iol_power"=>$iol_power,"iol_power_left"=>$iol_power_left,"medication_block"=>$medication_block,"medication"=>$medication,"general_instructions"=>$general_instructions,"surgery_block"=>$surgery_block,"surgery"=>$surgery,"wrdoby"=>$wrdoby,"pin"=>$pin,"location2"=>$location2);

					 

				}else{

						

						$chief_complaints_history='';

						 $past_ocular_history='';

						 $general_health='';

						 $family_history='';

						 $allergy_history='';

						 $pgp_block='';

						 $pgp='';

						 $sph_od='';

						 $sph_add='';

						 $cly_od='';

						 $axis_od='';

						 $sph_os='';

						 $cyl_os='';

						 $axis_os='';

						 $add_os='';

						 $ocular_block='';

						 $dv_glasses='';

						 $dv_od='';

						 $nv_od='';

						 $dv_os='';

						 $nv_os='';

						 $glass_block='';

						 $distance_sph_r='';

						 $distance_cyl_r='';

						 $distance_axis_r='';

						 $distance_va_r='';

						 $distance_sph_l='';

						 $distance_cyl_l='';

						 $distance_axis_l='';

						 $distance_va_l='';

						 $near_sph_r='';

						 $near_va_r='';

						 $near_sph_l='';

						 $near_va_l='';

						 $near_cyl_r='';

						 $near_axis_r='';

						 $near_cyl_l='';

						 $near_axis_l='';

						 $add_re_eye='';

						 $add_le_eye='';

						 $glass_prescription='';

						 $cover_test_select='';

						 $cover_test_text='';

						 $EOM='';

						 $EOM_left='';

						 $pupils='';

						 $pupils_left='';

						 $lid_adnexa='';

						 $lid_adnexa_left='';

						 $anterior_chamber='';

						 $anterior_chamber_left='';

						 $anterior_figure='';

						 $anterior_segment='';

						 $anterior_left_segment='';

						 $misc_findings='';

						 $misc_findings_left='';

						 $goneoscopy='';

						 $goneoscopy_left='';

						 $fundus_figure='';

						 $fundus='';

						 $fundus_left='';

						 $keratometry_block='';

						 $rk1='';

						 $rk2='';

						 $lk1='';

						 $lk2='';

						 $axial_length='';

						 $axial_length_left='';

						 $scotopic_pupil='';

						 $scotopic_pupil_left='';

						 $ww_diameter='';

						 $ww_diameter_left='';

						 $schirmers_test='';

						 $schirmers_test_left='';

						 $visual_fields='';

						 $visual_fields_left='';

						 $optical_coherence='';

						 $optical_coherence_left='';

						 $investigation='';

						 $diagnostic='';

						 $pinhole_od='';

						 $pinhole_os='';

						 $flash_od='';

						 $flash_os='';

						 $roplas_right='';

						 $roplas_left='';

						 $pachymetery='';

						 $pachymetery_left='';

						 $iol_power='';

						 $iol_power_left='';

						 $medication_block='';

						 $medication='';

						 //$medication_block='';

						// $medication='';

						 $general_instructions='';

						 $surgery_block='';

						 $surgery='';

						 $pin='';

						 $location2='';

						

					$arr=array("chief_complaints_history"=>$chief_complaints_history,"past_ocular_history"=>$past_ocular_history,"general_health"=>$general_health,"family_history"=>$family_history,"allergy_history"=>$allergy_history,"pgp_block"=>$pgp_block,"pgp"=>$pgp,"sph_od"=>$sph_od,"sph_add"=>$sph_add,"cly_od"=>$cly_od,"axis_od"=>$axis_od,"sph_os"=>$sph_os,"cyl_os"=>$cyl_os,"axis_os"=>$axis_os,"add_os"=>$add_os,"ocular_block"=>$ocular_block,"dv_glasses"=>$dv_glasses,"dv_od"=>$dv_od,"nv_od"=>$nv_od,"dv_os"=>$dv_os,"nv_os"=>$nv_os,"glass_block"=>$glass_block,"distance_sph_r"=>$distance_sph_r,"distance_cyl_r"=>$distance_cyl_r,"distance_axis_r"=>$distance_axis_r,"distance_va_r"=>$distance_va_r,"distance_sph_l"=>$distance_sph_l,"distance_cyl_l"=>$distance_cyl_l,"distance_axis_l"=>$distance_axis_l,"distance_va_l"=>$distance_va_l,"near_sph_r"=>$near_sph_r,"near_va_r"=>$near_va_r,"near_sph_l"=>$near_sph_l,"near_va_l"=>$near_va_l,"near_cyl_r"=>$near_cyl_r,"near_axis_r"=>$near_axis_r,"near_cyl_l"=>$near_cyl_l,"near_axis_l"=>$near_axis_l,"add_re_eye"=>$add_re_eye,"add_le_eye"=>$add_le_eye,"glass_prescription"=>$glass_prescription,"cover_test_select"=>$cover_test_select,"cover_test_text"=>$cover_test_text,"EOM"=>$EOM,"EOM_left"=>$EOM_left,"pupils"=>$pupils,"pupils_left"=>$pupils_left,"lid_adnexa"=>$lid_adnexa,"lid_adnexa_left"=>$lid_adnexa_left,"anterior_chamber"=>$anterior_chamber,"anterior_chamber_left"=>$anterior_chamber_left,"anterior_figure"=>$anterior_figure,"anterior_segment"=>$anterior_segment,"anterior_left_segment"=>$anterior_left_segment,"misc_findings"=>$misc_findings,"misc_findings_left"=>$misc_findings_left,"goneoscopy"=>$goneoscopy,"goneoscopy_left"=>$goneoscopy_left,"fundus_figure"=>$fundus_figure,"fundus"=>$fundus,"fundus_left"=>$fundus_left,"keratometry_block"=>$keratometry_block,"rk1"=>$rk1,"rk2"=>$rk2,"lk1"=>$lk1,"lk2"=>$lk2,"axial_length"=>$axial_length,"axial_length_left"=>$axial_length_left,"scotopic_pupil"=>$scotopic_pupil,"scotopic_pupil_left"=>$scotopic_pupil_left,"ww_diameter"=>$ww_diameter,"ww_diameter_left"=>$ww_diameter_left,"schirmers_test"=>$schirmers_test,"schirmers_test_left"=>$schirmers_test_left,"visual_fields"=>$visual_fields,"visual_fields_left"=>$visual_fields_left,"optical_coherence"=>$optical_coherence,"optical_coherence_left"=>$optical_coherence_left,"investigation"=>$investigation,"diagnostic"=>$diagnostic,"pinhole_od"=>$pinhole_od,"pinhole_os"=>$pinhole_os,"flash_od"=>$flash_od,"flash_os"=>$flash_os,"roplas_right"=>$roplas_right,"roplas_left"=>$roplas_left,"pachymetery"=>$pachymetery,"pachymetery_left"=>$pachymetery_left,"iol_power"=>$iol_power,"iol_power_left"=>$iol_power_left,"medication_block"=>$medication_block,"medication"=>$medication,"general_instructions"=>$general_instructions,"surgery_block"=>$surgery_block,"surgery"=>$surgery,"wrdoby"=>$wrdoby,"pin"=>$pin,"location2"=>$location2);

					

				}

	echo json_encode($arr);   

}





function prescription_fetch_from_trenetralaya(){

	global $conn;

	$mrd=$_POST['mrd'];

	$id=$_POST['id'];

	$sql4="SELECT * FROM `prescription_details_for_emr` WHERE `mrd_no`='".$mrd."' AND `id`='".$id."' ORDER BY `id` DESC LIMIT 1 ";

				 $result4=$conn->query($sql4) ;		

				 $count=$result4->num_rows;

				 if($count>0)

				{	

					$row4 = $result4->fetch_assoc();	

					 

							 $prescription_id=$row4['id'];

							 $mrd_no=$row4['mrd_no'];

							 $slip_id=$row4['slip_id'];

							 $patient_registration_id=$row4['patient_registration_id'];

							 $primary_doctor=$row4['primary_doctor'];

							 $patient_name=$row4['fname'].' '.$row4['lname'];

							 $mobile=$row4['mobile'];

							 $age=$row4['age'];

					

						 	$chief_complaints_history=$row4['chief_complaints_history'];

						 	$past_ocular_history=$row4['past_ocular_history'];

							$general_health=$row4['general_health'];

							$family_history=$row4['family_history'];

							$allergy_history=$row4['allergy_history'];

							$pgp_block=$row4['pgp_block'];

							$pgp=$row4['pgp'];

							$sph_od=$row4['sph_od'];

							$sph_add=$row4['sph_add'];

							$cly_od=$row4['cly_od'];

							$axis_od=$row4['axis_od'];

							$sph_os=$row4['sph_os'];

							$cyl_os=$row4['cyl_os'];

							$axis_os=$row4['axis_os'];

							$add_os=$row4['add_os'];

							$ocular_block=$row4['ocular_block'];

							$dv_glasses=$row4['dv_glasses'];

							$dv_od=$row4['dv_od'];

							$nv_od=$row4['nv_od'];

							$dv_os=$row4['dv_os'];

							$nv_os=$row4['nv_os'];

							$glass_block=$row4['glass_block'];

							$distance_sph_r=$row4['distance_sph_r'];

							$distance_cyl_r=$row4['distance_cyl_r'];

							$distance_axis_r=$row4['distance_axis_r'];

							$distance_va_r=$row4['distance_va_r'];

							$distance_sph_l=$row4['distance_sph_l'];

							$distance_cyl_l=$row4['distance_cyl_l'];

							$distance_axis_l=$row4['distance_axis_l'];

							$distance_va_l=$row4['distance_va_l'];

							$near_sph_r=$row4['near_sph_r'];

							$near_va_r=$row4['near_va_r'];

							$near_sph_l=$row4['near_sph_l'];

							$near_va_l=$row4['near_va_l'];

							$cover_test_select=$row4['cover_test_select'];

							$cover_test_text=$row4['cover_test_text'];

							$EOM=$row4['EOM'];

							$EOM_left=$row4['EOM_left'];

							$pupils=$row4['pupils'];

							$pupils_left=$row4['pupils_left'];

							$lid_adnexa=$row4['lid_adnexa'];

							$lid_adnexa_left=$row4['lid_adnexa_left'];

							$anterior_chamber=$row4['anterior_chamber'];

							$anterior_chamber_left=$row4['anterior_chamber_left'];

							$anterior_figure=$row4['anterior_figure'];

							$anterior_segment=$row4['anterior_segment'];

							$anterior_left_segment=$row4['anterior_left_segment'];

							$misc_findings=$row4['misc_findings'];

							$misc_findings_left=$row4['misc_findings_left'];

							$goneoscopy=$row4['goneoscopy'];

							$goneoscopy_left=$row4['goneoscopy_left'];

							$fundus_figure=$row4['fundus_figure'];

							$fundus=$row4['fundus'];

							$fundus_left=$row4['fundus_left'];

							$keratometry_block=$row4['keratometry_block'];

							$rk1=$row4['rk1'];

							$rk2=$row4['rk2'];

							$lk1=$row4['lk1'];

							$lk2=$row4['lk2'];

							$axial_length=$row4['axial_length'];

							$axial_length_left=$row4['axial_length_left'];

							$scotopic_pupil=$row4['scotopic_pupil'];

							$scotopic_pupil_left=$row4['scotopic_pupil_left'];

							$ww_diameter=$row4['ww_diameter'];

							$ww_diameter_left=$row4['ww_diameter_left'];

							$schirmers_test=$row4['schirmers_test'];

							$schirmers_test_left=$row4['schirmers_test_left'];

							$visual_fields=$row4['visual_fields'];

							$visual_fields_left=$row4['visual_fields_left'];

							$optical_coherence=$row4['optical_coherence'];

							$optical_coherence_left=$row4['optical_coherence_left'];

							$investigation='';

							$diagnostic=$row4['diagnostic'];

							$surgery_block=$row4['surgery_block'];

							$surgery=$row4['surgery'];

							$medication_block=$row4['medication_block'];

							$medication=$row4['medication'];

							$pre_operative_block=$row4['pre_operative_block'];

							$pre_operative=$row4['pre_operative'];

							$general_instructions=$row4['general_instructions'];

							$spglass_block=$row4['spglass_block'];

							$near_cyl_r=$row4['near_cyl_r'];

							$near_axis_r=$row4['near_axis_r'];

							$near_cyl_l=$row4['near_cyl_l'];

							$near_axis_l=$row4['near_axis_l'];

							$glass_prescription=$row4['glass_prescription'];

							$pinhole_od=$row4['pinhole_od'];

							$pinhole_os=$row4['pinhole_os'];

							$flash_od=$row4['flash_od'];

							$flash_os=$row4['flash_os'];

							$field_block=$row4['field_block'];

							$roplas_right=$row4['roplas_right'];

							$roplas_left=$row4['roplas_left'];

							$pachymetery=$row4['pachymetery'];

							$pachymetery_left=$row4['pachymetery_left'];

							$iol_power=$row4['iol_power'];

							$iol_power_left=$row4['iol_power_left'];

							$spmedication_block=$row4['spmedication_block'];

							$procedure_block=$row4['procedure_block'];

							$procedure_comments=$row4['procedure_comments'];

							$previous_medicine=$row4['previous_medicine'];

							$w_mobile=$row4['w_mobile'];

							$pin=$row4['pin'];

							$location2=$row4['location2'];

							$history_of_present_illness=$row4['history_of_present_illness'];

							$current_treatment=$row4['current_treatment'];

							$conjunctiva=$row4['conjunctiva'];

							$conjunctiva_left=$row4['conjunctiva_left'];

							$oct_macula=$row4['oct_macula'];

							$oct_macula_left=$row4['oct_macula_left'];

							$color_vision_isihara=$row4['color_vision_isihara'];

							$color_vision_isihara_left=$row4['color_vision_isihara_left'];

							$ot_notes_block=$row4['ot_notes_block'];

							$ot_notes=$row4['ot_notes'];

							$flash_cly_od=$row4['flash_cly_od'];

							$flash_axis_od=$row4['flash_axis_od'];

							$flash_cyl_os=$row4['flash_cyl_os'];

							$flash_axis_os=$row4['flash_axis_os'];

							$table_structure_block=$row4['table_structure_block'];

							$certificate=$row4['certificate'];

							$medical_doctor=$row4['medical_doctor'];
							
							$pr_left=$row4['pr_left'];
						 	$pr_right=$row4['pr_right'];
							$mb_ocular=$row4['mb_ocular'];
						 	$mb_ocular_left=$row4['mb_ocular_left'];
							$tears_outflow_system=$row4['tears_outflow_system'];
						 	$tears_outflow_system_right=$row4['tears_outflow_system_right'];
							
							$cornea_ocular=$row4['cornea_ocular'];
							$cornea_ocular_left=$row4['cornea_ocular_left'];	
							$iris_ocular=$row4['iris_ocular'];	
							$iris_ocular_left=$row4['iris_ocular_left'];	
							$lens_ocular=$row4['lens_ocular'];
							$lens_ocular_left=$row4['lens_ocular_left'];	
							$vitreous_ocular=$row4['vitreous_ocular'];	
							$vitreous_ocular_left=$row4['vitreous_ocular_left'];	
							$retina_ocular=$row4['retina_ocular'];
							$retina_ocular_left=$row4['retina_ocular_left'];	
							$onh_ocular=$row4['onh_ocular'];	
							$onh_ocular_left=$row4['onh_ocular_left'];	
							$remarks_pres=$row4['remarks_pres'];
							$iridotomy_left=$row4['iridotomy_left'];
							$iridotomy_right=$row4['iridotomy_right'];
							$explained_surgery_textarea=$row4['explained_surgery_textarea'];	
							$ac_ocular=$row4['ac_ocular'];
							$ac_ocular_left=$row4['ac_ocular_left'];	
												 

						$arr=array("chief_complaints_history"=>$chief_complaints_history,"past_ocular_history"=>$past_ocular_history,"general_health"=>$general_health,"family_history"=>$family_history,"allergy_history"=>$allergy_history,"pgp_block"=>$pgp_block,"pgp"=>$pgp,"sph_od"=>$sph_od,"sph_add"=>$sph_add,"cly_od"=>$cly_od,"axis_od"=>$axis_od,"sph_os"=>$sph_os,"cyl_os"=>$cyl_os,"axis_os"=>$axis_os,"add_os"=>$add_os,"ocular_block"=>$ocular_block,"dv_glasses"=>$dv_glasses,"dv_od"=>$dv_od,"nv_od"=>$nv_od,"dv_os"=>$dv_os,"nv_os"=>$nv_os,"glass_block"=>$glass_block,"distance_sph_r"=>$distance_sph_r,"distance_cyl_r"=>$distance_cyl_r,"distance_axis_r"=>$distance_axis_r,"distance_va_r"=>$distance_va_r,"distance_sph_l"=>$distance_sph_l,"distance_cyl_l"=>$distance_cyl_l,"distance_axis_l"=>$distance_axis_l,"distance_va_l"=>$distance_va_l,"near_sph_r"=>$near_sph_r,"near_va_r"=>$near_va_r,"near_sph_l"=>$near_sph_l,"near_va_l"=>$near_va_l,"cover_test_select"=>$cover_test_select,"cover_test_text"=>$cover_test_text,"EOM"=>$EOM,"EOM_left"=>$EOM_left,"pupils"=>$pupils,"pupils_left"=>$pupils_left,"lid_adnexa"=>$lid_adnexa,"lid_adnexa_left"=>$lid_adnexa_left,"anterior_chamber"=>$anterior_chamber,"anterior_chamber_left"=>$anterior_chamber_left,"anterior_figure"=>$anterior_figure,"anterior_segment"=>$anterior_segment,"anterior_left_segment"=>$anterior_left_segment,"misc_findings"=>$misc_findings,"misc_findings_left"=>$misc_findings_left,"goneoscopy"=>$goneoscopy,"goneoscopy_left"=>$goneoscopy_left,"fundus_figure"=>$fundus_figure,"fundus"=>$fundus,"fundus_left"=>$fundus_left,"keratometry_block"=>$keratometry_block,"rk1"=>$rk1,"rk2"=>$rk2,"lk1"=>$lk1,"lk2"=>$lk2,"axial_length"=>$axial_length,"axial_length_left"=>$axial_length_left,"scotopic_pupil"=>$scotopic_pupil,"scotopic_pupil_left"=>$scotopic_pupil_left,"ww_diameter"=>$ww_diameter,"ww_diameter_left"=>$ww_diameter_left,"schirmers_test"=>$schirmers_test,"schirmers_test_left"=>$schirmers_test_left,"visual_fields"=>$visual_fields,"visual_fields_left"=>$visual_fields_left,"optical_coherence"=>$optical_coherence,"optical_coherence_left"=>$optical_coherence_left,"investigation"=>$investigation,"diagnostic"=>$diagnostic,"surgery_block"=>$surgery_block,"surgery"=>$surgery,"medication_block"=>$medication_block,"medication"=>$medication,"pre_operative_block"=>$pre_operative_block,"pre_operative"=>$pre_operative,"general_instructions"=>$general_instructions,"spglass_block"=>$spglass_block,"near_cyl_r"=>$near_cyl_r,"near_axis_r"=>$near_axis_r,"near_cyl_l"=>$near_cyl_l,"near_axis_l"=>$near_axis_l,"glass_prescription"=>$glass_prescription,"pinhole_od"=>$pinhole_od,"pinhole_os"=>$pinhole_os,"flash_od"=>$flash_od,"flash_os"=>$flash_os,"field_block"=>$field_block,"roplas_right"=>$roplas_right,"roplas_left"=>$roplas_left,"pachymetery"=>$pachymetery,"pachymetery_left"=>$pachymetery_left,"iol_power"=>$iol_power,"iol_power_left"=>$iol_power_left,"spmedication_block"=>$spmedication_block,"procedure_block"=>$procedure_block,"procedure_comments"=>$procedure_comments,"previous_medicine"=>$previous_medicine,"w_mobile"=>$w_mobile,"pin"=>$pin,"location2"=>$location2,"history_of_present_illness"=>$history_of_present_illness,"current_treatment"=>$current_treatment,"conjunctiva"=>$conjunctiva,"conjunctiva_left"=>$conjunctiva_left,"oct_macula"=>$oct_macula,"oct_macula_left"=>$oct_macula_left,"color_vision_isihara"=>$color_vision_isihara,"color_vision_isihara_left"=>$color_vision_isihara_left,"ot_notes_block"=>$ot_notes_block,"ot_notes"=>$ot_notes,"flash_cly_od"=>$flash_cly_od,"flash_axis_od"=>$flash_axis_od,"flash_cyl_os"=>$flash_cyl_os,"flash_axis_os"=>$flash_axis_os,"table_structure_block"=>$table_structure_block,"certificate"=>$certificate,"medical_doctor"=>$medical_doctor,"prescription_id"=>$prescription_id,"mrd_no"=>$mrd_no,"slip_id"=>$slip_id,"patient_registration_id"=>$patient_registration_id,"primary_doctor"=>$primary_doctor,"patient_name"=>$patient_name,"mobile"=>$mobile,"age"=>$age,"pr_right"=>$pr_right,"pr_left"=>$pr_left,"mb_ocular"=>$mb_ocular,"mb_ocular_left"=>$mb_ocular_left,"tears_outflow_system"=>$tears_outflow_system,"tears_outflow_system_right"=>$tears_outflow_system_right,"cornea_ocular"=>$cornea_ocular,"cornea_ocular_left"=>$cornea_ocular_left,"iris_ocular"=>$iris_ocular,"iris_ocular_left"=>$iris_ocular_left,"lens_ocular"=>$lens_ocular,"lens_ocular_left"=>$lens_ocular_left,"vitreous_ocular"=>$vitreous_ocular,"vitreous_ocular_left"=>$vitreous_ocular_left,"retina_ocular"=>$retina_ocular,"retina_ocular_left"=>$retina_ocular_left,"onh_ocular"=>$onh_ocular,"onh_ocular_left"=>$onh_ocular_left,"remarks_pres"=>$remarks_pres,"iridotomy_left"=>$iridotomy_left,"iridotomy_right"=>$iridotomy_right,"explained_surgery_textarea"=>$explained_surgery_textarea,"ac_ocular"=>$ac_ocular,"ac_ocular_left"=>$ac_ocular_left);

					

					 

				}else{

						

					$chief_complaints_history='';	

					$past_ocular_history='';

					$general_health='';

					$family_history='';

					$allergy_history='';

					$pgp_block='';

					$pgp='';

					$sph_od='';

					$sph_add='';

					$cly_od='';

					$axis_od='';

					$sph_os='';

					$cyl_os='';

					$axis_os='';

					$add_os='';

					$ocular_block='';

					$dv_glasses='';

					$dv_od='';

					$nv_od='';

					$dv_os='';

					$nv_os='';

					$glass_block='';

					$distance_sph_r='';

					$distance_cyl_r='';

					$distance_axis_r='';

					$distance_va_r='';

					$distance_sph_l='';

					$distance_cyl_l='';

					$distance_axis_l='';

					$distance_va_l='';

					$near_sph_r='';

					$near_va_r='';

					$near_sph_l='';

					$near_va_l='';

					$cover_test_select='';

					$cover_test_text='';

					$EOM='';

					$EOM_left='';

					$pupils='';

					$pupils_left='';

					$lid_adnexa='';

					$lid_adnexa_left='';

					$anterior_chamber='';

					$anterior_chamber_left='';

					$anterior_figure='';

					$anterior_segment='';

					$anterior_left_segment='';

					$misc_findings='';

					$misc_findings_left='';

					$goneoscopy='';

					$goneoscopy_left='';

					$fundus_figure='';

					$fundus='';

					$fundus_left='';

					$keratometry_block='';

					$rk1='';

					$rk2='';

					$lk1='';

					$lk2='';

					$axial_length='';

					$axial_length_left='';

					$scotopic_pupil='';

					$scotopic_pupil_left='';

					$ww_diameter='';

					$ww_diameter_left='';

					$schirmers_test='';

					$schirmers_test_left='';

					$visual_fields='';

					$visual_fields_left='';

					$optical_coherence='';

					$optical_coherence_left='';

					$investigation='';

					$diagnostic='';

					$surgery_block='';

					$surgery='';

					$medication_block='';

					$medication='';

					$pre_operative_block='';

					$pre_operative='';

					$general_instructions='';

					$spglass_block='';

					$near_cyl_r='';

					$near_axis_r='';

					$near_cyl_l='';

					$near_axis_l='';

					$glass_prescription='';

					$pinhole_od='';

					$pinhole_os='';

					$flash_od='';

					$flash_os='';

					$field_block='';

					$roplas_right='';

					$roplas_left='';

					$pachymetery='';

					$pachymetery_left='';

					$iol_power='';

					$iol_power_left='';

					$spmedication_block='';

					$procedure_block='';

					$procedure_comments='';

					$previous_medicine='';

					$w_mobile='';

					$pin='';

					$location2='';

					$history_of_present_illness='';

					$current_treatment='';

					$conjunctiva='';

					$conjunctiva_left='';

					$oct_macula='';

					$oct_macula_left='';

					$color_vision_isihara='';

					$color_vision_isihara_left='';

					$ot_notes_block='';

					$ot_notes='';

					$flash_cly_od='';

					$flash_axis_od='';

					$flash_cyl_os='';

					$flash_axis_os='';

					$table_structure_block='';

					$certificate='';

					$medical_doctor='';

					 $prescription_id='';

					 $mrd_no='';

					 $slip_id='';

					 $patient_registration_id='';

					 $primary_doctor='';

					 $patient_name='';

					 $mobile='';

					 $age='';

					$pr_left='';
					$pr_right='';	 

					$mb_ocular='';
					$mb_ocular_left='';	
					$tears_outflow_system='';	
					$tears_outflow_system_right='';	
					
					$cornea_ocular='';
					$cornea_ocular_left='';	
					$iris_ocular='';	
					$iris_ocular_left='';	
					$lens_ocular='';
					$lens_ocular_left='';	
					$vitreous_ocular='';	
					$vitreous_ocular_left='';	
					$retina_ocular='';
					$retina_ocular_left='';	
					$onh_ocular='';	
					$onh_ocular_left='';	
					$remarks_pres='';
					$iridotomy_left='';
					$iridotomy_right='';
					$explained_surgery_textarea='';
					$ac_ocular='';
					$ac_ocular_left='';	

					$arr=array("chief_complaints_history"=>$chief_complaints_history,"past_ocular_history"=>$past_ocular_history,"general_health"=>$general_health,"family_history"=>$family_history,"allergy_history"=>$allergy_history,"pgp_block"=>$pgp_block,"pgp"=>$pgp,"sph_od"=>$sph_od,"sph_add"=>$sph_add,"cly_od"=>$cly_od,"axis_od"=>$axis_od,"sph_os"=>$sph_os,"cyl_os"=>$cyl_os,"axis_os"=>$axis_os,"add_os"=>$add_os,"ocular_block"=>$ocular_block,"dv_glasses"=>$dv_glasses,"dv_od"=>$dv_od,"nv_od"=>$nv_od,"dv_os"=>$dv_os,"nv_os"=>$nv_os,"glass_block"=>$glass_block,"distance_sph_r"=>$distance_sph_r,"distance_cyl_r"=>$distance_cyl_r,"distance_axis_r"=>$distance_axis_r,"distance_va_r"=>$distance_va_r,"distance_sph_l"=>$distance_sph_l,"distance_cyl_l"=>$distance_cyl_l,"distance_axis_l"=>$distance_axis_l,"distance_va_l"=>$distance_va_l,"near_sph_r"=>$near_sph_r,"near_va_r"=>$near_va_r,"near_sph_l"=>$near_sph_l,"near_va_l"=>$near_va_l,"cover_test_select"=>$cover_test_select,"cover_test_text"=>$cover_test_text,"EOM"=>$EOM,"EOM_left"=>$EOM_left,"pupils"=>$pupils,"pupils_left"=>$pupils_left,"lid_adnexa"=>$lid_adnexa,"lid_adnexa_left"=>$lid_adnexa_left,"anterior_chamber"=>$anterior_chamber,"anterior_chamber_left"=>$anterior_chamber_left,"anterior_figure"=>$anterior_figure,"anterior_segment"=>$anterior_segment,"anterior_left_segment"=>$anterior_left_segment,"misc_findings"=>$misc_findings,"misc_findings_left"=>$misc_findings_left,"goneoscopy"=>$goneoscopy,"goneoscopy_left"=>$goneoscopy_left,"fundus_figure"=>$fundus_figure,"fundus"=>$fundus,"fundus_left"=>$fundus_left,"keratometry_block"=>$keratometry_block,"rk1"=>$rk1,"rk2"=>$rk2,"lk1"=>$lk1,"lk2"=>$lk2,"axial_length"=>$axial_length,"axial_length_left"=>$axial_length_left,"scotopic_pupil"=>$scotopic_pupil,"scotopic_pupil_left"=>$scotopic_pupil_left,"ww_diameter"=>$ww_diameter,"ww_diameter_left"=>$ww_diameter_left,"schirmers_test"=>$schirmers_test,"schirmers_test_left"=>$schirmers_test_left,"visual_fields"=>$visual_fields,"visual_fields_left"=>$visual_fields_left,"optical_coherence"=>$optical_coherence,"optical_coherence_left"=>$optical_coherence_left,"investigation"=>$investigation,"diagnostic"=>$diagnostic,"surgery_block"=>$surgery_block,"surgery"=>$surgery,"medication_block"=>$medication_block,"medication"=>$visual_fields,"pre_operative_block"=>$pre_operative_block,"pre_operative"=>$pre_operative,"general_instructions"=>$general_instructions,"spglass_block"=>$spglass_block,"near_cyl_r"=>$near_cyl_r,"near_axis_r"=>$near_axis_r,"near_cyl_l"=>$near_cyl_l,"near_axis_l"=>$near_axis_l,"glass_prescription"=>$glass_prescription,"pinhole_od"=>$pinhole_od,"pinhole_os"=>$pinhole_os,"flash_od"=>$flash_od,"flash_os"=>$flash_os,"field_block"=>$field_block,"roplas_right"=>$roplas_right,"roplas_left"=>$roplas_left,"pachymetery"=>$pachymetery,"pachymetery_left"=>$pachymetery_left,"iol_power"=>$iol_power,"iol_power_left"=>$iol_power_left,"spmedication_block"=>$spmedication_block,"procedure_block"=>$procedure_block,"procedure_comments"=>$procedure_comments,"previous_medicine"=>$previous_medicine,"w_mobile"=>$w_mobile,"pin"=>$pin,"location2"=>$location2,"history_of_present_illness"=>$history_of_present_illness,"current_treatment"=>$current_treatment,"conjunctiva"=>$conjunctiva,"conjunctiva_left"=>$conjunctiva_left,"oct_macula"=>$oct_macula,"oct_macula_left"=>$oct_macula_left,"color_vision_isihara"=>$color_vision_isihara,"color_vision_isihara_left"=>$color_vision_isihara_left,"ot_notes_block"=>$ot_notes_block,"ot_notes"=>$ot_notes,"flash_cly_od"=>$flash_cly_od,"flash_axis_od"=>$flash_axis_od,"flash_cyl_os"=>$flash_cyl_os,"flash_axis_os"=>$flash_axis_os,"table_structure_block"=>$table_structure_block,"certificate"=>$certificate,"medical_doctor"=>$medical_doctor,"prescription_id"=>$prescription_id,"mrd_no"=>$mrd_no,"slip_id"=>$slip_id,"patient_registration_id"=>$patient_registration_id,"primary_doctor"=>$primary_doctor,"patient_name"=>$patient_name,"mobile"=>$mobile,"age"=>$age,"pr_right"=>$pr_right,"pr_left"=>$pr_left,"mb_ocular"=>$mb_ocular,"mb_ocular_left"=>$mb_ocular_left,"tears_outflow_system"=>$tears_outflow_system,"tears_outflow_system_right"=>$tears_outflow_system_right,"cornea_ocular"=>$cornea_ocular,"cornea_ocular_left"=>$cornea_ocular_left,"iris_ocular"=>$iris_ocular,"iris_ocular_left"=>$iris_ocular_left,"lens_ocular"=>$lens_ocular,"lens_ocular_left"=>$lens_ocular_left,"vitreous_ocular"=>$vitreous_ocular,"vitreous_ocular_left"=>$vitreous_ocular_left,"retina_ocular"=>$retina_ocular,"retina_ocular_left"=>$retina_ocular_left,"onh_ocular"=>$onh_ocular,"onh_ocular_left"=>$onh_ocular_left,"remarks_pres"=>$remarks_pres,"iridotomy_left"=>$iridotomy_left,"iridotomy_right"=>$iridotomy_right,"explained_surgery_textarea"=>$explained_surgery_textarea,"ac_ocular"=>$ac_ocular,"ac_ocular_left"=>$ac_ocular_left);
					

					

				}

	echo json_encode($arr);   

}



function fetch_old_patient_basic_data(){

			global $conn;

			$mrd=$_POST['mrd'];

			$id=$_POST['id'];

			

			$sql="SELECT * FROM `prescription_details_for_emr` WHERE `mrd_no`='".$mrd."' ORDER BY `id` DESC";

			$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			while($row=mysqli_fetch_assoc($res)){

				extract($row);

				$arr[]=array("id"=>$id,"created_on"=> date('d-m-Y',strtotime($created_on)));

			}

		echo json_encode($arr);

	}

?>

