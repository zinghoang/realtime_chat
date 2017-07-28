
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

@widget('GetUserLogin')
@yield('script')
@yield('script2')
<script src="{{ asset('js/chat.js') }}"></script>
@yield('endscript')
</body>

</html>