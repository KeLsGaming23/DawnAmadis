<x-app-layout>
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
    <table>
        <thead>
            <tr>
                <th>Payment Month</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student->child->payments as $payment)
                @if ($payment->payment_option === 'Cash')
                    <tr>
                        <td>Payment Option</td>
                        <td>{{ $payment->payment_option }}</td>
                    </tr>
                    <tr>
                        <td>Total Tuition Fee</td>
                        <td>{{ $payment->total_tuition_fee }}</td>
                    </tr>
                    <tr>
                        <td>Cash Received</td>
                        <td>{{ $payment->cash_receive }}</td>
                    </tr>
                @elseif ($payment->payment_option === 'Monthly')
                    <tr>
                        <td>Payment Option</td>
                        <td>{{ $payment->payment_option }}</td>
                    </tr>
                    <tr>
                        <td>Total Tuition Fee</td>
                        <td>{{ $payment->total_tuition_fee }}</td>
                    </tr>
                    <tr>
                        <td>Down Payment</td>
                        <td>{{ $payment->down_payment }}</td>
                    </tr>
                    @for ($i = 1; $i <= 10; $i++)
                        @php
                            $monthName = $i === 1 ? '1st' : ($i === 2 ? '2nd' : ($i === 3 ? '3rd' : ($i.'th')));
                            $column = 'payment_'.$monthName.'_month';
                        @endphp
                        <tr>
                            <td>Payment Month {{ $monthName }}</td>
                            <td>{{ $payment->$column }}</td>
                        </tr>
                    @endfor
                    <tr>
                        <td>Remaining Balance</td>
                        <td>{{ $payment->total_tuition_fee - ($payment->down_payment + $payment->payment_1st_month + $payment->payment_2nd_month + $payment->payment_3rd_month + $payment->payment_4th_month + $payment->payment_5th_month + $payment->payment_6th_month + $payment->payment_7th_month + $payment->payment_8th_month + $payment->payment_9th_month + $payment->payment_10th_month) }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@else
    <p>No payment information available</p>
@endif

                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
