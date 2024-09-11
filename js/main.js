
$(document).ready(function() {


$(document).on('click', '.TogglerViewSubject', function() {
    var subId = $(this).data('subject_id');
    var code = $(this).data('code');

    
    var url = 'view_subject.php?subject_id=' + subId+'&&code='+code;
    window.location.href = url;
});


$(document).on('click', '.TogglerViewDepartment', function() {
    var deptId = $(this).data('dept_id');
    var url = 'view_department.php?dept_id=' + deptId;
    window.location.href = url;
});


$(document).on('click', '.togglerAddSubjectForStudent', function (e) {
  e.preventDefault();
  
  var stud_id=$(this).attr('data-stud_id');

  $('#add_stud_id').val(stud_id)
  console.log(stud_id);
});


//FOR START EXPORT DEPARTMENT DATA
$('#frmDepartmentData').on('submit', function(e) {
  e.preventDefault();
  var form = $('<form>', {
    method: 'POST',
    action: 'function/export_department.php',
    target: '_blank'
  });
  $.each($(this).serializeArray(), function(index, field) {
    $('<input>', {
      type: 'hidden',
      name: field.name,
      value: field.value
    }).appendTo(form);
  });
  form.appendTo('body').submit().remove();
});
//FOR END EXPORT DEPARTMENT DATA


  //FOR START ADD SUBJECT
  $('#frmAddStudentSubject').on('submit', function(e) {
    e.preventDefault();
    $('#btnAddStudentSubject').prop('disabled', true);

    var subject_id  = $('#add_stud_subject').val();
    var stud_id = $('#add_stud_id').val()
    $.ajax({
      url: '../endpoints/post.php',
      type: 'POST',
      data: {
        stud_id: stud_id,
        subject_id : subject_id,
          SubmitType: 'AddStudentsSubject'
      },
      success: function(response) {
        console.log(response);
          // Handle successful response
          if (response == '200') {
            alertify.success('Successful added');
                window.location.href = 'view_student_info.php?stud_id='+stud_id;
              
            }
          console.log(response);
      },
     
    });
  
  });
  //FOR END ADD SUBJECT



   //FOR START ADD STUDENT
   $('#frmAddStudent').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this); // Create FormData object from form

    formData.append('SubmitType', 'AddStudent'); // Add custom field

    $('.loading-spinner').show(); // Show spinner
    $('#btnAddAdmin').prop('disabled', true); // Disable button

    $.ajax({
        url: '../endpoints/post.php',
        type: 'POST',
        data: formData,
        contentType: false, // Important for file uploads
        processData: false, // Important for file uploads
        success: function(response) {
            console.log(response);
            // Handle successful response
            if (response === '200') {
                alertify.success('Successfully added');
                setTimeout(function() {
                    // Hide spinner and redirect
                    $('.loading-spinner').hide();
                    $('#btnAddAdmin').prop('disabled', false);
                    window.location.href = '../admin/student.php';
                }, 2000); 
            } else if(response=='STUDENT_ID_ALREADY_EXIST'){
                alertify.error('Student ID already exists');
                $('.loading-spinner').hide();
                $('#btnAddAdmin').prop('disabled', false);

            }else {
                alertify.error('Failed to add user');
            }
        },
        error: function(xhr, status, error) {
            $('.loading-spinner').hide(); // Hide spinner on error
            $('#btnAddAdmin').prop('disabled', false);
            alertify.error('An error occurred: ' + error);
        }
    });
});
  //FOR END ADD STUDENT

 
