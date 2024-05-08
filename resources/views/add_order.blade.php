@include('inc/header')
@if(session('success_message'))
<!-- Include Bootstrap CSS and JS links here -->
  <div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body d-flex align-items-center"  style="text-align: center;">
          <div class="popup">
            <h2>Thank You!</h2>
            <img src="{{ asset('assets/images/tick.gif') }}" alt="Check GIF">
            <p> {{ Session::get('success_message') }}</p>
             <?php
                // Redirect to the stored route
                $redirectRoute = Session::get('redirect_route');
                ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  
    <!-- Include Bootstrap JS scripts here -->
    <script>
    // Trigger the modal on page load
    window.addEventListener('DOMContentLoaded', function () {
      var myModal = new bootstrap.Modal(document.querySelector('.modal'));
      myModal.show();

      // Close the modal after 5 seconds
      setTimeout(function () {
        myModal.hide();
      }, 2250); // 5000 milliseconds = 5 seconds
      window.location.href = "{{ route($redirectRoute) }}";
    });
     
  </script> 
  
@endif


      <!-- partial -->
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
              <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                  <h6 class="card-title" style="color:#7a00ff;"></h6>
                  <div style="position:absolute;right:120px;top:120px;padding:5px;">
                  <a href="{{route('dashboard')}}"><i class="fa fa-home" style="font-size:24px;color:#7a00ff;"></i></a>
                  </div>
                  <div style="position:absolute;right:60px;top:120px;padding:5px;">
                  <a href="{{route('orders.view')}}"><i class="fa fa-tasks" style="font-size:24px;color:#7a00ff;"></i></a>
                  </div>
                  <br>
 
                <div class="mdc-card">
                  <div class="template-demo">
                 <form action="{{ route('store_data.add') }}" method="post" id="myForm" onsubmit="return validateForm()">
                    @csrf
                    <div class="mdc-layout-grid__inner">
                     <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                          <input type="date" class="mdc-text-field__input" id="order_date" name="ord_date" value="{{ $date_settings->date ?? ''}}" autofocus >
                          <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">Date</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div>
                     
                     
                     <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                          <select class="mdc-text-field__input"  name="mode" name="mode" id="t1" onchange="handleModeChange()" autofocus >
                          <option value=" "><p style="color:blue;size:8px;"> Select Mode </p></option>
                           <option value="By Hand">By Hand</option>
                          <option value="Cash Transaction"> Cash Transaction</option>
                          </select>
                          <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">Mode</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div></div>
                      <div  id="targetDivcash" style="display: none;">
                      <div class="mdc-layout-grid__inner">
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                          <input class="mdc-text-field__input" id="text-field-hero-input" name="name" autofocus >
                          <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">Name</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div>
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                          <input class="mdc-text-field__input" id="text-field-hero-input" name="mobile_1" autofocus>
                          <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">Mobile</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div>
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                          <input class="mdc-text-field__input" id="text-field-hero-input" name="mobile_2" autofocus>
                          <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">Mobile 2</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div>
                     <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                          <input class="mdc-text-field__input" id="text-field-hero-input" name="address" autofocus>
                          <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">Address</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div>
                   </div>
                  </div>
                   <div id="targetDivbank" style="display: none;">
                   
                   <div class="mdc-layout-grid__inner">
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" id="text-field-hero-input" name="acc_name" autofocus>
                          <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">Name</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div>
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                        <select class="mdc-text-field__input" id="text-field-hero-input" name="bank" autofocus>
                            <option value=" "> Select Bank</option>
                            @foreach($bank as $data)
                            <option value="{{ $data->id }}"> {{ $data->bank_name }}</option>
                            @endforeach
                          </select>                         
                           <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">Bank</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div>
                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" id="text-field-hero-input" name="acc_no" autofocus>
                          <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">A/C No</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div>
                     <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" id="text-field-hero-input" name="ifsc" autofocus>
                          <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">IFSC</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div>
                   </div>
                  </div>
                  <div class="mdc-layout-grid__inner">
                     <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                           <input class="mdc-text-field__input" id="amount" name="amount" oninput="updateExchangeRate()" autofocus>
                          <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">Amount</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div>

                      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                       
                      </div>
                     
                      </div>

                      <br>
                      <button class="mdc-button mdc-button--raised filled-button--success" type="submit" id="submitButton">
                      Submit
                    </button>
                    </form>
                    </div>
                  </div>
                </div>
           
           
   
<script>
    $(document).ready(function() {
        $('#myForm').submit(function() {
            // Disable the submit button to prevent double submission
            $('#submitButton').prop('disabled', true);
        });
    });
</script>

<script>
    // Function to handle option change
    function handleModeChange() {
        console.log("Option changed");

        var selectedOption = document.getElementById("t1").value;
        var targetDivcash = document.getElementById("targetDivcash");
        var targetDivbank = document.getElementById("targetDivbank");

        // Show or hide the target div based on the selected option
        if (selectedOption === "By Hand") {
            console.log("Showing targetDivcash");
            targetDivcash.style.display = "block";
        } else {
            console.log("Hiding targetDivcash");
            targetDivcash.style.display = "none";
        }

        if (selectedOption === "Cash Transaction") {
            console.log("Showing targetDivbank");
            targetDivbank.style.display = "block";
        } else {
            console.log("Hiding targetDivbank");
            targetDivbank.style.display = "none";
        }
    }
</script>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
    </div>
@include('inc/footer')