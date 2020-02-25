<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>      
	 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
      <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		   
<div class="main_div">
    </br>
    <div class="header_text">
	


        <span>New Employee Profile</span>
        <span style="float: right;">
          <input type="button" value="Add" id="editBut" onclick="insertData()" style="width: 70px;" />
          <input type="button" value="Clear" id="editBut" onclick="clearData()" style="width: 70px; margin-left:10px" />
          <input type="button" value="Back" id="editBut" onclick="back()" style="width: 70px; margin-left:10px" />
        </span> 
    </div>
	 
    <div style="width:1080px;padding-top: 10px;">
        <div style="padding: 5px 10px;"><span class="_14 red">* - Mandatory Fields</span></div>
        <table>
            <tr>
                <td style="vertical-align: top;"> 
                    <fieldset style="width:530px;padding-left: 50px;height:900px">
                        <legend style="font-size: 16px; font-weight: bold;">&nbsp;&nbsp;Personal Information &nbsp;&nbsp;</legend>
                        <table>
                            <tr>
                                <td style="padding-top:6px;width:150px">Full Name<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="fullNameText" style="width:250px" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:200px">Nationality<span class="red"> *</span></td>
                                <td style="padding-top:6px;">
								<select id='country' onchange="race(this.value)" style="width:254px">

