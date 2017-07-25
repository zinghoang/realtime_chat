<div class="lv-header-alt clearfix">
	<div id="ms-menu-trigger">
		<div class="line-wrap">
			<div class="line top"></div>
			<div class="line center"></div>
			<div class="line bottom"></div>
		</div>
	</div>
	<div class="lvh-label hidden-xs">
		<div class="lv-avatar pull-left"> 
			<img src="{{ asset('images/home.png') }}" alt=""> 
		</div>
		<span class="c-black" id="showNameRoom">{{ $room->name }}</span>
		@if($room->user_id == Auth::id())
		<a href="javascript:void(0)" data-toggle="modal" data-target="#editNameRoom" title="Edit the name of room"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

		<!-- Modal Edit Name Room -->
        <div class="modal fade" id="editNameRoom" role="dialog">
        	<div class="modal-dialog">
        		<!-- Modal content-->
        		<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">&times;</button>
        				<h4 class="modal-title">Edit name room...</h4>
        			</div>
        			<form method="post" action="javascript:void(0)" id="form-edit-name-room">
        				{{ csrf_field() }}
        				<input type="hidden" name="_method" value="PUT">
        				<div class="modal-body">
        					<div class="form-group">
            					<label for="name">Name:</label>
            					<input type="text" class="form-control" name="name" id="nameRoom" value="{{ $room->name }}">
        					</div>
            			</div>
            			<div class="modal-footer">
            				<button type="submit" class="btn btn-info">Save</button>
            				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            			</div>
        			</form>
        			
        		</div>
        	</div>
        </div>
        @endif
	</div>
	@if($isJoin == 1)
	<ul class="lv-actions actions list-unstyled list-inline">
		<li>
			<a href="{{ route('frontend.room.show', $room->id) }}" title="Show all member of this room" style="border: 1px solid #adadad; border-radius: 50%; color: #adadad;">
				{{ $countMember}}
			</a>	
		</li>
		<li>
			<a id="leave-room" href="{{ route('frontend.room.leave', $room->id) }}" title="Leave this room" onclick="return confirm('Do you want to leave this room?')"> 
				<i class="fa fa-share" aria-hidden="true"></i> 
			</a>
		</li>
		<li>
			<form method="post" action="{{ route('frontend.message.uploadfile', $room->id) }}" enctype="multipart/form-data" id="upload-file">
				{{ csrf_field() }}
				<label for="upload">
					<i class="fa fa-upload" aria-hidden="true"></i> 
					<input type="file" id="upload" name="title" style="display:none" onchange="event.preventDefault(); document.getElementById('upload-file').submit();">
				</label>
		    </form>					
		</li>
		<li>
			<a href="#" data-toggle="modal" data-target="#inviteFriend" title="Invite friend">
				<i class="fa fa-envelope" aria-hidden="true"></i>
			</a>
		</li>

		@if($room->user_id == Auth::id())
			<li> 
				<a href="{{ route('frontend.room.destroy', $room->id) }}" 
	                onclick="event.preventDefault(); document.getElementById('destroy-room').submit();" style="text-decoration: none;">
	                <span class="glyphicon glyphicon-trash"></span>
	            </a>
	            <form id="destroy-room" action="{{ route('frontend.room.destroy', $room->id) }}" method="POST" style="display: none;">
	                {{ csrf_field() }}
	                <input name="_method" type="hidden" value="DELETE">
	            </form>
			</li>
		@endif
	</ul>
	<!-- Modal Invite Room -->
        <div class="modal fade" id="inviteFriend" role="dialog">
        	<div class="modal-dialog">
        		<!-- Modal content-->
        		<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">&times;</button>
        				<h4 class="modal-title">Invite friend...</h4>
        			</div>
        			<form method="post" action="javascript:void(0)" id="invite-form">
        				 <input type="hidden" name="_token" value="{{ csrf_token() }}">
        				<div id="message-form">
        				</div>
        				<div class="modal-body">
        					<div class="form-group">
            					<label for="name">Name:</label>
            					<input type="text" class="form-control" name="name" id="name-search" value="">
            					<input type="hidden" name="room_id" id="room_id" value="{{ $room->id }}">
        					</div>
            			</div>
            			<div class="modal-footer">
            				<button type="submit" class="btn btn-info" >Invite</button>
            				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            			</div>
        			</form>
        		</div>
        	</div>
        </div>
	@endif
</div>

@section('script')
<script type="text/javascript">
	$('#form-edit-name-room').on('submit', function(){
		$.ajax({
			url: "{{ route('frontend.room.update', $room->id) }}",
			type: 'POST',
			cache: false,
			data: {
				_method: 'PUT',
				name: $('#nameRoom').val(),
			},
			success: function(data){
				$( '#showNameRoom' ).text( data );

				
				$("#editNameRoom .close").click()
				

			},
			error: function (){
				alert('Error!');
			}
		}); 
	});
</script>
@endsection