@if(session('success_message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p style="color:green;"> {{ session('success_message') }}<p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>  
@endif

@include('inc/header')
<script src="{{ asset('js/validation.js') }}"></script>

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
                <div id="message"></div>
                  <div class="template-demo">
                   <form action="{{ route('order.update', $orders->id) }}" method="post" id="myForm" onsubmit="return validateForm()">
                    @csrf
                    @method('PUT')
                    <div class="mdc-layout-grid__inner">
                     <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                            <?php
                             $response = DB::table('date_settings')->select('date')->orderBy('created_at', 'desc')->first();
                             ?>
                            
                          <input type="date" class="mdc-text-field__input" id="order_date" name="ord_date" value="{{ $response->date ?? '' }}" required>
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
                  <span id="error-message" style="color: red;"></span>
                  </div>
                      
                     <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop">
                        <div class="mdc-text-field mdc-text-field--outlined">
                          <select class="mdc-text-field__input"  name="mode" name="mode" id="t1" onchange="handleModeChange()">
                           <option value="{{$orders->mode}}" selected><p style="color:blue;size:8px;"> {{$orders->mode}} </p></option>
                            <option value="By Cash"> By Cash</option>
                            <option value="Bank Transaction">Bank Transaction</option>
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
                          <input class="mdc-text-field__input" id="text-field-hero-input" name="name" value="{{$orders->name}}">
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
                          <input class="mdc-text-field__input" id="text-field-hero-input" name="mobile_1" value="{{$orders->mobile_1}}">
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
                          <input class="mdc-text-field__input" id="text-field-hero-input" name="mobile_2" value="{{$orders->mobile_2}}">
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
                          <input class="mdc-text-field__input" id="text-field-hero-input" name="address" value="{{ $orders->address }}">
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
                          <input class="mdc-text-field__input" id="text-field-hero-input" name="acc_name" value="{{$orders->acc_name}}">
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
                          <select class="mdc-text-field__input" id="text-field-hero-input" name="bank" value="{{$bank_name}}">
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
                          <input class="mdc-text-field__input" id="text-field-hero-input" name="acc_no" value="{{$orders->acc_no}}">
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
                          <input class="mdc-text-field__input" id="text-field-hero-input" name="ifsc" value="{{$orders->ifsc}}">
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
                          <input class="mdc-text-field__input" id="amount" name="amount" oninput="calculateSAR()" value="{{$orders->amount}}">
                          <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                              <label for="text-field-hero-input" class="mdc-floating-label">Amount</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                          </div>
                        </div>
                      </div>
      
                      </div>
                    <input type="hidden" id="paid_amt" name="paid_amt" value="{{$orders->paid_amt}}" readonly>
                    
                      <br>
                      <button class="mdc-button mdc-button--raised filled-button--success" type="submit" id="submitButton">
                      Submit
                    </button>
                    </form>
                    </div>
                  </div>
                </div>


<script>
    console.log("Script is running");

    document.addEventListener('DOMContentLoaded', function() {
        // Check if the MDC library is available
        if (typeof mdc !== 'undefined' && mdc.select) {
            console.log("MDC library found. Initializing MDC Select.");

            // Initialize MDC Select
            const selects = [].map.call(document.querySelectorAll('.mdc-select'), function(el) {
                return new mdc.select.MDCSelect(el);
            });
        } else {
            console.error('MDC library not found. Make sure it is included before this script.');
        }

        // Manually call handleModeChange() to handle the initial state
        handleModeChange();
    });

    // Function to handle option change
    function handleModeChange() {
        console.log("Option changed");

        var selectedOption = document.getElementById("t1").value;
        var targetDivcash = document.getElementById("targetDivcash");
        var targetDivbank = document.getElementById("targetDivbank");

        // Show or hide the target div based on the selected option
        if (selectedOption === "By Cash") {
            console.log("Showing targetDivcash");
            targetDivcash.style.display = "block";
        } else {
            console.log("Hiding targetDivcash");
            targetDivcash.style.display = "none";
        }

        if (selectedOption === "Bank Transaction") {
            console.log("Showing targetDivbank");
            targetDivbank.style.display = "block";
        } else {
            console.log("Hiding targetDivbank");
            targetDivbank.style.display = "none";
        }
    }
</script>
<script>
    function validateForm() {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage.textContent !== "") {
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('text-field-hero-input').addEventListener('input', function () {
            var value = parseInt(this.value);
            var errorMessage = document.getElementById('error-message');
            if (isNaN(value) || value > 999) {
                errorMessage.textContent = "Error: Value must be less than or equal to 999";
            } else {
                errorMessage.textContent = "";
            }
        });
    });
</script>



                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
    </div>
@include('inc/footer')