<option value="" selected="selected">Select Nationality</option>
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
<option value="Cote D'ivoire">Cote D'ivoire</option>
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
                           </td> 
                            </tr>
                            <tr class="ic">
                                <td style="padding-top:6px;width:150px">IC<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="ICText1" style="width:99px" type="Text" value="" maxlength="6" />&nbsp;-&nbsp;<input id="ICText2" style="width:30px" type="Text" value="" maxlength="2" />&nbsp;-&nbsp;<input id="ICText3" style="width:80px" type="Text" value="" maxlength="4" /></td>
                            </tr>
							<tr class="pn">   
                                <td style="padding-top:6px;width:150px">Passport Number<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="pass" style="width:250px" type="Text" value="" /></td>
                            </tr>
							<tr class="pe">
                                <td style="padding-top:6px;width:150px">Passport Expiry<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="pe" style="width:250px" type="Text" value="" /></td>
                            </tr>
							<tr class="wp">
                                <td style="padding-top:6px;width:150px">Work Permit<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="wp" style="width:250px" type="Text" value="" /></td>
                            </tr>
							<tr class="wp">
                                <td style="padding-top:6px;width:150px">Work Permit expiry<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="wpep" style="width:250px" type="Text" value="" /></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:150px">Contact Number (Home)</td>
                                <td style="padding-top:6px;"><input id="phoneText" style="width:250px" type="Text" value="" /></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:150px">Contact Number (Mobile)<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="mobileText" style="width:250px" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">Emergency Contact Person <span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="contactText" style="width:250px" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">Emergency Contact Number <span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="emergencyText" style="width:250px" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">Emergency Contact Relationship <span class="red"> *</span></td>
                                <td style="padding-top:6px;">
								 <select id="emergencyrelationship" style="width:250px;">
                                        <option value="0">--Please Select--</option>
                                        <option value="Spouse">Spouse</option>
                                        <option value="Son">Son</option>
										<option value="Daughter">Daughter</option>
										<option value="Friend">Friend</option>
										<option value="Parents">Parents</option>
										<option value="Siblings">Siblings</option>
                                  </select>
								</td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:150px">Email Address<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="emailAddText" style="width:250px" type="Text" value="" /></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:150px;" valign="top">Mailing Address</td>
                                <td style="padding-top:6px"><textarea id="mailAddText" style="height:90px;width:250px"></textarea></td>
                            </tr>
                            <tr>
                                <td style="width:30px">Gender<span class="red"> *</span></td>
                                <td style="">
                                    <select id="dropGender" style="width:250px;">
                                        <option value="0">--Please Select--</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">Race<span class="red"> *</span></td>
                                <td style="padding-top:6px;">
								
                                    <select id="dropRace" style="width:250px;">
                                        <option value="0">--Please Select--</option>
                                        <option value="Chinese">Chinese</option> 
                                        <option value="Indian">Indian</option> 
                                        <option value="Malay">Malay</option>
										<option value="Prebumi">Prebumi</option>
										<option value="Iban">Iban</option>
										<option value="Bidayuh">Bidayuh</option>
										<option value="Melanau">Melanau</option>
										<option value="Kadazan">Kadazan</option>
										<option value="Dusun">Dusun</option>
										<option value="Minokok">Minokok</option>
										<option value="Dumpas">Dumpas</option>
										<option value="Bajau">Bajau</option>
										<option value="Senoi">Senoi</option>
										<option value="Semang">Semang</option>
                                        <option value="Foreigner">Foreigner</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">Religion<span class="red"> *</span></td>
                                <td style="padding-top:6px;">
                                    <select id="dropReligion" style="width:250px;">
                                        <option value="0">--Please Select--</option>
                                        <option value="Buddhist">Buddhist</option>
                                        <option value="Catholic">Catholic</option>
                                        <option value="Christian">Christian</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-top:6px;width:200px">Marital Status<span class="red"> *</span></td>
                                <td style="padding-top:6px;width:200px;">
                                    <select id="dropMarital" style="width:250px;" onchange="checkMarital(this.value)">
                                        <option value="0">--Please Select--</option>
                                        <option value="S">Single</option>
                                        <option value="M">Married</option>
                                        <option value="D">Divorced</option>
                                    </select>
                                </td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:200px" id="spouse"></td>
                                <td style="padding-top:6px;width:200px" id="spousein"></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:30px" id="marital_spouse">Spouse Working</td>
                                <td style="padding-top:6px;">
                                    <select id="dropSpouse" style="width:250px;">
                                        <option value="0">--Please Select--</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </td>
                            </tr>
							  <tr style="display:none" class="company_name">
                                <td style="padding-top:6px;width:200px">Company Name</td>
                                <td style="padding-top:6px;width:200px"><input id="company_name" type="Text" style="width:250px;"/></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px" id="marital_child">Number of Children</td>
                                <td style="padding-top:6px;width:200px"><input id="numChildText" type="Text" style="width:250px;"/></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:150px">Date of Birth<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="dobText" name="e_dobText" type="Text" value="" style="width:250px;" /></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:150px">Join Date<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="joinDateText" name="e_joinDateText" style="width:250px;" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">Confirmation Date<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="confirmDateText" name="e_confirmDateText" style="width:250px;" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">PK FZ expirty Date (Pass)<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="e_date_pk_fz" name="e_pk_fz" style="width:250px;" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">Westport Expiry date (Pass)<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="e_date_westport" name="e_westport" style="width:250px;" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">Johor Port expiry Date (Pass)<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="e_date_johor_port" name="e_johor_port" style="width:250px;" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">PTP expiry date (Pass)<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="e_date_ptp" name="e_ptp" style="width:250px;" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">TLP expiry date (Pass)<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="e_date_tlp" name="e_tlp" style="width:250px;" type="Text" value="" /></td>
                            </tr>
                            <tr style="display: none;">
                                <td style="padding-top:6px;width:200px;" valign="top">Employee Profile</td>
                                <td style="padding-top:6px;width:200px"><textarea id="profileText" style="height:30px;width:250px"></textarea></td>
                            </tr>
                            <tr style="display: none;">
                                <td style="padding-top:6px;width:150px;" valign="top">Extra Information/Note</td>
                                <td style="padding-top:6px"><textarea class="input_textarea" id="noteText" style="height:50px;width:250px"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top: 10px;"><span class="cursor_pointer" onclick="add_field()"><img src="css/images/select.gif" alt="add" style="width: 20px; height: 20px; vertical-align: bottom;" />&nbsp;&nbsp;&nbsp;Add Information Field<span id="field_no" style="display: none;">0</span></span></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table id="add_field_table"></table>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
                <td>
                    <fieldset style="width:550px;padding-left: 50px;height:500px">
                        <legend style="font-size: 16px; font-weight: bold;">&nbsp;&nbsp;Profile&nbsp;&nbsp;</legend>
                        <table>

                            <tr>
                                <td style="padding-top:6px;width:200px">Username<span class="red"> *</span></td>
                                <td style="padding-top:6px;width:200px;"><input id="usernameText" type="text" value="" style="width:250px;" />
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">Status<span class="red"> *</span></td>
                                <td style="padding-top:6px;width:200px">
                                    <select id="dropempstatus" style="width:250px">
                                        <option value="0" >--Please Select--</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">Company<span class="red"> *</span></td>
                                <td style="padding-top:6px;width:200px">
                                    <div id="branchDiv">
                                        <select id="dropCompany" style="width:250px;" onchange="selectBranch(this.value)">
                                            <option value="0" selected="selected">--Please Select--</option>
                                            <?php
                                            $sqlCompany = mysql_query('SELECT * FROM company ORDER BY code');
                                            while ($rowCompany = mysql_fetch_array($sqlCompany)) {
                                                echo '<option value="' . $rowCompany['id'] . '">' . $rowCompany['code'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">Branch<span class="red"> *</span></td>
                                <td style="padding-top:6px;width:200px">
                                    <div id="branchDiv">
                                        <select id="dropBranch" style="width:250px;" onchange="selectDept(this.value)">
                                            <option value="0" selected="selected">--Please Select--</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-top:6px;width:200px">Department<span class="red"> *</span></td>
                                <td style="padding-top:6px;width:200px">
                                    <div id="deptDiv">
                                        <select id="dropDept" style="width:250px;" onchange="showGroup()">
                                            <option value="0" selected="selected">--Please Select--</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">Section/Unit<span class="red"> *</span></td>
                                <td style="padding-top:6px;width:200px">
                                    <div id="groupDiv">
                                        <select id="dropGroup" style="width:250px;">
                                            <option value="0" selected="selected">--Please Select--</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">Position<span class="red"> *</span></td>
                                <td style="padding-top:6px;width:200px">
                                    <div id="positionDiv">
                                        <select id="dropPosition" style="width:250px;" >
                                            <option value="0" selected="selected">--Please Select--</option>
                                            <?php
                                            $sqlPos = mysql_query('SELECT * FROM position ORDER BY position_name');
                                            while ($rowPos = mysql_fetch_array($sqlPos)) {
                                                echo '<option value="' . $rowPos['id'] . '">' . $rowPos['position_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Shift <span class="red"> *</span></td>
                                <td style="padding-top:5px;">
                                    <select id="dropShift" style="width:250px">
                                        <option value="0" >--Please Select--</option>
                                        <?php
                                        $sql = 'SELECT * FROM shift ORDER BY name';
                                        $sqlLeave = mysql_query($sql);
                                        while ($rowLeave = mysql_fetch_array($sqlLeave)) {
                                            echo '<option value="' . $rowLeave['id'] . '">' . $rowLeave['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">User Permission<span class="red"> *</span></td>
                                <td style="padding-top:6px;width:200px">
                                    <select id="dropUserPermission" style="width:250px;" >
                                        <option value="0" selected="selected">--Please Select--</option>
                                        <?php
                                        $sqlLevel = mysql_query('SELECT * FROM user_permission ORDER BY name');
                                        while ($rowLevel = mysql_fetch_array($sqlLevel)) {
                                            echo '<option value="' . $rowLevel['id'] . '">' . $rowLevel['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Leave Group<span class="red"> *</span></td>
                                <td style="padding-top:5px;">
                                    <select id="dropLeave" style="width:250px">
                                        <option value="0" >--Please Select--</option>
                                        <?php
                                        $sqlLeave = mysql_query('SELECT * FROM group_for_leave ORDER BY group_name');
                                        while ($rowLeave = mysql_fetch_array($sqlLeave)) {
                                            echo '<option value="' . $rowLeave['id'] . '">' . $rowLeave['group_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                           <!-- <tr>
                                <td style="padding-top:6px;width:200px">Overtime</td>
                                <td style="padding-top:6px;width:200px">
                                    <select id="dropOvertime" style="width:250px;">
                                        <option value="0">--Please Select--</option>
                                        <?php/*
                                        $sqlgetovertime = mysql_query('SELECT * FROM overtime ORDER BY overtime_name');
                                        while ($row = mysql_fetch_array($sqlgetovertime)) {
                                            echo '<option value="' . $row['id'] . '">' . $row['overtime_name'] . '</option>';
                                        }*/
                                        ?>
                                    </select>
                                </td>
                            </tr>-->
							  
						<!--	<tr>
                                <td style="padding-top:6px;width:150px">Resign Date</td>
                                <td style="padding-top:6px;"><input id="resignDateText" name="e_resignDateText" style="width:250px;" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">Last Working Day</td>
                                <td style="padding-top:6px;"><input id="lastDateText" name="e_lastDateText" style="width:250px;" type="Text" value="" /></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">Last Official Day</td>
                                <td style="padding-top:6px;"><input id="offDateText" name="e_offDateText" style="width:250px;" type="Text" value="" /></td>
                            </tr> -->
                        </table>
                    </fieldset>

                    <fieldset style="width:550px;padding-left: 50px;position: relative; top: -110px;">
                        <legend style="font-size: 16px; font-weight: bold;">&nbsp;&nbsp;Payroll&nbsp;&nbsp;</legend>
                        <table>
                            <tr>
                                <td style="padding-top:6px;width:150px">Employee Type<span class="red"> *</span></td>
                                <td style="padding-top:6px;width:200px;">
                                    <select id="underContract" style="width:250px">
                                        <option value="0" >--Please Select--</option>
                                        			 <?php
                                        $sqlbank = mysql_query('SELECT * FROM employee_type ORDER BY type');
                                        while ($row = mysql_fetch_array($sqlbank)) {
                                            echo '<option value="' . $row['type'] . '">' . $row['type'] . '</option>';
                                        }
                                        ?>							
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Salary Type<span class="red"> *</span></td>
                                <td style="padding-top:5px;">
                                    <select style="width:250px;" id="dropSalaryType">
                                        <option value="0" >--Please Select--</option>
                                        <option value="bs">Basic Salary</option>
                                        <option value="mn">Monthly</option>
                                        <option value="wk">Weekly</option>
                                        <option value="dy">Daily</option>
                                        <option value="hr">Hourly</option>
                                    </select>
                                </td>
                            </tr>
							<tr>
                                <td style="padding-top:5px;width:200px;">Payment Type<span class="red"> *</span></td>
                                <td style="padding-top:5px;">
                                    <select style="width:250px;" id="paymentType" onchange="paymentType(this.value)">
                                        <option value="0" >--Please Select--</option>
                                        <option value="cash">Cash</option>
										<option value="bank">Bank</option>
                                        <option value="cheque">Cheque</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Salary Amount<span class="red"> *</span></td>
                                <td style="padding-top:5px;"><input id="salaryAmtText" type="Text" value="" style="width:250px"/></td>
                            </tr>
                            <tr style="display:none" class="bank_type">
                                <td style="padding-top:6px;width:30px">Bank Type<span class="red"> *</span></td>
                                <td style="padding-top:6px;">
                                    <select id="dropBank" style="width:250px">
                                        <option value="0" >--Please Select--</option>
                                        <?php
                                        $sqlbank = mysql_query('SELECT * FROM bank ORDER BY name');
                                        while ($row = mysql_fetch_array($sqlbank)) {
                                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="display:none" class="bank_name">
                                <td style="padding-top:6px;width:200px">Bank Account Number<span class="red"> *</span></td>
                                <td style="padding-top:6px;width:200px"><input class="bankAccNumText" type="Text" value="" style="width:250px"/></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:200px">Salary Grade</td>
                                <td style="padding-top:6px;width:200px">
                                 <input id="salaryGrade" name="salaryGrade" style="width:250px;" type="Text" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">EPF Number</td>
                                <td style="padding-top:6px;width:200px"><input id="epfText" type="Text" value="" style="width:250px"/></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">Socso Number</td>
                                <td style="padding-top:6px;width:200px"><input id="socsoText" type="Text" value="" style="width:250px"/></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">Income Tax Number</td>
                                <td style="padding-top:6px;width:200px"><input id="iTaxText" type="Text" value="" style="width:250px"/></td>
                            </tr>
							<tr>
                                <td style="padding-top:6px;width:150px">Zakat Number</td>
                                <td style="padding-top:6px;"><input id="zakatnum" type="Text" value="" style="width:250px" /></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:150px">Zakat Amount</td>
                                <td style="padding-top:6px;"><input id="zakatText" type="Text" value="" style="width:250px" /></td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
        </table>
    </div>

    <div id="popup_box">
        <form>
            <span>Select Property :</span>
            <span style="float: right;">
                <table>
                    <tr>
                        <td>
                            <input type='button' class='button' value='OK' onclick='selectPro()' style='width:100px' />
                        <td><input type='button' class='button' value='Cancel' onclick='noSelectPro()' style='width:100px' /></td>
                    </tr>
                </table>
            </span>
            <br/><br/>
            <table class="margincenter" border="2" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 98%;">
                <tr class="tableth">
                    <th style='text-align: center;'>Select</th>
                    <th style='text-align: center;'>Property Name</th>
                    <th style='text-align: center;'>Specification</th>
                    <th style='text-align: center;'>Stock in date</th>
                </tr>
                <?php
                $queryPro = mysql_query("SELECT * FROM property WHERE is_occupy='N'");
                if ($queryPro && mysql_num_rows($queryPro) > 0) {
                    while ($row = mysql_fetch_array($queryPro)) {
                        echo "<tr class='tabletr'>
                                    <td style='text-align: center;'><input type='checkbox' name='checkPro' value='" . $row['id'] . "' /></td>
                                    <td style='text-align: center;'>" . $row['property_name'] . "</td>
                                    <td style='text-align: center;'>" . $row['specification'] . "</td>
                                    <td style='text-align: center;'>" . $row['stock_in_date'] . "</td>
                                </tr>";
                    }
                } else {
                    echo '<tr><td colspan="4">No property available.</td></tr>';
                }
                ?>
            </table>
        </form>
        <br/>
    </div>
    <input type="hidden" value="" id="new_emp_id" />
</div>
<script type="text/javascript">
 $(document).ready(function() {
$( "#datepicker" ).datepicker();
 })
    function checkMarital(status){
        if(status == "M"){
		    $("#spouse").html("Spouse Name<span class='red'> *</span>");
			$("#spousein").html("<input id='SpouseName' type='Text' style='width:250px;'/>");
			
            $("#marital_child").html("Number of Children<span class='red'> *</span>");
            $("#marital_spouse").html("Spouse Working<span class='red'> *</span>");
            $("#dropSpouse").attr('disabled', false);
            $("#numChildText").attr('disabled', false);
        }else if(status == "D"){
		    $("#spouse").html("");
			$("#spousein").html("");
            $("#marital_child").html("Number of Children<span class='red'> *</span>");
            $("#marital_spouse").html("Spouse Working");
            $("#dropSpouse").attr('disabled', true);
            $("#numChildText").attr('disabled', false);
            $("#dropSpouse").val('0');
        }else if(status == "S"){
		    $("#spouse").html("");
			$("#spousein").html("");
            $("#marital_child").html("Number of Children");
            $("#marital_spouse").html("Spouse Working");
            $("#dropSpouse").attr('disabled', true);
            $("#numChildText").attr('disabled', true);
            $("#dropSpouse").val('0');
            $("#numChildText").val('');
        }else{
		    $("#spouse").html("");
			$("#spousein").html("");
            $("#marital_child").html("Number of Children");
            $("#marital_spouse").html("Spouse Working");
            $("#dropSpouse").attr('disabled', false);
            $("#numChildText").attr('disabled', false);
            $("#dropSpouse").val('0');
            $("#numChildText").val('');
        }
    } 

    function selectBranch(company_id){
        $.ajax({
            type:'POST',
            url:'?widget=showcompany',
            data:{
                company_id:company_id
            },
            success:function(data){
                $("#dropBranch").empty().append(data);
                $("#dropDept").empty().append('<option value="0" >--Please Select--</option>');
                $("#dropGroup").empty().append('<option value="0" >--Please Select--</option>');
            }
        })
    }
	
    function selectDept(branch_id){
        $.ajax({
            type:'POST',
            url:'?widget=showdept',
            data:{
                branch_id:branch_id
            },
            success:function(data){
                $("#dropDept").empty().append(data);
                $("#dropGroup").empty().append('<option value="0" >--Please Select--</option>');
            }
        })
    }
    
    function add_field(){
        var field_no =  parseInt($("#field_no").html())+1;
        $("#field_no").html(field_no);
        $('#add_field_table').append("<tr><td style='width: 200px;'><input type='text' id='title_"+field_no+"' /></td><td style='padding-left: 10px;'><input type='text' id='value_"+field_no+"' style='width: 250px;' /></td></tr>");
    }

    function showGroup(){
        var a = document.getElementById("dropDept");
        var dept_id = a.options[a.selectedIndex].value;
        $.ajax({

            type:'POST',
            url:'?widget=showgroup',
            data:{
                dept_id:dept_id
            },
            success:function(data){
                if(data!=false){
                    $("#groupDiv").empty().append(data);
                }
                else{       
                }
            }
        })
    }

    function back(){
        window.location='?loc=home';
    }
	function race(v){
	
	if(v!="Malaysia"){
	
   $('.ic').hide();
   $('.pn').show();
	$('.pe').show();
	$('.wp').show();
	
	$('#ICText1').val("");
	$('#ICText2').val("");
	$('#ICText3').val(""); 
	}else{
	
	$('.pn').hide();
	$('.pe').hide();
	$('.wp').hide();
	$('#pass').val("");
	$('#pe').val("");
	$('#wp').val("");
	$('.ic').show();
	
	}
	}

    function insertData(){
        var name = $('#fullNameText').val();
        var ic1 = $('#ICText1').val();
        var ic2 = $('#ICText2').val();
        var ic3 = $('#ICText3').val();
        var ic = ic1 + "-" + ic2 + "-" +ic3;
		var country=$("#country").val();
		var e_date_pk_fz = $("#e_date_pk_fz").val(); 
		var e_date_westport = $("#e_date_westport").val();
		var e_date_johor_port= $("#e_date_johor_port").val();
		var e_date_ptp = $("#e_date_ptp").val();
		var e_date_tlp = $("#e_date_tlp").val();
		if(country!="Malaysia"){
			ic="0";
		}
		var pn="";
		var pe="";
		var wp="";
		var wpep = "";
		if(ic1 == '' || ic1 == ' ' || ic2 == '' || ic2 == ' ' || ic3 == '' || ic3 == ' '){
			pn=$("#pass").val();
			pe=$("#pe").val();
			wp=$("#wp").val();
			wpep = $("#wpep").val();
		
		}
		
		var salaryGrade = $("#salaryGrade").val();
        var pwd ="123456";
        var phone = $('#phoneText').val();
        var mobile = $('#mobileText').val();
		var emergency = $('#emergencyText').val();
		var contactText=$('#contactText').val();
		var emergencyContactRelationship=$('#emergencyrelationship').val();
		var SpouseName=$('#SpouseName').val();
        var emailAdd = $('#emailAddText').val();
        var mailAdd = $('#mailAddText').val();
        var profile = $('#profileText').val();
        var dob = $('#dobText').val();
        var joinDate = $('#joinDateText').val();
		var confirmDate= $('#confirmDateText').val();
        var bankAcc = $('.bankAccNumText').val();
        var iTax = $('#iTaxText').val();
        var socso = $('#socsoText').val();
        var epf = $('#epfText').val();
        var child = $('#numChildText').val();
        
        var resignDate = $('#resignDateText').val();
		var lastDateText = $('#lastDateText').val();
		var offDateText =$('#offDateText').val();

        var property = $('#propertyText').val();
        var username = $('#usernameText').val();
        var salaryAmt = $('#salaryAmtText').val();
        var zakat = $('#zakatText').val();
		var zakatnum = $('#zakatnum').val();
		
        var note = $('#noteText').val();

        var dept = $("#dropDept").val();
        var position = $("#dropPosition").val(); 
        var group = $("#dropGroup").val();
        var branch = $("#dropBranch").val();
        var gender = $("#dropGender").val();
        var marital = $("#dropMarital").val();
        var spouse = $("#dropSpouse").val();
        var bank = $("#dropBank").val();
        var contract = $("#underContract").val();
        var overtime = $("#dropOvertime").val();
        var religion = $("#dropReligion").val();
        var race = $("#dropRace").val();
        var empstatus = $("#dropempstatus").val();
        var salaryType = $("#dropSalaryType").val();
		var paymentType = $("#paymentType").val();
		var spouse_companyName = $("#company_name").val();
        var s = $("#dropShift").val();
        var leave = $("#dropLeave").val();
        var userpermission = $("#dropUserPermission").val();
        var company_id = $("#dropCompany").val();
        var check_username;
        var num = $("#field_no").html();
        var i;
        var extrainfo = "";
        
        if(num > 0){
            for(i=1; i<=num; i++){
                if($("#title_"+i).val()!="" || $("#value_"+i).val()!=""){
                    extrainfo = extrainfo+$("#title_"+i).val() + "," + $("#value_"+i).val() + ";";
                }
            }
        }
                
        var error1 = [];
        var error2 = [];
        var error3 = [];
		
        
        $.ajax({
            type:'POST',
            url:'?widget=check_username',
            data:{username:username},
            success:function(data){
                check_username = data;
                if(name == '' || name == ' '){
                    error1.push("Full Name");
                }
				if(country=="Malaysia"){
					if(ic1 == '' || ic1 == ' ' || ic2 == '' || ic2 == ' ' || ic3 == '' || ic3 == ' ' || ic1.length < 6 || ic2.length < 2 || ic3.length < 4){
						error1.push("I.C Number");
					}else{
						if(ic1.match(/^\d+$/) && ic2.match(/^\d+$/) && ic3.match(/^\d+$/)){
						}else{
							error2.push("I.C Number");
						}
					}
				}
				if(country==""){
				
				error3.push("Nationality");
				}
				  
				if(ic==""){
				if(pn==""){
					error1.push("Passport Number");
				}
				if(pe==""){
					error1.push("Passport Expiry");
				}
				if(wp==""){
					error1.push("Work Permit");
				}
				if(wpep==""){
					error1.push("Work Permit Expiry");
				}
				
				}
				
                if(mobile == '' || mobile == ' '){
                    error1.push("Mobile Number");
					
                }
				if(emergency== '' || emergency== ' '){emergencyContactRelationship
                    error1.push("Emergency Contact Number");
					
                }
				if(contactText== '' || contactText== ' '){
                    error1.push("Emergency Contact Person");
					
                }
				if(emergencyContactRelationship== '' || emergencyContactRelationship== ' '){
                    error1.push("Emergency Contact Relationship");
					
                }
				
				if(SpouseName== '' || SpouseName== ' '){
                    error1.push("Spouse Name");
					
                }
				
                if(emailAdd == '' || emailAdd == ' '){
                    error1.push("Email Address");
                }
                if(gender == '0'){
                    error3.push("Gender");
                }
                if(race == '0'){
                    error3.push("Race");
                }
                if(religion == '0'){
                    error3.push("Religion");
                }
                if(marital == '0'){
                    error3.push("Marital Status");
                }
                if(spouse == '0' && marital == "M"){
                    error3.push("Spouse Working");
                }
				if(spouse == 'Y' && spouse_companyName == ""){
                    error3.push("Spouse Company Name");
                }
                if((child == "" || child == " ") && (marital == "M" || marital == "D")){
                    error1.push("Number of Children");
                }else{
                    if(child == "" || child == " "){
                        child = 0;
                    }else{
                        if(child.match(/^\d+$/)){
                        }else{
                            error2.push("Number of Children");
                        }
                    }
                }
                if(dob == '' || dob == ' '){
                    error1.push("Date of Birth");
                }
                if(joinDate == '' || joinDate == ' '){
                    error1.push("Join Date");
                }
				if(confirmDate == '' || confirmDate == ' '){
                    error1.push("Confirm Date");
                }
                if(username == '' || username == ' '){
                    error1.push("Username");										
                }else{
                    if(check_username==true){
                        error2.push("Username Existed");
                    }
                }
				
                if(empstatus == "0"){
                    error3.push("Employee Status");
                }
                if(company_id == '0'){
                    error3.push("Company");
                }
                if(branch == '0' || branch == ''){
                    error3.push("Branch");
                }
                if(dept == '0'){
                    error3.push("Department");
                }
                if(group == '0'){
                    error3.push("Section/Unit");
                }
                if(position == '0'){
                    error3.push("Position");
                }
                if(s == "0"){
                    error3.push("Shift");
                }
                if(userpermission == '0'){
                    error3.push("User Permission");
                }
                if(leave == '0' || leave == ''){
                    error3.push("Leave Group");
                }
                if(contract == '0'){
                    error3.push("Employee Type");
                }
                if(salaryType == '0'){
                    error3.push("Salary Type");
                }
				if(paymentType == '0'){
                    error3.push("Payment Type");
                }
				if(paymentType == 'bank' && bank=='0'){
                    error3.push("Bank Type");
                }
				if(paymentType == 'bank' && bankAcc==''){
                    error3.push("Bank Account Number");
                }
                if(salaryAmt == '' || salaryAmt == ' '){
                    error1.push("Salary Amount");
                }else{
                    if(salaryAmt.match(/^\d+$/) || salaryAmt.match(/^[0-9]*\.[0-9]*$/)){
                    }else{
                        error2.push("Salary Amount");
                    }   
                }
                if(zakat != "" && zakat != " "){
                    if(zakat.match(/^\d+$/) || zakat.match(/^[0-9]*\.[0-9]*$/)){
                    }else{
                        error2.push("Zakat Amount");
                    } 
                }
                 
                var error_data1 = '';
                for(var i=0; i< error1.length; i++){
                    error_data1 = error_data1 + error1[i] + "; "
                }
                var error_data2 = '';
                for(var i=0; i< error2.length; i++){
                    error_data2 = error_data2 + error2[i] + "; "
                }
                var error_data3 = '';
                for(var i=0; i< error3.length; i++){
                    error_data3 = error_data3 + error3[i] + "; "
                }
              
                var data1 = "";
                var data2 = "";
                var data3 = "";
                if(error1.length > 0){
                    data1 = "Please Insert :\n"+error_data1+"\n\n";
                }
                if(error2.length > 0){
                    data2 = "Please Check :\n"+error_data2+"\n\n";
                }
                if(error3.length > 0){
                    data3 = "Please Select :\n"+error_data3;
                }
               
                if(error1.length > 0 || error2.length > 0 || error3.length > 0){
				 alert(data1 + data2 + data3);
                    
                }else{
                    $.ajax({
                        type:'POST',
                        url:'?widget=addemployee',
                        data:{
                            contract:contract,
                            name:name,
                            ic:ic,
                            phone:phone,
                            mobile:mobile,
							e_date_pk_fz:e_date_pk_fz,
							e_date_westport:e_date_westport,
							e_date_johor_port:e_date_johor_port,
							e_date_ptp:e_date_ptp,
							e_date_tlp:e_date_tlp,
							emergency:emergency,
							contactText:contactText,
							SpouseName:SpouseName,
                            emailAdd:emailAdd,
                            mailAdd:mailAdd,
                            race:race,
                            profile:profile,
                            dob:dob,
                            joinDate:joinDate,
							confirmDate:confirmDate,
                            resignDate:resignDate,
							lastDateText:lastDateText,
							offDateText:offDateText,
                            bankAcc:bankAcc,
							pn:pn,
							pe:pe,
							wp:wp,
							wpep:wpep,
							country:country,
                            position:position,
                            group:group,
                            branch:branch,
                            company_id:company_id,
                            iTax:iTax,
                            socso:socso,
                            epf:epf,
                            gender:gender,
                            marital:marital,
                            spouse:spouse,
                            bank:bank,
                            child:child,
                            property:property,
                            overtime:overtime,
                            username:username,
                            empstatus:empstatus,
                            religion:religion,
                            dept:dept,
                            salaryType:salaryType,
                            salaryAmt:salaryAmt,
                            zakat:zakat,
							zakatnum :zakatnum ,
                            leave:leave,
                            shift:s,
                            userpermission:userpermission,
                            note:note,
                            extrainfo:extrainfo,
                            pwd:pwd,
							spouse_companyName:spouse_companyName,
							paymentType:paymentType,
							emergencyContactRelationship:emergencyContactRelationship,
							salaryGrade:salaryGrade
                        },
                        success:function(data){
							alert(data);
							$(".main_div").append(data);
							exit();
                            if(data==false){
                                alert('Error While Processing');
                            }else if (data==true){
							alert('IC existed');
							}else{	
                                $('#new_emp_id').val(data);
                                alert('Profile Created Successfully\nPlease Select Property for Employee');
                                popUpProperty();
                            }
                        }
                    })
                }
            }
        });	
    }

   $("#mailAddText").click(function(){
   var em = checkEmail();
   if(em!=false){
   var email=$("#emailAddText").val();
   if(email!="" || email!=" "){
   $("#usernameText").val(email);
    $("#usernameText").attr('disabled', true);
   }
}else{
$("#mailAddText").val("")
$("#usernameText").val();
}
   
   })
   
   function checkEmail() {

    var email = document.getElementById('emailAddText');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
    alert('Please provide a valid email address');
    email.focus;
    return false;
 }
}
    function clearData(){
        window.location='?loc=new_profile';
    }

    function popUpProperty(){
        loadPopupBox();
 
        $('#popupBoxClose').click( function() {
            unloadPopupBox();
        });

        function loadPopupBox() {
            $('#popup_box').fadeIn("slow");
            $("#container").css({ 
                "opacity": "0.3"
            });
        }
    };

    function unloadPopupBox() {
        $('#popup_box').fadeOut("slow");
        $("#container").css({
            "opacity": "1"
        });
    }


    function selectPro(){
        var checkBoxPro = "";
        var type = 'OK';
        checkBoxPro = $("input[name=checkPro]:checked").map(function(){ return this.value; }).get().join(",");

        unloadPopupBox()
		
        if(checkBoxPro){
            $.ajax({
                type:'POST',
                url: '?widget=assignproperty',
                data:{
                    checkBoxPro:checkBoxPro,
                    type:type
                },
                success: function(data) {
                    if(data!=false){
                        alert('Please Select Profile Picture for Employee');
                        mywindow = window.open('?widget=editprofileupload&employeeID='+data,'mywindow','menubar=no,toolbar=no,width=500,height=300,left=500,top=200');
                    }else{
                        alert('Error While Proccess');
                    }
                }
            })
        }else{
            alert('Please Select Profile Picture for Employee');
            var data=$('#new_emp_id').val();
            mywindow = window.open('?widget=editprofileupload&employeeID='+data,'mywindow','menubar=no,toolbar=no,width=500,height=300,left=500,top=200');
        }
    }

    function noSelectPro(){
        unloadPopupBox();
        alert('Please Select Profile Picture for Employee');
        var data=$('#new_emp_id').val();
        mywindow = window.open('?widget=editprofileupload&employeeID='+data,'mywindow','menubar=no,toolbar=no,width=500,height=300,left=500,top=200');
    }

    $(function() {
        $("#joinDateText").datepicker({
		onSelect: function (){
          var j= $("#joinDateText").val();
        },
		onClose: function( selectedDate ) {
    $( "#confirmDateText" ).datepicker( "option", "minDate", selectedDate );
  },
           
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
			
        });
    });
	$(function() {
        $("#confirmDateText").datepicker({
            yearRange: "-60:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });

    $(function() {
        $("#resignDateText").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
	$(function() {
        $("#pe").datepicker({
            changeMonth: true,
            changeYear: true, 
            dateFormat: 'dd-mm-yy',
			minDate: '0'
        });
    });
	$(function() {
        $("#lastDateText").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    }); 
	$(function() {
        $("#offDateText").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
	
	
    $(function() {
	
        $("#dobText, #wpep").datepicker({
           
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
		
		 $("#e_date_pk_fz, #e_date_westport, #e_date_johor_port, #e_date_ptp, #e_date_tlp").datepicker({
           
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
			minDate: '0'
        });
		
    });
	 

</script>

<style type="text/css">


    /* popup_box DIV-Styles*/
    #popup_box {
        display:none; /* Hide the DIV */
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:300px;  
        width:600px;  
        background:#FFFFFF;  
        left: 300px;
        top: 150px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        margin-left: 15px;  	
        /* additional features, can be omitted */
        /*        border:2px solid #ff0000;  */
        border:10px solid #C4C4C7;
        padding:15px;  
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;
    }

    #container {
        width:100%;
        height:100%;
    }

    a{
        cursor: pointer;
        text-decoration:none;
    }

    /* This is for the positioning of the Close Link */
    #popupBoxClose {
        font-size:20px;
        line-height:15px;
        right:5px;
        top:5px;
        position:absolute;
        color:#6fa5e2;
        font-weight:500;
    }

</style>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>