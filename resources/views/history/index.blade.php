@extends('layouts.app')
@section('content')
<div class="container-fluid app-body settings-page">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Post Send To Buffer</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <i class="input-icon fa fa-search"></i>
                                <input type="text" placeholder="Search" name="keyword" class="form-control keywords" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="date" name="date" class="form-control sent-date" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select class="form-control group">
                                    <option value="">All Group</option>
                                    @foreach ($groups as $row)
                                        <option value="{{ $row->type }}">{{ $row->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="posting-data">
                            @include('history.view-posting')
                        </div>
                    </div>
                    
                </div>
            </div>
          
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.pagination a', function (event) {
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            event.preventDefault();
            var url = $(this).attr('href');
            var keywords = $('.keywords').val();
            var date = $(".sent-date").val();
            var group = $(".group").val();
            getPostingData(url, keywords,date,group);
        });
        $('.keywords').keyup(function () {
            var url = $(this).attr('action');
            var keywords = $('.keywords').val();
            var date = $(".sent-date").val();
            var group = $(".group").val();
            getPostingData(url, keywords,date,group);
        });
        $(".sent-date").change(function(){
            var url = $(this).attr('action');
            var keywords = $('.keywords').val();
            var date = $(".sent-date").val();
            var group = $(".group").val();
            getPostingData(url, keywords,date,group);
        });
        $(".group").change(function(){
            var url = $(this).attr('action');
            var keywords = $('.keywords').val();
            var date = $(".sent-date").val();
            var group = $(".group").val();
            getPostingData(url, keywords,date,group);
        });
    });

    function getPostingData(url, keywords,date,group) {
        $.ajax({
            url: url,
            type: "GET",
            datatype: "html",
            data: {
                "keywords": keywords,
                "date":date,
                'group':group
            }
        }).done(function (data) {
            console.log(data);
            $(".posting-data").empty().html(data);
        });
    }

</script>
@endsection