// Start code For Login
  $('#loginForm').on('submit', function(e) {
      e.preventDefault(); // Prevent the form from submitting the default way

      var username = $('#username').val();
      var password = $('#password-field').val();

      $.ajax({
        url: 'endpoints/post.php',
        type: 'POST',
        data: {
            username: username,
            password: password,
            SubmitType: 'Login'
        },
        dataType: 'json', // Expect JSON response
        success: function(response) {

          console.log(response);
            // Handle successful response
            if (response.status === 'success') {
              alertify.success('Login successful');
              document.getElementById('loading-spinner').style.display = 'block'; // Show spinner
              
              setTimeout(function() {
                // Hide spinner after the redirection
                document.getElementById('loading-spinner').style.display = 'none';
              
              
                  window.location.href = 'admin/dashboard.php';
                
              }, 2000); // Delay of 2000 milliseconds (2 seconds)
              
            } else {
                alertify.error('Login Failed');
            }
            console.log(response);
        },
        error: function(xhr, status, error) {
            // Handle error
            alertify.error('Login failed. Please try again.');
            console.log(xhr.responseText);
        }
    });
    
  });


// Toggler for update admin
$(document).on('click', '.TogglerUpdateUser', function(e) {
    e.preventDefault();
    var admin_id = $(this).attr('data-admin_id');
    
    var fname = $(this).attr('data-fname');

    var mname = $(this).attr('data-mname');
    var lname = $(this).attr('data-lname');
    var email = $(this).attr('data-email');
    var username = $(this).attr('data-username');
   

    $('#edit_admin_id').val(admin_id)
    
    $('#edit_user_fname').val(fname)
    $('#edit_user_mname').val(mname)
    $('#edit_user_lname').val(lname)
    $('#edit_user_email').val(email)
    $('#edit_user_username').val(username)
    
});


// Toggler for update admin
$(document).on('click', '.TogglerSubgrade', function(e) {
  e.preventDefault();

  var stud_id = $(this).attr('data-stud_id');
  var ss_id = $(this).attr('data-ss_id');
  var code = $(this).attr('data-code');
  var ss_final_grade = $(this).attr('data-ss_final_grade');
  
  $('#stud_id').val(stud_id)
  $('#subjectTarget').text(code)
  $('#ss_id').val(ss_id)
  $('#SubGrade').val(ss_final_grade)
  
});


// Toggler for update Department
$(document).on('click', '.TogglerUpdateDepartment', function(e) {
  e.preventDefault();
  var dept_id = $(this).attr('data-dept_id');
  
  
  var dept_name = $(this).attr('data-dept_name');
  var dept_description = $(this).attr('data-dept_description');

 

  $('#edit_dept_id').val(dept_id)
  
  $('#edit_dept_name').val(dept_name)
  $('#edit_dept_description').val(dept_description)
  
  console.log(dept_id);
});


// Toggler for update subject
$(document).on('click', '.TogglerUpdateSubject', function(e) {
    e.preventDefault();


    var for_year_level = $(this).attr('data-for_year_level');
    var course_code = $(this).attr('data-code');
    var title = $(this).attr('data-title');
    var units = $(this).attr('data-units');
    var pre = $(this).attr('data-pre');
    var subject_id = $(this).attr('data-subject_id');
    var stud_department = $(this).attr('data-dept_id');


    console.log(stud_department);

    
    $('#edit_for_year_level').val(for_year_level)

    $('#edit_stud_department').val(stud_department);


    $('#edit_course_code').val(course_code)
    $('#edit_descriptive_title').val(title)
    $('#edit_units').val(units)
    $('#edit_pre_requisite').val(pre)

    
    $('#edit_subject_id').val(subject_id)
    
});


