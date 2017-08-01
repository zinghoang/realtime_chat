<div class="lv-header-alt clearfix">
	<div id="ms-menu-trigger">
		<div class="line-wrap button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" role="button" type="button">
                    <div class="line top"></div>
                    <div class="line center"></div>
                    <div class="line bottom"></div>
                </div>
                @widget('MenuNav')
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
	<div id="notes"></div>
	@if($isJoin == 1)
	<ul class="lv-actions actions list-unstyled list-inline">
		<li>
			<a href="#" data-toggle="modal" data-target="#myModal" title="Create room">
				<i class="fa fa-plus"></i>
			</a>
		</li>
        
		<li>
			<a href="{{ route('frontend.room.show', $room->id) }}" title="Show all member of this room" style="border: 1px solid #adadad; border-radius: 50%; color: #adadad;" class="countmember">{{ $countMember}}</a>
		</li>
		<li>
			<a id="leave-room" href="{{ route('frontend.room.leave', $room->id) }}" title="Leave this room">
				<i class="fa fa-share" aria-hidden="true"></i> 
			</a>
		</li>
		<li>
			<a href="#" data-toggle="modal" data-target="#myModalUpload" title="Upload Media">
				<i class="fa fa-upload" aria-hidden="true"></i>
			</a>
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

	<!-- Modal Create room -->
    <div class="modal fade" id="myModal" role="dialog">
    	<div class="modal-dialog">
    		<!-- Modal content-->
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal">&times;</button>
    				<h4 class="modal-title">Create room...</h4>
    			</div>
    			<form method="post" action="{{ route('frontend.room.store') }}">
    				{{ csrf_field() }}
    				<div class="modal-body">
    					<div class="form-group">
        					<label for="name">Name:</label>
        					<input type="text" class="form-control" name="name" id="name">
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
		<!-- Modal Upload File -->
		<div class="modal fade" id="myModalUpload" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Upload Media...</h4>
					</div>
					<form method="post" action="{{ route('frontend.message.uploadfile', $room->id) }}" enctype="multipart/form-data" id="upload-file">
						{{ csrf_field() }}
						<div class="modal-body">
							<div class="form-group">
								<label for="title">Title:</label>
								<input type="text" class="form-control" name="title" id="title">
							</div>
							<div class="form-group">
								<label for="upload">Choose File:</label>
								<input type="file" class="form-control" id="upload" name="upload" onchange="showTitle(this)">
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
	<!-- Modal Invite Room -->
    <div class="modal fade" id="inviteFriend" role="dialog">
    	<div class="modal-dialog">
    		<!-- Modal content-->
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal">&times;</button>
    				<h4 class="modal-title">Invite friend...</h4>
    				<div id="noti-invite"></div>
    			</div>
    			<form method="post" action="javascript:void(0)" id="invite-form">
    				 <input type="hidden" name="_token" value="{{ csrf_token() }}">
    				<div id="message-form">
    				</div>
    				<div class="modal-body">
    					<div class="form-group">
        					<label for="name">Name:</label>
        					<input type="text" class="form-control" name="name" id="name-search" value="" required>
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
			}
		}); 
	});
    function showTitle(title) {
		var arr = $('#upload').val().split('\\');
		var arr_title = arr[arr.length-1];
        arr_title = arr_title.split('.');
		var show = '';
		for (var i = 0 ;i < arr_title.length-1;i++){
		    show = show + arr_title[i];
		    if (i< arr_title.length-1) show = show + ' ';
		}
		$('#title').val(show);
    }
</script>
@endsection