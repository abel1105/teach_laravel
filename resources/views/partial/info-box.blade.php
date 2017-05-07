@if(\Session::has('alert'))
    <div class="pad margin no-print">
        <div class="callout callout-danger" style="margin-bottom: 0!important;">
            <h4>警告!</h4>
            <p>{{ \Session::get('alert') }}</p>
        </div>
    </div>
@endif
@if(\Session::has('success'))
    <div class="pad margin no-print">
        <div class="callout callout-success" style="margin-bottom: 0!important;">
            <h4>成功</h4>
            <p>{{ \Session::get('success') }}</p>
        </div>
    </div>
@endif