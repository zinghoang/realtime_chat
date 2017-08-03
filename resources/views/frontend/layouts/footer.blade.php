
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/socket.io.js') }}"></script>
 <!-- Alert notification -->
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/notify.js') }}"></script>
<script type="text/javascript">
	var notes = $('#notes').notify({
		removeIcon: '<i class="icon icon-remove"></i>'
	});
</script>

@widget('GetUserLogin')
@yield('script')
@yield('script2')
@yield('scriptAlert')
<script src="{{ asset('js/chat.js') }}"></script>
@yield('endscript')
</body>

</html>