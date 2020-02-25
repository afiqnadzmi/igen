<?php
if (isset($_POST['userID']) == true) {
    $edited = $_POST['edited'];
    $getID = $_POST['userID'];
    $query = mysql_query('SELECT * FROM employee WHERE id=' . $getID . ';');
    $row = mysql_fetch_array($query);
    $queryDept = mysql_query('SELECT d.id,d.dep_name FROM department AS d INNER JOIN emp_group AS eg JOIN employee AS e ON d.id=eg.dep_id AND e.group_id = eg.id WHERE e.id = ' . $getID . ';');
    $rowDept = mysql_fetch_array($queryDept);

    $queryGroup = mysql_query('SELECT g.id FROM emp_group AS g INNER JOIN employee AS e ON g.id = e.group_id WHERE e.id=' . $getID);
    $rowGroup = mysql_fetch_array($queryGroup);

//       $queryLevel = mysql_query('SELECT l.id FROM level AS l INNER JOIN employee AS e ON l.id = e.level_id WHERE e.id = '.$getID);
//       $rowLevel = mysql_fetch_array($queryLevel);

    $queryPos = mysql_query('SELECT p.id,p.level FROM position AS p INNER JOIN employee AS e ON p.id = e.position_id WHERE e.id = ' . $getID);
    $rowPos = mysql_fetch_array($queryPos);

    $queryBranch = mysql_query('SELECT b.id FROM branch AS b INNER JOIN employee AS e ON b.id = e.branch_id WHERE e.id = ' . $getID . ';');
    $rowBranch = mysql_fetch_array($queryBranch);

    $sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $getID);
    $rowGetNew = mysql_fetch_array($sqlGetNew);
    $rowCount = mysql_num_rows($sqlGetNew);

    $sqlShift = "SELECT e.shift_id as id FROM employee e where e.id=" . $getID . " limit 1";
    $rsShift = mysql_query($sqlShift);
    $rowShift = mysql_fetch_array($rsShift);
    $showresigned="collapse";
    if ($rowCount > 0) {
        if ($rowGetNew['full_name'] != $row['full_name'] && $rowGetNew['full_name']!=null) {
            $fontColorName = 'yes';
            $imgName = 'block';
            $name = $rowGetNew['full_name'];
        } else {
            $fontColorName = 'no';
            $imgName = 'none';
            $name = $row['full_name'];
//            $name = $row['full_name'];
        }
		
		if ($rowGetNew['country'] != $row['country'] && $rowGetNew['country'] !=null) {
            $fontColorc = 'yes';
            $imgc = 'block';
            $country = $rowGetNew['country'];
        } else {
            $fontColorc = 'no';
            $imgc = 'none';
            $country = $row['country'];
//            $name = $row['full_name'];
        }
    } else {
        $fontColorName = 'no';
        $name = $row['full_name'];
		$fontColorc = 'no';
        $country = $row['country'];
    }
   $resign = $row['resign_date'];
   $reason_resign = $row['reasign_reason'];
   $last_working_day = $row['last_working_day'];
   $officail_working_day= $row['officail_working_day'];

