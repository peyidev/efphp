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


            <div class="col-lg-6">
              <h4 class="bg-light-purple">Permanent / Home Address</h4>

              <div class="col-lg-6">Parent/Gaurdian Name:</div>  <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Relation:</div>              <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Street:</div>                <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">City:</div>                  <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">State:</div>                 <div class="col-lg-6"><select  name="">
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
              <div class="col-lg-6">Zip Code:</div>              <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Country:</div>               <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Phone:</div>                 <div class="col-lg-6"><input type="text" name="" required></div>

            </div>
            <div class="col-lg-6">
              <h4 class="bg-light-purple">Employer Information</h4>

              <div class="col-lg-6">Employer:</div>            <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Employer's Address</div>   <div class="col-lg-6"><input type="text" name="" required></div>
              <div class="col-lg-6">Employer's Phone:</div>    <div class="col-lg-6"><input type="text" name="" required></div>
            </div>

            <div class="col-lg-6">
              <h4 class="bg-light-purple">Additional Information</h4>

              <div class="col-lg-6">Ever Been Evicted?*:</div>         <div class="col-lg-6"><select >
                  <option value="">Select...</option>
                  <option value="No">No</option>
                  <option value="Yes">Yes</option>
                </select></div>
              <div class="col-lg-6">Will you be a Subtenant?</div>     <div class="col-lg-6"><select>
                  <option value="No" selected="selected">No</option>
                  <option value="Yes">Yes</option>
                </select></div>
              <div class="col-lg-6">How did you find us?*</div>        <div class="col-lg-6"><select>
                  <option value="" selected="selected">Select...</option>
                  <option value="CurrentTenant">I am a current Tenant</option>
                  <option value="PastTenant">I was a past Tenant</option>
                  <option value="Google">Google Search</option>
                  <option value="Facebook">Facebook</option>
                  <option value="Friend-Referral">Friend / Referral</option>
                  <option value="Walk-In">Walk-In</option>
                  <option value="BuildingSign">Sign/Ad on Building</option>
                  <option value="DailyIllini">Daily Illini</option>
                  <option value="TenantUnion">Tenant Union</option>
                  <option value="HousingFair">Housing Fair</option>
                  <option value="Craigslist">Craigslist</option>
                  <option value="Rent.com">Rent.com</option>
                  <option value="ApartmentGuide">ApartmentGuide.com</option>
                  <option value="Bus">Commuter Bus Advertising</option>
                  <option value="Other">Other</option>
                </select></div>
            </div>


            <div class="col-lg-12 b-b-ddd">

              <br>
              <br>
              <br>
            </div>


            <div class="col-lg-4 text-center">
              <input class="btn btn-submit" name="submit" value="Submit Aplication to Rent" type="submit">
            </div>
          </form>










      </div>
    </div>
  </div>
</section>