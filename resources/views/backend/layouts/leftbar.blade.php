<section class="sidebar">
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ url('storage/avatars/' . Auth::user()->avatar) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ Auth::user()->fullname }}</p>
            @ {{ Auth::user()->name }}
        </div>
    </div>

    <ul class="sidebar-menu" id="list_pages">

        <li>
            <a href="{{ route('admin.index') }}">
                <i class="fa fa-home"></i> <span>Dashboard</span>
            </a>
        </li>
    
        <li class="{{ Request::is('admin/rooms*')? 'active' : '' }}">
            <a href="{{ route('rooms.index') }}">
                <i class="fa fa-folder"></i> <span>Rooms</span>
            </a>
        </li>
    
        <li class="{{ Request::is('admin/emotions*')? 'active' : '' }}">
            <a href="{{ route('emotions.index') }}">
                <i class="fa fa-smile-o"></i> <span>Emotions</span>
            </a>
        </li>
    
        <li class="{{ Request::is('admin/files*')? 'active' : '' }}">
            <a href="{{ route('files.index') }}">
                <i class="fa fa-file-audio-o"></i> <span>Files</span>
            </a>
        </li>

        @if(Auth::user()->level == 2)
    
        <li class="{{ Request::is('admin/users*')? 'active' : '' }}">
            <a href="{{ route('users.index') }}">
                <i class="fa fa-user"></i> <span>Users</span>
            </a>
        </li>

        @endif
    
    </ul>
</section>