
<x-app-layout>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card card-frame">
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="card-body">
              <form action="{{ route('store.user') }}" method="POST">
              @csrf
                <div class="form-group row">
                  <div class="col-lg-4">
                    <label for="profile_picture">Profile Photo</label>
                    <input class="form-control" type="file" accept=".jpg, .png" 
                      id="profile_picture" name="profile_picture">
                  </div>
                  <div class="col-lg-4">
                    <label for="old_student">Old Student?</label>
                    <select class="form-control" id="old_student" name="old_student">
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                  <div class="col-lg-4">
                    <label for="school_years_id">School Year</label>
                    <select class="form-control" id="school_years_id" name="school_years_id">
                    @foreach($schoolYears as $schoolYear)
                        <option value="{{ $schoolYear->id }}">{{ $schoolYear->school_year }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-lg-4">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Juan">
                  </div>
                  <div class="col-lg-4">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name">
                  </div>
                  <div class="col-lg-4">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Dela Cruz">
                  </div>
                </div>
                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="form-control" id="role" name="role">
                    <option value="Student">Student</option>
                    <option value="Parent">Parent</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Staff">Staff</option>
                  </select>
                </div>
                <div class="form-group row">
                  <span class="col-lg-9"></span>
                  <button type="submit" class="btn bg-gradient-default col-lg-3">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>  
      </div>  
    </div>  
</x-app-layout>