// Toggler for update student
$(document).on('click', '.TogglerUpdateStudent', function(e) {
  e.preventDefault();


  var stud_id = $(this).attr('data-stud_id');

  var stud_code = $(this).attr('data-stud_code');
  
  var fname = $(this).attr('data-fname');
  var mname = $(this).attr('data-mname');
  var lname = $(this).attr('data-lname');

  var phone = $(this).attr('data-phone');
  var email = $(this).attr('data-email');
  var address = $(this).attr('data-address');
  var gender = $(this).attr('data-gender');


  var year_level = $(this).attr('data-year_level');

  var stud_school_year = $(this).attr('data-stud_school_year');

  var stud_course = $(this).attr('data-stud_course');

  var stud_sem = $(this).attr('data-stud_sem');
  var stud_academic_status = $(this).attr('data-stud_academic_status');


  

  


  $('#update_stud_id').val(stud_id);

  $('#update_stud_code').val(stud_code)
  $('#update_stud_fname').val(fname)
  $('#update_stud_mname').val(mname)
  $('#update_stud_lname').val(lname)

  $('#update_phone_num').val(phone)
  $('#update_stud_email').val(email)
  $('#update_stud_address').val(address)
  $('#update_stud_gender').val(gender)



  $('#update_yr_lvl').val(year_level)
  $('#edit_sem').val(stud_sem);
  $('#edit_acadStatus').val(stud_academic_status);
  
  $('#update_stud_course').val(stud_course);
  $('#update_stud_Sy').val(stud_school_year);

  console.log(gender);


});





  //FOR START UPDATE SUBJECT
$('#frmEditSubject').on('submit', function(e) {
  e.preventDefault();

  var course_code = $('#edit_course_code').val();
  var descriptive_title = $('#edit_descriptive_title').val();
  var units = $('#edit_units').val();
  var pre_requisite = $('#edit_pre_requisite').val();
  var subject_id = $('#edit_subject_id').val();
  var stud_department = $('#edit_stud_department').val();
  var for_year_level = $('#edit_for_year_level').val();

  
  $.ajax({
    url: '../endpoints/post.php',
    type: 'POST',
    data: {
      stud_department:stud_department,
      subject_id:subject_id,
      course_code: course_code,
      descriptive_title: descriptive_title,
      units:units,
      pre_requisiteL:pre_requisite,
      for_year_level:for_year_level,
      SubmitType: 'UpdateSubject'
    },
  
    success: function(response) {

      console.log(response);
        // Handle successful response
        if (response == '200') {
          alertify.success('Updated Successful');
          $('.loading-spinner').show();
          document.getElementById('btnEditSubject').style.display = 'none'; 


          setTimeout(function() {
            // Hide spinner after the redirection
            $('.loading-spinner').hide();
            document.getElementById('btnEditSubject').style.display = 'block'; 

            
              window.location.href = '../admin/subject.php';
            
          }, 2000); 
        } else {
            alertify.error('Login Failed');
        }
        console.log(response);
    },
   
});

});

// frmAddStudentgrade
$('#frmAddStudentgrade').on('submit', function(e) {
  e.preventDefault();

  var stud_id =$("#stud_id").val()
  var formData = new FormData(this); 

  formData.append('SubmitType', 'updateSubGrade');

  $('.loading-spinner').show(); 
  
  $('.add-Subgrade-modal').modal('hide');

  $('#btnGradeSave').prop('disabled', true);

  $.ajax({
      url: '../endpoints/post.php',
      type: 'POST',
      data: formData,
      contentType: false, // Important for file uploads
      processData: false, // Important for file uploads
      success: function(response) {
          console.log(response);
          // Handle successful response
          if (response === '200') {
            alertify.success('Update Successfully');
              setTimeout(function() {
                  // Hide spinner and redirect
                  
                  $('.loading-spinner').hide();
                  $('#btnGradeSave').prop('disabled', false);

                  location.reload();
                  

              }, 2000); 
          } 
      },
      error: function(xhr, status, error) {
          $('.loading-spinner').hide(); // Hide spinner on error
          $('#btnGradeSave').prop('disabled', false);
          alertify.error('An error occurred: ' + error);
      }
  });
});



