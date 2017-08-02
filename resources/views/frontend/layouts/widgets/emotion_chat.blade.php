<div class="col-md-9">
    <div id="list-icon" >
        @foreach ($listEmotion as $key => $emotion)
        <button onclick='addIcon("{{ $emotion->code }}")'>
            <img src="{{ asset('storage/emotions/' . $emotion->image) }}" width="20px" alt="{{ $emotion->name }}">
        </button>
        @endforeach
    </div>
</div>  

<div class="emotion">
    <button onclick="showEmotion()"><i class="fa fa-smile-o" aria-hidden="true"></i></button>
</div> 

<script type="text/javascript">

    

    function addIcon(code)
    {

        var x = $('#txt-mess-content').val();
        $('#txt-mess-content').val(x + ' ' + code);

        var y = $('#mess-content').val();
        $('#mess-content').val(y + ' ' + code);


    }

    function showEmotion(){

        var x = document.getElementById('list-icon');
        if (x.style.display === 'none' || x.style.display === '') {
            x.style.display = 'block';
            window.scrollTo(0,document.body.scrollHeight);

        } else {
            x.style.display = 'none';
        }
    }


</script>