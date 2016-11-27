<section class="bg-white">
  <div class="container">
    <div class="row">
      <div id="main">

      <h2>Application to Rent</h2>













          <form action="https://mhmprop.oap.rentmanager.com/WebApplicationHandler" method="post" id="mhm-testapp2" name="mhm-testapp2" onsubmit="return validateForm()">

            <div class="col-lg-12">
              <h3>Application Date: [[DATE]]</h3>

              <div class="col-lg-12">
                <span>Lease Year:</span>
                <select id="rentapp_leaseyear" name="rmwebsvc_pudf_Lease_Year">
                  <option value="2017-18" selected="selected">2017-18</option>
                  <option value="2016-17">2016-17</option>
                </select>
              </div>

              <div class="col-lg-6">
                <span >Property of Interest:</span>
                <select id="rentapp_prop_of_interest" name="rmwebsvc_propshortname">
                  <option value="" selected="selected">Select...</option>
                  <option value="Daniel">101 E. Daniel St.</option>
                  <option value="Busey">101 S. Busey St.</option>
                  <option value="H-Armory">101 E. Armory St.</option>
                  <option value="Horizn">102 S. Lincoln Ave.</option>
                  <option value="Fourth">203 S. Fourth St.</option>
                  <option value="Sixth">205 S. Sixth St.</option>
                  <option value="FW">303 S. Fifth St.</option>
                  <option value="C311">311 E. Clark St.</option>
                  <option value="CF">314 E. Clark St.</option>
                  <option value="H-John">61 E. John St.</option>
                  <option value="Beckmn">605 E. Clark St.</option>
                  <option value="White">606 E. White St.</option>
                  <option value="H-First">803 S. First St.</option>
                  <option value="LsHs">803 S. Locust</option>
                  <option value="LsApt">805 S. Locust</option>
                  <option value="Oak">808 S. Oak St.</option>
                  <option value="Z-1711A">1711 Harrington</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              
              <div class="col-lg-6">
                <span>Apt #:</span>
                <input id="rmwebsvc_pudf_Unit_Interest" name="rmwebsvc_pudf_Unit_Interest" size="10" type="text">
                <span>(if known)</span>
              </div>

            </div>
            <!--#App date plus term-->


            <div class="col-lg-6">
              <h4 class="bg-light-purple">Personal Information</h4>

              <div class="col-lg-6">First Name*:</div>                <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Last Name*:</div>                 <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Date of Birth:</div>              <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Email:</div>                      <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">CellPhone:</div>                  <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">SSN(Last 4):</div>                <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">UIN:</div>                        <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Driver's License/State ID#:</div> <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">ID Issuing State:</div>           <div class="col-lg-6"><select name="">
                  <option value="" selected="selected">Select State...</option>
                  <option value="None">N/A</option>
                  <option value="AL">Alabama</option>
                  <option value="AK">Alaska</option>
                  <option value="AZ">Arizona</option>
                  <option value="AR">Arkansas</option>
                  <option value="CA">California</option>
                  <option value="CO">Colorado</option>
                  <option value="CT">Connecticut</option>
                  <option value="DE">Delaware</option>
                  <option value="DC">District Of Columbia</option>
                  <option value="FL">Florida</option>
                  <option value="GA">Georgia</option>
                  <option value="HI">Hawaii</option>
                  <option value="ID">Idaho</option>
                  <option value="IL">Illinois</option>
                  <option value="IN">Indiana</option>
                  <option value="IA">Iowa</option>
                  <option value="KS">Kansas</option>
                  <option value="KY">Kentucky</option>
                  <option value="LA">Louisiana</option>
                  <option value="ME">Maine</option>
                  <option value="MD">Maryland</option>
                  <option value="MA">Massachusetts</option>
                  <option value="MI">Michigan</option>
                  <option value="MN">Minnesota</option>
                  <option value="MS">Mississippi</option>
                  <option value="MO">Missouri</option>
                  <option value="MT">Montana</option>
                  <option value="NE">Nebraska</option>
                  <option value="NV">Nevada</option>
                  <option value="NH">New Hampshire</option>
                  <option value="NJ">New Jersey</option>
                  <option value="NM">New Mexico</option>
                  <option value="NY">New York</option>
                  <option value="NC">North Carolina</option>
                  <option value="ND">North Dakota</option>
                  <option value="OH">Ohio</option>
                  <option value="OK">Oklahoma</option>
                  <option value="OR">Oregon</option>
                  <option value="PA">Pennsylvania</option>
                  <option value="RI">Rhode Island</option>
                  <option value="SC">South Carolina</option>
                  <option value="SD">South Dakota</option>
                  <option value="TN">Tennessee</option>
                  <option value="TX">Texas</option>
                  <option value="UT">Utah</option>
                  <option value="VT">Vermont</option>
                  <option value="VA">Virginia</option>
                  <option value="WA">Washington</option>
                  <option value="WV">West Virginia</option>
                  <option value="WI">Wisconsin</option>
                  <option value="WY">Wyoming</option>
                  <option value="AS">American Samoa</option>
                  <option value="GU">Guam</option>
                  <option value="MP">Northern Mariana Islands</option>
                  <option value="PR">Puerto Rico</option>
                  <option value="UM">United States Minor Outlying Islands</option>
                  <option value="VI">Virgin Islands</option>
                  <option value="Other">Other</option>
                </select></div>
              <div class="col-lg-6">Car(Year-Make-Model):</div>       <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Car License Plate #:</div>        <div class="col-lg-6"><input type="text" name="" required></div>

            </div>

            <div class="col-lg-6">
              <h4 class="bg-light-purple">Present / Current Address (Where you live Now)</h4>

              <div class="col-lg-6">Street:</div>                   <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">City:</div>                     <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">State:</div>                    <div class="col-lg-6"><select name="">
                  <option value="" selected="selected">Select State...</option>
                  <option value="None">N/A</option>
                  <option value="AL">Alabama</option>
                  <option value="AK">Alaska</option>
                  <option value="AZ">Arizona</option>
                  <option value="AR">Arkansas</option>
                  <option value="CA">California</option>
                  <option value="CO">Colorado</option>
                  <option value="CT">Connecticut</option>
                  <option value="DE">Delaware</option>
                  <option value="DC">District Of Columbia</option>
                  <option value="FL">Florida</option>
                  <option value="GA">Georgia</option>
                  <option value="HI">Hawaii</option>
                  <option value="ID">Idaho</option>
                  <option value="IL">Illinois</option>
                  <option value="IN">Indiana</option>
                  <option value="IA">Iowa</option>
                  <option value="KS">Kansas</option>
                  <option value="KY">Kentucky</option>
                  <option value="LA">Louisiana</option>
                  <option value="ME">Maine</option>
                  <option value="MD">Maryland</option>
                  <option value="MA">Massachusetts</option>
                  <option value="MI">Michigan</option>
                  <option value="MN">Minnesota</option>
                  <option value="MS">Mississippi</option>
                  <option value="MO">Missouri</option>
                  <option value="MT">Montana</option>
                  <option value="NE">Nebraska</option>
                  <option value="NV">Nevada</option>
                  <option value="NH">New Hampshire</option>
                  <option value="NJ">New Jersey</option>
                  <option value="NM">New Mexico</option>
                  <option value="NY">New York</option>
                  <option value="NC">North Carolina</option>
                  <option value="ND">North Dakota</option>
                  <option value="OH">Ohio</option>
                  <option value="OK">Oklahoma</option>
                  <option value="OR">Oregon</option>
                  <option value="PA">Pennsylvania</option>
                  <option value="RI">Rhode Island</option>
                  <option value="SC">South Carolina</option>
                  <option value="SD">South Dakota</option>
                  <option value="TN">Tennessee</option>
                  <option value="TX">Texas</option>
                  <option value="UT">Utah</option>
                  <option value="VT">Vermont</option>
                  <option value="VA">Virginia</option>
                  <option value="WA">Washington</option>
                  <option value="WV">West Virginia</option>
                  <option value="WI">Wisconsin</option>
                  <option value="WY">Wyoming</option>
                  <option value="AS">American Samoa</option>
                  <option value="GU">Guam</option>
                  <option value="MP">Northern Mariana Islands</option>
                  <option value="PR">Puerto Rico</option>
                  <option value="UM">United States Minor Outlying Islands</option>
                  <option value="VI">Virgin Islands</option>
                  <option value="Other">Other</option>
                </select></div>
              <div class="col-lg-6">Zip Code:</div>                 <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Country:</div>                  <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">How Long At this Address:</div> <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Current Landlord:</div>         <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Landlord's Address:</div>       <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Landlord's Phone:</div>         <div class="col-lg-6"><input type="text" name="" required></div>
            </div>

            <div class="col-lg-12 b-b-ddd">

              <br>
              <br>
              <br>
            </div>



