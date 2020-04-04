<div class="modal fade" id="{{ $name }}" tabindex="-1" role="dialog" aria-labelledby="{{ $name }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $name }}">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $text }}
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">{{ $action ?? 'Potvrdi' }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $cancel ?? 'Otkaži' }}</button>
            </div>
        </div>
    </div>
</div>
