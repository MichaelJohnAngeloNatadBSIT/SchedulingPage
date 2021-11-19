<?php
  require 'includes/mailer.php'
?>



<link rel="stylesheet" type="text/css" href="style.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="./form.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<button id="authorize_button" style="display: none;">Authorize</button>
<button id="signout_button" style="display: none;">Sign Out</button>
<pre id="content"></pre>

<section class="contact-form">
    <h1>Set An Appointment</h1>
    <p>Please Fill Out all needed information.</p>
    
    <form action="includes/mailer.php" method="post">
      <div class="input-group">
        <label for="first-name">First Name</label>
        <input id="name" name="first-name" type="text"/>
      </div>

      <div class="input-group">
        <label for="last-name">Last Name</label>
        <input id="name" name="last-name" type="text"/>
      </div>

      <div class="input-group">
      <label for="gender">Gender</label>
        <input id="gender-male" name="gender" type="radio" value="Male"/>
        <label class="inline" for="gender-male">Male</label>
        
        <input id="gender-female" name="gender" type="radio" value="Female"/>
        <label class="inline" for="gender-female">Female</label>
      </div>

      <div class="input-group">
        <label for="contact">Contact Number</label>
        <input id="contact" name="contact-number" type="contact"/>
      </div>
      
      <div class="input-group">
        <label for="email">Email Address</label>
        <input id="email" name="email-address" type="email"/>
      </div>

      <div class="input-group">
        <label for="birthday">Birthday</label>
        <input type="text" name="birthday" value=""/>
        <script>
          $(function() {
            $('input[name="birthday"]').daterangepicker({
              singleDatePicker: true,
              showDropdowns: true,
              minYear: 1901,
              maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
              var years = moment().diff(start, 'years');
              alert("You are " + years + " years old!");
            });
          });
          </script>
      </div> 

      <div class="input-group">
        <label for="address">Full Address</label>
        <input id="address" name="address" type="address"/>
      </div>
      
      <div class="input-group">
        <label for="message">Brief Description of Visit</label>
        <textarea id="message" name="description" rows="6" cols="65"></textarea>
      </div>

      <div class="input-group">
        <label for="prev-client">Have you previously attended our facility?</label>
        <input id="prev-client" name="prev-client" type="radio" value="Yes"/>
        <label class="inline" for="prev-client">Yes</label>
        
        <input id="prev-client" name="prev-client" type="radio" value="No"/>
        <label class="inline" for="prev-client">No</label>
      </div>
  
      <div class="input-group">
        <label for="appointment-date">Set your Available Appointment Date</label>
        <input type="text" name="appointment-date" />
        <script>
          $(function() {
            $('input[name="appointment-date"]').daterangepicker({
              singleDatePicker: true,
              showDropdowns: true,
              timePicker: true,
              date: moment().startOf('hour'),
              locale: {
              format: 'Y-M-DD hh:mm A'
              },
              
            })
          
          });
          </script>
        
      </div>
      
      <button type="submit" name="set-appointment">Set Appointment</button>
    </form>
  </section>
  


  
