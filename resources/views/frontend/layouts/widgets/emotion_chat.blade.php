<!-- Start test emotion -->

<style type="text/css">
   

    .emotion{
        position: absolute;
        z-index: 30000000;
        bottom: 82px;

    }
    .emotion > button{
        border: none;
        
    }

    #list-icon{
        float: left;

        border: 1px solid #cccccc;
        border-radius: 2px;
        float: left;
        display: none;
        position: absolute;
        z-index: 21000000;
        left: 40px;
        bottom: 18px;
        width: 100%;
        right: 80px;

        overflow-y: scroll;
        height: 100px;
        overflow-x: hidden;

        background-color: #ffffff;
        
    }

    #list-icon button{
        border-radius: 50px;
        border: 1px solid #ffffff;
    }

</style>

<div class="row">
    <div class="col-md-4">
        <div id="list-icon" >
            @foreach ($listEmotion as $key => $emotion)
            <button onclick='addIcon("{{ $emotion->code }}")'>
                <img src="{{ asset('storage/emotions/' . $emotion->image) }}" width="20px" alt="{{ $emotion->name }}">
            </button>
            @endforeach
        </div>
    </div>
</div>

<div class="emotion">
    <button onclick="showEmotion()"><i class="fa fa-smile-o" aria-hidden="true"></i></button>
</div>  


<script type="text/javascript">
    function addIcon(code)
    {

        var x = $('#txt-mess-content').val();
        $('#txt-mess-content').val(x + code + ' ');

        var y = $('#mess-content').val();
        $('#mess-content').val(y + code + ' ');


    }
    // (#emo)

    // on('click', function(event))
    // event.target != 
    function showEmotion(){
        //$('#list-icon').show();

        var x = document.getElementById('list-icon');
        if (x.style.display === 'none' || x.style.display === '') {
            x.style.display = 'block';
            window.scrollTo(0,document.body.scrollHeight);

        } else {
            x.style.display = 'none';
        }
    }


</script>