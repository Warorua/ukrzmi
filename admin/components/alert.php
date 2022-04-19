<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
//$_SESSION['error'] = 'Test error';
//$_SESSION['success'] = 'Test success';
      if(isset($_SESSION['error'])){
        echo "         
  <script>
  $( document ).ready(function() {
 const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 10000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'error',
  title: '".$_SESSION['error']."'
})
}); 
      
  </script>
        ";
        unset($_SESSION['error']);
      }

      if(isset($_SESSION['success'])){
        echo "

  <script>
  $( document ).ready(function() {
   const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 10000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: '".$_SESSION['success']."'
})
}); 
      
  </script>
       ";
       unset($_SESSION['success']);
      }
?>