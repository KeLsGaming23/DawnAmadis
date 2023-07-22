<x-app-layout>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <div class="container-fluid py-4">
      <div class="row">
          <div class="col-12">
              <div class="card mb-4">
                  <div class="card-header pb-0">
                      <h6>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</h6>
                      <p>Grade: {{ $student->grade }}</p>
                  </div>
                  <div class="card-body pt-0 pb-2">
                      @if ($student->child && $student->child->parent)
                          <h6>Parent Details</h6>
                          <p>Father's Name: {{ $student->child->parent->fathers_name }}</p>
                          <p>Mother's Name: {{ $student->child->parent->mothers_name }}</p>
                      @else
                          <p>No parent information available</p>
                      @endif

                      @if ($student->child && $student->child->payments->count() > 0)
                          <h6>Payment Details</h6>
                          @foreach ($student->child->payments as $payment)
                              <p>Payment Option: {{ $payment->payment_option }}</p>

                              @if ($payment->payment_option === 'Cash')
                                  <p>Total Tuition Fee: {{ $payment->total_tuition_fee }}</p>
                                  <p>Cash Received: {{ $payment->cash_receive }}</p>
                              @elseif ($payment->payment_option === 'Monthly')
                                  <p>Total Tuition Fee: {{ $payment->total_tuition_fee }}</p>
                                  <p>Down Payment: {{ $payment->down_payment }}</p>
                                  <table style="border-collapse: collapse; width: 100%;">
                                    <thead>
                                      <tr>
                                        @for ($i = 1; $i <= 10; $i++)
                                          @php
                                            $monthName = $i === 1 ? '1st' : ($i === 2 ? '2nd' : ($i === 3 ? '3rd' : ($i.'th')));
                                          @endphp
                                          <th style="border: 1px solid black; padding: 8px; text-align: center; background-color: #f2f2f2;">{{ $monthName }} Month</th>
                                        @endfor
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        @for ($i = 1; $i <= 10; $i++)
                                          @php
                                            $monthName = $i === 1 ? '1st' : ($i === 2 ? '2nd' : ($i === 3 ? '3rd' : ($i.'th')));
                                            $column = 'payment_'.$monthName.'_month'; 
                                          @endphp
                                          <td class="clickable-cell" 
                                              style="border: 1px solid black; padding: 8px; text-align: center; cursor: pointer;"
                                              data-bs-toggle="modal" data-bs-target="#exampleModal"
                                              data-payment="{{ $payment->$column }}" data-column-name="{{ $column }}">
                                              {{ $payment->$column }}
                                          </td>
                                        @endfor

                                      </tr>                                      
                                    </tbody>
                                  </table>
                                                                   
                                  <p>Remaining Balance: {{ $payment->total_tuition_fee - ($payment->down_payment + $payment->payment_1st_month + $payment->payment_2nd_month + $payment->payment_3rd_month + $payment->payment_4th_month + $payment->payment_5th_month + $payment->payment_6th_month + $payment->payment_7th_month + $payment->payment_8th_month + $payment->payment_9th_month + $payment->payment_10th_month) }}</p>
                              @endif
                          @endforeach
                      @else
                          <p>No payment information available</p>
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Monthly Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="refreshPage()">
          Close
        </button>        
      </div>
      <div class="modal-body">
        <div class="card-body">
          <p>{{ $student->child->id }}</p>
          <form role="form text-left" id="editPaymentForm" action="{{ route('payment.edit', ['id' => $student->child->id, 'month' => '1st']) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="month" id="monthInput">
            <label for="monthly_payment">Monthly Payment</label>
            <input type="text" name="payment_for_month" id="monthly_payment_input" required>
            <div class="text-center">
              <button type="button" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0" onclick="refreshPage()">Save</button>
            </div>
          </form>
          
        </div>
      </div>
      
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
  var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
  myModal._element.addEventListener('show.bs.modal', function (event) {
    var triggerElement = event.relatedTarget;
    var payment = triggerElement.dataset.payment;
    var columnName = triggerElement.dataset.columnName;
    var inputField = myModal._element.querySelector('#monthly_payment_input');
    var modalTitle = myModal._element.querySelector('.modal-title');
    var form = myModal._element.querySelector('#editPaymentForm'); // Get the form element

    // Reset input field and modal title
    inputField.name = '';
    inputField.id = '';
    inputField.value = '';
    modalTitle.textContent = 'Monthly Payment';

    // Set the input field's name, ID, and value based on the clicked cell
    inputField.name = columnName;
    inputField.id = columnName + '_input';
    inputField.value = payment;
    modalTitle.textContent = 'Monthly Payment - ' + columnName;

    // Set the form's action attribute dynamically based on the clicked column name
    var defaultAction = "{{ route('payment.edit', ['id' => $student->child->id, 'month' => '1st']) }}";
    form.action = defaultAction.replace('month', columnName);
  });
});

function refreshPage() {
  // Refresh the page
  location.reload();
}

</script>




</x-app-layout>
