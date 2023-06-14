<script src="{{asset('usr_assets/plugins/jQuery/jquery.min.js') }}"></script>

  <script src="{{asset('usr_assets/plugins/bootstrap/bootstrap.min.js') }}"></script>

  <script src="{{asset('usr_assets/plugins/slick/slick.min.js') }}"></script>

  <script src="{{asset('usr_assets/plugins/instafeed/instafeed.min.js') }}"></script>


  <!-- Main Script -->
  <script src="{{ asset('usr_assets(js/script.js)') }}"></script>
  {{-- summernote  --}}
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  {{-- toastr  --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @stack('script_body')