//                <td style="padding-top:6px;"><img src="images/save.png" style="width:15px;height:15px;display:'.$imgName.';" onclick="saveTop()"/></td>
//                <td style="padding-top:6px;"><img src="images/button_cancel_icon.png" style="width:15px;height:15px;display:'.$imgName.';"/></td>
    echo '
        <div style="padding-top:20px;">
            <table id="titlebar" class="titleBarTo"  style="width:98%; padding-right: 5px;">
                <tr>
                    <td style="font-size:large;font-weight: bold;">
                        &nbsp;&nbsp;&nbsp;Employee Details
                    </td>
                    <td onclick="saveTop()" id="editBut">Save</td>
                    <td onclick="cancelTop()" id="editBut">Cancel</td>
                </tr>
            </table>
        </div>
        <table style="padding-top:20px;padding-left:20px;">';
    $new_id = 'EMP' . str_pad($getID, 6, "0", STR_PAD_LEFT);
    echo '
            <tr>
                <td style="padding-top:5px;width:200px;">Employee ID</td>
                <td style="padding-top:5px">' . $new_id . '</td>
            </tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Full Name<span class="red"> *</span></td>
                <td style="padding-top:5px;"><input type="text" id="textname" value="' . $name . '" style="width:245px;" /></td>';
    if ($fontColorName == 'yes') {
        echo '<td style="padding-top:5px;"><a href="javscript:void()" style="width:200px;color:red;">' . $row['full_name'] . '</a></td>
                        <td style="padding-top:6px;"><img src="images/button_cancel_icon.png"
                        style="cursor:pointer;width:15px;height:15px;display:' . $imgName . ';" onclick="disapproveTop(' . $getID . ')" /></td>';
    }
    echo '</tr>';
	echo '<tr>
                <td style="padding-top:5px;width:200px;">Nationality<span class="red"> *</span></td>
                <td style="padding-top:5px;">
				<select id="country" onchange="race(this.value)" style="width:254px"> 
					<option value="'.$country.'">'.$country.'</option>
					<option value="Malaysia">Malaysia</option>
					<option value="United States">United States</option>
					<option value="United Kingdom">United Kingdom</option>
					<option value="Afghanistan">Afghanistan</option>
					<option value="Albania">Albania</option>
					<option value="Algeria">Algeria</option>
					<option value="American Samoa">American Samoa</option>
					<option value="Andorra">Andorra</option>
					<option value="Angola">Angola</option>
					<option value="Anguilla">Anguilla</option>
					<option value="Antarctica">Antarctica</option>
					<option value="Antigua and Barbuda">Antigua and Barbuda</option>
					<option value="Argentina">Argentina</option>
					<option value="Armenia">Armenia</option>
					<option value="Aruba">Aruba</option>
					<option value="Australia">Australia</option>
					<option value="Austria">Austria</option>
					<option value="Azerbaijan">Azerbaijan</option>
					<option value="Bahamas">Bahamas</option>
					<option value="Bahrain">Bahrain</option>
					<option value="Bangladesh">Bangladesh</option>
					<option value="Barbados">Barbados</option>
					<option value="Belarus">Belarus</option>
					<option value="Belgium">Belgium</option>
					<option value="Belize">Belize</option>
					<option value="Benin">Benin</option>
					<option value="Bermuda">Bermuda</option>
					<option value="Bhutan">Bhutan</option>
					<option value="Bolivia">Bolivia</option>
					<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
					<option value="Botswana">Botswana</option>
					<option value="Bouvet Island">Bouvet Island</option>
					<option value="Brazil">Brazil</option>
					<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
					<option value="Brunei Darussalam">Brunei Darussalam</option>
					<option value="Bulgaria">Bulgaria</option>
					<option value="Burkina Faso">Burkina Faso</option>
					<option value="Burundi">Burundi</option>
					<option value="Cambodia">Cambodia</option>
					<option value="Cameroon">Cameroon</option>
					<option value="Canada">Canada</option>
					<option value="Cape Verde">Cape Verde</option>
					<option value="Cayman Islands">Cayman Islands</option>
					<option value="Central African Republic">Central African Republic</option>
					<option value="Chad">Chad</option>
					<option value="Chile">Chile</option>
					<option value="China">China</option>
					<option value="Christmas Island">Christmas Island</option>
					<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
					<option value="Colombia">Colombia</option>
					<option value="Comoros">Comoros</option>
					<option value="Congo">Congo</option>
					<option value="Democratic Republic of Congo">Democratic Republic of Congo</option>
					<option value="Cook Islands">Cook Islands</option>
					<option value="Costa Rica">Costa Rica</option>
					<option value="Cote Divoire">Cote Divoire</option>
					<option value="Croatia">Croatia</option>
					<option value="Cuba">Cuba</option>
					<option value="Cyprus">Cyprus</option>
					<option value="Czech Republic">Czech Republic</option>
					<option value="Denmark">Denmark</option>
					<option value="Djibouti">Djibouti</option>
					<option value="Dominica">Dominica</option>
					<option value="Dominican Republic">Dominican Republic</option>
					<option value="Ecuador">Ecuador</option>
					<option value="Egypt">Egypt</option>
					<option value="El Salvador">El Salvador</option>
					<option value="Equatorial Guinea">Equatorial Guinea</option>
					<option value="Eritrea">Eritrea</option>
					<option value="Estonia">Estonia</option>
					<option value="Ethiopia">Ethiopia</option>
					<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
					<option value="Faroe Islands">Faroe Islands</option>
					<option value="Fiji">Fiji</option>
					<option value="Finland">Finland</option>
					<option value="France">France</option>
					<option value="French Guiana">French Guiana</option>
					<option value="French Polynesia">French Polynesia</option>
					<option value="French Southern Territories">French Southern Territories</option>
					<option value="Gabon">Gabon</option>
					<option value="Gambia">Gambia</option>
					<option value="Georgia">Georgia</option>
					<option value="Germany">Germany</option>
					<option value="Ghana">Ghana</option>
					<option value="Gibraltar">Gibraltar</option>
					<option value="Greece">Greece</option>
					<option value="Greenland">Greenland</option>
					<option value="Grenada">Grenada</option>
					<option value="Guadeloupe">Guadeloupe</option>
					<option value="Guam">Guam</option>
					<option value="Guatemala">Guatemala</option>
					<option value="Guinea">Guinea</option>
					<option value="Guinea-bissau">Guinea-bissau</option>
					<option value="Guyana">Guyana</option>
					<option value="Haiti">Haiti</option>
					<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
					<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
					<option value="Honduras">Honduras</option>
					<option value="Hong Kong">Hong Kong</option>
					<option value="Hungary">Hungary</option>
					<option value="Iceland">Iceland</option>
					<option value="India">India</option>
					<option value="Indonesia">Indonesia</option>
					<option value="Iran">Iran</option>
					<option value="Iraq">Iraq</option>
					<option value="Ireland">Ireland</option>
					<option value="Israel">Israel</option>
					<option value="Italy">Italy</option>
					<option value="Jamaica">Jamaica</option>
					<option value="Japan">Japan</option>
					<option value="Jordan">Jordan</option>
					<option value="Kazakhstan">Kazakhstan</option>
					<option value="Kenya">Kenya</option>
					<option value="Kiribati">Kiribati</option>
					<option value="Korea">Korea</option>
					<option value="Kuwait">Kuwait</option>
					<option value="Kyrgyzstan">Kyrgyzstan</option>
					<option value="Lao">Lao </option>
					<option value="Latvia">Latvia</option>
					<option value="Lebanon">Lebanon</option>
					<option value="Lesotho">Lesotho</option>
					<option value="Liberia">Liberia</option>
					<option value="Libya">Libya</option>
					<option value="Liechtenstein">Liechtenstein</option>
					<option value="Lithuania">Lithuania</option>
					<option value="Luxembourg">Luxembourg</option>
					<option value="Macao">Macao</option>
					<option value="Macedonia">Macedonia</option>
					<option value="Madagascar">Madagascar</option>
					<option value="Malawi">Malawi</option>
					<option value="Maldives">Maldives</option>
					<option value="Mali">Mali</option>
					<option value="Malta">Malta</option>
					<option value="Marshall Islands">Marshall Islands</option>
					<option value="Martinique">Martinique</option>
					<option value="Mauritania">Mauritania</option>
					<option value="Mauritius">Mauritius</option>
					<option value="Mayotte">Mayotte</option>
					<option value="Mexico">Mexico</option>
					<option value="Micronesia">Micronesia</option>
					<option value="Moldova">Moldova</option>
					<option value="Monaco">Monaco</option>
					<option value="Mongolia">Mongolia</option>
					<option value="Montserrat">Montserrat</option>
					<option value="Morocco">Morocco</option>
					<option value="Mozambique">Mozambique</option>
					<option value="Myanmar">Myanmar</option>
					<option value="Namibia">Namibia</option>
					<option value="Nauru">Nauru</option>
					<option value="Nepal">Nepal</option>
					<option value="Netherlands">Netherlands</option>
					<option value="Netherlands Antilles">Netherlands Antilles</option>
					<option value="New Caledonia">New Caledonia</option>
					<option value="New Zealand">New Zealand</option>
					<option value="Nicaragua">Nicaragua</option>
					<option value="Niger">Niger</option>
					<option value="Nigeria">Nigeria</option>
					<option value="Niue">Niue</option>
					<option value="Norfolk Island">Norfolk Island</option>
					<option value="Northern Mariana Islands">Northern Mariana Islands</option>
					<option value="Norway">Norway</option>
					<option value="Oman">Oman</option>
					<option value="Pakistan">Pakistan</option>
					<option value="Palau">Palau</option>
					<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
					<option value="Panama">Panama</option>
					<option value="Papua New Guinea">Papua New Guinea</option>
					<option value="Paraguay">Paraguay</option>
					<option value="Peru">Peru</option>
					<option value="Philippines">Philippines</option>
					<option value="Pitcairn">Pitcairn</option>
					<option value="Poland">Poland</option>
					<option value="Portugal">Portugal</option>
					<option value="Puerto Rico">Puerto Rico</option>
					<option value="Qatar">Qatar</option>
					<option value="Reunion">Reunion</option>
					<option value="Romania">Romania</option>
					<option value="Russian Federation">Russian Federation</option>
					<option value="Rwanda">Rwanda</option>
					<option value="Saint Helena">Saint Helena</option>
					<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
					<option value="Saint Lucia">Saint Lucia</option>
					<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
					<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
					<option value="Samoa">Samoa</option>
					<option value="San Marino">San Marino</option>
					<option value="Sao Tome and Principe">Sao Tome and Principe</option>
					<option value="Saudi Arabia">Saudi Arabia</option>
					<option value="Senegal">Senegal</option>
					<option value="Serbia and Montenegro">Serbia and Montenegro</option>
					<option value="Seychelles">Seychelles</option>
					<option value="Sierra Leone">Sierra Leone</option>
					<option value="Singapore">Singapore</option>
					<option value="Slovakia">Slovakia</option>
					<option value="Slovenia">Slovenia</option>
					<option value="Solomon Islands">Solomon Islands</option>
					<option value="Somalia">Somalia</option>
					<option value="South Africa">South Africa</option>
					<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
					<option value="Spain">Spain</option>
					<option value="Sri Lanka">Sri Lanka</option>
					<option value="Sudan">Sudan</option>
					<option value="Suriname">Suriname</option>
					<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
					<option value="Swaziland">Swaziland</option>
					<option value="Sweden">Sweden</option>
					<option value="Switzerland">Switzerland</option>
					<option value="Syrian Arab Republic">Syrian Arab Republic</option>
					<option value="Taiwan, Province of China">Taiwan, Province of China</option>
					<option value="Tajikistan">Tajikistan</option>
					<option value="Tanzania">Tanzania</option>
					<option value="Thailand">Thailand</option>
					<option value="Timor-leste">Timor-leste</option>
					<option value="Togo">Togo</option>
					<option value="Tokelau">Tokelau</option>
					<option value="Tonga">Tonga</option>
					<option value="Trinidad and Tobago">Trinidad and Tobago</option>
					<option value="Tunisia">Tunisia</option>
					<option value="Turkey">Turkey</option>
					<option value="Turkmenistan">Turkmenistan</option>
					<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
					<option value="Tuvalu">Tuvalu</option>
					<option value="Uganda">Uganda</option>
					<option value="Ukraine">Ukraine</option>
					<option value="United Arab Emirates">United Arab Emirates</option>
					<option value="United Kingdom">United Kingdom</option>
					<option value="United States">United States</option>
					<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
					<option value="Uruguay">Uruguay</option>
					<option value="Uzbekistan">Uzbekistan</option>
					<option value="Vanuatu">Vanuatu</option>
					<option value="Venezuela">Venezuela</option>
					<option value="Viet Nam">Viet Nam</option>
					<option value="Virgin Islands, British">Virgin Islands, British</option>
					<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
					<option value="Wallis and Futuna">Wallis and Futuna</option>
					<option value="Western Sahara">Western Sahara</option>
					<option value="Yemen">Yemen</option>
					<option value="Zambia">Zambia</option> 
					<option value="Zimbabwe">Zimbabwe</option>
					</select>
					</td>';
    if ($fontColorc == 'yes') {
        echo '<td style="padding-top:5px;"><a href="javscript:void()" style="width:200px;color:red;">' . $row['country'] . '</a></td>
                        <td style="padding-top:6px;"><img src="images/button_cancel_icon.png"
                        style="cursor:pointer;width:15px;height:15px;display:' . $imgc . ';" onclick="disapproveTop(' . $getID . ')" /></td>';
    }
    echo '</tr>';
          echo '<tr>
          <td style="padding-top:6px;width:200px">Status<span class="red"> *</span></td>
          <td style="padding-top:6px;width:200px">
          <select id="dropempstatus" onchange="empStatus(this.value)" style="width:250px">
          <option value="0" >--Please Select--</option>';
    if ($row['emp_status'] == "Active") {
        echo '<option value="Active" selected="selected">Active</option>
              <option value="Inactive">Inactive</option>
			  <option value="Resigned">Resigned</option>';
    } elseif ($row['emp_status'] == "Inactive") {
        echo '<option value="Active">Active</option>
              <option value="Inactive" selected="selected">Inactive</option>
			  <option value="Resigned">Resigned</option>';
    }elseif ($row['emp_status'] == "Resigned") {
		 $showresigned="visible";
        echo '<option value="Active">Active</option>
              <option value="Inactive" >Inactive</option>
			  <option value="Resigned" selected="selected">Resigned</option>';
    }
    echo '</select>
          </td>
          </tr>';
		 
		if ($resign != "0000-00-00" && $resign != "") {
				$resign = date("d-m-Y", strtotime($resign));
			} else {
				$resign = "";
			}
    echo '<tr style="visibility:'.$showresigned.'" class="resign_info">
                <td style="padding-top:5px;width:200px">Resign Date</td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="textresign" value="'.$resign.'"';
    
    echo '" />
                </td>';
    echo '</tr>';
	 if ($last_working_day != "0000-00-00" && $last_working_day != "") {
			$last_working_day = date("d-m-Y", strtotime($last_working_day));
		} else {
			$last_working_day = "";
		}
	 echo'<tr style="visibility:'.$showresigned.'" class="resign_info">
                <td style="padding-top:5px;width:200px">Last Working Day</td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="lastDateText" value="'.$last_working_day.'"';
   
    echo '" />
                </td>';

   /* echo '</tr>';
	 if ($officail_working_day  != "0000-00-00" && $officail_working_day  != "") {
		$officail_working_day = date("d-m-Y", strtotime($officail_working_day));
    } else {
        $officail_working_day = "";
    }
	echo'<tr style="visibility:'.$showresigned.'" class="resign_info">
                <td style="padding-top:5px;width:200px">Officail Working Day </td>
                <td style="padding-top:5px;"><input type="text" style="width: 250px;" id="offDateText" value="'.$officail_working_day.'"';
   
    echo '" />
                </td>';
    echo '</tr>';*/
	 echo '<tr style="visibility:'.$showresigned.'" class="resign_info">
                <td style="padding-top:5px;width:200px;">Reason For Resign</td>
                <td style="padding-top:5px;"><textarea rows="3" cols="37" style="height: 100px;" id="reasnresign">'; 
   if ($reason_resign!= "" && $reason_resign != null) {
    print $reason_resign;
    } else {
        print "";
    }
    echo '</textarea>';
  
   echo' </td> </tr>';
		  echo '<tr>
          <td style="padding-top:5px;width:200px;">Employee Type<span class="red"> *</span></td>
          <td style="padding-top:5px">
          <select id="type" style="width:250px;" >';
          if($row['is_contract']!=null){
		  echo '<option>' . ucfirst($row['is_contract']) . '</option>';
		  }else{
		  
		  echo '<option value="0" >--Please Select--</option>';
		  }
    $sqlemp2 = mysql_query('SELECT * FROM employee_type');

    while ($rowemp2 = mysql_fetch_array($sqlemp2)) {
	
       
        if (trim($rowemp2['type'])==ucfirst($row['is_contract'])) {
            echo"select";
        } else {
            echo '<option>' . $rowemp2['type'] . '</option>';
        }
        
    }
    echo '</select>
        </td>
	</tr>';
    echo '<tr>
          <td style="padding-top:5px;width:200px;">Company<span class="red"> *</span></td>
          <td style="padding-top:5px">
          <select id="dropCompany" style="width:250px;" onchange="selectBranch(this.value)">
          <option value="0" >--Please Select--</option>';
    $sqlCompany2 = mysql_query('SELECT * FROM company');

    while ($rowCompany2 = mysql_fetch_array($sqlCompany2)) {
        echo '<option value="' . $rowCompany2['id'] . '"';
        if ($row['company_id'] == $rowCompany2['id']) {
            echo 'selected="selected"';
        } else {
            echo '';
        }
        echo '>' . $rowCompany2['name'] . '</option>';
    }
    echo '</select>
        </td>
	</tr>';
    echo '<tr>
          <td style="padding-top:5px;width:200px;">Branch<span class="red"> *</span></td>
          <td style="padding-top:5px">
          <select id="dropbranch" style="width:250px;" onchange="selectDept(this.value)">
          <option value="0" >--Please Select--</option>';
    $sqlBranch2 = mysql_query('SELECT * FROM branch WHERE company_id=' . $row["company_id"]);

    while ($rowBranch2 = mysql_fetch_array($sqlBranch2)) {
        echo '<option value="' . $rowBranch2['id'] . '"';
        if ($rowBranch['id'] == $rowBranch2['id']) {
            echo 'selected="selected"';
        } else {
            echo '';
        }
        echo '>' . $rowBranch2['branch_code'] . '</option>';
    }
    echo '</select>
        </td>
	</tr>'; 
    echo '<tr>
        <td style="padding-top:5px;width:200px;">Department<span class="red"> *</span></td>
        <td style="padding-top:5px">
        <select id="dropdept" style="width:250px;" onchange="changeGroup(this.value)">
        <option value="0" >--Please Select--</option>';
    $sqlDept2 = mysql_query('SELECT * FROM department WHERE branch_id=' . $rowBranch['id'] . ' AND is_active=1');
    while ($rowDept2 = mysql_fetch_array($sqlDept2)) {
        echo '<option value="' . $rowDept2['id'] . '"';
        if ($rowDept['id'] == $rowDept2['id']) {
            echo 'selected="selected"';
        } else {
            echo '';
        }
        echo '>' . $rowDept2['dep_name'] . '</option>';
    }
    $query_checkdep = mysql_query('SELECT id, dep_name, is_active FROM department WHERE id =' . $rowDept['id']);
    $row_checkdep = mysql_fetch_array($query_checkdep);
    if ($row_checkdep["is_active"] == "0") {
        echo '<optgroup label="--Inactive Department--">
              <option value="' . $row_checkdep["id"] . '" selected="true">' . $row_checkdep["dep_name"] . '</option>
              </optgroup>';
    }

    echo '</select>
            </td>
            </tr>';
    echo '<tr>
                <td style="padding-top:5px;width:200px;">Section/Unit<span class="red"> *</span></td>
                <td style="padding-top:5px">
                    <div id="groupDiv">
                        <select id="dropgroup" style="width:250px;">
        <option value="0" >--Please Select--</option>';
    $sqlGroup2 = mysql_query('SELECT * FROM emp_group WHERE dep_id=' . $rowDept['id'] . ' AND is_active = 1');

    while ($rowGroup2 = mysql_fetch_array($sqlGroup2)) {
        echo '<option value="' . $rowGroup2['id'] . '"';
        if ($rowGroup['id'] == $rowGroup2['id']) {
            echo 'selected="selected"';
        } else {
            echo '';
        }
        echo '>' . $rowGroup2['group_name'] . '</option>';
    }
    $query_checkgroup = mysql_query('SELECT id, group_name, is_active FROM emp_group WHERE id =' . $rowGroup['id']);
    $row_checkgroup = mysql_fetch_array($query_checkgroup);
    if ($row_checkgroup["is_active"] == "0") {
        echo '<optgroup label="--Inactive Group--">
              <option value="' . $row_checkgroup["id"] . '" selected="true">' . $row_checkgroup["group_name"] . '</option>
              </optgroup>';
    }
    echo '</select>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Position<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <form action="editprofiletop.php" method="post">
                <select id="droppos" name="droppos" style="width:250px;">
        <option value="0" >--Please Select--</option>';
    $sqlPos2 = mysql_query('SELECT * FROM position;');

    while ($rowPos2 = mysql_fetch_array($sqlPos2)) {
        echo '<option value="' . $rowPos2['id'] . '"';
        if ($row['position_id'] == $rowPos2['id']) {
            echo 'selected="selected"';
        } else {
            echo '';
        }
        echo '>' . $rowPos2['position_name'] . '</option>';
    }
    echo '</select></form>
            </td>
            </tr>';


    echo '<tr>
                <td style="padding-top:5px;width:200px;">Shift<span class="red"> *</span></td>
                <td style="padding-top:5px">
                <form action="editprofiletop.php" method="post">
                <select id="dropshift" name="dropshift" style="width:250px;">';
    $sqlshift2 = mysql_query('SELECT * FROM shift');

    while ($rowshift2 = mysql_fetch_array($sqlshift2)) {
        echo '<option value="' . $rowshift2['id'] . '"';
        if ($rowShift['id'] == $rowshift2['id']) {
            echo 'selected="selected"';
        } else {
            echo '';
        }
        echo '>' . $rowshift2['name'] . '</option>';
    }
    echo '</select></form>
            </td>
            </tr>';

//        $sql=mysql_query('SELECT * FROM position where position_name="'.$_POST['droppos'].'";');
//        $row=mysql_fetch_array($sql);
//        $level=$row['level'];

    echo '<tr>
        <td style="padding-top:5px;width:200px;">User Permission<span class="red"> *</span></td>
        <td style="padding-top:5px;">
        <div id="level">
        <select id="textlevel" style="width: 250px;">
        <option value="0">--Please Select--</option>';
    $sql_up = 'SELECT id, name FROM user_permission';
    $query_up = mysql_query($sql_up);
    while ($row_up = mysql_fetch_array($query_up)) {
        echo '<option value="' . $row_up["id"] . '" ';
        if ($row_up["id"] == $row["level_id"]) {
            echo 'selected="selected"';
        }
        echo '>' . $row_up["name"] . '</option>';
    }
    echo '</select>
        </div>
	</td>
        </tr>';
    echo '</table>';
} else {
    print false;
}
?>
<script>
$(function() {
        $("#offDateText, #lastDateText, #textresign").datepicker({
            yearRange: "-100:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
</script>
<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>