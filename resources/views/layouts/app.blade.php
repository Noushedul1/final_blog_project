<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">
@include('layouts.includes.head')
<body>
  <!-- navigation -->
@include('layouts.includes.navbar')
<!-- /navigation -->


@yield('mainSection')

{{-- @include('layouts.includes.footer') --}}


  <!-- JS Plugins -->
@include('layouts.includes.script')
</body>
</html>
