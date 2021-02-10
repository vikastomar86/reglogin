<div class="row">
    <div class="col-lg-9 form-errors">
        
        <ul class="error-list">
		 @if(!empty($error->messages))
            @foreach($error->messages as $message)
                <li>{{ $message }}</li>
            @endforeach
		 @endif
        </ul>
    </div>
</div>