//FOR START UPDATE USER
$('#frmUpdateStudent').on('submit', function(e) {
  e.preventDefault();

  var formData = new FormData(this); 

  formData.append('SubmitType', 'EditStudent');

  $('#loading-spinner').show(); 
  $('#btnEditAdmin').prop('disabled', true);

  $.ajax({
      url: '../endpoints/post.php',
      type: 'POST',
      data: formData,
      contentType: false, // Important for file uploads
      processData: false, // Important for file uploads
      success: function(response) {
          console.log(response);
          // Handle successful response
          if (response === '200') {
              alertify.success('Successfully added');
              setTimeout(function() {
                  // Hide spinner and redirect
                  $('#loading-spinner').hide();
                  $('#btnEditAdmin').prop('disabled', false);
                  window.location.href = '../admin/student.php';
              }, 2000); 
          } else if(response=='EmailAlready'){
              alertify.error('Email already exists');
              $('#loading-spinner').hide();
              $('#btnEditAdmin').prop('disabled', false);

          } else if(response=='UserNameAlready'){

              alertify.error('Username already exists');
              $('#loading-spinner').hide();
              $('#btnEditAdmin').prop('disabled', false);
          }else {
              alertify.error('Failed to add user');
          }
      },
      error: function(xhr, status, error) {
          $('#loading-spinner').hide(); // Hide spinner on error
          $('#btnEditAdmin').prop('disabled', false);
          alertify.error('An error occurred: ' + error);
      }
  });
});



