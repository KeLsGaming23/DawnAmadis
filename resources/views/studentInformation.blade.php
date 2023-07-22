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
                                          <td class="clickable-cell" style="border: 1px solid black; padding: 8px; text-align: center; cursor: pointer;">{{ $payment->$column }}</td>
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


<!-- Your modal HTML -->
<div id="simpleModal" style="display: none;">
  <div class="modal-content">
    <!-- Add the content you want to display in the modal here -->
    <!-- For example, you can show the cell content and column name -->
    <p>You clicked: <span id="modalCellContent"></span></p>
    <p>Column Name: <span id="modalColumnName"></span></p>
  </div>
</div>

<script>
  $(document).ready(function() {
    // This function will be executed when a <td> element with the class "clickable-cell" is clicked.
    $(".clickable-cell").on("click", function() {
      // Get the content of the clicked cell (i.e., the text inside the <td>).
      var cellContent = $(this).text();
      
      // Get the index of the clicked cell among its siblings.
      var cellIndex = $(this).index();
      
      // Get the column name from the column names array based on the cell index.
      var columnNames = {!! json_encode(array_keys((array)$payment)) !!};
      var columnName = columnNames[cellIndex];
      
      // Update the modal content with the cell content and column name.
      $("#modalCellContent").text(cellContent);
      $("#modalColumnName").text(columnName);
      
      // Display the modal by changing its display style to "block".
      $("#simpleModal").css("display", "block");
    });
  });
</script>

</x-app-layout>
