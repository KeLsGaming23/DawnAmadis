
<x-app-layout>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6 class="">Users table</h6>
              <a href="{{url('viewadduser')}}" class="btn btn-primary"><i class="bi-plus-square"></i> Add new Records</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Roles</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Enrolled At</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Token</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $user)
                    <tr id="Click-Table">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                          @if($user->studentBasicInformations)
                            <img src="{{ asset($user->studentBasicInformations->profile_picture) }}" class="avatar avatar-sm me-3" alt="user1">
                          @else
                            <!-- Handle the case where studentBasicInformation is null -->
                            <img src="{{ asset('image/student-profile/1767146127013664.jpg') }}" class="avatar avatar-sm me-3" alt="default-user">
                          @endif
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $user->role }}</p>
                        <p class="text-xs text-secondary mb-0">Organization</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">{{ $user->created_at->diffForHumans() }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $user->random_token }}</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs p-2" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                        <a href="{{ route('users.destroy', ['user' => $user->id]) }}" class="text-secondary font-weight-bold text-xs p-2" onclick="event.preventDefault(); confirmDelete('{{ $user->id }}');">
                            Delete
                        </a>
                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                      </td>
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
    <script>
      let click-table = getElementById("Click-Table");
      click-table.addEventListener('click', function() {
        alert('Div clicked!');
        // Your custom code here
      });
      function confirmDelete(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            document.getElementById('delete-form-' + userId).submit();
        }
      }

    </script>
</x-app-layout>