//FOR START UPDATE USER
$('#frmEditAdmin').on('submit', function(e) {
  e.preventDefault();

  var formData = new FormData(this); 

  formData.append('SubmitType', 'EditUser');

  $('#loading-spinner').show(); 
  $('#btnEditAdmin').prop('disabled', true);

  $.ajax({
      url: '../endpoints/post.php',
      type: 'POST',
      data: formData,
      contentType: false, // Important for file uploads
      processData: false, // Important for file uploads
      success: function(response) {
          console.log(response);
          // Handle successful response
          if (response === '200') {
              alertify.success('Successfully added');
              setTimeout(function() {
                  // Hide spinner and redirect
                  $('#loading-spinner').hide();
                  $('#btnEditAdmin').prop('disabled', false);
                  window.location.href = '../admin/user.php';
              }, 2000); 
          } else if(response=='EmailAlready'){
              alertify.error('Email already exists');
              $('#loading-spinner').hide();
              $('#btnEditAdmin').prop('disabled', false);

          } else if(response=='UserNameAlready'){

              alertify.error('Username already exists');
              $('#loading-spinner').hide();
              $('#btnEditAdmin').prop('disabled', false);
          }else {
              alertify.error('Failed to add user');
          }
      },
      error: function(xhr, status, error) {
          $('#loading-spinner').hide(); // Hide spinner on error
          $('#btnEditAdmin').prop('disabled', false);
          alertify.error('An error occurred: ' + error);
      }
  });
});





  //FOR START UPDATE ADMIN PROFILE
  $('#frmUpdateProfile').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this); // Create FormData object from form

    formData.append('SubmitType', 'UpdateAdminProfile'); // Add custom field

    $('.loading-spinner').show(); // Show spinner
    $('#btnAddAdmin').prop('disabled', true); // Disable button

    $.ajax({
        url: '../endpoints/post.php',
        type: 'POST',
        data: formData,
        contentType: false, // Important for file uploads
        processData: false, // Important for file uploads
        success: function(response) {
            console.log(response);
            // Handle successful response
            if (response === '200') {
                alertify.success('Successfully added');
                setTimeout(function() {
                    // Hide spinner and redirect
                    $('.loading-spinner').hide();
                    $('#btnAddAdmin').prop('disabled', false);
                    window.location.href = '../admin/user.php';
                }, 2000); 
            } else if(response=='EmailAlready'){
                alertify.error('Email already exists');
                $('.loading-spinner').hide();
                $('#btnAddAdmin').prop('disabled', false);

            } else if(response=='UserNameAlready'){

                alertify.error('Username already exists');
                $('.loading-spinner').hide();
                $('#btnAddAdmin').prop('disabled', false);
            }else {
                alertify.error('Failed to add user');
            }
        },
        error: function(xhr, status, error) {
            $('.loading-spinner').hide(); // Hide spinner on error
            $('#btnAddAdmin').prop('disabled', false);
            alertify.error('An error occurred: ' + error);
        }
    });
});
  //FOR END ADD USER



  //FOR START ADD USER
  $('#frmAddAdmin').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this); // Create FormData object from form

    formData.append('SubmitType', 'AddUser'); // Add custom field

    $('.loading-spinner').show(); // Show spinner
    $('#btnAddAdmin').prop('disabled', true); // Disable button

    $.ajax({
        url: '../endpoints/post.php',
        type: 'POST',
        data: formData,
        contentType: false, // Important for file uploads
        processData: false, // Important for file uploads
        success: function(response) {
            console.log(response);
            // Handle successful response
            if (response === '200') {
                alertify.success('Successfully added');
                setTimeout(function() {
                    // Hide spinner and redirect
                    $('.loading-spinner').hide();
                    $('#btnAddAdmin').prop('disabled', false);
                    window.location.href = '../admin/user.php';
                }, 2000); 
            } else if(response=='EmailAlready'){
                alertify.error('Email already exists');
                $('.loading-spinner').hide();
                $('#btnAddAdmin').prop('disabled', false);

            } else if(response=='UserNameAlready'){

                alertify.error('Username already exists');
                $('.loading-spinner').hide();
                $('#btnAddAdmin').prop('disabled', false);
            }else {
                alertify.error('Failed to add user');
            }
        },
        error: function(xhr, status, error) {
            $('.loading-spinner').hide(); // Hide spinner on error
            $('#btnAddAdmin').prop('disabled', false);
            alertify.error('An error occurred: ' + error);
        }
    });
});
  //FOR END ADD USER


  
   //FOR START EDIT Department
   $('#frmEditDepartment').on('submit', function(e) {
    e.preventDefault();

    var dept_id = $('#edit_dept_id').val();
    var dept_name = $('#edit_dept_name').val();
    var dept_description = $('#edit_dept_description').val();


    $.ajax({
      url: '../endpoints/post.php',
      type: 'POST',
      data: {
        dept_id: dept_id,
        dept_name: dept_name,
        dept_description: dept_description,
        SubmitType: 'EditDepartment'
      },
    
      success: function(response) {

        console.log(response);
          // Handle successful response
          if (response == '200') {
            alertify.success('Successful added');
            $('.loading-spinner').show();
            document.getElementById('btnEditDepartment').disabled = true;


            setTimeout(function() {
              // Hide spinner after the redirection
              $('.loading-spinner').hide();
              document.getElementById('btnEditDepartment').disabled = false;

              
                window.location.href = '../admin/department.php';
              
            }, 2000); 
          } else {
              alertify.error('Login Failed');
          }
          console.log(response);
      },
     
  });
  
  });
  //FOR END EDIT Department

   //FOR START ADD Department
   $('#frmAddDepartment').on('submit', function(e) {
    e.preventDefault();

    var dept_name = $('#add_dept_name').val();
    var dept_description = $('#add_dept_description').val();


    $.ajax({
      url: '../endpoints/post.php',
      type: 'POST',
      data: {
        dept_name: dept_name,
        dept_description: dept_description,
        SubmitType: 'AddDepartment'
      },
    
      success: function(response) {

        console.log(response);
          // Handle successful response
          if (response == '200') {
            alertify.success('Successful added');
            $('.loading-spinner').show();
            document.getElementById('btnAddDepartment').disabled = true;


            setTimeout(function() {
              // Hide spinner after the redirection
              $('.loading-spinner').hide();
              document.getElementById('btnAddDepartment').disabled = false;

              
                window.location.href = '../admin/department.php';
              
            }, 2000); 
          } else {
              alertify.error('Login Failed');
          }
          console.log(response);
      },
     
  });
  
  });
  //FOR END ADD Department


  //FOR START ADD SUBJECT
  $('#frmAddSubject').on('submit', function(e) {
    e.preventDefault();

    var course_code = $('#add_course_code').val();

    var for_yr_lvl = $('#for_yr_lvl').val();


    var descriptive_title = $('#add_descriptive_title').val();
    var units = $('#add_units').val();
    var pre_requisite = $('#add_pre_requisite').val();
    var stud_department = $('#add_stud_department').val();
    


    $.ajax({
      url: '../endpoints/post.php',
      type: 'POST',
      data: {
        for_yr_lvl:for_yr_lvl,
        course_code: course_code,
        descriptive_title: descriptive_title,
        units:units,
        pre_requisiteL:pre_requisite,
        stud_department:stud_department,
          SubmitType: 'AddSubject'
      },
    
      success: function(response) {

        console.log(response);
          // Handle successful response
          if (response == '200') {
            alertify.success('Successful added');
            $('.loading-spinner').show();
            document.getElementById('btnAddSubject').disabled = true;


            setTimeout(function() {
              // Hide spinner after the redirection
              $('.loading-spinner').hide();
              document.getElementById('btnAddSubject').disabled = false;

              
                window.location.href = '../admin/subject.php';
              
            }, 2000); 
          } else {
              alertify.error('Login Failed');
          }
          console.log(response);
      },
     
  });
  
  });
  //FOR END ADD SUBJECT


  //FOR START Delete Confirmation
  $(document).on('click', '.TogglerDeleteSubject', function(e) {
    e.preventDefault();
    var course_code = $(this).attr('data-code');
    var subject_id = $(this).attr('data-subject_id');

    console.log(course_code);

    alertify.confirm('Delete Confirmation', 'Are you sure you want to delete this subject?',
        function() {
            $.ajax({
                url: '../endpoints/post.php',
                type: 'POST',
                data: { course_code: course_code, subject_id: subject_id, SubmitType: 'DeleteSubject' },
                success: function(response) {
                    console.log(response);

                    if (response === '200') {
                        alertify.success('Deleted Successfully');

                          window.location.href = '../admin/subject.php';
                   
                    } else {
                        alertify.error('Deletion Failed');
                    }
                },
                error: function() {
                    alertify.error('Failed to delete the subject');
                }
            });
        },
        function() {
            // If the user clicks 'No'
            alertify.error('Delete action canceled');
        }
    );
});