<!--            <table width="100%" cellspacing="2" cellpadding="2" border="0">-->
<!--              <tbody>-->
<!---->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333"></font></td>-->
<!--                <td width="25%"><font color="#333333"><input id="first_name" name="rmwebsvc_fname" size="20" type="text"></font></td>-->
<!--                <td width="25%"><font color="#333333">Street:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <textarea name="rmwebsvc_pudf_Current_Address_Street1" id="rentapp_present_address1" cols="25" rows="2"></textarea>-->
<!--                  </font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">Last Name*:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_last_name" name="rmwebsvc_lname" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td width="25%"><font color="#333333">City:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_present_city" name="rmwebsvc_pudf_Current_Address_City" size="20" type="text">-->
<!--                  </font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">Date of Birth*:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_dob" name="rmwebsvc_bdate" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td width="25%"><font color="#333333">State:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <select id="rentapp_present_state" name="rmwebsvc_pudf_Current_Address_State">-->
<!--                      <option value="" selected="selected">Select State...</option>-->
<!--                      <option value="None">N/A</option>-->
<!--                      <option value="AL">Alabama</option>-->
<!--                      <option value="AK">Alaska</option>-->
<!--                      <option value="AZ">Arizona</option>-->
<!--                      <option value="AR">Arkansas</option>-->
<!--                      <option value="CA">California</option>-->
<!--                      <option value="CO">Colorado</option>-->
<!--                      <option value="CT">Connecticut</option>-->
<!--                      <option value="DE">Delaware</option>-->
<!--                      <option value="DC">District Of Columbia</option>-->
<!--                      <option value="FL">Florida</option>-->
<!--                      <option value="GA">Georgia</option>-->
<!--                      <option value="HI">Hawaii</option>-->
<!--                      <option value="ID">Idaho</option>-->
<!--                      <option value="IL">Illinois</option>-->
<!--                      <option value="IN">Indiana</option>-->
<!--                      <option value="IA">Iowa</option>-->
<!--                      <option value="KS">Kansas</option>-->
<!--                      <option value="KY">Kentucky</option>-->
<!--                      <option value="LA">Louisiana</option>-->
<!--                      <option value="ME">Maine</option>-->
<!--                      <option value="MD">Maryland</option>-->
<!--                      <option value="MA">Massachusetts</option>-->
<!--                      <option value="MI">Michigan</option>-->
<!--                      <option value="MN">Minnesota</option>-->
<!--                      <option value="MS">Mississippi</option>-->
<!--                      <option value="MO">Missouri</option>-->
<!--                      <option value="MT">Montana</option>-->
<!--                      <option value="NE">Nebraska</option>-->
<!--                      <option value="NV">Nevada</option>-->
<!--                      <option value="NH">New Hampshire</option>-->
<!--                      <option value="NJ">New Jersey</option>-->
<!--                      <option value="NM">New Mexico</option>-->
<!--                      <option value="NY">New York</option>-->
<!--                      <option value="NC">North Carolina</option>-->
<!--                      <option value="ND">North Dakota</option>-->
<!--                      <option value="OH">Ohio</option>-->
<!--                      <option value="OK">Oklahoma</option>-->
<!--                      <option value="OR">Oregon</option>-->
<!--                      <option value="PA">Pennsylvania</option>-->
<!--                      <option value="RI">Rhode Island</option>-->
<!--                      <option value="SC">South Carolina</option>-->
<!--                      <option value="SD">South Dakota</option>-->
<!--                      <option value="TN">Tennessee</option>-->
<!--                      <option value="TX">Texas</option>-->
<!--                      <option value="UT">Utah</option>-->
<!--                      <option value="VT">Vermont</option>-->
<!--                      <option value="VA">Virginia</option>-->
<!--                      <option value="WA">Washington</option>-->
<!--                      <option value="WV">West Virginia</option>-->
<!--                      <option value="WI">Wisconsin</option>-->
<!--                      <option value="WY">Wyoming</option>-->
<!--                      <option value="AS">American Samoa</option>-->
<!--                      <option value="GU">Guam</option>-->
<!--                      <option value="MP">Northern Mariana Islands</option>-->
<!--                      <option value="PR">Puerto Rico</option>-->
<!--                      <option value="UM">United States Minor Outlying Islands</option>-->
<!--                      <option value="VI">Virgin Islands</option>-->
<!--                      <option value="Other">Other</option>-->
<!--                    </select>-->
<!--                  </font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">E-mail*:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_email" name="rmwebsvc_email" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td width="25%"><font color="#333333">Zip Code:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_present_zip" name="rmwebsvc_pudf_Current_Address_Zip" size="20" type="text">-->
<!--                  </font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">Cell Phone*:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_cell_phone" name="rmwebsvc_carphone" size="20" type="text">-->
<!--                    <span id="smallexample"><br>-->
<!--                (format: xxx-xxx-xxxx)</span></font></td>-->
<!--                <td width="25%"><font color="#333333">Country</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_present_country" name="rmwebsvc_pudf_Current_Address_Country" size="20" type="text">-->
<!--                  </font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">SSN (Last 4 Digits):</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_ssn" maxlength="4" name="rmwebsvc_pudf_SSN4" size="5" type="text">-->
<!--                  </font></td>-->
<!--                <td width="25%"><font color="#333333">How Long At this Address:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_present_duration" name="rmwebsvc_pudf_How_Long" size="20" type="text">-->
<!--                  </font></td>-->
<!--              </tr>-->
<!---->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">UIN:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_uin" name="rmwebsvc_pudf_UIN" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td width="25%"><font color="#333333">Current Landlord:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_present_landlord" name="rmwebsvc_pudf_Landlord_current" size="20" type="text">-->
<!--                  </font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">Driver's License / State ID #:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_drivers_license" name="rmwebsvc_pudf_Drivers_License" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td width="25%"><font color="#333333">Landlord's Address:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_present_landlord_address" name="rmwebsvc_pudf_Landlord_Address" size="20" type="text">-->
<!--                  </font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">ID Issuing State:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <select id="rentapp_dl_issuing_state" name="rmwebsvc_pudf_ID_State">-->
<!--                      <option value="" selected="selected">Select State...</option>-->
<!--                      <option value="None">N/A</option>-->
<!--                      <option value="AL">Alabama</option>-->
<!--                      <option value="AK">Alaska</option>-->
<!--                      <option value="AZ">Arizona</option>-->
<!--                      <option value="AR">Arkansas</option>-->
<!--                      <option value="CA">California</option>-->
<!--                      <option value="CO">Colorado</option>-->
<!--                      <option value="CT">Connecticut</option>-->
<!--                      <option value="DE">Delaware</option>-->
<!--                      <option value="DC">District Of Columbia</option>-->
<!--                      <option value="FL">Florida</option>-->
<!--                      <option value="GA">Georgia</option>-->
<!--                      <option value="HI">Hawaii</option>-->
<!--                      <option value="ID">Idaho</option>-->
<!--                      <option value="IL">Illinois</option>-->
<!--                      <option value="IN">Indiana</option>-->
<!--                      <option value="IA">Iowa</option>-->
<!--                      <option value="KS">Kansas</option>-->
<!--                      <option value="KY">Kentucky</option>-->
<!--                      <option value="LA">Louisiana</option>-->
<!--                      <option value="ME">Maine</option>-->
<!--                      <option value="MD">Maryland</option>-->
<!--                      <option value="MA">Massachusetts</option>-->
<!--                      <option value="MI">Michigan</option>-->
<!--                      <option value="MN">Minnesota</option>-->
<!--                      <option value="MS">Mississippi</option>-->
<!--                      <option value="MO">Missouri</option>-->
<!--                      <option value="MT">Montana</option>-->
<!--                      <option value="NE">Nebraska</option>-->
<!--                      <option value="NV">Nevada</option>-->
<!--                      <option value="NH">New Hampshire</option>-->
<!--                      <option value="NJ">New Jersey</option>-->
<!--                      <option value="NM">New Mexico</option>-->
<!--                      <option value="NY">New York</option>-->
<!--                      <option value="NC">North Carolina</option>-->
<!--                      <option value="ND">North Dakota</option>-->
<!--                      <option value="OH">Ohio</option>-->
<!--                      <option value="OK">Oklahoma</option>-->
<!--                      <option value="OR">Oregon</option>-->
<!--                      <option value="PA">Pennsylvania</option>-->
<!--                      <option value="RI">Rhode Island</option>-->
<!--                      <option value="SC">South Carolina</option>-->
<!--                      <option value="SD">South Dakota</option>-->
<!--                      <option value="TN">Tennessee</option>-->
<!--                      <option value="TX">Texas</option>-->
<!--                      <option value="UT">Utah</option>-->
<!--                      <option value="VT">Vermont</option>-->
<!--                      <option value="VA">Virginia</option>-->
<!--                      <option value="WA">Washington</option>-->
<!--                      <option value="WV">West Virginia</option>-->
<!--                      <option value="WI">Wisconsin</option>-->
<!--                      <option value="WY">Wyoming</option>-->
<!--                      <option value="AS">American Samoa</option>-->
<!--                      <option value="GU">Guam</option>-->
<!--                      <option value="MP">Northern Mariana Islands</option>-->
<!--                      <option value="PR">Puerto Rico</option>-->
<!--                      <option value="UM">United States Minor Outlying Islands</option>-->
<!--                      <option value="VI">Virgin Islands</option>-->
<!--                      <option value="Other">Other</option>-->
<!--                    </select>-->
<!--                  </font></td>-->
<!--                <td width="25%"><font color="#333333">Landlord's Phone:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_present_landlord_phone" name="rmwebsvc_pudf_Landlord_Phone" size="20" type="text">-->
<!--                  </font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td>Car <font size="2">(Year-Make-Model)</font></td>-->
<!--                <td><font color="#333333">-->
<!--                    <input id="rentapp_car_desc" name="rmwebsvc_pudf_Car_Description" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td width="25%">&nbsp;</td>-->
<!--                <td width="25%">&nbsp;</td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td><font color="#333333">Car License Plate #</font></td>-->
<!--                <td><font color="#333333">-->
<!--                    <input id="rentapp_car_license" name="rmwebsvc_pudf_Car_License_No" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td width="25%">&nbsp;</td>-->
<!--                <td width="25%">&nbsp;</td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%">&nbsp;</td>-->
<!--                <td width="25%">&nbsp;</td>-->
<!--                <td colspan="2" bgcolor="#66CCFF"><font color="#333333"><strong>Employer Information</strong></font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td colspan="2" bgcolor="#66CCFF"><font color="#333333"><strong>Permanent / Home Address</strong></font></td>-->
<!--                <td width="25%"><font color="#333333">Employer:</font></td>-->
<!--                <td width="25%"><font color="#333333"><input id="rentapp_employer" name="rmwebsvc_employer" size="20" type="text"></font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">Parent/Gaurdian Name:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_nearest_rel_name" name="rmwebsvc_pudf_Parent_Name" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td width="25%"><font color="#333333">Employer's Address</font></td>-->
<!--                <td width="25%"><font color="#333333"><input id="rentapp_employer_address" name="rmwebsvc_pudf_Employer_Address" size="20" type="text"></font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">Relation</font></td>-->
<!--                <td width="25%"><font color="#333333"><input id="rentapp_nearest_rel" name="rmwebsvc_pudf_Relation" size="20" type="text"></font></td>-->
<!--                <td width="25%"><font color="#333333">Employer's Phone:</font></td>-->
<!--                <td width="25%"><font color="#333333"><input id="rentapp_employer_phone" name="rmwebsvc_pudf_Employer_Phone" size="20" type="text"></font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">Street:</font></td>-->
<!--                <td width="25%"><font color="#333333"><textarea name="rmwebsvc_pudf_Address_Parent_Street" id="rentapp_permanent_address" cols="25" rows="2"></textarea>-->
<!--                  </font>-->
<!--                </td>-->
<!--                <td width="25%">&nbsp;</td>-->
<!--                <td width="25%">&nbsp;</td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">City:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_permanent_city" name="rmwebsvc_pudf_Address_Parent_City" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td colspan="2" bgcolor="#66CCFF"><font color="#333333"><strong>Additional Information</strong></font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">State:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <select id="rentapp_permanent_state" name="rmwebsvc_pudf_Address_Parent_State">-->
<!--                      <option value="" selected="selected">Select State...</option>-->
<!--                      <option value="None">N/A</option>-->
<!--                      <option value="AL">Alabama</option>-->
<!--                      <option value="AK">Alaska</option>-->
<!--                      <option value="AZ">Arizona</option>-->
<!--                      <option value="AR">Arkansas</option>-->
<!--                      <option value="CA">California</option>-->
<!--                      <option value="CO">Colorado</option>-->
<!--                      <option value="CT">Connecticut</option>-->
<!--                      <option value="DE">Delaware</option>-->
<!--                      <option value="DC">District Of Columbia</option>-->
<!--                      <option value="FL">Florida</option>-->
<!--                      <option value="GA">Georgia</option>-->
<!--                      <option value="HI">Hawaii</option>-->
<!--                      <option value="ID">Idaho</option>-->
<!--                      <option value="IL">Illinois</option>-->
<!--                      <option value="IN">Indiana</option>-->
<!--                      <option value="IA">Iowa</option>-->
<!--                      <option value="KS">Kansas</option>-->
<!--                      <option value="KY">Kentucky</option>-->
<!--                      <option value="LA">Louisiana</option>-->
<!--                      <option value="ME">Maine</option>-->
<!--                      <option value="MD">Maryland</option>-->
<!--                      <option value="MA">Massachusetts</option>-->
<!--                      <option value="MI">Michigan</option>-->
<!--                      <option value="MN">Minnesota</option>-->
<!--                      <option value="MS">Mississippi</option>-->
<!--                      <option value="MO">Missouri</option>-->
<!--                      <option value="MT">Montana</option>-->
<!--                      <option value="NE">Nebraska</option>-->
<!--                      <option value="NV">Nevada</option>-->
<!--                      <option value="NH">New Hampshire</option>-->
<!--                      <option value="NJ">New Jersey</option>-->
<!--                      <option value="NM">New Mexico</option>-->
<!--                      <option value="NY">New York</option>-->
<!--                      <option value="NC">North Carolina</option>-->
<!--                      <option value="ND">North Dakota</option>-->
<!--                      <option value="OH">Ohio</option>-->
<!--                      <option value="OK">Oklahoma</option>-->
<!--                      <option value="OR">Oregon</option>-->
<!--                      <option value="PA">Pennsylvania</option>-->
<!--                      <option value="RI">Rhode Island</option>-->
<!--                      <option value="SC">South Carolina</option>-->
<!--                      <option value="SD">South Dakota</option>-->
<!--                      <option value="TN">Tennessee</option>-->
<!--                      <option value="TX">Texas</option>-->
<!--                      <option value="UT">Utah</option>-->
<!--                      <option value="VT">Vermont</option>-->
<!--                      <option value="VA">Virginia</option>-->
<!--                      <option value="WA">Washington</option>-->
<!--                      <option value="WV">West Virginia</option>-->
<!--                      <option value="WI">Wisconsin</option>-->
<!--                      <option value="WY">Wyoming</option>-->
<!--                      <option value="AS">American Samoa</option>-->
<!--                      <option value="GU">Guam</option>-->
<!--                      <option value="MP">Northern Mariana Islands</option>-->
<!--                      <option value="PR">Puerto Rico</option>-->
<!--                      <option value="UM">United States Minor Outlying Islands</option>-->
<!--                      <option value="VI">Virgin Islands</option>-->
<!--                      <option value="Other">Other</option>-->
<!--                    </select>-->
<!--                  </font></td>-->
<!--                <td width="25%"><font color="#333333">Ever Been Evicted?*</font></td>-->
<!--                <td width="25%"><font color="#333333"><select id="rentapp_been_evicted" name="rmwebsvc_pudf_Evicted">-->
<!--                      <option value="">Select...</option>-->
<!--                      <option value="No">No</option>-->
<!--                      <option value="Yes">Yes</option>-->
<!--                    </select></font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">Zip Code:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_permanent_zip" name="rmwebsvc_pudf_Address_Parent_Zip" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td width="25%"><font color="#333333">Will you be a Subtenant?</font></td>-->
<!--                <td width="25%"><font color="#333333"><select id="rentapp_subtenant" name="rmwebsvc_pudf_Subtenant">-->
<!--                      <option value="No" selected="selected">No</option>-->
<!--                      <option value="Yes">Yes</option>-->
<!--                    </select></font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">Country:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_permanent_country" name="rmwebsvc_pudf_Address_Parent_Country" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td width="25%"><font color="#333333">How did you find us?*</font></td>-->
<!--                <td width="25%"><font color="#333333"><select id="rentapp_how_find_us" name="rmwebsvc_pudf_Find">-->
<!--                      <option value="" selected="selected">Select...</option>-->
<!--                      <option value="CurrentTenant">I am a current Tenant</option>-->
<!--                      <option value="PastTenant">I was a past Tenant</option>-->
<!--                      <option value="Google">Google Search</option>-->
<!--                      <option value="Facebook">Facebook</option>-->
<!--                      <option value="Friend-Referral">Friend / Referral</option>-->
<!--                      <option value="Walk-In">Walk-In</option>-->
<!--                      <option value="BuildingSign">Sign/Ad on Building</option>-->
<!--                      <option value="DailyIllini">Daily Illini</option>-->
<!--                      <option value="TenantUnion">Tenant Union</option>-->
<!--                      <option value="HousingFair">Housing Fair</option>-->
<!--                      <option value="Craigslist">Craigslist</option>-->
<!--                      <option value="Rent.com">Rent.com</option>-->
<!--                      <option value="ApartmentGuide">ApartmentGuide.com</option>-->
<!--                      <option value="Bus">Commuter Bus Advertising</option>-->
<!--                      <option value="Other">Other</option>-->
<!--                    </select></font></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td width="25%"><font color="#333333">Phone:</font></td>-->
<!--                <td width="25%"><font color="#333333">-->
<!--                    <input id="rentapp_permanent_phone" name="rmwebsvc_pudf_Parent_Phone_Number" size="20" type="text">-->
<!--                  </font></td>-->
<!--                <td>&nbsp;</td>-->
<!--                <td>&nbsp;</td>-->
<!--              </tr>-->
<!---->
<!--              <tr>-->
<!--                <td>&nbsp;</td>-->
<!--                <td>&nbsp;</td>-->
<!--                <td>&nbsp;</td>-->
<!--                <td>&nbsp;</td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td valign="top" bgcolor="#D6D6D6"><font color="#333333">Security Phrase:</font></td>-->
<!--                <td colspan="3" bgcolor="#D6D6D6"><p><font color="#333333">-->
<!---->
<!---->
<!---->
<!---->
<!--                      <img src="https://mhmprop.captcha.rentmanager.com/CaptchaImage?key=obX23aCfSWPxO169uIQ4iQ%3d%3dLgDOPsRNpOe33UBYms3D2q2W%2f3i7AEjC8ogIc7se8wVjJ4qLle9M2ecgYUCvdcD8jmAxf7m0PklMKgfcVFzoEuxxgxhmSEpB7rOB2XGBiTtYZv5%2bkj30edcQDSMV%2fNqbGdG1mTWI1l%2fq0pFa0JAs3uALaXri0VrQ82R0JtYcmP%2bDkJ2GWwEH%2bZh7vd12gCH60qVT%2fjW%2bNAluqT33U9%2fB0gBceEy85TKXDAP%2f4TSf%2fYOyfyQP7QHS4wDDTCuJfFH6k%2fDF4B29Sf2ECTG2D21%2ffsibB5FRXW3MQr0Ae%2bzf0zc%3d"><br>-->
<!--                      <input name="CaptchaChallenge" id="CaptchaChallenge" type="text">-->
<!--                      <font size="2">(Enter Phrase Above)</font></font>-->
<!--                    <font color="#333333"><input name="CaptchaKey" value="Vc%2fnRaZxEERxj4GH6nPpVA%3d%3dcpCfNKWAA974kvDXeaagFQ%3d%3d" type="hidden">-->
<!--                    </font></p></td>-->
<!--              </tr>-->
<!--              </tbody></table>-->
<!--            <div align="center">-->
<!--              <p><font color="#333333"><br>-->
<!--                  <input name="rmwebsvc_redirectpage" id="rmwebsvc_redirectpage" value="http://www.mhmproperties.com/rentapp/index.php?rma=success" type="hidden">-->
<!--                  <input name="rmwebsvc_failedpage" id="rmwebsvc_failedpage" value="http://www.mhmproperties.com/rentapp/index.php?rma=failed" type="hidden">-->
<!--                  <input class="buttons" name="submit" value="Submit Application to Rent" id="submit" style=" border : solid 1px #000000; border-radius : 3px;-->
<!--        moz-border-radius : 3px;-->
<!--        -webkit-box-shadow : 0px 2px 2px rgba(0,0,0,0.4);-->
<!--        -moz-box-shadow : 0px 2px 2px rgba(0,0,0,0.4);-->
<!--        box-shadow : 0px 2px 2px rgba(0,0,0,0.4);-->
<!--        font-size : 20px;-->
<!--        color : #ffffff;-->
<!--        padding : 2px 20px;-->
<!--        background-color : #4183d9;-->
<!---->
<!--      }" type="submit">-->
<!--                </font></p>-->
<!--            </div>-->
            <div class="col-lg-4 text-center">
              <input class="btn btn-submit" name="submit" value="Submit" type="submit">
            </div>
          </form>










      </div>
    </div>
  </div>
</section>