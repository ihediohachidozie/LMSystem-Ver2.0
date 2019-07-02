  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('theme/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('theme/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('theme/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('theme/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{asset('theme/js/demo/chart-pie-demo.js') }}"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

  <script>

      $(document).ready(function() {
          $('#example').DataTable( {
              "paging":   false,
              "ordering": false,
              "searching": false,
              "info":     false,
              dom: 'Bfrtip',
              buttons: {
                  buttons: [
                      { extend: 'copy', className: 'btn btn-success' },
                      { extend: 'excel', className: 'btn btn-primary' }

                  ]
              },
          });
      });
            
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        
    });
  </script>