//FOR START Delete for students subject
$('.TogglerDeleteStudentSubject').on('click', function(e) {
  e.preventDefault();
  var student_id = $(this).attr('data-student_id');
  var course_code = $(this).attr('data-code');
  var subject_id = $(this).attr('data-subject_id');

  var ss_id = $(this).attr('data-ss_id');

  console.log(ss_id);

  alertify.confirm('Delete Confirmation', 'Are you sure you want to remove this subject?',
      function() {
          $.ajax({
              url: '../endpoints/post.php',
              type: 'POST',
              data: { ss_id: ss_id, SubmitType: 'DeleteStudentSubject' },
              success: function(response) {
                  console.log(response);

                  if (response === '200') {
                      alertify.success('Deleted Successfully');
                        window.location.href = 'view_student_info.php?stud_id='+student_id;
                  } else {
                      alertify.error('Deletion Failed');
                  }
              },
              error: function() {
                  alertify.error('Failed to delete the subject');
              }
          });
      },
      function() {
          // If the user clicks 'No'
          alertify.error('Delete action canceled');
      }
  );
});











//FOR START Delete Confirmation for student
$(document).on('click', '.TogglerDeleteStudent', function(e) {
  e.preventDefault();
  var stud_id = $(this).attr('data-stud_id');

  console.log(stud_id);

  alertify.confirm('Delete Confirmation', 'Are you sure you want to delete this user?',
      function() {
          $.ajax({
              url: '../endpoints/post.php',
              type: 'POST',
              data: { stud_id: stud_id, SubmitType: 'deactivateStudent' },
              success: function(response) {
                  console.log(response);

                  if (response === '200') {
                      alertify.success('Deleted Successfully');

                        window.location.href = '../admin/student.php';

                  } else {
                      alertify.error('Deletion Failed');
                  }
              },
              error: function() {
                  alertify.error('Failed to delete the subject');
              }
          });
      },
      function() {
          // If the user clicks 'No'
          alertify.error('Delete action canceled');
      }
  );
});
  //FOR END Delete Confirmation for student



  
