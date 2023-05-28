
<x-app-layout>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card card-frame">
            @if(session('success'))
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> {{ session('success') }}
            </div>
            @endif
            <div class="card-body">
              <form action="{{ route('store.user') }}" method="POST">
              @csrf
                <div class="form-group">
                  <label for="profile_photo">Profile Photo</label>
                  <input class="form-control" type="file" accept=".jpg, .png" 
                    id="profile_photo" name="profile_photo">
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
