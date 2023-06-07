
<x-app-layout>
  <style> 
    .search-icon{
      cursor: pointer;
    }
    .wrapper{
    display: flex;
    }

    .container{
      width: 300px;
      height: 420px;
      border-radius: 10px;
      background: #fff;
    }

    .img-container{
      width: 100%;
      height: 40%;
      position: relative;
    }

    .img-container img.banner-img{
      width: 100%;
      height: 100%;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }

    .img-container img.profile-img{
      position: absolute;
      bottom: -50px;
      left: 100px;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      border: 5px solid #fff;
    }

    .share{
      position: absolute;
      top: 10px;
      right: 10px;
    }

    .share ul{
      list-style: none;
    }

    .share ul li{
      width: 35px;
      height: 35px;
      margin-bottom: 5px;
      border-radius: 50%;
      border: 2px solid #673BB7;
      text-align: center;
      cursor: pointer;
      transition: all 1s ease;
    }

    .share ul li .fa{
      line-height: 35px;
      color: #673BB7;
      transition: all 1s ease;
    }

    .share ul li:hover{
      background: #673BB7;
    }

    .share ul li:hover .fa{
      color: #fff;
    }

    .content{
      height: 60%;
      width: 100%;
      box-sizing: border-box;
      padding: 60px 50px 50px;
      position: relative;
    }

    .title{
      text-align: center;
      color: #673BB7;
      padding-bottom: 35px;
    }

    .title p{
      font-size: 28px;
      font-weight: 700;
    }

    .title span{
      font-size: 12px;
      font-weight: 300;
    }


    .follow{
      text-align: center;
      border: 2px solid #673BB7;
      border-radius: 50px;
      padding: 10px;
      color: #673BB7;
      font-weight: 500;
      text-transform: uppercase;
      cursor: pointer;
      transition: all 1s ease;
    }

    .follow:hover{
      color: #fff;
      background: #673BB7;
    }

    .heart,
    .like{
      cursor: pointer;
    }

    .heart:before{
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      border-left: 30px solid #673BB7;
      border-right: 30px solid transparent;
      border-top: 30px solid transparent;
      border-bottom: 30px solid #673BB7;
      border-bottom-left-radius: 8px;
    }

    .heart:after{
      font-family: fontawesome;
      content:"\f08a";
      position: absolute;
      bottom: 10px;
      left: 10px;
      color: #fff;
    }



    .like:before{
      content: "";
      position: absolute;
      bottom: 0;
      right: 0;
      border-left: 30px solid transparent;
      border-right: 30px solid #673BB7;
      border-top: 30px solid transparent;
      border-bottom: 30px solid #673BB7;
      border-bottom-right-radius: 8px;
    }

    .like:after{
      font-family: fontawesome;
      content:"\f087";
      position: absolute;
      bottom: 10px;
      right: 10px;
      color: #fff;
      font-weight: 300;
    }
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <div class="form-group">
                <div class="col-lg-6">
                  <label for="role">Role</label>
                  <select class="form-control" id="role" name="role">
                    <option value="Student">Student</option>
                    <option value="Parent">Parent</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Staff">Staff</option>
                  </select>
                </div>
              </div>
              <form action="{{ route('store.user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row" id="studentFields">
                  <div class="form-group">
                    <div class="col-lg-6">
                      <label for="grade">Grade</label>
                      <select class="form-control" id="grade" name="grade">
                        <option value="Kinder">Kinder</option>
                        <option value="Prep">Prep</option>
                        <option value="Grade 1">Grade 1</option>
                        <option value="Grade 2">Grade 2</option>
                        <option value="Grade 3">Grade 3</option>
                        <option value="Grade 4">Grade 4</option>
                        <option value="Grade 5">Grade 5</option>
                        <option value="Grade 6">Grade 6</option>
                        <option value="Grade 7">Grade 7</option>
                        <option value="Grade 8">Grade 8</option>
                        <option value="Grade 9">Grade 9</option>
                        <option value="Grade 10">Grade 10</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-4">
                      <label for="profile_picture">Profile Photo</label>
                      <input class="form-control" type="file" name="profile_picture" accept=".jpg, .png" 
                        id="profile_picture">
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
                    <div class="col-lg-3">
                      <label for="first_name">First Name</label>
                      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Juan">
                    </div>
                    <div class="col-lg-3">
                      <label for="middle_name">Middle Name</label>
                      <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name">
                    </div>
                    <div class="col-lg-3">
                      <label for="last_name">Last Name</label>
                      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Dela Cruz">
                    </div>
                    <div class="col-lg-3">
                      <label for="gender">Gender</label>
                      <select class="form-control" id="gender" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="birth_date" class="form-control-label">Birth Date</label>
                        <input class="form-control" type="date" value="2023-01-01" id="birth_date" name="birth_date">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <label for="place_of_birth">Place of Birth</label>
                      <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" placeholder="Juan">
                    </div>
                  </div>
                  <div class="form-group row">
                    <span class="col-lg-9"></span>
                    <button type="submit" class="btn bg-gradient-default col-lg-3">Submit</button>
                  </div>
                </div>
              </form>
              <form action="{{route('add-parent-info')}}" method="POST">
              @csrf
              <div id="parentFields" style="display: none;">
                  <div class="form-group row">
                    <div class="col-lg-6">
                      <label for="fathers_name">Father's Name</label>
                      <input type="text" class="form-control" id="fathers_name" name="fathers_name" placeholder="Father's Name">
                    </div>
                    <div class="col-lg-6">
                      <label for="fathers_occupation">Occupation</label>
                      <input type="text" class="form-control" id="fathers_occupation" name="fathers_occupation" placeholder="Occupation">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-6">
                      <label for="mothers_name">Mother's Name</label>
                      <input type="text" class="form-control" id="mothers_name" name="mothers_name" placeholder="Mother's Name">
                    </div>
                    <div class="col-lg-6">
                      <label for="mothers_occupation">Occupation</label>
                      <input type="text" class="form-control" id="mothers_occupation" name="mothers_occupation" placeholder="Occupation">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-6">
                      <label for="guardian_name">Guardian's Name</label>
                      <input type="text" class="form-control" id="guardian_name" name="guardian_name" placeholder="Guardian's Name">
                    </div>
                    <div class="col-lg-6">
                      <label for="guardian_contact_no">Guardian's Contact No.</label>
                      <input type="text" class="form-control" id="guardian_contact_no" name="guardian_contact_no" placeholder="Guardian's Contact No.">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-6">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                    </div>
                    <div class="col-lg-6">
                      <label for="contact_no">Contact No.</label>
                      <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No.">
                    </div>
                  </div>
                  <div class="form-group row">
                    <h1>Search Student</h1>
                    <div class="col-lg-6">
                      <div class="input-group">
                        <input class="form-control" type="text" id="searchInput" placeholder="Enter a student name">
                        <div class="input-group-append" style="margin-right: 5px;">
                          <span class="search-icon" onclick="search()">&#128269;</span>
                        </div>
                      </div>
                    </div>
                    <div id="checkboxPlaceHolder" class="col-lg-12"></div>
                    <div id="searchResults" class="col-lg-12 wrapper"></div>
                  </div>

                  <div class="form-group row">
                    <span class="col-lg-9"></span>
                    <button type="submit" class="btn bg-gradient-default col-lg-3">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>  
      </div>  
    </div>
    <script>
      //Variable Declaration
      const roleSelect = document.getElementById('role');
      const parentFields = document.getElementById('parentFields');
      const studentFields = document.getElementById('studentFields');

      let selectFieldCounter = 1;

      function handleRoleChange() {
        const selectedRole = roleSelect.value;
        // Show/hide parent fields and student fields based on the selected role
        if (selectedRole === 'Parent') {
          parentFields.style.display = 'block';
          studentFields.style.display = 'none';
        } else {
          parentFields.style.display = 'none';
          studentFields.style.display = 'block';
        }
      }
      roleSelect.addEventListener('change', handleRoleChange);

      // Call the handleRoleChange function initially to set the initial state
      handleRoleChange();
      let checkboxCounter = 1;

      function handleSearch(event) {
        if (event.keyCode === 13) { // 13 represents the Enter key
          search();
        }
      }
      //Search Function for student
      function search() {
        const searchInput = document.getElementById('searchInput');
        const searchQuery = searchInput.value.trim();

        if (searchQuery === '') {
          // Clear search results if the search query is empty
          document.getElementById('searchResults').innerHTML = '';
          return;
        }

        const url = 'https://dawnamadis.com/api/get.student.name';

        fetch(url)
          .then(response => response.json())
          .then(data => {
            const results = data.filter(student => student.name.toLowerCase().includes(searchQuery.toLowerCase()));
            displayResults(results);
          })
          .catch(error => {
            console.error('Error:', error);
            document.getElementById('searchResults').innerHTML = 'An error occurred while fetching data.';
          });
      }

      function displayResults(results) {
        const searchResults = document.getElementById('searchResults');
        searchResults.innerHTML = '';

        if (results.length === 0) {
          searchResults.innerHTML = 'No results found.';
          return;
        }

        results.forEach(result => {
          const container = document.createElement('div');
          container.className = 'container';

          const img_container = document.createElement('div');
          img_container.className = 'img-container';

          const banner_img = document.createElement('img');
          banner_img.className = 'banner-img';
          banner_img.src = "https://i.imgur.com/unqgNiU.jpg";

          const profile_img = document.createElement('img');
          profile_img.className = 'profile-img';
          profile_img.src = result.profile_picture;

          const share = document.createElement('div');
          share.className = 'share';
          share.innerHTML = 
          `<ul>
            <li><i class="fa fa-twitter" aria-hidden="true"></i></li>
            <li><i class="fa fa-git" aria-hidden="true"></i></li>
            <li><i class="fa fa-linkedin" aria-hidden="true"></i></li>
          </ul>`;

          const header = document.createElement('div');
          header.className = 'card-header';
          header.textContent = result.id;

          const profilePicture = document.createElement('img');
          profilePicture.className = 'profile-picture';
          profilePicture.src = result.profile_picture;

          const content = document.createElement('div');
          content.className = 'content';
          
          const title = document.createElement('div');
          title.className = 'title';
          title.innerHTML = 
          `<p>${result.name}</p>`;
          
          const addChild = document.createElement('div');
          addChild.className = 'follow';
          addChild.textContent = 'Add Child';
          addChild.onclick = function() {
            createChildCheckBox(result.id, result.name);
          };

          const heart = document.createElement('div');
          heart.className = 'heart';
          
          const like = document.createElement('div');
          like.className = 'like';

          container.appendChild(img_container);
          img_container.appendChild(banner_img);
          img_container.appendChild(profile_img);
          img_container.appendChild(share);
          container.appendChild(content);
          content.appendChild(title);
          content.appendChild(addChild);
          content.appendChild(heart);
          content.appendChild(like);

          searchResults.appendChild(container);
        });
      }

      function createChildCheckBox(id, name) {
        alert("Your Child is added");
        const checkboxPlaceHolder = document.getElementById('checkboxPlaceHolder');
        const checkbox = document.createElement('input');
        const checkboxLabel = document.createElement('label');
        checkbox.type = 'checkbox';
        checkbox.value = id;
        checkbox.name = 'checkbox[]'; // Use the "[]" syntax to indicate an array of values
        checkbox.checked = true; // Set the checkbox as checked
        checkboxLabel.innerHTML = name;

        checkboxPlaceHolder.appendChild(checkbox);
        checkboxPlaceHolder.appendChild(checkboxLabel);

        checkboxCounter++;
      }
    </script>
</x-app-layout>