//FOR START Delete Confirmation for student
$(document).on('click', '.TogglerDeleteDepartment', function(e) {
  e.preventDefault();
  var dept_id = $(this).attr('data-dept_id');

  console.log(dept_id);

  alertify.confirm('Delete Confirmation', 'Are you sure you want to delete this user?',
      function() {
          $.ajax({
              url: '../endpoints/post.php',
              type: 'POST',
              data: { dept_id: dept_id, SubmitType: 'deactivateDepartment' },
              success: function(response) {
                  console.log(response);

                  if (response === '200') {
                      alertify.success('Deleted Successfully');

                        window.location.href = '../admin/department.php';

                  } else {
                      alertify.error('Deletion Failed');
                  }
              },
              error: function() {
                  alertify.error('Failed to delete the subject');
              }
          });
      },
      function() {
          // If the user clicks 'No'
          alertify.error('Delete action canceled');
      }
  );
});
  //FOR END Delete Confirmation for student









//FOR START Delete Confirmation for user
$(document).on('click', '.TogglerDeleteUser', function(e) {
  e.preventDefault();
  var admin_id = $(this).attr('data-admin_id');

  console.log(admin_id);

  alertify.confirm('Delete Confirmation', 'Are you sure you want to delete this user?',
      function() {
          $.ajax({
              url: '../endpoints/post.php',
              type: 'POST',
              data: { admin_id: admin_id, SubmitType: 'deactivateUser' },
              success: function(response) {
                  console.log(response);

                  if (response === '200') {
                      alertify.success('Deleted Successfully');
                                            
     
                    var buttons = document.querySelectorAll('#delLoad-' + admin_id + ' button');
                    buttons.forEach(function(button) {
                        button.disabled = true;
                    });

                    setTimeout(function() {

                        buttons.forEach(function(button) {
                            button.disabled = false;
                        });

                        // Redirect to the subject page
                        window.location.href = '../admin/user.php';
                    }, 2000);

                  } else {
                      alertify.error('Deletion Failed');
                  }
              },
              error: function() {
                  alertify.error('Failed to delete the subject');
              }
          });
      },
      function() {
          // If the user clicks 'No'
          alertify.error('Delete action canceled');
      }
  );
});

  //FOR END Delete Confirmation

});




$(document).on('click', '.view_student', function() {
  var stud_id = $(this).data('stud_id');
  window.location.href = 'view_student_info.php?stud_id=' + stud_id;
});








(function($) {

	"use strict";

	$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

})(jQuery);









$(document).ready(function() {
  $('#filterButton').click(function() {
      var selectedYear = $('#schoolYear').val();
      var selectedSemester = $('#semester').val();

      $('#myTable tbody tr').each(function() {
          var rowYear = $(this).data('school_year');
          var rowSemester = $(this).data('semester');

          if ((selectedYear === '' || rowYear === selectedYear) &&
              (selectedSemester === '' || rowSemester === selectedSemester)) {
              $(this).show();
          } else {
              $(this).hide();
          }
      });
  });

  // Reset button functionality
  $('.btnReset').click(function() {
      // Clear the filter selections
      $('#schoolYear').val('');
      $('#semester').val('');

      // Show all rows in the table
      $('#myTable tbody tr').show();
  });
});






