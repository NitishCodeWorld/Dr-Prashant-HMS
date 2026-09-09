Note
===========================
Add Page 
============================
1)discharge_summary_from.php
2)medications_template_masters_for_emr
3)ajax/medications_template_masters_ajax_for_emr
4)discharge_summary_from_edit
5)discharge_dashboadrd.php
6)estimation_form_billing.php
7)estimation_form_billing_edit.php
8)estimation_form_billing_print.php
9)get_json_data_for_appr_reports.php



Change PAge:
===========
1)follow_up_fetch_ajax.php
2)view_registration_form.php
3)ajax/old_db_ajax.php
4)get_json_data_for_ipd_details.php
5)dashboard_for_appt.php
5)view_registration_form.php

Add DB Table:
===========
1)disease_template_masters_for_emr
2)patient_discharge_diagnoses_details_table
3)patient_discharge_anaesthetst_assistent_details
4)patient_discharge_post_up_chkup_details
5)patient_discharge_summary
6)estimation_form_details
7)estimation_purpose_details




================================================================
Next Working
================================================================
11) Glass prescription tick wise report
19) Diagnosis Wise Report
20) Surgery Advise Report
23) Estimation Form ( add , delete, print) [https://www.omeyecarekolkata.com/sunetra_hms_test/adavnce_final_billing.php?opd_flag=1&uhid_no=66666]as it is this url upper side
24) post op review date, final post review date ( discharge summery ) report shown in appt dashboard and reg dashboard ( Model open remarks)
25) Next visit patient report ( Like T basu)

15) Cancel report (Advance, Advance refund, OPD , IPD)




////////////////////////////////
Advance:  (OPD ->  opd_flag=1    ; IPD -> opd_flag=0 )  ( status=3 -> cancel

billing_date,billing_time,reason,deleted_by, deleted_time

adavnce_final_billing
adavnce_final_payment_billing	
adavnce_final_procedure

invoice_final_billing
invoice_final_payment_billing
invoice_final_procedure

from date , to date , All/opd/ipd

Hospiatal No, Invoice No, PAtient Details(Phone), Doc Name, Bill date time, Cancel date time , Bill details(bill by, cancel By, cancel reason),Pay Mode, Total Amount


Grand Totals

