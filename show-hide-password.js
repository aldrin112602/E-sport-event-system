    $(document).ready(() => {
      $('#eye').on('click', () => {
        if($('#pswd').prop('type') == 'password') {
         $('#eye').removeClass('fa-eye-slash');
         $('#eye').addClass('fa-eye');
         $('#pswd').prop('type', 'text');
       }
       else {
         $('#eye').addClass('fa-eye-slash');
         $('#eye').removeClass('fa-eye');
         $('#pswd').prop('type', 'password');
       }
      })
    });