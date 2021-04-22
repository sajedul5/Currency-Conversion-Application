@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Currency Conversion Application
        </div>
        <div class="card-body">
            <form id="currency-exchange-rate" action="#" method="post" class="form-group">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" name="amount" class="form-control" value="1">
                    </div>
                    <div class="col-md-4">
                        <select name="from_currency" class="form-control">
                            <option value='BDT'>BDT</option>
                            <option value='EUR'>EUR</option>
                            <option value='USD'>USD</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="to_currency" class="form-control">
                            <option value='BDT'>BDT</option>
                            <option value='EUR'>EUR</option>
                            <option value='USD'>USD</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary " value="Click To Currency Conversion">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <span id="output"></span>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#btnSubmit").click(function(event) {
            //stop submit the form, we will post it manually.
            event.preventDefault();
            // Get form
            var form = $('#currency-exchange-rate')[0];
            // Create an FormData object
            var data = new FormData(form);
            // disabled the submit button
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                url: "{{ url('currency') }}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function(data) {
                    $("#output").html(data);
                    $("#btnSubmit").prop("disabled", false);
                },
                error: function(e) {
                    $("#output").html(e.responseText);
                    console.log("ERROR : ", e);
                    $("#btnSubmit").prop("disabled", false);
                }
            });
        });
    });
</script>
@endsection
