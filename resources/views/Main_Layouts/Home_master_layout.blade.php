

    @include('Common_header_footer.header')



    @guest

    @else





    @endguest


        @yield('content')


    @include('Common_header_footer.footer')



