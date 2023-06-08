<x-app-layout>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6 class="">Current: {{ $currentSchoolYear }}</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Grade Level</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Middle Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Grade Level</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($students as $student)
                    <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="{{ $student->profile_picture }}" class="avatar avatar-sm me-3" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $student->last_name }}, {{ $student->first_name }}</h6>
                              @if ($student->user)
                                  <p class="text-xs text-secondary mb-0">{{ $student->user->email }}</p>
                              @else
                                  <p class="text-xs text-secondary mb-0">No email available</p>
                              @endif
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $student->user->role }}</p>
                          <p class="text-xs text-secondary mb-0">{{ $student->grade }}</p>
                        </td>                        
                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ $student->middle_name }}</td>
                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ $student->grade }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>  
            </div>  
          </div>  
        </div>  
      </div>  
    </div>  
</x-app-layout>
