<section class="bg-white p-d-xl">
  <div class="container bg-f6 p-d-xl">
    <!--    <div class="container bg-f6 p-d-xl animate-in">-->

    <h2 class="p-l-md slider-sun">Move-In Condition Report</h2>
    <form id="mhm-movein-report" name="mhm-testapp2" class="slider-sun">
      <!--#Part 1-->
      <div class="col-lg-12" id="credentials-div">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
          <br>
          <div class="col-lg-3"><span>First Name</span></div>
          <div class="col-lg-9"><input type="text" name="fname" placeholder="First Name" id="fname" required></div>

          <div class="col-lg-3 m-t-md"><span>Last Name</span></div>
          <div class="col-lg-9 m-t-md"><input type="text" name="lname" placeholder="Last Name" id="lname" required></div>

          <div class="col-lg-12">
            <br>
            <span>Property of Interest:</span>
            <select name="property_of_interest" id="propname" required>
              <option value="" selected="selected">Select...</option>
              <option value="101 E. Daniel St.">101 E. Daniel St.</option>
              <option value="101 S. Busey St.">101 S. Busey St.</option>
              <option value="101 E. Armory St.">101 E. Armory St.</option>
              <option value="102 S. Lincoln Ave.">102 S. Lincoln Ave.</option>
              <option value="203 S. Fourth St.">203 S. Fourth St.</option>
              <option value="205 S. Sixth St.">205 S. Sixth St.</option>
              <option value="303 S. Fifth St.">303 S. Fifth St.</option>
              <option value="311 E. Clark St.">311 E. Clark St.</option>
              <option value="314 E. Clark St.">314 E. Clark St.</option>
              <option value="61 E. John St.">61 E. John St.</option>
              <option value="605 E. Clark St.">605 E. Clark St.</option>
              <option value="606 E. White St.">606 E. White St.</option>
              <option value="803 S. First St.">803 S. First St.</option>
              <option value="803 S. Locust<">803 S. Locust</option>
              <option value="805 S. Locust">805 S. Locust</option>
              <option value="808 S. Oak St.">808 S. Oak St.</option>
              <option value="1711 Harrington">1711 Harrington</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="col-lg-12">
            <br>
            <span>Apt #:</span>
            <input name="apt_number" type="text" id="aptname" required>
          </div>

          <div class="col-lg-12">
            <br>
            <button class="btn btn-submit next-size pull-right" id="next-btn-micr">Next <i class="fa fa-arrow-right"></i></button>
          </div>


        </div>
        <div class="col-lg-3"></div>
      </div>


      <!--#Part 2(top-left)-->
      <div class="col-lg-12 no-display" id="move-in-form">
        <p>
          The Lessee(s) accepts responsibility for the condition of the unit “AS IS” with any exceptions listed below: <br>
          (Please describe any defects precisely, including location, size, etc.  Vague generalities are unacceptable.)
        </p>
        <!--Living Room-->
        <div class="row m-b-lg">
          <div class="col-lg-3"><b>Living Room</b></div>
          <div class="col-lg-1">Good</div>
          <div class="col-lg-1">Fair</div>
          <div class="col-lg-1">Poor</div>
          <div class="col-lg-6">If Poor, Explain</div>
        </div>
        <div class="row">
          <div class="col-lg-3">Walls & Doors</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="lr-walls"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="lr-walls"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="lr-walls"></div>
          <div class="col-lg-6"><input type="text" name="lr-walls-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Ceiling</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="lr-ceiling"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="lr-ceiling"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="lr-ceiling"></div>
          <div class="col-lg-6"><input type="text" name="lr-ceiling-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Floor/Carpet</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="lr-floorcarpet"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="lr-floorcarpet"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="lr-floorcarpet"></div>
          <div class="col-lg-6"><input type="text" name="lr-floorcarpet-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Couch</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="lr-couch"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="lr-couch"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="lr-couch"></div>
          <div class="col-lg-6"><input type="text" name="lr-couch-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Chairs</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="lr-chairs"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="lr-chairs"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="lr-chairs"></div>
          <div class="col-lg-6"><input type="text" name="lr-chairs-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Blinds</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="lr-blinds"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="lr-blinds"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="lr-blinds"></div>
          <div class="col-lg-6"><input type="text" name="lr-blinds-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Other</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="lr-other"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="lr-other"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="lr-other"></div>
          <div class="col-lg-6"><input type="text" name="lr-other-txt"></div>
        </div>
        <hr>
        <!--Kitchen-->
        <div class="row m-b-lg">
          <div class="col-lg-3"><b>Kitchen</b></div>
          <div class="col-lg-1">Good</div>
          <div class="col-lg-1">Fair</div>
          <div class="col-lg-1">Poor</div>
          <div class="col-lg-6">If Poor, Explain</div>
        </div>
        <div class="row">
          <div class="col-lg-3">Walls</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-walls"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-walls"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-walls"></div>
          <div class="col-lg-6"><input type="text" name="ki-walls-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Ceiling</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-ceiling"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-ceiling"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-ceiling"></div>
          <div class="col-lg-6"><input type="text" name="ki-ceiling-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Floor</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-floor"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-floor"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-floor"></div>
          <div class="col-lg-6"><input type="text" name="ki-floor-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Cabinets</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-cabinets"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-cabinets"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-cabinets"></div>
          <div class="col-lg-6"><input type="text" name="ki-cabinets-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Range</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-range"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-range"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-range"></div>
          <div class="col-lg-6"><input type="text" name="ki-range-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Refrigerator</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-refri"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-refri"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-refri"></div>
          <div class="col-lg-6"><input type="text" name="ki-refri-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Vent Hood</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-venthood"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-venthood"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-venthood"></div>
          <div class="col-lg-6"><input type="text" name="ki-venthood-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Microwave</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-microwave"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-microwave"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-microwave"></div>
          <div class="col-lg-6"><input type="text" name="ki-microwave-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Disposal</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-disposal"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-disposal"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-disposal"></div>
          <div class="col-lg-6"><input type="text" name="ki-disposal-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Dishwasher</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-dishwasher"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-dishwasher"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-dishwasher"></div>
          <div class="col-lg-6"><input type="text" name="ki-dishwasher"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Table & Chairs</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-tchairs"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-tchairs"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-tchairs"></div>
          <div class="col-lg-6"><input type="text" name="ki-tchairs-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Other</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="ki-other"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="ki-other"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="ki-other"></div>
          <div class="col-lg-6"><input type="text" name="ki-other-txt"></div>
        </div>
        <hr>
        <!--Bedrooms-->
        <div class="row m-b-lg">
          <div class="col-lg-3"><b>Bedrooms</b></div>
          <div class="col-lg-1">Good</div>
          <div class="col-lg-1">Fair</div>
          <div class="col-lg-1">Poor</div>
          <div class="col-lg-6">If Poor, Explain</div>
        </div>
        <div class="row">
          <div class="col-lg-3">Walls/Doors</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bd-walls"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bd-walls"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bd-walls"></div>
          <div class="col-lg-6"><input type="text" name="bd-walls-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Ceiling</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bd-ceiling"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bd-ceiling"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bd-ceiling"></div>
          <div class="col-lg-6"><input type="text" name="bd-ceiling-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Floor/Carpet</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bd-floorcarpet"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bd-floorcarpet"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bd-floorcarpet"></div>
          <div class="col-lg-6"><input type="text" name="bd-floorcarpet-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Mattress & Spring Box</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bd-mattress"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bd-mattress"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bd-mattress"></div>
          <div class="col-lg-6"><input type="text" name="bd-mattress-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Dresser/Chest</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bd-dresserchest"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bd-dresserchest"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bd-dresserchest"></div>
          <div class="col-lg-6"><input type="text" name="bd-dresserchest-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Wire Drawer Baskets</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bd-wiredrawer"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bd-wiredrawer"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bd-wiredrawer"></div>
          <div class="col-lg-6"><input type="text" name="bd-wiredrawer-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Desk</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bd-desk"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bd-desk"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bd-desk"></div>
          <div class="col-lg-6"><input type="text" name="bd-desk-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Desk Chair</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bd-deskchair"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bd-deskchair"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bd-deskchair"></div>
          <div class="col-lg-6"><input type="text" name="bd-deskchair-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Mirror Closet Door</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bd-mirrorcloset"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bd-mirrorcloset"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bd-mirrorcloset"></div>
          <div class="col-lg-6"><input type="text" name="bd-mirrorcloset-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Blinds</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bd-blinds"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bd-blinds"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bd-blinds"></div>
          <div class="col-lg-6"><input type="text" name="bd-blinds-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Other</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bd-other"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bd-other"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bd-other"></div>
          <div class="col-lg-6"><input type="text" name="bd-other-txt"></div>
        </div>
        <hr>
        <!--Baths-->
        <div class="row m-b-lg">
          <div class="col-lg-3"><b>Baths</b></div>
          <div class="col-lg-1">Good</div>
          <div class="col-lg-1">Fair</div>
          <div class="col-lg-1">Poor</div>
          <div class="col-lg-6">If Poor, Explain</div>
        </div>
        <div class="row">
          <div class="col-lg-3">Walls/Doors</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bt-walls"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bt-walls"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bt-walls"></div>
          <div class="col-lg-6"><input type="text" name="bt-walls-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Ceiling</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bt-ceiling"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bt-ceiling"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bt-ceiling"></div>
          <div class="col-lg-6"><input type="text" name="bt-ceiling-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Floor/Carpet</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bt-floor"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bt-floor"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bt-floor"></div>
          <div class="col-lg-6"><input type="text" name="bt-floor-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Vanity Top</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bt-vtop"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bt-vtop"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bt-vtop"></div>
          <div class="col-lg-6"><input type="text" name="bt-vtop-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Mirror</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bt-mirror"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bt-mirror"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bt-mirror"></div>
          <div class="col-lg-6"><input type="text" name="bt-mirror-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Cabinets</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bt-cabinets"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bt-cabinets"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bt-cabinets"></div>
          <div class="col-lg-6"><input type="text" name="bt-cabinets-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Fixtures</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bt-fixtures"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bt-fixtures"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bt-fixtures"></div>
          <div class="col-lg-6"><input type="text" name="bt-fixtures-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Exhaust Fan/Light</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bt-fanlight"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bt-fanlight"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bt-fanlight"></div>
          <div class="col-lg-6"><input type="text" name="bt-fanlight-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Toilet</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bt-toilet"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bt-toilet"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bt-toilet"></div>
          <div class="col-lg-6"><input type="text" name="bt-toilet-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Tub</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bt-tub"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bt-tub"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bt-tub"></div>
          <div class="col-lg-6"><input type="text" name="bt-tub-txt"></div>
        </div>
        <div class="row">
          <div class="col-lg-3">Other</div>
          <div class="col-lg-1"><input value="1" type="checkbox" required name="bt-other"></div>
          <div class="col-lg-1"><input value="2" type="checkbox" required name="bt-other"></div>
          <div class="col-lg-1"><input value="3" type="checkbox" required name="bt-other"></div>
          <div class="col-lg-6"><input type="text" name="bt-other-txt"></div>
        </div>
        <hr>
        <p>
          Notice: The Lessee(s) shall be responsible for the condition of this unit as received. <br>
          Anydamage beyond normal wear and tear will be paid for at the Lessees’ expense. <br>
          Forms submitted after 48 hours of move-in date are null and void.
        </p>
        <hr>
        <h3>MOVE-IN INSPECTION DETAILS HEREBY TENDERED BY:</h3>
        <hr>
        <div class="row">
          <div class="col-lg-3">Name:</div>
          <div class="col-lg-3"><input type="text" name="hereby_name" required></div>
          <div class="col-lg-3">Date:</div>
          <div class="col-lg-3"><input type="text" id="datepicker"  required></div>
        </div>

      </div>


      <!--#WHITE SPACE-->
      <div class="col-lg-12 b-b-ddd">
        <br>


      </div>
      <!--#Submit Button-->

      <div class="submit-btn-big-form p-t-lg no-display">
        <input class="btn btn-submit" name="submit" value="Submit Report" type="submit">
      </div>

    </form>

  </div>
</section>