<?php
    require_once("../includes/initialize.php");    
	require_once("../includes/class.phpmailer.php");
    session_start();
    $jsonarray = array();
    $skip_op_l = 0;
    $company_id = "";
    $loggedin_userid = mysqli_real_escape_string($con, $_COOKIE["USER_ID"]);
    
    $sql_get_company_id = "SELECT id FROM company_basic WHERE user_id = '".$loggedin_userid."'";
    $result_get_company_id = mysqli_query($con, $sql_get_company_id);
    
    if($result_get_company_id && $myrow_get_company_id = mysqli_fetch_array($result_get_company_id))
    {
        $company_id = $myrow_get_company_id['id'];
    }    
    

    $form_step =  mysqli_real_escape_string($con, $_POST["form_step"]);
    
    if($form_step == 1)
    {
        $company_type = mysqli_real_escape_string($con, $_POST["company_type"]);
        $company_subtype = $_POST["company_subtype"];
        $company_subtype_cnt = count($company_subtype);

        if($company_type == "")
        {
            $error = 1;
            $error_msg = "Please select company type";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }
        $skip_op_l = $_SESSION['skip_op_l'] = ($company_type==8 || $company_type==9 || $company_type==10)? 1:2;
		// print_r($_SESSION);
        $sql_get_individual_type_id = "SELECT id FROM company_type WHERE codename = 'individual'";
        $result_get_individual_type_id = mysqli_query($con, $sql_get_individual_type_id);
        
        if($result_get_individual_type_id && $myrow_get_individual_type_id = mysqli_fetch_array($result_get_individual_type_id))
        {
            $individual_type_id = $myrow_get_individual_type_id['id'];
        }
        
        if($company_type == $individual_type_id)
        {
            $error = 2;
            $error_msg = "Individual User Login";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }
                
        
        $sql = "START TRANSACTION";
        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Something went wrong while starting transaction. Please try again later.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }
        
        if(isset($company_id) && $company_id != "")
        {            
            $sql_company_operation = "  UPDATE company_basic
                                        SET company_type = '".$company_type."',status = 'approved', modifiedon = NOW()
                                        WHERE id = '".$company_id."'";
            
            if(mysqli_affected_rows($con) > 0)
            {
                mysqli_query($con, "ROLLBACK");
                $error = 1;
                $error_msg = "Something went while updating company details.";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                echo json_encode($jsonarray);
                exit;  
            }
            
            if(isset($_POST["company_subtype"]))
            {
                $sql_delete = "DELETE FROM company_subtype_rel WHERE company_id = '".$company_id."'";
                $result_delete = mysqli_query($con, $sql_delete);
            }
            
        }
        else 
        {
            
            $sql_new_company = "INSERT INTO company_basic(company_type, user_id, active, profile_completed, status)     
                                VALUES('".$company_type."', '".$loggedin_userid."',1 , 1, 'approved')";
            $result_new_company = mysqli_query($con, $sql_new_company);
            //echo $sql_new_company; exit;
            if(mysqli_affected_rows($con) <= 0)
            {
                mysqli_query($con, "ROLLBACK");
                $error = 1;
                $error_msg = "Something went wrong while inserting company";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                echo json_encode($jsonarray);
                exit;  
            }    
            else 
            {
                $company_id = mysqli_insert_id($con);  
            }
        }
        
        for($x=0; $x<$company_subtype_cnt; $x++)
        {
            $company_subtype_id = mysqli_real_escape_string($con, $company_subtype[$x]);

            $sql_insert_cst = "INSERT INTO company_subtype_rel(company_id, company_type_id)
                              VALUES('".$company_id."', '".$company_subtype_id."')";
            $result_insert_cst = mysqli_query($con, $sql_insert_cst);
            if(mysqli_affected_rows($con)<=0)
            {
                mysqli_query($con, "ROLLBACK");
                $error = 1;
                $error_msg = "Something went while adding company sub type";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                echo json_encode($jsonarray);
                exit;
            }
        }
        
        
        $sql = "COMMIT";
        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Something went wrong while commiting transaction. Please try again later.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }
        else
        {
            $error = 0;
            $error_msg = "";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }
    }
    else if($form_step == 2)
    {
        $name = mysqli_real_escape_string($con, $_POST["company_name"]);
        $contact_person = mysqli_real_escape_string($con, $_POST["owner_name"]);        
        $estd_year = mysqli_real_escape_string($con, $_POST["est_year"]);
        $mobile_no = mysqli_real_escape_string($con, $_POST["mobile_no"]);
        $email_addr = mysqli_real_escape_string($con, $_POST["email_addr"]);
        $company_address = mysqli_real_escape_string($con, $_POST["company_address"]);
        $company_turn_over = mysqli_real_escape_string($con, $_POST["compnay_turn_over"]);         $company_turn_over_qty = mysqli_real_escape_string($con, $_POST["turnover_qty"]);
		if(isset($_POST["contact_person_email"]))
		{
			$contact_person_email = mysqli_real_escape_string($con, $_POST["contact_person_email"]);
			$to = $contact_person_email;
			 $email_subject = "".SITE_NAME."";

    $mailbody = "Please click the below link to register as a second user:<br/><br/>";
    
    $mailbody .= "  Thanks ,<br/>
                    Regards <br/>                 
                   <strong>Team".SITE_NAME."</strong>";

    $reply_address = CONTACTUS_REPLY_ADD;
    $reply_person_name = CONTACTUS_REPLY_NAME;
    $from_address = CONTACTUS_FROM_ADD;
    $from_name = CONTACTUS_FROM_NAME;
    $alt_body = "To view the message, please use an HTML compatible email viewer!";

    $mail = new PHPMailer(); // defaults to using php "mail()"

    if(USE_SMTP_SERVER==1)
    {
        $mail->IsSMTP(); // telling the class to use SMTP
        // 1 = errors and messages
        // 2 = messages only
        $mail->SMTPDebug  = SMTP_DEBUGGING;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Host       = SMTP_HOST; // sets the SMTP server
        $mail->Port       = SMTP_HOST_PORT;                    // set the SMTP port for the GMAIL server
        $mail->Username   = SMTP_HOST_USERNAME; // SMTP account agent_username
        $mail->Password   = SMTP_HOST_PASSWORD;        // SMTP account password                
    }                

    $body = $mailbody;
    $mail->SetFrom($from_address, $from_name);
    $mail->AddReplyTo($reply_address,$reply_person_name);

    $mail->AddAddress(ADMIN_EMAIL_ADDRESS);
    

    $mail->Subject = $email_subject;
    $mail->AltBody = $alt_body; // optional, comment out and test
    $mail->MsgHTML($body);
    if(!$mail->Send())
    {       
        $error = 1;
        $error_msg = "Something Went Wrong While Sending a Enquiry, Please Try again later !!!";
        $jsonarray["code"] = $error;
        $jsonarray["msg"] = $error_msg;
        echo json_encode($jsonarray);
        exit;
    }
    else
    {
		$error_msg = "success";
    }

		}
		else
		{
			$contact_person_email = "";
		}
		
        /*if($name == "" || $contact_person == "" || $estd_year == ""  ||  $company_turn_over == "" ||
             $email_addr == "" )*/
        if($name == "" || $contact_person == "" || $estd_year == "" ||
             $email_addr == "" || $company_address == "" )
        {
            $error = 1;
            $error_msg = "Please fill mandatory field.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }
        
        if(!is_numeric($mobile_no))
        {
            $error = 1;
            $error_msg = "Enter mobile number in numeric.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }
		if(strlen($mobile_no)!=10 ){
            $error = 1;
            $error_msg = "Enter valid mobile number ";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
		}

        $sql = "START TRANSACTION";
        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Something went wrong while starting transaction. Please try again later.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }


        $sql = "SELECT id FROM company_basic WHERE phone_no = '".$mobile_no."' AND user_id != '".$loggedin_userid."'";
        $result = mysqli_query($con, $sql);

        if($result && $myrow = mysqli_fetch_array($result))
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Phone number already exists";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;  
        }

        $sql = "SELECT id FROM company_basic WHERE email_addr = '".$email_addr."' AND user_id != '".$loggedin_userid."'";
        $result = mysqli_query($con, $sql);

        if($result && $myrow = mysqli_fetch_array($result))
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Email Address already exists";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;  
        }
		/*$add_new_user = "INSERT INTO company_person (name,designation,contact,office_contact,email,company_id) VALUES ('".$contact_person_new."', '".$designation."','".$contact_number."','".$office_number."','".$contact_person_email."','".$company_id."')";
	
		$add_new_user_operation = mysqli_query($con, $add_new_user);*/
        
        $sql_company_operation = "  UPDATE company_basic
                                    SET name = '".$name."', contact_person = '".$contact_person."', estd_year = '".$estd_year."', 
                                        phone_no = '".$mobile_no."', email_addr = '".$email_addr."', company_turn_over='".$company_turn_over."',address ='".$company_address."' , profile_completed = 2 , turnover_qty = '".$company_turn_over_qty."', modifiedon = NOW()
                                    WHERE id = '".$company_id."'";
        
        $result_company_operation = mysqli_query($con, $sql_company_operation);   
		
		
		
        if(mysqli_affected_rows($con) <= 0)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Something went while updating company details.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;  
        }
        else 
        {   
            $sql_active_account = " UPDATE user 
                                SET active = 1, reset_code = NULL,  modifiedon = NOW() 
                                WHERE id = '".$loggedin_userid."'";
        
            $result_active_account = mysqli_query($con, $sql_active_account);
            if(mysqli_affected_rows($con) <= 0)
            {
                mysqli_query($con, "ROLLBACK");
                $error = 1;
                $error_msg = "Something went while updating company details.";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                echo json_encode($jsonarray);
                exit;  
                
            }
            else
            {

                $sql = "COMMIT";
                $result = mysqli_query($con, $sql);
                if(!$result)
                {
                    mysqli_query($con, "ROLLBACK");
                    $error = 1;
                    $error_msg = "Something went wrong while commiting transaction. Please try again later.";
                    $jsonarray["code"] = $error;
                    $jsonarray["msg"] = $error_msg;
                    echo json_encode($jsonarray);
                    exit;
                }
                else
                {
                    $error = 0;
                    $error_msg = "";
                    $jsonarray["code"] = $error;
                    $jsonarray["msg"] = $error_msg;
					if(($_SESSION['skip_op_l'])==1){
						$jsonarray["skip_last"] = 1;
					}
                    echo json_encode($jsonarray);
                    exit;
                }
            } 
        }
            
        
        
        
    }
    else if($form_step == 3)
    {
        $sql = "START TRANSACTION";
        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Something went wrong while starting transaction. Please try again later.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }

        $area_of_operation = $_POST["area_of_operation"];
        $area_of_operation_cnt = count($area_of_operation);
        
        if($area_of_operation_cnt < 0)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Please select Area of operation";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit; 
        }
        
        $sql_delete = "DELETE FROM area_of_operation WHERE company_id = '".$company_id."'";
        $result_delete = mysqli_query($con, $sql_delete);
        
        for($x=0; $x<$area_of_operation_cnt; $x++)
        {
            $area_of_operation_id = mysqli_real_escape_string($con, $area_of_operation[$x]);

            $sql_insert_aop = "INSERT INTO area_of_operation(company_id, city_id)
                              VALUES('".$company_id."', '".$area_of_operation_id."')";
            $result_insert_cst = mysqli_query($con, $sql_insert_aop);
            if(mysqli_affected_rows($con)<=0)
            {
                mysqli_query($con, "ROLLBACK");
                $error = 1;
                $error_msg = "Something went while adding area of operation";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                echo json_encode($jsonarray);
                exit;
            }
        }

        $sql_company_operation = "  UPDATE company_basic
                                    SET profile_completed = 3, modifiedon = NOW()
                                    WHERE id = '".$company_id."'";
        
        $result_company_operation = mysqli_query($con, $sql_company_operation);    
        if(mysqli_affected_rows($con) <= 0)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Something went while updating company details.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;  
        }
        else 
        {

        $sql = "COMMIT";
            $result = mysqli_query($con, $sql);
            if(!$result)
            {
                mysqli_query($con, "ROLLBACK");
                $error = 1;
                $error_msg = "Something went wrong while commiting transaction. Please try again later.";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                echo json_encode($jsonarray);
                exit;
            }
            else
            {
                $error = 0;
                $error_msg = "";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                echo json_encode($jsonarray);
                exit;
            }
        }
        
    }
    else if($form_step == 4)
    {
        $sql = "START TRANSACTION";
        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Something went wrong while starting transaction. Please try again later.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }

        $work_type = $_POST["company_work_type"];
        $work_type_cnt = count($work_type);
        if($work_type_cnt <= 0)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Please select Work Type";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit; 
        }
        
        $sql_delete = "DELETE FROM company_work_type_rel WHERE company_id = '".$company_id."'";
        $result_delete = mysqli_query($con, $sql_delete);
        
        for($x=0; $x<$work_type_cnt; $x++)
        {
            $work_type_id = mysqli_real_escape_string($con, $work_type[$x]);

            $sql_insert_aop = "INSERT INTO company_work_type_rel(company_id, work_type_id)
                              VALUES('".$company_id."', '".$work_type_id."')";
            $result_insert_cst = mysqli_query($con, $sql_insert_aop);
            if(mysqli_affected_rows($con)<=0)
            {
                mysqli_query($con, "ROLLBACK");
                $error = 1;
                $error_msg = "Something went while adding work type";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                echo json_encode($jsonarray);
                exit;
            }
        }

        $sql_company_operation = "  UPDATE company_basic
                                    SET profile_completed = 4, modifiedon = NOW()
                                    WHERE id = '".$company_id."'";
        
        $result_company_operation = mysqli_query($con, $sql_company_operation);    
        if(mysqli_affected_rows($con) <= 0)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Something went while updating company details.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;  
        }
        else 
        {
            $sql = "COMMIT";
            $result = mysqli_query($con, $sql);
            if(!$result)
            {
                mysqli_query($con, "ROLLBACK");
                $error = 1;
                $error_msg = "Something went wrong while commiting transaction. Please try again later.";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                echo json_encode($jsonarray);
                exit;
            }
            else
            {
                $error = 0;
                $error_msg = "";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                echo json_encode($jsonarray);
                exit;
            }
        }
    }
    else if($form_step == 5)
    {
        $sql = "START TRANSACTION";
        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Something went wrong while starting transaction. Please try again later.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }

        $level_of_work = implode(',', $_POST["level_of_work"]);
        //$level_of_work = mysqli_real_escape_string($con, $_POST["level_of_work"]);
        if($level_of_work == "")
        {
            $error = 1;
            $error_msg = "Please select level of work";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;
        }
        
        $sql_company_operation = "  UPDATE company_basic
                                    SET level_of_work = '".$level_of_work."', profile_completed = 5 , modifiedon = NOW()
                                    WHERE id = '".$company_id."'";

        //echo $sql_company_operation; exit;
        
        $result_company_operation = mysqli_query($con, $sql_company_operation);    
        if(mysqli_affected_rows($con) <= 0)
        {
            mysqli_query($con, "ROLLBACK");
            $error = 1;
            $error_msg = "Something went while updating company details.";
            $jsonarray["code"] = $error;
            $jsonarray["msg"] = $error_msg;
            echo json_encode($jsonarray);
            exit;  
        }
        else 
        {
            $sql = "COMMIT";
            $result = mysqli_query($con, $sql);
            if(!$result)
            {
                mysqli_query($con, "ROLLBACK");
                $error = 1;
                $error_msg = "Something went wrong while commiting transaction. Please try again later.";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                echo json_encode($jsonarray);
                exit;
            }
            else
            {
                $error = 0;
                $error_msg = "";
                $jsonarray["code"] = $error;
                $jsonarray["msg"] = $error_msg;
                $jsonarray["company"] = $company_id;
                echo json_encode($jsonarray);
                exit;
            }
        }
    }
?>